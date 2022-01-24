import RPi.GPIO as GPIO
from threading import Thread
from driver import MotorDriver
import time, sqlite3
from time import sleep
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

FREQUENCY = 1000
speed = 100

Dir = [
    'anticlockwise',
    'clockwise',
]

SENSOR_INFO = {
    "name":"flow",
    "interface":"gpio",
    "url_purchase":[""],
    "url_datasheet":[""],
    "gpio":"",
    "addr":"",
    "type":"YF-S201"
}


class OUTPUT:
	def __init__(self):
		self.count = 0
		self.type = []
		self.minTrigger = []
		self.maxTrigger = []
		self.belongsTo = []
		self.TriggerSet = []
		self.id = []
		self.interface = []# gpio, i2c
		self.address = []
		self.pins = []
		self.active = [] # output gpio active high/low
		self.info = []
		self.MyThread = ''
		self.obj = []
		self.stop = False
		self.outActivated = []
		self.pumpNumber = []
		self.pumpTimings = []
		
	
	def add_ouput(self, ID, Type, interface, addr=None, pin=None, active=None, pump=-1):
		self.count += 1
		self.id.append(ID)
		self.type.append(Type)
		self.interface.append(interface)
		self.minTrigger.append(0.0)
		self.maxTrigger.append(0.0)
		self.TriggerSet.append(False)
		self.outActivated.append(False)
		self.belongsTo.append(0)
		self.address.append(addr)
		self.pins.append(pin)
		self.active.append(active)
		SENSOR_INFO["type"] = SENSOR_INFO["name"] = Type
		SENSOR_INFO["gpio"] = pin
		SENSOR_INFO["addr"] = addr
		self.info.append(SENSOR_INFO)
		
		self.pumpTimings.append(0)
		
		if(interface == 'gpio'):
			self.obj.append(0)
			self.pumpNumber.append(pump)
			if(active == 'high'):
				GPIO.setup(pin, GPIO.OUT, initial=GPIO.LOW)
			else:
				GPIO.setup(pin, GPIO.OUT, initial=GPIO.HIGH)
		elif(interface == 'i2c'):
			if(Type == 'pump'):
				self.obj.append(MotorDriver(addr, FREQUENCY))
				p = [pump, Dir[1]]
				self.pumpNumber.append(p)
		
	
	def add_trigger(self, SensorID, OutputID, MIN, MAX):
		x = self.id.index(OutputID)
		self.belongsTo[x] = SensorID
		self.minTrigger[x] = float(MIN)
		self.maxTrigger[x] = float(MAX)
		self.TriggerSet[x] = True
	
	
	def remove_trigger(self, ID):
		x = self.id.index(OutputID)
		self.belongsTo[x] = 0
		self.minTrigger[x] = 0.0
		self.maxTrigger[x] = 0.0
		self.TriggerSet[x] = False

	
	def activate_output(self, ID):
		x = self.id.index(ID)
		if(self.interface[x] == 'gpio'):
			if(self.active[x] == 'high'):
				GPIO.output(self.pins[x], GPIO.HIGH)
			else:
				GPIO.output(self.pins[x], GPIO.LOW)
			self.outActivated[x] = True
			print('gpio activated')
		elif(self.interface[x] == 'i2c'):
			if(self.type[x] == 'pump'):
				pump = self.pumpNumber[x]
				number = pump[0]
				direction = pump[1]
				self.obj[x].run(number, direction, speed)
				self.outActivated[x] = True
				self.pumpTimings[x] = time.time()
				print('pump activated')
	
	
	def deactivate_output(self, ID):
		x = self.id.index(ID)
		if(self.interface[x] == 'gpio'):
			if(self.active[x] == 'high'):
				GPIO.output(self.pins[x], GPIO.LOW)
			else:
				GPIO.output(self.pins[x], GPIO.HIGH)
			self.outActivated[x] = False
			print('gpio close')
		elif(self.interface[x] == 'i2c'):
			if(self.type[x] == 'pump'):
				self.obj[x].stop(self.pumpNumber[x][0])
				self.outActivated[x] = False
				print('pump close')
	
	
	def run(self):
		db = sqlite3.connect('/home/pi/Hydroponics.db', timeout=10)
		while True:
			if(self.stop):
				break
			for x in range(self.count):
				if(self.TriggerSet[x]):
					v = db.execute("SELECT vals FROM SensorsValues where ids = ?", (self.belongsTo[x],)).fetchone()[0]
					v = v.split(",")
					value = float(v[0])
					if(self.interface[x] == 'gpio'):
						if(value < self.maxTrigger[x] and value > self.minTrigger[x] and self.outActivated[x]):
							self.deactivate_output(self.id[x])
						elif((value > self.maxTrigger[x] or value < self.minTrigger[x]) and (self.outActivated[x] == False)):
							self.activate_output(self.id[x])
							
					elif(self.interface[x] == 'i2c'):
						if(self.outActivated[x]):
							if(time.time() - self.pumpTimings[x] >= 5):
								self.deactivate_output(self.id[x])
						elif(value > self.maxTrigger[x] and (self.outActivated[x] == False)):
							self.pumpNumber[x][1] = Dir[0]
							self.activate_output(self.id[x])
						elif(value < self.minTrigger[x] and (self.outActivated[x] == False)):
							self.pumpNumber[x][1] = Dir[1]
							self.activate_output(self.id[x])
			sleep(3)
	
	def loop(self):
		self.stop = False
		self.MyThread = Thread(target=self.run, daemon=True)
		self.MyThread.start()
	
	
	def stop(self):
		self.stop = True
		self.MyThread.join()
	
	
	def get_sensor_info(self, ID):
		x = self.id.index(ID)
		return self.info[x]
	
