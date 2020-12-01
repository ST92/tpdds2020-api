-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2020 at 03:10 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpdds2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `competencia`
--

DROP TABLE IF EXISTS `competencia`;
CREATE TABLE IF NOT EXISTS `competencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_competencia_id` int(11) NOT NULL,
  `tipo_competencia_id` int(11) NOT NULL,
  `deporte_id` int(11) NOT NULL,
  `tipo_puntuacion_id` int(11) NOT NULL,
  `fixture_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reglamento` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permite_empate` tinyint(1) NOT NULL,
  `ptos_ganado` int(11) DEFAULT NULL,
  `ptos_empate` int(11) DEFAULT NULL,
  `ptos_presentacion` int(11) DEFAULT NULL,
  `ptos_ausencia` int(11) DEFAULT NULL,
  `cantidad_sets` int(11) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_842C498AE524616D` (`fixture_id`),
  KEY `usuario_fk_1` (`usuario_id`),
  KEY `tipo_competencia_fk_1` (`tipo_competencia_id`),
  KEY `tipo_puntuacion_fk_1` (`tipo_puntuacion_id`),
  KEY `fixture_fk_1` (`fixture_id`),
  KEY `estado_competencia_fk_1` (`estado_competencia_id`),
  KEY `deporte_fk_1` (`deporte_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competencia`
--

INSERT INTO `competencia` (`id`, `estado_competencia_id`, `tipo_competencia_id`, `deporte_id`, `tipo_puntuacion_id`, `fixture_id`, `usuario_id`, `nombre`, `reglamento`, `permite_empate`, `ptos_ganado`, `ptos_empate`, `ptos_presentacion`, `ptos_ausencia`, `cantidad_sets`, `fecha_baja`) VALUES
(14, 1, 1, 1, 2, 7, 1, 'Competencia_Liga_Valida_Sets', NULL, 1, 20, 10, 10, NULL, 5, NULL),
(15, 1, 1, 1, 2, NULL, 1, 'Competencia_Liga_Valida_Sets2', NULL, 1, 20, 10, 10, NULL, 5, NULL),
(16, 1, 1, 1, 2, 6, 1, 'Competencia_Liga_Valida_Sets3', NULL, 0, 20, 10, 10, NULL, 5, NULL),
(17, 1, 1, 1, 2, NULL, 1, 'Competencia_Liga_Valida_Sets4', NULL, 0, 20, 10, 10, NULL, 5, NULL),
(18, 1, 1, 1, 2, NULL, 1, 'Competencia_Liga_Valida_Sets44', NULL, 0, 20, NULL, 10, NULL, 5, NULL),
(19, 1, 2, 3, 2, NULL, 1, 'Competencia_EliminacionDoble_Valida', NULL, 0, NULL, NULL, NULL, 15, NULL, NULL),
(20, 1, 2, 3, 2, NULL, 1, 'Competencia_EliminacionDoble_Valida1', NULL, 0, NULL, NULL, NULL, 15, NULL, NULL),
(21, 1, 1, 1, 2, NULL, 1, 'Competencia_Liga_Valida_Sets63', NULL, 1, 20, 10, 10, 15, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deporte`
--

DROP TABLE IF EXISTS `deporte`;
CREATE TABLE IF NOT EXISTS `deporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deporte`
--

INSERT INTO `deporte` (`id`, `nombre`) VALUES
(1, 'football'),
(2, 'basquet'),
(3, 'tenis');

-- --------------------------------------------------------

--
-- Table structure for table `encuentro`
--

DROP TABLE IF EXISTS `encuentro`;
CREATE TABLE IF NOT EXISTS `encuentro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `encuentro_empatado` tinyint(1) NOT NULL,
  `asistencia_participante_1` tinyint(1) NOT NULL,
  `asistencia_participante_2` tinyint(1) NOT NULL,
  `participante1_id` int(11) NOT NULL,
  `participante2_id` int(11) NOT NULL,
  `ganador_id` int(11) DEFAULT NULL,
  `sedes_id` int(11) NOT NULL,
  `ronda_id` int(11) NOT NULL,
  `encuentro_perdedor_id` int(11) DEFAULT NULL,
  `encuentro_ganador_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CDFA77FA48D8D82A` (`encuentro_perdedor_id`),
  UNIQUE KEY `UNIQ_CDFA77FA5DF18436` (`encuentro_ganador_id`),
  KEY `participante_fk_2` (`participante2_id`),
  KEY `sedes_fk_1` (`sedes_id`),
  KEY `encuentro_fk_1` (`encuentro_perdedor_id`),
  KEY `encuentro_fk_2` (`encuentro_ganador_id`),
  KEY `participante_fk_1` (`participante1_id`),
  KEY `participante_fk_3` (`ganador_id`),
  KEY `ronda_fk_1` (`ronda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encuentro`
--

INSERT INTO `encuentro` (`id`, `encuentro_empatado`, `asistencia_participante_1`, `asistencia_participante_2`, `participante1_id`, `participante2_id`, `ganador_id`, `sedes_id`, `ronda_id`, `encuentro_perdedor_id`, `encuentro_ganador_id`) VALUES
(106, 0, 0, 0, 2, 7, NULL, 1, 29, NULL, NULL),
(107, 0, 0, 0, 3, 6, NULL, 1, 29, NULL, NULL),
(108, 0, 0, 0, 4, 5, NULL, 1, 29, NULL, NULL),
(109, 0, 0, 0, 6, 4, NULL, 1, 30, NULL, NULL),
(110, 0, 0, 0, 7, 3, NULL, 1, 30, NULL, NULL),
(111, 0, 0, 0, 1, 2, NULL, 1, 30, NULL, NULL),
(112, 0, 0, 0, 3, 1, NULL, 1, 31, NULL, NULL),
(113, 0, 0, 0, 4, 7, NULL, 1, 31, NULL, NULL),
(114, 0, 0, 0, 5, 6, NULL, 1, 31, NULL, NULL),
(115, 0, 0, 0, 7, 5, NULL, 1, 32, NULL, NULL),
(116, 0, 0, 0, 1, 4, NULL, 1, 32, NULL, NULL),
(117, 0, 0, 0, 2, 3, NULL, 1, 32, NULL, NULL),
(118, 0, 0, 0, 4, 2, NULL, 1, 33, NULL, NULL),
(119, 0, 0, 0, 5, 1, NULL, 1, 33, NULL, NULL),
(120, 0, 0, 0, 6, 7, NULL, 1, 33, NULL, NULL),
(121, 0, 0, 0, 1, 6, NULL, 2, 34, NULL, NULL),
(122, 0, 0, 0, 2, 5, NULL, 2, 34, NULL, NULL),
(123, 0, 0, 0, 3, 4, NULL, 2, 34, NULL, NULL),
(124, 0, 0, 0, 5, 3, NULL, 2, 35, NULL, NULL),
(125, 0, 0, 0, 6, 2, NULL, 2, 35, NULL, NULL),
(126, 0, 0, 0, 7, 1, NULL, 3, 35, NULL, NULL),
(127, 0, 0, 0, 24, 25, NULL, 1, 36, NULL, NULL),
(128, 0, 0, 0, 2, 7, NULL, 1, 37, NULL, NULL),
(129, 0, 0, 0, 3, 6, NULL, 1, 37, NULL, NULL),
(130, 0, 0, 0, 4, 5, NULL, 1, 37, NULL, NULL),
(131, 0, 0, 0, 6, 4, NULL, 1, 38, NULL, NULL),
(132, 0, 0, 0, 7, 3, NULL, 1, 38, NULL, NULL),
(133, 0, 0, 0, 1, 2, NULL, 1, 38, NULL, NULL),
(134, 0, 0, 0, 3, 1, NULL, 1, 39, NULL, NULL),
(135, 0, 0, 0, 4, 7, NULL, 1, 39, NULL, NULL),
(136, 0, 0, 0, 5, 6, NULL, 1, 39, NULL, NULL),
(137, 0, 0, 0, 7, 5, NULL, 1, 40, NULL, NULL),
(138, 0, 0, 0, 1, 4, NULL, 1, 40, NULL, NULL),
(139, 0, 0, 0, 2, 3, NULL, 1, 40, NULL, NULL),
(140, 0, 0, 0, 4, 2, NULL, 1, 41, NULL, NULL),
(141, 0, 0, 0, 5, 1, NULL, 1, 41, NULL, NULL),
(142, 0, 0, 0, 6, 7, NULL, 1, 41, NULL, NULL),
(143, 0, 0, 0, 1, 6, NULL, 2, 42, NULL, NULL),
(144, 0, 0, 0, 2, 5, NULL, 2, 42, NULL, NULL),
(145, 0, 0, 0, 3, 4, NULL, 2, 42, NULL, NULL),
(146, 0, 0, 0, 5, 3, NULL, 2, 43, NULL, NULL),
(147, 0, 0, 0, 6, 2, NULL, 2, 43, NULL, NULL),
(148, 0, 0, 0, 7, 1, NULL, 3, 43, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estadocompetencia`
--

DROP TABLE IF EXISTS `estadocompetencia`;
CREATE TABLE IF NOT EXISTS `estadocompetencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estadocompetencia`
--

INSERT INTO `estadocompetencia` (`id`, `nombre`) VALUES
(1, 'CREADA');

-- --------------------------------------------------------

--
-- Table structure for table `fixture`
--

DROP TABLE IF EXISTS `fixture`;
CREATE TABLE IF NOT EXISTS `fixture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fixture`
--

INSERT INTO `fixture` (`id`) VALUES
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `historialencuentro`
--

DROP TABLE IF EXISTS `historialencuentro`;
CREATE TABLE IF NOT EXISTS `historialencuentro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ganador_id` int(11) DEFAULT NULL,
  `encuentro_id` int(11) NOT NULL,
  `fecha_historial` date NOT NULL,
  `encuentro_empatado` tinyint(1) NOT NULL,
  `asistencia_participante_1` tinyint(1) NOT NULL,
  `asistencia_participante_2` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3B34A83DA338CEA5` (`ganador_id`),
  KEY `IDX_3B34A83DE304C7C8` (`encuentro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historialresultado`
--

DROP TABLE IF EXISTS `historialresultado`;
CREATE TABLE IF NOT EXISTS `historialresultado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puntosparticipante1` date NOT NULL,
  `historial_encuentro_id` int(11) NOT NULL,
  `puntosparticipante2` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDE006DBD5B7AC3A` (`historial_encuentro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localidad`
--

DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `provincia_fk_1` (`provincia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localidad`
--

INSERT INTO `localidad` (`id`, `nombre`, `provincia_id`) VALUES
(130, 'Rosario del Tala', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Argentina');

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

DROP TABLE IF EXISTS `participante`;
CREATE TABLE IF NOT EXISTS `participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `competencia_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competencia_fk_1` (`competencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id`, `competencia_id`, `nombre`, `email`) VALUES
(1, 14, 'Participante1', 'email@email'),
(2, 14, 'Participante12', 'email@email2'),
(3, 14, 'Participante2', 'email2@email2'),
(4, 14, 'Participante3', 'email3@email'),
(5, 14, 'Participante4', 'email4@email'),
(6, 14, 'Participante5', 'email5@email'),
(7, 14, 'Participante6', 'email6@email'),
(8, 15, 'Participante8', 'email8@email'),
(24, 16, 'Par', '_21emal_11@emailom.com'),
(25, 16, 'Part', '21emal_11@emailom.com'),
(26, 17, 'Parti', '21emal_11@emailo.mcom'),
(27, 17, 'Partic', 'emal_11@emailo.mcom'),
(28, 17, 'Partici', '_emal_11@emailo.frsr.mcom');

-- --------------------------------------------------------

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pais_fk_1` (`pais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`, `pais_id`) VALUES
(3, 'Entre Ríos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resultado`
--

DROP TABLE IF EXISTS `resultado`;
CREATE TABLE IF NOT EXISTS `resultado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puntos_participante_1` int(11) NOT NULL,
  `puntos_participante_2` int(11) NOT NULL,
  `encuentro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B2ED91CE304C7C8` (`encuentro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resultado`
--

INSERT INTO `resultado` (`id`, `puntos_participante_1`, `puntos_participante_2`, `encuentro_id`) VALUES
(1, 0, 2, 106),
(2, 0, 2, 107),
(3, 0, 2, 108);

-- --------------------------------------------------------

--
-- Table structure for table `ronda`
--

DROP TABLE IF EXISTS `ronda`;
CREATE TABLE IF NOT EXISTS `ronda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `fixture_id` int(11) NOT NULL,
  `fixture_perdedores_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fixture_fk_2` (`fixture_perdedores_id`),
  KEY `fixture_fk_1` (`fixture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ronda`
--

INSERT INTO `ronda` (`id`, `numero`, `fecha`, `fixture_id`, `fixture_perdedores_id`) VALUES
(29, 0, NULL, 5, NULL),
(30, 1, NULL, 5, NULL),
(31, 2, NULL, 5, NULL),
(32, 3, NULL, 5, NULL),
(33, 4, NULL, 5, NULL),
(34, 5, NULL, 5, NULL),
(35, 6, NULL, 5, NULL),
(36, 0, NULL, 6, NULL),
(37, 0, NULL, 7, NULL),
(38, 1, NULL, 7, NULL),
(39, 2, NULL, 7, NULL),
(40, 3, NULL, 7, NULL),
(41, 4, NULL, 7, NULL),
(42, 5, NULL, 7, NULL),
(43, 6, NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sedes`
--

DROP TABLE IF EXISTS `sedes`;
CREATE TABLE IF NOT EXISTS `sedes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_borrado` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_fk_2` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sedes`
--

INSERT INTO `sedes` (`id`, `usuario_id`, `codigo`, `nombre`, `descripcion`, `fecha_borrado`) VALUES
(1, 1, 1, 'Rafael Osinalde', 'Cancha de futball', NULL),
(2, 1, 2, 'Gregorio Panizza', 'Cancha de basquet', NULL),
(3, 1, 3, 'Club Talense', 'Cancha de tenis', NULL),
(4, 1, 4, '2 de Enero', 'Cancha de futball', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sedescompetencia`
--

DROP TABLE IF EXISTS `sedescompetencia`;
CREATE TABLE IF NOT EXISTS `sedescompetencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `competencia_id` int(11) NOT NULL,
  `sedes_id` int(11) NOT NULL,
  `disponibilidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sedes_fk_2` (`sedes_id`),
  KEY `competencia_fk_2` (`competencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sedescompetencia`
--

INSERT INTO `sedescompetencia` (`id`, `competencia_id`, `sedes_id`, `disponibilidad`) VALUES
(40, 14, 1, 15),
(41, 14, 2, 5),
(42, 14, 3, 8),
(43, 15, 1, 5),
(44, 15, 2, 4),
(45, 15, 3, 2),
(46, 16, 1, 5),
(47, 16, 2, 4),
(48, 16, 3, 2),
(49, 17, 1, 5),
(50, 17, 2, 4),
(51, 17, 3, 2),
(52, 18, 1, 5),
(53, 18, 2, 4),
(54, 18, 3, 2),
(55, 19, 2, 10),
(56, 20, 2, 10),
(57, 21, 1, 5),
(58, 21, 2, 4),
(59, 21, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sedesdeporte`
--

DROP TABLE IF EXISTS `sedesdeporte`;
CREATE TABLE IF NOT EXISTS `sedesdeporte` (
  `sedes_id` int(11) NOT NULL,
  `deporte_id` int(11) NOT NULL,
  PRIMARY KEY (`sedes_id`,`deporte_id`),
  KEY `IDX_790C3D1DBC4E8C79` (`sedes_id`),
  KEY `IDX_790C3D1D239C54DD` (`deporte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sedesdeporte`
--

INSERT INTO `sedesdeporte` (`sedes_id`, `deporte_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipocompetencia`
--

DROP TABLE IF EXISTS `tipocompetencia`;
CREATE TABLE IF NOT EXISTS `tipocompetencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipocompetencia`
--

INSERT INTO `tipocompetencia` (`id`, `nombre`) VALUES
(1, 'LIGA'),
(2, 'ELIMINACION_SIMPLE'),
(3, 'ELIMINACION_DOBLE');

-- --------------------------------------------------------

--
-- Table structure for table `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `nombre`) VALUES
(1, 'DNI');

-- --------------------------------------------------------

--
-- Table structure for table `tipopuntuacion`
--

DROP TABLE IF EXISTS `tipopuntuacion`;
CREATE TABLE IF NOT EXISTS `tipopuntuacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipopuntuacion`
--

INSERT INTO `tipopuntuacion` (`id`, `nombre`) VALUES
(1, 'SETS'),
(2, 'PUNTUACION'),
(3, 'RESULTADO_FINAL');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `confirmacion_terminos` tinyint(1) NOT NULL,
  `localidad_id` int(11) NOT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_documento_fk_1` (`tipo_documento_id`),
  KEY `localidad_fk_2` (`localidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `password`, `documento`, `confirmacion_terminos`, `localidad_id`, `tipo_documento_id`) VALUES
(1, 'Armando Esteban', 'Quito', 'aquito@gmail.com', 'constraseña', 38983478, 1, 130, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competencia`
--
ALTER TABLE `competencia`
  ADD CONSTRAINT `FK_842C498A15530CED` FOREIGN KEY (`tipo_competencia_id`) REFERENCES `tipocompetencia` (`id`),
  ADD CONSTRAINT `FK_842C498A239C54DD` FOREIGN KEY (`deporte_id`) REFERENCES `deporte` (`id`),
  ADD CONSTRAINT `FK_842C498A7336E949` FOREIGN KEY (`estado_competencia_id`) REFERENCES `estadocompetencia` (`id`),
  ADD CONSTRAINT `FK_842C498A9E9155BB` FOREIGN KEY (`tipo_puntuacion_id`) REFERENCES `tipopuntuacion` (`id`),
  ADD CONSTRAINT `FK_842C498ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_842C498AE524616D` FOREIGN KEY (`fixture_id`) REFERENCES `fixture` (`id`);

--
-- Constraints for table `encuentro`
--
ALTER TABLE `encuentro`
  ADD CONSTRAINT `FK_CDFA77FA48D8D82A` FOREIGN KEY (`encuentro_perdedor_id`) REFERENCES `encuentro` (`id`),
  ADD CONSTRAINT `FK_CDFA77FA5DF18436` FOREIGN KEY (`encuentro_ganador_id`) REFERENCES `encuentro` (`id`),
  ADD CONSTRAINT `FK_CDFA77FAA338CEA5` FOREIGN KEY (`ganador_id`) REFERENCES `participante` (`id`),
  ADD CONSTRAINT `FK_CDFA77FAB27F466B` FOREIGN KEY (`ronda_id`) REFERENCES `ronda` (`id`),
  ADD CONSTRAINT `FK_CDFA77FABC4E8C79` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `FK_CDFA77FACFF6EEE3` FOREIGN KEY (`participante1_id`) REFERENCES `participante` (`id`),
  ADD CONSTRAINT `FK_CDFA77FADD43410D` FOREIGN KEY (`participante2_id`) REFERENCES `participante` (`id`);

--
-- Constraints for table `historialencuentro`
--
ALTER TABLE `historialencuentro`
  ADD CONSTRAINT `FK_3B34A83DA338CEA5` FOREIGN KEY (`ganador_id`) REFERENCES `participante` (`id`),
  ADD CONSTRAINT `FK_3B34A83DE304C7C8` FOREIGN KEY (`encuentro_id`) REFERENCES `participante` (`id`);

--
-- Constraints for table `historialresultado`
--
ALTER TABLE `historialresultado`
  ADD CONSTRAINT `FK_FDE006DBD5B7AC3A` FOREIGN KEY (`historial_encuentro_id`) REFERENCES `historialencuentro` (`id`);

--
-- Constraints for table `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `FK_4F68E0104E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `FK_85BDC5C39980C34D` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`);

--
-- Constraints for table `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `FK_D39AF213C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

--
-- Constraints for table `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `FK_B2ED91CE304C7C8` FOREIGN KEY (`encuentro_id`) REFERENCES `encuentro` (`id`);

--
-- Constraints for table `ronda`
--
ALTER TABLE `ronda`
  ADD CONSTRAINT `FK_5F18BAA0C4A34353` FOREIGN KEY (`fixture_perdedores_id`) REFERENCES `fixture` (`id`),
  ADD CONSTRAINT `FK_5F18BAA0E524616D` FOREIGN KEY (`fixture_id`) REFERENCES `fixture` (`id`);

--
-- Constraints for table `sedes`
--
ALTER TABLE `sedes`
  ADD CONSTRAINT `FK_EAF0B6ABDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `sedescompetencia`
--
ALTER TABLE `sedescompetencia`
  ADD CONSTRAINT `FK_517E75CB9980C34D` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`),
  ADD CONSTRAINT `FK_517E75CBBC4E8C79` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`);

--
-- Constraints for table `sedesdeporte`
--
ALTER TABLE `sedesdeporte`
  ADD CONSTRAINT `FK_790C3D1D239C54DD` FOREIGN KEY (`deporte_id`) REFERENCES `deporte` (`id`),
  ADD CONSTRAINT `FK_790C3D1DBC4E8C79` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D67707C89` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`),
  ADD CONSTRAINT `FK_2265B05DF6939175` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipodocumento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
