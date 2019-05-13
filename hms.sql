-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 08:27 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `houseno` int(5) NOT NULL,
  `streetno` int(5) NOT NULL,
  `city` varchar(64) NOT NULL,
  `province` varchar(64) NOT NULL,
  `zipcode` int(8) NOT NULL,
  `country` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `houseno`, `streetno`, `city`, `province`, `zipcode`, `country`) VALUES
(3, 69, 69, 'Lahore', 'Punjab', 54000, 'Pakistan'),
(4, 69, 69, 'Lahore', 'Punjab', 54000, 'Pakistan'),
(5, 1, 3, 'Peshawar', 'KPK', 100, 'Pakistan'),
(6, 5, 4, 'Larkana', 'Punjab', 1400, 'Pakistan'),
(7, 59, 34, 'Lahore', 'Punjab', 14000, 'Pakistan'),
(8, 12, 19, 'Sialkot', 'Punjab', 5000, 'Pakistan'),
(9, 56, 24, 'Karachi', 'Sindh', 6500, 'Pakistan'),
(10, 17, 20, 'Quetta', 'Balochistan', 8000, 'Pakistan'),
(11, 31, 34, 'Gujrat', 'Punjab', 5700, 'Pakistan'),
(14, 4, 1, 'lahore', 'punjab', 54000, 'Pakistan'),
(15, 0, 0, '', '', 0, ''),
(16, 51, 56, 'asdf', 'Sindh', 56982, 'India'),
(17, 0, 0, '', '', 0, ''),
(18, 0, 0, '', '', 0, ''),
(19, 51, 56, 'asdf', 'Sindh', 56982, 'India'),
(20, 51, 56, 'asdf', 'Sindh', 56982, 'India'),
(21, 0, 0, 'HJB', 'JKHB', 0, 'B'),
(22, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(23, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(24, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(25, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(26, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(27, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(28, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(29, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(30, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(31, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(32, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(33, 0, 0, 'hb', 'hjb', 0, 'kjhb'),
(34, 0, 0, 'j', 'hb', 0, 'asdf'),
(35, 0, 0, '51', '651', 6, '651'),
(36, 65, 651, '6516', '51', 651, '651'),
(37, 54, 56, 'Jacobabad', 'Sindh', 5650, 'Pakistan'),
(38, 0, 0, 'vgh', 'hgv', 0, 'hgvhg'),
(39, 51, 51, 'Quetta', 'Balochistan', 58498, 'Pakistan'),
(40, 51651, 561651, '56165', '1561', 1651, '65156');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `name`) VALUES
(1, 'Administration'),
(2, 'Misc'),
(3, 'Accident and emergency (A&E)'),
(4, 'Anaesthetics'),
(5, 'Breast screening'),
(6, 'Cardiology'),
(7, 'Chaplaincy'),
(8, 'Critical care'),
(9, 'Diagnostic imaging'),
(10, 'Discharge lounge'),
(11, 'Ear nose and throat (ENT)'),
(12, 'Elderly services'),
(13, 'Gastroenterology'),
(14, 'Endoscopy'),
(15, 'General surgery'),
(16, 'Gynaecology'),
(17, 'Haematology'),
(18, 'Maternity departments'),
(19, 'Microbiology'),
(20, 'Neonatal unit'),
(21, 'Nephrology'),
(22, 'Neurology'),
(23, 'Nutrition and dietetics'),
(24, 'Obstetrics and gynaecology units'),
(25, 'Occupational therapy'),
(26, 'Oncology'),
(27, 'Ophthalmology'),
(28, 'Orthopaedics'),
(29, 'Pain management clinics'),
(30, 'Pharmacy'),
(31, 'Physiotherapy'),
(32, 'Radiotherapy'),
(33, 'Renal unit'),
(34, 'Rheumatology'),
(35, 'Sexual health (genitourinary medicine)'),
(36, 'Urology');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_type_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) DEFAULT NULL,
  `dob` date NOT NULL,
  `sex` char(1) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `email` varchar(64) NOT NULL,
  `qualification` varchar(64) DEFAULT NULL,
  `salary` int(8) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hiredate` date NOT NULL,
  `mobile1` varchar(20) NOT NULL,
  `mobile2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_type_id`, `dept_id`, `address_id`, `fname`, `lname`, `dob`, `sex`, `cnic`, `email`, `qualification`, `salary`, `username`, `password`, `hiredate`, `mobile1`, `mobile2`) VALUES
(3, 1, 1, 3, 'Mohsin', 'Ali', '2000-01-01', 'M', '43102-8745695-6', '', 'BS', 0, 'mohsin44', '786786', '2017-05-13', '923122512081', NULL),
(5, 2, 4, 3, 'Shafiq', 'Rana', '2000-01-01', 'M', '41203923418', '', 'Blah blah blah', 0, 'shafiqrana', 'sid', '2017-05-19', '923132434243', NULL),
(8, 4, 36, 3, 'Aaqib', 'Ashfaq', '2000-01-01', 'M', '2423435523', '', 'pucha', 0, 'aaqib29', 'aqib', '0000-00-00', '923432452345', NULL),
(9, 3, 29, 3, 'Ansha', 'Nawaz', '1996-05-16', 'F', '210933342524', '', 'Data Miner', 0, 'ansha01', 'nawaz', '2017-05-24', '9241413453456', NULL),
(11, 5, 15, 3, 'Anees', 'Bhatti', '2000-01-01', 'M', '41233423023', '', 'PF Pass', 0, 'anees18', 'anees', '2017-03-15', '9231499953321', NULL),
(14, 5, 3, 40, 'Tahir', 'Ahmed', '2017-06-20', 'M', '165168465', 'asd@adsfa.asd', 'adsf', 0, 'tahir', 'tahir', '2017-05-25', '51651', '651561');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `employee_type_id` int(11) NOT NULL,
  `typename` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`employee_type_id`, `typename`) VALUES
(1, 'Administrator'),
(2, 'Doctor'),
(3, 'Nurse'),
(4, 'Receptionist'),
(5, 'Pharmacist');

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `patient_id` int(5) NOT NULL,
  `med_rec_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_record`
--

INSERT INTO `medical_record` (`patient_id`, `med_rec_id`) VALUES
(11, 5),
(11, 6),
(11, 7),
(11, 8),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(11, 14);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `med_id` int(11) NOT NULL,
  `med_name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`med_id`, `med_name`, `description`, `price`) VALUES
(6, 'Disprin', '', 100),
(8, 'Panadol', '', 500),
(9, 'Flagyl', 'twice a day', 0),
(10, 'Espresso', 'twice a day', 10),
(11, 'Augmentin', '', 100),
(12, 'Nexum', '', 100),
(13, '', '', 560),
(14, 'asdf', 'adsf', 6515),
(15, 'a', 'a', 5),
(16, 'Wegra', 'Make timing', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `miscstaff`
--

CREATE TABLE `miscstaff` (
  `staff_id` int(11) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `sex` char(1) NOT NULL,
  `job` varchar(32) NOT NULL,
  `address_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `mobile1` varchar(12) NOT NULL,
  `mobile2` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `operation_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `price` int(8) NOT NULL,
  `estimated_time` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`operation_id`, `title`, `price`, `estimated_time`, `description`) VALUES
(1, 'Heart Surgery', 200000, '5-8 hour', ''),
(2, 'Bypass', 400000, '5-8 hour', ''),
(3, 'Brain Tumour', 600000, '10-12 hour', ''),
(4, 'adf', 651, '56', 'adf'),
(5, 'op', 5, '5', 'op');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(5) NOT NULL,
  `address_id` int(5) NOT NULL,
  `fname` varchar(12) NOT NULL,
  `lname` varchar(12) NOT NULL,
  `mobileno` int(15) NOT NULL,
  `registration_date` date NOT NULL,
  `dob` date NOT NULL,
  `sex` char(1) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `emergencyno` varchar(12) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `address_id`, `fname`, `lname`, `mobileno`, `registration_date`, `dob`, `sex`, `cnic`, `emergencyno`, `email`) VALUES
(4, 7, 'Faiq', 'Hussain', 0, '2008-05-19', '1997-08-12', 'm', '3520124599874', '', ''),
(11, 39, 'Asad', 'Ali', 1565161, '2017-05-25', '2017-05-25', 'M', '84651984685456', '561561', 'af@asd.sad');

-- --------------------------------------------------------

--
-- Table structure for table `precription_rec`
--

CREATE TABLE `precription_rec` (
  `visit_rec_id` int(5) NOT NULL,
  `presc_id` int(5) NOT NULL,
  `remarks` text,
  `disease` varchar(30) DEFAULT NULL,
  `operation_id` int(5) DEFAULT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presc_med`
--

CREATE TABLE `presc_med` (
  `presc_id` int(5) NOT NULL,
  `med_id` int(5) NOT NULL,
  `recommendation` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `nurse_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `type`, `patient_id`, `nurse_id`) VALUES
(1, 'Presidential Suite', NULL, 9),
(2, 'Executive Suite', NULL, NULL),
(3, 'Deluxe Suite', NULL, NULL),
(4, 'Junior Suite', NULL, NULL),
(5, 'Executive Single Room', NULL, NULL),
(6, 'Single Room', NULL, NULL),
(7, 'Two-bedded Room', NULL, NULL),
(8, 'Four-bedded Room', NULL, NULL),
(9, 'adsf', NULL, NULL),
(10, 'adsf', NULL, NULL),
(11, 'asdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit_record`
--

CREATE TABLE `visit_record` (
  `med_rec_id` int(5) NOT NULL,
  `visit_rec_id` int(5) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `in_out_door` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `employee_type_id_fk` (`employee_type_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`employee_type_id`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`med_rec_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `miscstaff`
--
ALTER TABLE `miscstaff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `patient_address_id_fk` (`address_id`);

--
-- Indexes for table `precription_rec`
--
ALTER TABLE `precription_rec`
  ADD PRIMARY KEY (`presc_id`),
  ADD KEY `visit_rec_id` (`visit_rec_id`),
  ADD KEY `precription_rec_patient_id_fk` (`patient_id`),
  ADD KEY `precription_rec_operation_id_fk` (`operation_id`);

--
-- Indexes for table `presc_med`
--
ALTER TABLE `presc_med`
  ADD KEY `presc_id` (`presc_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `nurse_id` (`nurse_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `visit_record`
--
ALTER TABLE `visit_record`
  ADD PRIMARY KEY (`visit_rec_id`),
  ADD KEY `med_rec_id` (`med_rec_id`),
  ADD KEY `vist_rec_doctor_id_fk` (`doctor_id`),
  ADD KEY `visit_record_patient_id_fk` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `employee_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `med_rec_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `miscstaff`
--
ALTER TABLE `miscstaff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operation`
--
ALTER TABLE `operation`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `precription_rec`
--
ALTER TABLE `precription_rec`
  MODIFY `presc_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `visit_record`
--
ALTER TABLE `visit_record`
  MODIFY `visit_rec_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `employee_type_id_fk` FOREIGN KEY (`employee_type_id`) REFERENCES `employee_type` (`employee_type_id`);

--
-- Constraints for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD CONSTRAINT `medical_record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `miscstaff`
--
ALTER TABLE `miscstaff`
  ADD CONSTRAINT `miscstaff_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_address_id_fk` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `precription_rec`
--
ALTER TABLE `precription_rec`
  ADD CONSTRAINT `precription_rec_ibfk_1` FOREIGN KEY (`visit_rec_id`) REFERENCES `visit_record` (`visit_rec_id`),
  ADD CONSTRAINT `precription_rec_operation_id_fk` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`operation_id`),
  ADD CONSTRAINT `precription_rec_patient_id_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `presc_med`
--
ALTER TABLE `presc_med`
  ADD CONSTRAINT `presc_med_ibfk_1` FOREIGN KEY (`presc_id`) REFERENCES `precription_rec` (`presc_id`),
  ADD CONSTRAINT `presc_med_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`med_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `visit_record`
--
ALTER TABLE `visit_record`
  ADD CONSTRAINT `visit_record_ibfk_1` FOREIGN KEY (`med_rec_id`) REFERENCES `medical_record` (`med_rec_id`),
  ADD CONSTRAINT `visit_record_patient_id_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `vist_rec_doctor_id_fk` FOREIGN KEY (`doctor_id`) REFERENCES `employee` (`employee_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
