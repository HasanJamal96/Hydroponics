import subprocess, cv2, os
from time import time, sleep
from subprocess import STDOUT
from threading import Thread
from WebComunication import API
import base64

POST_TIMELAPSE_API = ""

headers = {'User-Agent': ''}

web = API(headers)

DEVNULL = open(os.devnull, 'wb')

class CameraModule():
	def __init__(self):
		self.CameraStatus = False
		self.cap = ''
		self.StreamProc = ''
		self.Stream = False
		self.TimeLapse = False
		self.StreamWidth = 640
		self.StreamHeight = 480
		self.FrameRate = 30
		self.VideoBitrate = 1000 # in kbits/s
		self.Key = ''
		self.stopping = True
		self.streamThread = ''
		self.rotate = 0
		self.perDay = False
		self.perHour = False
		self.frequency = 1
		self.LastGet = 0
		self.difference = 0
		self.dir = ''
		print('Camera initialized')
		
	
	def UpdateCameraParams(self, width, height):
		if(not self.CameraStatus):
			self.StreamWidth = width
			self.StreamHeight = height
			print('Camera params set')


	def UpdateStreamParams(self, fps, bitrate, rotate, key):
		if(self.CameraStatus):
			self.FrameRate = fps
			self.VideoBitrate = bitrate # in kbits/s
			self.Key = key
			self.rotate = rotate
			print('Stream params set')
			
	
	def UpdateTimelapseParams(self, per, frequency):
		if(per == 'day'):
			self.perDay = True
			self.perHour = False
			self.difference = (24*60*60)/frequency
		elif(per == 'hour'):
			self.perDay = False
			self.perHour = True
			self.difference  = (60*60)/frequency
		else:
			self.perDay = True
			self.perHour = False
			self.difference  = (24*60*60)/frequency
			
		self.frequency = frequency
		print('Timelapse params set')
	
	
	def StartCamera(self):
		if(self.CameraStatus == False):
			self.cap = cv2.VideoCapture(0)
			self.cap.set(cv2.CAP_PROP_FRAME_WIDTH, self.StreamWidth)
			self.cap.set(cv2.CAP_PROP_FRAME_HEIGHT, self.StreamHeight)
			self.CameraStatus = True
			print('Camera started')
	
	
	def StopCamera(self):
		if(self.CameraStatus):
			self.cap.release()
			self.CameraStatus = False
			print('Camera stopped')
			
	
	
	def StartTimelapse(self):
		if(self.CameraStatus):
			self.TimeLapse = True
			print('timelapse activated')
	
	
	def StopTimelapse(self):
		if(self.TimeLapse):
			self.TimeLapse = False
			print("Timelapse deactivated")


	def StartStream(self):
		if(self.Key == ''):
			print('Stream key is not configured')
			return
		if(self.CameraStatus):
			if(self.rotate == 0):
				rotate = 'transpose=0,transpose=1'
			elif(self.rotate == 90):
				rotate = 'transpose=1'
			elif(self.rotate == 180):
				rotate = 'transpose=1,transpose=1'
			elif(self.rotate == 270):
				rotate = 'transpose=1,transpose=1,transpose=1'
			else:
				rotate = 'transpose=0,transpose=1'
			YoutubeCommand = ['ffmpeg',
			'-f', 'rawvideo',
			'-pix_fmt', 'bgr24',
			'-s',str(self.StreamWidth) + 'x' + str(self.StreamHeight),
			'-i','-',
			'-ar', '44100',
			'-ac', '2',
			'-acodec', 'pcm_s16le',
			'-f', 's16le',
			'-ac', '2',
			'-i','/dev/zero', 
			'-vf', rotate,  
			'-acodec','aac',
			'-ab','128k',
			'-strict','experimental',
			'-vcodec','h264',
			'-pix_fmt','yuv420p',
			'-g', '50',
			'-vb', str(self.VideoBitrate) + 'k',
			'-profile:v', 'baseline',
			'-preset', 'ultrafast',
			'-r', str(self.FrameRate),
			'-f', 'flv', 
			'rtmp://a.rtmp.youtube.com/live2/' + self.Key]
			self.StreamProc = subprocess.Popen(YoutubeCommand, stdin=subprocess.PIPE, stdout=DEVNULL, stderr=STDOUT)
			self.Stream = True
			print('Stream started')
    
    
	def StopStream(self):
		if(self.Stream):
			self.Stream = False
			sleep(1)
			self.StreamProc.kill()
			print('Stream stopped')
    
    
	def GetFrame(self):
		if(self.CameraStatus):
			_, frame = self.cap.read()
			return frame
		
		else:
			return None
	
	
	def SendFrame(self, frame):
		retval, buffer = cv2.imencode('.jpg', frame)
		jpg_as_text = base64.b64encode(buffer).decode("utf-8")
		image = {"cam_id":"5","image": ""}
		image["image"] = jpg_as_text
		res = web.send(POST_TIMELAPSE_API, image)
		if(res.status_code == 200):
			print('Frame sent')
		else:
			print('Failed to send frame')
	
	
	def loop(self):
		self.stopping = False
		while True:
			if(self.stopping):
				self.StopStream()
				self.StopCamera()
				break
			if(self.CameraStatus):
				frame = self.GetFrame()
				if(self.Stream):
					self.StreamProc.stdin.write(frame.tostring())
				if(self.TimeLapse):
					CurrentTime = int(time())
					if(CurrentTime - self.LastGet >= self.difference):
						Thread(target=self.SendFrame, args=(frame,), daemon=True).start()
						self.LastGet = CurrentTime
			
		print('Camera deleted run loop again if you need camera')
	
		
	def run(self):
		self.streamThread = Thread(target=self.loop, daemon=True)
		self.streamThread.start()


	def GetCameraState(self):
		return self.CameraStatus
	
	
	def GetStreamState(self):
		return self.Stream
	
	
	def GetTimelapseState(self):
		return self.TimeLapse
		

	def stop(self):
		self.stopping = True
		if(self.Stream):
			self.streamThread.join()
		print('Stopping Camera All')
