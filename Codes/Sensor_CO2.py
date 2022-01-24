from AtlasI2C import AtlasI2C
from time import sleep
from outputs import OUTPUT
from threading import Thread
from WebComunication import API
import time

data = {"sensor_id":"","sensor_data":""}



SENSOR_INFO = {
    "name":"CO2",
    "measurements_name":"carbon dioxide",
    "interface":"i2c",
    "url_purchase":["https://atlas-scientific.com/probes/co2-sensor/"],
    "url_datasheet":["https://files.atlas-scientific.com/EZO_CO2_Datasheet.pdf"],
    "address":"",
    "min":"",
    "max":"",
    "type":"EZO-CO2"
}


class CO2:
    def __init__(self, api, headers):
        self.api = api
        self.web = API(headers)
        self.outOBJ = OUTPUT()
        self.MyThread = ''
        self.outcheck = 0
        self.wait = self.stop = False
        self.count = 0
        self.id = []
        self.name = []
        self.info = []
        self.status = []
        self.address = []
        self.assosiatedOuts = []
        self.Triggered = []
        self.frequency = []
        self.lastRead = []
        self.currentValues = []
        
        self.max = []
        self.min = []
        
        self.sensor = []
    
    
    def addSensor(self, name, addr, ID, maxi, mini):
        self.count += 1
        self.id.append(ID)
        self.name.append(name)
        self.address.append(addr)
        
        self.max.append(maxi)
        self.min.append(mini)
        
        self.status.append(False)
        self.assosiatedOuts.append('')
        self.frequency.append(5)
        self.lastRead.append(5)
        self.Triggered.append(False)
        self.currentValues.append('')
        
        SENSOR_INFO["address"] = str(addr)
        self.info.append(SENSOR_INFO)
        
        
        self.sensor.append(AtlasI2C())
    
    
    def delete_sensor(self, ID):
        x = self.id.index(ID)
        self.count -= 1
        del self.id[x]
        del self.name[x]
        del self.info[x]
        del self.status[x]
        del self.address[x]
        del self.min[x]
        del self.max[x]
        del self.sensor[x]
        del self.assosiatedOuts[x]
        del self.Triggered[x]
        del self.frequency[x]
        del self.lastRead[x]
        del self.currentValues[x]
    
    
    def activate_deactivate(self, ID, state):
        x = self.id.index(ID)
        self.status[x] = state
        if (state):
            self.sensor[x].set_i2c_address(self.address[x])
        else:
	        self.sensor[x].close()
        
    
    def modify_min_max(self, ID, maxi, mini):
        x = self.id.index(ID)
        self.max[x] = maxi
        self.min[x] = mini
    
    
    def assosiate_output(self, ID, OutID, Type, Interface, pin_addr, Extra):
        x = self.id.index(ID)
        self.outOBJ.add_ouput(ID, Type, Interface, pin_addr, Extra)
        self.assosiatedOuts[x] = [OutID, Type, Interface, Extra, pin_addr]
    
    
    def get_measurement_all(self, CurrentTime):
        value = []
        for x in range(self.count):
            if(self.status[x] and self.wait == False):
                if(CurrentTime - self.lastRead[x] > self.frequency[x]):
                    data["sensor_id"] = str(self.id[x])
                    data["sensor_data"] = ""
                    self.sensor[x].write("R")
                    sleep(1.5)
                    val = self.sensor[x].read()
                    val = val.replace(' ', '')
                    val = val.split(":")
                    if(val[0] == 'Success'):
                        sensor_value = val[1]
                        data["sensor_data"] = '[{"val":"' + sensor_value +'", "unit":"ppm"}]'
                        value.append(data)
                        self.currentValues[x] = float(sensor_value)
                    else:
                        self.currentValues[x] = ''
                    self.lastRead[x] = time.time()
                    print(data)
        Thread(target=self.SendData, args=(value,), daemon=True).start()
        return value

    
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
                        if(self.currentValues[x] < self.min[x]):
                            self.outOBJ.activate_output(self.id[x], self.assosiatedOuts[x])
                            self.Triggered[x] = True
                            if(self.assosiatedOuts[x][1] == 'pump'):
                                time.sleep(3)
                                self.outOBJ.deactivate_output(self.id[x], self.assosiatedOuts[x])
                                self.Triggered[x] = False
                    else:
                        if(self.currentValues[x] > self.min[x]):
                            self.outOBJ.deactivate_output(self.id[x], self.assosiatedOuts[x])
                            self.Triggered[x] = False
        self.outcheck = time.time()


    def get_measurement(self, ID):
        x = self.id.index(ID)
        data["sensor_id"] = str(self.id[x])
        data["sensor_data"] = ""
        if(self.status[x]):
            self.sensor[x].write("R")
            sleep(1.5)
            val = self.sensor[x].read()
            val = val.replace(' ', '')
            val = val.split(":")
            if(val[0] == 'Success'):
                sensor_value = val[1]
                data["sensor_data"] = '[{"val":"' + sensor_value +'", "unit":" "}]'
        return data
    
    
    def SendData(self, val):
        for x in range(len(val)):
            if(val[x]["sensor_data"] != ""):
                self.web.send(self.api, val[x])
            
            
    def get_sensor_info(self, ID):
        x = self.id.index(ID)
        return self.info[x]

