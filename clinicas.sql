-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2024 a las 08:52:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlaces`
--

CREATE TABLE `enlaces` (
  `id` int(4) NOT NULL,
  `enlaces` varchar(100) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enlaces`
--

INSERT INTO `enlaces` (`id`, `enlaces`, `activo`) VALUES
(2, 'turnos.html', 0),
(3, 'turnos.html', 0),
(2, 'turnos.html', 0),
(3, 'turnos.html', 0),
(4, 'turnos.html', 0),
(5, 'turnos.html', 1),
(6, '<br /><b>Warning</b>:  Undefined array key ', 1),
(7, 'turnos.html', 1),
(8, 'turnos.html', 1),
(9, 'turnos.html', 1),
(10, 'turnos.html', 1),
(11, 'turnos.html', 1),
(12, 'turnos.html', 1),
(13, 'turnos.html', 1),
(14, 'turnos.html', 1),
(15, 'turnos.html', 1),
(16, 'turnos.html', 1),
(17, 'turnos.html', 1),
(18, 'turnos.html', 1),
(19, 'turnos.html', 1),
(20, 'turnos.html', 1),
(21, 'turnos.html', 1),
(22, 'turnos.html', 1),
(23, 'turnos.html', 1),
(24, 'turnos.html', 1),
(25, 'turnos.html', 1),
(26, 'turnos.html', 1),
(27, 'turnos.html', 1),
(28, 'turnos.html', 1),
(29, 'turnos.html', 1),
(30, 'turnos.html', 1),
(31, 'turnos.html', 1),
(32, 'turnos.html', 1),
(33, 'turnos.html', 1),
(34, 'turnos.html', 1),
(35, 'turnos.html', 1),
(36, 'turnos.html', 1),
(37, 'turnos.html', 1),
(38, 'turnos.html', 1),
(39, 'turnos.html', 1),
(40, 'turnos.html', 1),
(41, 'turnos.html', 1),
(42, 'turnos.html', 1),
(43, 'turnos.html', 1),
(44, 'turnos.html', 1),
(45, 'turnos.html', 1),
(46, 'turnos.html', 1),
(47, 'turnos.html', 1),
(48, 'turnos.html', 0),
(49, 'turnos.html', 1),
(50, 'turnos.html', 1),
(1001, 'turnos.html', 1),
(1002, 'turnos.html', 1),
(1003, 'turnos.html', 1),
(1004, 'turnos.html', 1),
(1005, 'turnos.html', 1),
(1006, 'turnos.html', 1),
(1007, 'turnos.html', 1),
(1008, 'turnos.html', 1),
(1014, 'turnos.html', 1),
(1015, 'turnos.html', 1),
(1016, 'turnos.html', 1),
(1017, 'turnos.html', 0),
(1018, 'turnos.html', 1),
(1019, 'turnos.html', 1),
(1020, 'turnos.html', 1),
(1021, 'http://localhost/proyecto2/turnos.html', 1),
(1022, 'http://localhost/proyecto2/turnos.html', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `codespecialidades` int(4) NOT NULL,
  `especialidades` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`codespecialidades`, `especialidades`) VALUES
(0, 'urologo'),
(102, 'Psiquiatría'),
(103, 'Endocrinología'),
(104, 'Reumatología'),
(105, 'Ortopedia'),
(106, 'Gastroenterología'),
(2001, 'Clinico'),
(2002, 'Pedriatra'),
(2003, 'cardiologo'),
(2004, 'dentista'),
(2005, 'urologo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(4) NOT NULL,
  `medico` varchar(30) NOT NULL,
  `codespecialidad` int(4) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `medico`, `codespecialidad`, `activo`) VALUES
