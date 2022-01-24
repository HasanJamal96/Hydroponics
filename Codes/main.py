#Extra Modules
import os, sys, json
from time import sleep
from threading import Thread
from os.path import exists


# Sensor Modules
from Sensor_PH import PH
from Sensor_DO import DO
from Sensor_CO2 import CO2
from Sensor_FLOW import FLOW
from Sensor_DHT import DHT
from Sensor_EC import EC
from Sensor_TSL import TSL
from Sensor_DS18B20 import DS
from WebComunication import API
from Camera import CameraModule


# web globals
POST_API = "https://ebmacshost.com/Hydroponics/index.php/api/postsensorvalue"
GET_API = "https://ebmacshost.com/Hydroponics/api/readSesnorName"
INTERRUPTED_SENSOR_API = "https://ebmacshost.com/Hydroponics/api/readintruptedSesnorName"

headers = {'User-Agent': ''}

# creating objects of sensors, output, web and camera

web = API(headers)
cam = CameraModule()
ec = EC(POST_API, headers)
ph = PH(POST_API, headers)
do = DO(POST_API, headers)
ds = DS(POST_API, headers)
co2 = CO2(POST_API, headers)

tsl = TSL(POST_API, headers)
dht = DHT(POST_API, headers)
flow = FLOW(POST_API, headers)

AtlasObjs = {'EZO-PH': ph,
			'EZO-EC': ec,
			'EZO-DO': do,
			'EZO-CO2': co2
			}


# global veriables

new = 1
First = True
configUpdate = False


# update configuration from web

FileName = "configuration/configuration.json"
BackupFileName = "configuration/Backup_configuration.json"

FilePath = os.path.join(sys.path[0], FileName)
BackupFilePath = os.path.join(sys.path[0], BackupFileName)


servre_response = web.send(GET_API, "")
if(servre_response.status_code == 200):
    payload = json.loads(servre_response.text)
    with open(BackupFilePath, 'w', encoding='utf-8') as conf_file:
        json.dump(payload, conf_file, ensure_ascii=False, indent=4)
    configUpdate = True
    print('configuration updated')

# reading configuration first time
file_exists = exists(BackupFilePath)
if(not file_exists):
    with open(BackupFilePath, 'w', encoding='utf-8') as conf_file:
        json.dump({}, conf_file, ensure_ascii=False, indent=4)


with open(BackupFilePath, "r") as conf_file:
	config = json.load(conf_file)



# adding sensors from configuration
Sensors = config['sensor']
SensorsCount = len(Sensors)
for x in range(SensorsCount):
	SensorName = Sensors[x]["name"]
	triggers = json.loads(Sensors[x]["trigger"])
	if(SensorName == 'EZO-EC' or SensorName == 'EZO-DO' or SensorName == 'EZO-PH' or SensorName == 'EZO-CO2'):
		triggers = triggers[0]
		AtlasObjs[SensorName].addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
		AtlasObjs[SensorName].activate_deactivate(int(Sensors[x]['sensor_id']), True)
		outs = Sensors[x]["output"]
		if(outs != "" and outs != None):
			AtlasObjs[SensorName].assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
	elif(SensorName == 'DS18B20'):
		triggers = triggers[0]
		ds.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
		ds.activate_deactivate(int(Sensors[x]['sensor_id']), True)
		outs = Sensors[x]["output"]
		if(outs != "" and outs != None):
			ds.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
	elif(SensorName == 'TSL2591'):
		triggers = triggers[0]
		tsl.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
		tsl.activate_deactivate(int(Sensors[x]['sensor_id']), True)
		outs = Sensors[x]["output"]
		if(outs != "" and outs != None):
			tsl.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
	elif(SensorName == 'DHT'):
		temp = triggers[0]
		humi = triggers[1]
		dew = triggers[2]
		dht.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), 'DHT22',  int(Sensors[x]['sensor_id']), float(temp['max-val']), float(temp['min-value']), float(humi['max-val']), float(humi['min-value']), float(dew['max-val']), float(dew['min-value']))
		dht.activate_deactivate(int(Sensors[x]['sensor_id']), True)
		outs = Sensors[x]["output"]
		if(outs != "" and outs != None):
			tsl.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
	elif(SensorName == 'FLOW'):
		triggers = triggers[0]
		flow.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
		outs = Sensors[x]["output"]
		if(outs != "" and outs != None):
			flow.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
	


