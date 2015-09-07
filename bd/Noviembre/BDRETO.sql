-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 05-11-2009 a las 15:00:47
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `reto`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `encuentros`
-- 

CREATE TABLE `encuentros` (
  `CodRonda` varchar(1) NOT NULL default '',
  `Numero` int(10) unsigned NOT NULL default '0',
  `Equipo1` int(10) unsigned NOT NULL default '0',
  `Equipo2` int(10) unsigned NOT NULL default '0',
  `Equipo3` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`CodRonda`,`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `encuentros`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `equipos`
-- 

CREATE TABLE `equipos` (
  `Numero` int(10) unsigned NOT NULL default '0',
  `Equipo` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `equipos`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `estadistica`
-- 

CREATE TABLE `estadistica` (
  `CodRonda` varchar(1) NOT NULL default '',
  `Encuentro` int(10) unsigned NOT NULL default '0',
  `Equipo` int(10) unsigned NOT NULL default '0',
  `FlagGano` varchar(1) NOT NULL default '',
  `Puntos` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`CodRonda`,`Encuentro`,`Equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `estadistica`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `historial`
-- 

CREATE TABLE `historial` (
  `Id` int(10) unsigned NOT NULL auto_increment,
  `Ronda` varchar(1) NOT NULL default '',
  `Equipo` int(10) unsigned NOT NULL default '0',
  `Pregunta` int(10) unsigned NOT NULL,
  `FlagAcierto` varchar(1) NOT NULL default 'N',
  `Encuentro` int(10) unsigned NOT NULL default '0',
  `FlagValido` varchar(1) NOT NULL default '',
  PRIMARY KEY  (`Id`),
  UNIQUE KEY `historial_uk_2` (`Ronda`,`Equipo`,`Pregunta`,`Encuentro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `historial`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `parametros`
-- 

CREATE TABLE `parametros` (
  `Parametro` varchar(10) NOT NULL default '',
  `Descripcion` varchar(100) NOT NULL default '',
  `Valor` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`Parametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `parametros`
-- 

INSERT INTO `parametros` VALUES ('PRERONDA1', 'LIMITE DE PREGUNTAS RONDA ELIMINATORIA', '2');
INSERT INTO `parametros` VALUES ('PRERONDA2', 'LIMITE DE PREGUNTAS RONDA SEMI-FINAL', '2');
INSERT INTO `parametros` VALUES ('PRERONDA3', 'LIMITE DE PREGUNTAS RONDA FINAL', '2');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `preguntas`
-- 

CREATE TABLE `preguntas` (
  `Numero` int(10) unsigned NOT NULL auto_increment,
  `Pregunta` longtext NOT NULL,
  `OpcionA` longtext NOT NULL,
  `OpcionB` longtext NOT NULL,
  `OpcionC` longtext NOT NULL,
  `OpcionD` longtext NOT NULL,
  `Respuesta` varchar(1) NOT NULL default '',
  `Puntos` int(2) unsigned NOT NULL default '0',
  `Ronda` varchar(1) NOT NULL default '',
  PRIMARY KEY  (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `preguntas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `resultados`
-- 

CREATE TABLE `resultados` (
  `CodRonda` varchar(1) NOT NULL default '',
  `Numero` int(10) unsigned NOT NULL default '0',
  `Puntos1` int(10) unsigned NOT NULL default '0',
  `Puntos2` int(10) unsigned NOT NULL default '0',
  `Puntos3` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`CodRonda`,`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `resultados`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rondas`
-- 

CREATE TABLE `rondas` (
  `CodRonda` varchar(1) NOT NULL default '',
  `Ronda` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`CodRonda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rondas`
-- 

INSERT INTO `rondas` VALUES ('1', 'ELIMINATORIA');
INSERT INTO `rondas` VALUES ('2', 'SEMI-FINAL');
INSERT INTO `rondas` VALUES ('3', 'FINAL');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `status`
-- 

CREATE TABLE `status` (
  `CodRonda` varchar(1) NOT NULL default '',
  `Encuentro` int(10) unsigned NOT NULL default '0',
  `Turno` varchar(1) NOT NULL default '',
  PRIMARY KEY  (`CodRonda`,`Encuentro`,`Turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `status`
-- 

INSERT INTO `status` VALUES ('1', 1, '1');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `turnos`
-- 

CREATE TABLE `turnos` (
  `Equipo1` int(10) unsigned NOT NULL default '0',
  `Equipo2` int(10) unsigned NOT NULL default '0',
  `Equipo3` int(10) unsigned NOT NULL default '0',
  `CodRonda` varchar(1) NOT NULL default '',
  `Encuentro` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`Encuentro`,`CodRonda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `turnos`
-- 

