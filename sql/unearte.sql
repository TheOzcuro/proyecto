-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-03-2022 a las 02:46:00
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unearte`
--
CREATE DATABASE IF NOT EXISTS `unearte` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `unearte`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `cedula` int NOT NULL,
  `contrasena` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`codigo`, `cedula`, `contrasena`) VALUES
(1, 9372683, '152560loco'),
(7, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE IF NOT EXISTS `aula` (
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`codigo`, `nombre`) VALUES
('11', 'SIMON RODRIGUEZ'),
('12', 'artes plastiscas'),
('9000', 'OVER'),
('sexo', 'AJA'),
('aydiosmio', 'PUTAMADRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE IF NOT EXISTS `carrera` (
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`codigo`, `nombre`) VALUES
('1313', 'INGENIERIA ELECTRICA'),
('1414', 'AGRONOMIA'),
('11', 'AY VALE'),
('100', 'SERGIO'),
('90', 'TUMAMA'),
('1000', 'AYDIOSMIO'),
('', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigo`, `nombre`) VALUES
(1, 'Auxiliar Docente I'),
(2, 'Auxiliar Docente II'),
(3, 'Auxiliar Docente III'),
(4, 'Instructor'),
(5, 'Asistente'),
(6, 'Asesor'),
(7, 'Agregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion`
--

DROP TABLE IF EXISTS `dedicacion`;
CREATE TABLE IF NOT EXISTS `dedicacion` (
  `codigo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dedicacion`
--

INSERT INTO `dedicacion` (`codigo`, `nombre`) VALUES
(1, 'Tiempo Convencional'),
(2, 'Medio Tiempo'),
(3, 'Tiempo Completo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lapso_academico`
--

DROP TABLE IF EXISTS `lapso_academico`;
CREATE TABLE IF NOT EXISTS `lapso_academico` (
  `trayecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  PRIMARY KEY (`trayecto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lapso_academico`
--

INSERT INTO `lapso_academico` (`trayecto`, `fecha_inicio`, `fecha_final`) VALUES
('2020-II', '2022-02-19', '2022-03-13'),
('2021-II', '2022-03-02', '2022-03-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`codigo`, `nombre`, `tipo`) VALUES
('83', 'MUSIC', '0'),
('1616', 'ARTE', '1'),
('90', 'MATEMATICA 2', '0'),
('1515', 'DEPORTE', '0'),
('sexo', 'AJA', '0'),
('enshel', 'TEAMO', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

DROP TABLE IF EXISTS `oferta`;
CREATE TABLE IF NOT EXISTS `oferta` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `lapso_academico` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `pnf` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`codigo`, `lapso_academico`, `pnf`) VALUES
(13, '2021-II', '1414'),
(12, '2021-II', '1313'),
(11, '2021-II', '11'),
(14, '2020-II', '1313'),
(15, '2020-II', '1414'),
(16, '2020-II', '11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pensum`
--

DROP TABLE IF EXISTS `pensum`;
CREATE TABLE IF NOT EXISTS `pensum` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `pnf` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `unidad_curricular` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`codigo`, `pnf`, `unidad_curricular`) VALUES
(249, '1414', '1616'),
(250, '1414', '1515'),
(255, '1313', '1616'),
(254, '1313', '83'),
(253, '1313', '90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `cedula` int NOT NULL,
  `rol` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `primer_apellido` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_apellido` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contratacion` int NOT NULL,
  `categoria` int NOT NULL,
  `dedicacion` int NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`cedula`, `rol`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `direccion`, `telefono`, `contratacion`, `categoria`, `dedicacion`) VALUES
(1213132, '0', 'INSER', 'INTO', 'PROFESOR', 'VALUES', 'AYDIOS', '00000000000', 0, 0, 0),
(11716900, '0', 'WILLIREX', 'ALEXI', 'RAMIREZ', 'RIVAS', 'TUCACA 7-27', '04141118100', 0, 0, 0),
(9372683, '1', 'NIRETCIA', 'INMACULADA', 'RAMIREZ', 'VALERO', 'CASA CON PAREDES', '04161309806', 0, 0, 0),
(3, '1', 'CULO', 'AAAANOVALE', 'ALVAREZ', 'TUMAMA', 'DSADASDSADSA', '000000000', 0, 0, 0),
(12121212, '0', 'AAAAVAINA', '', 'HERNANDEZ', '', 'CAMBURITO CALLE 7', '04141118100', 0, 0, 0),
(27460860, '0', 'SERGIO', 'BIENMARICO', 'BLANCO', 'CULO', 'DONDE VIVEN LOS RICOS Y MARIGUANOS Y VAINAS MAS QUE PUTO LA PUTA MADRE', '6969696969', 0, 0, 0),
(29824977, '0', 'MANUEL', '', 'DELGADO', '', 'A DOS CASAS DEL BARRIL DEL CHAVO', '04145555555', 0, 0, 0),
(1515614651, '0', 'DASDASDASDSADASD', '', 'SADSADSADSA', '', 'DSADASDASDASDAS', '1416516516', 2, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcontratacion`
--

DROP TABLE IF EXISTS `tcontratacion`;
CREATE TABLE IF NOT EXISTS `tcontratacion` (
  `codigo` int NOT NULL,
  `tcontratacion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tcontratacion`
--

INSERT INTO `tcontratacion` (`codigo`, `tcontratacion`) VALUES
(1, 'Tiempo Inderteminado'),
(2, 'Tiempo Determinado'),
(3, 'Ordinario');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
