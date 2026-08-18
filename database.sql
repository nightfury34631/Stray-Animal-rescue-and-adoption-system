-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2026 at 11:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stray_animal_system`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `AnimalsByStatus` (`status_name` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN

    DECLARE total INT;

    SELECT COUNT(*)
    INTO total
    FROM Animals
    WHERE status = status_name;

    RETURN total;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `TotalApprovedAdoptions` () RETURNS INT(11) DETERMINISTIC BEGIN

    DECLARE total INT;

    SELECT COUNT(*)
    INTO total
    FROM Adoptions
    WHERE status='approved';

    RETURN total;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `adoption_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `adopter_id` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`adoption_id`, `animal_id`, `adopter_id`, `request_date`, `status`) VALUES
(19, 13, 3, '2026-05-04', 'approved'),
(20, 15, 3, '2026-05-04', 'approved'),
(21, 16, 3, '2026-06-09', 'approved'),
(22, 20, 3, '2026-06-10', 'approved'),
(23, 20, 3, '2026-06-10', 'approved'),
(25, 18, 3, '2026-06-10', 'approved'),
(26, 21, 3, '2026-06-11', 'approved');

--
-- Triggers `adoptions`
--
DELIMITER $$
CREATE TRIGGER `trg_approve_adoption` AFTER UPDATE ON `adoptions` FOR EACH ROW BEGIN

    IF NEW.status = 'approved' THEN

        UPDATE Animals
        SET status = 'rehomed'
        WHERE animal_id = NEW.animal_id;

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `adoption_details`
-- (See below for the actual view)
--
CREATE TABLE `adoption_details` (
`adoption_id` int(11)
,`animal_id` int(11)
,`species` varchar(50)
,`user_id` int(11)
,`adopter_name` varchar(100)
,`request_date` date
,`status` enum('pending','approved','rejected')
);

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `species` varchar(50) DEFAULT NULL,
  `animal_condition` varchar(100) DEFAULT NULL,
  `status` enum('found','rescued','treated','rehomed') DEFAULT NULL,
  `found_date` date DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `species`, `animal_condition`, `status`, `found_date`, `photo_url`, `location`) VALUES
(13, 'Dog', 'weak', 'rehomed', NULL, NULL, 'mirpur 12'),
(14, 'cat', 'Broken leg', 'rescued', NULL, NULL, 'uttara'),
(15, 'Bird', 'sick', 'rehomed', NULL, NULL, 'uttara'),
(16, 'dolphin', 'broken fin', 'rehomed', NULL, NULL, 'Mirpur'),
(17, 'dolphin', 'sick', 'found', NULL, NULL, 'mirpur 12'),
(18, 'cow', 'sick', 'rehomed', NULL, NULL, 'shyamoli'),
(20, 'peacock', 'sick', 'rehomed', NULL, NULL, 'banani'),
(21, 'cat2', 'sick', 'rehomed', NULL, NULL, 'uttara');

-- --------------------------------------------------------

--
-- Stand-in structure for view `medical_record_details`
-- (See below for the actual view)
--
CREATE TABLE `medical_record_details` (
`record_id` int(11)
,`animal_id` int(11)
,`species` varchar(50)
,`user_id` int(11)
,`vet_name` varchar(100)
,`treatment` text
,`vaccine` varchar(100)
,`date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `medrecords`
--

CREATE TABLE `medrecords` (
  `record_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `vaccine` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medrecords`
--

INSERT INTO `medrecords` (`record_id`, `animal_id`, `vet_id`, `treatment`, `vaccine`, `date`) VALUES
(9, 13, 2, 'surgery', 'flue', '2026-05-05'),
(10, 14, 2, 'leg surgery', 'rabis', '2026-05-05'),
(11, 15, 2, 'fixed the wings', 'yes', '2026-05-04'),
(13, 20, 2, 'fixed the wings', 'null', '2026-06-11'),
(14, 18, 2, 'injection for pain', 'null', '2026-06-11'),
(15, 21, 2, 'leg surgery', 'null', '2026-06-12');

--
-- Triggers `medrecords`
--
DELIMITER $$
CREATE TRIGGER `trg_animal_treated` AFTER INSERT ON `medrecords` FOR EACH ROW BEGIN

    UPDATE Animals
    SET status = 'treated'
    WHERE animal_id = NEW.animal_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `neutering`
--

CREATE TABLE `neutering` (
  `neuter_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pending_sightings`
-- (See below for the actual view)
--
CREATE TABLE `pending_sightings` (
`sighting_id` int(11)
,`species` varchar(100)
,`animal_condition` varchar(100)
,`location` varchar(255)
,`date` date
,`status` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `rescues`
--

CREATE TABLE `rescues` (
  `rescue_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `rescuer_id` int(11) DEFAULT NULL,
  `rescue_date` date DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rescues`
--

INSERT INTO `rescues` (`rescue_id`, `animal_id`, `rescuer_id`, `rescue_date`, `status`) VALUES
(25, 13, 1, '2026-05-05', 'completed'),
(26, 14, 1, '2026-05-04', 'completed'),
(27, 13, 1, '2026-05-05', 'completed'),
(28, 15, 1, '2026-05-04', 'completed'),
(29, 16, 1, '2026-06-09', 'in_progress'),
(30, 18, 1, '2026-06-11', 'completed');

-- --------------------------------------------------------

--
-- Stand-in structure for view `rescue_details`
-- (See below for the actual view)
--
CREATE TABLE `rescue_details` (
`rescue_id` int(11)
,`animal_id` int(11)
,`species` varchar(50)
,`user_id` int(11)
,`rescuer_name` varchar(100)
,`rescue_date` date
,`status` enum('pending','in_progress','completed')
);

-- --------------------------------------------------------

--
-- Table structure for table `sightings`
--

CREATE TABLE `sightings` (
  `sighting_id` int(11) NOT NULL,
  `species` varchar(100) NOT NULL,
  `animal_condition` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `reported_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sightings`
--

INSERT INTO `sightings` (`sighting_id`, `species`, `animal_condition`, `location`, `date`, `status`, `reported_by`) VALUES
(1, 'cat', 'sick', 'mirpur 12', '2026-05-05', 'approved', 1),
(2, 'Dog', 'weak', 'mirpur 12', '2026-05-04', 'approved', 4),
(3, 'cat', 'Broken leg', 'uttara', '2026-05-05', 'approved', 4),
(4, 'Bird', 'sick', 'uttara', '2026-05-04', 'approved', 4),
(5, 'dolphin', 'sick', 'mirpur 12', '2026-06-09', 'approved', 5),
(6, 'cow', 'sick', 'shyamoli', '2026-06-11', 'approved', 4),
(7, 'peacock', 'weak', 'shyamoli', '2026-06-11', 'approved', 1),
(8, 'peacock', 'sick', 'banani', '2026-06-11', 'approved', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` text NOT NULL,
  `role` enum('community','rescuer','vet','shelter','adopter','admin') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'rahim', 'rahim@email.com', 'hash123', 'rescuer', '2026-03-12 04:26:50'),
