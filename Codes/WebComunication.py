import requests

class API:
	def __init__(self, headers):
		self.headers = headers
	
	
	def send(self,api,data):
		response = requests.post(api, data=data, headers=self.headers)
		return response
	
	def get(self,api):
		response = requests.get(api, headers=self.headers)
		return response