(2, 'Dr. Ana Gómez', 102, 1),
(3, 'Dr. Luis Martínez', 103, 0),
(4, 'Dr. Laura Sánchez', 101, 0),
(5, 'Dr. Carlos Fernández', 104, 1),
(6, 'Dr. Marta Rodrígues', 105, 1),
(7, 'Dr. Javier López', 102, 1),
(8, 'Dr. María Torres', 106, 1),
(9, 'Dr. Francisco Ruiz', 103, 1),
(10, 'Dr. Isabel Morales', 104, 1),
(11, 'Dr. Pablo González', 105, 1),
(12, 'Dr. Patricia Gómez', 106, 1),
(13, 'Dr. Manuel Ortega', 101, 1),
(14, 'Dr. Alicia Fernández', 102, 1),
(15, 'Dr. Ernesto Castro', 103, 1),
(16, 'Dr. Carmen Díaz', 104, 1),
(17, 'Dr. Sergio Vargas', 105, 1),
(18, 'Dr. Elena Morales', 106, 1),
(19, 'Dr. Alberto Ramírez', 101, 1),
(20, 'Dr. Gabriela Jiménez', 102, 1),
(21, 'Dr. Ricardo Sánchez', 103, 1),
(22, 'Dr. Sandra López', 104, 1),
(23, 'Dr. Óscar Mendoza', 105, 1),
(24, 'Dr. Laura Pérez', 106, 1),
(25, 'Dr. Andrés Castillo', 101, 1),
(26, 'Dr. Beatriz González', 102, 1),
(27, 'Dr. Julio Martínez', 103, 1),
(28, 'Dr. Paula Fernández', 104, 1),
(29, 'Dr. Pedro Ruiz', 105, 1),
(30, 'Dr. Marta García', 106, 1),
(31, 'Dr. Javier Castro', 101, 1),
(32, 'Dr. Ana María Rodríguez', 102, 1),
(33, 'Dr. Tomás Ramírez', 103, 1),
(34, 'Dr. Elena Sánchez', 104, 1),
(35, 'Dr. Luis García', 105, 1),
(36, 'Dr. Valeria Morales', 106, 1),
(37, 'Dr. Fernando Ortega', 101, 1),
(38, 'Dr. Clara Gómez', 102, 1),
(39, 'Dr. Mario Martínez', 103, 1),
(40, 'Dr. Isabel Castro', 104, 1),
(41, 'Dr. Felipe López', 105, 1),
(42, 'Dr. Carolina Fernández', 106, 1),
(43, 'Dr. Manuel Gómez', 101, 1),
(44, 'Dr. Susana Pérez', 102, 1),
(45, 'Dr. Ernesto Ruiz', 103, 1),
(46, 'Dr. Gabriela Sánchez', 104, 1),
(47, 'Dr. Arturo Rodríguez', 105, 1),
(48, 'Dr. Laura Jiménez', 106, 0),
(49, 'Dr. Daniel Fernández', 101, 1),
(50, 'Dr. Mariana López', 102, 1),
(1001, 'Dr. Juan Pérez ', 2001, 1),
(1002, 'Dr. Mario Moriconi', 2002, 1),
(1003, 'Dr. Juan Lopes ', 2001, 1),
(1004, 'Dr. Mario Cabrera', 2002, 1),
(1005, 'Dr. Ana Martínez', 2003, 1),
(1006, 'Dr. Luis García', 2004, 1),
(1007, 'Dr. Laura Fernández', 2004, 1),
(1008, 'Dr. Pablo Rodríguez', 2005, 1),
(1014, 'maximo', 0, 1),
(1015, 'maximo', 0, 1),
(1016, 'prueba', 0, 1),
(1017, 'prueba2', 102, 0),
(1018, 'prueba 3', 2005, 1),
(1019, 'prueba 3', 2005, 1),
(1020, 'usuario de prueba 23', 2002, 1),
(1021, 'buty', 104, 1),
(1022, 'prueba123', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enlaces`
--
ALTER TABLE `enlaces`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`codespecialidades`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codespecialidad` (`codespecialidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enlaces`
--
ALTER TABLE `enlaces`
  ADD CONSTRAINT `enlaces_ibfk_1` FOREIGN KEY (`id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD CONSTRAINT `especialidades_ibfk_1` FOREIGN KEY (`codespecialidades`) REFERENCES `medicos` (`codespecialidad`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
