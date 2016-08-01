-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2015 at 07:24 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `HIS`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedDispensedDrug`(IN `drugs_srno` INT, IN `userId` INT, IN `quantity` INT, IN `drugQuantity` INT, IN `dname` VARCHAR(200))
BEGIN

  INSERT INTO
  `pharm_dispensedrug`( `dispense_drugs_srno`, `dispense_drugs_name`,  `dispense_drugs_userid`, `dispense_drugs_dispensedate`, `dispense_drugs_quantity`)
  VALUES
  (drugs_srno,dname,userId,now(),quantity);
 
 
  UPDATE
`pharm_asst_stock`
SET
`updatedDate`=now(),`requestedUserID`=userId,`drugQty`=drugQuantity
WHERE `drug_srno`=drugs_srno;

SELECT * FROM `pharm_dispensedrug` WHERE `dispense_drugs_srno` = drugs_srno   GROUP BY dispense_drugs_userid
HAVING MAX(dispense_drugs_userid);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE IF NOT EXISTS `admin_permission` (
  `permission_id` int(11) NOT NULL,
  `permission_discription` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_permission`
--

INSERT INTO `admin_permission` (`permission_id`, `permission_discription`, `is_active`) VALUES
(1, 'Add Role', 1),
(2, 'Delete Role', 1),
(3, 'Update Role', 1),
(4, 'View Role', 1),
(5, 'View Permission', 1),
(6, 'View User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissionrequest`
--

CREATE TABLE IF NOT EXISTS `admin_permissionrequest` (
  `request_id` int(11) NOT NULL,
  `reqest_permission` varchar(250) NOT NULL,
  `reason` text NOT NULL,
  `requester` int(11) NOT NULL,
  `approver` int(11) DEFAULT NULL,
  `request_date` date NOT NULL,
  `approve_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_approve` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_permissionrequest`
--

INSERT INTO `admin_permissionrequest` (`request_id`, `reqest_permission`, `reason`, `requester`, `approver`, `request_date`, `approve_date`, `is_active`, `is_approve`) VALUES
(1, 'Request Add Role Permission', 'To add role details', 3, 3, '2014-08-25', '2014-08-25', 1, 1),
(2, 'Request Add User Permission', 'To add User details', 3, 3, '2014-08-25', '2014-08-25', 1, 0),
(5, 'Delete permission for all domain classes', 'To delete user details  \n \n', 3, 3, '2014-08-26', '2014-08-26', 1, 0),
(6, 'Show user roles', 'Please add show user role for me', 3, 3, '2014-08-27', '2014-08-27', 1, 1),
(7, 'Show user roles', 'Please add show user role for me', 3, 3, '2014-08-27', '2014-08-28', 1, 1),
(8, 'Delete admin', 'To delete admin ', 3, 3, '2014-08-27', '2014-08-29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_rolepermissions`
--

CREATE TABLE IF NOT EXISTS `admin_rolepermissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_rolepermissions`
--

INSERT INTO `admin_rolepermissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(2, 2),
(4, 2),
(4, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` varchar(110) NOT NULL,
  `role_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`user_id`, `user_name`, `password`, `role_id`, `employee_id`, `is_active`) VALUES
(1, 'Wasantha', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 1, 1, 1),
(2, 'Sahan', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 4, 12, 1),
(3, 'Rasangi', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 2, 1, 1),
(4, 'Nisha', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 5, 12, 1),
(5, 'Ishara', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 1, 13, 1),
(6, 'Madhura', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 2, 26, 1),
(7, 'Dilini', '1000:36811180741ae8228031ab39f3435b37a5d9879511055c92:85e4f4ffd3f3d486827212e47b2a0f13d215880fcdf3d5ee', 1, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_userroles`
--

CREATE TABLE IF NOT EXISTS `admin_userroles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_userroles`
--

INSERT INTO `admin_userroles` (`role_id`, `role_name`, `is_active`) VALUES
(1, 'Doctor', 1),
(2, 'Nurse', 1),
(3, 'MLT', 1),
(4, 'Chief Pharmacist', 1),
(5, 'Assistant Pharmacist', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_log`
--

CREATE TABLE IF NOT EXISTS `attendance_log` (
  `Bcode` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_patient_attachment`
--

CREATE TABLE IF NOT EXISTS `clinic_patient_attachment` (
  `attachment_id` int(11) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `attachment_type` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_patient_history`
--

CREATE TABLE IF NOT EXISTS `clinic_patient_history` (
  `clinic_history_id` int(11) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `treatment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_patient_queue`
--

CREATE TABLE IF NOT EXISTS `clinic_patient_queue` (
  `clinic_queue_token_no` varchar(20) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `clinic_visit_type` varchar(200) NOT NULL,
  `clinic_queue_assign_date` datetime NOT NULL,
  `clinic_queue_assign_by` varchar(100) NOT NULL,
  `clinic_queue_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_patient_treatment`
--

CREATE TABLE IF NOT EXISTS `clinic_patient_treatment` (
  `treatment_id` int(11) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `clinic_date` date NOT NULL,
  `prescriptionItems_ID` int(11) NOT NULL,
  `clinic_doc` varchar(100) NOT NULL,
  `clinic_diagnosis` varchar(200) NOT NULL,
  `clinic_remarks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_schedule`
--

CREATE TABLE IF NOT EXISTS `clinic_schedule` (
  `schedule_id` int(11) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `clinic_datetime` datetime NOT NULL,
  `mobile_no` int(10) NOT NULL,
  `create_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_visit`
--

CREATE TABLE IF NOT EXISTS `clinic_visit` (
  `clinic_visit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `clinic_visit_date` date NOT NULL,
  `clinic_visit_type` varchar(200) NOT NULL,
  `clinic_visit_create_user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_xray`
--

CREATE TABLE IF NOT EXISTS `clinic_xray` (
  `xray_id` int(11) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `clinic_patient_name` varchar(200) NOT NULL,
  `clinic_problem` varchar(200) NOT NULL,
  `clinic_image` longblob NOT NULL,
  `clinic_remarks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cps_info`
--

CREATE TABLE IF NOT EXISTS `cps_info` (
  `cps_IP` varchar(11) NOT NULL,
  `cps_Port` int(11) DEFAULT '3306'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_ID` int(11) NOT NULL,
  `department_Name` varchar(30) NOT NULL,
  `department_Section` varchar(30) DEFAULT NULL,
  `department_Telephone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_ID`, `department_Name`, `department_Section`, `department_Telephone`) VALUES
(1, 'ICU', 'pediatric', '0112890291'),
(2, 'OPD', 'OPD', '0112890290'),
(3, 'CCU', 'pediatric', '0112774904'),
(4, 'IPD Pharamacy', 'IPD', '0112834763'),
(5, 'LAB', 'OPD LAB', '0112567188');

-- --------------------------------------------------------

--
-- Table structure for table `diabetic_chat`
--

CREATE TABLE IF NOT EXISTS `diabetic_chat` (
  `chat_id` int(11) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diabetic_graph`
--

CREATE TABLE IF NOT EXISTS `diabetic_graph` (
  `graph_id` int(11) NOT NULL,
  `clinic_visit_id` int(11) NOT NULL,
  `blood_glucose_level` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_ID` int(11) NOT NULL,
  `employee_SerialNo` int(11) DEFAULT NULL,
  `employee_NIC` varchar(10) NOT NULL,
  `employee_Name` varchar(30) NOT NULL,
  `employee_DOB` date NOT NULL,
  `employee_Address` varchar(50) NOT NULL,
  `employee_TelephoneNo` varchar(30) DEFAULT NULL,
  `employee_Gender` varchar(10) NOT NULL,
  `employee_CivilStatus` varchar(10) NOT NULL,
  `employee_Type` varchar(30) NOT NULL,
  `employee_Post` varchar(30) DEFAULT NULL,
  `employee_AppointmentDate` date NOT NULL,
  `employee_PensionDate` date DEFAULT NULL,
  `employee_WandOPNo` varchar(30) DEFAULT NULL,
  `employee_BasicSalary` double DEFAULT NULL,
  `employee_SalaryCode` varchar(30) DEFAULT NULL,
  `employee_MedRegNo` varchar(30) DEFAULT NULL,
  `employee_DoctorType` varchar(30) DEFAULT NULL,
  `employee_Active` bit(1) NOT NULL,
  `department_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_ID`, `employee_SerialNo`, `employee_NIC`, `employee_Name`, `employee_DOB`, `employee_Address`, `employee_TelephoneNo`, `employee_Gender`, `employee_CivilStatus`, `employee_Type`, `employee_Post`, `employee_AppointmentDate`, `employee_PensionDate`, `employee_WandOPNo`, `employee_BasicSalary`, `employee_SalaryCode`, `employee_MedRegNo`, `employee_DoctorType`, `employee_Active`, `department_ID`) VALUES
(1, 100, '892754233V', 'Wasantha Rathnayake', '1972-02-13', 'No:227,Kota Road,Rajagiriya', '0112774989', 'Male', 'married', 'Doctor', 'Consultant', '1997-03-13', '2027-02-13', '82/7321', 50000, 'PL1-2006-A', '20420', 'Surgeon', b'1', 1),
(2, 101, '712754233V', 'Rasangi Perera', '1971-02-04', 'No:12,Jothipala Mawatha,New Kandy Road,Malabe', '0112774984', 'Female', 'married', 'Nurse', 'Senior Nurse', '1998-03-13', '2026-02-13', '82/7334', 30000, 'PL1-2006-B', '', '', b'1', 2),
(3, 104, '892710325V', 'Rusiru Perera', '1989-08-28', '214, Rajagiriya', '0723456546', 'Male', 'Single', 'Chief Pharmacist', 'Chief Pharmacist', '2000-10-01', '2020-10-09', '82/7321', 50000, 'PL1-2023-B', '20420', 'Pharmacist', b'1', 4),
(4, 105, '892710555V', 'Kumara Perera', '1989-08-28', '214, Rajagiriya', '0723456578', 'Male', 'Single', 'Assistant Pharmacist', 'Assistant Pharmacist', '2000-10-01', '2020-10-09', '82/7326', 50000, 'PL1-2023-P', '2042009', 'Pharmacist', b'1', 4),
(5, 106, '892710555V', 'Nimal Perera', '1989-11-04', '214, Rajagiriya', '0723456546', 'Male', 'Single', 'MLT', 'MLT', '2000-10-01', '2020-10-09', '82/7321', 50000, 'PL1-2023-B', '2042009', 'MLT', b'1', 5),
(6, 3445, '985676543V', 'Miyuru De Silva', '2013-11-05', '214, Rajagiriya', '0723456546', 'Male', 'Single', 'MLT', 'MLT', '2013-11-05', '2013-11-29', '82/7344', 50000, 'PL1-2023-V', '204207776', 'MLT', b'1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `external_patients`
--

CREATE TABLE IF NOT EXISTS `external_patients` (
  `patientID` int(11) NOT NULL,
  `patient_NIC` varchar(10) DEFAULT NULL,
  `patient_HIN` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hin`
--

CREATE TABLE IF NOT EXISTS `hin` (
  `hin_Id` int(100) NOT NULL,
  `hin_Date` datetime NOT NULL,
  `hin_Pci` varchar(500) NOT NULL,
  `hin_LastserialNumber` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hin`
--

INSERT INTO `hin` (`hin_Id`, `hin_Date`, `hin_Pci`, `hin_LastserialNumber`) VALUES
(1, '2013-11-16 14:36:39', '5555', '000002');

-- --------------------------------------------------------

--
-- Table structure for table `hr_assignschedule`
--

CREATE TABLE IF NOT EXISTS `hr_assignschedule` (
  `emp_ID` int(11) NOT NULL,
  `shift_ID` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_attendance`
--

CREATE TABLE IF NOT EXISTS `hr_attendance` (
  `attendance_id` int(11) NOT NULL,
  `in_time` datetime NOT NULL,
  `out_time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `ot_hours` double NOT NULL DEFAULT '0',
  `employee_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_attendance`
--

INSERT INTO `hr_attendance` (`attendance_id`, `in_time`, `out_time`, `status`, `ot_hours`, `employee_id`, `is_active`) VALUES
(1, '2014-08-25 08:00:00', '2016-08-25 18:00:00', 1, 0, 1, 1),
(2, '2014-08-05 08:00:00', '2016-08-05 18:00:00', 1, 0, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_contact`
--

CREATE TABLE IF NOT EXISTS `hr_contact` (
  `contact_type_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_contacttype`
--

CREATE TABLE IF NOT EXISTS `hr_contacttype` (
  `contact_type_ID` int(11) NOT NULL,
  `contact_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_department`
--

CREATE TABLE IF NOT EXISTS `hr_department` (
  `dept_ID` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_head_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_department`
--

INSERT INTO `hr_department` (`dept_ID`, `dept_name`, `dept_head_ID`) VALUES
(1, 'Administrarion', NULL),
(3, 'Ward-03', NULL),
(4, 'PCU', NULL),
(5, 'OPD', 12),
(6, 'Ward-01', NULL),
(7, 'Ward-02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_designation`
--

CREATE TABLE IF NOT EXISTS `hr_designation` (
  `designation_ID` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL,
  `groups` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_designation`
--

INSERT INTO `hr_designation` (`designation_ID`, `designation_name`, `groups`) VALUES
(1, 'Doctor', 1),
(2, 'Head Nurse1', NULL),
(3, 'Nurse', NULL),
(4, 'Administrator', NULL),
(5, 'Child Specialist ', 1),
(6, 'Physician', 1),
(7, 'Surgeon', 1),
(8, 'Chief Nurse', NULL),
(9, 'Chief', NULL),
(10, 'Pharmacist', NULL),
(11, 'Chief Pharmacist', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_designationgroup`
--

CREATE TABLE IF NOT EXISTS `hr_designationgroup` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_designationgroup`
--

INSERT INTO `hr_designationgroup` (`group_id`, `group_name`) VALUES
(1, 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee`
--

CREATE TABLE IF NOT EXISTS `hr_employee` (
  `emp_ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `is_active` bit(1) NOT NULL,
  `emp_image` blob
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_employee`
--

INSERT INTO `hr_employee` (`emp_ID`, `title`, `first_name`, `last_name`, `birthday`, `gender`, `civil_status`, `is_active`, `emp_image`) VALUES
(1, 'Mr', 'Wasantha ', 'Rathnayaka', '1990-04-08', 'Male', 'Single', b'1', NULL),
(2, 'Mrs', 'Rasangi', 'Perera', '1990-03-23', 'Female', 'Single', b'1', NULL),
(12, 'Dr', 'Nishadini', 'Fernando', '2014-09-10', 'Female', 'Single', b'1', NULL),
(13, 'Dr', 'Ishara', 'Gunathilake', '2014-09-30', 'Male', 'Single', b'1', NULL),
(14, 'Dr', 'Shermin', 'Fernandopulle', '2014-09-24', 'Male', 'Single', b'1', NULL),
(15, 'Dr', 'Kasun', 'Gunathilake', '2014-10-01', 'Male', 'Single', b'1', NULL),
(16, 'Dr', 'Shashindu', 'Samare', '2014-10-01', 'Male', 'Single', b'1', NULL),
(17, 'Dr', 'Himansha', 'De Silva', '2014-10-01', 'Female', 'Single', b'1', NULL),
(19, 'Dr', 'Dilini', 'Jaye', '2014-10-01', 'Female', 'Single', b'1', NULL),
(20, 'Dr', 'Sharmal', 'Perera', '2014-10-01', 'Male', 'Single', b'1', NULL),
(21, 'Dr', 'Nishon', 'Wishmith', '2014-10-01', 'Male', 'Single', b'1', NULL),
(22, 'Dr', 'Marlon', 'Moraes', '2014-10-01', 'Male', 'Single', b'1', NULL),
(23, 'Dr', 'Maleesha', 'Weerasinghe', '2014-10-01', 'Female', 'Single', b'1', NULL),
(24, 'Ms', 'Nishani', 'Fernando', '2014-10-01', 'Female', 'Married', b'1', NULL),
(25, 'Ms', 'Hasangi', 'Shashikala', '2014-10-01', 'Female', 'Single', b'1', NULL),
(26, 'Mr', 'Madhura', 'Perera', '2014-10-01', 'Male', 'Married', b'1', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `hr_employee_view`
--
CREATE TABLE IF NOT EXISTS `hr_employee_view` (
`emp_ID` int(11)
,`title` varchar(50)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`birthday` date
,`gender` varchar(50)
,`civil_status` varchar(50)
,`Address` varchar(100)
,`Phone` varchar(100)
,`Mobile` varchar(100)
,`Email` varchar(100)
,`NIC` varchar(50)
,`EPF` varchar(50)
,`Driving_Licence` varchar(50)
,`dept_name` varchar(50)
,`designation_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `hr_hasleaves`
--

CREATE TABLE IF NOT EXISTS `hr_hasleaves` (
  `emp_ID` int(11) NOT NULL,
  `leave_type_ID` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_identity`
--

CREATE TABLE IF NOT EXISTS `hr_identity` (
  `identity_type_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `identity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_identitytype`
--

CREATE TABLE IF NOT EXISTS `hr_identitytype` (
  `identity_type_ID` int(11) NOT NULL,
  `identity_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leavetype`
--

CREATE TABLE IF NOT EXISTS `hr_leavetype` (
  `leave_type_ID` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `no_of_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_shifttimes`
--

CREATE TABLE IF NOT EXISTS `hr_shifttimes` (
  `shift_ID` int(11) NOT NULL,
  `from_datetime` datetime NOT NULL,
  `to_datetime` datetime NOT NULL,
  `dept_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_takeleaves`
--

CREATE TABLE IF NOT EXISTS `hr_takeleaves` (
  `emp_ID` int(11) NOT NULL,
  `leave_type_ID` int(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `reason` varchar(100) NOT NULL,
  `approve_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_userattendance`
--

CREATE TABLE IF NOT EXISTS `hr_userattendance` (
  `Bcode` varchar(30) DEFAULT NULL,
  `Fname` varchar(45) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `image` longblob,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_workin`
--

CREATE TABLE IF NOT EXISTS `hr_workin` (
  `emp_ID` int(11) NOT NULL,
  `dept_ID` int(11) NOT NULL,
  `designation_ID` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(50) NOT NULL,
  `is_active` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_workin`
--

INSERT INTO `hr_workin` (`emp_ID`, `dept_ID`, `designation_ID`, `start_date`, `end_date`, `description`, `is_active`) VALUES
(1, 5, 1, '2014-11-13', '2014-11-29', 'Assign', b'1'),
(12, 1, 1, '2014-08-01', '2014-10-01', 'Assign', b'1'),
(13, 6, 1, '2015-03-01', '2015-12-01', 'Assign', b'1'),
(19, 5, 1, '2014-08-01', '2014-10-08', 'Assign', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `lab_externallabresults`
--

CREATE TABLE IF NOT EXISTS `lab_externallabresults` (
  `result_id` int(11) NOT NULL,
  `mainresult` varchar(255) DEFAULT NULL,
  `other_comments` varchar(255) DEFAULT NULL,
  `ftest_id` int(11) DEFAULT NULL,
  `fsubf_id` int(11) DEFAULT NULL,
  `fparentf_id` int(11) DEFAULT NULL,
  `fpatient_id` int(11) DEFAULT NULL,
  `result_finalized_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fadded_user_id` int(11) DEFAULT NULL,
  `flast_updated_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_inwardlabrequest`
--

CREATE TABLE IF NOT EXISTS `lab_inwardlabrequest` (
  `inward_lab_test_request_id` int(11) NOT NULL,
  `bht` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_labdepartments`
--

CREATE TABLE IF NOT EXISTS `lab_labdepartments` (
  `lab_dept_id` int(11) NOT NULL,
  `lab_dept_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_labdepartments`
--

INSERT INTO `lab_labdepartments` (`lab_dept_id`, `lab_dept_name`) VALUES
(1, 'Pathology'),
(2, 'Microbiology'),
(3, 'Histopathology'),
(4, 'Biochemistry');

-- --------------------------------------------------------

--
-- Table structure for table `lab_laboratories`
--

CREATE TABLE IF NOT EXISTS `lab_laboratories` (
  `lab_id` int(11) NOT NULL,
  `lab_name` varchar(30) NOT NULL,
  `flab_type_id` int(11) DEFAULT NULL,
  `lab_incharge` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `flab_dept_id` int(11) DEFAULT NULL,
  `lab_dept_count` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `flab_added_user_id` int(11) DEFAULT NULL,
  `flab_last_updated_user_id` int(11) DEFAULT NULL,
  `lab_added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_last_updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contact_number_1` varchar(10) NOT NULL,
  `contact_number_2` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_laboratories`
--

INSERT INTO `lab_laboratories` (`lab_id`, `lab_name`, `flab_type_id`, `lab_incharge`, `location`, `flab_dept_id`, `lab_dept_count`, `email`, `flab_added_user_id`, `flab_last_updated_user_id`, `lab_added_date`, `lab_last_updated_date`, `contact_number_1`, `contact_number_2`) VALUES
(12, 'PCU', 1, 'Kasun', 'Homagama', 3, 2, 'pcu@hislis.com', 1, 1, '2015-07-23 07:59:39', '2014-11-20 07:19:06', '0112345678', '0112345676'),
(13, 'OPD', 1, 'Sahan', 'OPD', 4, 3, 'opd@limishis.com', 1, 1, '2015-07-23 07:59:44', '2015-07-10 04:43:01', '0113456784', '0113456789'),
(14, 'Clinic', 1, 'Yashoda', 'Clinic', 4, 2, 'clinic@limshims.com', 1, 1, '2015-07-23 07:59:46', '2014-11-20 09:00:21', '0112345568', '0112345655'),
(15, 'Inward', 1, 'Hasangi', 'Inward', 4, 2, 'inward@hislims.com', 1, 1, '2015-07-23 07:59:49', '2015-07-17 05:45:03', '0112345679', '0112345615');

-- --------------------------------------------------------

--
-- Table structure for table `lab_labtestrequest`
--

CREATE TABLE IF NOT EXISTS `lab_labtestrequest` (
  `lab_test_request_id` int(11) NOT NULL,
  `ftest_id` int(11) DEFAULT NULL,
  `fpatient_id` int(11) DEFAULT NULL,
  `flab_id` int(11) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `test_request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `test_due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ftest_request_person` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_labtestrequest`
--

INSERT INTO `lab_labtestrequest` (`lab_test_request_id`, `ftest_id`, `fpatient_id`, `flab_id`, `comment`, `priority`, `status`, `test_request_date`, `test_due_date`, `ftest_request_person`) VALUES
(1, 1, 1, 13, 'Test', 'High', 'Report Issued', '2015-07-30 04:51:20', '2015-07-23 01:55:45', 1),
(2, 30, 60, 13, 'Test', 'Medium', 'Report Issued', '2015-07-29 03:39:03', '2015-07-23 22:56:14', 1),
(3, 1, 10, 13, 'qwdw', 'Medium', 'Report Issued', '2015-07-30 04:59:44', '2015-07-30 04:59:44', 1),
(4, 30, 1, 13, 'Test', 'High', 'Report Issued', '2015-07-29 03:41:17', '2015-07-23 01:55:45', 1),
(5, 2, 10, 13, 'Need a Report', 'High', 'Report Issued', '2015-07-30 05:32:36', '2015-07-30 05:32:36', 1),
(6, 30, 2, 13, 'test', 'High', 'Report Issued', '2015-07-30 05:56:28', '2015-08-02 02:51:19', 1),
(7, 1, 1, 13, 'note', 'High', 'Report Issued', '2015-07-30 08:35:07', '2015-07-30 08:35:07', 1),
(8, 1, 6, 13, 'etdt', 'High', 'Sample Collected', '2015-08-06 08:50:00', '2015-08-06 08:50:00', 1),
(9, 1, 8, 13, 'wsarfdwzs', 'Medium', 'Sample Required', '2015-08-12 06:34:26', '2015-08-12 06:34:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_mainresults`
--

CREATE TABLE IF NOT EXISTS `lab_mainresults` (
  `result_id` int(11) NOT NULL,
  `mainresult` varchar(255) NOT NULL,
  `ftest_request_id` int(11) DEFAULT NULL,
  `fparentf_id` int(11) DEFAULT NULL,
  `result_finalized_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_mainresults`
--

INSERT INTO `lab_mainresults` (`result_id`, `mainresult`, `ftest_request_id`, `fparentf_id`, `result_finalized_date`) VALUES
(1, '4', 1, 4, '2015-07-30 04:59:30'),
(2, '4', 1, 7, '2015-07-30 04:59:30'),
(3, '4', 1, 13, '2015-07-30 04:59:30'),
(4, '55', 1, 2, '2015-07-30 04:59:30'),
(5, '4', 1, 6, '2015-07-30 04:59:30'),
(6, '4', 1, 12, '2015-07-30 04:59:30'),
(7, '4', 1, 10, '2015-07-30 04:59:30'),
(8, '4', 1, 3, '2015-07-30 04:59:30'),
(9, '4', 1, 5, '2015-07-30 04:59:30'),
(10, '4', 1, 8, '2015-07-30 04:59:30'),
(11, '4', 1, 11, '2015-07-30 04:59:30'),
(12, '4', 1, 9, '2015-07-30 04:59:30'),
(13, '4', 1, 1, '2015-07-30 04:59:30'),
(14, '9', 2, 17, '2015-07-30 05:00:26'),
(15, '9', 2, 16, '2015-07-30 05:00:26'),
(16, '9', 2, 18, '2015-07-30 05:00:26'),
(17, '9', 2, 19, '2015-07-30 05:00:26'),
(18, '9', 2, 20, '2015-07-30 05:00:26'),
(19, '8', 3, 5, '2015-07-30 05:01:12'),
(20, '8', 3, 11, '2015-07-30 05:01:12'),
(21, '8', 3, 10, '2015-07-30 05:01:12'),
(22, '8', 3, 2, '2015-07-30 05:01:12'),
(23, '8', 3, 4, '2015-07-30 05:01:12'),
(24, '8', 3, 13, '2015-07-30 05:01:12'),
(25, '8', 3, 7, '2015-07-30 05:01:12'),
(26, '8', 3, 12, '2015-07-30 05:01:12'),
(27, '8', 3, 1, '2015-07-30 05:01:12'),
(28, '8', 3, 9, '2015-07-30 05:01:12'),
(29, '8', 3, 3, '2015-07-30 05:01:12'),
(30, '8', 3, 6, '2015-07-30 05:01:12'),
(31, '8', 3, 8, '2015-07-30 05:01:12'),
(32, '3', 4, 19, '2015-07-30 05:22:43'),
(33, '20', 4, 18, '2015-07-30 05:22:43'),
(34, '15', 4, 16, '2015-07-30 05:22:43'),
(35, '2', 4, 20, '2015-07-30 05:22:43'),
(36, '14', 4, 17, '2015-07-30 05:22:43'),
(37, '85', 5, 31, '2015-07-30 05:33:13'),
(38, '5', 6, 19, '2015-07-30 05:57:40'),
(39, '8', 6, 20, '2015-07-30 05:57:40'),
(40, '5', 6, 16, '2015-07-30 05:57:40'),
(41, '8', 6, 17, '2015-07-30 05:57:40'),
(42, '13', 6, 18, '2015-07-30 05:57:40'),
(43, '7', 7, 6, '2015-07-30 08:56:37'),
(44, '5', 7, 11, '2015-07-30 08:56:37'),
(45, '5', 7, 4, '2015-07-30 08:56:37'),
(46, '6', 7, 12, '2015-07-30 08:56:37'),
(47, '8', 7, 3, '2015-07-30 08:56:37'),
(48, '6', 7, 2, '2015-07-30 08:56:37'),
(49, '3', 7, 5, '2015-07-30 08:56:37'),
(50, '1', 7, 7, '2015-07-30 08:56:37'),
(51, '2', 7, 8, '2015-07-30 08:56:37'),
(52, '5', 7, 1, '2015-07-30 08:56:37'),
(53, '9', 7, 13, '2015-07-30 08:56:37'),
(54, '8', 7, 9, '2015-07-30 08:56:37'),
(55, '4', 7, 10, '2015-07-30 08:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `lab_opdlabrequest`
--

CREATE TABLE IF NOT EXISTS `lab_opdlabrequest` (
  `opd_lab_test_request_id` int(11) NOT NULL,
  `patient_visit_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_parenttestfields`
--

CREATE TABLE IF NOT EXISTS `lab_parenttestfields` (
  `parent_field_id` int(11) NOT NULL,
  `parent_field_id_name` varchar(5) NOT NULL,
  `parent_field_name` varchar(80) NOT NULL,
  `ftest_name_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_parenttestfields`
--

INSERT INTO `lab_parenttestfields` (`parent_field_id`, `parent_field_id_name`, `parent_field_name`, `ftest_name_id`) VALUES
(1, 'PF', 'RBC', 1),
(2, 'PF', 'Haemoglobin', 1),
(3, 'PF', 'PCV', 1),
(4, 'PF', 'MCV', 1),
(5, 'PF', 'MCH', 1),
(6, 'PF', 'MCHC', 1),
(7, 'PF', 'Platelet Count', 1),
(8, 'PF', 'Leucocyte Count', 1),
(9, 'PF', 'Neutrophils', 1),
(10, 'PF', 'Lymphocytes', 1),
(11, 'PF', 'Eosinophils', 1),
(12, 'PF', 'Monocytes', 1),
(13, 'PF', 'Basophils', 1),
(14, 'PF', 'Sodium ', 10),
(15, 'PF', 'Potassium', 10),
(16, 'PF', 'Total Cholesterol', 30),
(17, 'PF', 'HDL', 30),
(18, 'PF', 'LDL', 30),
(19, 'PF', 'Serum Triglycerides', 30),
(20, 'PF', 'Cholesterol HDL Ratio', 30),
(21, 'PF', 'SGPT (Alanine Aminotransferase)', 11),
(22, 'PF', 'Fat Globules', 20),
(23, 'PF', 'Reducing Substances ', 20),
(24, 'PF', 'Fibers	', 20),
(25, 'PF', 'Amoebae', 20),
(26, 'PF', 'Ova', 20),
(27, 'PF', 'Cysts', 20),
(30, 'PF', 'Pus Cells', 20),
(31, 'PF', 'Fasting Blood Sugar', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lab_pculabrequest`
--

CREATE TABLE IF NOT EXISTS `lab_pculabrequest` (
  `pcu_lab_test_request_id` int(11) NOT NULL,
  `pcu_patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_reports`
--

CREATE TABLE IF NOT EXISTS `lab_reports` (
  `report_id` int(11) NOT NULL,
  `fpatient_id` int(11) DEFAULT NULL,
  `issued_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ftest_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_samplecenters`
--

CREATE TABLE IF NOT EXISTS `lab_samplecenters` (
  `sample_center_id` int(11) NOT NULL,
  `sample_center_name` varchar(30) NOT NULL,
  `fsample_center_type_id` int(11) DEFAULT NULL,
  `sample_center_incharge` varchar(30) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fsample_center_added_user_id` int(11) DEFAULT NULL,
  `fsample_center_last_updated_user_id` int(11) DEFAULT NULL,
  `sample_center_added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sample_center_last_updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contact_number_1` varchar(10) NOT NULL,
  `contact_number_2` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_samplecenters`
--

INSERT INTO `lab_samplecenters` (`sample_center_id`, `sample_center_name`, `fsample_center_type_id`, `sample_center_incharge`, `location`, `email`, `fsample_center_added_user_id`, `fsample_center_last_updated_user_id`, `sample_center_added_date`, `sample_center_last_updated_date`, `contact_number_1`, `contact_number_2`) VALUES
(1, 'Asiri-SampleCollectionCenter', 1, 'Nirmali', 'Malabe', 'asiriSample@asirilab.com', 1, 1, '2015-07-23 07:33:53', '2015-07-23 07:33:53', '011223456', '011223457');

-- --------------------------------------------------------

--
-- Table structure for table `lab_samplecentertypes`
--

CREATE TABLE IF NOT EXISTS `lab_samplecentertypes` (
  `sample_center_type_id` int(11) NOT NULL,
  `sample_center_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_samplecentertypes`
--

INSERT INTO `lab_samplecentertypes` (`sample_center_type_id`, `sample_center_type_name`) VALUES
(1, 'Regional');

-- --------------------------------------------------------

--
-- Table structure for table `lab_specimen`
--

CREATE TABLE IF NOT EXISTS `lab_specimen` (
  `specimen_id` int(11) NOT NULL,
  `specimen_collected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `specimen_received_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remarks` varchar(300) DEFAULT NULL,
  `specimen_delivered_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `specimen_stored_destroyed_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stored_location` varchar(40) DEFAULT NULL,
  `stored_or_destroyed` varchar(10) DEFAULT NULL,
  `fspecimen_collected_by` int(11) DEFAULT NULL,
  `fspecimen_receiveded_by` int(11) DEFAULT NULL,
  `fspecimen_delivered_by` int(11) DEFAULT NULL,
  `fretention_type_id` int(11) DEFAULT NULL,
  `fspecimen_type_id` int(11) DEFAULT NULL,
  `flabtest_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_specimen`
--

INSERT INTO `lab_specimen` (`specimen_id`, `specimen_collected_date`, `specimen_received_date`, `remarks`, `specimen_delivered_date`, `specimen_stored_destroyed_date`, `stored_location`, `stored_or_destroyed`, `fspecimen_collected_by`, `fspecimen_receiveded_by`, `fspecimen_delivered_by`, `fretention_type_id`, `fspecimen_type_id`, `flabtest_request_id`) VALUES
(1, '2016-11-06 18:30:00', '2016-11-06 18:30:00', 'sample', '2016-11-06 18:30:00', '2017-07-06 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 1),
(2, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'aa', '2017-06-06 18:30:00', '2015-07-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 2),
(3, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'aa', '2017-06-06 18:30:00', '2015-08-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 1),
(4, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'gg', '2017-06-06 18:30:00', '2015-08-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 2),
(5, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'ii', '2017-06-06 18:30:00', '2015-06-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 3),
(6, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'test', '2017-06-06 18:30:00', '2015-08-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 4),
(7, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'test', '2017-06-06 18:30:00', '2017-07-06 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 5),
(8, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'aa', '2017-06-06 18:30:00', '2015-07-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 6),
(9, '2017-06-06 18:30:00', '2017-06-06 18:30:00', 'Sample', '2017-06-06 18:30:00', '2015-08-07 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 7),
(10, '2017-02-07 18:30:00', '2017-02-07 18:30:00', 'dd', '2017-02-07 18:30:00', '2015-03-08 18:30:00', 'OPD', 'stored', 1, 2, 3, 1, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lab_specimenretentiontype`
--

CREATE TABLE IF NOT EXISTS `lab_specimenretentiontype` (
  `retention_type_id` int(11) NOT NULL,
  `retention_type_name` varchar(40) DEFAULT NULL,
  `duration` varchar(30) DEFAULT NULL,
  `fcategory_id` int(11) DEFAULT NULL,
  `fsub_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_specimenretentiontype`
--

INSERT INTO `lab_specimenretentiontype` (`retention_type_id`, `retention_type_name`, `duration`, `fcategory_id`, `fsub_category_id`) VALUES
(1, 'Blood Fluids', '3 days', 1, 1),
(2, 'wre', '43', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lab_specimentype`
--

CREATE TABLE IF NOT EXISTS `lab_specimentype` (
  `specimen_type_id` int(11) NOT NULL,
  `specimen_type_name` varchar(100) DEFAULT NULL,
  `fcategory_id` int(11) DEFAULT NULL,
  `fsub_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_specimentype`
--

INSERT INTO `lab_specimentype` (`specimen_type_id`, `specimen_type_name`, `fcategory_id`, `fsub_category_id`) VALUES
(1, 'Blood Smear', 1, 1),
(2, 'wer', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lab_subfieldresults`
--

CREATE TABLE IF NOT EXISTS `lab_subfieldresults` (
  `sub_field_result_id` int(11) NOT NULL,
  `sub_field_result` varchar(255) DEFAULT NULL,
  `fmresult_id` int(11) DEFAULT NULL,
  `fparentf_id` int(11) DEFAULT NULL,
  `fsubf_id` int(11) DEFAULT NULL,
  `result_finalized_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_subtestfields`
--

CREATE TABLE IF NOT EXISTS `lab_subtestfields` (
  `sub_test_field_id` int(11) NOT NULL,
  `sub_field_id_name` varchar(5) NOT NULL,
  `sub_test_field_name` varchar(80) NOT NULL,
  `fpar_test_field_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_subtestfields`
--

INSERT INTO `lab_subtestfields` (`sub_test_field_id`, `sub_field_id_name`, `sub_test_field_name`, `fpar_test_field_id`) VALUES
(1, 'SF', 'wer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_testcategory`
--

CREATE TABLE IF NOT EXISTS `lab_testcategory` (
  `category_id` int(11) NOT NULL,
  `category_id_name` varchar(5) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_testcategory`
--

INSERT INTO `lab_testcategory` (`category_id`, `category_id_name`, `category_name`) VALUES
(1, 'TC', 'Biochemistry'),
(2, 'TC', 'er');

-- --------------------------------------------------------

--
-- Table structure for table `lab_testfieldsrange`
--

CREATE TABLE IF NOT EXISTS `lab_testfieldsrange` (
  `range_id` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `minage` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `min_val` double NOT NULL,
  `max_val` double NOT NULL,
  `max_age` int(11) DEFAULT NULL,
  `fparent_field_id` int(11) DEFAULT NULL,
  `fsub_field_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_testfieldsrange`
--

INSERT INTO `lab_testfieldsrange` (`range_id`, `gender`, `minage`, `unit`, `min_val`, `max_val`, `max_age`, `fparent_field_id`, `fsub_field_id`) VALUES
(1, 'Male', 25, '10^3u/l', 3.5, 6, 45, 1, NULL),
(2, 'Male', 25, '10^3u/l', 11, 18, 45, 2, NULL),
(3, 'Male', 25, '10^3u/l', 35, 55, 45, 3, NULL),
(4, 'Male', 25, '10^3u/l', 80, 100, 45, 4, NULL),
(5, 'Male', 25, '10^3u/l', 25, 33, 45, 5, NULL),
(6, 'Male', 25, '10^3u/l', 30, 38, 45, 6, NULL),
(7, 'Male', 25, '10^3u/l', 150, 450, 45, 7, NULL),
(8, 'Male', 25, '10^3u/l', 4, 11, 45, 8, NULL),
(9, 'Male', 25, '%', 40, 60, 45, 9, NULL),
(10, 'Male', 35, '%', 20, 40, 65, 10, NULL),
(11, 'Male', 35, '%', 2, 8, 65, 11, NULL),
(12, 'Male', 35, '%', 1, 4, 65, 12, NULL),
(13, 'Male', 35, '%', 0.5, 1, 65, 13, NULL),
(14, 'Female', 35, 'mg/dl', 3.5, 6, 65, 1, NULL),
(15, 'Female', 20, '10^3u/l', 11, 18, 50, 2, NULL),
(16, 'Female', 30, '10^3u/l', 35, 55, 55, 3, NULL),
(17, 'Female', 25, '10^3u/l', 80, 100, 55, 4, NULL),
(18, 'Female', 20, '10^3u/l', 25, 33, 55, 5, NULL),
(19, 'Female', 30, '10^3u/l', 30, 38, 50, 6, NULL),
(20, 'Female', 20, '10^3u/l', 150, 450, 55, 7, NULL),
(21, 'Female', 30, '10^3u/l', 4, 11, 50, 8, NULL),
(22, 'Female', 25, '%', 40, 60, 55, 9, NULL),
(23, 'Female', 24, '%', 20, 40, 56, 10, NULL),
(24, 'Female', 22, '%', 2, 8, 60, 11, NULL),
(25, 'Female', 30, '%', 1, 4, 50, 12, NULL),
(26, 'Female', 30, '%', 0.5, 1, 45, 13, NULL),
(27, 'Male', 30, 'mmol/L', 135, 148, 45, 14, NULL),
(28, 'Male', 30, 'mmol/L', 3.5, 5.3, 55, 15, NULL),
(29, 'Female', 20, 'mmol/L', 135, 148, 50, 14, NULL),
(30, 'Female', 30, 'mmol/L', 3.5, 5.3, 55, 15, NULL),
(31, 'Male', 30, 'mg/dl', 70, 115, 55, 31, NULL),
(32, 'Female', 30, 'mg/dl', 70, 115, 55, 10, NULL),
(33, 'Male', 20, 'mg/dl', 200, 240, 45, 16, NULL),
(34, 'Male', 20, 'mg/dl', 35, 55, 50, 17, NULL),
(35, 'Male', 20, 'mg/dl', 150, 190, 45, 18, NULL),
(36, 'Male', 20, 'mg/dl', 40, 160, 50, 19, NULL),
(37, 'Male', 20, 'mg/dl', 2, 6, 45, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lab_testnames`
--

CREATE TABLE IF NOT EXISTS `lab_testnames` (
  `test_id` int(11) NOT NULL,
  `test_id_name` varchar(5) NOT NULL,
  `test_name` varchar(30) NOT NULL,
  `test_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `test_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ftest_category_id` int(11) DEFAULT NULL,
  `ftest_sub_category_id` int(11) DEFAULT NULL,
  `ftest_create_user_id` int(11) DEFAULT NULL,
  `ftest_last_update_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_testnames`
--

INSERT INTO `lab_testnames` (`test_id`, `test_id_name`, `test_name`, `test_created_date`, `test_last_update`, `ftest_category_id`, `ftest_sub_category_id`, `ftest_create_user_id`, `ftest_last_update_user_id`) VALUES
(1, 'TN', 'Full Blood Count', '2015-08-04 10:34:52', '2015-08-04 10:34:52', 1, 1, NULL, 1),
(2, 'TN', 'Fasting Blood Sugar', '2015-07-27 08:46:00', '2015-07-25 12:46:31', 1, 1, 1, 1),
(3, 'TN', 'Random Blood Sugar', '2015-07-27 08:45:50', '2015-07-25 12:51:10', 1, 1, 1, 1),
(4, 'TN', 'PPBS', '2015-07-27 08:45:42', '2015-07-25 12:51:10', 1, 1, 1, 1),
(5, 'TN', 'Blood Sugar Sevies', '2015-07-27 08:45:35', '2015-07-25 12:52:56', 1, 1, 1, 1),
(6, 'TN', 'Reticulocyte Count', '2015-07-27 08:45:28', '2015-07-25 12:52:56', 1, 1, 1, 1),
(7, 'TN', 'PT - INR', '2015-07-27 08:50:45', '2015-07-25 12:54:19', 1, 1, 1, 1),
(8, 'TN', 'CSF Full Report', '2015-07-27 08:45:11', '2015-07-25 12:54:19', 1, 1, 1, 1),
(9, 'TN', 'Aspiration Fluid Full Report', '2015-07-27 08:44:52', '2015-07-25 12:55:40', 1, 1, 1, 1),
(10, 'TN', 'Serum Electrolytes', '2015-07-27 08:44:56', '2015-07-25 14:16:59', 1, 1, 1, 1),
(11, 'TN', 'SGOT - SGPT', '2015-07-27 08:50:33', '2015-07-25 12:57:10', 1, 1, 1, 1),
(12, 'TN', 'Serum Bilirubin', '2015-07-27 08:45:05', '2015-07-25 12:57:10', 1, 1, 1, 1),
(13, 'TN', 'Dengue IgG - IgM Ab', '2015-07-27 08:52:18', '2015-07-25 14:52:52', 1, 1, 1, 1),
(14, 'TN', 'Urine Full Report', '2015-07-27 08:44:32', '2015-07-25 14:52:23', 1, 1, 1, 1),
(15, 'TN', 'Urine Sugar', '2015-07-27 08:44:28', '2015-07-25 12:59:26', 1, 1, 1, 1),
(16, 'TN', 'Urine Bile', '2015-07-27 08:44:16', '2015-07-25 12:59:26', 1, 1, 1, 1),
(17, 'TN', 'Urine Ketone Bodies', '2015-07-27 08:44:09', '2015-07-25 13:01:27', 1, 1, 1, 1),
(18, 'TN', 'Urine Bence', '2015-07-27 08:47:35', '2015-07-25 13:01:27', 1, 1, 1, 1),
(19, 'TN', 'Urine Albumin', '2015-07-27 08:43:55', '2015-07-25 13:02:43', 1, 1, 1, 1),
(20, 'TN', 'Stool Full Report', '2015-07-27 08:43:49', '2015-07-25 13:02:43', 1, 1, 1, 1),
(21, 'TN', 'Stool Occult Blood', '2015-07-27 08:43:40', '2015-07-25 13:03:45', 1, 1, 1, 1),
(22, 'TN', 'Blood Urea', '2015-07-27 08:43:34', '2015-07-25 13:03:45', 1, 1, 1, 1),
(23, 'TN', 'Serum Creatinine', '2015-07-27 08:43:25', '2015-07-25 13:04:50', 1, 1, 1, 1),
(24, 'TN', 'ESR', '2015-07-27 08:43:18', '2015-07-25 13:04:50', 1, 1, 1, 1),
(25, 'TN', 'Anti Streptolysin O Titre', '2015-07-27 08:43:11', '2015-07-25 14:46:00', 1, 1, 1, 1),
(26, 'TN', 'Blood For Malarial Parasite', '2015-07-27 08:43:03', '2015-07-25 14:25:43', 1, 1, 1, 1),
(27, 'TN', 'Serum Cholesterol ', '2015-07-27 08:42:55', '2015-07-25 14:28:45', 1, 1, 1, 1),
(28, 'TN', 'CRP', '2015-07-27 08:53:23', '2015-07-25 14:45:30', 1, 1, 1, 1),
(29, 'TN', 'Human Chorionic Gonadotrophin ', '2015-07-27 08:42:43', '2015-07-25 14:38:18', 1, 1, 1, 1),
(30, 'TN', 'Lipid Profile', '2015-07-27 08:42:37', '2015-07-25 14:38:21', 1, 1, 1, 1),
(31, 'TN', 'WBC - DC', '2015-07-27 08:51:50', '2015-07-25 14:54:25', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_testsubcategory`
--

CREATE TABLE IF NOT EXISTS `lab_testsubcategory` (
  `sub_category_id` int(11) NOT NULL,
  `sub_category_id_name` varchar(5) NOT NULL,
  `sub_category_name` varchar(30) DEFAULT NULL,
  `fcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_testsubcategory`
--

INSERT INTO `lab_testsubcategory` (`sub_category_id`, `sub_category_id_name`, `sub_category_name`, `fcategory_id`) VALUES
(1, 'SC', 'Biochemistry_sub', 1),
(2, 'SC', 'wr', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lab_types`
--

CREATE TABLE IF NOT EXISTS `lab_types` (
  `lab_type_id` int(11) NOT NULL,
  `lab_type_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_types`
--

INSERT INTO `lab_types` (`lab_type_id`, `lab_type_name`) VALUES
(2, ''),
(1, 'Internal');

-- --------------------------------------------------------

--
-- Table structure for table `liveallergies`
--

CREATE TABLE IF NOT EXISTS `liveallergies` (
  `id` int(11) NOT NULL,
  `allergyname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `liveinjury`
--

CREATE TABLE IF NOT EXISTS `liveinjury` (
  `id` int(11) NOT NULL,
  `injuryname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient`
--

CREATE TABLE IF NOT EXISTS `opd_patient` (
  `patient_id` int(11) NOT NULL,
  `patient_title` varchar(5) NOT NULL,
  `patient_fullname` varchar(100) NOT NULL,
  `patient_personal_username` varchar(50) NOT NULL,
  `patient_NIC` varchar(10) NOT NULL,
  `patient_passport` varchar(10) NOT NULL,
  `patient_HIN` varchar(20) NOT NULL,
  `patient_photo` varchar(100) NOT NULL,
  `patient_DOB` date NOT NULL,
  `patient_telephone` varchar(40) NOT NULL,
  `patient_gender` varchar(10) NOT NULL,
  `patient_civil_status` varchar(20) NOT NULL,
  `patient_preferred_language` varchar(10) NOT NULL,
  `patient_citizenship` varchar(20) NOT NULL,
  `patient_blood` text NOT NULL,
  `patient_address` varchar(500) NOT NULL,
  `patient_contact_p_name` varchar(50) NOT NULL,
  `patient_contact_p_no` varchar(20) NOT NULL,
  `patient_remarks` varchar(500) NOT NULL,
  `patient_create_date` datetime NOT NULL,
  `patient_create_user` int(11) NOT NULL,
  `patient_lastupdate_date` datetime NOT NULL,
  `patient_lastupdate_user` int(11) NOT NULL,
  `patient_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient`
--

INSERT INTO `opd_patient` (`patient_id`, `patient_title`, `patient_fullname`, `patient_personal_username`, `patient_NIC`, `patient_passport`, `patient_HIN`, `patient_photo`, `patient_DOB`, `patient_telephone`, `patient_gender`, `patient_civil_status`, `patient_preferred_language`, `patient_citizenship`, `patient_blood`, `patient_address`, `patient_contact_p_name`, `patient_contact_p_no`, `patient_remarks`, `patient_create_date`, `patient_create_user`, `patient_lastupdate_date`, `patient_lastupdate_user`, `patient_active`) VALUES
(1, 'Mr', 'Kasun Gunathilaka', 'Kasun', '98765433V', '98978996N', '12340000012', '', '2014-08-19', '2143241341', 'Male', 'Single', 'Sinhala', 'sri lankan', 'A', 'Nugegoda', '', '', '', '2014-08-26 10:45:34', 5, '2014-08-26 05:10:24', 5, 1),
(2, 'Mr.', 'Ishara Gunathilaka', 'Ishara', '987654322V', '', 'null', '', '2014-08-19', '2143241341', 'Male', 'Single', 'Sinhala', ' sri lankan', 'A+', 'Nugegoda', ' ', ' ', '', '2014-08-26 10:45:34', 3, '2015-09-08 14:17:41', 3, 1),
(3, 'Dr', 'Iresh Perera', 'Fernando', '6734864237', '4143413414', '12340000038', '', '2014-08-06', '345325352', 'Male', 'Married', 'English', 'sri lankan', '', 'Nugegoda', 'Iresh', '907878798', '', '2014-08-26 08:23:03', 3, '2014-08-26 08:23:03', 3, 0),
(4, 'Mr.', 'Brian Walter', 'Brian', '839133344v', '', 'null', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', '  Sri Lanka', 'A+', 'White house,Papiliyana,Nugegoda', ' Brian Walter', '  071992755', 'None', '2013-08-31 15:35:03', 2, '2015-09-08 14:31:17', 3, 1),
(5, 'Mr.', 'Imanka Kodikara', 'Imee', '839133345v', '', '12340000053', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Imanka', ' 071992755', 'None', '2013-08-31 16:21:40', 2, '2013-08-31 16:21:40', 2, 1),
(6, 'Mr.', 'Amal Silva', 'Amal', '839133345v', '', '12340000061', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Amal', ' 071992755', 'None', '2013-08-31 16:42:10', 2, '2013-08-31 16:42:10', 2, 1),
(7, 'Mr.', 'Saman Silva', 'Saman', '839133345v', '', '12340000079', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Saman Silva', ' 071992755', 'None', '2013-08-31 16:47:48', 2, '2013-08-31 16:47:48', 2, 1),
(8, 'Mr.', 'Kamal Silva', 'Brian', '839133345v', '', '12340000087', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Kamal Silva', ' 071992755', 'None', '2013-08-31 16:50:36', 2, '2013-08-31 16:50:36', 2, 1),
(9, 'Mr.', 'Akila Perera', 'Akila', '839133345v', '', '12340000093', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Akila Perera', ' 071992755', 'None', '2013-09-01 11:37:32', 1, '2013-09-01 11:37:32', 1, 1),
(10, 'Mr.', 'Thanuja Walter', 'Thanuja', '839133345v', '', '12340000101', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Thanuja Walter', ' 071992755', 'None', '2013-11-14 14:14:49', 2, '2013-11-14 14:14:49', 2, 1),
(11, 'Mr.', 'Thinuka Hasaranga', 'Thinuka', '839133345v', '', '12340000119', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Thinuka', ' 071992755', 'None', '2013-11-14 14:15:31', 2, '2013-11-14 14:15:31', 2, 1),
(12, 'Mr.', 'Nirmana Silva', 'Nirmana ', '839133345v', '', '12340000127', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Nirmana Silva', ' 071992755', 'None', '2013-11-16 14:35:02', 2, '2013-11-16 14:35:02', 2, 1),
(13, 'Mr.', 'Ann Jerom', 'Ann ', '839133345v', '', '12340000135', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Ann', ' 071992755', 'None', '2013-11-16 14:36:19', 2, '2013-11-16 14:36:19', 2, 1),
(14, 'Mr.', 'Kasun Jerom', 'Kasun', '839133345v', '', '12340000142', '', '1989-09-27', '0728986544', 'Male', 'Single', 'Tamil', ' Sri Lanka', '', 'White house,Papiliyana,Nugegoda', 'Kasun Jerom', ' 071992755', 'None', '2013-11-16 14:36:39', 2, '2013-11-16 14:36:39', 2, 1),
(15, 'Mr.', 'Hareen Fernando', 'Hareen', '902313958V', '', '12340000150', 'null', '1990-12-01', '', 'Male', 'Single', '', '     ', '', 'Galle                                   ', '     ', '     ', '', '2014-05-30 11:25:41', 2, '2014-08-27 12:53:42', 2, 1),
(16, 'Mr.', 'Surath Mendis', 'Surath', '902313958V', '', '12340000163', 'null', '1990-08-18', '', 'Male', 'Single', '', ' ', '', 'Galle', ' ', ' ', '', '2014-07-26 14:44:30', 2, '2014-07-26 14:44:30', 2, 1),
(17, 'Mr.', 'Udara Deshan ', 'Udara', '952384051V', '', '12340000172', 'null', '1995-08-18', '', 'Male', 'Single', '', ' ', '', 'Homagama ', ' ', ' ', '', '2014-07-27 21:07:50', 2, '2014-07-27 21:07:50', 2, 1),
(18, 'Mr.', 'Asiri Samarasekara', 'Asiri', '902313858V', '', '12340000181', 'null', '1990-07-18', '', 'Male', 'Single', '', ' ', '', 'Matara, Southern Province, Sri Lanka', ' ', ' ', '', '2014-07-28 10:01:32', 2, '2014-07-28 10:01:32', 2, 1),
(19, 'Mr.', 'Jhon Fernando', 'Jhon', '601050982V', 'N8761575', '12340000192', 'null', '1960-02-19', '0112541667', 'Male', 'Married', 'Sinhala', ' Sri Lanka', '', 'Colombo, Western Province, Sri Lanka', ' Jhon Fernando', ' 011245322', 'Blind', '2014-07-28 15:54:56', 2, '2014-07-28 15:54:56', 2, 1),
(20, 'Mr.', 'Rusiru Kothalawala', 'Rusiru', '877761765V', '', '12340000202', 'null', '1987-10-02', '', 'Male', 'Single', '', ' ', '', 'Maharagama, Western Province, Sri Lanka', ' ', ' ', '', '2014-07-28 16:04:16', 2, '2014-07-28 16:04:16', 2, 1),
(21, 'Mr.', 'Prabhavi Perera', 'Prabhavi ', '912383958V', '', '12340000212', 'null', '1991-03-07', '', 'Female', 'Single', '', ' ', '', 'Galle, Southern Province, Sri Lanka', ' ', ' ', '', '2014-08-02 11:13:18', 2, '2014-08-02 11:13:18', 2, 1),
(22, 'Mr.', 'Sahan Harinda Nagodawithana', 'Sahan', '902313858V', 'N3141478', '12340000222', 'null', '1990-08-18', '0711892494', 'Male', 'Single', 'English', ' Sri Lanka', '', 'Milidduwa', 'Sahan', ' 071856511', 'Good person ', '2014-08-02 14:17:25', 2, '2014-08-02 14:17:25', 2, 1),
(23, 'Mr.', 'Asiri Pathirana', 'Asiri', '902313858V', '', '12340000232', 'null', '1990-02-03', '', 'Male', 'Single', '', ' ', '', 'Matara, Southern Province, Sri Lanka', ' ', ' ', '', '2014-08-03 14:50:24', 2, '2014-08-03 14:50:24', 2, 1),
(24, 'Mr.', 'Kasun Mendis', 'Kasun', '902313958V', '', '12340000245', 'null', '1990-08-18', '', 'Male', 'Single', '', ' ', '', 'Galle, Southern Province, Sri Lanka', ' ', ' ', '', '2014-08-03 17:21:37', 2, '2014-08-03 17:21:37', 2, 1),
(25, 'Mr.', 'Kalpana Silva', 'Kalpana', '903423948V', '', '12340000252', 'Koala.jpg', '1990-02-03', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Galle, Southern Province, Sri Lanka', ' ', ' ', '', '2014-09-09 16:23:50', 2, '2014-09-09 16:23:50', 2, 1),
(26, 'Mr.', 'Panditha De Silva', 'Panditha', '892710325V', '', '12340000267', 'Koala.jpg', '1989-02-23', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Malabe Post Office', ' ', ' ', '', '2014-09-09 16:27:56', 2, '2014-09-09 16:27:56', 2, 1),
(27, 'Mr.', 'Saminda Perera', 'Saminda', '902323958V', '', '12340000274', 'DSC_0246.jpg', '1990-09-01', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Nawala', ' ', ' ', '', '2014-09-09 16:33:50', 2, '2014-09-09 16:33:50', 2, 1),
(28, 'Miss.', 'Pravi Mendis', 'Pravi', '908171799v', '', '12340000288', 'null', '1990-01-01', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Kottawa, Pannipitiya, Western Province, Sri Lanka', ' ', ' ', '', '2014-09-20 16:34:09', 2, '2014-09-20 16:34:09', 2, 1),
(29, 'Mr.', 'Wimarsha Madubashana', 'Wimarsha ', '971252311v', '', '12340000295', '1.jpg', '1997-01-01', '', 'Male', 'Single', 'Sinhala', '  ', '', 'Maharagama                   ', '  ', '  ', '', '2014-09-20 21:00:07', 2, '2014-09-20 21:15:56', 2, 1),
(30, 'Miss.', 'Thilini Kanchana', 'Thilini', '908171799v', '', '12340000300', 'null', '1990-01-01', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Australia', ' ', ' ', '', '2014-09-22 20:07:16', 2, '2014-09-22 20:07:16', 2, 1),
(31, 'Mr.', 'Thilina Jayasinghe', 'Thilina', '908171799v', '', '12340000318', 'null', '1990-01-01', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Argentina', ' ', ' ', '', '2014-09-22 20:08:09', 2, '2014-09-22 20:08:09', 2, 1),
(32, 'Mr.', 'Asitha Meegama', 'Asitha', '908171799v', '', '12340000327', 'null', '1990-01-01', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Argentina', ' ', ' ', '', '2014-09-22 20:09:12', 2, '2014-09-22 20:09:12', 2, 1),
(33, 'Miss.', 'Praveena Karunarathna', 'Praveena', '908171799v', '11', '12340000332', '15554-you-and-me.jpg', '1990-01-01', '0711946591', 'Female', 'Single', 'English', ' sri lankan', '', 'Kottawa, Pannipitiya, Western Province, Sri Lanka', 'Praveena', '0711946591', 'Fever', '2014-09-22 20:16:30', 2, '2014-09-22 20:16:30', 2, 1),
(34, 'Mr.', 'Praveen Jayasinghe', 'Praveen', '908171799v', '11', '12340000348', 'null', '1990-01-01', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Pannipitiya', ' ', ' ', '', '2014-09-22 20:46:19', 2, '2014-09-22 20:46:19', 2, 1),
(35, 'Miss.', 'Thiru Fernando', 'Thiru', '908171799v', '', '12340000359', 'null', '1990-11-12', '', 'Female', 'Single', 'Sinhala', '  ', '', 'Kottawa                         ', '  ', '  ', '', '2014-09-24 22:40:35', 2, '2014-09-24 22:50:12', 2, 1),
(36, 'Miss.', 'Nirupama De Silva', 'Nirupama', '908171799v', '', '12340000365', 'null', '1990-11-12', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Pannipitiya', ' ', ' ', '', '2014-09-25 09:18:54', 2, '2014-09-25 09:18:54', 2, 1),
(37, 'Miss.', 'Indrani Perera ', 'Indrani', '908171799v', '', '12340000371', 'null', '1990-11-12', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Malabe, Western Province, Sri Lanka', ' ', ' ', '', '2014-09-25 09:32:58', 2, '2014-09-25 09:32:58', 2, 1),
(38, 'Mr.', 'Nipuna Silva', 'Nipuna', '902312345V', '', '12340000385', 'autosave.jpg', '1990-12-12', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Kaduwela, Western Province, Sri Lanka', ' ', ' ', '', '2014-11-08 10:58:45', 3, '2014-11-08 10:58:45', 3, 1),
(39, 'Mr.', 'Han Silva', 'Han', '902569865V', '', '12340000399', 'null', '1990-05-05', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Galle', ' ', ' ', '', '2014-11-11 16:23:04', 3, '2014-11-11 16:23:04', 3, 1),
(40, 'Mr.', 'Sunil Perera', 'Sunil', '601554872V', '', '12340000409', 'null', '1960-12-12', '0112457778', 'Male', 'Married', 'Sinhala', '  Sri Lanka', '', 'Homagama', 'Sunil', ' 0772647777', 'Vomit and fever', '2014-11-19 22:06:35', 3, '2014-11-19 22:17:30', 1, 1),
(41, 'Miss.', 'Rukshani Senarathna', 'Rukshani', '902313958V', '', '12340000418', 'proimage.jpg', '1990-08-18', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Galle, Southern Province, Sri Lanka', ' ', ' ', '', '2014-11-20 14:23:25', 3, '2014-11-20 14:23:25', 3, 1),
(42, 'Miss.', 'Ayanthi Dihara', 'Ayanthi', '983576456v', '', '12340000425', 'null', '1998-06-24', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Malabe', ' ', ' ', '', '2014-11-20 16:00:17', 3, '2014-11-20 16:00:17', 3, 1),
(43, 'Mr.', 'Rasanga Hapuarachchi', 'Rasanga', '902686542V', '', '12340000439', 'null', '1990-11-25', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Malabe', ' ', ' ', '', '2015-02-02 16:06:39', 3, '2015-02-02 16:06:39', 3, 1),
(44, 'Mr.', 'Koliya Pulasinghe', 'Koliya', '600245315V', '', '12340000447', 'null', '1960-04-05', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Horana, Western Province, Sri Lanka', ' ', ' ', '', '2015-02-06 12:22:42', 3, '2015-02-06 12:22:42', 3, 1),
(45, 'Mrs.', 'Chameli Weerasena', 'Chameli ', '910910255V', '', '12340000455', 'Koala.jpg', '1991-05-01', '0112729729', 'Female', 'Married', 'Sinhala', ' ', '', 'Malabe, Western Province, Sri Lanka', '', ' ', 'Fever', '2015-02-07 14:05:28', 3, '2015-02-07 14:05:28', 3, 1),
(46, 'Mr.', 'Luke Morphus', 'Luke', '912356945V', '', '12340000463', 'Koala.jpg', '1991-01-01', '', 'Male', 'Single', 'Sinhala', ' ', '', 'Kegalle, Sabaragamuwa Province, Sri Lanka', ' ', ' ', '', '2015-02-11 18:38:35', 3, '2015-02-11 18:38:35', 3, 1),
(47, 'Miss.', 'Anika Morpus', 'Anika', '901254789V', '', '12340000471', 'null', '1990-01-01', '', 'Female', 'Single', 'Sinhala', ' ', '', 'Athurugiriya, Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-06-25 13:41:23', 3, '2015-06-25 13:41:23', 3, 1),
(48, 'Mr.', 'Hamesha De Silva', 'Hamesha', '895647213V', '', '12340000489', 'null', '1989-11-29', '', 'Male', 'Single', 'Sinhala', ' ', '', 'West Bengal, India', ' ', ' ', '', '2015-06-26 16:45:53', 3, '2015-06-26 16:45:53', 3, 1),
(49, 'Miss.', 'nimali', 'thanuja', '898342344v', '12345555', '12340000491', 'abc.jpg', '1989-11-29', '0712345678', 'Female', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo 03, Colombo, Western Province, Sri Lanka', 'dilshan', '4325434324', 'daswsr', '2015-07-23 14:49:33', 3, '2015-07-23 14:49:33', 3, 1),
(50, 'Mr.', 'Rohan', 'Gamage', '898342344v', '12345555', '12340000509', 'abc.jpg', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', 'dilshan', '4325434324', '', '2015-07-23 15:14:53', 3, '2015-07-23 15:14:53', 3, 1),
(51, 'Mr.', 'sankalpaaa', 'udarangaa', '898342344v', '', 'null', 'abc.jpg', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', '  srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', '  dilshan', '  4325434324', 'wsd', '2015-07-23 15:56:08', 3, '2015-07-23 16:01:44', 3, 1),
(52, 'Mr.', 'thiru', 'fonseka', '898342344v', '12345555', '12340000525', 'null', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'AB', 'Col TG Jayawardena Mawatha, Colombo, Western Province, Sri Lanka', 'dilshan', '1231231231', '', '2015-07-23 16:40:27', 3, '2015-07-23 16:40:27', 3, 1),
(53, 'Mr.', 'chanka', 'palliyaguru', '898342344v', '12345555', '12340000533', 'null', '1989-11-29', '1231231321', 'Male', 'Single', 'Sinhala', 'srilankan', 'AB', 'Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-07-23 16:41:26', 3, '2015-07-23 16:41:26', 3, 1),
(54, 'Mr.', 'janitha', 'senevirathna', '898342344v', '12345555', '12340000541', 'null', '1989-11-29', '1231231321', 'Male', 'Single', 'Sinhala', 'srilankan', 'AB', 'Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-07-23 16:42:34', 3, '2015-07-23 16:42:34', 3, 1),
(55, 'Mr.', 'sanath', 'desilva', '898342344v', '12345555', '12340000558', 'null', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', 'dilshan', '4325434324', 'wedd', '2015-07-24 09:25:43', 3, '2015-07-24 09:25:43', 3, 1),
(56, 'Mr.', 'fedew', 'jayasena', '898342344v', '12345555', '12340000566', 'null', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', 'dilshan', '1231231231', '', '2015-07-24 09:26:46', 3, '2015-07-24 09:26:46', 3, 1),
(57, 'Mr.', 'sanath', 'Aththanayaka', '898342344v', '12345555', '12340000574', 'null', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', 'dilshan', '4325434324', '', '2015-07-24 09:27:29', 3, '2015-07-24 09:27:29', 3, 1),
(58, 'Mr.', 'fedew', 'jayasena', '898342344v', '1234', '12340000582', 'abc.jpg', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-07-24 09:31:10', 3, '2015-07-24 09:31:10', 3, 1),
(59, 'Mr.', 'fedew', 'jayasena', '898342344v', '12345555', '12340000590', 'abc.jpg', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', 'dilshan', '4325434324', '', '2015-07-24 09:39:07', 3, '2015-07-24 09:39:07', 3, 1),
(60, 'Mr.', 'Mahesh', 'Gamage', '909876543v', '12345', '12340000608', 'abc.jpg', '1990-09-10', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo, Western Province, Sri Lanka', 'dilshan', '0987654321', '', '2015-07-24 09:48:17', 3, '2015-07-24 09:48:17', 3, 1),
(61, 'Mr.', 'wimarshana', 'madubashana', '909876543v', '', 'null', 'michael-asmar.jpg', '1990-09-10', '0712345678', 'Male', 'Single', 'Sinhala', ' srilankan', 'O+', 'Colombo, Western Province, Sri Lanka', ' dilshan', ' 0987654321', '', '2015-07-28 11:24:32', 3, '2015-07-28 11:26:06', 3, 1),
(62, 'Mr.', 'Gayan', 'jayasena', '898342344v', '12345555', '12340000624', 'michael-asmar.jpg', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombia', ' ', ' ', '', '2015-07-30 10:07:02', 3, '2015-07-30 10:07:02', 3, 1),
(63, 'Mr.', 'Dinesh', 'Jayathilaka', '901254789V', '9018181818', '12340000632', 'null', '1990-01-01', '', 'Male', 'Single', 'English', ' Sri Lnakan', 'AB', 'Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-07-30 11:15:02', 3, '2015-07-30 11:15:02', 3, 1),
(64, 'Mr.', 'Dinesh', 'Nishan', '901254789V', '', 'null', 'photo.jpg.png', '1990-01-01', '0112700700', 'Male', 'Single', 'Sinhala', '    Sri Lnakan', 'A+', 'Colombo, Western Province, Sri Lanka', '    Jayasena', '     0112800800', 'New patient ', '2015-07-30 11:16:50', 3, '2015-07-30 11:23:26', 3, 1),
(65, 'Miss.', 'hansi', 'desilva', '901254789V', '', '12340000657', 'photo.jpg.png', '1990-01-01', '0112700700', 'Male', 'Single', 'Sinhala', 'Sri Lnakan', 'A+', 'Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-07-30 13:20:54', 3, '2015-07-30 13:20:54', 3, 1),
(66, 'Mr.', 'Dineshg', 'desilva', '901254789V', '', 'null', 'mbuntu-6.jpg', '1991-01-01', '0112700700', 'Male', 'Single', 'Sinhala', ' Sri Lnakan', 'A+', 'Colombia', ' Jayasena', ' 0112800800', '', '2015-08-06 14:14:06', 3, '2015-08-06 14:14:34', 3, 1),
(67, 'Miss.', 'sanath', 'jayasena', '898342344v', '', '12340000673', 'Profile-Photo-Christos-Mastoras-21.png', '1989-11-29', '0712345678', 'Female', 'Married', 'Tamil', 'srilankan', 'A+', 'Poland', 're', '4325434324', 'hkj', '2015-09-14 10:44:04', 3, '2015-09-14 10:44:04', 3, 1),
(68, 'Mr.', 'sanath', 'Aththanayaka', '898342344v', '', '12340000681', 'd9.png', '1989-11-29', '0712345678', 'Male', 'Single', 'Sinhala', 'srilankan', 'A+', 'Colombo 03, Colombo, Western Province, Sri Lanka', ' ', ' ', '', '2015-09-14 12:44:02', 3, '2015-09-14 12:44:02', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_allergy`
--

CREATE TABLE IF NOT EXISTS `opd_patient_allergy` (
  `allergy_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `allergy_name` varchar(500) NOT NULL,
  `allergy_status` varchar(500) NOT NULL,
  `allergy_remarks` varchar(500) NOT NULL,
  `allergy_create_date` datetime NOT NULL,
  `allergy_create_user` int(11) NOT NULL,
  `allergy_lastupdate_date` datetime NOT NULL,
  `allergy_lastupdate_user` int(11) NOT NULL,
  `allergy_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient_allergy`
--

INSERT INTO `opd_patient_allergy` (`allergy_id`, `patient_id`, `allergy_name`, `allergy_status`, `allergy_remarks`, `allergy_create_date`, `allergy_create_user`, `allergy_lastupdate_date`, `allergy_lastupdate_user`, `allergy_active`) VALUES
(1, 1, 'Peanut Allergy', 'Current', 'rwedg', '2015-08-03 16:02:05', 3, '2015-07-23 16:02:05', 3, 1),
(2, 60, 'Peanut Allergy', 'Past', '', '2015-07-24 09:49:27', 3, '2015-07-24 09:49:27', 3, 1),
(3, 61, 'Peanut Allergy', 'Past', '', '2015-07-28 11:26:19', 3, '2015-07-28 11:26:19', 3, 1),
(4, 62, 'Peanut Allergy', 'Past', '', '2015-07-30 10:07:35', 3, '2015-07-30 10:07:35', 3, 1),
(5, 64, 'Headach', 'Past', 'first time', '2015-07-30 11:17:33', 3, '2015-07-30 11:17:33', 3, 1),
(6, 1, 'peanut', 'Past', '', '2015-08-03 15:23:40', 1, '2015-08-03 15:23:40', 1, 1),
(7, 1, 'Headach', 'Current', 'ddadadadada', '2015-08-03 15:42:18', 1, '2015-08-03 15:42:18', 1, 1),
(8, 11, 'Headach', 'Past', 'new', '2015-08-04 09:29:26', 1, '2015-08-04 09:29:26', 1, 1),
(9, 11, 'peanut', 'Past', 'new', '2015-08-04 09:29:39', 1, '2015-08-04 09:29:39', 1, 1),
(10, 11, 'Headach', 'Past', 'ABCD', '2015-08-04 11:38:23', 1, '2015-08-04 11:38:23', 1, 1),
(11, 11, 'Sick', 'Past', 'first time', '2015-08-04 16:25:43', 1, '2015-08-04 16:25:43', 1, 1),
(12, 1, 'Caugh', 'Past', '3weeks', '2015-08-05 09:00:51', 1, '2015-08-05 09:00:51', 1, 1),
(13, 11, 'Headach', 'Past', 'old one', '2015-08-05 09:30:24', 1, '2015-08-05 09:30:24', 1, 1),
(14, 11, 'Kneey Ingery', 'Past', 'new one', '2015-08-05 11:08:32', 1, '2015-08-05 11:08:32', 1, 1),
(15, 11, 'Caugh and Sick', 'Past', 'Little one', '2015-08-05 11:11:20', 1, '2015-08-05 11:11:20', 1, 1),
(16, 11, 'peanut', 'Past', 'fdfdsdfsf', '2015-08-05 11:40:47', 1, '2015-08-05 11:40:47', 1, 1),
(17, 11, 'Caughh', 'Past', '', '2015-08-05 12:14:56', 1, '2015-08-05 12:14:56', 1, 1),
(18, 14, 'Headach', 'Past', '', '2015-08-05 12:30:07', 1, '2015-08-05 12:30:07', 1, 1),
(19, 14, 'Caugh', 'Past', '', '2015-08-05 12:33:19', 1, '2015-08-05 12:33:19', 1, 1),
(20, 10, 'Caugh and Sick', 'Past', '', '2015-08-05 12:50:05', 1, '2015-08-05 12:50:05', 1, 1),
(21, 54, 'Headach', 'Past', '', '2015-08-05 16:38:45', 1, '2015-08-05 16:38:45', 1, 1),
(22, 14, 'peanut', 'Past', 'fdfdfdfd', '2015-08-06 10:37:01', 1, '2015-08-06 10:37:01', 1, 1),
(23, 11, 'LOL', 'Past', 'fdfdgdgd', '2015-08-06 11:19:19', 3, '2015-08-06 11:19:19', 3, 1),
(24, 65, 'Caugh and Sick', 'Past', 'klklkjl', '2015-08-06 11:40:21', 1, '2015-08-06 11:40:21', 1, 1),
(25, 66, 'Headach', 'Past', '', '2015-08-06 14:14:44', 3, '2015-08-06 14:14:44', 3, 1),
(26, 6, 'peanut', 'Past', '', '2015-08-06 14:18:29', 1, '2015-08-06 14:18:29', 1, 1),
(27, 8, 'Headach', 'Past', 'dgf', '2015-08-12 12:05:00', 1, '2015-08-12 12:05:00', 1, 1),
(28, 2, 'bingun', 'Current', 'dangerous', '2015-09-05 14:41:07', 3, '2015-09-05 14:41:07', 3, 1),
(29, 5, 'Peanut Allergy', 'Past', 'pp', '2015-09-14 09:57:41', 1, '2015-09-14 09:57:41', 1, 1),
(30, 51, 'pplp', 'Past', '', '2015-09-14 10:27:27', 1, '2015-09-14 10:27:27', 1, 1),
(31, 68, 'two Allergy', 'Past', '', '2015-09-14 12:44:20', 3, '2015-09-14 12:44:20', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_attachment`
--

CREATE TABLE IF NOT EXISTS `opd_patient_attachment` (
  `attachment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `attachment_type` varchar(500) NOT NULL,
  `attachment_attached_by` int(11) NOT NULL,
  `attachment_description` varchar(500) NOT NULL,
  `attachment_name` varchar(500) NOT NULL,
  `attachment_link` varchar(500) NOT NULL,
  `attachment_create_date` datetime NOT NULL,
  `attachment_create_user` int(11) NOT NULL,
  `attachment_last_update_date` datetime NOT NULL,
  `attachment_last_update_user` int(11) NOT NULL,
  `attachment_active` int(11) NOT NULL,
  `attachment_comment` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient_attachment`
--

INSERT INTO `opd_patient_attachment` (`attachment_id`, `patient_id`, `attachment_type`, `attachment_attached_by`, `attachment_description`, `attachment_name`, `attachment_link`, `attachment_create_date`, `attachment_create_user`, `attachment_last_update_date`, `attachment_last_update_user`, `attachment_active`, `attachment_comment`) VALUES
(1, 60, 'null', 3, 'note', 'Attachment', '/opt/lampp/htdocs/SEP_Project/uploads/proposal1.pdf', '2015-07-24 09:50:29', 3, '2015-07-24 09:50:29', 3, 1, 'null'),
(2, 61, 'null', 3, '', 'PDF', '/opt/lampp/htdocs/SEP_Project/uploads/proposal2.pdf', '2015-07-28 11:26:55', 3, '2015-07-28 11:26:55', 3, 1, 'null'),
(3, 62, 'null', 3, '', 'kkk', '/opt/lampp/htdocs/SEP_Project/uploads/proposal4.pdf', '2015-07-30 10:08:03', 3, '2015-07-30 10:08:03', 3, 1, 'null'),
(4, 10, 'null', 1, '', 'Attachment', '/opt/lampp/htdocs/SEP_Project/uploads/proposal5.pdf', '2015-07-30 11:10:00', 1, '2015-07-30 11:10:00', 1, 1, 'null'),
(5, 10, 'null', 1, '', 'Attachment', '/opt/lampp/htdocs/SEP_Project/uploads/proposal6.pdf', '2015-07-30 11:10:53', 1, '2015-07-30 11:10:53', 1, 1, 'null'),
(6, 10, 'null', 1, 'llllllllllllllllllllllllllllll', 'g', '/opt/lampp/htdocs/SEP_Project/uploads/background.jpg', '2015-07-30 11:11:20', 1, '2015-07-30 11:11:20', 1, 1, 'null'),
(7, 64, 'null', 3, 'sss', 'hk', '/opt/lampp/htdocs/SEP_Project/uploads/photo.jpg.png', '2015-07-30 11:23:16', 3, '2015-07-30 11:23:16', 3, 1, 'null'),
(8, 11, 'null', 1, 'ssss', 'sss', '/opt/lampp/htdocs/SEP_Project/uploads/Screenshot_from_2015-07-30_11:46:42.png', '2015-08-04 10:43:27', 1, '2015-08-04 10:43:27', 1, 1, 'null'),
(9, 11, 'null', 1, 'Today one', 'New Image', '/opt/lampp/htdocs/SEP_Project/uploads/mbuntu-default.jpg', '2015-08-05 09:20:10', 1, '2015-08-05 09:20:10', 1, 1, 'null'),
(10, 66, 'null', 3, '', ' vcb', '/opt/lampp/htdocs/SEP_Project/uploads/mbuntu-7.jpg', '2015-08-06 14:15:00', 3, '2015-08-06 14:15:00', 3, 1, 'null'),
(11, 6, 'null', 1, '', 'hcvch', '/opt/lampp/htdocs/SEP_Project/uploads/mbuntu-6.jpg', '2015-08-06 14:18:53', 1, '2015-08-06 14:18:53', 1, 1, 'null');

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_examination`
--

CREATE TABLE IF NOT EXISTS `opd_patient_examination` (
  `examination_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `examination_date` datetime NOT NULL,
  `examination_weight` double NOT NULL,
  `examination_height` double NOT NULL,
  `examination_bmi` double NOT NULL,
  `examination_sysBP` double NOT NULL,
  `examination_diastBP` double NOT NULL,
  `examination_temprature` double NOT NULL,
  `examination_create_date` datetime NOT NULL,
  `examination_create_user` int(11) NOT NULL,
  `examination_lastupdate_date` datetime NOT NULL,
  `examination_lastupdate_user` int(11) NOT NULL,
  `examination_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient_examination`
--

INSERT INTO `opd_patient_examination` (`examination_id`, `visit_id`, `examination_date`, `examination_weight`, `examination_height`, `examination_bmi`, `examination_sysBP`, `examination_diastBP`, `examination_temprature`, `examination_create_date`, `examination_create_user`, `examination_lastupdate_date`, `examination_lastupdate_user`, `examination_active`) VALUES
(1, 1, '2015-08-03 15:15:44', 30, 120, 20.833333333333336, 51, 31, 96.01, '2015-07-23 15:15:44', 1, '2015-07-23 15:15:44', 1, 1),
(2, 5, '2015-07-23 15:57:07', 20, 130, 11.834319526627217, 50, 32, 96.01, '2015-07-23 15:57:07', 1, '2015-07-23 15:57:07', 1, 1),
(3, 7, '2015-07-24 09:42:57', 0.09, 15.09, 3.952428569734673, 52, 31, 96.02, '2015-07-24 09:42:57', 1, '2015-07-24 09:42:57', 1, 1),
(4, 9, '2015-07-24 09:54:11', 52, 180, 16.049382716049383, 53, 34, 96.02, '2015-07-24 09:54:11', 1, '2015-07-24 09:54:11', 1, 1),
(5, 14, '2015-07-24 10:19:08', 45, 150, 20, 53, 33, 96.02, '2015-07-24 10:19:08', 1, '2015-07-24 10:19:08', 1, 1),
(6, 16, '2015-07-27 09:07:10', 50, 160, 19.531249999999996, 53, 33, 96.04, '2015-07-27 09:07:10', 1, '2015-07-27 09:07:10', 1, 1),
(7, 17, '2015-07-27 11:56:17', 40, 180, 12.345679012345679, 54, 35, 96.05, '2015-07-27 11:56:17', 1, '2015-07-27 11:56:17', 1, 1),
(8, 19, '2015-07-28 11:30:18', 50, 140, 25.510204081632658, 53, 32, 96.02, '2015-07-28 11:30:18', 1, '2015-07-28 11:30:18', 1, 1),
(9, 21, '2015-07-28 12:09:55', 45, 160, 17.578124999999996, 54, 33, 96.05, '2015-07-28 12:09:55', 1, '2015-07-28 12:09:55', 1, 1),
(10, 27, '2015-07-30 10:21:29', 50, 180, 15.432098765432098, 52, 32, 96.02, '2015-07-30 10:21:29', 1, '2015-07-30 10:21:29', 1, 1),
(11, 32, '2015-07-30 11:03:49', 54, 166, 19.5964581216432, 53, 30, 98, '2015-07-30 11:03:49', 1, '2015-07-30 11:03:49', 1, 1),
(12, 36, '2015-07-30 14:02:51', 50, 180, 15.432098765432098, 53, 32, 96.03, '2015-07-30 14:02:51', 1, '2015-07-30 14:02:51', 1, 1),
(13, 51, '2015-08-05 11:54:00', 45, 150, 20, 52, 32, 96.02, '2015-08-05 11:54:00', 1, '2015-08-05 11:54:00', 1, 1),
(14, 67, '2015-08-06 14:16:10', 50, 180, 15.432098765432098, 52, 32, 96, '2015-08-06 14:16:10', 1, '2015-08-06 14:16:10', 1, 1),
(15, 71, '2015-08-12 12:04:06', 45, 180, 13.888888888888888, 55, 34, 96.02, '2015-08-12 12:04:06', 1, '2015-08-12 12:04:06', 1, 1),
(16, 80, '2015-09-18 13:26:55', 0.05, 15.02, 2.21630812711325, 51, 31, 96.02, '2015-09-18 13:26:55', 1, '2015-09-18 13:26:55', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_history`
--

CREATE TABLE IF NOT EXISTS `opd_patient_history` (
  `history_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `history_category` varchar(500) NOT NULL,
  `history_record` varchar(500) NOT NULL,
  `history_create_date` datetime NOT NULL,
  `history_create_user` int(11) NOT NULL,
  `history_lastupdate_date` datetime NOT NULL,
  `history_lastupdate_user` int(11) NOT NULL,
  `history_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_queue`
--

CREATE TABLE IF NOT EXISTS `opd_patient_queue` (
  `queue_token_no` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `queue_assign_time` datetime NOT NULL,
  `queue_assign_by` int(11) NOT NULL,
  `queue_assign_to` int(11) NOT NULL,
  `queue_status` varchar(500) NOT NULL,
  `queue_remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient_queue`
--

INSERT INTO `opd_patient_queue` (`queue_token_no`, `patient_id`, `queue_assign_time`, `queue_assign_by`, `queue_assign_to`, `queue_status`, `queue_remarks`) VALUES
(1, 1, '2015-07-23 12:18:50', 3, 1, 'Delete', 'Knee Injury'),
(2, 50, '2015-07-23 15:15:07', 3, 1, 'Delete', ''),
(3, 51, '2015-07-23 15:56:20', 3, 1, 'Delete', ''),
(4, 1, '2015-07-23 16:30:36', 3, 1, 'Delete', ''),
(1, 57, '2015-07-24 09:44:33', 3, 1, 'Delete', ''),
(2, 60, '2015-07-24 09:48:45', 3, 1, 'Delete', ''),
(3, 7, '2015-07-24 10:00:17', 3, 1, 'Delete', ''),
(4, 60, '2015-07-24 10:03:29', 3, 1, 'Delete', ''),
(5, 57, '2015-07-24 10:03:50', 3, 1, 'Delete', ''),
(6, 60, '2015-07-24 10:18:07', 3, 1, 'Delete', ''),
(1, 60, '2015-07-27 09:03:30', 3, 1, 'Delete', ''),
(2, 57, '2015-07-27 09:04:43', 3, 1, 'Delete', ''),
(3, 54, '2015-07-27 11:40:11', 3, 1, 'Delete', ''),
(4, 53, '2015-07-27 11:53:16', 3, 1, 'Delete', ''),
(1, 61, '2015-07-28 11:28:26', 3, 1, 'Delete', ''),
(2, 8, '2015-07-28 12:09:22', 3, 1, 'Delete', ''),
(3, 15, '2015-07-28 12:11:25', 3, 1, 'Delete', ''),
(4, 7, '2015-07-28 14:48:46', 3, 1, 'Delete', ''),
(5, 6, '2015-07-28 15:03:01', 3, 1, 'Delete', ''),
(6, 4, '2015-07-28 15:36:13', 3, 1, 'Delete', ''),
(1, 14, '2015-07-30 08:41:06', 3, 1, 'Delete', ''),
(2, 6, '2015-07-30 08:50:24', 3, 1, 'Delete', 'adadada'),
(3, 62, '2015-07-30 10:07:08', 3, 1, 'Delete', ''),
(4, 10, '2015-07-30 10:29:06', 3, 1, 'Delete', ''),
(5, 64, '2015-07-30 11:17:06', 3, 1, 'Delete', ''),
(6, 4, '2015-07-30 11:33:50', 3, 1, 'Delete', 'd'),
(7, 65, '2015-07-30 13:23:34', 3, 1, 'Delete', ''),
(8, 2, '2015-07-30 14:59:18', 3, 1, 'Delete', ''),
(1, 1, '2015-08-03 16:25:13', 3, 1, 'Delete', ''),
(2, 11, '2015-08-03 16:26:07', 3, 1, 'Delete', ''),
(1, 14, '2015-08-05 12:29:37', 3, 1, 'Delete', ''),
(2, 34, '2015-08-05 12:31:38', 3, 1, 'Delete', ''),
(3, 14, '2015-08-05 12:32:40', 3, 1, 'Delete', ''),
(4, 10, '2015-08-05 12:49:19', 3, 1, 'Delete', ''),
(5, 54, '2015-08-05 16:37:56', 3, 1, 'Delete', ''),
(6, 62, '2015-08-05 16:40:19', 3, 1, 'Delete', ''),
(1, 66, '2015-08-06 14:15:22', 3, 1, 'Delete', ''),
(2, 6, '2015-08-06 14:17:45', 3, 1, 'Delete', ''),
(1, 6, '2015-08-10 15:47:05', 3, 1, 'Delete', ''),
(1, 11, '2015-08-14 10:25:28', 3, 5, 'Waiting', ''),
(2, 8, '2015-08-14 10:25:40', 3, 19, 'Waiting', ''),
(3, 4, '2015-08-14 10:39:52', 3, 5, 'Delete', ''),
(4, 7, '2015-08-14 15:30:26', 3, 5, 'Waiting', ''),
(5, 15, '2015-08-14 15:31:02', 3, 7, 'Waiting', ''),
(6, 12, '2015-08-14 15:31:37', 3, 5, 'Waiting', ''),
(1, 5, '2015-08-19 09:20:46', 3, 1, 'Delete', ''),
(1, 10, '2015-08-21 09:16:40', 3, 1, 'Delete', ''),
(1, 68, '2015-09-14 12:44:09', 3, 1, 'In', ''),
(1, 3, '2015-09-18 09:16:51', 3, 1, 'Delete', '');

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_record`
--

CREATE TABLE IF NOT EXISTS `opd_patient_record` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `record_type` int(11) NOT NULL,
  `record_text` varchar(500) NOT NULL,
  `record_visibility` varchar(500) NOT NULL,
  `record_completed` int(11) NOT NULL,
  `record_create_user` int(11) NOT NULL,
  `record_create_date` datetime NOT NULL,
  `record_last_update_user` int(11) NOT NULL,
  `record_last_update_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient_record`
--

INSERT INTO `opd_patient_record` (`record_id`, `patient_id`, `record_type`, `record_text`, `record_visibility`, `record_completed`, `record_create_user`, `record_create_date`, `record_last_update_user`, `record_last_update_date`) VALUES
(1, 6, 0, '              notes', 'all', 0, 1, '2015-07-30 10:25:03', 1, '2015-07-30 10:25:03'),
(2, 1, 0, 'Need to check the blood preasure            ', 'me', 0, 1, '2015-07-30 11:28:39', 1, '2015-07-30 11:28:39'),
(3, 1, 1, 'Check the ECG              ', 'me', 0, 1, '2015-07-30 11:28:53', 1, '2015-07-30 11:28:53'),
(4, 1, 0, 'ewsdfdfdsf              ', 'me', 0, 1, '2015-08-03 16:26:15', 1, '2015-08-03 16:26:15'),
(5, 11, 0, '           fcb', 'all', 0, 1, '2015-08-03 16:26:50', 1, '2015-08-03 16:26:50'),
(6, 1, 0, '              xdf', 'all', 0, 1, '2015-08-03 16:34:38', 1, '2015-08-03 16:34:38'),
(7, 11, 1, '              gdc', 'all', 0, 1, '2015-08-04 09:13:45', 1, '2015-08-04 09:13:45'),
(8, 11, 0, 'hhhh              ', 'all', 0, 1, '2015-08-04 09:19:29', 1, '2015-08-04 09:19:29'),
(9, 11, 1, 'ddddd              ', 'all', 0, 1, '2015-08-04 09:19:48', 1, '2015-08-04 09:19:48'),
(10, 11, 0, 'kkkk              ', 'all', 0, 1, '2015-08-04 09:21:29', 1, '2015-08-04 09:21:29'),
(11, 11, 1, 'gggg              ', 'all', 0, 1, '2015-08-04 10:18:15', 1, '2015-08-04 10:18:15'),
(12, 11, 1, 'ABC', 'all', 0, 1, '2015-08-04 10:20:31', 1, '2015-08-04 10:20:31'),
(13, 6, 0, '              cch', 'all', 0, 1, '2015-08-06 14:18:13', 1, '2015-08-06 14:18:13'),
(14, 6, 1, '              jbv j', 'all', 0, 1, '2015-08-06 14:20:30', 1, '2015-08-06 14:20:30'),
(15, 10, 1, '              Get Blood Test', 'me', 0, 1, '2015-08-21 09:21:04', 1, '2015-08-21 09:21:04'),
(16, 10, 0, '              fgcgc', 'all', 0, 1, '2015-08-21 10:06:46', 1, '2015-08-21 10:06:46'),
(17, 10, 1, '       dqawszdw       ', 'all', 0, 1, '2015-08-21 10:07:26', 1, '2015-08-21 10:07:26'),
(18, 10, 0, '              fcdx c', 'all', 0, 1, '2015-08-21 10:07:55', 1, '2015-08-21 10:07:55'),
(19, 10, 1, '              bfc b', 'all', 0, 1, '2015-08-21 10:08:14', 1, '2015-08-21 10:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_visit`
--

CREATE TABLE IF NOT EXISTS `opd_patient_visit` (
  `visit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `visit_date` datetime NOT NULL,
  `visit_complaint` varchar(500) NOT NULL,
  `visit_doctor` int(11) NOT NULL,
  `visit_remarks` varchar(500) NOT NULL,
  `visit_create_user` int(11) NOT NULL,
  `visit_last_update_date` datetime NOT NULL,
  `visit_last_update_user` int(11) NOT NULL,
  `visit_type` varchar(255) NOT NULL,
  `visit_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_patient_visit`
--

INSERT INTO `opd_patient_visit` (`visit_id`, `patient_id`, `visit_date`, `visit_complaint`, `visit_doctor`, `visit_remarks`, `visit_create_user`, `visit_last_update_date`, `visit_last_update_user`, `visit_type`, `visit_active`) VALUES
(1, 1, '2015-08-03 12:19:20', 'Knee Injury', 1, 'Knee Injury                            ', 1, '2015-07-23 12:19:20', 1, 'OPD', 0),
(2, 1, '2015-07-23 12:51:46', 'Knee Injury', 1, 'Knee Injury', 1, '2015-07-23 12:51:46', 1, 'OPD', 0),
(3, 1, '2015-07-23 13:32:49', 'Neck Injury', 1, 'Knee Injury                                                        ', 1, '2015-07-23 13:33:50', 1, 'OPD', 0),
(4, 50, '2015-07-23 15:15:23', 'rasangi', 1, '                            ', 1, '2015-07-23 15:15:23', 1, 'OPD', 0),
(5, 51, '2015-07-23 15:56:45', 'lol', 1, '                                                        ', 1, '2015-09-14 10:26:36', 1, 'OPD', 0),
(6, 1, '2015-07-23 16:30:50', 'BCD', 1, '                            ', 1, '2015-07-23 16:30:50', 1, 'OPD', 0),
(7, 1, '2015-07-24 09:42:32', 'sahan', 1, '                            ', 1, '2015-07-24 09:42:32', 1, 'OPD', 0),
(8, 57, '2015-07-24 09:51:59', 'sahan', 1, '                            ', 1, '2015-07-24 09:51:59', 1, 'OPD', 0),
(9, 60, '2015-07-24 09:52:22', 'Knee Injury', 1, 'note', 1, '2015-07-24 09:52:22', 1, 'OPD', 0),
(10, 7, '2015-07-24 10:00:33', 'headach', 1, '                            ', 1, '2015-07-24 10:00:33', 1, 'OPD', 0),
(11, 7, '2015-07-24 10:02:46', 'Knee Injury', 1, '                            ', 1, '2015-07-24 10:02:46', 1, 'OPD', 0),
(12, 60, '2015-07-24 10:04:04', 'Knee Injury', 1, '                            ', 1, '2015-07-24 10:04:04', 1, 'OPD', 0),
(13, 57, '2015-07-24 10:05:19', 'sahan', 1, '                            ', 1, '2015-07-24 10:05:19', 1, 'OPD', 0),
(14, 60, '2015-07-24 10:18:18', 'Knee Injury', 1, '                            ', 1, '2015-07-24 10:18:18', 1, 'OPD', 0),
(15, 60, '2015-07-24 16:41:42', 'Knee Injury', 1, '                            ', 1, '2015-07-24 16:41:42', 1, 'OPD', 0),
(16, 57, '2015-07-24 16:42:51', 'Knee Injury', 1, '                            ', 1, '2015-07-24 16:42:51', 1, 'OPD', 0),
(17, 53, '2015-07-27 23:51:43', 'rasangi', 1, '                            ', 1, '2015-07-27 23:51:43', 1, 'OPD', 0),
(18, 53, '2015-07-27 23:55:33', 'rasangi', 1, '                            ', 1, '2015-07-27 23:55:33', 1, 'OPD', 0),
(19, 61, '2015-07-28 11:29:55', 'Knee Injury', 1, '                            ', 1, '2015-07-28 11:29:55', 1, 'OPD', 0),
(20, 61, '2015-07-28 12:05:52', 'Knee Injury', 1, '                            ', 1, '2015-07-28 12:05:52', 1, 'OPD', 0),
(21, 8, '2015-07-28 12:09:32', 'Knee Injury', 1, '                            ', 1, '2015-07-28 12:09:32', 1, 'OPD', 0),
(22, 15, '2015-07-28 14:48:26', 'rasangi', 1, '                            ', 1, '2015-07-28 14:48:26', 1, 'OPD', 0),
(23, 7, '2015-07-28 15:03:23', 'rasangi', 1, '                            ', 1, '2015-07-28 15:03:23', 1, 'OPD', 0),
(24, 14, '2015-07-29 17:07:05', 'Knee Injury', 1, '                            ', 1, '2015-07-29 17:07:05', 1, 'OPD', 0),
(25, 6, '2015-07-29 17:07:23', 'Knee Injury', 1, '                            ', 1, '2015-07-29 17:07:23', 1, 'OPD', 0),
(26, 6, '2015-07-29 17:13:08', 'Knee Injury', 1, 'sdsdsadasdsadsadsafd', 1, '2015-07-29 17:13:08', 1, 'OPD', 0),
(27, 62, '2015-07-30 10:20:12', 'Knee Injury', 1, '                            ', 1, '2015-07-30 10:20:12', 1, 'OPD', 0),
(28, 6, '2015-07-30 10:23:22', 'Knee Injury', 1, '                            ', 1, '2015-07-30 10:23:22', 1, 'OPD', 0),
(29, 6, '2015-07-30 10:25:29', 'Knee Injury', 1, '                            ', 1, '2015-07-30 10:25:29', 1, 'OPD', 0),
(30, 10, '2015-07-30 10:29:20', 'Knee Injury', 1, '                            ', 1, '2015-07-30 10:29:20', 1, 'OPD', 0),
(31, 10, '2015-07-30 10:56:45', 'Knee Injury', 1, '                            ', 1, '2015-07-30 10:56:45', 1, 'OPD', 0),
(32, 10, '2015-07-30 11:01:20', 'Headach', 1, 'For the first time                             ', 1, '2015-07-30 11:01:20', 1, 'OPD', 0),
(33, 10, '2015-07-30 11:19:32', 'Knee Injury', 1, '                            ', 1, '2015-07-30 11:19:32', 1, 'OPD', 0),
(34, 65, '2015-07-30 13:44:22', 'Knee Injury', 1, '                            ', 1, '2015-07-30 13:44:22', 1, 'OPD', 0),
(35, 65, '2015-07-30 13:44:22', 'Knee Injury cougf', 1, '                            ', 1, '2015-07-30 13:44:22', 1, 'OPD', 0),
(36, 1, '2015-07-30 13:53:04', 'Knee Injury', 1, '                            ', 1, '2015-07-30 13:53:04', 1, 'OPD', 0),
(37, 1, '2015-07-30 14:05:36', 'Knee Injury', 1, '                            ', 1, '2015-07-30 14:05:36', 1, 'OPD', 0),
(38, 4, '2015-07-30 14:07:13', 'Knee Injury', 1, '                            ', 1, '2015-07-30 14:07:13', 1, 'OPD', 0),
(39, 4, '2015-07-30 14:09:28', 'Knee Injury', 1, '                            ', 1, '2015-07-30 14:09:28', 1, 'OPD', 0),
(40, 4, '2015-07-30 14:15:12', 'Knee Injury', 1, '                            ', 1, '2015-07-30 14:15:12', 1, 'OPD', 0),
(41, 50, '2015-07-30 14:55:33', 'Knee Injury', 1, '                            ', 1, '2015-07-30 14:55:33', 1, 'OPD', 0),
(42, 50, '2015-07-30 14:56:08', 'Knee Injury', 1, '                            ', 1, '2015-07-30 14:56:08', 1, 'OPD', 0),
(43, 2, '2015-07-30 14:59:27', 'wasantha', 1, '                            ', 1, '2015-07-30 14:59:27', 1, 'OPD', 0),
(44, 11, '2015-08-03 17:12:26', 'Knee Injury', 1, '                            ', 1, '2015-08-03 17:12:26', 1, 'OPD', 0),
(45, 11, '2015-08-04 11:34:55', 'Knee Injury', 1, ' new one                           ', 1, '2015-08-04 11:34:55', 1, 'OPD', 0),
(46, 11, '2015-08-04 11:38:35', 'Knee Injury', 1, 'BBBBBBB                            ', 1, '2015-08-04 11:38:35', 1, 'OPD', 0),
(47, 11, '2015-08-04 16:06:15', 'Knee Injury', 1, '                            ', 1, '2015-08-04 16:06:15', 1, 'OPD', 0),
(48, 1, '2015-08-04 16:18:25', 'EFG', 1, '  6y6yty                          ', 1, '2015-08-04 16:18:25', 1, 'OPD', 0),
(49, 11, '2015-08-05 11:32:24', 'ABC', 1, '                            ', 1, '2015-08-05 11:32:24', 1, 'OPD', 0),
(50, 11, '2015-08-05 11:41:01', 'EFG', 1, 'ffdfsfdsf', 1, '2015-08-05 11:41:01', 1, 'OPD', 0),
(51, 11, '2015-08-05 11:53:33', 'ABC', 1, '                            ', 1, '2015-08-05 11:53:33', 1, 'OPD', 0),
(52, 11, '2015-08-05 12:14:36', 'ABC', 1, '                            ', 1, '2015-08-05 12:14:36', 1, 'OPD', 0),
(53, 11, '2015-08-05 12:15:07', 'ABC', 1, '                            ', 1, '2015-08-05 12:15:07', 1, 'OPD', 0),
(54, 14, '2015-08-05 12:30:14', 'ABC', 1, '                            ', 1, '2015-08-05 12:30:14', 1, 'OPD', 0),
(55, 14, '2015-08-05 12:33:29', 'ABC', 1, '                            ', 1, '2015-08-05 12:33:29', 1, 'OPD', 0),
(56, 11, '2015-08-05 12:42:17', 'Knee Injury', 1, ' fdsfds                           ', 1, '2015-08-05 12:42:17', 1, 'OPD', 0),
(57, 10, '2015-08-05 12:49:44', 'ABC', 1, '                            ', 1, '2015-08-05 12:49:44', 1, 'OPD', 0),
(58, 10, '2015-08-05 12:50:19', 'ABC', 1, '                            ', 1, '2015-08-05 12:50:19', 1, 'OPD', 0),
(59, 10, '2015-08-05 13:04:50', 'ABC', 1, '                            ', 1, '2015-08-05 13:04:50', 1, 'OPD', 0),
(60, 34, '2015-08-05 14:00:59', 'BCD', 1, '                            ', 1, '2015-08-05 14:00:59', 1, 'OPD', 0),
(61, 34, '2015-08-05 14:00:59', 'ABC', 1, '                            ', 1, '2015-08-05 14:00:59', 1, 'OPD', 0),
(62, 14, '2015-08-05 14:12:41', 'BCD', 1, '                            ', 1, '2015-08-05 14:12:41', 1, 'OPD', 0),
(63, 14, '2015-08-05 14:22:39', 'BCD', 1, '                            ', 1, '2015-08-05 14:22:39', 1, 'OPD', 0),
(64, 54, '2015-08-05 16:38:10', 'ABC', 1, '                            ', 1, '2015-08-05 16:38:10', 1, 'OPD', 0),
(65, 14, '2015-08-06 11:08:05', 'Pissu', 1, 'sdsdddada                            ', 1, '2015-08-06 11:08:05', 1, 'OPD', 0),
(66, 62, '2015-08-06 12:05:35', 'Knee Injury', 1, 'dfdffd', 1, '2015-08-06 12:05:35', 1, 'OPD', 0),
(67, 66, '2015-08-06 14:15:44', 'ABC', 1, '                            ', 1, '2015-08-06 14:15:44', 1, 'OPD', 0),
(68, 6, '2015-08-06 14:19:14', 'ABC', 1, '                            ', 1, '2015-08-06 14:19:14', 1, 'OPD', 0),
(69, 6, '2015-08-10 15:48:08', 'Knee Injury', 1, '                            ', 1, '2015-08-10 15:48:08', 1, 'OPD', 0),
(70, 6, '2015-08-10 15:50:26', 'Knee Injury', 1, '                            ', 1, '2015-08-10 15:50:26', 1, 'OPD', 0),
(71, 8, '2015-08-12 12:01:39', 'Knee Injury', 1, '                            ', 1, '2015-08-12 12:01:39', 1, 'OPD', 0),
(72, 8, '2015-08-12 12:05:19', 'Knee Injury', 1, '                            ', 1, '2015-08-12 12:05:19', 1, 'OPD', 0),
(73, 8, '2015-08-13 15:03:14', 'Knee Injury', 1, '                            ', 1, '2015-08-13 15:03:14', 1, 'OPD', 0),
(74, 5, '2015-08-19 09:21:10', 'Knee Injury', 1, '                            ', 1, '2015-08-19 09:21:10', 1, 'OPD', 0),
(75, 5, '2015-08-19 09:27:44', 'Knee Injury', 1, '                            ', 1, '2015-08-19 09:27:44', 1, 'OPD', 0),
(76, 10, '2015-08-21 09:18:19', 'Knee Injury', 1, '                            ', 1, '2015-08-21 09:18:19', 1, 'OPD', 0),
(77, 5, '2015-09-14 09:56:39', 'rasangi', 1, 'iji', 1, '2015-09-14 09:56:39', 1, 'OPD', 0),
(78, 10, '2015-09-14 10:02:40', 'wqe', 1, '                            qew', 1, '2015-09-14 10:02:40', 1, 'OPD', 0),
(79, 68, '2015-09-14 12:45:51', 'BCD', 1, '                            asdsad', 1, '2015-09-14 12:45:51', 1, 'OPD', 0),
(80, 3, '2015-09-18 13:25:38', 'ABC', 1, '                            ', 1, '2015-09-18 13:25:38', 1, 'OPD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opd_prescription`
--

CREATE TABLE IF NOT EXISTS `opd_prescription` (
  `prescription_id` int(11) NOT NULL,
  `visit_id` int(11) DEFAULT NULL,
  `prescription_prescribed_by` int(11) DEFAULT NULL,
  `prescription_date` date DEFAULT NULL,
  `prescription_status` varchar(500) DEFAULT NULL,
  `prescription_create_date` date DEFAULT NULL,
  `prescription_create_user` int(11) DEFAULT NULL,
  `prescription_last_update_date` date DEFAULT NULL,
  `prescription_last_update_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_prescription`
--

INSERT INTO `opd_prescription` (`prescription_id`, `visit_id`, `prescription_prescribed_by`, `prescription_date`, `prescription_status`, `prescription_create_date`, `prescription_create_user`, `prescription_last_update_date`, `prescription_last_update_user`) VALUES
(1, 3, 1, '2015-07-23', '1', '2015-07-23', 1, '2015-07-23', 1),
(2, 6, 1, '2015-07-23', '0', '2015-07-23', 1, '2015-07-23', 1),
(3, 10, 1, '2015-07-24', '0', '2015-07-24', 1, '2015-07-24', 1),
(4, 12, 1, '2015-07-24', '0', '2015-07-24', 1, '2015-07-24', 1),
(5, 16, 1, '2015-07-27', '0', '2015-07-27', 1, '2015-07-27', 1),
(6, 27, 1, '2015-07-30', '1', '2015-07-30', 1, '2015-07-30', 1),
(7, 32, 1, '2015-07-30', '0', '2015-07-30', 1, '2015-07-30', 1),
(8, 32, 1, '2015-07-30', '1', '2015-07-30', 1, '2015-07-30', 1),
(9, 36, 1, '2015-07-30', '0', '2015-07-30', 1, '2015-07-30', 1),
(10, 39, 1, '2015-07-30', '1', '2015-07-30', 1, '2015-07-30', 1),
(11, 40, 1, '2015-07-30', '0', '2015-07-30', 1, '2015-07-30', 1),
(12, 68, 1, '2015-08-06', '0', '2015-08-06', 1, '2015-08-06', 1),
(13, 78, 1, '2015-09-14', '0', '2015-09-14', 1, '2015-09-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `opd_prescription_item`
--

CREATE TABLE IF NOT EXISTS `opd_prescription_item` (
  `prescription_item_id` int(11) NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `prescription_item_drug_id` int(11) NOT NULL,
  `prescription_item_frequency` varchar(500) DEFAULT NULL,
  `prescription_item_dosage` varchar(500) DEFAULT NULL,
  `prescription_item_period` varchar(500) DEFAULT NULL,
  `prescription_item_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_prescription_item`
--

INSERT INTO `opd_prescription_item` (`prescription_item_id`, `prescription_id`, `prescription_item_drug_id`, `prescription_item_frequency`, `prescription_item_dosage`, `prescription_item_period`, `prescription_item_quantity`) VALUES
(1, 1, 1, 'Twice a Day', '2', 'For 5 day', 20),
(2, 3, 2, 'Twice a Day', '1', 'For 2 day', 4),
(3, 4, 2, 'Twice a Day', '1', 'For 2 day', 4),
(4, 5, 1, 'Twice a Day', '1', 'For 2 day', 4),
(5, 6, 1, 'Twice a Day', '1', 'For 2 day', 4),
(6, 7, 12, ' Thrice a Day', '1', 'For 5 day', 0),
(7, 8, 12, ' Thrice a Day', '1', 'For 5 day', 0),
(8, 8, 1, 'Twice a Day', '2', 'For 4 day', 16),
(9, 9, 1, 'Twice a Day', '1', 'For 4 day', 8),
(10, 9, 1, 'Once a Day', '2', 'For 1 day', 2),
(11, 10, 1, 'Twice a Day', '1', 'For 4 day', 8),
(12, 11, 1, 'Twice a Day', '1', 'For 2 day', 4),
(13, 12, 1, 'Twice a Day', '1', 'For 4 day', 8),
(14, 13, 12, 'Twice a Day', '1', 'For 4 day', 8);

-- --------------------------------------------------------

--
-- Table structure for table `opd_question`
--

CREATE TABLE IF NOT EXISTS `opd_question` (
  `question_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `question_text` varchar(500) NOT NULL,
  `question_answer_type` varchar(500) NOT NULL,
  `question_answer_value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opd_questionanswer`
--

CREATE TABLE IF NOT EXISTS `opd_questionanswer` (
  `answer_id` int(11) NOT NULL,
  `answer_set_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opd_questionanswerset`
--

CREATE TABLE IF NOT EXISTS `opd_questionanswerset` (
  `answer_setid` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `answerSet_create_user` int(11) NOT NULL,
  `answerSet_Create_date` datetime NOT NULL,
  `answerSet_lastupdate_user` int(11) NOT NULL,
  `answerSet_lastupdate_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opd_questionnaire`
--

CREATE TABLE IF NOT EXISTS `opd_questionnaire` (
  `questionnaire_id` int(11) NOT NULL,
  `questionnaire_name` varchar(500) NOT NULL,
  `questionnaire_relateTo` varchar(500) NOT NULL,
  `questionnaire_remarks` varchar(500) NOT NULL,
  `questionnaire_create_date` datetime NOT NULL,
  `questionnaire_create_user` int(11) NOT NULL,
  `questionnaire_lastupdate_date` datetime NOT NULL,
  `questionnaire_lastupdate_user` int(11) NOT NULL,
  `questionnaire_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_admition`
--

CREATE TABLE IF NOT EXISTS `pcu_admition` (
  `admition_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `admition_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_expireditems`
--

CREATE TABLE IF NOT EXISTS `pcu_expireditems` (
  `s_number` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `quantity` float DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_itembatch`
--

CREATE TABLE IF NOT EXISTS `pcu_itembatch` (
  `batch_id` int(11) NOT NULL,
  `recieved_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_itembatchrelation`
--

CREATE TABLE IF NOT EXISTS `pcu_itembatchrelation` (
  `s_number` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `quantity` float DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_items`
--

CREATE TABLE IF NOT EXISTS `pcu_items` (
  `s_number` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `remark` text,
  `last_stock_recieved` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `measurement` varchar(20) DEFAULT NULL,
  `reorder_level` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_itemstockday`
--

CREATE TABLE IF NOT EXISTS `pcu_itemstockday` (
  `date` date NOT NULL,
  `stock` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_manualdispense`
--

CREATE TABLE IF NOT EXISTS `pcu_manualdispense` (
  `id` int(11) NOT NULL,
  `admition_id` int(11) NOT NULL DEFAULT '0',
  `s_number` int(11) NOT NULL DEFAULT '0',
  `dispensed_date` date DEFAULT NULL,
  `dispensed_by` int(11) DEFAULT NULL,
  `quanity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_nursenote`
--

CREATE TABLE IF NOT EXISTS `pcu_nursenote` (
  `note_id` int(11) NOT NULL,
  `pcu_patient_id` int(11) NOT NULL,
  `note_details` text NOT NULL,
  `note_by` int(11) NOT NULL,
  `note_time` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_patientsymtoms`
--

CREATE TABLE IF NOT EXISTS `pcu_patientsymtoms` (
  `symtoms_id` int(11) NOT NULL,
  `pcu_patient_id` int(11) NOT NULL,
  `symtoms_details` varchar(225) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_prescription`
--

CREATE TABLE IF NOT EXISTS `pcu_prescription` (
  `prescription_id` int(11) NOT NULL,
  `pcu_patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `prescription_details` text NOT NULL,
  `prescription_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_prescriptiondispense`
--

CREATE TABLE IF NOT EXISTS `pcu_prescriptiondispense` (
  `prescription_id` int(11) NOT NULL DEFAULT '0',
  `s_number` int(11) NOT NULL DEFAULT '0',
  `dispensed_date` date DEFAULT NULL,
  `dispensed_by` int(11) DEFAULT NULL,
  `quanity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcu_prescriptionitems`
--

CREATE TABLE IF NOT EXISTS `pcu_prescriptionitems` (
  `prescription_id` int(11) NOT NULL DEFAULT '0',
  `s_number` int(11) NOT NULL DEFAULT '0',
  `period_in_hours` float DEFAULT NULL,
  `frequency_of_drug` float DEFAULT NULL,
  `quanity` float DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pcu_prescriptionitems`
--

INSERT INTO `pcu_prescriptionitems` (`prescription_id`, `s_number`, `period_in_hours`, `frequency_of_drug`, `quanity`, `started_date`, `closed_date`, `status`) VALUES
(1, 1, 2, 2, 2, '2014-08-14', '2014-08-15', 'DISPENSED'),
(2, 2, 2, 2, 1, '2014-08-20', '2014-08-30', 'pending'),
(2, 3, 2, 2, 4, '2014-08-27', '2014-08-20', 'pending'),
(4, 2, 2, 3, 1, '2014-08-12', '2014-08-28', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pcu_requesteditems`
--

CREATE TABLE IF NOT EXISTS `pcu_requesteditems` (
  `id` int(11) NOT NULL,
  `s_number` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `requested_by` int(11) DEFAULT NULL,
  `requested_date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pcu_requesteditems`
--

INSERT INTO `pcu_requesteditems` (`id`, `s_number`, `quantity`, `requested_by`, `requested_date`, `status`) VALUES
(1, 1, 100, 3, '2014-08-21', 'PENDING'),
(2, 2, 100, 1, '2014-08-26', 'PENDING'),
(3, 3, 100, 0, '2014-08-26', 'PENDING');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pcu_viewinventory`
--
CREATE TABLE IF NOT EXISTS `pcu_viewinventory` (
`s_number` int(11)
,`name` varchar(100)
,`remark` text
,`last_stock_recieved` timestamp
,`reorder_level` float
,`tot_qty` double
);

-- --------------------------------------------------------

--
-- Table structure for table `pharm_asst_stock`
--

CREATE TABLE IF NOT EXISTS `pharm_asst_stock` (
  `drug_srno` int(11) NOT NULL,
  `drug_name` varchar(500) NOT NULL,
  `drugQty` int(5) NOT NULL,
  `requestedUserID` int(3) DEFAULT NULL,
  `updatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_asst_stock`
--

INSERT INTO `pharm_asst_stock` (`drug_srno`, `drug_name`, `drugQty`, `requestedUserID`, `updatedDate`) VALUES
(1, 'Methyldopa', 3283, 4, '2015-07-30 08:40:40'),
(2, 'Captopril', 642, 4, '2015-07-18 05:53:36'),
(12, 'Asprin', 340, 4, '2015-07-30 05:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_department`
--

CREATE TABLE IF NOT EXISTS `pharm_department` (
  `department_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_department`
--

INSERT INTO `pharm_department` (`department_name`) VALUES
('Clinic Pharmacy'),
('IPD Pharmacy'),
('LAB Pharmacy'),
('OPD Pharmacy');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_dispensedrug`
--

CREATE TABLE IF NOT EXISTS `pharm_dispensedrug` (
  `dispense_drugs_id` int(11) NOT NULL,
  `dispense_drugs_srno` int(11) NOT NULL,
  `dispense_drugs_name` varchar(500) NOT NULL,
  `dispense_drugs_batchno` varchar(500) NOT NULL DEFAULT '',
  `dispense_drugs_userid` int(11) NOT NULL,
  `dispense_drugs_dispensedate` datetime DEFAULT NULL,
  `dispense_drugs_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_dispensedrug`
--

INSERT INTO `pharm_dispensedrug` (`dispense_drugs_id`, `dispense_drugs_srno`, `dispense_drugs_name`, `dispense_drugs_batchno`, `dispense_drugs_userid`, `dispense_drugs_dispensedate`, `dispense_drugs_quantity`) VALUES
(26, 2, 'Captopril', '', 4, '2015-06-29 10:33:13', 8),
(27, 2, 'Captopril', '', 4, '2015-06-29 10:41:12', 4),
(28, 12, 'Asprin', '', 4, '2015-06-29 10:41:42', 1),
(29, 12, 'Asprin', '', 4, '2015-06-29 10:50:52', 4),
(30, 1, 'Methyldopa', '', 4, '2015-07-10 10:01:43', 0),
(31, 2, 'Captopril', '', 1, '2015-07-11 11:04:58', 0),
(32, 1, 'Methyldopa', '', 4, '2015-07-11 12:37:28', 1),
(33, 2, 'Captopril', '', 1, '2015-07-11 14:35:48', 4),
(34, 2, 'Captopril', '', 4, '2015-07-18 11:23:36', 0),
(35, 1, 'Methyldopa', '', 2, '2015-07-21 14:19:32', 16),
(36, 1, 'Methyldopa', '', 4, '2015-07-23 13:35:01', 20),
(37, 1, 'Methyldopa', '', 4, '2015-07-30 10:21:18', 4),
(38, 12, 'Asprin', '', 4, '2015-07-30 11:05:33', 0),
(39, 1, 'Methyldopa', '', 4, '2015-07-30 11:05:33', 16),
(40, 1, 'Methyldopa', '', 4, '2015-07-30 14:10:40', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pharm_dosage`
--

CREATE TABLE IF NOT EXISTS `pharm_dosage` (
  `dosage_id` int(11) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `dosage_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_dosage`
--

INSERT INTO `pharm_dosage` (`dosage_id`, `dosage`, `dosage_status`) VALUES
(1, '1/2', 1),
(2, '1', 0),
(3, '2', 0),
(4, '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drug`
--

CREATE TABLE IF NOT EXISTS `pharm_drug` (
  `drug_srno` int(11) NOT NULL,
  `drug_name` varchar(500) NOT NULL,
  `drug_remarks` varchar(500) NOT NULL,
  `drug_create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `drug_create_user` int(11) NOT NULL DEFAULT '2',
  `drug_lastupdate_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `drug_lastupdate_user` int(11) NOT NULL,
  `drug_active` tinyint(1) NOT NULL,
  `drug_unit` varchar(500) NOT NULL,
  `drug_categoryid` int(11) NOT NULL,
  `drug_price` double NOT NULL,
  `drug_quantity` int(11) NOT NULL,
  `drug_statusreorder` int(11) NOT NULL,
  `drug_statusdanger` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_drug`
--

INSERT INTO `pharm_drug` (`drug_srno`, `drug_name`, `drug_remarks`, `drug_create_date`, `drug_create_user`, `drug_lastupdate_date`, `drug_lastupdate_user`, `drug_active`, `drug_unit`, `drug_categoryid`, `drug_price`, `drug_quantity`, `drug_statusreorder`, `drug_statusdanger`) VALUES
(1, 'Methyldopa', 'New Arrival', '2013-07-11 06:05:34', 1, '2015-07-30 08:40:40', 4, 1, 'Tab', 1, 6, 0, 100, 25),
(2, 'Captopril', '', '2014-11-16 05:50:53', 2, '2015-07-18 05:53:36', 4, 1, 'Tab', 1, 35, 0, 100, 25),
(3, 'Panadol', 'New Arrival', '2013-07-18 10:04:54', 1, '2014-07-27 15:41:32', 4, 1, 'Tab', 1, 1.73, 1807, 100, 25),
(5, 'Pindolol Tablet 5mg', 'New Arrival', '2013-07-19 06:23:28', 1, '2013-08-20 18:30:00', 1, 1, 'Tab', 1, 6.7, 400, 100, 25),
(6, 'Propranolol Tablet 10mg', 'New Arrival', '2013-07-19 06:26:21', 1, '2014-08-26 04:53:40', 4, 1, 'Tab', 1, 0.1568, 20, 100, 25),
(7, 'Enalapril', 'New Arrival', '2013-07-31 12:36:55', 1, '2013-08-29 18:30:00', 1, 1, 'Tab', 1, 12, 0, 100, 25),
(8, 'Afrin', '', '2014-11-17 05:26:51', 2, '2014-11-17 05:26:51', 2, 1, 'Amp', 2, 31.1, 0, 200, 25),
(11, ' Ampicillin ', '', '2014-11-17 04:53:11', 2, '2014-11-19 08:24:10', 4, 1, 'Spray', 1, 130, 34, 1000, 500),
(12, 'Asprin', '', '2013-08-18 17:30:54', 0, '2015-07-30 05:35:34', 4, 0, 'Tab', 1, 123, 340, 500, 100),
(13, ' Ampicillin 250mg', 'New', '2013-08-20 11:31:43', 0, '2014-09-09 11:14:00', 0, 0, 'Amp', 1, 13, 2000, 3000, 200),
(14, ' Ampicillin 250mg', 'New Arrival', '2013-08-22 04:21:59', 0, '2014-09-09 11:14:00', 0, 0, 'Cap', 1, 10, 0, 1000, 200),
(15, 'Asprin 500mg', '', '2014-11-16 05:49:03', 2, '2014-11-16 05:49:03', 2, 0, 'Spray', 1, 200, 0, 32, 20),
(16, 'Losartan', 'New', '2013-08-22 07:24:16', 1, '2013-08-22 07:24:16', 0, 0, 'Tab', 1, 10, 0, 1000, 200),
(17, 'Metformin 50mg', 'New', '2013-08-22 07:27:54', 1, '2013-08-22 07:27:54', 0, 0, 'Tab', 1, 10, 2000, 1000, 200),
(20, 'Metformin 25mg', 'New', '2013-08-22 07:55:29', 1, '2013-08-22 07:55:29', 0, 0, 'Tab', 1, 20, 0, 3000, 300),
(21, 'Metformin 10mg', 'New', '2013-08-22 08:18:36', 1, '2013-08-22 08:18:36', 0, 0, 'Tab', 1, 10, 1000, 2000, 200),
(22, 'Atorvastatin 5mg', 'New', '2013-08-22 09:11:41', 1, '2013-08-22 09:11:41', 0, 0, 'Tab', 1, 10, 0, 1000, 400),
(24, 'Atorvastatin 10mg', 'New', '2013-08-22 09:12:04', 1, '2013-08-22 09:12:04', 0, 0, 'Tab', 1, 10, 0, 1000, 400),
(38, 'Afrin Test', '', '2013-10-29 09:36:38', 5, '2014-08-26 10:14:21', 4, 0, 'Amp', 3, 3.01, 0, 2000, 200),
(39, 'Afrin Latest', 'New', '2013-10-29 09:36:15', 5, '2014-08-26 10:14:30', 4, 0, 'Amp', 3, 5.01, 884, 1000, 200),
(48, 'Pethidine hydrochloride Injection 50mg Ampoule', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Amp', 1, 48.13, 1000, 1000, 200),
(49, 'Pethidine Hydrochloride Injection 75mg Ampoule', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Amp', 1, 91.99, 20, 1000, 200),
(50, 'Acitretin (Soriatane) 50mg', '', '2014-11-20 10:37:58', 2, '2014-11-20 10:37:58', 2, 0, 'Tab', 1, 45.65, 0, 2000, 200),
(51, 'Codeine Phosphate injection 60mg/ml', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Amp', 1, 250, 1200, 1000, 200),
(52, 'Fentanyl Injection 100mcg in 2ml Ampoule', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Amp', 1, 134.34, 1500, 1000, 200),
(53, 'Amlodipine Besylate tablet 5mg', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Tab', 1, 0.44, 5000, 1000, 200),
(54, 'Diltiazem tablet 30mg', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Tab', 1, 0.4, 1200, 1000, 200),
(55, 'Nifedipine Slow Release Tablet 20mg', 'New', '2014-11-20 10:37:31', 2, '2014-11-20 10:37:31', 0, 0, 'Tab', 1, 0.13, 2000, 1000, 200);

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drugcategory`
--

CREATE TABLE IF NOT EXISTS `pharm_drugcategory` (
  `category_id` int(20) NOT NULL,
  `category` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_drugcategory`
--

INSERT INTO `pharm_drugcategory` (`category_id`, `category`) VALUES
(1, 'Narcotics'),
(2, 'Drugs used in the treatment of injections'),
(3, 'Drugs used in the treatment of Cardiovascular system'),
(4, 'Drugs acting on the central nervous system'),
(5, 'Drugs affecting nutrition & blood'),
(6, 'Drugs used in the treatment of diseases of the respiratory system'),
(7, 'Immunological product and vaccines'),
(8, 'Drugs used in the treatment of the endocrine system'),
(9, 'Drugs acting on the gastrointestinal system'),
(10, 'Drugs acting on eye');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drugdosage`
--

CREATE TABLE IF NOT EXISTS `pharm_drugdosage` (
  `drugdosage_id` int(11) NOT NULL,
  `drugdosage_srno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drugfrequency`
--

CREATE TABLE IF NOT EXISTS `pharm_drugfrequency` (
  `drugfrequency_id` int(11) NOT NULL,
  `drugfrequency_srno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_drugfrequency`
--

INSERT INTO `pharm_drugfrequency` (`drugfrequency_id`, `drugfrequency_srno`) VALUES
(1, 36),
(3, 16),
(3, 17),
(2, 20),
(3, 21),
(2, 22),
(2, 24),
(2, 25),
(3, 26),
(3, 27),
(3, 29),
(3, 30),
(1, 37);

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drugmanufacturer`
--

CREATE TABLE IF NOT EXISTS `pharm_drugmanufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drugrequests`
--

CREATE TABLE IF NOT EXISTS `pharm_drugrequests` (
  `request_drug_id` int(11) NOT NULL,
  `request_drug_srno` int(11) NOT NULL,
  `request_drug_name` varchar(500) DEFAULT NULL,
  `request_drug_batchno` varchar(500) DEFAULT NULL,
  `request_drug_department` varchar(500) NOT NULL DEFAULT 'OPD Pharmacy',
  `request_drug_date` datetime DEFAULT NULL,
  `request_drug_process_date` datetime DEFAULT NULL,
  `request_drug_quantity` int(11) DEFAULT NULL,
  `request_drug_processed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_drugssupplied`
--

CREATE TABLE IF NOT EXISTS `pharm_drugssupplied` (
  `drug_supplied_srno` int(11) NOT NULL,
  `drug_supplied_name` varchar(500) NOT NULL,
  `drug_supplied_batchno` varchar(500) NOT NULL,
  `drug_supplied_qty` int(11) DEFAULT NULL,
  `drug_supplied_manufactrure` varchar(500) DEFAULT NULL,
  `drug_supplied_manufact_date` datetime DEFAULT NULL,
  `drug_supplied_expirydate` datetime DEFAULT NULL,
  `drug_supplied_create_date` datetime DEFAULT NULL,
  `drug_supplied_create_user` int(11) DEFAULT NULL,
  `drug_supplied_lastupdate_date` datetime DEFAULT NULL,
  `drug_supplied_lastupdate_user` int(11) DEFAULT NULL,
  `drug_supplied_status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_drugssupplied`
--

INSERT INTO `pharm_drugssupplied` (`drug_supplied_srno`, `drug_supplied_name`, `drug_supplied_batchno`, `drug_supplied_qty`, `drug_supplied_manufactrure`, `drug_supplied_manufact_date`, `drug_supplied_expirydate`, `drug_supplied_create_date`, `drug_supplied_create_user`, `drug_supplied_lastupdate_date`, `drug_supplied_lastupdate_user`, `drug_supplied_status`) VALUES
(1, 'Methyldopa Tablet 250mg', 'B01', 1000, '', '2013-06-25 13:00:00', '2013-07-26 11:37:03', '2013-07-11 11:37:03', 1, '2013-08-08 11:37:03', 1, ''),
(1, 'Methyldopa Tablet 250mg', 'B22', 1200, '', '2013-06-20 05:14:00', '2014-06-20 11:37:03', '2013-07-19 11:04:11', 1, '2013-08-08 11:37:03', 1, ''),
(1, 'Methyldopa Tablet 250mg', 'B35', 1000, '', '2013-06-20 05:08:00', '2014-06-30 11:37:03', '2013-07-19 11:12:24', 1, '2013-08-08 11:37:03', 1, ''),
(2, 'Captopril Tablet 25mg', 'B01', 1000, '', '2012-06-28 05:21:00', '2013-07-25 11:37:03', '2013-07-11 11:36:46', 1, '2013-08-08 11:37:03', 1, ''),
(2, 'Captopril Tablet 25mg', 'B22', 1200, '', '2013-06-20 05:24:00', '2014-06-20 11:37:03', '2013-07-19 11:01:20', 1, '2013-08-08 11:37:03', 1, ''),
(3, 'Panadol', 'B06', 1000, '', '2012-06-28 06:15:00', '2014-06-25 11:37:03', '2013-07-19 11:24:57', 1, '2013-08-08 11:37:03', 1, ''),
(3, 'Panadol', 'B07', 1000, '', '2012-06-28 10:15:00', '2014-06-25 11:37:03', '2013-07-19 11:28:02', 1, '2013-08-08 11:37:03', 1, ''),
(3, 'Panadol', 'B08', 1000, '', '2012-06-28 07:14:00', '2014-06-25 11:37:03', '2013-07-19 11:35:07', 1, '2013-08-08 11:37:03', 1, ''),
(3, 'Panadol', 'B09', 1000, '', '2012-06-28 08:18:00', '2014-06-25 11:37:03', '2013-07-19 11:37:41', 1, '2013-08-08 11:37:03', 1, ''),
(3, 'Panadol', 'B10', 1000, '', '2012-06-28 05:25:00', '2014-06-25 11:37:03', '2013-07-19 11:48:30', 1, '2013-08-08 11:37:03', 1, ''),
(3, 'Panadol', 'B1289', 1000, '', '2013-07-26 04:16:00', '2013-11-15 11:37:03', '2013-08-19 09:35:20', 1, '2013-11-15 11:37:03', 0, ''),
(5, 'Pindolol Tablet 5mg', 'B02', 1500, '', '2013-06-25 11:37:03', '2014-06-25 11:37:03', '2013-07-19 12:03:15', 1, '2013-08-08 11:37:03', 1, ''),
(6, 'Propranolol Tablet 10mg', 'B01', 1000, '', '2013-08-16 11:37:03', '2013-08-31 11:37:03', '2013-07-19 11:57:36', 1, '2013-08-08 11:37:03', 1, ''),
(6, 'Propranolol Tablet 10mg', 'B11', 1000, '', '2013-06-17 11:37:03', '2013-08-31 11:37:03', '2013-07-24 15:50:19', 1, '2013-08-08 11:37:03', 1, ''),
(11, 'Asprin', 'B01', 1000, '', '2013-08-15 11:37:03', '2013-08-31 11:37:03', '2013-08-11 15:26:52', 1, '2013-08-08 11:37:03', 1, ''),
(11, 'Asprin', 'B05', 8, NULL, '2013-12-29 00:00:00', '2013-12-29 00:00:00', '2014-11-18 09:57:37', 1, NULL, 0, 'Enabled'),
(11, 'Asprin', 'S001', 6, NULL, '2013-12-29 00:00:00', '2013-12-29 00:00:00', '2014-11-18 10:06:36', 1, NULL, 0, 'Enabled'),
(11, 'Asprin', 'S004', 8, NULL, '2013-12-29 00:00:00', '2013-12-29 00:00:00', '2014-11-18 10:15:51', 1, NULL, 0, 'Enabled'),
(13, 'TestDrug100', 'B01', 2000, '', '2013-08-15 11:37:03', '2013-08-15 11:37:03', '2013-08-20 17:13:54', 1, '2013-08-20 17:13:54', 0, ''),
(17, 'TestDrug20000', 'B10', 2000, '', '2013-04-20 11:37:03', '2015-04-20 11:37:03', '2013-08-22 13:13:29', 1, '2013-08-20 17:13:54', 0, ''),
(21, 'NewDrug2', 'B01', 1000, '', '2013-04-10 11:37:03', '2015-04-10 11:37:03', '2013-08-22 13:49:14', 1, '2013-08-20 17:13:54', 0, ''),
(25, 'TestDrug2015', 'B01', 1000, '', '2013-05-20 11:37:03', '2014-05-20 00:00:00', '2013-08-22 15:14:14', 1, '2013-08-20 17:13:54', 0, ''),
(26, 'TestDrug2016', 'B01', 2000, '', '2013-06-10 00:00:00', '2014-06-20 00:00:00', '2013-08-22 15:21:09', 1, '2013-08-20 17:13:54', 0, ''),
(26, 'TestDrug2016', 'B03', 3000, '', '2013-04-20 00:00:00', '2014-04-20 00:00:00', '2013-08-22 15:23:41', 1, '2013-08-20 17:13:54', 0, ''),
(30, 'TestDrug2021', 'B02', 2000, '', '2013-06-20 00:00:00', '2014-06-20 00:00:00', '2013-08-22 15:27:15', 1, '2013-08-20 17:13:54', 0, ''),
(39, 'Afrin Latest', 'B01', 1000, '', '2011-04-19 00:00:00', '2015-06-28 00:00:00', '2013-10-29 15:07:25', 1, '2013-10-29 15:08:17', 0, 'Enabled'),
(42, 'Acitretin (Soriatane) 50mg', 'SD01', 64, NULL, '2013-12-29 00:00:00', '2013-12-29 00:00:00', '2014-11-20 13:46:23', 1, NULL, 0, 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_email`
--

CREATE TABLE IF NOT EXISTS `pharm_email` (
  `email_id` int(11) NOT NULL,
  `email_drug_id` int(11) NOT NULL,
  `email_content` text NOT NULL,
  `email_send_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_frequency`
--

CREATE TABLE IF NOT EXISTS `pharm_frequency` (
  `frequency_id` int(11) NOT NULL,
  `frequency` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_frequency`
--

INSERT INTO `pharm_frequency` (`frequency_id`, `frequency`) VALUES
(1, 'Once a Day'),
(2, 'Twice a Day'),
(3, '3 Times a Day'),
(4, 'Four Times a Day'),
(5, '5 Times a Day'),
(6, 'BD');

-- --------------------------------------------------------

--
-- Table structure for table `ward_admission`
--

CREATE TABLE IF NOT EXISTS `ward_admission` (
  `bht_no` varchar(500) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `bed_no` int(11) DEFAULT NULL,
  `ward_no` varchar(100) NOT NULL,
  `daily_no` int(11) NOT NULL,
  `monthly_no` int(11) NOT NULL,
  `yearly_no` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `admit_date_time` datetime NOT NULL,
  `patient_complain` varchar(500) NOT NULL,
  `previous_history` varchar(500) NOT NULL,
  `discharge_type` varchar(5) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `admission_unit` varchar(5) NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `last_updated_user` int(11) NOT NULL,
  `last_updated_date_time` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `sign` varchar(500) NOT NULL,
  `outcomes` varchar(500) NOT NULL,
  `dischargediagnosis` varchar(500) NOT NULL,
  `referredto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_admission`
--

INSERT INTO `ward_admission` (`bht_no`, `patient_id`, `bed_no`, `ward_no`, `daily_no`, `monthly_no`, `yearly_no`, `doctor_id`, `admit_date_time`, `patient_complain`, `previous_history`, `discharge_type`, `remark`, `admission_unit`, `created_user`, `created_date_time`, `last_updated_user`, `last_updated_date_time`, `status`, `sign`, `outcomes`, `dischargediagnosis`, `referredto`) VALUES
('20141', 15, 2, 'Ward-01', 1, 1, 1, 17, '2014-10-18 15:22:00', 'patient with headache', 'patient was a dengue patient', 'none', '', 'Ward', 1, '2014-10-03 13:52:00', 3, '2014-11-10 14:22:00', 'signs', 'C:\\Users\\Babi\\Desktop\\treatmentimages\\testdf', '', '', ''),
('201410', 13, 1, 'Ward-01', 1, 9, 10, 17, '2014-11-18 12:59:00', 'Heart Pain', 'Second time heart attack', 'M', 'missing patient', 'WARD', 3, '2014-11-16 16:26:00', 3, '2014-11-20 12:59:00', '', '', '', '', ''),
('201412', 1, 10, 'Ward-01', 1, 11, 12, 17, '2014-11-18 12:59:00', 'Rash', 'Infection', 'none', '', 'opd', 3, '2014-11-18 01:44:00', 5, '2014-11-20 07:34:00', 'Confirmed', '\\home\\his\\Desktop\\dilhara\\images\\201412-160915050522.jpg', '', '', ''),
('201413', 31, -99, 'Ward-03', 1, 12, 13, 17, '2014-11-20 13:00:00', 'Fatigue', 'Virus Flu patient', 'none', '', 'OPD', 5, '2014-11-20 07:55:00', 5, '2014-11-20 04:00:00', 'is confirmed', 'url', '', '', ''),
('201416', 2, 2, 'Ward-03', 1, 15, 16, 17, '2014-11-20 12:59:00', 'Leg Cramps', 'Artharities', 'IT', 'Healed', 'OPD', 5, '2014-11-20 10:11:00', 5, '2014-11-20 12:59:00', '', '', '', '', ''),
('201417', 39, 1, 'Ward-01', 1, 16, 17, 17, '2014-11-20 13:00:00', 'Stomach Ache', 'Urine Infection', 'none', 'testad', 'WARD', 3, '2014-11-20 12:40:00', 5, '2015-08-05 05:06:00', '', '', 'asthma', 'test23', 'clinic'),
('201418', 39, 2, 'Ward-03', 1, 17, 18, 17, '2014-11-20 12:59:00', 'test', 'test', 'none', '', 'OPD', 5, '2014-11-20 13:44:00', 5, '2014-11-20 13:44:00', 'is confirmed', 'url', '', '', ''),
('201419', 40, 5, 'Ward-02', 1, 18, 19, 22, '2014-11-20 12:59:00', 'patient with headack', 'patient was a dengue patient', 'L', 'go patient', 'WARD', 6, '2014-11-20 14:33:00', 6, '2014-11-20 13:59:00', '', '', '', '', ''),
('20142', 5, 1, 'Ward-01', 1, 1, 2, 17, '2014-11-21 14:22:00', 'Pain in heart', 'Heart Patient and daily get drugs', 'ET', 'transfer hospital', 'Ward', 1, '2014-11-07 17:11:00', 1, '2014-11-09 14:22:00', '', '', '', '', ''),
('201420', 40, 1, 'Ward-03', 1, 19, 20, 17, '2014-11-13 12:59:00', 'test', 'test', 'IT', 'test', 'OPD', 5, '2014-11-20 14:41:00', 5, '2014-11-20 12:59:00', '', '', '', '', ''),
('20143', 16, 1, 'Ward-01', 1, 2, 3, 17, '2014-11-09 14:30:00', 'patient with headack', 'patient was a dengue ', 'IT', 'he have to transfer hospital', 'Ward', 1, '2014-11-12 23:14:00', 1, '2014-11-12 00:15:00', '', '', '', '', ''),
('20144', 13, 1, 'Ward-02', 1, 3, 4, 22, '2014-11-13 12:59:00', 'patient with headack', 'patient was a dengue patient', 'L', 'missing patient', 'Ward', 5, '2014-11-12 23:15:00', 5, '2014-11-20 13:00:00', '', '', '', '', ''),
('20145', 17, 5, 'Ward-01', 1, 4, 5, 17, '2014-11-12 12:00:00', 'patient with headack', 'patient was a dengue patient', 'none', '', 'opd', 5, '2014-11-13 19:17:00', 5, '2014-11-20 10:08:00', '', '', '', '', ''),
('20146', 26, 2, 'Ward-02', 1, 5, 6, 1, '2014-11-19 12:59:00', 'Dengi', 'patient was a dengue patient', 'none', '', 'opd', 5, '2014-11-13 19:18:00', 5, '2014-11-13 19:18:00', '', '', '', '', ''),
('20147', 4, -99, 'Ward-01', 1, 6, 7, 17, '2014-11-13 12:59:00', 'patient with headack', 'patient was a dengue patient', 'ND', 'go patient', 'WARD', 1, '2014-11-13 22:29:00', 3, '2014-11-20 12:58:00', '', '', '', '', ''),
('20148', 18, -99, 'Ward-02', 1, 7, 8, 22, '2014-11-12 12:59:00', 'Dengi', 'patient was a dengue patient', 'none', '', 'WARD', 5, '2014-11-13 22:38:00', 5, '2014-11-17 19:04:00', '', '', '', '', ''),
('20149', 28, 1, 'Ward-03', 1, 8, 9, 17, '2014-11-16 12:59:00', 'patient with headack', 'patient was a dengue patienttesttttttt', 'IT', 'test', 'WARD', 3, '2014-11-16 14:42:00', 5, '2014-11-20 12:59:00', '', '', '', '', ''),
('201520', 2, -99, 'Ward-01', 1, 19, 20, 1, '2015-02-04 08:02:00', '', '', 'none', '', 'WARD', 5, '2015-02-19 00:39:00', 5, '2015-02-19 18:18:00', '', '', '', '', ''),
('201523', 3, -99, 'Ward-01', 1, 20, 23, 1, '2015-02-17 05:06:00', '', '', 'none', '', 'WARD', 5, '2015-02-19 09:06:00', 5, '2015-02-19 09:06:00', '', '', '', '', ''),
('201524', 13, 3, 'Ward-01', 1, 21, 24, 13, '2015-02-12 05:06:00', '', '', 'none', '', 'WARD', 5, '2015-02-19 11:03:00', 5, '2015-02-19 11:03:00', '', '', '', '', ''),
('201526', 4, 6, 'Ward-01', 1, 23, 26, 13, '2015-02-12 05:06:00', '', '', 'none', '', 'WARD', 5, '2015-02-19 23:48:00', 5, '2015-02-19 23:48:00', '', '', '', '', ''),
('201527', 15, 1, 'Ward-03', 1, 24, 27, 13, '2015-02-11 17:06:00', 'test', '', 'none', '', 'WARD', 5, '2015-02-19 23:53:00', 5, '2015-02-19 23:53:00', '', '', '', '', ''),
('201528', 27, 2, 'Ward-01', 2, 25, 28, 1, '2015-02-11 05:06:00', '', '', 'none', '', 'WARD', 5, '2015-02-19 23:55:00', 5, '2015-02-19 23:55:00', '', '', '', '', ''),
('201529', 7, 1, 'Ward-01', 2, 25, 29, 1, '2015-08-27 17:06:00', 'after', 'testing', 'none', '', 'OPD', 5, '2015-08-27 17:38:00', 5, '2015-08-27 17:38:00', '', '', '', '', ''),
('201530', 7, 2, 'Ward-01', 3, 26, 30, 1, '2015-08-27 17:06:00', 'testing', 'dd', 'none', '', 'OPD', 5, '2015-08-27 17:39:00', 5, '2015-08-27 17:39:00', 'signs', 'C:\\Users\\Babi\\Desktop\\treatmentimages\\testdf', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ward_admission_request`
--

CREATE TABLE IF NOT EXISTS `ward_admission_request` (
  `auto_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `request_unit` varchar(20) NOT NULL,
  `is_read` int(11) NOT NULL,
  `transfer_ward` varchar(100) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `create_user` int(11) NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_user_doctor` int(11) NOT NULL,
  `last_update_user` int(11) NOT NULL,
  `last_update_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bht_no` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_admission_request`
--

INSERT INTO `ward_admission_request` (`auto_id`, `patient_id`, `request_unit`, `is_read`, `transfer_ward`, `remark`, `create_user`, `create_date_time`, `is_user_doctor`, `last_update_user`, `last_update_date_time`, `bht_no`) VALUES
(6, 1, 'opd', 1, 'Ward-01', 'opd transfer', 3, '2014-11-13 08:15:00', 0, 3, '2014-11-13 08:17:00', '20145'),
(7, 2, 'opd', 1, 'Ward-02', 'my ward patient admission', 3, '2014-11-13 08:18:00', 1, 3, '2014-11-13 08:18:00', '20146'),
(8, 2, 'opd', 1, 'Ward-01', 'neww', 3, '2014-11-15 23:16:00', 1, 3, '2014-11-17 14:41:00', '201411'),
(9, 1, 'opd', 1, 'Ward-01', 'patient', 3, '2014-11-15 23:27:00', 0, 3, '2014-11-17 14:44:00', '201412'),
(11, 31, 'OPD', 1, 'Ward-03', 'patient admit imediately', 3, '2014-11-19 20:53:00', 0, 5, '2014-11-19 20:55:00', '201413'),
(12, 1, 'OPD', 1, 'Ward-01', 'TEST', 3, '2014-11-19 23:09:00', 1, 3, '2014-11-19 23:10:00', '201415'),
(13, 2, 'OPD', 1, 'Ward-03', 'test', 3, '2014-11-19 23:11:00', 0, 5, '2014-11-19 23:11:00', '201416'),
(14, 23, 'OPD', 0, 'Ward-02', 'testing', 6, '2014-11-20 01:29:00', 0, 6, '2014-11-20 01:29:00', NULL),
(15, 39, 'OPD', 1, 'Ward-03', 'test', 3, '2014-11-20 02:24:00', 0, 5, '2014-11-20 02:44:00', '201418'),
(16, 40, 'OPD', 1, 'Ward-03', 'test', 3, '2014-11-20 03:39:00', 0, 5, '2014-11-20 03:41:00', '201420'),
(17, 7, 'OPD', 0, 'Ward-02', 'wed', 3, '2015-07-30 05:03:00', 1, 3, '2015-07-30 05:03:00', NULL),
(18, 7, 'OPD', 0, 'Ward-01', 'asd', 3, '2015-07-30 05:11:00', 1, 3, '2015-07-30 05:11:00', NULL),
(19, 7, 'OPD', 0, 'Ward-01', '', 3, '2015-07-30 05:13:00', 1, 3, '2015-07-30 05:13:00', NULL),
(20, 7, 'OPD', 0, 'Ward-01', '', 3, '2015-07-30 05:15:00', 0, 3, '2015-07-30 05:15:00', NULL),
(21, 7, 'OPD', 0, 'Ward-01', '', 3, '2015-07-30 05:24:00', 1, 3, '2015-07-30 05:24:00', NULL),
(22, 7, 'OPD', 0, 'Ward-01', '', 3, '2015-07-30 05:25:00', 1, 3, '2015-07-30 05:25:00', NULL),
(23, 1, 'OPD', 0, 'Ward-01', '', 1, '2015-08-03 08:05:00', 0, 1, '2015-08-03 08:05:00', NULL),
(24, 6, 'OPD', 0, 'Ward-01', '', 1, '2015-08-06 08:49:00', 1, 1, '2015-08-06 08:49:00', NULL),
(25, 51, 'OPD', 0, 'Ward-01', '', 1, '2015-09-14 04:57:00', 1, 1, '2015-09-14 04:57:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ward_beds`
--

CREATE TABLE IF NOT EXISTS `ward_beds` (
  `bed_id` int(11) NOT NULL,
  `bed_no` int(11) NOT NULL,
  `bed_type` varchar(100) NOT NULL,
  `ward_no` varchar(100) NOT NULL,
  `availability` varchar(500) NOT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_beds`
--

INSERT INTO `ward_beds` (`bed_id`, `bed_no`, `bed_type`, `ward_no`, `availability`, `patient_id`) VALUES
(22, 1, 'Normal', 'Ward-01', 'free', NULL),
(23, 2, 'Normal', 'Ward-01', 'free', NULL),
(24, 3, 'Normal', 'Ward-01', '201524', 13),
(26, 5, 'Normal', 'Ward-01', '20145', 17),
(27, 6, 'Normal', 'Ward-01', '201526', 4),
(28, 7, 'Normal', 'Ward-01', 'free', NULL),
(29, 8, 'Normal', 'Ward-01', 'free', NULL),
(30, 9, 'Normal', 'Ward-01', 'free', NULL),
(31, 10, 'Normal', 'Ward-01', '201412', 1),
(32, 1, 'Normal', 'Ward-02', 'free', NULL),
(33, 2, 'Normal', 'Ward-02', '20146', 2),
(34, 3, 'Normal', 'Ward-02', 'free', NULL),
(36, 1, 'Normal', 'Ward-03', '201527', 15),
(37, 2, 'Normal', 'Ward-03', '201418', 39),
(38, 3, 'Normal', 'Ward-03', 'free', NULL),
(39, 1, 'Normal', 'Ward-04', 'free', NULL),
(40, 2, 'Normal', 'Ward-04', 'free', NULL),
(41, 3, 'Normal', 'Ward-04', 'free', NULL),
(42, 4, 'Normal', 'Ward-04', 'free', NULL),
(43, 5, 'Normal', 'Ward-04', 'free', NULL),
(44, 6, 'Normal', 'Ward-04', 'free', NULL),
(45, 7, 'Normal', 'Ward-04', 'free', NULL),
(46, 8, 'Normal', 'Ward-04', 'free', NULL),
(47, 9, 'Normal', 'Ward-04', 'free', NULL),
(48, 10, 'Normal', 'Ward-04', 'free', NULL),
(49, 5, 'Normal', 'Ward-02', 'free', NULL),
(50, 6, 'Normal', 'Ward-02', 'free', NULL),
(51, 4, 'Normal', 'Ward-03', 'free', NULL),
(52, 5, 'Normal', 'Ward-03', 'free', NULL),
(53, 11, 'Normal', 'Ward-04', 'free', NULL),
(54, 1, 'Normal', 'Ward-05', 'free', NULL),
(55, 2, 'special', 'Ward-05', 'free', NULL),
(57, 3, 'Normal', 'Ward-05', 'free', NULL),
(59, 2, 'Normal', 'Word-07', 'free', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ward_diabeticchart`
--

CREATE TABLE IF NOT EXISTS `ward_diabeticchart` (
  `row_no` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  `blood_suger` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_diabeticchart`
--

INSERT INTO `ward_diabeticchart` (`row_no`, `bht_no`, `date_time`, `blood_suger`) VALUES
(1, '201410', '2015-06-08 09:02:00', 10),
(2, '201520', '2015-06-08 09:02:00', 20),
(3, '201410', '2015-06-13 10:00:00', 55.5),
(4, '201410', '2015-08-25 10:05:00', 55.5);

-- --------------------------------------------------------

--
-- Table structure for table `ward_externaltransfer`
--

CREATE TABLE IF NOT EXISTS `ward_externaltransfer` (
  `transfer_id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `transfer_from` varchar(100) NOT NULL,
  `transfer_to` varchar(100) NOT NULL,
  `name_of_guardian` varchar(200) NOT NULL,
  `address_of_guardian` varchar(500) NOT NULL,
  `reason_for_transfer` varchar(1000) NOT NULL,
  `report_of_spacial_examination` varchar(1000) NOT NULL,
  `treatment_suggested` varchar(1000) NOT NULL,
  `transfer_created_date_time` datetime NOT NULL,
  `transfer_created_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_externaltransfer`
--

INSERT INTO `ward_externaltransfer` (`transfer_id`, `bht_no`, `transfer_from`, `transfer_to`, `name_of_guardian`, `address_of_guardian`, `reason_for_transfer`, `report_of_spacial_examination`, `treatment_suggested`, `transfer_created_date_time`, `transfer_created_user`) VALUES
(1, '20142', 'Thalangama', 'Homagama', 'S.A Wijerathne', 'No-145/8/3, Dadagamuwa,Veyangoda', 'sergical', 'Heart patient', 'Give Aspin ', '2014-11-09 14:22:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ward_internaltransfer`
--

CREATE TABLE IF NOT EXISTS `ward_internaltransfer` (
  `tranfer_id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `transfer_ward` varchar(100) NOT NULL,
  `transfer_from_ward` varchar(100) NOT NULL,
  `reson_for_trasnsfer` varchar(1000) NOT NULL,
  `report_of_spacial_examination` varchar(1000) NOT NULL,
  `treatment_suggested` varchar(1000) NOT NULL,
  `transfer_created_date_time` datetime NOT NULL,
  `transfer_created_user` int(11) NOT NULL,
  `read_transfer` int(11) NOT NULL,
  `new_bht_no` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_internaltransfer`
--

INSERT INTO `ward_internaltransfer` (`tranfer_id`, `bht_no`, `transfer_ward`, `transfer_from_ward`, `reson_for_trasnsfer`, `report_of_spacial_examination`, `treatment_suggested`, `transfer_created_date_time`, `transfer_created_user`, `read_transfer`, `new_bht_no`) VALUES
(4, '20143', 'Ward-02', 'Ward-01', 'lab testing', 'heart attack', 'aspin', '2014-11-12 00:15:00', 1, 1, '20148'),
(5, '201416', 'Ward-01', 'Ward-03', 'test', 'heart attack', 'test', '2014-11-20 12:59:00', 5, 0, NULL),
(6, '20149', 'Ward-01', 'Ward-03', 'test', 'test', 'test', '2014-11-20 12:59:00', 5, 0, NULL),
(7, '201420', 'Ward-01', 'Ward-03', 'tes', 'test', 'test', '2014-11-20 12:59:00', 5, 1, '201530'),
(8, '201530', 'Ward-02', 'Ward-01', 'test4', '', 'tests', '2015-01-12 10:10:00', 5, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ward_liquidbalancechart`
--

CREATE TABLE IF NOT EXISTS `ward_liquidbalancechart` (
  `row_no` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  `Oral` double NOT NULL,
  `Saline` double NOT NULL,
  `Output` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_liquidbalancechart`
--

INSERT INTO `ward_liquidbalancechart` (`row_no`, `bht_no`, `date_time`, `Oral`, `Saline`, `Output`) VALUES
(1, '201419', '2015-06-08 09:02:00', 100, 80, 20),
(2, '201419', '2015-06-14 09:02:00', 120, 20, 100),
(3, '201415', '2015-07-02 10:11:00', 100, 20, 32),
(4, '201410', '2015-10-26 10:10:00', 120, 20, 100),
(5, '201412', '2015-09-16 05:05:00', 100, 45, 55),
(6, '201412', '2015-09-16 05:06:00', 100, 45, 55),
(7, '201412', '2015-09-16 05:06:00', 145, 50, 95);

-- --------------------------------------------------------

--
-- Table structure for table `ward_nursenote`
--

CREATE TABLE IF NOT EXISTS `ward_nursenote` (
  `note_id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `create_user` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_nursenote`
--

INSERT INTO `ward_nursenote` (`note_id`, `bht_no`, `note`, `create_user`, `date_time`) VALUES
(1, '201417', 'test1', 5, '2015-06-08 07:43:00'),
(2, '201415', 'test1', 5, '2015-07-05 21:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `ward_operations`
--

CREATE TABLE IF NOT EXISTS `ward_operations` (
  `operation_id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `operation_type` varchar(500) NOT NULL,
  `operation_discription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ward_prescription_terms`
--

CREATE TABLE IF NOT EXISTS `ward_prescription_terms` (
  `term_id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `no_of_terms` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `create_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_prescription_terms`
--

INSERT INTO `ward_prescription_terms` (`term_id`, `bht_no`, `no_of_terms`, `start_date`, `end_date`, `create_user`) VALUES
(23, '20144', 1, '2014-11-19', '2014-11-19', 3),
(24, '20144', 2, '2014-11-19', '2014-11-19', 3),
(25, '20144', 3, '2014-11-19', '2014-11-19', 3),
(26, '201410', 1, '2014-11-19', '2014-11-19', 3),
(27, '20144', 4, '2014-11-20', '2014-11-20', 3),
(28, '20144', 5, '2014-11-20', '2014-11-20', 3),
(29, '20144', 6, '2014-11-20', '2014-11-20', 3),
(30, '20144', 7, '2014-11-20', '2014-11-20', 3),
(31, '20142', 1, '2014-11-20', '2014-11-20', 3),
(32, '20141', 1, '2014-11-20', '2014-11-20', 3),
(33, '20149', 1, '2014-11-20', '2014-11-20', 3),
(34, '20149', 2, '2014-11-20', '2014-11-20', 3),
(35, '20149', 3, '2014-11-20', '2014-11-20', 3),
(36, '201413', 1, '2014-11-20', '2014-11-20', 3),
(37, '20141', 2, '2014-11-20', '2014-11-20', 3),
(38, '20142', 2, '2014-11-20', '2014-11-20', 3),
(39, '20142', 3, '2014-11-20', '2014-11-20', 3),
(40, '20142', 4, '2014-11-20', '2014-11-20', 3),
(41, '20141', 3, '2014-11-20', '2014-11-20', 3),
(42, '201416', 1, '2014-11-20', '2014-11-20', 3),
(43, '201415', 1, '2014-11-20', '2014-11-20', 3),
(44, '201410', 2, '2014-11-20', '2014-11-20', 3),
(45, '201410', 3, '2014-11-20', '2014-11-20', 3),
(46, '201410', 4, '2014-11-20', '2014-11-20', 3),
(47, '201417', 1, '2014-11-20', '2014-11-20', 3),
(48, '20147', 1, '2014-11-20', '2014-11-20', 3),
(49, '201419', 1, '2014-11-20', '2014-11-20', 6),
(50, '201420', 1, '2014-11-20', '2014-11-20', 5),
(51, '20141', 4, '2014-11-20', '2014-11-20', 3),
(52, '201412', 1, '2014-12-20', '2014-12-20', 3),
(53, '201412', 2, '2014-12-20', '2014-12-20', 3),
(54, '201412', 3, '2014-12-20', '2014-12-20', 3),
(55, '201412', 4, '2014-12-20', '2014-12-20', 3),
(58, '201520', 1, '2015-02-19', '2015-02-19', 5),
(59, '201520', 2, '2015-02-19', '2015-02-19', 5),
(61, '201414', 1, '2015-02-19', '2015-02-19', 1),
(62, '201414', 1, '2015-02-19', '2015-02-19', 1),
(63, '201521', 1, '2015-02-19', '2015-02-19', 5),
(64, '201522', 1, '2015-02-19', '2015-02-19', 5),
(66, '201418', 1, '2015-02-19', '2015-02-19', 5),
(67, '201418', 2, '2015-02-19', '2015-02-19', 5),
(68, '201521', 2, '2015-02-19', '2015-02-19', 5),
(69, '201523', 1, '2015-02-19', '2015-02-19', 5),
(70, '201522', 1, '2015-02-19', '2015-02-19', 5),
(73, '201522', 1, '2015-02-19', '2015-02-19', 5),
(75, '201521', 3, '2015-02-19', '2015-02-19', 5),
(76, '201522', 1, '2015-02-19', '2015-02-19', 5),
(79, '201524', 1, '2015-02-19', '2015-02-19', 5),
(81, '201526', 1, '2015-02-19', '2015-02-19', 5),
(82, '201528', 1, '2015-02-19', '2015-02-19', 5),
(83, '201411', 1, '2015-02-20', '2015-02-20', 5),
(84, '201411', 1, '2015-02-20', '2015-02-20', 5),
(86, '201528', 2, '2015-02-20', '2015-02-20', 5),
(87, '201528', 3, '2015-02-20', '2015-02-20', 5),
(90, '201526', 2, '2015-02-20', '2015-02-20', 5),
(91, '20145', 1, '2015-02-20', '2015-02-20', 5),
(92, '20145', 2, '2015-02-20', '2015-02-20', 5),
(93, '201411', 1, '2015-02-22', '2015-02-22', 5),
(94, '201525', 1, '2015-02-22', '2015-02-22', 5),
(95, '20146', 1, '2015-02-22', '2015-02-22', 5),
(96, '201414', 1, '2015-02-22', '2015-02-22', 5),
(97, '201414', 1, '2015-02-22', '2015-02-22', 5),
(98, '201414', 1, '2015-02-22', '2015-02-22', 5),
(99, '201414', 1, '2015-02-22', '2015-02-22', 5),
(100, '201414', 1, '2015-02-22', '2015-02-22', 5),
(101, '20148', 1, '2015-02-22', '2015-02-22', 5),
(102, '201414', 1, '2015-02-22', '2015-02-22', 5),
(103, '20148', 2, '2015-02-22', '2015-02-22', 5),
(104, '201414', 1, '2015-02-22', '2015-02-22', 5),
(105, '201529', 1, '2015-03-28', '2015-03-28', 5),
(106, '201529', 2, '2015-03-28', '2015-03-28', 5),
(107, '201524', 2, '2015-04-16', '2015-04-16', 5),
(108, '201412', 5, '2015-09-16', '2015-09-16', 5),
(109, '201412', 6, '2015-09-16', '2015-09-16', 5),
(110, '201412', 7, '2015-09-16', '2015-09-16', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ward_prescriptionitem`
--

CREATE TABLE IF NOT EXISTS `ward_prescriptionitem` (
  `auto_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `dose` int(11) NOT NULL,
  `frequency` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_prescriptionitem`
--

INSERT INTO `ward_prescriptionitem` (`auto_id`, `term_id`, `drug_id`, `dose`, `frequency`, `status`) VALUES
(33, 24, 38, 1, 'Twice a Day', 'con'),
(34, 24, 3, 1, 'Once a Day', 'omit'),
(35, 24, 20, 2, ' Thrice a Day', 'con'),
(36, 24, 6, 1, ' Thrice a Day', 'omit'),
(37, 25, 38, 1, 'Twice a Day', 'con'),
(38, 25, 20, 2, ' Thrice a Day', 'con'),
(39, 25, 11, 1, 'Once a Day', 'chg'),
(40, 27, 38, 1, 'Twice a Day', 'con'),
(41, 27, 20, 2, ' Thrice a Day', 'chg'),
(42, 27, 38, 2, 'Twice a Day', 'con'),
(43, 27, 21, 3, ' Thrice a Day', 'con'),
(44, 27, 11, 3, 'Thrice a Day', 'chg'),
(45, 28, 38, 1, 'Twice a Day', 'con'),
(46, 28, 38, 2, 'Twice a Day', 'con'),
(47, 28, 21, 3, ' Thrice a Day', 'con'),
(48, 28, 11, 2, 'Once a Day', 'con'),
(49, 28, 20, 3, 'Thrice a Day', 'con'),
(50, 29, 38, 1, 'Twice a Day', 'con'),
(51, 29, 38, 2, 'Twice a Day', 'con'),
(52, 29, 21, 3, ' Thrice a Day', 'con'),
(53, 29, 11, 2, 'Once a Day', 'con'),
(54, 29, 20, 3, 'Thrice a Day', 'con'),
(55, 29, 6, 1, 'Once a Day', 'con'),
(56, 30, 38, 1, 'Twice a Day', 'active'),
(57, 30, 38, 2, 'Twice a Day', 'active'),
(58, 30, 21, 3, ' Thrice a Day', 'active'),
(59, 30, 11, 2, 'Once a Day', 'active'),
(60, 30, 20, 3, 'Thrice a Day', 'active'),
(61, 32, 6, 1, 'Once a Day', 'con'),
(62, 32, 1, 1, 'Once a Day', 'omit'),
(63, 32, 11, 2, 'Once a Day', 'chg'),
(64, 34, 38, 3, 'Twice a Day', 'omit'),
(65, 35, 2, 3, 'Twice a Day', 'active'),
(66, 35, 3, 1, ' Thrice a Day', 'active'),
(67, 37, 6, 1, 'Once a Day', 'omit'),
(68, 37, 2, 3, 'Twice a Day', 'con'),
(69, 37, 11, 1, 'Thrice a Day', 'chg'),
(70, 38, 11, 2, ' Thrice a Day', 'con'),
(71, 38, 6, 2, ' Thrice a Day', 'omit'),
(72, 38, 3, 2, 'Twice a Day', 'omit'),
(73, 38, 39, 1, 'Once a Day', 'chg'),
(74, 39, 11, 2, ' Thrice a Day', 'con'),
(75, 39, 39, 2, 'Once a Day', 'omit'),
(76, 39, 1, 3, ' Thrice a Day', 'con'),
(77, 40, 11, 2, ' Thrice a Day', 'active'),
(78, 40, 1, 3, ' Thrice a Day', 'active'),
(79, 40, 2, 2, 'Twice a Day', 'active'),
(80, 40, 5, 2, ' Thrice a Day', 'active'),
(81, 41, 2, 3, 'Twice a Day', 'con'),
(82, 41, 1, 3, ' Thrice a Day', 'omit'),
(83, 41, 11, 2, 'Thrice a Day', 'con'),
(84, 44, 39, 2, 'Twice a Day', 'con'),
(85, 44, 6, 3, 'Twice a Day', 'chg'),
(86, 44, 6, 2, 'Twice a Day', 'omit'),
(87, 45, 39, 2, 'Twice a Day', 'con'),
(88, 45, 8, 2, ' Thrice a Day', 'con'),
(89, 45, 6, 1, 'Once a Day', 'omit'),
(90, 46, 39, 2, 'Twice a Day', 'active'),
(91, 46, 8, 2, ' Thrice a Day', 'active'),
(92, 46, 2, 3, 'Twice a Day', 'active'),
(93, 51, 2, 3, 'Twice a Day', 'active'),
(94, 51, 11, 2, 'Thrice a Day', 'active'),
(95, 51, 39, 1, 'Once a Day', 'active'),
(96, 53, 15, 3, ' Thrice a Day', 'omit'),
(97, 53, 39, 2, 'Twice a Day', 'chg'),
(98, 54, 39, 1, 'Twice a Day', 'chg'),
(99, 54, 11, 2, 'Once a Day', 'chg'),
(100, 55, 39, 2, 'Twice a Day', 'active'),
(101, 55, 11, 3, 'Thrice a Day', 'active'),
(102, 55, 39, 1, 'Twice a Day', 'active'),
(103, 59, 39, 3, ' Thrice a Day', 'active'),
(104, 67, 53, 3, ' Thrice a Day', 'active'),
(105, 68, 11, 3, ' Thrice a Day', 'con'),
(106, 75, 11, 3, ' Thrice a Day', 'active'),
(107, 75, 11, 3, 'Twice a Day', 'active'),
(108, 86, 15, 3, ' Thrice a Day', 'omit'),
(109, 86, 39, 2, ' Thrice a Day', 'chg'),
(110, 87, 39, 3, 'Twice a Day', 'active'),
(111, 87, 39, 2, 'Twice a Day', 'active'),
(112, 90, 15, 2, 'Twice a Day', 'active'),
(113, 92, 53, 2, 'Once a Day', 'active'),
(114, 103, 53, 2, 'Twice a Day', 'active'),
(115, 106, 38, 2, 'Twice a Day', 'active'),
(116, 106, 53, 2, 'Twice a Day', 'active'),
(117, 107, 53, 3, ' Thrice a Day', 'active'),
(118, 108, 11, 1, 'Once a Day', 'active'),
(119, 110, 11, 1, 'Once a Day', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ward_prescriptions`
--

CREATE TABLE IF NOT EXISTS `ward_prescriptions` (
  `prescribe_id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `diagnosis` varchar(1000) NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ward_signature`
--

CREATE TABLE IF NOT EXISTS `ward_signature` (
  `auto_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `d_sign` varchar(500) NOT NULL,
  `createuser` int(11) NOT NULL,
  `createdatetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_signature`
--

INSERT INTO `ward_signature` (`auto_id`, `doctor_id`, `d_sign`, `createuser`, `createdatetime`) VALUES
(1, 17, 'test', 5, '2015-08-16 21:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `ward_surgicalobsrchart`
--

CREATE TABLE IF NOT EXISTS `ward_surgicalobsrchart` (
  `row_no` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ward_temp_prescribe`
--

CREATE TABLE IF NOT EXISTS `ward_temp_prescribe` (
  `auto_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `dose` int(11) NOT NULL,
  `frequency` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_temp_prescribe`
--

INSERT INTO `ward_temp_prescribe` (`auto_id`, `term_id`, `drug_id`, `dose`, `frequency`) VALUES
(35, 23, 38, 1, 'Twice a Day'),
(36, 23, 3, 1, 'Once a Day'),
(37, 23, 20, 2, ' Thrice a Day'),
(38, 23, 6, 1, ' Thrice a Day'),
(39, 24, 11, 1, 'Once a Day'),
(40, 25, 38, 2, 'Twice a Day'),
(41, 25, 21, 3, ' Thrice a Day'),
(42, 25, 11, 3, 'Thrice a Day'),
(43, 27, 11, 2, 'Once a Day'),
(44, 27, 20, 3, 'Thrice a Day'),
(45, 28, 6, 1, 'Once a Day'),
(46, 29, 1, 1, 'Once a Day'),
(47, 33, 38, 3, 'Twice a Day'),
(49, 34, 2, 3, 'Twice a Day'),
(50, 34, 3, 1, ' Thrice a Day'),
(51, 32, 2, 3, 'Twice a Day'),
(52, 32, 11, 1, 'Thrice a Day'),
(53, 31, 11, 2, ' Thrice a Day'),
(54, 31, 6, 2, ' Thrice a Day'),
(55, 31, 3, 2, 'Twice a Day'),
(56, 31, 39, 1, 'Once a Day'),
(57, 38, 39, 2, 'Once a Day'),
(58, 38, 1, 3, ' Thrice a Day'),
(59, 39, 2, 2, 'Twice a Day'),
(60, 39, 5, 2, ' Thrice a Day'),
(61, 37, 1, 3, ' Thrice a Day'),
(62, 37, 11, 2, 'Thrice a Day'),
(63, 26, 39, 2, 'Twice a Day'),
(64, 26, 6, 3, 'Twice a Day'),
(65, 26, 6, 2, 'Twice a Day'),
(67, 44, 8, 2, ' Thrice a Day'),
(68, 44, 6, 1, 'Once a Day'),
(69, 45, 2, 3, 'Twice a Day'),
(70, 41, 39, 1, 'Once a Day'),
(71, 52, 15, 3, ' Thrice a Day'),
(72, 52, 39, 2, 'Twice a Day'),
(73, 53, 39, 1, 'Twice a Day'),
(74, 53, 11, 2, 'Once a Day'),
(75, 54, 39, 2, 'Twice a Day'),
(76, 54, 11, 3, 'Thrice a Day'),
(77, 54, 39, 1, 'Twice a Day'),
(78, 58, 39, 3, ' Thrice a Day'),
(79, 63, 11, 3, ' Thrice a Day'),
(80, 66, 53, 3, ' Thrice a Day'),
(81, 68, 11, 3, 'Twice a Day'),
(82, 75, 53, 3, 'Twice a Day'),
(83, 82, 15, 3, ' Thrice a Day'),
(84, 82, 39, 2, ' Thrice a Day'),
(85, 86, 39, 3, 'Twice a Day'),
(86, 86, 39, 2, 'Twice a Day'),
(87, 81, 15, 2, 'Twice a Day'),
(88, 91, 53, 2, 'Once a Day'),
(89, 101, 53, 2, 'Twice a Day'),
(90, 105, 38, 2, 'Twice a Day'),
(91, 105, 53, 2, 'Twice a Day'),
(92, 79, 53, 3, ' Thrice a Day');

-- --------------------------------------------------------

--
-- Table structure for table `ward_temperaturechart`
--

CREATE TABLE IF NOT EXISTS `ward_temperaturechart` (
  `row_no` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `temperature` double NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_temperaturechart`
--

INSERT INTO `ward_temperaturechart` (`row_no`, `bht_no`, `temperature`, `date_time`) VALUES
(1, '201410', 55.5, '2015-08-25 10:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `ward_treatment`
--

CREATE TABLE IF NOT EXISTS `ward_treatment` (
  `id` int(11) NOT NULL,
  `bht_no` varchar(500) NOT NULL,
  `treat` varchar(1000) NOT NULL,
  `image` varchar(5000) NOT NULL,
  `create_user` int(11) DEFAULT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_treatment`
--

INSERT INTO `ward_treatment` (`id`, `bht_no`, `treat`, `image`, `create_user`, `create_date_time`) VALUES
(1, '20142', 'test', 'urlddd', 3, '2014-11-19 00:15:44'),
(2, '20141', 'surath', 'urlddd', 3, '2014-11-19 00:17:58'),
(3, '20145', 'Kidney failure', 'C:\\xampp\\htdocs\\Inward\\css\\img\\20145-190815090839.png', 5, '2015-08-18 22:08:37'),
(5, '201418', 'Lungs pres ', 'C:\\xampp\\htdocs\\Inward\\css\\img\\201418-190815100331.png', 5, '2015-08-18 23:03:30'),
(22, '201526', 'jjj', '\\his\\Home\\Desktop\\dilhara\\images\\201526-160915091033.jpg', 5, '2015-09-16 06:08:49'),
(23, '201526', 'tty', '\\his\\Home\\Desktop\\dilhara\\images\\201526-160915091555.jpg', 5, '2015-09-16 06:14:12'),
(24, '20145', 'gyhu', '/home/his/Desktop/dilhara/images/20145-160915091837.jpeg', 5, '2015-09-16 06:16:54'),
(25, '201526', 'hkl', '/home/his/Desktop/dilhara/images/201526-160915092105.jpeg', 5, '2015-09-16 06:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `ward_wards`
--

CREATE TABLE IF NOT EXISTS `ward_wards` (
  `ward_no` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `ward_gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_wards`
--

INSERT INTO `ward_wards` (`ward_no`, `category`, `ward_gender`) VALUES
('Ward-01', 'Medical', 'Male'),
('Ward-02', 'Sergical', 'Male'),
('Ward-03', 'Sergical', 'Male'),
('Ward-04', 'medical', 'Female'),
('Ward-05', 'Sergical', 'Male');

-- --------------------------------------------------------

--
-- Structure for view `hr_employee_view`
--
DROP TABLE IF EXISTS `hr_employee_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hr_employee_view` AS select `e`.`emp_ID` AS `emp_ID`,`e`.`title` AS `title`,`e`.`first_name` AS `first_name`,`e`.`last_name` AS `last_name`,`e`.`birthday` AS `birthday`,`e`.`gender` AS `gender`,`e`.`civil_status` AS `civil_status`,max((case when (`c`.`contact_type_ID` = '1') then `c`.`contact` end)) AS `Address`,max((case when (`c`.`contact_type_ID` = '2') then `c`.`contact` end)) AS `Phone`,max((case when (`c`.`contact_type_ID` = '3') then `c`.`contact` end)) AS `Mobile`,max((case when (`c`.`contact_type_ID` = '4') then `c`.`contact` end)) AS `Email`,max((case when (`i`.`identity_type_ID` = '1') then `i`.`identity` end)) AS `NIC`,max((case when (`i`.`identity_type_ID` = '2') then `i`.`identity` end)) AS `EPF`,max((case when (`i`.`identity_type_ID` = '3') then `i`.`identity` end)) AS `Driving_Licence`,`dep`.`dept_name` AS `dept_name`,`des`.`designation_name` AS `designation_name` from (((((`hr_employee` `e` left join `hr_contact` `c` on((`e`.`emp_ID` = `c`.`emp_ID`))) left join `hr_identity` `i` on((`e`.`emp_ID` = `i`.`emp_ID`))) left join `hr_workin` `w` on((`e`.`emp_ID` = `w`.`emp_ID`))) left join `hr_department` `dep` on((`w`.`dept_ID` = `dep`.`dept_ID`))) left join `hr_designation` `des` on((`w`.`designation_ID` = `des`.`designation_ID`))) group by `e`.`emp_ID`;

-- --------------------------------------------------------

--
-- Structure for view `pcu_viewinventory`
--
DROP TABLE IF EXISTS `pcu_viewinventory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pcu_viewinventory` AS select `ib`.`s_number` AS `s_number`,`pi`.`name` AS `name`,`pi`.`remark` AS `remark`,`pi`.`last_stock_recieved` AS `last_stock_recieved`,`pi`.`reorder_level` AS `reorder_level`,sum(`ib`.`quantity`) AS `tot_qty` from (`pcu_items` `pi` join `pcu_itembatchrelation` `ib`) where (`pi`.`s_number` = `ib`.`s_number`) group by `ib`.`s_number`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `permission_IDfk_1` (`permission_id`);

--
-- Indexes for table `admin_permissionrequest`
--
ALTER TABLE `admin_permissionrequest`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `requester` (`requester`),
  ADD KEY `approver` (`approver`);

--
-- Indexes for table `admin_rolepermissions`
--
ALTER TABLE `admin_rolepermissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `userName` (`user_name`),
  ADD KEY `user_IDfk_1` (`role_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `admin_userroles`
--
ALTER TABLE `admin_userroles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clinic_patient_attachment`
--
ALTER TABLE `clinic_patient_attachment`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `clinic_patient_history`
--
ALTER TABLE `clinic_patient_history`
  ADD PRIMARY KEY (`clinic_history_id`);

--
-- Indexes for table `clinic_patient_queue`
--
ALTER TABLE `clinic_patient_queue`
  ADD PRIMARY KEY (`clinic_queue_token_no`);

--
-- Indexes for table `clinic_patient_treatment`
--
ALTER TABLE `clinic_patient_treatment`
  ADD PRIMARY KEY (`treatment_id`);

--
-- Indexes for table `clinic_schedule`
--
ALTER TABLE `clinic_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `clinic_visit`
--
ALTER TABLE `clinic_visit`
  ADD PRIMARY KEY (`clinic_visit_id`);

--
-- Indexes for table `clinic_xray`
--
ALTER TABLE `clinic_xray`
  ADD PRIMARY KEY (`xray_id`);

--
-- Indexes for table `cps_info`
--
ALTER TABLE `cps_info`
  ADD PRIMARY KEY (`cps_IP`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_ID`);

--
-- Indexes for table `diabetic_chat`
--
ALTER TABLE `diabetic_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `diabetic_graph`
--
ALTER TABLE `diabetic_graph`
  ADD PRIMARY KEY (`graph_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`),
  ADD KEY `department_ID_idx` (`department_ID`),
  ADD KEY `department_ID_idx1` (`department_ID`);

--
-- Indexes for table `external_patients`
--
ALTER TABLE `external_patients`
  ADD PRIMARY KEY (`patientID`);

--
-- Indexes for table `hin`
--
ALTER TABLE `hin`
  ADD PRIMARY KEY (`hin_Id`);

--
-- Indexes for table `hr_assignschedule`
--
ALTER TABLE `hr_assignschedule`
  ADD PRIMARY KEY (`emp_ID`,`shift_ID`),
  ADD KEY `FK_HR_AssignSchedule_HR_ShiftTimes` (`shift_ID`);

--
-- Indexes for table `hr_attendance`
--
ALTER TABLE `hr_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `hr_contact`
--
ALTER TABLE `hr_contact`
  ADD PRIMARY KEY (`contact_type_ID`,`emp_ID`),
  ADD KEY `FK_HR_Contact_HR_Employee` (`emp_ID`);

--
-- Indexes for table `hr_contacttype`
--
ALTER TABLE `hr_contacttype`
  ADD PRIMARY KEY (`contact_type_ID`);

--
-- Indexes for table `hr_department`
--
ALTER TABLE `hr_department`
  ADD PRIMARY KEY (`dept_ID`),
  ADD KEY `FK_HR_Department_HR_Employee` (`dept_head_ID`);

--
-- Indexes for table `hr_designation`
--
ALTER TABLE `hr_designation`
  ADD PRIMARY KEY (`designation_ID`),
  ADD KEY `group` (`groups`),
  ADD KEY `group_2` (`groups`);

--
-- Indexes for table `hr_designationgroup`
--
ALTER TABLE `hr_designationgroup`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `hr_employee`
--
ALTER TABLE `hr_employee`
  ADD PRIMARY KEY (`emp_ID`);

--
-- Indexes for table `hr_hasleaves`
--
ALTER TABLE `hr_hasleaves`
  ADD PRIMARY KEY (`emp_ID`,`leave_type_ID`),
  ADD KEY `FK_HR_HasLeaves_HR_LeaveType` (`leave_type_ID`);

--
-- Indexes for table `hr_identity`
--
ALTER TABLE `hr_identity`
  ADD PRIMARY KEY (`identity_type_ID`,`emp_ID`),
  ADD KEY `FK_HR_Identity_HR_Employee` (`emp_ID`);

--
-- Indexes for table `hr_identitytype`
--
ALTER TABLE `hr_identitytype`
  ADD PRIMARY KEY (`identity_type_ID`);

--
-- Indexes for table `hr_leavetype`
--
ALTER TABLE `hr_leavetype`
  ADD PRIMARY KEY (`leave_type_ID`);

--
-- Indexes for table `hr_shifttimes`
--
ALTER TABLE `hr_shifttimes`
  ADD PRIMARY KEY (`shift_ID`),
  ADD KEY `FK_HR_ShiftTimes_HR_Department` (`dept_ID`);

--
-- Indexes for table `hr_takeleaves`
--
ALTER TABLE `hr_takeleaves`
  ADD PRIMARY KEY (`emp_ID`,`leave_type_ID`),
  ADD KEY `FK_HR_TakeLeaves_HR_LeaveType` (`leave_type_ID`);

--
-- Indexes for table `hr_userattendance`
--
ALTER TABLE `hr_userattendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hr_workin`
--
ALTER TABLE `hr_workin`
  ADD PRIMARY KEY (`emp_ID`,`dept_ID`,`designation_ID`),
  ADD KEY `FK_HR_Department_HR_Designation` (`designation_ID`),
  ADD KEY `FK_HR_WorkIn_HR_Department` (`dept_ID`);

--
-- Indexes for table `lab_externallabresults`
--
ALTER TABLE `lab_externallabresults`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `ExternalLabResults_TestNames` (`ftest_id`),
  ADD KEY `ExternalLabResults_SubTestFields` (`fsubf_id`),
  ADD KEY `ExternalLabResults_ParentTestFields` (`fparentf_id`),
  ADD KEY `ExtenalLabResults_opd_patient` (`fpatient_id`),
  ADD KEY `ExternalLabResults_User1` (`fadded_user_id`),
  ADD KEY `ExternalLabResults_User2` (`flast_updated_user_id`);

--
-- Indexes for table `lab_inwardlabrequest`
--
ALTER TABLE `lab_inwardlabrequest`
  ADD PRIMARY KEY (`inward_lab_test_request_id`,`bht`);

--
-- Indexes for table `lab_labdepartments`
--
ALTER TABLE `lab_labdepartments`
  ADD PRIMARY KEY (`lab_dept_id`);

--
-- Indexes for table `lab_laboratories`
--
ALTER TABLE `lab_laboratories`
  ADD PRIMARY KEY (`lab_id`),
  ADD KEY `Laboratories_Types` (`flab_type_id`),
  ADD KEY `Laboratories_LabDepartments` (`flab_dept_id`),
  ADD KEY `Laboratories_User1` (`flab_added_user_id`),
  ADD KEY `Laboratories_User2` (`flab_last_updated_user_id`);

--
-- Indexes for table `lab_labtestrequest`
--
ALTER TABLE `lab_labtestrequest`
  ADD PRIMARY KEY (`lab_test_request_id`);

--
-- Indexes for table `lab_mainresults`
--
ALTER TABLE `lab_mainresults`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `MainResults_LabTestRequest` (`ftest_request_id`),
  ADD KEY `MainResults_ParentTestFields` (`fparentf_id`);

--
-- Indexes for table `lab_opdlabrequest`
--
ALTER TABLE `lab_opdlabrequest`
  ADD PRIMARY KEY (`opd_lab_test_request_id`,`patient_visit_id`),
  ADD KEY `OpdLabRequest_Visit` (`patient_visit_id`);

--
-- Indexes for table `lab_parenttestfields`
--
ALTER TABLE `lab_parenttestfields`
  ADD PRIMARY KEY (`parent_field_id`),
  ADD UNIQUE KEY `parent_field_name` (`parent_field_name`),
  ADD KEY `ParentTestFields_TestNames` (`ftest_name_id`);

--
-- Indexes for table `lab_pculabrequest`
--
ALTER TABLE `lab_pculabrequest`
  ADD PRIMARY KEY (`pcu_lab_test_request_id`,`pcu_patient_id`),
  ADD KEY `PcuLabRequest_Admition` (`pcu_patient_id`);

--
-- Indexes for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `Reports_LabTestRequest` (`ftest_request_id`),
  ADD KEY `Reports_opd_patient` (`fpatient_id`);

--
-- Indexes for table `lab_samplecenters`
--
ALTER TABLE `lab_samplecenters`
  ADD PRIMARY KEY (`sample_center_id`),
  ADD KEY `SampleCenters_SampleCenterTypes` (`fsample_center_type_id`),
  ADD KEY `SampleCenters_User1` (`fsample_center_added_user_id`),
  ADD KEY `SampleCenters_User2` (`fsample_center_last_updated_user_id`);

--
-- Indexes for table `lab_samplecentertypes`
--
ALTER TABLE `lab_samplecentertypes`
  ADD PRIMARY KEY (`sample_center_type_id`);

--
-- Indexes for table `lab_specimen`
--
ALTER TABLE `lab_specimen`
  ADD PRIMARY KEY (`specimen_id`),
  ADD KEY `Specimen_User1` (`fspecimen_collected_by`),
  ADD KEY `Specimen_User2` (`fspecimen_receiveded_by`),
  ADD KEY `Specimen_User3` (`fspecimen_delivered_by`),
  ADD KEY `Specimen_SpecimenRetentionType` (`fretention_type_id`),
  ADD KEY `Specimen_SpecimenType` (`fspecimen_type_id`),
  ADD KEY `LabTestRequest_Id` (`flabtest_request_id`);

--
-- Indexes for table `lab_specimenretentiontype`
--
ALTER TABLE `lab_specimenretentiontype`
  ADD PRIMARY KEY (`retention_type_id`),
  ADD UNIQUE KEY `retention_type_name` (`retention_type_name`),
  ADD KEY `SpecimenRetentionType_TestCategory` (`fcategory_id`),
  ADD KEY `SpecimenRetentionType_TestSubCategory` (`fsub_category_id`);

--
-- Indexes for table `lab_specimentype`
--
ALTER TABLE `lab_specimentype`
  ADD PRIMARY KEY (`specimen_type_id`),
  ADD UNIQUE KEY `specimen_type_name` (`specimen_type_name`),
  ADD KEY `SpecimenType_TestCategory` (`fcategory_id`),
  ADD KEY `SpecimenType_TestSubCategory` (`fsub_category_id`);

--
-- Indexes for table `lab_subfieldresults`
--
ALTER TABLE `lab_subfieldresults`
  ADD PRIMARY KEY (`sub_field_result_id`),
  ADD KEY `SubFieldResults_MainResults` (`fmresult_id`),
  ADD KEY `SubFieldResults_ParentTestFields` (`fparentf_id`),
  ADD KEY `SubFieldResults_SubTestFields` (`fsubf_id`);

--
-- Indexes for table `lab_subtestfields`
--
ALTER TABLE `lab_subtestfields`
  ADD PRIMARY KEY (`sub_test_field_id`),
  ADD UNIQUE KEY `sub_test_field_name` (`sub_test_field_name`),
  ADD KEY `SubTestFields_ParentTestFields` (`fpar_test_field_id`);

--
-- Indexes for table `lab_testcategory`
--
ALTER TABLE `lab_testcategory`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `lab_testfieldsrange`
--
ALTER TABLE `lab_testfieldsrange`
  ADD PRIMARY KEY (`range_id`),
  ADD KEY `TestFieldsRange_ParentTestFields` (`fparent_field_id`),
  ADD KEY `TestFieldsRange_SubTestFields` (`fsub_field_id`);

--
-- Indexes for table `lab_testnames`
--
ALTER TABLE `lab_testnames`
  ADD PRIMARY KEY (`test_id`),
  ADD UNIQUE KEY `test_name` (`test_name`),
  ADD KEY `TestNames_TestCategory` (`ftest_category_id`),
  ADD KEY `TestNames_TestSubCategory` (`ftest_sub_category_id`),
  ADD KEY `TestNames_User1` (`ftest_create_user_id`),
  ADD KEY `TestNames_User2` (`ftest_last_update_user_id`);

--
-- Indexes for table `lab_testsubcategory`
--
ALTER TABLE `lab_testsubcategory`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD UNIQUE KEY `sub_category_name` (`sub_category_name`),
  ADD KEY `TestSubCategory_TestCategory` (`fcategory_id`);

--
-- Indexes for table `lab_types`
--
ALTER TABLE `lab_types`
  ADD PRIMARY KEY (`lab_type_id`),
  ADD UNIQUE KEY `lab_type_name` (`lab_type_name`);

--
-- Indexes for table `liveallergies`
--
ALTER TABLE `liveallergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liveinjury`
--
ALTER TABLE `liveinjury`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opd_patient`
--
ALTER TABLE `opd_patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `patient_create_user` (`patient_create_user`),
  ADD KEY `patient_lastupdate_user` (`patient_lastupdate_user`),
  ADD KEY `patient_create_user_2` (`patient_create_user`);

--
-- Indexes for table `opd_patient_allergy`
--
ALTER TABLE `opd_patient_allergy`
  ADD PRIMARY KEY (`allergy_id`),
  ADD KEY `FK_OPD_Allergy_CreateUser` (`allergy_create_user`),
  ADD KEY `FK_OPD_Allergy_Patient_ID` (`patient_id`),
  ADD KEY `FK_OPD_Allergy_UpdateUser` (`allergy_lastupdate_user`),
  ADD KEY `allergy_create_user` (`allergy_create_user`),
  ADD KEY `allergy_lastupdate_user` (`allergy_lastupdate_user`);

--
-- Indexes for table `opd_patient_attachment`
--
ALTER TABLE `opd_patient_attachment`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `FK_OPD_Attached_by` (`attachment_attached_by`),
  ADD KEY `FK_OPD_Attachment_createUser` (`attachment_create_user`),
  ADD KEY `FK_OPD_Attachment_patient_ID` (`patient_id`),
  ADD KEY `FK_OPD_Attachment_UpdateUser` (`attachment_last_update_user`),
  ADD KEY `attachment_attached_by` (`attachment_attached_by`);

--
-- Indexes for table `opd_patient_examination`
--
ALTER TABLE `opd_patient_examination`
  ADD PRIMARY KEY (`examination_id`),
  ADD KEY `FK_OPD_Patient_Examination_VisitID` (`visit_id`);

--
-- Indexes for table `opd_patient_history`
--
ALTER TABLE `opd_patient_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `FK_OPD_History_CreateUser` (`history_create_user`),
  ADD KEY `FK_OPD_History_Patient_ID` (`patient_id`),
  ADD KEY `FK_OPD_History_UpdateUser` (`history_lastupdate_user`);

--
-- Indexes for table `opd_patient_queue`
--
ALTER TABLE `opd_patient_queue`
  ADD PRIMARY KEY (`queue_assign_time`),
  ADD KEY `FK_OPD_Queue_AssignBy` (`queue_assign_by`),
  ADD KEY `FK_OPD_Queue_AssignTo` (`queue_assign_to`),
  ADD KEY `FK_OPD_Queue_Paient_ID` (`patient_id`);

--
-- Indexes for table `opd_patient_record`
--
ALTER TABLE `opd_patient_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `FK_OPD_Record_CreateUser` (`record_create_user`),
  ADD KEY `FK_OPD_Record_patient_ID` (`patient_id`),
  ADD KEY `FK_OPD_Record_UpdateUser` (`record_last_update_user`);

--
-- Indexes for table `opd_patient_visit`
--
ALTER TABLE `opd_patient_visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `FK_OPD_Visit_ceateUser` (`visit_create_user`),
  ADD KEY `FK_OPD_Visit_DoctorID` (`visit_doctor`),
  ADD KEY `FK_OPD_Visit_patient_ID` (`patient_id`),
  ADD KEY `FK_OPD_Visit_UpdateUser` (`visit_last_update_user`);

--
-- Indexes for table `opd_prescription`
--
ALTER TABLE `opd_prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `opd_prescription_item`
--
ALTER TABLE `opd_prescription_item`
  ADD PRIMARY KEY (`prescription_item_id`),
  ADD KEY `prescription_id` (`prescription_id`);

--
-- Indexes for table `opd_question`
--
ALTER TABLE `opd_question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `FK_OPD_QuestionnaireID` (`questionnaire_id`);

--
-- Indexes for table `opd_questionanswer`
--
ALTER TABLE `opd_questionanswer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `FK_OPD_QuestionID` (`question_id`),
  ADD KEY `FK_OPD_Question_AnswerSet_ID` (`answer_set_id`);

--
-- Indexes for table `opd_questionanswerset`
--
ALTER TABLE `opd_questionanswerset`
  ADD PRIMARY KEY (`answer_setid`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `answerSet_lastupdate_user` (`answerSet_lastupdate_user`),
  ADD KEY `answerSet_lastupdate_date` (`answerSet_lastupdate_date`);

--
-- Indexes for table `opd_questionnaire`
--
ALTER TABLE `opd_questionnaire`
  ADD PRIMARY KEY (`questionnaire_id`),
  ADD KEY `FK_OPD_Question_CreateUser` (`questionnaire_create_user`),
  ADD KEY `FK_OPD_Question_UpdateUser` (`questionnaire_lastupdate_user`);

--
-- Indexes for table `pcu_admition`
--
ALTER TABLE `pcu_admition`
  ADD PRIMARY KEY (`admition_id`);

--
-- Indexes for table `pcu_expireditems`
--
ALTER TABLE `pcu_expireditems`
  ADD PRIMARY KEY (`s_number`,`batch_no`);

--
-- Indexes for table `pcu_itembatch`
--
ALTER TABLE `pcu_itembatch`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `pcu_itembatchrelation`
--
ALTER TABLE `pcu_itembatchrelation`
  ADD PRIMARY KEY (`s_number`,`batch_no`),
  ADD KEY `FK_PCU_ItemBatchRelation_PCU_ItemBatch` (`batch_no`);

--
-- Indexes for table `pcu_items`
--
ALTER TABLE `pcu_items`
  ADD PRIMARY KEY (`s_number`);

--
-- Indexes for table `pcu_itemstockday`
--
ALTER TABLE `pcu_itemstockday`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `pcu_manualdispense`
--
ALTER TABLE `pcu_manualdispense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcu_nursenote`
--
ALTER TABLE `pcu_nursenote`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `pcu_patientsymtoms`
--
ALTER TABLE `pcu_patientsymtoms`
  ADD PRIMARY KEY (`symtoms_id`);

--
-- Indexes for table `pcu_prescription`
--
ALTER TABLE `pcu_prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `pcu_prescriptiondispense`
--
ALTER TABLE `pcu_prescriptiondispense`
  ADD PRIMARY KEY (`prescription_id`,`s_number`);

--
-- Indexes for table `pcu_prescriptionitems`
--
ALTER TABLE `pcu_prescriptionitems`
  ADD PRIMARY KEY (`prescription_id`,`s_number`);

--
-- Indexes for table `pcu_requesteditems`
--
ALTER TABLE `pcu_requesteditems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `s_number_UNIQUE` (`s_number`);

--
-- Indexes for table `pharm_asst_stock`
--
ALTER TABLE `pharm_asst_stock`
  ADD PRIMARY KEY (`drug_srno`);

--
-- Indexes for table `pharm_dispensedrug`
--
ALTER TABLE `pharm_dispensedrug`
  ADD PRIMARY KEY (`dispense_drugs_id`);

--
-- Indexes for table `pharm_dosage`
--
ALTER TABLE `pharm_dosage`
  ADD PRIMARY KEY (`dosage_id`);

--
-- Indexes for table `pharm_drug`
--
ALTER TABLE `pharm_drug`
  ADD PRIMARY KEY (`drug_srno`),
  ADD KEY `drug_categoryid` (`drug_categoryid`);

--
-- Indexes for table `pharm_drugcategory`
--
ALTER TABLE `pharm_drugcategory`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `pharm_drugdosage`
--
ALTER TABLE `pharm_drugdosage`
  ADD PRIMARY KEY (`drugdosage_id`,`drugdosage_srno`);

--
-- Indexes for table `pharm_drugmanufacturer`
--
ALTER TABLE `pharm_drugmanufacturer`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `pharm_drugrequests`
--
ALTER TABLE `pharm_drugrequests`
  ADD PRIMARY KEY (`request_drug_id`),
  ADD KEY `request_drug_srno` (`request_drug_srno`);

--
-- Indexes for table `pharm_drugssupplied`
--
ALTER TABLE `pharm_drugssupplied`
  ADD PRIMARY KEY (`drug_supplied_srno`,`drug_supplied_batchno`),
  ADD KEY `drug_supplied_srno` (`drug_supplied_srno`);

--
-- Indexes for table `pharm_email`
--
ALTER TABLE `pharm_email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `pharm_frequency`
--
ALTER TABLE `pharm_frequency`
  ADD PRIMARY KEY (`frequency_id`);

--
-- Indexes for table `ward_admission`
--
ALTER TABLE `ward_admission`
  ADD PRIMARY KEY (`bht_no`);

--
-- Indexes for table `ward_admission_request`
--
ALTER TABLE `ward_admission_request`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `patient_id` (`patient_id`,`transfer_ward`,`create_user`),
  ADD KEY `last_update_user` (`last_update_user`);

--
-- Indexes for table `ward_beds`
--
ALTER TABLE `ward_beds`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `ward_diabeticchart`
--
ALTER TABLE `ward_diabeticchart`
  ADD PRIMARY KEY (`row_no`);

--
-- Indexes for table `ward_externaltransfer`
--
ALTER TABLE `ward_externaltransfer`
  ADD PRIMARY KEY (`transfer_id`,`bht_no`);

--
-- Indexes for table `ward_internaltransfer`
--
ALTER TABLE `ward_internaltransfer`
  ADD PRIMARY KEY (`tranfer_id`,`bht_no`);

--
-- Indexes for table `ward_liquidbalancechart`
--
ALTER TABLE `ward_liquidbalancechart`
  ADD PRIMARY KEY (`row_no`);

--
-- Indexes for table `ward_nursenote`
--
ALTER TABLE `ward_nursenote`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `ward_operations`
--
ALTER TABLE `ward_operations`
  ADD PRIMARY KEY (`operation_id`,`bht_no`);

--
-- Indexes for table `ward_prescription_terms`
--
ALTER TABLE `ward_prescription_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `bht_no` (`bht_no`,`create_user`);

--
-- Indexes for table `ward_prescriptionitem`
--
ALTER TABLE `ward_prescriptionitem`
  ADD PRIMARY KEY (`auto_id`,`term_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- Indexes for table `ward_prescriptions`
--
ALTER TABLE `ward_prescriptions`
  ADD PRIMARY KEY (`prescribe_id`,`bht_no`);

--
-- Indexes for table `ward_signature`
--
ALTER TABLE `ward_signature`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `ward_surgicalobsrchart`
--
ALTER TABLE `ward_surgicalobsrchart`
  ADD PRIMARY KEY (`row_no`);

--
-- Indexes for table `ward_temp_prescribe`
--
ALTER TABLE `ward_temp_prescribe`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `ward_temperaturechart`
--
ALTER TABLE `ward_temperaturechart`
  ADD PRIMARY KEY (`row_no`);

--
-- Indexes for table `ward_treatment`
--
ALTER TABLE `ward_treatment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward_wards`
--
ALTER TABLE `ward_wards`
  ADD PRIMARY KEY (`ward_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_permission`
--
ALTER TABLE `admin_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `admin_permissionrequest`
--
ALTER TABLE `admin_permissionrequest`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `admin_userroles`
--
ALTER TABLE `admin_userroles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `diabetic_chat`
--
ALTER TABLE `diabetic_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diabetic_graph`
--
ALTER TABLE `diabetic_graph`
  MODIFY `graph_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hin`
--
ALTER TABLE `hin`
  MODIFY `hin_Id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hr_attendance`
--
ALTER TABLE `hr_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hr_contacttype`
--
ALTER TABLE `hr_contacttype`
  MODIFY `contact_type_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_department`
--
ALTER TABLE `hr_department`
  MODIFY `dept_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hr_designation`
--
ALTER TABLE `hr_designation`
  MODIFY `designation_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `hr_designationgroup`
--
ALTER TABLE `hr_designationgroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hr_employee`
--
ALTER TABLE `hr_employee`
  MODIFY `emp_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `hr_identitytype`
--
ALTER TABLE `hr_identitytype`
  MODIFY `identity_type_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_leavetype`
--
ALTER TABLE `hr_leavetype`
  MODIFY `leave_type_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_shifttimes`
--
ALTER TABLE `hr_shifttimes`
  MODIFY `shift_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_externallabresults`
--
ALTER TABLE `lab_externallabresults`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_labdepartments`
--
ALTER TABLE `lab_labdepartments`
  MODIFY `lab_dept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lab_laboratories`
--
ALTER TABLE `lab_laboratories`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lab_labtestrequest`
--
ALTER TABLE `lab_labtestrequest`
  MODIFY `lab_test_request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lab_mainresults`
--
ALTER TABLE `lab_mainresults`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `lab_parenttestfields`
--
ALTER TABLE `lab_parenttestfields`
  MODIFY `parent_field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `lab_reports`
--
ALTER TABLE `lab_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_samplecenters`
--
ALTER TABLE `lab_samplecenters`
  MODIFY `sample_center_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lab_samplecentertypes`
--
ALTER TABLE `lab_samplecentertypes`
  MODIFY `sample_center_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lab_specimen`
--
ALTER TABLE `lab_specimen`
  MODIFY `specimen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lab_specimenretentiontype`
--
ALTER TABLE `lab_specimenretentiontype`
  MODIFY `retention_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lab_specimentype`
--
ALTER TABLE `lab_specimentype`
  MODIFY `specimen_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lab_subfieldresults`
--
ALTER TABLE `lab_subfieldresults`
  MODIFY `sub_field_result_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_subtestfields`
--
ALTER TABLE `lab_subtestfields`
  MODIFY `sub_test_field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lab_testcategory`
--
ALTER TABLE `lab_testcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lab_testfieldsrange`
--
ALTER TABLE `lab_testfieldsrange`
  MODIFY `range_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `lab_testnames`
--
ALTER TABLE `lab_testnames`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `lab_testsubcategory`
--
ALTER TABLE `lab_testsubcategory`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lab_types`
--
ALTER TABLE `lab_types`
  MODIFY `lab_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `liveallergies`
--
ALTER TABLE `liveallergies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `liveinjury`
--
ALTER TABLE `liveinjury`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opd_patient`
--
ALTER TABLE `opd_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `opd_patient_allergy`
--
ALTER TABLE `opd_patient_allergy`
  MODIFY `allergy_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `opd_patient_attachment`
--
ALTER TABLE `opd_patient_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `opd_patient_examination`
--
ALTER TABLE `opd_patient_examination`
  MODIFY `examination_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `opd_patient_history`
--
ALTER TABLE `opd_patient_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opd_patient_record`
--
ALTER TABLE `opd_patient_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `opd_patient_visit`
--
ALTER TABLE `opd_patient_visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `opd_prescription`
--
ALTER TABLE `opd_prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `opd_prescription_item`
--
ALTER TABLE `opd_prescription_item`
  MODIFY `prescription_item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `opd_question`
--
ALTER TABLE `opd_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opd_questionanswer`
--
ALTER TABLE `opd_questionanswer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opd_questionanswerset`
--
ALTER TABLE `opd_questionanswerset`
  MODIFY `answer_setid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opd_questionnaire`
--
ALTER TABLE `opd_questionnaire`
  MODIFY `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_admition`
--
ALTER TABLE `pcu_admition`
  MODIFY `admition_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_items`
--
ALTER TABLE `pcu_items`
  MODIFY `s_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_manualdispense`
--
ALTER TABLE `pcu_manualdispense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_nursenote`
--
ALTER TABLE `pcu_nursenote`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_patientsymtoms`
--
ALTER TABLE `pcu_patientsymtoms`
  MODIFY `symtoms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_prescription`
--
ALTER TABLE `pcu_prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcu_requesteditems`
--
ALTER TABLE `pcu_requesteditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pharm_dispensedrug`
--
ALTER TABLE `pharm_dispensedrug`
  MODIFY `dispense_drugs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `pharm_dosage`
--
ALTER TABLE `pharm_dosage`
  MODIFY `dosage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pharm_drug`
--
ALTER TABLE `pharm_drug`
  MODIFY `drug_srno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `pharm_drugcategory`
--
ALTER TABLE `pharm_drugcategory`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pharm_drugmanufacturer`
--
ALTER TABLE `pharm_drugmanufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharm_drugrequests`
--
ALTER TABLE `pharm_drugrequests`
  MODIFY `request_drug_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharm_email`
--
ALTER TABLE `pharm_email`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharm_frequency`
--
ALTER TABLE `pharm_frequency`
  MODIFY `frequency_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ward_admission_request`
--
ALTER TABLE `ward_admission_request`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ward_beds`
--
ALTER TABLE `ward_beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `ward_diabeticchart`
--
ALTER TABLE `ward_diabeticchart`
  MODIFY `row_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ward_externaltransfer`
--
ALTER TABLE `ward_externaltransfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ward_internaltransfer`
--
ALTER TABLE `ward_internaltransfer`
  MODIFY `tranfer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ward_liquidbalancechart`
--
ALTER TABLE `ward_liquidbalancechart`
  MODIFY `row_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ward_nursenote`
--
ALTER TABLE `ward_nursenote`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ward_operations`
--
ALTER TABLE `ward_operations`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ward_prescription_terms`
--
ALTER TABLE `ward_prescription_terms`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `ward_prescriptionitem`
--
ALTER TABLE `ward_prescriptionitem`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `ward_prescriptions`
--
ALTER TABLE `ward_prescriptions`
  MODIFY `prescribe_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ward_signature`
--
ALTER TABLE `ward_signature`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ward_surgicalobsrchart`
--
ALTER TABLE `ward_surgicalobsrchart`
  MODIFY `row_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ward_temp_prescribe`
--
ALTER TABLE `ward_temp_prescribe`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `ward_temperaturechart`
--
ALTER TABLE `ward_temperaturechart`
  MODIFY `row_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ward_treatment`
--
ALTER TABLE `ward_treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;--
-- Database: `cdcol`
--

-- --------------------------------------------------------

--
-- Table structure for table `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `titel` varchar(200) DEFAULT NULL,
  `interpret` varchar(200) DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cds`
--

INSERT INTO `cds` (`titel`, `interpret`, `jahr`, `id`) VALUES
('Beauty', 'Ryuichi Sakamoto', 1990, 1),
('Goodbye Country (Hello Nightclub)', 'Groove Armada', 2001, 4),
('Glee', 'Bran Van 3000', 1997, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cds`
--
ALTER TABLE `cds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cds`
--
ALTER TABLE `cds`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE IF NOT EXISTS `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE IF NOT EXISTS `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE IF NOT EXISTS `pma__column_info` (
  `id` int(5) unsigned NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma__designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE IF NOT EXISTS `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE IF NOT EXISTS `pma__history` (
  `id` bigint(20) unsigned NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE IF NOT EXISTS `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE IF NOT EXISTS `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{"db":"HIS","table":"ward_treatment"},{"db":"HIS","table":"ward_admission"},{"db":"HIS","table":"ward_admission_request"},{"db":"HIS","table":"lab_labtestrequest"},{"db":"HIS","table":"opd_prescription"},{"db":"HIS","table":"ward_prescriptions"},{"db":"HIS","table":"ward_prescription_terms"},{"db":"HIS","table":"pharm_drug"},{"db":"HIS","table":"opd_patient_visit"},{"db":"HIS","table":"opd_prescription_item"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE IF NOT EXISTS `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE IF NOT EXISTS `pma__savedsearches` (
  `id` int(5) unsigned NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE IF NOT EXISTS `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE IF NOT EXISTS `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE IF NOT EXISTS `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE IF NOT EXISTS `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2015-08-13 09:15:36', '{"collation_connection":"utf8mb4_general_ci"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE IF NOT EXISTS `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE IF NOT EXISTS `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_coords`
--
ALTER TABLE `pma__designer_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
