from PCA9685 import PCA9685

SENSOR_INFO = {
    "name":"driver",
    "measurements_name":"motor driver",
    "interface":"i2c",
    "url_purchase":["https://www.amazon.com/Raspberry-Onboard-PCA9685-TB6612FNG-Interface/dp/B07K7NP7C9/ref=sr_1_3?dchild=1&keywords=rpi+motor+driver+hat&qid=1629113649&sr=8-3"],
    "url_datasheet":["https://www.waveshare.com/w/upload/8/81/Motor_Driver_HAT_User_Manual_EN.pdf"],
    "address":"",
    "frequency":"",
    "type":"PCA9685/TB6612FNG"
}

Dir = [
    'anticlockwise',
    'clockwise',
]

class MotorDriver:
    def __init__(self, addr, freq):#frequency range 40Hz to 1000Hz
        self.PWMA = 0
        self.AIN1 = 1
        self.AIN2 = 2
        self.PWMB = 5
        self.BIN1 = 3
        self.BIN2 = 4
        self.pwm = PCA9685(addr, debug=False)
        self.pwm.setPWMFreq(freq)
        SENSOR_INFO["address"] = str(addr)
        SENSOR_INFO["frequency"] = str(freq)
        self.info = SENSOR_INFO

    def run(self, motor, index, speed):
        if speed > 100:
            return
        if(motor == 0):
            self.pwm.setDutycycle(self.PWMA, speed)
            if(index == Dir[0]):
                self.pwm.setLevel(self.AIN1, 0)
                self.pwm.setLevel(self.AIN2, 1)
            else:
                self.pwm.setLevel(self.AIN1, 1)
                self.pwm.setLevel(self.AIN2, 0)
        else:
            self.pwm.setDutycycle(self.PWMB, speed)
            if(index == Dir[0]):
                self.pwm.setLevel(self.BIN1, 0)
                self.pwm.setLevel(self.BIN2, 1)
            else:
                self.pwm.setLevel(self.BIN1, 1)
                self.pwm.setLevel(self.BIN2, 0)

    def stop(self, motor):
        if (motor == 0):
            self.pwm.setDutycycle(self.PWMA, 0)
        else:
            self.pwm.setDutycycle(self.PWMB, 0)
    
    def get_sensor_info():
        return self.info
