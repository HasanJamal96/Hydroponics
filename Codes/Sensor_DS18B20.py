import sqlite3
import os, glob, time
from outputs import OUTPUT
from threading import Thread
from WebComunication import API

data = {"sensor_id":"","sensor_data":""}
db = sqlite3.connect('/home/pi/Hydroponics.db', timeout=10)

SENSOR_INFO = {
    "name":"Water Temperature",
    "measurements_name":"temperature",
    "interface":"1-wire",
    "url_purchase":["https://www.amazon.com/HiLetgo-DS18B20-Temperature-Stainless-Waterproof/dp/B00M1PM55K/ref=sr_1_1?dchild=1&keywords=DS18B20&qid=1628696218&sr=8-1"],
    "url_datasheet":["https://datasheets.maximintegrated.com/en/ds/DS18B20.pdf"],
    "GPIO":"4",
    "address":"",
    "min":"",
    "max":"",
    "type":"DS18B20"
}


class DS:
    def __init__(self, api, headers):
        os.system('modprobe w1-gpio')
        os.system('modprobe w1-therm')
        self.base_dir = '/sys/bus/w1/devices/'
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
        self.sensor_unique_id = []
        self.device_file = []
        self.assosiatedOuts = []
        self.Triggered = []
        self.frequency = []
        self.lastRead = []
        self.currentValues = []
        
        self.max = []
        self.min = []
        
        
    def addSensor(self, name, uid, ID, maxi, mini):
        address = str(uid)
        length = len(address)
        address = ((12-(length)) * '0') + address
        direc = self.base_dir + '28-' + address
        device_folder = glob.glob(direc)[0] # add senser uid option
        self.device_file.append(device_folder + '/w1_slave')
        self.count += 1
        self.id.append(ID)
        self.name.append(name)
        self.sensor_unique_id.append(uid)
        
        self.max.append(maxi)
        self.min.append(mini)
        self.assosiatedOuts.append('')
        self.frequency.append(5)
        self.lastRead.append(5)
        self.Triggered.append(False)
        self.currentValues.append('')
        
        SENSOR_INFO["address"] = str(uid)
        
        self.status.append(False)
        self.info.append(SENSOR_INFO)


    def delete_sensor(self, ID):
        try:
            x = self.id.index(ID)
            self.count -= 1
            del self.id[x]
            del self.name[x]
            del self.info[x]
            del self.status[x]
            del self.sensor_unique_id[x]
            del self.min[x]
            del self.max[x]
            del self.device_file[x]
            del self.assosiatedOuts[x]
            del self.Triggered[x]
            del self.frequency[x]
            del self.lastRead[x]
            del self.currentValues[x]
            self.outOBJ.delete_output(ID)
            print('sensor deleted')
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
        

    def read_temp_raw(self, index):
        f = open(self.device_file[index], 'r')
        lines = f.readlines()
        f.close()
        return lines


    def get_measurement_all(self, CurrentTime):
        val = []
        for x in range(self.count):
            if(self.status[x] and self.wait == False):
                if(CurrentTime - self.lastRead[x] > self.frequency[x]):
                    lines = self.read_temp_raw(x)
                    while lines[0].strip()[-3:] != 'YES':
                        time.sleep(0.2)
                        lines = self.read_temp_raw(x)
                    equals_pos = lines[1].find('t=')
                    if equals_pos != -1:
                        temp_string = lines[1][equals_pos + 2:]
                        temp_c = float(temp_string) / 1000.0
                        data["sensor_id"] = str(self.id[x])
                        value = str(round(temp_c,2))
                        data["sensor_data"] = '[{"val":"' + value +'", "unit":"C"}]'
                        val.append(data)
                        self.currentValues[x] = float(value)
                        print(data)
                    else:
                        self.currentValues[x] = ''
                    self.lastRead[x] = time.time()
            time.sleep(0.5)
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


    def pause_unpause_sensors(self, state):
        self.wait = state
        

    def SendData(self, val):
        for x in range(len(val)):
            if(val[x]["sensor_data"] != ""):
                a = self.web.send(self.api, val[x])
    
    
    def get_sensor_info(self, ID):
        x = self.id.index(ID)
        return self.info[x]
