-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 10.169.0.50
-- Generation Time: Dec 10, 2018 at 01:12 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casalcat_casalbiblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradors`
--

CREATE TABLE `administradors` (
  `administrador_ID` int(11) NOT NULL,
  `administrador_nom` varchar(50) NOT NULL DEFAULT '',
  `administrador_password` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `autors`
--

CREATE TABLE `autors` (
  `autor_ID` int(11) NOT NULL,
  `autor_nom` varchar(50) NOT NULL DEFAULT '',
  `autor_cognoms` varchar(50) DEFAULT NULL,
  `autor_idioma_ID` int(11) NOT NULL DEFAULT '0',
  `autor_biografia` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoria_ID` int(11) NOT NULL,
  `categoria_nom` varchar(25) DEFAULT NULL,
  `categoria_descripcio` text,
  `categoria_medi_ID` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `editorials`
--

CREATE TABLE `editorials` (
  `editorial_ID` int(11) NOT NULL,
  `editorial_nom` varchar(50) NOT NULL DEFAULT '',
  `editorial_colleccio` varchar(50) DEFAULT NULL,
  `editorial_adreca` varchar(100) DEFAULT NULL,
  `editorial_extra` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `idiomes`
--

CREATE TABLE `idiomes` (
  `idioma_ID` int(11) NOT NULL,
  `idioma_nom` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medis`
--

CREATE TABLE `medis` (
  `medi_ID` int(11) NOT NULL,
  `medi_nom` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `procedencies`
--

CREATE TABLE `procedencies` (
  `procedencia_ID` int(11) NOT NULL,
  `procedencia_descripcio` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE `Status` (
  `Status_ID` int(11) NOT NULL,
  `Status_Descripcio` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `titols`
--

CREATE TABLE `titols` (
  `titol_ID` int(11) NOT NULL,
  `titol_nom` varchar(100) NOT NULL DEFAULT '',
  `titol_autor_ID` int(11) NOT NULL DEFAULT '0',
  `titol_editorial_ID` int(11) NOT NULL DEFAULT '0',
  `titol_idioma_ID` int(11) NOT NULL DEFAULT '0',
  `titol_procedencia_ID` int(11) NOT NULL DEFAULT '0',
  `titol_ISBN` varchar(25) DEFAULT NULL,
  `titol_pagines` int(11) NOT NULL DEFAULT '0',
  `titol_categoria_ID` int(11) NOT NULL DEFAULT '0',
  `titol_medi_ID` int(11) NOT NULL DEFAULT '0',
  `titol_sinopsis` text,
  `titol_any` int(11) DEFAULT NULL,
  `titol_cataleg` varchar(15) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `titol_status` varchar(20) CHARACTER SET ascii COLLATE ascii_bin NOT NULL DEFAULT 'indeterminat',
  `titol_historia` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradors`
--
ALTER TABLE `administradors`
  ADD PRIMARY KEY (`administrador_ID`);

--
-- Indexes for table `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`autor_ID`),
  ADD KEY `autor_nom_index` (`autor_nom`),
  ADD KEY `autor_cognoms_index` (`autor_cognoms`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoria_ID`);

--
-- Indexes for table `editorials`
--
ALTER TABLE `editorials`
  ADD PRIMARY KEY (`editorial_ID`),
  ADD KEY `editorial_nom_index` (`editorial_nom`),
  ADD KEY `editorial_collecio_index` (`editorial_colleccio`);

--
-- Indexes for table `idiomes`
--
ALTER TABLE `idiomes`
  ADD PRIMARY KEY (`idioma_ID`);

--
-- Indexes for table `medis`
--
ALTER TABLE `medis`
  ADD PRIMARY KEY (`medi_ID`);

--
-- Indexes for table `procedencies`
--
ALTER TABLE `procedencies`
  ADD PRIMARY KEY (`procedencia_ID`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`Status_ID`),
  ADD UNIQUE KEY `Status_ID` (`Status_ID`);

--
-- Indexes for table `titols`
--
ALTER TABLE `titols`
  ADD PRIMARY KEY (`titol_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradors`
--
ALTER TABLE `administradors`
  MODIFY `administrador_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autors`
--
ALTER TABLE `autors`
  MODIFY `autor_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoria_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editorials`
--
ALTER TABLE `editorials`
  MODIFY `editorial_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `idiomes`
--
ALTER TABLE `idiomes`
  MODIFY `idioma_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medis`
--
ALTER TABLE `medis`
  MODIFY `medi_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procedencies`
--
ALTER TABLE `procedencies`
  MODIFY `procedencia_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `titols`
--
ALTER TABLE `titols`
  MODIFY `titol_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
