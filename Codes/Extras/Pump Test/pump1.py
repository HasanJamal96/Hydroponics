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
    motor.run(1, 'clockwise', 100)
    sleep(5)
    motor.run(1, 'clockwise', 1)
    sleep(5)
    motor.run(1, 'clockwise', 50)
    sleep(5)
    motor.stop(1)


main()
