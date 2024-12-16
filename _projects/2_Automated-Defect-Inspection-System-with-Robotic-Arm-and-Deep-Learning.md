---
layout: page
title: Automated Defect Inspection System with Robotic Arm and Deep Learning
description: Developed an automated defect inspection system using a robotic arm, computer vision, and deep learning to efficiently detect and classify product defects on a conveyor belt.
img: assert/overall_system.png
importance: 3
category: work
---

# Robot Arm in product inspection with ROS and Deep Learning.
This is a brief note about the way we built a simple Robot Arm and
Deep Leanring approach in order to make a model to predict defects in product inspection. 
# Video link:
1. https://drive.google.com/file/d/1KCF31cqWTbForki-6d7YNfTgb_rOv_WZ/view?usp=sharing
2. https://drive.google.com/file/d/1sIMJ3BOCjd-B2ghHndZeDxoD2xsCqL9v/view?usp=sharing
3. Github Source: https://github.com/quocnh/RobotArm/tree/master
   
## Table of Contents

* [1. Introduction](#)
* [2. System Overview](#1.-system-overview)
* [3. Controlling the Robot Arm by ROS](#)
    * [3.1 ROS](#)
    * [3.2 Design the Arm](#)
        * [Generalized Coordinates](#)
        * [Degrees of Freedom](#)
        * [Robot Kinematics](#)
        * [Forward Kinematics](#)
            * [Calculating Homodeneous Transformation Matrix](#)
        * [Invert Kinematics](#)
        * [Visualizing the Arm in Rviz](#)
            * [URDF](#)
        * [Motion plaining with MoveIt](#)
    * [3.3 Communication between of the Arm and Raspberry Pi by ROS ](#)
* [4. Creating a Deep Learning Model](#)
    * [4.1 Preparing data](#)
    * [4.2 Training with RESNET-50](#)
* [5. Capturing Objects by Pi Camera](#)
    * [5.1 Connecting Pi Camera to the Arm](#)
    * [5.2 Making Pi Camera Server](#)
* [6. Implementation and Experimental Reslut ](#)
    * [6.1 Kinametic Implementation](#)
    * [6.2 The Robot Arm performance](#)
    * [6.3 Prediction Result](#)
* [7. Conclusion](#)
* [8. References](#)

## Abbreviations
* DOF       Degrees Of Freedom
* ROS       Robot Operating System
* ARC       Amazon Robotics Challenge
* ISS         International Space Station
* EVA        Extra Vehicular Activity
* EE          End-Effector
* WC         Wrist Center
* DH          Denavit–Hartenberg
* FK          Forward Kinematics
* IK           Inverse Kinematics
* RRR       Revolute Revolute Revolute
* URDF     Unified Robot Description Format

## 1. Introduction
This project explores the development of an automated inspection system designed to detect defects in products on a conveyor belt, replacing traditional manual inspection methods. In many factories, human operators manually inspect products and remove defective ones, which is labor-intensive and prone to inconsistency. By introducing a robotic arm combined with deep learning, this project demonstrates a system capable of efficiently identifying and handling defective products with high accuracy.

The proposed system integrates a robotic arm controlled via the Robot Operating System (ROS) and a deep learning model to detect even the smallest defects in products. This approach offers significant improvements in speed, reliability, and scalability compared to manual inspection. The project outlines the construction of the robotic arm, the implementation of ROS for motion planning, and the development of a deep learning model trained to identify defects with precision. Together, these components create a promising foundation for fully automated product inspection processe.

## 2. System Overview

<p align="center">
<img src="https://github.com/quocnh/RobotArm/blob/master/assert/overall_system.png" alt="" width="65%">
<br>
<sup><b>Fig1.0 &nbsp;&nbsp;&nbsp;Overall System</b></sup>
<br>
</p>

The Figure 1 shows the overall system of the process of product inspection, which including three main parts:
(1) Controlling the Robot Arm by ROS; (2) Capturing photos of product and (3) Deep Learning model. We will explain each part in detail bellow: 

## 3. Controlling the Robot Arm By ROS
### 3.1 Robot Operate System
ROS is an open-source, meta-operating system
for your robot. It provides the services you
would expect from an operating system, including hardware
abstraction, low-level device control, implementation of
commonly-used functionality, message-passing between
processes, and package management. It also provides
tools and libraries for obtaining, building, writing, and
running code across multiple computers. [6]


The ROS Wiki defines ROS as above. In other words, ROS includes hardware abstraction layer
similar to operating systems. However, unlike conventional operating systems, it can be used for
numerous combinations of hardware implementation. Furthermore, it is a robot software
platform that provides various development environments specialized for developing robot
application programs.

### 3.2 Design the Arm
The following theoretical concepts are used in this project:

- Generalized Coordinates and Degrees of Freedom
- Rotation matrices and composition of rotations
- Homogeneous transforms
- Denavit–Hartenberg parameters
- Forward and Inverse Kinematics

And the following tools are used for simulation and motion planning:

The project uses [ROS Kinetic Kame](http://wiki.ros.org/kinetic) running on [Ubuntu 16.04 LTS (Xenial Xerus)](http://releases.ubuntu.com/16.04/).

* [Gazebo](http://gazebosim.org/): a physics based 3D simulator extensively used in the robotics world
* [RViz](http://wiki.ros.org/rviz): a 3D visualizer for sensor data analysis, and robot state visualization
* [MoveIt!](http://moveit.ros.org/): a ROS based software framework for motion planning, kinematics and robot control

#### Generalized Coordinates
Generalized coordinates are parameters that are used to uniquely describe the instantaneous dynamical 
configuration of a [rigid](https://en.wikipedia.org/wiki/Rigid_body) [multi-body system](https://en.wikipedia.org/wiki/Multibody_system) 
relative to some reference configuration. In the robotics of serial manipulators, 
they are used to define the *configuration space* or *joint space*, which refers 
to the set of all possible configurations a manipulator may have.
#### Degrees of Freedom
The [degree of freedom (DOF)](https://en.wikipedia.org/wiki/Degrees_of_freedom_(mechanics)) of a
rigid body or mechanical system is the number of independent parameters or coordinates that
fully define its configuration in free space.

#### 3.2.1 Robot Kinematics
Robot kinematics applies geometry to the study of the movement of multi-degree of freedom kinematic
chains that form the structure of robotic systems. A fundamental tool in robot kinematics
is the kinematics equations of the kinematic chains that form the robot. These non-linear
equations are used to map the joint parameters to the configuration of the robot system.

"Robot Arm" = Joints + Links. Speciffically, Joints are parts that allow motion (in our case, Joints are 6 servos) and Links are parts that connect Joints together.

a. Kinematic Diagram
Diagram that shows how the links and joints are connected together, when all of the joints variables have a value of 0.
There are some crucial rules:
- Rule 1: The Z axis must be the axis of rotation for a revolute joint, ot the direction of motion for a prismatic joint. 
- Rule 2: The X axis must be perpendicular both to its own Z axis, and the Z axis of the frame before it.
- Rule 3: All frames must follow the right-hand rule.
- Rule 4: Each X axis must intersect the Z axis of the frame before it. 

* There are 6 DoFs but we only need 5 DoFs, follow 4 rules above we got the kinematic diagram:  

<img src="https://github.com/quocnh/RobotArm/blob/master/assert/kinematic_diagram1.jpeg" width="700" title="DH diagram">

#### Forward Kinematics
Forward kinematics specifies the joint parameters and computes the configuration of the chain, following these steps below:
##### Calculating Homodeneous Transformation Matrix
In detail, there are 2 methods to compute the HTM:
###### Method 1 (Basic): 
First, finding the rotation matrix and the displacement vector for each pair of subsequent frames and then assembling
those two components together into the homogeneous transformation matrix. 

* Calculating Rotation Matrices
<img src="https://github.com/quocnh/RobotArm/blob/master/assert/rotation_fomular.png" width="300" title="DH diagram">

* Calculating Displacement Vectors
<img src="https://github.com/quocnh/RobotArm/blob/master/assert/displacement_vector.png" width="300" title="DH diagram">

The displacement vetor only has one column and it has 3 rows. The first row tells us the x position of the n frame in the m frame. The 2nd row tells us the 
Y position and the 3rd row tells us the Z posiiton.

* Assembling Rotation matrices and Displacement Vectors into Homogeneous Transformation Matrix:

###### Method 2 (Denavit Hartenberg):

In mechanical engineering, the Denavit–Hartenberg parameters 
(also called DH parameters) are the four parameters associated with a particular
convention for attaching reference frames to the links of a spatial kinematic 
chain, or robot manipulator. It is a kind of industry standard that we'll frequently see
in robotics research papers and industry documentation.

This method is faster than the other way but it kind of obscures the meaning behind the rotation matrix
and the displacement vector. So it is important to fist do the basic method above and make sure we understand the meaning of each 
part of the homogeneous transformation before we srat taking the shorcut method to the end.

![viewer](https://github.com/quocnh/RobotArm/blob/master/assert/Classic-DHparameters.png.png)

The following 4 transformation parameters are known as D–H parameters:

* d - the distance between the previous x-axis and the current x-axis, along the previous z-axis.
* θ - the angle around the z-axis between the previous x-axis and current x-axis.
* a (or r) - the length of the common normal, which is the distance between the previous z-axis and the current z-axis.
* α - the angle around the common normal to between the previous z-axis and current z-axis.
 
- Step 1: Assign frames according to the 4 Denavit-Hartenberg rules.
- Step 2: Fill out the Denavit-Hartenberg parameter table. 
- Step 3: Get the Homogeneous transformation matrix

<img src="https://github.com/quocnh/RobotArm/blob/master/assert/DH_fomular.png" width="500" title="DH Fomular">
#### Invert Kinematics
Inverse kinematics specifies the end-effector location and computes the associated joint angles. 
The inverse kinematics problem of the serial manipulators has been studied
for many decades. It is needed in the control of manipulators. Solving the inverse
kinematics is computationally expansive and generally takes a very long
time in the real time control of manipulators. Tasks to be performed by a manipulator
are in the Cartesian space, whereas actuators work in joint space.
Cartesian space includes orientation matrix and position vector. However,
joint space is represented by joint angles. The conversion of the position and
orientation of a manipulator end-effector from Cartesian space to joint space is
called as inverse kinematics problem. 

The implementation of Forward and Invert Kinematic is shown in the colab file at the portion of 6.1 Kinematic Implementation.

#### Visualizing the Arm in Rviz
To simulate a Robot Arm model in virtual space, first we need to create a URDF for the Arm consisting
of joints and links.

URDF describes each component of the robot using XML tags. In the URDF format, first
describe the name of the robot, the name and type of the base (URDF assumes that the base is a
fixed link), and the description of the link connected to the base and then describe each joint
and link. A link describes the name, size, weight, inertia of the link. The joints describes the
name, type, and link connected to each joint. The dynamic parameters of the robot, visualization,
and the collision model can be easily set. The URDF is initiated by the <robot> tag, and in
general, it is common for the <link> tag and the <joint> tag to appear alternately to define links
and joints that are components of the robot. The <transmission> tag is also often included for
interfacing with the ROS-Control to establish the relationship between the joint and the actuator.
Let’s take a closer look at the robot.urdf we created.


Robot.urdf
```sh
<?xml version="1.0"?>
<robot name="myfirst">
  <material name="blue">
    <color rgba="0 0 0.8 1"/>
  </material>
  <link name="base_link">
    <visual>
      <origin
        xyz="0 0 0"
        rpy="0 0 0" />
      <geometry>
        <box size="0.6 0.1 0.02"/>
      </geometry>
    </visual>
  </link>

  <link name="link_0">
    <visual>
      <geometry>
        <cylinder length="0.1" radius="0.05"/>
      </geometry>
      <origin rpy="0 0 0.02" xyz="0 0 0.05"/>
    </visual>
  </link>


  <joint name="joint_1" type="revolute">
    <axis xyz="0 0 1"/>
    <limit effort="1000.0" lower="-1.0" upper="1.0" velocity="0.5"/>
    <parent link="base_link"/>
    <child link="link_0"/>
    <origin rpy="0 0 0" xyz="0 0 0.01"/>
  </joint>

  <link name="link_1">
    <visual>
      <geometry>
        <box size="0.2 0.1 0.02"/>
      </geometry>
      <origin rpy="0 1.57075 0" xyz="0 0 0.1"/>
    </visual>
  </link>

  <joint name="joint_2" type="revolute">
    <axis xyz="0 1 0"/>
    <limit effort="1000.0" lower="0.0" upper="1.0" velocity="0.5"/>
    <parent link="link_0"/>
    <child link="link_1"/>
    <origin rpy="0 0 0" xyz="0 0 0.1"/>
  </joint>

  <link name="link_2">
    <visual>
      <geometry>
        <box size="0.2 0.1 0.02"/>
      </geometry>
      <origin rpy="0 2.1075 0" xyz="0.05 0 0.08"/>
    </visual>
  </link>

  <joint name="joint_3" type="revolute">
    <axis xyz="0 1 0"/>
    <limit effort="1000.0" lower="0.0" upper="1.0" velocity="0.5"/>
    <parent link="link_1"/>
    <child link="link_2"/>
    <origin rpy="0 0 0" xyz="0 0 0.2"/>
  </joint>

  <link name="link_3">
    <visual>
      <geometry>
        <box size="0.1 0.1 0.02"/>
      </geometry>
      <origin rpy="0 3.1075 0" xyz="0.05 0 0"/>
    </visual>
  </link>

  <joint name="joint_4" type="revolute">
    <axis xyz="0 1 0"/>
    <limit effort="1000.0" lower="0.0" upper="1.0" velocity="0.5"/>
    <parent link="link_2"/>
    <child link="link_3"/>
    <origin rpy="0 0 0" xyz="0.11 0 0.16"/>
  </joint>

  <link name="wheel_gripper">
    <visual>
      <geometry>
        <cylinder length="0.02" radius="0.02"/>
      </geometry>
      <origin rpy="0 1.57075 0" xyz="0.01 0 0"/>
    </visual>
  </link>

  <joint name="joint_5" type="revolute">
    <axis xyz="1 0 0"/>
    <limit effort="1000.0" lower="0.0" upper="1.0" velocity="0.5"/>
    <parent link="link_3"/>
    <child link="wheel_gripper"/>
    <origin rpy="0 0 0" xyz="0.1 0 0"/>
  </joint>

  <link name="gripper">
    <visual>
      <geometry>
        <cylinder length="0.05" radius="0.01"/>
      </geometry>
      <origin rpy="0 1.57075 0" xyz="0.025 0 0"/>
      <material name="blue"/>
    </visual>
  </link>

  <joint name="wheel_gripper_to_gripper" type="fixed">
    <parent link="wheel_gripper"/>
    <child link="gripper"/>
    <origin rpy="0 0 0" xyz="0.02 0 0"/>
  </joint>


</robot>

```
After created a URDF for our robot model, next we display and interac with the robot model by using Rviz. 
RViz is the 3D visualization tool of ROS. It supports various visualization using user specified polygons, and Interactive Markers
allow users to perform interactive movements with commands and data received from the user
node. In addition, ROS describes robots in Unified Robot Description Format (URDF), which is
expressed as a 3D model for which each model can be moved or operated according to their
corresponding degree of freedom, so they can be used for simulation or control.

The robot model can be displayed and interacted as shown in Figure bellow.

<img src="https://github.com/quocnh/RobotArm/blob/master/assert/moveit.png" width="500" title="Moveit">


#### Motion plaining with MoveIt
The motion planning, which is also called as path planning, creates a trajectory from the current
pose to the target pose specified on the map. The created path plan includes the global path
planning in the whole map and the local path planning for smaller areas around the robot. We
plan to use the OMPL algorithm to optimize the trajactory of the Arm. OMPL can be install by Moveit Assistant Wizard, more information can found in the index page at http://ompl.kavrakilab.org/

### 3.3 Communication between of the Arm and Raspberry Pi by ROS
<img src="https://github.com/quocnh/RobotArm/blob/master/assert/rosgraph.png" width="500" title="ros_graph">

ROS is developed in unit of nodes, which is the minimum unit of executetable program that has broken down for the maximum reusability.
The node exchanges data with other nodes through messages forming a large program as a whole. The key concept here is the message communication methods among nodes.
There are three different methods of exchanging messages: a topic which prodives a unidirectional messafe transmission/reception,
a service which provides a bidirectional messafe request/response and an action which provides a bidirectional message goal/result/feedback. 
In addition, the parameters used in the node can be modified from the outside of node. This can also be considered as a type of
message communication in the larger context. Message communication is illustrated and the differences are summarized in the Figure and Table bellow . It is important to use each topic, service,
action, and parameter according to its correct purpose when programming on ROS.

<img src="https://github.com/quocnh/RobotArm/blob/master/assert/ros_communication.png" width="500" title="ros_graph">

<img src="https://github.com/quocnh/RobotArm/blob/master/assert/communication_table.png" width="500" title="ros_graph">

## 4. Creating a Deep Learning Model
### 4.1 Preparing data
To efficiently prepare the dataset, a custom C++ program was developed to extract frames from video recordings. This approach significantly reduced the time and effort required for object data collection, as it automated the process of capturing high-quality images of the inspected objects. Using computer vision techniques, the program ensured accurate frame extraction while maintaining image quality for subsequent processing.

The captured frames were then pre-processed and labeled to serve as input for a deep learning model. This streamlined workflow demonstrates expertise in C++ programming for high-performance tasks, the application of computer vision for automation, and the integration of deep learning to solve real-world challenges in defect detection.

Apple (an object) was planted in the shaft of a low speed motor (3 rpm) and a short movie of 20 seconds was recorded. Behind the fruits we placed a white
sheet of paper as background.However due to the variations in the lighting conditions, the background
was not uniform and we wrote a dedicated algorithm which extract the
fruit from the background. This algorithm is of flood fill type: Start from
each edge of the image and marking all pixels there, then marking all
pixels found in the neighborhood of the already marked pixels for which
the distance between colors is less than a prescribed value. Finally, repeat the
previous step until no more pixels can be marked. The process like this video https://vimeo.com/286843424

### 4.2 Training with RESNET-50
We defined train & test datasets followed by four metrics above (500 OK and 500 NG images): 
#### Folder structure
    Dataset
            |__train
            |    |__OK (400)
            |    |__NG (400)
            |       |__...
            |       |__...
            |
            |__test
                |__OK (100)
                |__NG (100)
                    |__...
                    |__...
     
#### Metrics
    * binary_crossentropy
    
# 5. Capturing Objects by Pi Camera
### 5.1 Connecting Pi Camera to the Arm
First, connecting the Camera Module to the Raspberry Pi’s camera port, then start up the Pi and ensure the software is enabled.
<img src="https://github.com/quocnh/RobotArm/blob/master/assert/connect-camera.jpg" width="500" title="ros_graph">

Then, we attached the pi camera on top of the Arm. The result like the photo below. 

<img src="https://github.com/quocnh/RobotArm/blob/master/assert/pi.JPG" width="500" title="ros_graph">

### 5.2 Making Pi Camera Server
To install camera node in ROS is a tough step. It took alots of time to accomplish. Folow this tutorial to finish this step.

In order to use the Raspberry Pi 3 camera v2, we need to install a third-party ROS node from source, since it is not part of the ROS distribution at the moment. 
The installation is not that straightforward using only the barebones ROS installation,
since there are a few dependencies on other packages. Looking at the package definition package.xml, 
we see the following dependencies:
```sh
catkin
compressed_image_transport
roscpp
std_msgs
std_srvs
sensor_msgs
camera_info_manager
dynamic_reconfigure
libraspberrypi0
```
The highlighted ones are missing from the ros_comm stack, so we need to install them manually. The approach here is simply to fetch the missing packages and then merge them into the existing barebones catkin workspace. Lastly, we build and test raspicam_node.

1. Install all dependencies
Fetch the package information for all the missing packages and their ROS dependencies:

```sh
rosinstall_generator compressed_image_transport --rosdistro kinetic --deps --wet-only --tar > kinetic-compressed_image_transport-wet.rosinstall

rosinstall_generator camera_info_manager --rosdistro kinetic --deps --wet-only --tar > kinetic-camera_info_manager-wet.rosinstall

rosinstall_generator dynamic_reconfigure --rosdistro kinetic --deps --wet-only --tar > kinetic-dynamic_reconfigure-wet.rosinstall
```

Now we need to fetch the sources and put them to the ~/ros_catkin_ws/src where all the other packages from the barebone installation are located:
```sh
wstool merge -t src kinetic-compressed_image_transport-wet.rosinstall
wstool merge -t src kinetic-camera_info_manager-wet.rosinstall
wstool merge -t src kinetic-dynamic_reconfigure-wet.rosinstall
wstool update -t src
```
Fetch any additional Raspbian libraries that are needed

```sh
rosdep install --from-paths src --ignore-src --rosdistro kinetic -y
```

Build the packages. Please, note that this takes a very long time, so it might be a good idea to build it overnight in a tmux window.

```sh
./src/catkin/bin/catkin_make_isolated -j1 --install --install-space /opt/ros/kinetic -DCMAKE_BUILD_TYPE=Release
```
It turns out that raspicam_node depends on the raspberry pi library, so we also install the headers:
```sh
sudo apt-get install libraspberrypi-dev
```
2. Build the raspicam node
Check out the source code for raspicam_node from Github in the workspace src directory:
```sh
cd ~/ros_catkin_ws
git clone https://github.com/UbiquityRobotics/raspicam_node.git
```
Install other library dependencies automatically:
```sh
rosdep install --from-paths src --ignore-src --rosdistro kinetic -y
```
Finally, build and install raspicam_node. It should be possible to do this more specifically with --pkg raspicam and save some time, but this hasn’t been tried yet. Two compilation processes -j2 are a safe option here:
```sh
./src/catkin/bin/catkin_make_isolated -j2 --install --install-space /opt/ros/kinetic -DCMAKE_BUILD_TYPE=Release
```

3. Test the camera
Now that we have the camera node installed, we can test the Raspberry camera if we haven’t done that yet. It needs to be enabled with raspi-config from the interface menu:
```sh
sudo raspi-config
```
Take a test shot
```sh
raspistill -o test.jpg
```
Everything is fine, so we can test the raspicam node.

4. Test raspicam_node
Start a new tmux session and source the setup file in every relevant window
```sh
source /opt/ros/kinetic/setup.bash
```
Open a new window for roscore and start it there. Find the launch definitions in ~/ros_catkin_ws/src/raspicam_node/launch/ and go there:
```sh
cd ~/ros_catkin_ws/src/raspicam_node/launch/
```
Start raspicam_node with the launch configuration of choice:
```sh
roslaunch camerav2_1280x960.launch
```
A simple topic check shows us that the node is active:
```sh
:~$ rostopic list
/raspicam_node/camera_info
/raspicam_node/image/compressed
/raspicam_node/parameter_descriptions
/raspicam_node/parameter_updates
/rosout
/rosout_agg
```

## 6. Experimental Reslut
### 6.1 Kinametic Implementation
https://colab.research.google.com/drive/16oZtyKOfklekXpCMOa6KYnGSpCuyhuNP
### 6.3 Prediction Result
Please check the video on top of the paper.
## 7. Conclusion
This project aims to build a small system that presents the real process in factories. By using a robot arm, image data is collected and deliveried to detect defects. 
Plus, based on computer vision is out-of-date and imposiible for inspect kind of this problems. Thus, with Deep Leaning, we can train and make a model that can solve the problem.
This opens many great ideas follow by such as pick and place object by using deep learning, or categorize object, etc... Or connect the Robot Arm to the conveyor belt for many different purposes.

## References
* [1] Hartenberg parameters, https://en.wikipedia.org/wiki/Denavit%E2%80%93Hartenberg_parameters
* [2] Publish image stream by raspberry pi, http://www.theconstructsim.com/publish-image-stream-ros-kinetic-raspberry-pi/
* [3] Videos about AR2 robot, https://www.youtube.com/watch?v=FIx6olybAeQ&feature=youtu.be
* [4] Robotic course, https://www.youtube.com/playlist?list=PLRG6WP3c31_U7TFGduEIJWVtkOw6AJjFf
* [5] Forward Kinematic, https://www.youtube.com/watch?v=NRgNDlVtmz0
* [6] ROS, http://www.ros.org/
* [7] Setup Pi camera and Raspberry Pi, https://projects.raspberrypi.org/en/projects/getting-started-with-picamera/4
* [8] Camera node in ROS, https://venelinpetkov.com/2017/11/19/how-to-install-a-raspberry-camera-node-on-ros-kinetic-raspbian-stretch/
* [9] Interact MoveIt and Industry Robot, https://github.com/eYSIP-2017/eYSIP-2017_Robotic_Arm/wiki/Interfacing-Real-Robot-with-MoveIt!
* [10] Pick and place, https://groups.google.com/forum/#!topic/moveit-users/_M0mf-R7AvI
 