(2, 'karim', 'karim@email.com', 'hash456', 'vet', '2026-03-12 04:26:50'),
(3, 'sadia', 'sadia@email.com', 'hash789', 'adopter', '2026-03-12 04:26:50'),
(4, 'admin', 'admin@email.com', 'adminhash', 'admin', '2026-03-12 04:26:50'),
(5, 'admin2', 'admin2@email.com', 'admin2', 'admin', '2026-04-28 17:46:18'),
(6, 'admin3', 'admin3@email.com', 'admin2', 'admin', '2026-04-28 18:04:19');

-- --------------------------------------------------------

--
-- Structure for view `adoption_details`
--
DROP TABLE IF EXISTS `adoption_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `adoption_details`  AS SELECT `a`.`adoption_id` AS `adoption_id`, `an`.`animal_id` AS `animal_id`, `an`.`species` AS `species`, `u`.`user_id` AS `user_id`, `u`.`username` AS `adopter_name`, `a`.`request_date` AS `request_date`, `a`.`status` AS `status` FROM ((`adoptions` `a` join `animals` `an` on(`a`.`animal_id` = `an`.`animal_id`)) join `users` `u` on(`a`.`adopter_id` = `u`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `medical_record_details`
--
DROP TABLE IF EXISTS `medical_record_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `medical_record_details`  AS SELECT `m`.`record_id` AS `record_id`, `an`.`animal_id` AS `animal_id`, `an`.`species` AS `species`, `u`.`user_id` AS `user_id`, `u`.`username` AS `vet_name`, `m`.`treatment` AS `treatment`, `m`.`vaccine` AS `vaccine`, `m`.`date` AS `date` FROM ((`medrecords` `m` join `animals` `an` on(`m`.`animal_id` = `an`.`animal_id`)) join `users` `u` on(`m`.`vet_id` = `u`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `pending_sightings`
--
DROP TABLE IF EXISTS `pending_sightings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pending_sightings`  AS SELECT `sightings`.`sighting_id` AS `sighting_id`, `sightings`.`species` AS `species`, `sightings`.`animal_condition` AS `animal_condition`, `sightings`.`location` AS `location`, `sightings`.`date` AS `date`, `sightings`.`status` AS `status` FROM `sightings` WHERE `sightings`.`status` = 'pending' ;

-- --------------------------------------------------------

--
-- Structure for view `rescue_details`
--
DROP TABLE IF EXISTS `rescue_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rescue_details`  AS SELECT `r`.`rescue_id` AS `rescue_id`, `an`.`animal_id` AS `animal_id`, `an`.`species` AS `species`, `u`.`user_id` AS `user_id`, `u`.`username` AS `rescuer_name`, `r`.`rescue_date` AS `rescue_date`, `r`.`status` AS `status` FROM ((`rescues` `r` join `animals` `an` on(`r`.`animal_id` = `an`.`animal_id`)) join `users` `u` on(`r`.`rescuer_id` = `u`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `adopter_id` (`adopter_id`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `medrecords`
--
ALTER TABLE `medrecords`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- Indexes for table `neutering`
--
ALTER TABLE `neutering`
  ADD PRIMARY KEY (`neuter_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- Indexes for table `rescues`
--
ALTER TABLE `rescues`
  ADD PRIMARY KEY (`rescue_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `rescuer_id` (`rescuer_id`);

--
-- Indexes for table `sightings`
--
ALTER TABLE `sightings`
  ADD PRIMARY KEY (`sighting_id`),
  ADD KEY `reported_by` (`reported_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `medrecords`
--
ALTER TABLE `medrecords`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `neutering`
--
ALTER TABLE `neutering`
  MODIFY `neuter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rescues`
--
ALTER TABLE `rescues`
  MODIFY `rescue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sightings`
--
ALTER TABLE `sightings`
  MODIFY `sighting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`adopter_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `medrecords`
--
ALTER TABLE `medrecords`
  ADD CONSTRAINT `medrecords_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `medrecords_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `neutering`
--
ALTER TABLE `neutering`
  ADD CONSTRAINT `neutering_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `neutering_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rescues`
--
ALTER TABLE `rescues`
  ADD CONSTRAINT `rescues_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `rescues_ibfk_2` FOREIGN KEY (`rescuer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sightings`
--
ALTER TABLE `sightings`
  ADD CONSTRAINT `sightings_ibfk_1` FOREIGN KEY (`reported_by`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
