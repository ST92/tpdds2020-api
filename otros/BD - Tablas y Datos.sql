-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2020 at 09:07 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competencia`
--

INSERT INTO `competencia` (`id`, `estado_competencia_id`, `tipo_competencia_id`, `deporte_id`, `tipo_puntuacion_id`, `fixture_id`, `usuario_id`, `nombre`, `reglamento`, `permite_empate`, `ptos_ganado`, `ptos_empate`, `ptos_presentacion`, `ptos_ausencia`, `cantidad_sets`, `fecha_baja`) VALUES
(23, 3, 1, 1, 2, 6, 1, 'CompetenciaPrueba1', NULL, 1, 5, 2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deporte`
--

DROP TABLE IF EXISTS `deporte`;
CREATE TABLE IF NOT EXISTS `deporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deporte`
--

INSERT INTO `deporte` (`id`, `nombre`) VALUES
(1, 'Fútbol'),
(2, 'Basquet'),
(3, 'Tenis'),
(4, 'Rugby');

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
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encuentro`
--

INSERT INTO `encuentro` (`id`, `encuentro_empatado`, `asistencia_participante_1`, `asistencia_participante_2`, `participante1_id`, `participante2_id`, `ganador_id`, `sedes_id`, `ronda_id`, `encuentro_perdedor_id`, `encuentro_ganador_id`) VALUES
(127, 0, 0, 0, 34, 39, 39, 1, 36, NULL, NULL),
(128, 0, 0, 0, 35, 38, 35, 1, 36, NULL, NULL),
(129, 0, 0, 0, 36, 37, NULL, 1, 36, NULL, NULL),
(130, 0, 0, 0, 39, 37, NULL, 1, 37, NULL, NULL),
(131, 0, 0, 0, 38, 36, NULL, 1, 37, NULL, NULL),
(132, 0, 0, 0, 34, 35, NULL, 1, 37, NULL, NULL),
(133, 0, 0, 0, 35, 39, NULL, 1, 38, NULL, NULL),
(134, 0, 0, 0, 36, 34, NULL, 1, 38, NULL, NULL),
(135, 0, 0, 0, 37, 38, NULL, 1, 38, NULL, NULL),
(136, 0, 0, 0, 39, 38, NULL, 1, 39, NULL, NULL),
(137, 0, 0, 0, 34, 37, NULL, 1, 39, NULL, NULL),
(138, 0, 0, 0, 35, 36, NULL, 1, 39, NULL, NULL),
(139, 0, 0, 0, 36, 39, NULL, 1, 40, NULL, NULL),
(140, 0, 0, 0, 37, 35, NULL, 1, 40, NULL, NULL),
(141, 0, 0, 0, 38, 34, NULL, 1, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estadocompetencia`
--

DROP TABLE IF EXISTS `estadocompetencia`;
CREATE TABLE IF NOT EXISTS `estadocompetencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estadocompetencia`
--

INSERT INTO `estadocompetencia` (`id`, `nombre`) VALUES
(1, 'CREADA'),
(2, 'PLANIFICADA'),
(3, 'EN_DISPUTA'),
(4, 'FINALIZADA'),
(5, 'ELIMINADA');

-- --------------------------------------------------------

--
-- Table structure for table `fixture`
--

DROP TABLE IF EXISTS `fixture`;
CREATE TABLE IF NOT EXISTS `fixture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fixture`
--

INSERT INTO `fixture` (`id`) VALUES
(6);

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
  `puntosparticipante1` int(11) NOT NULL,
  `historial_encuentro_id` int(11) NOT NULL,
  `puntosparticipante2` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id`, `competencia_id`, `nombre`, `email`) VALUES
(34, 23, 'Participante1', 'competenciaPrueba1@gmail.com'),
(35, 23, 'Participante2', 'competenciaPrueba2@gmail.com'),
(36, 23, 'Participante3', 'competenciaPrueba3@gmail.com'),
(37, 23, 'Participante4', 'competenciaPrueba4@gmail.com'),
(38, 23, 'Participante5', 'competenciaPrueba5@gmail.com'),
(39, 23, 'Participante6', 'competenciaPrueba6@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resultado`
--

INSERT INTO `resultado` (`id`, `puntos_participante_1`, `puntos_participante_2`, `encuentro_id`) VALUES
(1, 0, 2, 127),
(2, 3, 0, 128),
(3, 0, 0, 129),
(4, 1, 1, 130);

-- --------------------------------------------------------

--
-- Table structure for table `ronda`
--

DROP TABLE IF EXISTS `ronda`;
CREATE TABLE IF NOT EXISTS `ronda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `fixture_id` int(11) NOT NULL,
  `fixture_perdedores_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fixture_fk_2` (`fixture_perdedores_id`),
  KEY `fixture_fk_1` (`fixture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ronda`
--

INSERT INTO `ronda` (`id`, `numero`, `fixture_id`, `fixture_perdedores_id`) VALUES
(36, 0, 6, NULL),
(37, 1, 6, NULL),
(38, 2, 6, NULL),
(39, 3, 6, NULL),
(40, 4, 6, NULL);

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
(1, 1, 1, 'Rafael Osinalde', 'Cancha de Fútbol', NULL),
(2, 1, 2, 'Gregorio Panizza', 'Cancha de Basquet', NULL),
(3, 1, 3, 'Club Talense', 'Cancha de Tenis', NULL),
(4, 1, 4, '2 de Enero', 'Cancha de Fútbol', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sedescompetencia`
--

INSERT INTO `sedescompetencia` (`id`, `competencia_id`, `sedes_id`, `disponibilidad`) VALUES
(63, 23, 1, 15),
(64, 23, 2, 14),
(65, 23, 3, 12);

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
