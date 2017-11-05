-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: sql210.hgratis.com
-- Tiempo de generación: 05-11-2017 a las 18:04:23
-- Versión del servidor: 5.6.35-81.0
-- Versión de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hgrat_20986938_Estacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cochera`
--

CREATE TABLE IF NOT EXISTS `Cochera` (
  `piso` int(10) NOT NULL,
  `id_cochera` int(10) NOT NULL,
  `ocupado` tinyint(1) NOT NULL,
  `discapacitado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registro_autos`
--

CREATE TABLE IF NOT EXISTS `Registro_autos` (
  `id_cochera` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `patente` varchar(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `hora_ingreso` bigint(20) NOT NULL,
  `fecha_egreso` date NOT NULL,
  `hora_egreso` bigint(20) NOT NULL,
  `monto` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_usuarios`
--

CREATE TABLE IF NOT EXISTS `registro_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Vehiculo`
--

CREATE TABLE IF NOT EXISTS `Vehiculo` (
  `id_cochera` int(10) NOT NULL,
  `patente` varchar(9) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `hora` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_cochera`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
