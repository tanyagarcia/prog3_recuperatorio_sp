-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 12:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recuperatorio_sp`
--

-- --------------------------------------------------------

--
-- Table structure for table `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL,
  `tipo_mascota` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `precio_mascota` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `fecha_turno` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `tipo_mascota`, `precio_mascota`, `turno`, `fecha_turno`, `created_at`, `updated_at`) VALUES
(1, 'gato', 1400, 1, '06/12/2020', '2020-12-02 02:31:35', '2020-12-02 03:39:04'),
(2, 'perro', 1750, 1, '01/12/2020', '2020-12-02 02:33:05', '2020-12-02 03:38:14'),
(3, 'huron', 2500, 0, NULL, '2020-12-02 03:03:05', '2020-12-02 03:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `turnos`
--

CREATE TABLE `turnos` (
  `id_cliente` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `turnos`
--

INSERT INTO `turnos` (`id_cliente`, `id_mascota`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-12-02 03:37:08', '2020-12-02 03:37:08'),
(1, 2, '2020-12-02 03:38:14', '2020-12-02 03:38:14'),
(1, 1, '2020-12-02 03:39:04', '2020-12-02 03:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `clave`, `tipo`, `email`, `created_at`, `updated_at`) VALUES
(1, 'manuel', 112233, 'cliente', 'manuel@mail.com', '2020-12-02 01:56:03', '2020-12-02 01:56:03'),
(2, 'tanya', 114477, 'admin', 'tanya@mail.com', '2020-12-02 02:12:30', '2020-12-02 02:12:30'),
(3, 'rocio', 446688, 'cliente', 'rocio@mail.com', '2020-12-02 03:02:13', '2020-12-02 03:02:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
