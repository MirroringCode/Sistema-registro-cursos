-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2021 at 03:59 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prep_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id_area`, `area`) VALUES
(1, 'informática'),
(2, 'diseño'),
(3, 'finanzas');

-- --------------------------------------------------------

--
-- Table structure for table `credenciales_prof`
--

DROP TABLE IF EXISTS `credenciales_prof`;
CREATE TABLE IF NOT EXISTS `credenciales_prof` (
  `id_cred` int(11) NOT NULL AUTO_INCREMENT,
  `credencial` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_cred`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credenciales_prof`
--

INSERT INTO `credenciales_prof` (`id_cred`, `credencial`) VALUES
(1, 'Licenciatura'),
(2, 'Maestría'),
(3, 'Doctorado');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(3) NOT NULL AUTO_INCREMENT,
  `nombre_curso` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dificultad` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_area` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ci_profesor` int(11) NOT NULL,
  `id_modalidad` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `fk_area` (`id_area`),
  KEY `fk_prof` (`ci_profesor`),
  KEY `fk_horario` (`id_horario`),
  KEY `fk_modalidad` (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre_curso`, `descripcion`, `dificultad`, `id_area`, `fecha`, `imagen`, `ci_profesor`, `id_modalidad`, `id_horario`) VALUES
(4, 'Curso programación linux', 'Bienvenido al curso programación linux', 'principiantes', 1, '2021-09-28', 'cursos-prog.jpg', 26009, 1, 3),
(5, 'Curso base de datos', 'This', 'principiantes', 3, '2021-09-08', 'it-courses.jpg', 9009, 1, 2),
(6, 'Desarrollo movil con kotlin', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\\r\\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\\r\\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\\r\\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\\r\\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\\r\\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'principiantes', 1, '2021-09-28', 'games-course.jpg', 9009, 1, 1),
(32, 'Curso principal dos', 'Curso de principal dx', 'intermedio', 3, '2021-10-19', '1631478876289.png', 199245, 2, 2),
(34, 'Curso diseñador javascript', 'Curso javascript para profesionales, únete ya, no te lo pierdas.', 'avanzado', 1, '2021-10-26', 'javascript.png', 6890, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `horario_curso`
--

DROP TABLE IF EXISTS `horario_curso`;
CREATE TABLE IF NOT EXISTS `horario_curso` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `horario` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `horario_curso`
--

INSERT INTO `horario_curso` (`id_horario`, `horario`) VALUES
(1, 'mañana'),
(2, 'tarde'),
(3, 'noche');

-- --------------------------------------------------------

--
-- Table structure for table `materiales_y_curso`
--

DROP TABLE IF EXISTS `materiales_y_curso`;
CREATE TABLE IF NOT EXISTS `materiales_y_curso` (
  `id_mc` int(11) NOT NULL AUTO_INCREMENT,
  `id_materiales` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_mc`),
  KEY `fk_curso` (`id_curso`),
  KEY `fk_materiales` (`id_materiales`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materiales_y_curso`
--

INSERT INTO `materiales_y_curso` (`id_mc`, `id_materiales`, `id_curso`) VALUES
(1, 7, 6),
(3, 2, 5),
(4, 7, 5),
(5, 5, 5),
(7, 9, 6),
(8, 8, 4),
(9, 6, 4),
(10, 9, 4),
(11, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `material_curso`
--

DROP TABLE IF EXISTS `material_curso`;
CREATE TABLE IF NOT EXISTS `material_curso` (
  `id_materiales` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoría` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_materiales`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_curso`
--

INSERT INTO `material_curso` (`id_materiales`, `nombre`, `categoría`, `tipo`) VALUES
(2, 'PostgreSQL', 'Software', 'Administrador de base de datos'),
(5, 'sublime text', 'software', 'editor de texto'),
(6, 'Gitbasher', 'software', 'commandline'),
(7, 'CPUPC', 'hardware', 'Computadora'),
(8, 'Desygner 2', 'software', 'Herramienta de diseño'),
(9, 'Visual studio code', 'software', 'Editor de código'),
(10, 'Material chevere', 'software', 'Herramienta random');

-- --------------------------------------------------------

--
-- Table structure for table `modalidad_curso`
--

DROP TABLE IF EXISTS `modalidad_curso`;
CREATE TABLE IF NOT EXISTS `modalidad_curso` (
  `id_modalidad` int(11) NOT NULL AUTO_INCREMENT,
  `modalidad` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'mañana',
  PRIMARY KEY (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modalidad_curso`
--

INSERT INTO `modalidad_curso` (`id_modalidad`, `modalidad`) VALUES
(1, 'presencial'),
(2, 'en línea'),
(3, 'mixto');

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `ci_profesor` int(11) NOT NULL,
  `nombre_profesor` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellido_profesor` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_cred` int(11) NOT NULL,
  PRIMARY KEY (`ci_profesor`),
  KEY `fk_cred` (`id_cred`),
  KEY `foreign_area` (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`ci_profesor`, `nombre_profesor`, `apellido_profesor`, `id_area`, `id_cred`) VALUES
(177, 'Pablo', 'Medina', 1, 1),
(941, 'Angel', 'Goméz', 2, 1),
(6890, 'Sirio', 'Gomes', 3, 3),
(9009, 'Miguel', 'Simmons', 1, 2),
(26009, 'Santiago', 'Uribe', 1, 3),
(87423, 'Carlos', 'Gomez', 2, 2),
(199245, 'Sara', 'Hurtado', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ci_usuario` int(11) NOT NULL,
  `primer_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'estudiante',
  PRIMARY KEY (`ci_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ci_usuario`, `primer_nombre`, `apellido`, `usuario`, `email`, `contrasena`, `rol`) VALUES
(183, 'Carlos', 'Zambrano', 'Carlitos', 'carlos@hotmail.com', '$2y$10$HZvt9xe8rrrQrMVcYUbJee4pNgo9dOZlQGQxwEpohoFDDtca3xDza', 'estudiante'),
(72564, 'Sandrá', 'Oñoa', 'Sandritá', 'sandra@gmail.com', '$2y$10$YtEHZKXaOCehOXQ.GJ3gvuaYzoYfO9XxcEgz6yDPRPUY9BwiIa6ra', 'estudiante'),
(74529, 'Anna', 'Torres', 'Annita02', 'anna@hotmail.com', '$2y$10$9l8tA5bcyzmXlOkNbLpez.8zq0C4wLv0gWfqRwRgVOceABSDhTjuS', 'estudiante'),
(99734, 'Miguel', 'David', 'miquios', 'miguel@hotmail.com', '$2y$10$MdCWVpyuBIRBLbkYQK7CwOmKtO8NHc8dGuDTAzWsLzTFJRdPE6v76', 'admin'),
(4827750, 'Diana', 'Castillo', 'Diana', 'diana@hotmail.es', '$2y$10$my3QZNGzf5UCmAHdyaGZIeDhaWfY2JLkstkMcbYYDqyIWYmQgoISG', 'estudiante');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_y_curso`
--

DROP TABLE IF EXISTS `usuario_y_curso`;
CREATE TABLE IF NOT EXISTS `usuario_y_curso` (
  `id_uc` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL,
  `ci_usuario` int(11) NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 DEFAULT 'En progreso',
  PRIMARY KEY (`id_uc`),
  KEY `frk_curso` (`id_curso`),
  KEY `frk_usuario` (`ci_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario_y_curso`
--

INSERT INTO `usuario_y_curso` (`id_uc`, `id_curso`, `ci_usuario`, `estado`) VALUES
(6, 5, 4827750, 'En progreso'),
(8, 34, 72564, 'En progreso'),
(23, 4, 4827750, 'Completado'),
(24, 6, 4827750, 'En progreso'),
(25, 4, 74529, 'En progreso'),
(26, 5, 74529, 'En progreso');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_area` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_horario` FOREIGN KEY (`id_horario`) REFERENCES `horario_curso` (`id_horario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modalidad` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidad_curso` (`id_modalidad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prof` FOREIGN KEY (`ci_profesor`) REFERENCES `profesor` (`ci_profesor`) ON UPDATE CASCADE;

--
-- Constraints for table `materiales_y_curso`
--
ALTER TABLE `materiales_y_curso`
  ADD CONSTRAINT `fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_materiales` FOREIGN KEY (`id_materiales`) REFERENCES `material_curso` (`id_materiales`) ON UPDATE CASCADE;

--
-- Constraints for table `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_cred` FOREIGN KEY (`id_cred`) REFERENCES `credenciales_prof` (`id_cred`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_area` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON UPDATE CASCADE;

--
-- Constraints for table `usuario_y_curso`
--
ALTER TABLE `usuario_y_curso`
  ADD CONSTRAINT `frk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_usuario` FOREIGN KEY (`ci_usuario`) REFERENCES `usuarios` (`ci_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
