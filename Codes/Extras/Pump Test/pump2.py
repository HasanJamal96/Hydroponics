from time import sleep
from driver import MotorDriver

DRIVER_ADDR = 0x40
FREQUENCY = 1000
Dir = [
    'anticlockwise',
    'clockwise',
]
motor = MotorDriver(DRIVER_ADDR, FREQUENCY)
def main():
    speed = 100
    motor.run(1, 'clockwise', speed)
    sleep(3)
    motor.stop(1)


main()