def updateCamera(payload):
	global First
	count = len(payload)
	if(count < 1):
		return
	for x in range(count):
		if(payload[x]["cam_name"] == "RPi Camera"):
			if(payload[x]['intrupt_by_admin'] == '1' or First):
				camState = cam.GetCameraState()
				if(payload[x]['status'] == '1' and camState == False):
					res = payload[x]['livecamresolation'].split('x')
					cam.UpdateCameraParams(int(res[0]), int(res[1]))
					cam.StartCamera()
				elif(payload[x]['status'] == '0' and camState):
					cam.StopCamera()
				camState = cam.GetCameraState()
				if(camState):
					if(payload[x]['mode'] == 'stop'):
						cam.StopTimelapse()
						cam.StopStream()
					elif(payload[x]['mode'] == 'start'):
						cam.UpdateTimelapseParams('hour', 120)#int(payload['picperhour'])
						cam.UpdateStreamParams(int(payload[x]['livecamfps']), 1000, int(payload[x]['rotation']), payload[x]['livecamkey'])
						cam.StartTimelapse()
						cam.StartStream()
				First = False



def addSensor(Sensors):
	count = len(Sensors)
	if(count < 1):
		return
	for x in range(count):
		name = Sensors[x]['name']
		triggers = json.loads(Sensors[x]["trigger"])
		if(name == 'DS18B20'):
			ds.pause_unpause_sensors(True)
			ds.delete_sensor(int(Sensors[x]['sensor_id']))
			triggers = triggers[0]
			ds.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
			ds.activate_deactivate(int(Sensors[x]['sensor_id']), True)
			outs = Sensors[x]["output"]
			if(outs != "" and outs != None):
				ds.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
			ds.pause_unpause_sensors(False)
		elif(name == 'EZO-EC' or name == 'EZO-DO' or name == 'EZO-PH' or name == 'EZO-CO2'):
			AtlasObjs[name].pause_unpause_sensors(True)
			AtlasObjs[name].delete_sensor(int(Sensors[x]['sensor_id']))
			triggers = triggers[0]
			AtlasObjs[name].addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
			AtlasObjs[name].activate_deactivate(int(Sensors[x]['sensor_id']), True)
			outs = Sensors[x]["output"]
			if(outs != "" and outs != None):
				AtlasObjs[name].assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
			AtlasObjs[name].pause_unpause_sensors(False)
		elif(name == 'TSL2591'):
			tsl.pause_unpause_sensors(True)
			tsl.delete_sensor(int(Sensors[x]['sensor_id']))
			triggers = triggers[0]
			tsl.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
			tsl.activate_deactivate(int(Sensors[x]['sensor_id']), True)
			outs = Sensors[x]["output"]
			if(outs != "" and outs != None):
				tsl.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
			tsl.pause_unpause_sensors(False)
		elif(name == 'DHT'):
			dht.pause_unpause_sensors(True)
			dht.delete_sensor(int(Sensors[x]['sensor_id']))
			triggers = triggers
			dht.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), 'DHT22', int(Sensors[x]['sensor_id']), float(triggers[0]['max-val']), float(triggers[0]['min-value']), float(triggers[1]['max-val']), float(triggers[1]['min-value']), float(triggers[2]['max-val']), float(triggers[2]['min-value']))
			dht.activate_deactivate(int(Sensors[x]['sensor_id']), True)
			outs = Sensors[x]["output"]
			if(outs != "" and outs != None):
				dht.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
			dht.pause_unpause_sensors(False)
		elif(name == 'FLOW'):
			flow.pause_unpause_sensors(True)
			flow.delete_sensor(int(Sensors[x]['sensor_id']))
			triggers = triggers[0]
			flow.addSensor(Sensors[x]['name'], int(Sensors[x]['interface_description']), int(Sensors[x]['sensor_id']), float(triggers['max-val']), float(triggers['min-value']))
			flow.activate_deactivate(int(Sensors[x]['sensor_id']), True)
			outs = Sensors[x]["output"]
			if(outs != "" and outs != None):
				flow.assosiate_output(int(Sensors[x]['sensor_id']), int(outs['output_id']), outs['type'], outs['interface'], int(outs['pin']), outs['other_dispcription'])
			flow.pause_unpause_sensors(False)


