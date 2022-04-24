-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-04-2022 a las 21:23:17
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`codigo`, `cedula`, `contrasena`) VALUES
(1, 9372683, '152560loco'),
(9, 16541564, '');

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
('2023', 'FRANCISCO DE MIRANDA'),
('9009', 'FLOR ESPIRITUAL'),
('91303', 'ARAGUANEY'),
('4654165', 'GGGGG'),
('7', 'AULA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_disponibilidad`
--

DROP TABLE IF EXISTS `bloque_disponibilidad`;
CREATE TABLE IF NOT EXISTS `bloque_disponibilidad` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `cedula` bigint NOT NULL,
  `bloque` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `dia` int NOT NULL,
  `disponibilidad` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=1076 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bloque_disponibilidad`
--

INSERT INTO `bloque_disponibilidad` (`codigo`, `cedula`, `bloque`, `dia`, `disponibilidad`) VALUES
(846, 11716900, 'B3', 2, 1),
(845, 11716900, 'B2', 2, 1),
(844, 11716900, 'B1', 2, 1),
(1060, 27414575, 'B3', 1, 1),
(843, 11716900, 'B4', 1, 1),
(842, 11716900, 'B3', 1, 1),
(841, 11716900, 'B2', 1, 1),
(840, 11716900, 'B1', 1, 1),
(1059, 27414575, 'B2', 1, 1),
(1058, 27414575, 'B1', 1, 1),
(1061, 27414575, 'B4', 1, 1),
(1074, 9372683, 'B4', 5, 1),
(1073, 9372683, 'B3', 5, 1),
(1072, 9372683, 'B2', 5, 1),
(1071, 9372683, 'B1', 5, 1),
(1070, 9372683, 'B6', 1, 1),
(1069, 9372683, 'B5', 1, 1),
(1068, 9372683, 'B4', 1, 1),
(1067, 9372683, 'B3', 1, 1),
(1066, 9372683, 'B2', 1, 1),
(1065, 9372683, 'B1', 1, 1),
(1062, 27414575, 'B1', 5, 1),
(1063, 27414575, 'B2', 5, 1),
(1064, 27414575, 'B3', 5, 1),
(1075, 9372683, 'B5', 5, 1);

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
('1616', 'DANZA'),
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
(7, 'Agregado'),
(8, 'Asociado'),
(9, 'Titular');

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
(3, 'Tiempo Completo'),
(4, 'Tiempo Exclusivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_semana`
--

DROP TABLE IF EXISTS `dias_semana`;
CREATE TABLE IF NOT EXISTS `dias_semana` (
  `codigo` int NOT NULL,
  `dias` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dias_semana`
--

INSERT INTO `dias_semana` (`codigo`, `dias`) VALUES
(5, 'VIERNES'),
(4, 'JUEVES'),
(3, 'MIERCOLES'),
(2, 'MARTES'),
(1, 'LUNES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_docente`
--

DROP TABLE IF EXISTS `horario_docente`;
CREATE TABLE IF NOT EXISTS `horario_docente` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `cedula_docente` bigint NOT NULL,
  `codigo_aula` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `lapso_academico` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `bloque` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `unidad_curricular` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `carrera` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `dia` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horario_docente`
--

INSERT INTO `horario_docente` (`codigo`, `cedula_docente`, `codigo_aula`, `lapso_academico`, `bloque`, `unidad_curricular`, `carrera`, `dia`) VALUES
(57, 9372683, '2023', '1103', 'B1', '07', '1616', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lapso_academico`
--

DROP TABLE IF EXISTS `lapso_academico`;
CREATE TABLE IF NOT EXISTS `lapso_academico` (
  `lapso` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  PRIMARY KEY (`lapso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lapso_academico`
--

INSERT INTO `lapso_academico` (`lapso`, `fecha_inicio`, `fecha_final`) VALUES
('90', '2022-02-19', '2022-03-13'),
('1103', '2022-03-13', '2022-03-16'),
('TRAYECTO1 ', '2022-04-16', '2022-04-30'),
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
('10', 'MATERIA10', '0'),
('11', 'MATERIA11', '0'),
('009', 'ARTES PLASTICAS', '0'),
('05', 'MATERIAS', '0'),
('GFGFG', 'GFGFGF', '0'),
('06', 'MATERIA', '0'),
('005', 'MAT', '1'),
('008', 'MAT', '1'),
('03', 'MATERIAS', '0'),
('04', 'MATERIAS01', '0'),
('07', 'MATEMATICA', '0'),
('MATANGA', 'DIJO', '0'),
('ALV', 'PERRO', '0'),
('UFF', 'ALAMADRE', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

DROP TABLE IF EXISTS `noticia`;
CREATE TABLE IF NOT EXISTS `noticia` (
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `noticia` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_de_publicacion` date NOT NULL,
  `fecha_de_expiracion` date NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`codigo`, `noticia`, `fecha_de_publicacion`, `fecha_de_expiracion`) VALUES
('DSADAS', 'MELANIE ESCRIBE UNA FANFIC PARA NADA CRISTIANO Y LO COMPRA NETFLIX PARA UNA PELICULA ', '2022-04-24', '2022-04-30'),
('HHHHHHHH', 'ANGEL TUVO UNA NOCHE DE PLACER CON UNA SEñORITA DE LA NOCHE', '2022-04-24', '2022-05-07'),
('BBBBBB', 'MARTIN REBAJO 6 KILOS, QUE GRANDE', '2022-04-24', '2022-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

DROP TABLE IF EXISTS `oferta`;
CREATE TABLE IF NOT EXISTS `oferta` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `lapso_academico` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `pnf` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `horas_semanales` int NOT NULL,
  `creditos` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`codigo`, `lapso_academico`, `pnf`, `horas_semanales`, `creditos`) VALUES
(49, '1103', '1616', 15, 15),
(69, 'TRAYECTO1 ', '2121', 90, 15),
(70, '9000', '2121', 90, 15),
(71, '90', '2121', 90, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficio`
--

DROP TABLE IF EXISTS `oficio`;
CREATE TABLE IF NOT EXISTS `oficio` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oficio`
--

INSERT INTO `oficio` (`nombre`) VALUES
('MAMARLA'),
('MUSICO');

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
) ENGINE=MyISAM AUTO_INCREMENT=421 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`codigo`, `pnf`, `unidad_curricular`) VALUES
(383, '70', 'PO-12'),
(392, '70', '03'),
(393, '70', '04'),
(418, '2121', 'MATANGA'),
(419, '2121', 'ALV'),
(415, '1616', '009'),
(414, '1616', '07'),
(375, '102', 'GFGFG'),
(413, '1616', '06'),
(410, '2121', ''),
(412, '102', '05'),
(420, '2121', 'UFF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `cedula` bigint NOT NULL,
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
  `disponibilidad` int NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`cedula`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `contratacion`, `categoria`, `dedicacion`, `direccion`, `telefono`, `telefono_fijo`, `correo`, `titulo`, `oficio`, `rol`, `disponibilidad`) VALUES
(9372683, 'NIRETCIA', 'INMACULADA', 'RAMIREZ', 'VALERO', 3, 5, 1, 'CAMBURITO', '04147965415', '02556659105', 'perro@gmail.com', 'BACHILLER', 'MUSICO', '1', 1),
(11716900, 'JONATHAN', 'SEXO', 'RAMIREZ', '', 2, 3, 3, 'URB CAMBURITO, CALLE 7, CASA 7-24', '04167577138', '0255669105', 'jonathan@gmail.com', 'MASTER EN PINTURA', 'PINTOR', '0', 1),
(27414575, 'MARTIN', 'PEREZ', 'ROJAS', 'PASTOR', 1, 6, 3, 'EN LAS PALMAS', '04125719342', '02314242113', 'sexo@gmail.com', 'LICENCIADA EN ADMINISTRACION', 'BAILARINA', '0', 1),
(6546, 'ALOHA', '', 'VERGA', '', 1, 8, 3, 'AAAAAAAA', '0416139094', '02556649749', 'jonas@gmail.com', 'PERRO', 'MAMARLA', '0', 0);

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
(1, 'Tiempo Indeterminado'),
(2, 'Tiempo Determinado'),
(3, 'Ordinario');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
