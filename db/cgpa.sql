-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 09:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cgpa`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator_control`
--

CREATE TABLE `administrator_control` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `resumption_date` date DEFAULT NULL,
  `admin_sign` varchar(255) DEFAULT NULL,
  `no_of_jss` int(11) DEFAULT NULL,
  `no_of_days_ss` int(11) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `school_address1` varchar(255) DEFAULT NULL,
  `school_address2` varchar(255) DEFAULT NULL,
  `school_logo` varchar(255) DEFAULT NULL,
  `session1` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `school_type` varchar(255) DEFAULT NULL,
  `term_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_unit` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `course` text DEFAULT NULL,
  `session1` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_title`, `course_code`, `course_unit`, `level`, `semester`, `course`, `session1`, `created_at`, `updated_at`) VALUES
(2, 'PROFESSIONAL ETHICS', 'CHE 211', 1, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(3, 'ANATOMY  AND PHYSIOLOGY 1', 'CHE 212', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(4, 'BEHAVIOUR CHANGE COMMUNICATION', 'CHE 213', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(5, 'HUMAN NUTRITION', 'CHE 214', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(6, 'INTRODUCTION TO PRIMARY HEALTH CARE', 'CHE 215', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(7, 'INTRODUCTION TO PSYCHOLOGY', 'GNS411', 1, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(8, 'INTRODUCTION TO ENVIRONMETAL HEALTH', 'EHT 111', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(9, 'INTRODUCTION TO COMPUTER', 'COM 111', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(10, 'INTRODUCTION TO MEDICAL SOCIOLOGY', 'GNS 213', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(11, 'GEOGRAPHY', 'FOT 111', 1, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(12, 'CITIZENSHIP EDUCATION', 'GNS 111', 1, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(13, 'SYMPTOMATOLOGY', 'CHE 221', 2, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(14, 'POPULATION DYNAMICS AND FAMILY PLANNING', 'CHE 222', 3, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(15, 'CLINICAL SKILLS 1', 'CHE 223', 3, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(16, 'SCIENCE LABORATORY TECHNOLOGY', 'STB 211', 3, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(17, 'IMMUNITY AND IMMUNIZATION', 'CHE 224', 2, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(18, 'CONTROL OF COMMUNICABLE DISEASES', 'CHE 225', 2, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(19, 'ACCIDENT AND EMERGENCY', 'CHE 226', 2, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(20, 'SUPERVISED CLINICAL EXPERIENCE  1', 'CHE 227', 3, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(21, 'COMMUNICATION IN ENGLISH', 'GNS 102', 2, '100', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(22, 'Introduction to Dental Science', 'IDS 101', 2, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(23, 'Human Biology 1 (Anatomy & Physiology)', 'HB 1 101', 5, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(24, 'Physics/Chemistry', 'PHY & CHE 101', 1, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(25, 'Behavioural Science', 'BHS 101', 3, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(26, 'The Use of English Languge', 'GNS 101', 2, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(27, 'Primary Health Care', 'PHC 101', 2, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(28, 'Oral Health Sciences', 'OHS 101', 4, '100', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(29, 'Huuman Biology (Anatomy & Physiology)', 'HB 102', 4, '100', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(30, 'Nutrition/Biochemistry', 'NB 102', 2, '100', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(31, 'Pharmacology 1', 'PHARM 102', 2, '100', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(32, 'Microbiology and Sterilization', 'MBS 102', 3, '100', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(33, 'Behavioural Science', 'BHS 102', 2, '100', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(34, 'Pharmacology II', 'PHARM 201', 2, '200', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(35, 'Primary Oral Health', 'POH 201', 3, '200', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(36, 'Statistical Methods', 'STM 201', 3, '200', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(37, 'Research in Dental Practice', 'RDP 201', 3, '200', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(38, 'Occupational Health', 'OCH 201', 2, '200', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(39, 'Medical Emergencies in Dental Practice', 'MEDP 202', 4, '200', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(40, 'Dental marterial Science', 'DMS 202', 3, '200', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(41, 'Pain and anxiety control in Dental Practice', 'PAC 202', 2, '200', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(42, 'Dental Radiology', 'DRA 202', 2, '200', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(43, 'Restorative Dentistry', 'RD 202', 1, '200', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(44, 'Community Oral Health', 'OAC 301', 4, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(45, 'Restorative Dentistry', 'RD 301', 1, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(46, 'Child Dental Health', 'CDH 301', 2, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(47, 'Oral and Mascillofacial Surgery', 'OMS 301', 3, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(48, 'Oral Pathology & Medicine', 'OPM 301', 2, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(49, 'Communication Skills/Basic Informatics Computer', 'ITC 301', 2, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(50, 'General Biology I', 'BIO 111', 3, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(51, 'General Chemistry I (Physical & Inorganic)', 'CHM 111', 3, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(52, 'General Physics I', 'PHY 111', 2, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(53, 'General Mathematics I', 'MTH 111', 3, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(54, 'Introduction to Computer', 'ICT 101', 2, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(55, 'Use of English', 'ENG 101', 2, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(56, 'Citizenship', 'CTZ 101', 2, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(57, 'Introduction to Enterpreneurship', 'ETP 101', 1, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(58, 'Introduction to Principles of Pharmacy', 'PTP 111', 2, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(59, 'Behavioural Science', 'BHV 101', 1, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(60, 'Use of Library', 'LIS 101', 1, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(61, 'General Biology II', 'BIO 112', 3, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(62, 'General Chemistry II (Organic Chemistry)', 'CHM 112', 3, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(63, 'General Physics II', 'PHY 112', 2, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(64, 'General Biology Practical', 'BIO 122', 1, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(65, 'General Chemistry Practical', 'CHM 122', 1, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(66, 'General Physics Practical', 'PHY 122', 1, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(67, 'General Mathematics II', 'MTH 112', 2, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(68, 'Communication Skills', 'ENG 102', 2, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(69, 'Introduction to Action and Uses of Medicines', 'AUM 122', 3, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(70, 'Basic Dispensing Theory I', 'BDT 152', 3, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(71, 'Basic Microbiology I', 'MCB 112', 2, '100', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(72, 'Action and Uses of Medicines I', 'AUM 221', 3, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(73, 'Basic Dispensing Theory II', 'BDT 251', 3, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(74, 'Pharmaceutical Calculations', 'BDT 253', 3, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(75, 'Anatomy and Physiology I', 'ANA 241', 3, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(76, 'Basic Dispensing Practical I', 'BDP 231', 3, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(77, 'Primary Health Care I', 'PHC 201', 2, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(78, 'Introduction to Statistics', 'STA 221', 2, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(79, 'Basic Microbiology II', 'MCB 221', 1, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(80, 'Logistics and Supply Chain Management System', 'BDT 255', 2, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(81, 'Supply Chain Management', 'SCM 201', 1, '200', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(82, 'Action and Uses of Medicines II', 'AUM 222', 3, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(83, 'Basic Dispensing Theory III', 'BDT 252', 2, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(84, 'Basic Dispensing Practical II', 'BDP 232', 3, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(85, 'Anatomy and Physiology II', 'ANA 242', 3, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(86, 'Logistics and Supply Chain Management II', 'BDT 254', 2, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(87, 'Introduction to Psychology', 'PSY 202', 2, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(88, 'Practice of Enterpreneurship', 'ETP 202', 3, '200', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(89, 'Hospital/Community and Industrial Practice', 'HCP 361', 6, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(90, 'Basic Dispensing Practical III', 'BDP 331', 3, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(91, 'Basic Dispensing Theory IV', 'BDT 351', 3, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(92, 'Action and Uses of Medicines III', 'AUM 321', 3, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(93, 'Computer Application in Pharmacy', 'ICT 301', 2, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(94, 'Seminar Presentation I', 'SEM 301', 2, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(95, 'Anatomy and Physiology III', 'ANA 342', 3, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(96, 'Primary Health Care II', 'PHC 302', 2, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(97, 'Principles of Pharmacy Technician Practice II', 'PTP 312', 2, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(98, 'Action and Uses of Medicines IV', 'AUM 322', 3, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(99, 'Basic Dispensing Practical IV', 'BDP 332', 3, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(100, 'Basic Dispensing Theory V', 'BDT 352', 3, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(101, 'Seminar Presentation II', 'SEM 302', 2, '300', 'Second', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(102, 'Anatomy and Physiology', 'ANA 341', 2, '300', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(103, 'Introduction to Laboratory Techniques', 'BDT 151', 2, '100', 'First', 'Certificate for Pharmacy Technicians', '2023/2024', NULL, NULL),
(104, 'Applied Anatomy and Physiology I', 'DTH 115', 3, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(105, 'Applied Chemistry', 'DNS 111', 2, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(106, 'Applied Physics', 'DNS 112', 3, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(107, 'Introduction to Microbiology', 'MCB 113', 2, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(108, 'Foundation of Nursing I', 'DNP 111', 5, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(109, 'Primary Oral Health', 'DNP 112', 1, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(110, 'General Pathology I', 'DNP 113', 1, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(111, 'Epidemiology in Nursing', 'DMP 118', 2, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(112, 'Use of English I', 'GNS 101', 2, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(113, 'Principles of Nursing', 'DNP 114', 2, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(114, 'Applied Pharmacology', 'DNP 117', 2, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(115, 'Clinical Practice I', 'DNP 110', 4, 'NDI', 'FIRST', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(116, 'Applied Anatomy and Physiology II', 'DTH 125', 3, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(117, 'Nutrition', 'NUD 112', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(118, 'Epidemiology in Nursing II', 'DTH 217', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(119, 'General Pathology', 'DNP 126', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(120, 'Applied Environmental Health', 'DNS 121', 3, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(121, 'Foundation of Nursing II', 'DNP 121', 5, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(122, 'Introduction to Reproductive Health', 'DNP 122', 4, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(123, 'Applied Pharmacology II', 'DNP 127', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(124, 'Introduction to Enterpreneurship', 'EED 126', 3, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(125, 'Introduction to Sociology', 'GNS 121', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(126, 'Ethico-Legal Issue in Nursing', 'DNP 124', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(127, 'Applied Research Methodology', 'DNP 128', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(128, 'Biostatics', 'DNP 129', 2, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(129, 'Clinical Practice II', 'DNP 120', 4, 'NDI', 'SECOND', 'ND Dental Nursing', '2023/2024', NULL, NULL),
(130, 'USE OF ENGLISH', 'GNS 101', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(131, 'INTRODUCTION TO PRIMARY HEALTH CARE', 'JCH 111', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(132, 'PROFESSIONAL ETHICS', 'JCH 112', 1, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(133, 'INTRODUCTION TO BEHAVIORAL SCIENCE', 'JCH 113', 1, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(134, 'BEHAVIOUR CHANGE COMMUNICATION', 'JCH 114', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(135, 'ANATOMY AND PHYSIOLOGY', 'JCH 115', 3, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(136, 'HUMAN NUTRITION', 'JCH 116', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(137, 'ACCIDENTS AND EMERGENCY CONDITIONS', 'JCH 117', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(138, 'HEALTH STATISTICS', 'JCH 118', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(139, 'INTRODUCTION TO COMPUTER', 'COM 111', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(140, 'ENTREPRENEURSHIP EDUCATION', 'BUS 213', 1, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(141, 'INTRODUCTION TO PSYCHOLOGY', 'GNS 411', 2, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(142, 'CITIZENSHIP EDUCATION', 'GNS 111', 1, '100', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(143, 'PRIMARY EYE CARE', 'JCH 131', 1, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(144, 'PRIMARY EAR, NOSE AND THROAT CARE', 'JCH 132', 2, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(145, 'ORAL HEALTH CARE', 'JCH 133', 1, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(146, 'LABORATORY SERVICES', 'JCH 134', 2, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(147, 'CHILD HEALTH / IMCI', 'JCH 135', 3, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(148, 'FAMILY PLANNING', 'JCH 136', 1, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(149, 'COMMUNITY MENTAL HEALTH', 'JCH 137', 1, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(150, 'NON-COMMUNICABLE DISEASES', 'JCH 138', 2, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(151, 'SUPERVISED CLINICAL EXPERIENCE (SCE)', 'JCH 140', 3, '200', 'FIRST', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(152, 'USE OF ENGLISH', 'GNS 101', 2, '100', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(153, 'Administration and management in Dental practice', 'AMD 301', 2, '300', 'FIRST', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(154, 'Research and Project Revision and final Examination', 'PROJ 302', 6, '300', 'SECOND', 'Professional Diploma for Dental Surgery Technicians', '2023/2024', NULL, NULL),
(155, 'Morphology and Physiology of Living Things', 'STB 112', 3, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(156, 'Mechanics and properties of matter', 'BPH 111', 3, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(157, 'Introduction to Statistics', 'STA 111', 2, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(158, 'Oral Hygiene', 'DTH 111', 1, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(159, 'Primary Health care', 'DTH 112', 1, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(160, 'Pharmacology', 'DTH 113', 1, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(161, 'Tooth morphology and tooth craving', 'DTH 114', 2, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(162, 'Human Anatomy and Physiology I', 'DTH 115', 2, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(163, 'Communication in English', 'GNS 102', 2, 'NDI', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(164, 'General Laboratory Techniques', 'GLT 111', 5, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(165, 'Technical Drawing', 'PTD 111', 3, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(166, 'Introductory Microbiology', 'STB 211', 3, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(167, 'Dental Theraphy Instrumentation I', 'DTH 121', 2, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(168, 'Oral Physiology', 'DTH 122', 3, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(169, 'Care and Maintainance of Dental Equipments', 'DTH 123', 2, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(170, 'General Pathology I', 'DTH 124', 1, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(171, 'Medical Sociology', 'GNS 124', 3, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(172, 'General Laboratory Technique (Photography)', 'GLT 211', 1, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(173, 'Oral Histology and Anatomy', 'DTH 211', 2, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(174, 'Phantom Heads', 'DTH212', 2, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(175, 'Oral Health Education I', 'DTH 213', 1, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(176, 'General Pathology II', 'DTH 214', 1, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(177, 'Instrumentation II', 'DTH 215', 2, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(178, 'Introduction to Nursing Care', 'DTH 216', 2, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(179, 'Dental Radiography I', 'DTH 217', 1, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(180, 'Communication in English', 'GNS 202', 3, 'NDII', 'FIRST', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(181, 'Introductory Microbiology', 'STB 221', 3, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(182, 'Human Nutrition', 'NUD 122', 2, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(183, 'First Aid and Dental Emergencies', 'DTH 221', 2, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(184, 'Anatomy of Head and Neck', 'DTH 222', 1, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(185, 'Human Anatomy and Physiology II', 'DTH 223', 2, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(186, 'Dental Materials', 'DTH 224', 2, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(187, 'Clinical Practice', 'DTH 225', 2, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(188, 'Nutrion and Dietetics Syllabus', 'NUD', 2, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(189, 'Semiar', 'DTH 226', 1, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(190, 'Project', 'DTH 227', 1, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(191, 'Citizenship Education', 'GNS 121', 6, 'NDII', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(192, 'COMMUNICATION SKILLS I', 'ELS 101', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(193, 'INTRODUCTION TO IT I', 'CSC 101', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(194, 'GENERAL CHEMISTRY I', 'CHM 101', 3, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(195, 'GENERAL BIOLOGY I', 'BIO 101', 3, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(196, 'GENERAL PHYSICS I', 'PHY 101', 3, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(197, 'GENERAL MATHEMATICS I', 'MTH 101', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(198, 'CITIZENSHIP EDUCATION', 'GST 101', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(199, 'HISTORY AND PHILOSOPHY OF SCIENCE', 'GST103', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(200, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 101', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(201, 'FUNCTIONAL FRENCH I', 'FRN 101', 2, '100', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(202, 'COMMUNICATION SKILLS II', 'ELS 102', 2, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(203, 'INTRODUCTION TO IT II', 'CSC 102', 2, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(204, 'GENERAL PHYSICS II', 'PHY 102', 3, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(205, 'ORGANIC CHEMISTRY', 'CHM 102', 3, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(206, 'GENERAL BIOLOGY II', 'BIO 102', 3, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(207, 'GENERAL MATHEMATICS II', 'MTH 102', 2, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(208, 'FIRST AID AND PRIMARY HEALTH CARE', 'FAP 102', 2, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(209, 'PHILOSOPHY AND LOGIC/CRITICAL REASONING', 'GST 102', 2, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(210, 'FUNCTIONAL FRENCH II', 'FRN 102', 2, '100', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(211, 'BASIC ANATOMY', 'ANA 201', 3, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(212, 'BASIC PHYSIOLOGY', 'PHS 201', 3, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(213, 'BASIC BIOCHEMISTRY', 'BCH 201', 3, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(214, 'INTRODUCTION TO MLS', 'MLT 201', 3, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(215, 'INTRODUCTION TO IMMUNOLOGY', 'MLT 203', 2, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(216, 'CLINICAL LABORATORY POSTING I', 'MLT 205', 3, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(217, 'BASIC LABORATORY TECHNIQUES I', 'MLT 207', 2, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(218, 'BASIC CYTOLOGY AND GENETICS', 'BIO 201', 2, '200', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(219, 'MEDICAL MICROBIOLOGY  I', 'MLT 202', 3, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(220, 'HEAMATOLOGY I', 'MLT 204', 3, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(221, 'CLINICAL CHEMISTRY I', 'MLT 206', 3, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(222, 'HISTOPATHOLOGY I', 'MLT 208', 3, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(223, 'RESEARCH METHODOLOGY', 'MLT 210', 2, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(224, 'INTRODUCTION TO MANAGEMENT, LAB ORGANIZATION AND ETHICS', 'MLT 212', 2, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(225, 'CLINICAL LABORATORY POSTING II', 'MLT 214', 3, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(226, 'BASIC LABORATORY TECHNIQUES II', 'MLT 216', 2, '200', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(227, 'MEDICAL PARASITOLOGY', 'MLT 301', 3, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(228, 'BLOOD TRANSFUSION SCIENCE', 'MLT 303', 3, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(229, 'CLINICAL CHEMISTRY II', 'MLT 305', 3, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(230, 'HISTOPATHOLOGY II', 'MLT 307', 3, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(231, 'CLINICAL LABORATORY POSTING III', 'MLT 311', 3, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(232, 'SEMINAR IN LABORATORY SCIENCE', 'MLT 309', 3, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(233, 'INTODUCTORY VIROLOGY', 'MLT 313', 2, '300', 'FIRST', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(234, 'MEDICAL MICROBIOLOGY  II', 'MLT 302', 3, '300', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(235, 'HEAMATOLOGY II', 'MLT 304', 3, '300', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(236, 'CLINICAL CHEMISTRY III', 'MLT 306', 2, '300', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(237, 'HISTOPATHOLOGY III', 'MLT 308', 2, '300', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(238, 'RESEARCH PROJECT', 'MLT 312', 6, '300', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(239, 'GOOD LABORATORY PRACTICE', 'MLT 310', 2, '300', 'SECOND', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(240, 'USE OF ENGLISH', 'GNS 301', 2, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(241, 'INTRODUCTION TO MEDICAL SOCIOLOGY', 'GNS 323', 3, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(242, 'INTRODUCTION TO MICROBIOLOGY (MODULES I,II,III)', 'STB 311', 4, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(243, 'COMPUTER PACKAGE', 'COM 323', 3, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(244, 'PUBLIC HEALTH NUTRITION', 'PHN 311', 4, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(245, 'DRUG SUPPLY ADMINISTRATION AND CONTROL', 'PHN 313', 2, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(246, 'PRIMARY ORAL HEALTH', 'PHN 315', 2, '100', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(247, 'USE OF ENGLISH II', 'GNS 304', 2, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(248, 'SOCIOLOGY OF THE FAMILY', 'GNS 324', 2, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(249, 'PUBLIC HEALTH NURSING I', 'PHN 312', 4, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(250, 'FOOD MICROBIOLOGY AND HYGIENE', 'PHN 320', 4, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(251, 'COMMUNITY MENTAL HEALTH', 'PHN 322', 4, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(252, 'ENVIRONMENTAL HEALTH AND PUBLIC HEALTH LAWS', 'PHN 324', 2, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(253, 'BIOSTATISTICS', 'PHN 326', 3, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(254, 'EPIDEMIOLOGY', 'PHN 328', 4, '100', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(255, 'MATERNAL AND CHILD HEALTH I', 'PHN 413', 4, '200', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(256, 'PUBLIC HEALTH NURSING II', 'PHN 421', 4, '200', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(257, 'REPRODUCTIVE HEALTH AND  FAMILY PLANNING I', 'PHN 423', 3, '200', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(258, 'Entrepreneurship', 'EED 126', 2, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(259, 'CONTEMPORARY ISSUES IN PUBLIC HEALTH NURSING', 'PHN 427', 2, '200', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(260, 'PRINCIPLES OF MANAGEMENT I', 'PHN 429', 2, '200', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(261, 'RESEARCH METHODOLOGY', 'PHN 435', 6, '200', 'FIRST', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(262, 'SCHOOL HEALTH PROGRAMME', 'PHN 414', 3, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(263, 'REPRODUCTIVE HEALTH AND FAMILY PLANNING II', 'PHN 416', 4, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(264, 'HEALTH EDUCATION', 'PHN 418', 3, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(265, 'MATERNAL AND CHILD HEALTH II', 'PHN 420', 4, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(266, 'OCCUPATIONAL HEALTH', 'PHN 426', 2, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(267, 'PRINCIPLES OF MANAGEMENT II', 'PHN 430', 2, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(268, 'PUBLIC HEALTH NURSING III', 'PHN 432', 3, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(269, 'ADOLESCENTS ADULTS AGED AND HANDICAPPED', 'PHN 442', 3, '200', 'SECOND', 'HND in Public Health Nursing', '2023/2024', NULL, NULL),
(270, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 111', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(271, 'INTRODUCTION TO CONCEPT OF HEALTH AND DISEASES', 'EHT 112', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(272, 'HUMAN ANATOMY AND PHYSIOLOGY I', 'DTH 115', 4, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(273, 'APPLIED PHYSICS', 'EHS 111', 3, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(274, 'APPLIED CHEMISTRY', 'EHS 112', 3, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(275, 'GENERAL BIOLOGY', 'GNS 230', 3, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(276, 'INTRODUCTION TO PSYCHOLOGY', 'GNS 411', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(277, 'INTRODUCTION TO COMPUTER SCIENCE', 'COM 111', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(278, 'USE OF ENGLISH', 'GNS 101', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(279, 'CITIZENSHIP EDUCATION I', 'GNS 111', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(280, 'INTRODUCTION TO MEDICAL SOCIOLOGY', 'EHT101', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(281, 'INTRODUCTION TO STATISTICS', 'STA 101', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(282, 'GENERAL LABORATORY TECHNIQUE', 'GLT 111', 3, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(283, 'GENERAL MATHEMATICS', 'MTH 101', 3, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(284, 'USE OF LIBRARY', 'LIB 101', 2, 'NDI', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(285, 'INTRODUCTION TO ENVIRONMENTAL MANAGEMENT', 'EHT 121', 3, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(286, 'BUILDING SANITATION', 'EHT 123', 3, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(287, 'ECOLOGY', 'EHT 124', 2, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(288, 'HUMAN ANATOMY AND PHYSIOLOGY II', 'DTH 216', 4, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(289, 'PHARMACOLOGY I', 'EHS 125', 2, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(290, 'INTRODUCTION TO SOCIOLOGY', 'GNS 115', 2, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(291, 'INTRODUCTION TO BIOCHEMISTRY', 'EHS 121', 3, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(292, 'TECHNICAL DRAWING', 'MEC 112', 2, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(293, 'ENTREPRENEURSHIP EDUCATION', 'EED 126', 3, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(294, 'INTRODUCTION TO MICROBIOLOGY', 'STB 211', 3, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(295, 'INRODUCTION TO DEMOGRAPHY', 'EHT 102', 2, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(296, 'ENVIRONMENTAL SCANNING', 'EHT 105', 1, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(297, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 104', 2, 'NDI', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(298, 'PUBLIC HEALTH PEST MANAGEMENT', 'EHT 211', 3, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(299, 'PRINCIPLES OF EPIDEMIOLOGY AND DISEASE CONTROL', 'EHT 212', 3, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(300, 'INTRODUCTION TO ENTOMOLOGY', 'EHT 213', 3, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(301, 'ENVIRONMENTAL PARASITOLOGY I', 'EHT 214', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(302, 'WASTE MANAGEMENT I', 'EHT 215', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(303, 'ENVIRONMENTAL APPRAISAL', 'EHT 216', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(304, 'TECHNICAL REPORT WRITING', 'EHS 211', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(305, 'PRIMARY HEALTH CARE I', 'CHO 111', 3, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(306, 'HUMAN NUTRITION', 'NUD 124', 3, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(307, 'RESEARCH METHODS', 'GNS 228', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(308, 'CITIZENSHIP EDUCATION', 'GNS 227', 1, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(309, 'HEALTH AGENCIES (NATIONAL AND INTERNATIONAL)', 'EHT 205', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(310, 'ENVIRONMENTAL HEALT LAB I', 'EHT 206', 2, 'NDII', 'FIRST', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(311, 'FOOD HYGIENE AND INSPECTION', 'EHT 221', 3, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(312, 'PUBLIC AND ENVIRONMENTAL LAWS', 'EHT 222', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(313, 'CONTEMPORARY ENVIRONMENTAL HEALTH ISSUES', 'EHT 223', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(314, 'SANITARY INSPECTION OF PREMISES', 'EHT 224', 3, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(315, 'WATER SANITATION I', 'EHT 225', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(316, 'PRINCIPLES OF ENVIRONMENTAL HEALTH ADMINISTRATION', 'EHT 226', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(317, 'PROJECT REPORT WRITING', 'EHT 229', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(318, 'PRIMARY HEALTH CARE II', 'CHO 221', 3, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(319, 'INTRODUCTION TO IMMUNITY AND IMMUNOLOGY', 'EHT 227', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(320, 'FIRST AID MANAGEMENT', 'EHS 228', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(321, 'HEALTH EDUCATION I', 'EHT 228', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(322, 'COMMUNICATION IN ENGLISH II', 'GNS 102', 2, 'NDII', 'SECOND', 'ND in Environmental Health Technology', '2023/2024', NULL, NULL),
(323, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 111', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(324, 'INTRODUCTION TO CONCEPT OF HEALTH AND DISEASES', 'EHT 112', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(325, 'HUMAN ANATOMY AND PHYSIOLOGY I', 'DTH 115', 4, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(326, 'GENERAL PHYSICS', 'PHY 101', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(327, 'GENERAL CHEMISTRY', 'CHM 101', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(328, 'GENERAL BIOLOGY', 'GNS 230', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(329, 'INTRODUCTION TO PSYCHOLOGY', 'GNS 411', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(330, 'INTRODUCTION TO COMPUTER SCIENCE', 'CSC 101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(331, 'USE OF ENGLISH', 'GST 101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(332, 'CITIZENSHIP EDUCATION I', 'GNS 111', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(333, 'INTRODUCTION TO MEDICAL SOCIOLOGY', 'EHT101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(334, 'INTRODUCTION TO STATISTICS', 'STA 101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(335, 'GENERAL LABORATORY TECHNIQUE', 'GLT 111', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(336, 'GENERAL MATHEMATICS', 'MTH 101', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(337, 'USE OF LIBRARY', 'LIB 101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(338, 'INTRODUCTION TO ENVIRONMENTAL MANAGEMENT', 'EHT 121', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(339, 'BUILDING SANITATION', 'EHT 123', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(340, 'HEALTH ECOLOGY', 'EHT 106', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(341, 'HUMAN ANATOMY AND PHYSIOLOGY II', 'DTH 216', 4, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(342, 'INTRODUCTION TO PHARMACOLOGY', 'PHM 101', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(343, 'INTRODUCTION TO SOCIOLOGY', 'GNS 115', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(344, 'INTRODUCTION TO BIOCHEMISTRY', 'EHS 103', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(345, 'TECHNICAL DRAWING', 'PTD 111', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(346, 'ENTREPRENEURSHIP EDUCATION', 'EED 126', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(347, 'INTRODUCTION TO MICROBIOLOGY', 'STB 211', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(348, 'INRODUCTION TO DEMOGRAPHY', 'EHT 102', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(349, 'ENVIRONMENTAL SCANNING', 'EHT 105', 1, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(350, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 104', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(351, 'PUBLIC HEALTH PEST MANAGEMENT', 'EHT 211', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(352, 'PRINCIPLES OF EPIDEMIOLOGY AND DISEASE CONTROL', 'EHT 201', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(353, 'ENTOMOLOGY AND PEST CONTROL', 'EHT 202', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(354, 'ENVIRONMENTAL AND PUBLIC HEALTH PARASITOLOGY', 'EHT 203', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(355, 'SOLID WASTE MANAGEMENT', 'EHT 204', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(356, 'ENVIRONMENTAL APPRAISAL', 'EHT 216', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(357, 'TECHNICAL REPORT WRITING', 'PEL 217', 1, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(358, 'PRIMARY HEALTH CARE I', 'CHO 111', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(359, 'FOOD SCIENCE AND  NUTRITION', 'NUD 223', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(360, 'RESEARCH METHODS', 'GNS 228', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(361, 'CITIZENSHIP EDUCATION', 'GNS 227', 1, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(362, 'HEALTH AGENCIES (NATIONAL AND INTERNATIONAL)', 'EHT 205', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(363, 'ENVIRONMENTAL HEALT LAB I', 'EHT 206', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(364, 'FOOD HYGIENE AND INSPECTION', 'EHT 209', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(365, 'PUBLIC HELATH LAWS AND ETHICS', 'EHT 210', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(366, 'CONTEMPORARY ENVIRONMENTAL HEALTH ISSUES', 'EHT 223', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(367, 'SANITARY INSPECTION OF PREMISES', 'EHT 212', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(368, 'WATER SANITATION', 'EHT 208', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(369, 'PRINCIPLES OF ENVIRONMENTAL HEALTH ADMINISTRATION', 'EHT 226', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(370, 'PROJECT REPORT WRITING', 'EHT 229', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(371, 'PRIMARY HEALTH CARE DELIVERY SYSTEM', 'EHT 211', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(372, 'INTRODUCTION TO IMMUNOLOGY', 'EHT 213', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(373, 'PRINCIPLES AND PRACTICE OF FIRST AID', 'EHT 207', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(374, 'HEALTH EDUCATION I', 'EHT 228', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(375, 'COMMUNICATION IN ENGLISH II', 'GNS 102', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(376, 'Use of English I', 'GNS 101', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(377, 'Citizenship Education', 'GNS 102', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(378, 'Morphology and Physiology of Living things', 'STB 112', 3, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(379, 'Introducton to Biochemistry', 'BCH 121', 3, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(380, 'Introduction to Statistics', 'STA 111', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(381, 'General Microbiology', 'FST 122', 3, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(382, 'Intoduction to Agriculture', 'AGR 101', 3, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(383, 'Introduction to Human Nutrition and Dietetics', 'NUD 111', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL);
INSERT INTO `course` (`id`, `course_title`, `course_code`, `course_unit`, `level`, `semester`, `course`, `session1`, `created_at`, `updated_at`) VALUES
(384, 'Food formulation and Organoleptic evaluation', 'NUD 113', 3, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(385, 'Nutrition Education', 'NUD 101', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(386, 'Library studies', 'LIS 101', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(387, 'Economics (Basics)', 'ECO 101', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(388, 'Contemporary Social Problem and Outline of Nigeria', 'GNS 120', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(389, 'Citizenship Education II', 'GNS 101', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(390, 'Communication in English', 'GNS 102', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(391, 'Introduction to Enterpreneuship', 'EED 126', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(392, 'Introduction to Food Science and Food Commodity', 'FST 121', 3, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(393, 'Food Chemistry', 'FST 123', 3, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(394, 'Food Preparation and Service', 'HTM 123', 3, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(395, 'Human Anatomy and Physiology', 'NUD 121', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(396, 'Human Nutrition and Dietetics', 'NUD 122', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(397, 'Food Science and Nutrition', 'NUD 123', 3, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(398, 'Food Microbiology (Introduction to Food Microbiology)', 'NUD 124', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(399, 'Introduction to Computer', 'CSC 102', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(400, 'Introduction to Sociology', 'GNS 121', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(401, 'Use of English II', 'GNS 202', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(402, 'Practice of Entrepreneurship', 'EED 216', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(403, 'Human Physiology', 'NUD 231', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(404, 'Human Nutrition II', 'NUD 232', 3, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(405, 'Clinical Diseases and Diet Therapy I', 'NUD 233', 3, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(406, 'Nutrient Metabolism', 'NUD 234', 3, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(407, 'Community Nutrition', 'NUD 235', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(408, 'Elements of Public Health Nutrition', 'NUD 236', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(409, 'Research Methods', 'NUD 237', 2, 'NDII', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(410, 'Communication in English II', 'GNS 202', 2, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(411, 'Business Management', 'MAN 201', 2, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(412, 'Introduction to fod packaging', 'FST 223', 2, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(413, 'Human Nutrition III', 'NUD 241', 2, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(414, 'Clinical Disease and Diet Therapy II', 'NUD 242', 3, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(415, 'Introduction to Food Analysis', 'NUD 243', 2, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(416, 'Seminar', 'NUD 244', 1, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(417, 'Project', 'NUD 245', 6, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(418, 'Public Health Nutrition', 'NUD 244', 2, 'NDII', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(419, 'PHARMACOLOGY', 'PHAM 201', 2, '200', 'Second', 'Certificate for  Medical Laboratory Technicians(MLT)', '2023/2024', NULL, NULL),
(420, 'Anatomy and Physiology II', 'CHE231', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(421, 'Oral Health', 'CHE 232', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(422, 'Community Mental Health', 'CHE 233', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(423, 'Reproductive Health', 'CHE 234', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(424, 'Child Health', 'CHE 235', 3, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(425, 'School Health Programme', 'CHE 236', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(426, 'Control of Non-Communicable Diseases', 'CHE 237', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(427, 'Introduction to physical chemistry', 'BCH 111', 1, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(428, 'Community Linkage and Development', 'CHE 238', 3, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(429, 'Care and Management of HIV and AIDS', 'CHE 239', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(430, 'Occupational Kealth and Safety', 'CHE 240', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(431, 'Clinical Skills II', 'CHE 241', 3, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(432, 'Maternal Health', 'CHE 242', 4, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(433, 'Modified Essential Newborn care', 'CHE 243', 3, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(434, 'Community Ear,Nose and throat care', 'CHE 244', 2, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(435, 'Community Eye care', 'CHE 245', 1, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(436, 'Use of standing Orders', 'CHE 246', 3, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(437, 'Introduction to pharamacology', 'GNP 123', 2, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(438, 'Nigerian Health System', 'CHE 247', 2, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(439, 'Supervised Clinical Experience II', 'CHE 248', 4, '200', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(440, 'Care of Older Persons', 'CHE 251', 1, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(441, 'Care of Persons with special needs', 'CHE 252', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(442, 'Health Statistics', 'CHE 253', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(443, 'Essential Medicines', 'CHE 254', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(444, 'Human Resources for Health', 'CHE 255', 1, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(445, 'Research Methodology', 'CHE 256', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(446, 'Community Based Newborn Care', 'CHE 257', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(447, 'Supervised Community Based Experience (SCBE)', 'CHE 258', 4, '300', 'FIRST', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(448, 'Primary Health Care Management', 'CHE 261', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(449, 'Referral System and Outreach Services', 'CHE 262', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(450, 'Accounting System in Primary Health Care', 'CHE 263', 1, '300', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(451, 'Health Management Information System', 'CHE 264', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(452, 'Entrepreneurship Education', 'BUS 213', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(453, 'Research project', 'CHE 265', 4, '300', 'SECOND', 'Diploma in Community Health(CHEW)', '2023/2024', NULL, NULL),
(454, 'Clinical skills', 'JCH 121', 4, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(455, 'symptomatology', 'JCH  122', 2, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(456, 'Reproductive health', 'JCH 123', 2, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(457, 'Maternal health', 'JCH 124', 2, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(458, 'Modified Essential care of the newborn', 'JCH 125', 3, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(459, 'Communicable diseases', 'JCH 126', 2, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(460, 'Laboratory Services', 'JCH 127', 2, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(461, 'Community-based healh care', 'JCH 128', 3, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(462, 'Supervised clinical experience', 'JCH 129', 3, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(463, 'immunity and immunisation', 'JCH 130', 3, '100', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(464, 'School health programme', 'JCH 142', 2, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(465, 'Adolesent health', 'JCH 143', 2, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(466, 'Adult health', 'JCH 144', 1, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(467, 'Care of persons with special needs', 'JCH 145', 2, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(468, 'Care of the older persons', 'JCH 146', 1, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(469, 'Essential medicines', 'JCH 147', 2, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(470, 'Health management information system', 'JCH 148', 1, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(471, 'Occupational health and safety education', 'JCH 149', 1, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(472, 'Care and management of HIV and AIDS', 'JCH 150', 2, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(473, 'Human resourses fo health', 'JCH 151', 1, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(474, 'Referrals and outreach services', 'JCH 152', 2, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(475, 'Family case study', 'JCH 153', 4, '200', 'SECOND', 'Certificate in Community Health(JCHEW)', '2023/2024', NULL, NULL),
(476, 'Enviromental Epidemiology', 'EHT 301', 3, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(477, 'Meat Inspection Hygiene and Sanitation', 'EHT 302', 3, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(478, 'Ecology', 'EHT 303', 3, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(479, 'Biostatistics', 'EHT 304', 3, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(480, 'Enviromntal Health Economics', 'EHT 305', 1, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(481, 'Control of Non-Communitable Diseases', 'EHT 306', 2, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(482, 'Community  Sanitation', 'EHT 307', 2, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(483, 'Sewage abd Waste Water Management', 'EHT 308', 3, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(484, 'Introduction to Enviromental and Public Health Biotechnology', 'EHT 315', 2, 'HNDI', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(485, 'Pollution control', 'EHT 309', 2, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(486, 'Pest Management Method and Control', 'EHT 310', 3, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(487, 'Solid Waste Management', 'EHT 311', 3, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(488, 'Enviromental Toxicology', 'EHT 312', 3, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(489, 'Water Quality Management', 'EHT 313', 2, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(490, 'Immunology and Immunization', 'EHT 314', 3, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(491, 'Public Utilities and Enviromental Health Issues', 'EHT 316', 2, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(492, 'Industrial Layout, Landscaping and Planning', 'EHT 317', 2, 'HNDI', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(493, 'Research Methodology in Enviromental Health', 'EHT 401', 3, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(494, 'Hazardous and Radioactive Waste Management', 'EHT 402', 2, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(495, 'Occupational Health and Safety', 'EHT 403', 3, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(496, 'Management and Adminstration of Enviromental Health Programmes', 'EHT 404', 2, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(497, 'Contemporary Issues in Enviromental Health', 'EHT 405', 3, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(498, 'Seminar Presentation in Enviromental Health', 'EHT 406', 2, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(499, 'Health Promotion and Education', 'EHT 407', 3, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(500, 'Pest Management Control', 'EHT 408', 2, 'HNDII', 'FIRST', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(501, 'Sanitary Inspection of Premises II', 'EHT 409', 2, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(502, 'Enviromental Health Services in Emergencies', 'EHT 410', 2, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(503, 'Enviromental Health Laws, Ethnics and Polices', 'EHT 412', 3, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(504, 'Enviromental Health Monitoring and Impact Assessment', 'EHT 413', 3, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(505, 'International Health Services', 'EHT 414', 2, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(506, 'Pest Management Equipment and Machinery', 'EHT 415', 2, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(507, 'Pathophysiology', 'STB 401', 3, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(508, 'Research Project in Enviromental Health', 'EHT 411', 4, 'HNDII', 'SECOND', 'HND(WAHEB) in Environmental Health Technology', '2023/2024', NULL, NULL),
(509, 'Use of English', 'GNS 101', 1, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(510, 'Hospital Sanitation', 'HHA 208', 3, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(511, 'Fundamental of Medical Practice', 'GHA 105', 2, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(512, 'Citizenship Education', 'GHA 107', 2, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(513, 'Environmental Health', 'EHA 104', 1, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(514, 'Behavioral Science', 'BHA 212', 2, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(515, 'Principle of Epidemiology', 'EHA 222', 2, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(516, 'Anatomy and Physiology', 'GHT 111', 2, '100', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(517, 'First aid in the company', 'GHA 105', 2, '100', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(518, 'Personnel management', 'GHS 105', 1, '100', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(519, 'Accident and minor surgery', 'GHA 201', 2, '100', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(520, 'Introduction to nutrition', 'GHA 103', 2, '100', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(521, 'Care of the aged & handicap', 'GHA 210', 1, '100', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(522, 'Clinical skills', 'GHT 111', 3, '100', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(523, 'Use of English', 'GNS 201', 2, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(524, 'Medical emergency', 'PHT 213', 1, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(525, 'Introduction to family sociology', 'PHT 115', 2, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(526, 'Introduction to human nutrition', 'NUD 122', 2, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(527, 'Health statistics', 'PHT 216', 1, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(528, 'Introduction to computer', 'CSC 101', 2, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(529, 'Environmental health & waste control', 'EHT 104', 2, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(530, 'Use of library', 'GNS 107', 2, '200', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(531, 'Communicable& non communicable diseases', 'PHT 221', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(532, 'Principle of epidemiology & disease control', 'EHT 214', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(533, 'Introduction to heath promotion & education', 'HPE 122', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(534, 'Clinical skills II', 'PHT 126', 3, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(535, 'Occupational health& safety', 'EVT 221', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(536, 'Management of essential drugs &supply', 'PHT 125', 1, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(537, 'Management of hospital equipment', 'PHT 109', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(538, 'Reproductive health', 'PHT 315', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(539, 'School health programme', 'PHT 216', 2, '200', 'SECOND', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(540, 'PHC I', 'PHT 122', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(541, 'Immunity & public health', 'EVT 208', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(542, 'MCH I', 'PHT 214', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(543, 'Community mobilization', 'PHT 311', 3, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(544, 'Vector and disease control', 'EVT 203', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(545, 'Principles of pest management', 'PMT 215', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(546, 'Research methodology', 'GHT 213', 1, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(547, 'Health agencies', 'PHT 318', 1, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(548, 'General clinical skills I', 'PHT 111', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(549, 'Entrepreneurship', 'PHT 225', 2, '300', 'FIRST', 'Diploma for Health Technicians', '2023/2024', NULL, NULL),
(550, 'Use of English', 'GNS 101', 1, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(551, 'Hospital Sanitation', 'HHA 208', 3, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(552, 'Fundamental of Medical Practice', 'GHA 105', 2, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(553, 'Citizenship Education', 'GHA 107', 2, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(554, 'Environmental Health', 'EHA 104', 1, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(555, 'Behavioral Science', 'BHA 212', 2, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(556, 'Principle of Epidemiology', 'EHA 222', 2, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(557, 'Anatomy and Physiology', 'GHT 111', 2, '100', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(558, 'Laboratory technique', 'LHA 211', 2, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(559, 'First aid in the company', 'GHA 105', 2, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(560, 'Personnel management', 'GHS 105', 1, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(561, 'Accident and minor surgery', 'GHA 201', 2, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(562, 'Introduction to nutrition', 'GHA 103', 2, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(563, 'Care of the aged & handicap', 'GHA 210', 1, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(564, 'Clinical skills', 'GHT 111', 3, '100', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(565, 'Use of English', 'GNS 201', 2, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(566, 'Medical emergency', 'PHT 213', 1, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(567, 'Introduction to family sociology', 'PHT 115', 2, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(568, 'Introduction to human nutrition', 'NUD 122', 2, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(569, 'Health statistics', 'PHT 216', 1, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(570, 'Introduction to computer', 'CSC 101', 2, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(571, 'Environmental health & waste control', 'EHT 104', 2, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(572, 'Use of library', 'GNS 107', 2, '200', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(573, 'Communicable& non communicable diseases', 'PHT 221', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(574, 'Principle of epidemiology & disease control', 'EHT 214', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(575, 'Introduction to heath promotion & education', 'HPE 122', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(576, 'Clinical skills II', 'PHT 126', 3, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(577, 'Occupational health& safety', 'EVT 221', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(578, 'Management of essential drugs &supply', 'PHT 125', 1, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(579, 'Management of hospital equipment', 'PHT 109', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(580, 'Reproductive health', 'PHT 315', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(581, 'School health programme', 'PHT 216', 2, '200', 'SECOND', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(582, 'PHC I', 'PHT 122', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(583, 'Immunity & public health', 'EVT 208', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(584, 'MCH I', 'PHT 214', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(585, 'Community mobilization', 'PHT 311', 3, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(586, 'Vector and disease control', 'EVT 203', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(587, 'Principles of pest management', 'PMT 215', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(588, 'Research methodology', 'GHT 213', 1, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(589, 'Health agencies', 'PHT 318', 1, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(590, 'General clinical skills I', 'PHT 111', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(591, 'Entrepreneurship', 'PHT 225', 2, '300', 'FIRST', 'Diploma for Health Technicians(DE)', '2023/2024', NULL, NULL),
(592, 'Use of English', 'GHS 101', 1, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(593, 'Water Sanitation', 'EVT 104', 2, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(594, 'Nutrition', 'GHA 103', 2, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(595, 'Fundamental of Medical Practice', 'GHA 105', 2, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(596, 'Sociology of the Family', 'GNS 103', 2, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(597, 'Ethincs', 'GNS 105', 2, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(598, 'Clinical skills', 'GHA 111', 3, '100', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(599, 'Family Planning', 'GHA 104', 2, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(600, 'Personnel Management', 'GNS 104', 1, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(601, 'Introduction to Computer', 'GSC 102', 2, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(602, 'Environmental Health', 'EHA 104', 2, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(603, 'Statistics', 'SHA 112', 1, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(604, 'Oral Health', 'GHA 106', 2, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(605, 'Introduction to PHC', 'PHA 114', 2, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(606, 'Maternal and Child Health I', 'GHA 109', 2, '100', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(607, 'Communication in English', 'GNS 201', 2, '200', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(608, 'Adolescent Health', 'HA 203', 2, '200', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(609, 'First Aid in the Community', 'HA 205', 2, '200', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(610, 'Personnel Management II', 'GNS 205', 1, '200', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(611, 'Accident and Minor Surgery', 'GHA 201', 2, '200', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(612, 'Mental Health I', 'GHA 203', 2, '200', 'FIRST', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(613, 'Maternal and Child Health II', 'GHA 204', 2, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(614, 'Mental Health II', 'GHA 206', 2, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(615, 'Hospital Sanitation', 'HHA 208', 3, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(616, 'Care of the Aged and Handicap', 'GHA 210', 1, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(617, 'Principle of Epidemiology', 'EHA 222', 2, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(618, 'Behavioural Science', 'BHA 212', 2, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(619, 'Introduction to PHC II', 'PHA 224', 2, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(620, 'Report Writing/Care Study', 'GNS 202', 3, '200', 'SECOND', 'Certificate for Health Assistants', '2023/2024', NULL, NULL),
(621, 'Anatomy and Physiology II', 'CHE231', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(622, 'Oral Health', 'CHE 232', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(623, 'Community Mental Health', 'CHE 233', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(624, 'Reproductive Health', 'CHE 234', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(625, 'Child Health', 'CHE 235', 3, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(626, 'School Health Programme', 'CHE 236', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(627, 'Control of Non-Communicable Diseases', 'CHE 237', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(628, 'Introduction to physical chemistry', 'BCH 111', 1, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(629, 'Community Linkage and Development', 'CHE 238', 3, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(630, 'Care and Management of HIV and AIDS', 'CHE 239', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(631, 'Occupational Kealth and Safety', 'CHE 240', 2, '200', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(632, 'Clinical Skills II', 'CHE 241', 3, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(633, 'Maternal Health', 'CHE 242', 4, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(634, 'Modified Essential Newborn care', 'CHE 243', 3, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(635, 'Community Ear,Nose and throat care', 'CHE 244', 2, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(636, 'Community Eye care', 'CHE 245', 1, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(637, 'Use of standing Orders', 'CHE 246', 3, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(638, 'Introduction to pharamacology', 'GNP 123', 2, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(639, 'Nigerian Health System', 'CHE 247', 2, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(640, 'Supervised Clinical Experience II', 'CHE 248', 4, '200', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(641, 'Care of Older Persons', 'CHE 251', 1, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(642, 'Care of Persons with special needs', 'CHE 252', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(643, 'Health Statistics', 'CHE 253', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(644, 'Essential Medicines', 'CHE 254', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(645, 'Human Resources for Health', 'CHE 255', 1, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(646, 'Research Methodology', 'CHE 256', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(647, 'Community Based Newborn Care', 'CHE 257', 2, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(648, 'Supervised Community Based Experience (SCBE)', 'CHE 258', 4, '300', 'FIRST', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(649, 'Primary Health Care Management', 'CHE 261', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(650, 'Referral System and Outreach Services', 'CHE 262', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(651, 'Accounting System in Primary Health Care', 'CHE 263', 1, '300', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(652, 'Health Management Information System', 'CHE 264', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(653, 'Entrepreneurship Education', 'BUS 213', 2, '300', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(654, 'Research project', 'CHE 265', 4, '300', 'SECOND', 'Diploma in Community Health(CHEW)(DE)', '2023/2024', NULL, NULL),
(655, 'Food and Beverage Production', 'HHM 101', 2, 'NDI', 'FIRST', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(656, 'Food and Beverage Production', 'HHM 102', 2, 'NDI', 'SECOND', 'ND Nutrition and Dietetics', '2023/2024', NULL, NULL),
(657, 'Enterpreneurship', 'EED 126', 1, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(658, 'Use of Library', 'LIS 101', 2, 'NDI', 'SECOND', 'ND Dental Therapy', '2023/2024', NULL, NULL),
(659, 'Use of English', 'GNS 101', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(660, 'Algebra and Elementary Trigonometry', 'MATH 101', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(661, 'General Physics 1', 'PHY 111', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(662, 'General and Physical Chemistry 1', 'CHEM 111', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(663, 'Citizenship Education', 'GNS 111', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(664, 'Computer 1', 'COM 111', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(665, 'Entrepreneurship', 'GNS 103', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(666, 'Medical Image Processing', 'MXT 101', 2, '100', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(667, 'Communication in English', 'GNS 102', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(668, 'Research Method 1', 'GNS 228', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(669, 'General Physics II', 'PHY 112', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(670, 'General and Physical Chemistry II', 'CHEM 112', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(671, 'Human Anatomy 1', 'ANA 121', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(672, 'Medical Image Processing II', 'MXT 102', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(673, 'Medical Image Processing III', 'MXT 103', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(674, 'Computer Studies II', 'COM 112', 2, '100', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(675, 'Human Anatomy II', 'ANA 122', 2, '200', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(676, 'Research Method II', 'GNS 328', 2, '200', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(677, 'Atomic and Radiation Physics', 'MXT 112', 2, '200', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(678, 'Processing Chemicals and their Formulations', 'MXT 201', 2, '200', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(679, 'Manual Film Processing Equipment and Techniques', 'MXT 202', 4, '200', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(680, 'Practical Demonstration/viva 1', 'MXT 203', 4, '200', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(681, 'Introduction to Radiographic Anatomy', 'MXT 204', 2, '200', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(682, 'Automatic film processing Equipment and Techniques', 'MXT 205', 4, '200', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(683, 'Dark room Health Hazard/ Quality Assurance', 'MXT 206', 2, '200', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(684, 'Practical Demonstration/viva II', 'MXT 207', 4, '200', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(685, 'Care of patient/ Health Management 1', 'MXT 208', 2, '200', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(686, 'Radiographic Techniques of upper limb', 'MXT 209', 2, '200', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(687, 'Radiographic Techniques of the lower limb', 'MXT 301', 4, '300', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(688, 'Basic Radiographic Equipment', 'MXT 302', 4, '300', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(689, 'Practical Demonstration/viva 3', 'MXT 306', 4, '300', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(690, 'Care of patient/ Health Management 2', 'MXT 311', 2, '300', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(691, 'Introduction to Daylight/Digital image Processes', 'MXT 303', 2, '300', 'FIRST', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(692, 'Industrial Training/ Practical attachment', 'MXT 304', 6, '300', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(693, 'Research Project', 'MXT 305', 4, '300', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(694, 'Final viva/ qualifying Board examination', 'MXT 305', 4, '300', 'SECOND', 'Professional Certificate in Medical Image Processing/X-ray Technician', '2023/2024', NULL, NULL),
(695, 'Health Information Management 1', 'HIT 111', 3, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(696, 'Fundamentals of Medical Practice', 'HIT 112', 2, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(697, 'Communication in Health Information Management', 'HIT 113', 3, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(698, 'Mathematics for Health Information Management', 'HIS 111', 2, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(699, 'Human Anatomy and Physiology 1', 'HIS 113', 3, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(700, 'Descriptive Statistics 1', 'STA 114', 2, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(701, 'Introduction to Computers', 'COM 111', 3, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(702, 'Use of English 1', 'GNS 101', 2, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(703, 'Disease Classification and Clinical Coding 1', 'HIT 121', 3, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(704, 'Health Planning and Management 1', 'HIS 121', 2, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(705, 'Introduction to Programming', 'HIS 123', 3, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(706, 'Primary Health Care for Health Information Management 1', 'HIS 125', 2, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(707, 'Descriptive Statistics II', 'HIS 126', 3, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(708, 'Entrepreneurship', 'EED 126', 3, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(709, 'Operating System', 'HIS 114', 3, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(710, 'Citizenship Education', 'GNS 111', 2, '100', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(711, 'Health Informatics 1', 'HIS 211', 3, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(712, 'Health Information Management II', 'HIT 211', 3, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(713, 'Medical Demography', 'HIS 213', 2, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(714, 'Disease Classification and Clinical Coding II', 'HIT 212', 2, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(715, 'Human Anatomy and Physiology II', 'HIS 214', 3, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(716, 'Monitoring and Evaluation 1', 'HIT 213', 2, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(717, 'Statistical Theory for HIM', 'HIS 122', 2, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(718, 'Computer Packages 1', 'HIS 124', 2, '200', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(719, 'Applied General Statistics', 'HIS 221', 3, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(720, 'Electronic Health Records 1', 'HIT 221', 3, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(721, 'Legal and Ethical Aspects of HIM 1', 'HIT 222', 2, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(722, 'Data sharing, Dissemination and Use 1', 'HIT 223', 2, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(723, 'Hospital Statistics 1', 'HIT 225', 3, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(724, 'Communication in English 1', 'GNS 102', 2, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(725, 'Research Methods', 'GNS 228', 2, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(726, 'Health Planning and Management II', 'HIS 222', 2, '200', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(727, 'Database Management Systems 1', 'HIS 311', 2, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(728, 'Introduction To Medical Sociology', 'GNS 213', 3, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(729, 'Monitoring and Evaluation II', 'HIS 312', 3, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(730, 'Record Documentation Systems', 'HIT 311', 2, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(731, 'Citizenship Education II', 'GNS 121', 2, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(732, 'Introduction to Conservation and Preservation', 'LIS 206', 3, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(733, 'Introduction Sampling Techniques', 'HIS 313', 3, '300', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(734, 'Diseases Classification and Clinical Coding II', 'HIT 321', 3, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(735, 'Health Planning and Management III', 'HIT 322', 2, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(736, 'Health Information Management III', 'HIT 323', 3, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(737, 'Independent study (Project)', 'HIT 324', 6, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(738, 'Hospital Statistics II', 'HIT 325', 3, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(739, 'Fundamentals of Data Analysis', 'HIT 321', 2, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(740, 'Health Care Finance', 'HIS 328', 2, '300', 'SECOND', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(741, 'Use of Library', 'LIS 101', 2, '100', 'FIRST', 'Professional Diploma in Health Information Management', '2023/2024', NULL, NULL),
(742, 'RESEARCH METHODS', 'GNS 228', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(743, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 111', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(744, 'GENERAL MATHEMATICS', 'MTH 101', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(745, 'PUBLIC HEALTH PEST MANAGEMENT', 'EHT 211', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(746, 'PRINCIPLES OF EPIDEMIOLOGY AND DISEASE CONTROL', 'EHT 201', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(747, 'ENTOMOLOGY AND PEST CONTROL', 'EHT 202', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(748, 'ENVIRONMENTAL AND PUBLIC HEALTH PARASITOLOGY', 'EHT 203', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(749, 'SOLID WASTE MANAGEMENT', 'EHT 204', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(750, 'ENVIRONMENTAL APPRAISAL', 'EHT 216', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(751, 'TECHNICAL REPORT WRITING', 'PEL 217', 1, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL);
INSERT INTO `course` (`id`, `course_title`, `course_code`, `course_unit`, `level`, `semester`, `course`, `session1`, `created_at`, `updated_at`) VALUES
(752, 'FOOD SCIENCE AND  NUTRITION', 'NUD 223', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(753, 'CITIZENSHIP EDUCATION', 'GNS 227', 1, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(754, 'INTRODUCTION TO COMPUTER SCIENCE', 'CSC 101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(755, 'ANATOMY', 'ANA 101', 4, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(756, 'GENERAL PHYSICS', 'PHY 101', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(757, 'GENERAL CHEMISTRY', 'CHM 101', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(758, 'PRIMARY HEALTH CARE I', 'CHO 111', 3, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(759, 'HEALTH AGENCIES (NATIONAL AND INTERNATIONAL)', 'EHT 205', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(760, 'USE OF ENGLISH', 'GST 101', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(761, 'INTRODUCTION TO MEDICAL SOCIOLOGY', 'EVT 103', 2, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(762, 'ENVIRONMENTAL HEALT LAB I', 'EHT 206', 2, 'NDII', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(763, 'ENVIRONMENTAL ETHICS', 'EVT 105', 3, 'NDI', 'FIRST', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(764, 'HUMAN ANATOMY AND PHYSIOLOGY II', 'DTH 216', 4, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(765, 'INTRODUCTION TO ENVIRONMENTAL HEALTH', 'EHT 104', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(766, 'INTRODUCTION TO ENVIRONMENTAL MANAGEMENT', 'EHT 121', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(767, 'BUILDING SANITATION', 'EHT 123', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(768, 'HEALTH ECOLOGY', 'EHT 106', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(769, 'PUBLIC HELATH LAWS AND ETHICS', 'EHT 210', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(770, 'HEALTH EDUCATION I', 'EHT 228', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(771, 'PRINCIPLES AND PRACTICE OF FIRST AID', 'EHT 207', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(772, 'INTRODUCTION TO IMMUNOLOGY', 'EHT 213', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(773, 'PRIMARY HEALTH CARE DELIVERY SYSTEM', 'EHT 211', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(774, 'PROJECT REPORT WRITING', 'EHT 229', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(775, 'PRINCIPLES OF ENVIRONMENTAL HEALTH ADMINISTRATION', 'EHT 226', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(776, 'WATER SANITATION', 'EHT 208', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(777, 'INRODUCTION TO DEMOGRAPHY', 'EHT 102', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(778, 'CONTEMPORARY ENVIRONMENTAL HEALTH ISSUES', 'EHT 223', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(779, 'INTRODUCTION TO PHARMACOLOGY', 'PHM 101', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(780, 'FOOD HYGIENE AND INSPECTION', 'EHT 209', 3, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(781, 'COMMUNICATION IN ENGLISH II', 'GNS 102', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(782, 'ENVIRONMENTAL SCANNING', 'EHT 105', 1, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(783, 'INTRODUCTION TO MICROBIOLOGY', 'STB 211', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(784, 'ENTREPRENEURSHIP EDUCATION', 'EED 126', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(785, 'TECHNICAL DRAWING', 'PTD 111', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(786, 'INTRODUCTION TO BIOCHEMISTRY', 'EHS 103', 3, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(787, 'INTRODUCTION TO SOCIOLOGY', 'GNS 115', 2, 'NDI', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(788, 'SANITARY INSPECTION OF PREMISES', 'EHT 212', 2, 'NDII', 'SECOND', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', '2023/2024', NULL, NULL),
(789, 'Health Information Management I', 'HIM 111', 3, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(790, 'Fundamental of Medical Practice', 'HIM 112', 2, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(791, 'Communication in Health Information Management', 'HIM 113', 3, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(792, 'Mathematics for Health Information Management', 'HIS 111', 3, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(793, 'Introduction to Operating System', 'HIS 112', 2, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(794, 'Human Anatomy and Physiology I', 'HIS 113', 2, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(795, 'Descriptive Statistics I', 'STA 111', 3, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(796, 'Introduction to Computers', 'COM 111', 3, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(797, 'Use of English', 'GNS 101', 2, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(798, 'Citizenship Education', 'GNS 111', 2, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(799, 'Disease Classification and Clinical Coding I', 'HIM 121', 2, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(800, 'Health Planning and Management', 'HIS 121', 2, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(801, 'Statistical Theory for HIM', 'HIS 122', 3, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(802, 'Introduction to Programming', 'HIS 123', 3, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(803, 'Computer Packages 1', 'HIS 124', 2, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(804, 'Primary Health Care for HIM 1', 'HIS 125', 2, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(805, 'Descriptive Statistics II', 'HIS 126', 3, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(806, 'Entrepreneurship', 'Eed 126', 3, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(807, 'Communication in English I', 'GNS 102', 2, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(808, 'Citizenship Education II', 'GNS 121', 2, 'NDI', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(809, 'Disease Classification and Clinical Coding II', 'HIM 212', 3, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(810, 'Record Documentation System', 'HIM 213', 2, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(811, 'Health Informaation I', 'HIS 211', 2, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(812, 'Database Management System I', 'HIS 212', 2, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(813, 'Medical Demography', 'HIT 213', 3, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(814, 'Monitoring and Evaluation I', 'HIS 214', 2, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(815, 'Fundamentals of Data Analysis', 'HIS 215', 2, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(816, 'Human Anatomy and Physiology II', 'HIS 216', 3, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(817, 'Introduction to Medical Sociology', 'GNS 213', 3, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(818, 'Research Methods', 'GNS 228', 2, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(819, 'Electronic Health Records I', 'HIM 221', 2, 'NDII', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(820, 'Hospital Statistics', 'HIM 222', 1, 'NDII', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(821, 'Project', 'HIS 223', 6, 'NDII', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(822, 'Monitoring and Evaluation II', 'HIS 221', 2, 'NDII', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(823, 'Legal and Ethical Aspects of HIM I', 'HIS 222', 2, 'NDII', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(824, 'Applied and General Statistics', 'HIS 222', 3, 'NDII', 'SECOND', 'ND Health Information Management', '', NULL, NULL),
(825, 'Use of Library', 'LIS 111', 1, 'NDI', 'FIRST', 'ND Health Information Management', '', NULL, NULL),
(826, 'Health Information Management II', 'HIM 211', 3, 'NDII', 'FIRST', 'ND Health Information Management', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_study`
--