def deletesensor(payload):
	count = len(payload)
	if(count < 1):
		return
	with open(BackupFilePath, "r") as conf_file:
		config = json.load(conf_file)
	Sensors = config['sensor']
	SensorsCount = len(Sensors)
	for x in range(count):
		Delete = False
		sensor_name = payload[x]['sensor_name']
		sensor_id = int(payload[x]['sensor_id'])
		if(sensor_name == 'DS18B20'):
			ds.pause_unpause_sensors(True)
			ds.delete_sensor(sensor_id)
			ds.pause_unpause_sensors(False)
			Delete = True
		elif(sensor_name == 'EZO-EC' or sensor_name == 'EZO-DO' or sensor_name == 'EZO-PH' or sensor_name == 'EZO-CO2'):
			AtlasObjs[sensor_name].pause_unpause_sensors(True)
			AtlasObjs[sensor_name].delete_sensor(sensor_id)
			AtlasObjs[sensor_name].pause_unpause_sensors(False)
			Delete = True
		elif(sensor_name == 'DHT'):
			dht.pause_unpause_sensors(True)
			dht.delete_sensor(sensor_id)
			dht.pause_unpause_sensors(False)
			Delete = True
		elif(sensor_name == 'TSL2591'):
			tsl.pause_unpause_sensors(True)
			tsl.delete_sensor(sensor_id)
			tsl.pause_unpause_sensors(False)
			Delete = True
		elif(sensor_name == 'FLOW'):
			flow.pause_unpause_sensors(True)
			flow.delete_sensor(sensor_id)
			flow.pause_unpause_sensors(False)
			Delete = True
		
		
		if(Delete):
			for x in range(SensorsCount):
				SensorID = int(Sensors[x]["sensor_id"])
				if(SensorID == sensor_id):
					del Sensors[x]
	
	
	config['sensor'] = Sensors
	with open(BackupFilePath, 'w', encoding='utf-8') as conf_file:
		json.dump(config, conf_file, ensure_ascii=False, indent=4)



def checkWebInterrupts():
	servre_response = web.get(INTERRUPTED_SENSOR_API)
	if(servre_response.status_code == 200):
		payload = json.loads(servre_response.text)
		Deleted_Sensors = payload['delete_sesnor']
		Sensors_list = payload['sensor']
		Camera = payload['camsensor']
		
		Cam_Thread = Thread(target=updateCamera, args=(Camera,), daemon=True)
		Add_Sensor_Thread = Thread(target=addSensor, args=(Sensors_list,), daemon=True)
		Del_Sensor_Thread = Thread(target=deletesensor, args=(Deleted_Sensors,), daemon=True)
		
		
		Cam_Thread.start()
		Add_Sensor_Thread.start()
		Del_Sensor_Thread.start()



AtlasObjs['EZO-EC'].run()
AtlasObjs['EZO-PH'].run()
AtlasObjs['EZO-DO'].run()
AtlasObjs['EZO-CO2'].run()
tsl.run()
dht.run()
ds.run()
flow.run()
cam.run()
ds.run()
if __name__ == '__main__':
	while True:
		pass
		checkWebInterrupts()
		sleep(5)
		
