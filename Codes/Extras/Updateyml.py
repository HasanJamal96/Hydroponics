import json, yaml

SensorsList = []
SensorsCount = {"INPUTS":"",
				"OUTPUTS":"",
				"TRIGGERS":""}

My_data = dict()

def update(sensors, outputs, triggers, CONFIG_FILE):
	sensors_count = len(sensors)
	outputs_count = len(outputs)
	triggers_count = len(triggers)
	
	for x in range(sensors_count):
		sensor_name = sensor["name"]
		sensor_id = sensor["sensor_id"]
		defaults = sensor["default_value"]
		interface = sensor["interface"]
		defaults_count = len(defaults)
		if(sensor_name in SensorsList):
			count = SensorsCount[sensor_name] = SensorsCount[sensor_name] + 1
		else:
			SensorsList.append(sensor_name)
			count = SensorsCount[sensor_name] = 1
			My_data[sensor_name] = {}
			
		data = {"Sensor" + str(count): {}}
		data["Sensor" + str(count)]['ID'] = int(ID)
		data["Sensor" + str(count)]['interface'] = interface
		if(interface == 'i2c'):
			data["Sensor" + str(count)]['Addr'] = int(address)
		elif(interface == 'gpio'):
			data["Sensor" + str(count)]['Pin'] = int(pin)
		
		for d in range(defaults_count):
			label = defaults[d]["label"]
			mini = defaults[d]["max"]
			maxi = defaults[d]["min"]
	
	
	
	for i in range(len(payload)):
		sensor = payload[i]
		name = sensor["name"]
		ID = sensor["sensor_id"]
		vals = sensor["default_value"]
		vals = json.loads(vals)
		data = {}
		if(name in SensorsList):
			SensorsCount[name] = SensorsCount[name] + 1
			count = SensorsCount[name]
		else:
			SensorsList.append(name)
			count = SensorsCount[name] = 1
			My_data[name] = {}
		
		data = {"Sensor" + str(count): {}}
		data["Sensor" + str(count)]["Name"] = name		
		if(name == 'DHT'):
			data["Sensor" + str(count)]['ID'] = int(ID)
			data["Sensor" + str(count)]['Temp_min'] = float(vals[0]["min-value"])
			data["Sensor" + str(count)]['Temp_max'] = float(vals[0]["max-val"])
			data["Sensor" + str(count)]['Humi_min'] = float(vals[1]["min-value"])
			data["Sensor" + str(count)]['Humi_max'] = float(vals[1]["max-val"])
			data["Sensor" + str(count)]['Pin'] = 17
			data["Sensor" + str(count)]['Type'] = 'DHT22'
		elif(name == 'EZO-PH' or name == 'EZO-EC' or name == 'EZO-DO' or name == 'EZO-CO2' or name == 'TSL2591'):
			data["Sensor" + str(count)]['ID'] = int(ID)
			data["Sensor" + str(count)]['Temp_min'] = float(["min-value"])
			data["Sensor" + str(count)]['Temp_max'] = float(["max-val"])
			data["Sensor" + str(count)]['Addr'] = int(["addr"])
			data["Sensor" + str(count)]['Type'] = 'i2c'
			
		
		if(count > 1):
			old = My_data[name]
			My_data[name] = {**old, **data}
		else:
			My_data[name] = data
		
		
		
		'''if(name in SensorsList):
			ID = sensor["sensor_id"]
			vals = sensor["default_value"]
			vals = json.loads(vals)
			SensorsCount[name] = str(SensorsCount[name] + 1)
			count = str(SensorsCount[name])
			if(name == 'DHT'):
				temp_min1 = vals[0]["min-value"]
				temp_max1 = vals[0]["max-val"]
				humi_min1 = vals[1]["min-value"]
				humi_max1 = vals[1]["max-val"]
				config.set(name, 'temp_min' + count, str(temp_min1))
				config.set(name, 'temp_max' + count, str(temp_max1))
				config.set(name, 'humi_min' + count, str(humi_min1))
				config.set(name, 'humi_max' + count, str(humi_max1))
			else:
				mini = vals[0]["min-value"]
				maxi = vals[0]["max-val"]
				config.set(name, 'min' + count, str(mini))
				config.set(name, 'max' + count, str(maxi))
			
			config.set(name, 'id' + count, ID)
			config.set(name, 'count', count)
			config.set(name, 'enable' + count, str(True))
			try:
				config.getint(name, 'interval')
			except:
				config.set(name, 'interval', '5')'''

	
	with open('New_Configuration.yml', 'w') as configfile:
		yaml.dump(My_data, configfile, default_flow_style=False)
	'''new = os.path.join(sys.path[0], 'New_Configuration.ini')
	shutil.copyfile(new, CONFIG_FILE)'''
	print("Configuration updated")