CREATE TABLE `course_study` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept` varchar(255) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_study`
--

INSERT INTO `course_study` (`id`, `dept`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, 'PUBLIC HEALTH NURSING', 'HND in Public Health Nursing', NULL, NULL),
(2, 'PUBLIC HEALTH NURSING', 'HND in Public Health Nursing (DE)', NULL, NULL),
(3, 'PUBLIC HEALTH NURSING', 'Certificate for Health Assistants', NULL, NULL),
(4, 'PUBLIC HEALTH NURSING', 'Diploma for Health Technicians', NULL, NULL),
(5, 'ENVIRONMENTAL HEALTH', 'Certificate for Environmental Health Technicians', NULL, NULL),
(6, 'ENVIRONMENTAL HEALTH', 'Diploma in Health Promotion and education', NULL, NULL),
(7, 'HEALTH INFORMATION MANAGEMENT', 'Professional Diploma in Health Information Management', NULL, NULL),
(8, 'COMMUNITY HEALTH', 'Diploma in Community Health(CHEW)', NULL, NULL),
(9, 'COMMUNITY HEALTH', 'Diploma in Community Health(CHEW)(DE)', NULL, NULL),
(10, 'COMMUNITY HEALTH', 'Certificate in Community Health(JCHEW)', NULL, NULL),
(11, 'PHARMACY TECHNICIAN', 'Certificate for Pharmacy Technicians', NULL, NULL),
(12, 'ENVIRONMENTAL HEALTH', 'WAHEB Certificate in  Food Hygiene', NULL, NULL),
(13, 'ORAL HEALTH SCIENCE', 'Professional Diploma for Dental Surgery Technicians', NULL, NULL),
(14, 'MEDICAL LABORATORY SCIENCE', 'Certificate for  Medical Laboratory Technicians(MLT)', NULL, NULL),
(15, 'PUBLIC HEALTH NURSING', 'Diploma for Health Technicians(DE)', NULL, NULL),
(16, 'ENVIRONMENTAL HEALTH', 'Diploma in Hospitality Management', NULL, NULL),
(17, 'ENVIRONMENTAL HEALTH', 'NABTEB Certificate in Catering Craft Practice', NULL, NULL),
(18, 'ENVIRONMENTAL HEALTH', 'Diploma in Food Hygiene', NULL, NULL),
(19, 'COMPLEMENTARY HEALTH SCIENCES (NATURAL/ALTERNATIVE MEDICINE)', 'Diploma in Complementary Health Sciences (Natural/Alternative Medicine)', NULL, NULL),
(20, 'ENVIRONMENTAL HEALTH', 'ND in Environmental Health Technology', NULL, NULL),
(21, 'ENVIRONMENTAL HEALTH', 'HND in Environmental Health Technology', NULL, NULL),
(22, 'NUTRITION AND DIETETICS', 'ND Nutrition and Dietetics', NULL, NULL),
(23, 'HEALTH INFORMATION MANAGEMENT', 'ND Health Information Management', NULL, NULL),
(24, 'ORAL HEALTH SCIENCE', 'ND Dental Therapy', NULL, NULL),
(25, 'ORAL HEALTH SCIENCE', 'ND Dental Nursing', NULL, NULL),
(26, 'MEDICAL IMAGE PROCESSING TECHNICIAN', 'Professional Certificate in Medical Image Processing/X-ray Technician', NULL, NULL),
(27, 'ENVIRONMENTAL HEALTH', 'ND(WAHEB) in Environmental Health Technology', NULL, NULL),
(28, 'ENVIRONMENTAL HEALTH', 'ND(WAHEB) in Environmental Health Technology(OKEHO)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_study_all`
--

CREATE TABLE `course_study_all` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_study_all`
--

INSERT INTO `course_study_all` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'HND in Public Health Nursing', NULL, NULL),
(2, 'HND in Public Health Nursing (DE)', NULL, NULL),
(3, 'Certificate for Health Assistants', NULL, NULL),
(4, 'Diploma for Health Technicians', NULL, NULL),
(5, 'Certificate for Environmental Health Technicians', NULL, NULL),
(6, 'Diploma in Health Promotion and education', NULL, NULL),
(7, 'Professional Diploma in Health Information Management', NULL, NULL),
(8, 'Diploma in Community Health(CHEW)', NULL, NULL),
(9, 'Diploma in Community Health(CHEW)(DE)', NULL, NULL),
(10, 'Certificate in Community Health(JCHEW)', NULL, NULL),
(11, 'Certificate for Pharmacy Technicians', NULL, NULL),
(12, 'WAHEB Certificate in  Food Hygiene', NULL, NULL),
(13, 'Professional Diploma for Dental Surgery Technicians', NULL, NULL),
(14, 'Certificate for  Medical Laboratory Technicians(MLT)', NULL, NULL),
(15, 'Diploma for Health Technicians(DE)', NULL, NULL),
(16, 'Diploma in Hospitality Management', NULL, NULL),
(17, 'NABTEB Certificate in Catering Craft Practice', NULL, NULL),
(18, 'Diploma in Food Hygiene', NULL, NULL),
(19, 'Diploma in Complementary Health Sciences (Natural/Alternative Medicine)', NULL, NULL),
(20, 'ND in Environmental Health Technology', NULL, NULL),
(21, 'HND in Environmental Health Technology', NULL, NULL),
(22, 'ND Nutrition and Dietetics', NULL, NULL),
(23, 'ND Health Information Management', NULL, NULL),
(24, 'ND Dental Therapy', NULL, NULL),
(25, 'ND Dental Nursing', NULL, NULL),
(26, 'ND(WAHEB) in Environmental Health Technology', NULL, NULL),
(27, 'Professional Certificate in Medical Image Processing/X-ray Technician', NULL, NULL),
(28, 'HND(WAHEB) in Environmental Health Technology', NULL, NULL),
(29, 'ND(WAHEB) in Environmental Health Technology(OKEHO)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, 'PUBLIC HEALTH NURSING', NULL, NULL),
(2, 'HEALTH INFORMATION MANAGEMENT', NULL, NULL),
(3, 'PHARMACY TECHNICIAN', NULL, NULL),
(4, 'COMMUNITY HEALTH', NULL, NULL),
(5, 'ENVIRONMENTAL HEALTH', NULL, NULL),
(6, 'ORAL HEALTH SCIENCE', NULL, NULL),
(7, 'MEDICAL LABORATORY SCIENCE', NULL, NULL),
(8, 'COMPLEMENTARY HEALTH SCIENCES (NATURAL/ALTERNATIVE MEDICINE)', NULL, NULL),
(9, 'MEDICAL IMAGE PROCESSING TECHNICIAN', NULL, NULL),
(10, 'NUTRITION AND DIETETICS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_logins`
--

CREATE TABLE `failed_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grading_system`
--

CREATE TABLE `grading_system` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade01` varchar(255) NOT NULL,
  `grade02` varchar(255) NOT NULL,
  `grade11` varchar(255) NOT NULL,
  `grade12` varchar(255) NOT NULL,
  `grade21` varchar(255) NOT NULL,
  `grade22` varchar(255) NOT NULL,
  `grade31` varchar(255) NOT NULL,
  `grade32` varchar(255) NOT NULL,
  `grade41` varchar(255) NOT NULL,
  `grade42` varchar(255) NOT NULL,
  `interpretation1` varchar(255) NOT NULL,
  `interpretation2` varchar(255) NOT NULL,
  `interpretation3` varchar(255) NOT NULL,
  `interpretation4` varchar(255) NOT NULL,
  `interpretation5` varchar(255) NOT NULL,
  `unit01` varchar(255) NOT NULL,
  `unit02` varchar(255) NOT NULL,
  `unit03` varchar(255) NOT NULL,
  `unit04` varchar(255) NOT NULL,
  `unit05` varchar(255) NOT NULL,
  `unit06` varchar(255) NOT NULL,
  `grade51` varchar(255) NOT NULL,
  `grade52` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `arepeat` varchar(255) NOT NULL,
  `awithdraw` varchar(255) NOT NULL,
  `lgrade1` varchar(255) NOT NULL,
  `lgrade2` varchar(255) NOT NULL,
  `lgrade3` varchar(255) NOT NULL,
  `lgrade4` varchar(255) NOT NULL,
  `lgrade5` varchar(255) NOT NULL,
  `lgrade6` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grading_system`
--

INSERT INTO `grading_system` (`id`, `grade01`, `grade02`, `grade11`, `grade12`, `grade21`, `grade22`, `grade31`, `grade32`, `grade41`, `grade42`, `interpretation1`, `interpretation2`, `interpretation3`, `interpretation4`, `interpretation5`, `unit01`, `unit02`, `unit03`, `unit04`, `unit05`, `unit06`, `grade51`, `grade52`, `dept`, `arepeat`, `awithdraw`, `lgrade1`, `lgrade2`, `lgrade3`, `lgrade4`, `lgrade5`, `lgrade6`, `created_at`, `updated_at`) VALUES
(1, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'PHARMACY TECHNICIAN', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(2, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'PUBLIC HEALTH NURSING', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(3, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'HEALTH INFORMATION MANAGEMENT', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(4, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'COMMUNITY HEALTH', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(5, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'ENVIRONMENTAL HEALTH', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(6, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'ORAL HEALTH SCIENCE', '3', '1.5', 'A', 'AB', 'BB', 'BC', 'C', 'F', NULL, NULL),
(7, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'COMPLEMENTARY HEALTH SCIENCES (NATURAL/ALTERNATIVE MEDICINE)', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(8, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'MEDICAL IMAGE PROCESSING TECHNICIAN', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(9, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'NUTRITION AND DIETETICS', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL),
(10, '70', '100', '65', '69', '60', '64', '55', '59', '50', '54', '', '', '', '', '', '4.00', '3.50', '3.00', '2.50', '2.00', '0.00', '0', '49', 'MEDICAL LABORATORY SCIENCE', '3', '1.5', 'A', 'AB', 'B', 'BC', 'C', 'F', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_11_125434_create_user_clearances_table', 1),
(6, '2024_04_11_125454_create_user_tracks_table', 1),
(7, '2024_04_11_125520_create_payment_transactions_table', 1),
(8, '2024_04_11_132237_create_failed_logins_table', 1),
(9, '2024_04_14_174206_create_user_requests_table', 1),
(10, '2024_04_15_190502_create_user_years_table', 1),
(11, '2024_04_15_190529_create_user_programmes_table', 1),
(12, '2024_04_16_172227_create_transcript_fees_table', 1),
(13, '2024_04_22_173632_create_transcript_uploads_table', 1),
(14, '2024_12_21_201200_create_administratorcontrol_table', 2),
(15, '2024_12_21_201625_create_course_table', 2),
(16, '2024_12_21_202908_create_course_study_table', 3),
(17, '2024_12_21_203436_create_course_study_all_table', 4),
(18, '2024_12_21_203916_create_department_table', 5),
(19, '2024_12_21_204306_create_grading_system_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `matric_no` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL,
  `amount_due` double NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `response_status` varchar(255) DEFAULT NULL,
  `flicks_transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transcript_fees`
--

CREATE TABLE `transcript_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transcript_uploads`
--

CREATE TABLE `transcript_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `transcript_dir` varchar(255) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_type_status` enum('1','2','3') NOT NULL COMMENT '1: Admin, 2: Instructor, 3: Student',
  `email_verified_status` int(11) DEFAULT NULL,
  `login_attempts` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `email_verified_at`, `password`, `phone_no`, `user_type`, `user_type_status`, `email_verified_status`, `login_attempts`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Akinyooye', 'Femi', 'admin@gmail.com', '2024-12-21 19:44:24', '$2y$12$x5zAbUJ8ncVsTOEa/zK2hetsVWi5qpjJtEImD/I0eDMwHg/paZ5De', '23409073829919', 'Admin', '1', 1, 0, NULL, NULL, '2024-12-22 03:44:09'),
(2, 'Johnson', 'Jane', 'instructor@gmail.com', NULL, '$2y$12$30IXqKdCKpnzdvvHsZLJVOEM40h28OANUiDxriwwsqB.JqKFIgeLq', '23408123456789', 'Instructor', '2', NULL, NULL, NULL, NULL, NULL),
(3, 'Doe', 'John', 'student@gmail.com', NULL, '$2y$12$6tmuS8WPcl2Z0RZ2U7RVJuj.86l43KJpVze1m1G3GvwE4K..XQ7Tq', '23407098765432', 'Student', '3', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_clearances`
--

CREATE TABLE `user_clearances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clearance_no` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_programmes`
--

CREATE TABLE `user_programmes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programme` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `matric_no` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `graduation_year` varchar(255) NOT NULL,
  `programme` varchar(255) NOT NULL,
  `clearance_no` varchar(255) NOT NULL,
  `destination_address` varchar(255) NOT NULL,
  `certificate_status` varchar(255) NOT NULL,
  `certificate_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tracks`
--

CREATE TABLE `user_tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `certificate_status` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_years`
--

CREATE TABLE `user_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator_control`
--
ALTER TABLE `administrator_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_study`
--
ALTER TABLE `course_study`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_study_all`
--
ALTER TABLE `course_study_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `failed_logins`
--
ALTER TABLE `failed_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grading_system`
--
ALTER TABLE `grading_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transcript_fees`
--
ALTER TABLE `transcript_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transcript_uploads`
--
ALTER TABLE `transcript_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_clearances`
--
ALTER TABLE `user_clearances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_programmes`
--
ALTER TABLE `user_programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tracks`
--
ALTER TABLE `user_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_years`
--
ALTER TABLE `user_years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator_control`
--
ALTER TABLE `administrator_control`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=827;

--
-- AUTO_INCREMENT for table `course_study`
--
ALTER TABLE `course_study`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_study_all`
--
ALTER TABLE `course_study_all`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grading_system`
--
ALTER TABLE `grading_system`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transcript_fees`
--
ALTER TABLE `transcript_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transcript_uploads`
--
ALTER TABLE `transcript_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_clearances`
--
ALTER TABLE `user_clearances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_programmes`
--
ALTER TABLE `user_programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tracks`
--
ALTER TABLE `user_tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_years`
--
ALTER TABLE `user_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
