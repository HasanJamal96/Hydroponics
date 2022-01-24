import RPi.GPIO as GPIO
import time
from outputs import OUTPUT
from WebComunication import API
from threading import Thread

data = {"sensor_id":"","sensor_data":""}

GPIO.setmode(GPIO.BCM)

SENSOR_INFO = {
    "name":"flow",
    "measurements_name":"water flow",
    "interface":"gpio",
    "url_purchase":["https://www.amazon.com/DIGITEN-Sensor-Switch-Flowmeter-Counter/dp/B00VKATCRQ/ref=sr_1_1?dchild=1&keywords=water+flow+sensor+rpi&qid=1628697509&sr=8-1"],
    "url_datasheet":["https://files.amperka.ru/store-media/products/water-flow-sensor/media/YF-S201.pdf"],
    "gpio":"",
    "min":"",
    "max":"",
    "type":"YF-S201"
}


class FLOW:
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
        self.name = []
        self.min = []
        self.max = []
        self.status = []
        self.assosiatedOuts = []
        self.Triggered = []
        self.frequency = []
        self.lastRead = []
        self.currentValues = []
        
        self.pulses = []
        self.first_time = []
        self.start_counter = []
        self.start_time = []
        self.total = []
        self.info = []


    def addSensor(self, name, pin, ID, maxi, mini):
        self.count += 1
        self.id.append(ID)
        self.name.append(name)
        self.pin.append(pin)
        self.max.append(maxi)
        self.min.append(mini)
        
        self.status.append(False)
        
        self.pulses.append(0)
        self.first_time.append(True)
        self.start_counter.append(False)
        self.start_time.append(0)
        self.total.append(0)
        self.assosiatedOuts.append('')
        self.frequency.append(5)
        self.lastRead.append(5)
        self.Triggered.append(False)
        self.currentValues.append('')
        
        SENSOR_INFO["gpio"] = str(pin)
        SENSOR_INFO["min"] = str(mini)
        SENSOR_INFO["max"] = str(maxi)
        self.info.append(SENSOR_INFO)
        
    
    def delete_sensor(self, ID):
        x = self.id.index(ID)
        self.count -= 1
        del self.id[x]
        del self.name[x]
        del self.info[x]
        del self.status[x]
        del self.pin[x]
        del self.min[x]
        del self.max[x]
        del self.pulses[x]
        del self.first_time[x]
        del self.start_counter[x]
        del self.start_time[x]
        del self.total[x]
        del self.assosiatedOuts[x]
        del self.Triggered[x]
        del self.frequency[x]
        del self.lastRead[x]
        del self.currentValues[x]
    
    
    def assosiate_output(self, ID, OutID, Type, Interface, pin_addr, Extra):
        x = self.id.index(ID)
        self.outOBJ.add_ouput(ID, Type, Interface, pin_addr, Extra)
        self.assosiatedOuts[x] = [OutID, Type, Interface, Extra, pin_addr]
        

    def count_pulse(self,channel):
        x = self.pin.index(channel)
        if (self.start_counter[x]):
            self.pulses[x] = self.pulses[x] + 1


    def start_flow_sensor(self, ID):
        x = self.id.index(ID)
        self.start_counter[x] = True
        self.start_time[x] = time.time()
        GPIO.setup(self.pin[x], GPIO.IN, pull_up_down=GPIO.PUD_UP)
        GPIO.add_event_detect(self.pin[x], GPIO.FALLING, callback=self.count_pulse)
        self.first_time[x] = False


    def get_measurement_all(self, CurrentTime):
        val = []
        for x in range(self.count):
            if(CurrentTime - self.lastRead[x] > self.frequency[x]):
                self.start_counter[x] = True
                self.start_flow_sensor(self.id[x])
                time.sleep(1)
                self.start_counter[x] = False
                GPIO.remove_event_detect(self.pin[x])
                duration = time.time() - self.start_time[x]
                flow = self.pulses[x]  * duration / 7.5
                flow = str(round(flow, 2))
                self.total[x] = self.total[x] + (self.pulses[x] / 450)
                self.pulses[x] = 0
                data["sensor_id"] = str(self.id[x])
                data["sensor_data"] = '[{"val":"' + flow + '","unit":"L/M"}]'
                self.currentValues[x] = float(flow)
                val.append(data)
        Thread(target=self.SendData, args=(val,), daemon=True).start()
        return val

        
    def totalFlow(self, ID):
        x = self.id.index(ID)
        return '[{"val":"' + str(self.total[x]) + '","unit":"L"}]'
    
    
    def modify_min_max(self, ID, mini, maxi):
        x = self.id.index(ID)
        self.min[x] = mini
        self.max[x] = maxi

    
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
    
    
    def SendData(self, val):
        for x in range(self.count):
            self.web.send(self.api, val[x])
            
    
    def get_sensor_info(self, ID):
        x = self.id.index(ID)
        return self.info[x]
