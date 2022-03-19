-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-03-2022 a las 02:24:52
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`codigo`, `cedula`, `contrasena`) VALUES
(1, 9372683, '152560loco');

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
('14564165', 'SIMON RODRIGUEZ'),
('914914d', 'FRANCISCO DE MIRANDA'),
('9009', 'FLOR ESPIRITUAL'),
('91303', 'ARAGUANEY');

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
('2121', 'INGENIERIA EN AZUCAR'),
('1515', 'DANSA'),
('102', 'ARTES PLASTICAS'),
('70', 'PROGRAMACION');

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
('90', '2022-02-19', '2022-03-13'),
('1100', '2022-03-13', '2022-03-16'),
('9000', '2022-03-13', '2022-03-14');

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
('100', 'EJECUCION INSTRUMENTAL', '0'),
('4564', 'MATEMATICA 2', '0'),
('900', 'CANTO Y REPERTORIO', '0'),
('903', 'MUSICA LATINOAMAERICA', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`codigo`, `lapso_academico`, `pnf`) VALUES
(46, '1100', '2121');

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
) ENGINE=MyISAM AUTO_INCREMENT=288 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`codigo`, `pnf`, `unidad_curricular`) VALUES
(287, '2121', '4564');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `cedula` int NOT NULL,
  `primer_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `primer_apellido` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_apellido` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contratacion` int NOT NULL,
  `categoria` int NOT NULL,
  `dedicacion` int NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono_fijo` char(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `oficio` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`cedula`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `contratacion`, `categoria`, `dedicacion`, `direccion`, `telefono`, `telefono_fijo`, `correo`, `titulo`, `oficio`, `rol`) VALUES
(9372683, 'NIRETCIA', 'INMACULADA', 'RAMIREZ', 'VALERO', 3, 5, 1, 'CAMBURITO', '04147965415', '02556659105', 'perro@gmail.com', 'BACHILLER', 'MUSICO', '1'),
(11716900, 'JONATHAN', 'SEXO', 'RAMIREZ', '', 2, 3, 3, 'URB CAMBURITO, CALLE 7, CASA 7-24', '04167577138', '0255669105', 'jonathan@gmail.com', 'MASTER EN SEXO', 'PLANIFICADOR DE ORGIAS', '0'),
(27414575, 'MARTIN', 'PEREZ', 'ROJAS', 'PASTOR', 1, 6, 2, 'EN LAS PALMAS', '04125719342', '02314242113', 'sexo@gmail.com', 'ESCUELA PRIMARIA', 'DAR MAMADAS', '0');

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
