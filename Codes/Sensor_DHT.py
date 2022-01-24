import Adafruit_DHT
from time import sleep
from threading import Thread
from WebComunication import API
from outputs import OUTPUT
import math, time

data = {"sensor_id":"","sensor_data":""}

types = {
    'DHT11': Adafruit_DHT.DHT11,
    'DHT22': Adafruit_DHT.DHT22,
    'AM2302': Adafruit_DHT.AM2302
    }




SENSOR_INFO = {
    "name":"DHT",
    "measurements_name":"temperature/humidity/dew point",
    "interface":"gpio",
    "url_purchase":["https://www.amazon.com/HiLetgo-Temperature-Humidity-Electronic-Practice/dp/B0795F19W6/ref=sr_1_1?dchild=1&keywords=DHT22&qid=1628699368&sr=8-1"],
    "url_datasheet":["https://www.sparkfun.com/datasheets/Sensors/Temperature/DHT22.pdf"],
    "gpio":"",
    "type":"DHT22"
}


class DHT:
    def __init__(self, api, headers):
        self.api = api
        self.web = API(headers)
        self.outOBJ = OUTPUT()
        self.MyThread = ''
        self.outcheck = 0
        self.wait = self.stop = False
        self.count = 0
        self.id = []
        self.pin = []
        self.type = []
        self.name = []
        self.status = []
        self.info = []
        self.assosiatedOuts = []
        self.Triggered = []
        self.frequency = []
        self.lastRead = []
        self.currentValues = []
        
        self.temp_max = []
        self.temp_min = []
        self.humi_max = []
        self.humi_min = []
        self.dew_max = []
        self.dew_min = []
        
        
    def addSensor(self, name, pin, Type, ID, temp_max, temp_min, humi_max, humi_min, dew_max, dew_min):
        self.count += 1
        self.id.append(ID)
        self.pin.append(pin)
        self.type.append(types[Type])
        self.name.append(name)
        self.assosiatedOuts.append('')
        self.frequency.append(5)
        self.lastRead.append(5)
        self.Triggered.append(False)
        self.currentValues.append('')
        
        self.temp_max.append(temp_max)
        self.temp_min.append(temp_min)
        self.humi_max.append(humi_max)
        self.humi_min.append(humi_min)
        self.dew_max.append(dew_max)
        self.dew_min.append(dew_min)
        
        SENSOR_INFO["gpio"] = str(pin)
        SENSOR_INFO["type"] = str(Type)
        
        self.status.append(False)
        self.info.append(SENSOR_INFO)
    
    
    def activate_deactivate(self, ID, state):
        x = self.id.index(ID)
        self.status[x] = state
    
    
    def assosiate_output(self, ID, OutID, Type, Interface, pin_addr, Extra):
        x = self.id.index(ID)
        self.outOBJ.add_ouput(ID, Type, Interface, pin_addr, Extra)
        self.assosiatedOuts[x] = [OutID, Type, Interface, Extra, pin_addr]
    
    
    def modify_min_max(self, ID, temp_max, temp_min, humi_max, humi_min, dew_max, dew_min):
        x = self.id.index(ID)
        self.temp_max[x] = temp_max
        self.temp_min[x] = temp_min
        self.humi_max[x] = humi_max
        self.humi_min[x] = humi_min
        self.dew_max[x] = dew_max
        self.dew_min[x] = dew_min
    
    
    def delete_sensor(self, ID):
        x = self.id.index(ID)
        self.count -= 1
        del self.id[x]
        del self.pin[x]
        del self.type[x]
        del self.name[x]
        del self.temp_max[x]
        del self.temp_min[x]
        del self.humi_max[x]
        del self.humi_min[x]
        del self.dew_max[x]
        del self.dew_min[x]
        del self.info[x]
        del self.status[x]
        del self.assosiatedOuts[x]
        del self.Triggered[x]
        del self.frequency[x]
        del self.lastRead[x]
        del self.currentValues[x]
    
    
    def get_measurement_all(self, CurrentTime):
        val = []
        for x in range(self.count):
            if(self.status[x] and self.wait == False):
                if(CurrentTime - self.lastRead[x] > self.frequency[x]):
                    data["sensor_id"] = str(self.id[x])
                    data["sensor_data"] = ""
                    humidity, temperature = Adafruit_DHT.read_retry(self.type[x], self.pin[x], 2)
                    self.currentValues[x] = ''
                    if humidity is not None and temperature is not None:
                        temp = round(temperature, 2)
                        humi = round(humidity, 2)
                        dew = self.CalculateDewPoint(temp, humi)
                        value = str(temp) + ',' + str(humi) + ',' + (dew)
                        data["sensor_data"] = '[{"val":"' + str(temp) +'", "unit":"C"},{"val": "' + str(humi) + '", "unit":"rh%"},{"val": "' + dew + '", "unit":"C Td"}]'
                        val.append(data)
                        self.currentValues[x] = (temp)
                        self.lastRead[x] = time.time()
                        print(data)
        Thread(target=self.SendData, args=(val,), daemon=True).start()
        return val
    
    def get_measurement(self, ID):
        x = self.id.index(ID)
        data["sensor_id"] = str(self.id[x])
        data["sensor_data"] = ""
        if(self.status[x]):
            humidity, temperature = Adafruit_DHT.read_retry(self.type[x], self.pin[x], 2)
            if humidity is not None and temperature is not None:
                temp = round(temperature, 2)
                humi = round(humidity, 2)
                dew = self.CalculateDewPoint(temp, humi)
                data["sensor_data"] = '[{"val":"' + str(temp) +'", "unit":"C"},{"val": "' + str(humi) + '", "unit":"rh%"},{"val": "' + dew + '", "unit":"C Td"}]'
        return data
    
    
    def CalculateDewPoint(self, temp, humi):
        RATIO = 373.15 / (273.15 + temp)
        RHS = -7.90298 * (RATIO - 1)
        RHS += 5.02808 * math.log10(RATIO)
        RHS += -1.3816e-7 * (math.pow(10, (11.344 * (1 - 1 / RATIO ))) - 1)
        RHS += 8.1328e-3 * (math.pow(10, (-3.49149 * (RATIO - 1))) - 1)
        RHS += math.log10(1013.246);
        VP = math.pow(10, RHS - 3) * humi
  
        T = math.log(VP / 0.61078)
        return  str(round(((241.88 * T) / (17.558 - T)),2))

    
    def loop(self):
        while True:
            CurrentTime = time.time()
            self.get_measurement_all(CurrentTime)
            if(CurrentTime - self.outcheck > 5):
                self.CheckOutputs()
    
    def run(self):
        self.wait = self.stop = False
        self.MyThread = Thread(target=self.loop, daemon=True)
        self.MyThread.start()
    
    
    def stop(self):
        self.stop = True
        self.MyThread.join()


    def pause_unpause_sensors(self, state):
        self.wait = state
        
        
    def CheckOutputs(self):
        for x in range(self.count):
            if(self.status[x] and self.wait == False):
                if(self.assosiatedOuts[x] != '' and self.currentValues[x] != ''):
                    if(self.Triggered[x] == False):
                        if(self.currentValues[x] < self.temp_min[x]):
                            self.outOBJ.activate_output(self.id[x], self.assosiatedOuts[x])
                            self.Triggered[x] = True
                            if(self.assosiatedOuts[x][1] == 'pump'):
                                time.sleep(3)
                                self.outOBJ.deactivate_output(self.id[x], self.assosiatedOuts[x])
                                self.Triggered[x] = False
                    else:
                        if(self.currentValues[x] > self.temp_min[x]):
                            self.outOBJ.deactivate_output(self.id[x], self.assosiatedOuts[x])
                            self.Triggered[x] = False
        self.outcheck = time.time()
        
        
    def SendData(self, val):
        for x in range(len(val)):
            if(val[x]["sensor_data"] != ""):
                self.web.send(self.api, val[x])
    
    def get_sensor_info(self, ID):
        x = self.id.index(ID)
        return self.info[x]
    
    

