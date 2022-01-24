import board, time
from threading import Thread
from outputs import OUTPUT
from WebComunication import API
import adafruit_tsl2591

data = {"sensor_id":"","sensor_data":""}
i2c = board.I2C()

SENSOR_INFO = {
    "name":"Light",
    "measurements_name":"light intensity",
    "interface":"i2c",
    "url_purchase":["https://www.adafruit.com/product/1980"],
    "url_datasheet":["https://cdn-learn.adafruit.com/downloads/pdf/adafruit-tsl2591.pdf"],
    "address":"",
    "type":"TSL2591"
}

class TSL:
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
        self.assosiatedOuts.append('')
        self.frequency.append(5)
        self.lastRead.append(5)
        self.Triggered.append(False)
        self.currentValues.append('')
        
        SENSOR_INFO["address"] = str(addr)
        
        self.status.append(False)
        self.info.append(SENSOR_INFO)
        self.sensor.append(adafruit_tsl2591.TSL2591(i2c, addr))
        self.sensor[self.count-1].gain = adafruit_tsl2591.GAIN_LOW
    
    
    def delete_sensor(self, ID):
        try:
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
            self.outOBJ.delete_output(ID)
        except:
            print('sensor not exist')
        
        
    def modify_min_max(self, ID, maxi, mini):
        x = self.id.index(ID)
        self.max[x] = maxi
        self.min[x] = mini
    
    
    def assosiate_output(self, ID, OutID, Type, Interface, pin_addr, Extra):
        x = self.id.index(ID)
        self.outOBJ.add_ouput(ID, Type, Interface, pin_addr, Extra)
        self.assosiatedOuts[x] = [OutID, Type, Interface, Extra, pin_addr]
    
    
    def activate_deactivate(self, ID, state):
        x = self.id.index(ID)
        self.status[x] = state
        
        
    def get_infrared(self, ID):
        x = self.id.index(ID)
        return self.sensor[x].infrared
        
        
    def get_lux(self, ID):
        x = self.id.index(ID)
        return self.sensor[x].lux
        
        
    def get_visible(self, ID):
        x = self.id.index(ID)
        return self.sensor[x].visible
        
        
    def get_full_spectrum(self):
        x = self.id.index(ID)
        return self.sensor[x].full_spectrum
    
    
    def get_measurement_all(self, CurrentTime):
        val = []
        for x in range(self.count):
            if(self.status[x] and self.wait == False):
                if(CurrentTime - self.lastRead[x] > self.frequency[x]):
                    self.currentValues[x] = ''
                    data["sensor_id"] = str(self.id[x])
                    value = str(round(self.sensor[x].visible, 2))
                    data["sensor_data"] = '[{"val":"' + value +'", "unit":"nm"}]'
                    self.currentValues[x] = float(value)
                    val.append(data)
                    self.lastRead[x] = time.time()
                    print(data)
        Thread(target=self.SendData, args=(val,), daemon=True).start()
        return val

    
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
        if(self.status[x]):
            value = str(round(self.sensor[x].visible, 2))
            data["sensor_data"] = '[{"val":"' + value +'", "unit":"nm"}]'
        return data
    
    
    def SendData(self, val):
        for x in range(len(val)):
            if(val[x]["sensor_data"] != ""):
                a = self.web.send(self.api, val[x])
    
    
    def get_sensor_info(self, ID):
        x = self.id.index(ID)
        return self.info[x]

