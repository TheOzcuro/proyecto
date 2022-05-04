-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-05-2022 a las 14:46:24
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE IF NOT EXISTS `aula` (
  `codigo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`codigo`, `nombre`) VALUES
('40', 'VERGA'),
('90', 'ANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_disponibilidad`
--

DROP TABLE IF EXISTS `bloque_disponibilidad`;
CREATE TABLE IF NOT EXISTS `bloque_disponibilidad` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `cedula` bigint NOT NULL,
  `bloque` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dia` int NOT NULL,
  `disponibilidad` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=1241 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bloque_disponibilidad`
--

INSERT INTO `bloque_disponibilidad` (`codigo`, `cedula`, `bloque`, `dia`, `disponibilidad`) VALUES
(1238, 11716900, 'B1', 1, 1),
(1239, 11716900, 'B2', 1, 1),
(1240, 11716900, 'B3', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE IF NOT EXISTS `carrera` (
  `codigo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`codigo`, `nombre`) VALUES
('TA', 'TRAPIAO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
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
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
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
  `dias` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
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
  `codigo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `periodo_academico` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `bloque` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `unidad_curricular` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `carrera` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dia` int NOT NULL,
  `seccion` int NOT NULL,
  `tipo` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horario_docente`
--

INSERT INTO `horario_docente` (`codigo`, `cedula_docente`, `codigo_aula`, `periodo_academico`, `bloque`, `unidad_curricular`, `carrera`, `dia`, `seccion`, `tipo`) VALUES
(100, 11716900, '90', '416', 'B1', '45', 'TA', 1, 2, 0),
(101, 11716900, '40', '416', 'B2', 'FFFF', 'TA', 1, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lapso_academico`
--

DROP TABLE IF EXISTS `lapso_academico`;
CREATE TABLE IF NOT EXISTS `lapso_academico` (
  `periodo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_final` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` int NOT NULL,
  PRIMARY KEY (`periodo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lapso_academico`
--

INSERT INTO `lapso_academico` (`periodo`, `fecha_inicio`, `fecha_final`, `estatus`) VALUES
('416', '02-05-2022', '03-06-2022', 1),
('2023-II', '20-04-2022', '16-11-2022', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `codigo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `horas_semanales` int NOT NULL,
  `unidad_credito` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`codigo`, `nombre`, `tipo`, `horas_semanales`, `unidad_credito`) VALUES
('FISICUAN', 'FISICA CUANTICA', '0', 14, 20),
('45', 'SEXO', '1', 45, 10),
('46', 'SEXO', '1', 10, 35),
('FFFF', 'FEO', '0', 40, 30),
('66666', '1561DS', '0', 30, 30),
('DSADAS', '6060GG', '0', 60, 30),
('GFGFA', 'DSACZ', '0', 16, 16),
('GFD6VZ', 'CX1Z3', '0', 61, 61),
('4DSA6', '616', '0', 46, 14),
('DSA16', 'D1S6A', '0', 14, 14),
('4D6SA', 'DSA', '0', 16, 16),
('1616DS', 'DSADSA1Z3', '0', 15, 15),
('161SA', '61DS6A', '0', 13, 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

DROP TABLE IF EXISTS `noticia`;
CREATE TABLE IF NOT EXISTS `noticia` (
  `codigo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `noticia` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_de_publicacion` date NOT NULL,
  `fecha_de_expiracion` date NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`codigo`, `noticia`, `fecha_de_publicacion`, `fecha_de_expiracion`) VALUES
('HHHHHHHH', 'LOS HORARIOS YA SE CREARON', '2022-04-25', '2022-05-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

DROP TABLE IF EXISTS `oferta`;
CREATE TABLE IF NOT EXISTS `oferta` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `periodo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pnf` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`codigo`, `periodo`, `pnf`) VALUES
(74, '416', 'TA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficio`
--

DROP TABLE IF EXISTS `oficio`;
CREATE TABLE IF NOT EXISTS `oficio` (
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oficio`
--

INSERT INTO `oficio` (`nombre`) VALUES
('PERRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pensum`
--

DROP TABLE IF EXISTS `pensum`;
CREATE TABLE IF NOT EXISTS `pensum` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `pnf` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `unidad_curricular` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=437 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`codigo`, `pnf`, `unidad_curricular`) VALUES
(422, 'TA', 'FISICUAN'),
(426, 'TA', '45'),
(427, 'TA', 'FFFF'),
(428, 'TA', '66666'),
(429, 'TA', 'DSADAS'),
(430, 'TA', 'GFGFA'),
(431, 'TA', 'GFD6VZ'),
(432, 'TA', '4DSA6'),
(433, 'TA', 'DSA16'),
(434, 'TA', '4D6SA'),
(435, 'TA', '1616DS'),
(436, 'TA', '161SA');

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
(11716900, 'ALEXI', '', 'RAMIREZ', '', 1, 5, 3, 'DSADA1DS65ADSA', '0416751138', '51616156161', 'jonatha@gmail.com', 'SEXO', 'PERRO', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_pass`
--

DROP TABLE IF EXISTS `profesor_pass`;
CREATE TABLE IF NOT EXISTS `profesor_pass` (
  `codigo` bigint NOT NULL AUTO_INCREMENT,
  `cedula` bigint NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor_pass`
--

INSERT INTO `profesor_pass` (`codigo`, `cedula`, `password`) VALUES
(8, 11716900, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `codigo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`codigo`) VALUES
('1'),
('2'),
('3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcontratacion`
--

DROP TABLE IF EXISTS `tcontratacion`;
CREATE TABLE IF NOT EXISTS `tcontratacion` (
  `codigo` int NOT NULL,
  `tcontratacion` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
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
