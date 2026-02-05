-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: feb. 05, 2026 la 05:13 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `porsche`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admin`
--

CREATE TABLE `admin` (
  `cod_admin` int(4) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `parola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `admin`
--

INSERT INTO `admin` (`cod_admin`, `nume`, `parola`) VALUES
(1, 'admin1', '1234');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `echipare`
--

CREATE TABLE `echipare` (
  `id_echipare` int(4) NOT NULL,
  `id_model` int(4) NOT NULL,
  `poza_model` varchar(250) NOT NULL,
  `nume_echipare` varchar(50) NOT NULL,
  `pret` decimal(15,2) NOT NULL,
  `acceleratie` decimal(4,1) NOT NULL,
  `putere` int(5) NOT NULL,
  `viteza_max` int(5) NOT NULL,
  `cod_motor` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `echipare`
--

INSERT INTO `echipare` (`id_echipare`, `id_model`, `poza_model`, `nume_echipare`, `pret`, `acceleratie`, `putere`, `viteza_max`, `cod_motor`) VALUES
(37, 3, '718-Spyder RS_37.avif', 'Spyder RS', 173853.85, 3.4, 368, 308, 1),
(38, 3, '718-Cayman GT4 RS_38.avif', 'Cayman GT4 RS', 171853.85, 3.4, 368, 315, 1),
(39, 1, '911-Carrera_39.avif', 'Carrera', 144520.74, 4.1, 290, 294, 1),
(40, 1, '911-Carrera T_40.avif', 'Carrera T', 155200.99, 4.5, 290, 295, 1),
(41, 1, '911-Carrera 4 GTS_41.avif', 'Carrera 4 GTS', 192829.98, 3.0, 398, 312, 1),
(42, 1, '911-Carrera Cabriolet_42.avif', 'Carrera Cabriolet', 158963.77, 4.3, 290, 291, 1),
(43, 1, '911-Targa 4 GTS_43.avif', 'Targa 4 GTS', 207271.82, 3.1, 312, 398, 1),
(44, 2, 'Taycan-4_44.avif', '4', 113762.81, 4.6, 300, 230, 3),
(45, 2, 'Taycan-GTS_45.avif', 'GTS', 155968.54, 3.3, 515, 250, 3),
(46, 2, 'Taycan-Turbo S Sport Turismo_46.avif', 'Turbo S Sport Turismo', 220142.86, 2.4, 700, 260, 3),
(47, 4, 'Panamera-4_47.avif', '4', 128458.12, 5.0, 260, 270, 1),
(48, 4, 'Panamera-4S E-Hybrid_48.avif', '4S E-Hybrid', 152870.97, 3.7, 400, 290, 2),
(49, 5, 'Macan-4_49.avif', '4', 87605.42, 5.2, 300, 220, 3),
(50, 5, 'Macan-Turbo_50.avif', 'Turbo', 119560.49, 3.3, 470, 260, 3),
(51, 6, 'Cayenne-E-Hybrid_51.avif', 'E-Hybrid', 119708.05, 4.9, 346, 254, 2),
(52, 6, 'Cayenne-S_52.avif', 'S', 126213.78, 5.0, 349, 273, 1),
(53, 6, 'Cayenne-S E-Hybrid Coupe_53.avif', 'S E-Hybrid Coupe', 134454.53, 4.7, 382, 263, 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `modele`
--

CREATE TABLE `modele` (
  `id_model` int(4) NOT NULL,
  `nume_model` varchar(50) NOT NULL,
  `nume_foto` varchar(100) NOT NULL,
  `fotografie` varchar(100) NOT NULL,
  `descriere` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `modele`
--

INSERT INTO `modele` (`id_model`, `nume_model`, `nume_foto`, `fotografie`, `descriere`) VALUES
(1, '911', '911.svg', '911.jpeg', 'Iconic 2-door rear-engine sports car.'),
(2, 'Taycan', 'taycan.svg', 'taycan.avif', '4-door, 4/5-seater, electric sports car.'),
(3, '718', '718.svg', '718.avif', 'Mid-engine 2-seater sports car. '),
(4, 'Panamera', 'panamera.svg', 'panamera.avif', '4-door, 4-seater, high comfort luxury sedan.'),
(5, 'Macan', 'macan.svg', 'macan.avif', '4-door, 5-seater, sporty compact SUV. '),
(6, 'Cayenne', 'cayenne.svg', 'cayenne.avif', 'Up to 5-seats versatile SUV.');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `motorizare`
--

CREATE TABLE `motorizare` (
  `cod_motor` int(4) NOT NULL,
  `tip_motor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `motorizare`
--

INSERT INTO `motorizare` (`cod_motor`, `tip_motor`) VALUES
(1, 'Benzina'),
(2, 'Hibrid'),
(3, 'Electric'),
(6, 'Hidrogen');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`cod_admin`),
  ADD UNIQUE KEY `nume` (`nume`);

--
-- Indexuri pentru tabele `echipare`
--
ALTER TABLE `echipare`
  ADD PRIMARY KEY (`id_echipare`),
  ADD KEY `id_model` (`id_model`,`cod_motor`),
  ADD KEY `cod_motor` (`cod_motor`);

--
-- Indexuri pentru tabele `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id_model`);

--
-- Indexuri pentru tabele `motorizare`
--
ALTER TABLE `motorizare`
  ADD PRIMARY KEY (`cod_motor`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `admin`
--
ALTER TABLE `admin`
  MODIFY `cod_admin` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `echipare`
--
ALTER TABLE `echipare`
  MODIFY `id_echipare` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pentru tabele `modele`
--
ALTER TABLE `modele`
  MODIFY `id_model` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `motorizare`
--
ALTER TABLE `motorizare`
  MODIFY `cod_motor` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `echipare`
--
ALTER TABLE `echipare`
  ADD CONSTRAINT `echipare_ibfk_1` FOREIGN KEY (`cod_motor`) REFERENCES `motorizare` (`cod_motor`),
  ADD CONSTRAINT `echipare_ibfk_2` FOREIGN KEY (`id_model`) REFERENCES `modele` (`id_model`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
