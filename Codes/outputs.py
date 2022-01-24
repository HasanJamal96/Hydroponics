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


class OUTPUT:
	def __init__(self):
		self.count = 0
		self.id = []
		self.obj = []

	
	def add_ouput(self, SensorID, Type, interface, pin_addr, extra=None):
		self.count += 1
		self.id.append(SensorID)
		if(interface == 'Gpio'):
			self.obj.append(0)
			if(extra == 'high'):
				GPIO.setup(int(pin_addr), GPIO.OUT, initial=GPIO.LOW)
			else:
				GPIO.setup(int(pin_addr), GPIO.OUT, initial=GPIO.HIGH)
		elif(interface == 'I2c'):
			if(Type == 'pump'):
				self.obj.append(MotorDriver(int(pin_addr), FREQUENCY))
				
	
	def delete_output(self, ID):
		x = self.id.index(ID)
		self.count -= 1
		del self.id[x]
		del self.obj[x]

	
	def activate_output(self, ID, data):
		x = self.id.index(ID)
		Type = data[1]
		interface = data[2]
		extra = data[3]
		pin_addr = int(data[4])
		if(interface == 'Gpio'):
			if(extra == 'high'):
				GPIO.output(pin_addr, GPIO.HIGH)
			else:
				GPIO.output(pin_addr, GPIO.LOW)
			print('gpio activated')
		elif(interface == 'I2c'):
			if(Type == 'pump'):
				self.obj[x].run(int(extra), Dir[1], speed)
				print('pump activated')
	
	
	def deactivate_output(self, ID, data):
		x = self.id.index(ID)
		Type = data[1]
		interface = data[2]
		extra = data[3]
		pin_addr = int(data[4])
		if(interface == 'Gpio'):
			if(extra == 'high'):
				GPIO.output(pin_addr, GPIO.LOW)
			else:
				GPIO.output(pin_addr, GPIO.HIGH)
			print('gpio close')
		elif(interface == 'I2c'):
			if(Type == 'pump'):
				self.obj[x].stop(int(extra))
				print('pump close')
	
