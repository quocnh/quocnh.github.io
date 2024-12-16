---
layout: page
title: Automated Defect Inspection System with Robotic Arm and Deep Learning
description: Developed an automated defect inspection system using a robotic arm, computer vision, and deep learning to efficiently detect and classify product defects on a conveyor belt.
img: assert/img/project2.png
importance: 3
category: work
---

# Automated Defect Inspection System with Robotic Arm and Deep Learning
Github: https://github.com/quocnh/Automated-Defect-Inspection-System-Using-Robotic-Arm-and-DeepLearning/blob/master/Publication.md

# Video link:
1. https://drive.google.com/file/d/1KCF31cqWTbForki-6d7YNfTgb_rOv_WZ/view?usp=sharing
2. https://drive.google.com/file/d/1sIMJ3BOCjd-B2ghHndZeDxoD2xsCqL9v/view?usp=sharing

## Requirements:
- Raspberry Pi 3 Model B+
- Adafruit 16 Channel Servo Driver PWM PCA9685
- Servos MG996R


## Connect Raspberry Pi with PCA9685
![viewer](assert/pi_pca.png)

## Servos Configuration

    # Set frequency to 60Hz, good for l298n h-bridge.
    PCA9685_pwm.set_pwm_freq(60)
    
    # Configure min and max servo pulse lengths
    servo_min = 150  # Min pulse length out of 4096
    servo_max = 600  # Max pulse length out of 4096
    
## System Overview
![viewer](assert/system_overview.png)

## Steps 

    1. Run Roscoe in pc
    2. Run Ros controller in Pi 
        source ~/pca_ws/devel/setup.bash
        export ROS_MASTER_URI=“http://mypc:11311”
        rosrun ros_pca9685 controller_sub
    3. Run action_server
        source ~/ws_arm/devel/setup.bash
        python src/arm_controller/scripts/action_server.py
    4. Run i2c_joint
        source ~/ws_arm/devel/setup.bash
        python src/arm_controller/scripts/i2c_joint.py
    5. Run i2c_birdge 
       source ~/ws_arm/devel/setup.bash
       python src/arm_controller/scripts/i2c_bridge.py
    6. Run Moveit 
        cd ws_arm source ~/ws_arm/devel/setup.bash
        roslaunch arm_moveit demo.launch
        roslaunch arm_moveit setup.assistant.launch
    7. Run rqt 
    8. Run camera in pi 
        source /opt/ros/kinetic/setup.bash
        export ROS_MASTER_URI=http://mypc:11311
        cd ~/ws_cam/src/raspicam_node
        roslaunch raspicam_node camera_module_v2_640x480_30fps.launch
        rosservice call /raspicam_node/start_capture
        rosrun rqt_image_view rqt_image_view
        to config camera:
        rosrun rqt_reconfigure rqt_reconfigure 
    9. Run pi camera server on pi
        python ws_cam/src/pi_camera_server/picamera_server.py
    10. Run motion_plaining
        source ~/ws_arm/devel/setup.bash
        python src/arm_controller/scripts/motion_plaining.py
    11. 


### Create a bash script to run may python files
    1. Create a demo.sh
    2. Pussh “#!bin/básh” at the first line
    3. Run chmod +x demo.sh
    4. ./demo.sh to run


    



 

