-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-10-2020 a las 18:04:22
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_dds`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

DROP TABLE IF EXISTS `competencia`;
CREATE TABLE IF NOT EXISTS `competencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `reglamento` varchar(1000) DEFAULT NULL,
  `permite_empate` tinyint(1) DEFAULT NULL,
  `ptos_ganado` int(11) DEFAULT NULL,
  `ptos_empate` int(11) DEFAULT NULL,
  `ptos_presentacion` int(11) DEFAULT NULL,
  `ptos_ausencia` int(11) DEFAULT NULL,
  `cantidad_sets` int(11) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `estado_competencia_id` int(11) NOT NULL,
  `tipo_competencia_id` int(11) NOT NULL,
  `deporte_id` int(11) NOT NULL,
  `tipo_puntuacion_id` int(11) NOT NULL,
  `fixture_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_unico` (`nombre`),
  KEY `estado_competencia_fk_1` (`estado_competencia_id`),
  KEY `tipo_competencia_fk_1` (`tipo_competencia_id`),
  KEY `deporte_fk_1` (`deporte_id`),
  KEY `tipo_puntuacion_fk_1` (`tipo_puntuacion_id`),
  KEY `fixture_fk_1` (`fixture_id`),
  KEY `usuario_fk_1` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

DROP TABLE IF EXISTS `deporte`;
CREATE TABLE IF NOT EXISTS `deporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuentro`
--

DROP TABLE IF EXISTS `encuentro`;
CREATE TABLE IF NOT EXISTS `encuentro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `encuentro_empatado` tinyint(1) NOT NULL,
  `asistencia_participante_1` tinyint(1) NOT NULL,
  `asistencia_participante_2` tinyint(1) NOT NULL,
  `participante1_id` int(11) NOT NULL,
  `participante2_id` int(11) NOT NULL,
  `ganador_id` int(11) NOT NULL,
  `sedes_id` int(11) NOT NULL,
  `ronda_id` int(11) NOT NULL,
  `encuentro_perdedor_id` int(11) NOT NULL,
  `encuentro_ganador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `participante_fk_1` (`participante1_id`),
  KEY `participante_fk_2` (`participante2_id`),
  KEY `participante_fk_3` (`ganador_id`),
  KEY `sedes_fk_1` (`sedes_id`),
  KEY `ronda_fk_1` (`ronda_id`),
  KEY `encuentro_fk_1` (`encuentro_perdedor_id`),
  KEY `encuentro_fk_2` (`encuentro_ganador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocompetencia`
--

DROP TABLE IF EXISTS `estadocompetencia`;
CREATE TABLE IF NOT EXISTS `estadocompetencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fixture`
--

DROP TABLE IF EXISTS `fixture`;
CREATE TABLE IF NOT EXISTS `fixture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialresultado`
--

DROP TABLE IF EXISTS `historialresultado`;
CREATE TABLE IF NOT EXISTS `historialresultado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_historial` date NOT NULL,
  `puntos_participante_1` int(11) NOT NULL,
  `puntos_participante_2` int(11) NOT NULL,
  `encuentro_empatado` tinyint(1) NOT NULL,
  `asistencia_participante_1` tinyint(1) NOT NULL,
  `asistencia_participante_2` tinyint(1) NOT NULL,
  `ganador_id` int(11) NOT NULL,
  `encuentro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `provincia_fk_1` (`provincia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

DROP TABLE IF EXISTS `participante`;
CREATE TABLE IF NOT EXISTS `participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `competencia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competencia_fk_1` (`competencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `pais_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pais_fk_1` (`pais_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

DROP TABLE IF EXISTS `resultado`;
CREATE TABLE IF NOT EXISTS `resultado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puntos_participante_1` int(11) NOT NULL,
  `puntos_participante_2` int(11) NOT NULL,
  `encuentro_id` int(11) NOT NULL,
  `historial_resultado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ronda`
--

DROP TABLE IF EXISTS `ronda`;
CREATE TABLE IF NOT EXISTS `ronda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fixture_id` int(11) NOT NULL,
  `fixture_perdedores_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fixture_fk_1` (`fixture_id`),
  KEY `fixture_fk_2` (`fixture_perdedores_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

DROP TABLE IF EXISTS `sedes`;
CREATE TABLE IF NOT EXISTS `sedes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_borrado` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_fk_2` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedescompetencia`
--

DROP TABLE IF EXISTS `sedescompetencia`;
CREATE TABLE IF NOT EXISTS `sedescompetencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disponibilidad` int(11) NOT NULL,
  `competencia_id` int(11) NOT NULL,
  `sedes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competencia_fk_2` (`competencia_id`),
  KEY `sedes_fk_2` (`sedes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedesdeporte`
--

DROP TABLE IF EXISTS `sedesdeporte`;
CREATE TABLE IF NOT EXISTS `sedesdeporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deporte_id` int(11) NOT NULL,
  `sedes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deporte_fk_2` (`deporte_id`),
  KEY `sedes_fk_3` (`sedes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocompetencia`
--

DROP TABLE IF EXISTS `tipocompetencia`;
CREATE TABLE IF NOT EXISTS `tipocompetencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopuntuacion`
--

DROP TABLE IF EXISTS `tipopuntuacion`;
CREATE TABLE IF NOT EXISTS `tipopuntuacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `documento` int(11) NOT NULL,
  `confirmacion_terminos` tinyint(1) NOT NULL,
  `localidad_id` int(11) NOT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `localidad_fk_2` (`localidad_id`),
  KEY `tipo_documento_fk_1` (`tipo_documento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
