-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-04-2014 a las 21:00:23
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_consultapp_v1`
--
CREATE DATABASE `db_consultapp_v1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_consultapp_v1`;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `user_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'indice primario y autoincremental',
  `name_vc` varchar(100) NOT NULL COMMENT 'nombre de usuario, servira de identificador',
  `password_vc` varchar(10) NOT NULL COMMENT 'contrasenia para su ingres',
  `role_int` int(1) NOT NULL DEFAULT '0' COMMENT '0=inactivo, 1=usuario, 2=administrador',
  PRIMARY KEY (`user_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_user`
--

INSERT INTO `t_user` (`user_pk`, `name_vc`, `password_vc`, `role_int`) VALUES
(1, 'user', 'user123', 1),
(2, 'admin', 'admin789', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
