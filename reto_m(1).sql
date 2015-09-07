-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-01-2015 a las 15:22:04
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `reto_m`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuentros`
--

CREATE TABLE IF NOT EXISTS `encuentros` (
  `CodRonda` varchar(1) NOT NULL DEFAULT '',
  `Numero` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo1` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo2` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo3` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`CodRonda`,`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encuentros`
--

INSERT INTO `encuentros` (`CodRonda`, `Numero`, `Equipo1`, `Equipo2`, `Equipo3`) VALUES
('1', 1, 11, 12, 0),
('1', 2, 2, 8, 0),
('1', 3, 4, 7, 0),
('1', 4, 6, 3, 0),
('1', 5, 5, 10, 0),
('1', 6, 1, 4, 0),
('2', 1, 7, 11, 0),
('2', 2, 2, 5, 0),
('2', 3, 6, 4, 0),
('3', 1, 7, 2, 4),
('3', 2, 2, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `Numero` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(150) NOT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`Numero`, `Equipo`, `logo`) VALUES
(1, 'Contraloría Municipio Acosta', 'ACOSTA.jpg'),
(2, 'Contraloría Municipio Aguasay', 'RETO AL CONOCIMIENTO FRANELAS AGUASAY.jpg'),
(3, 'Contraloría Municipio Bolivar', 'RETO AL CONOCIMIENTO FRANELAS BOLIVAR.jpg'),
(4, 'Contraloría Municipio Caripe', 'RETO AL CONOCIMIENTO FRANELAS CARIPE.jpg'),
(5, 'Contraloría Municipio Cedeño', 'RETO AL CONOCIMIENTO FRANELAS CEDEÑO.jpg'),
(6, 'Contraloría Municipio Ezequiel Zamora', 'RETO AL CONOCIMIENTO FRANELAS ZAMORA.jpg'),
(7, 'Contraloría Municipio Libertador', 'RETO AL CONOCIMIENTO FRANELAS LIBERTADOR.jpg'),
(8, 'Contraloría Municipio Maturín', 'RETO AL CONOCIMIENTO FRANELAS  MATURIN.jpg'),
(9, 'Contraloría Municipio Piar', 'Piar.PNG'),
(10, 'Contraloría Municipio Punceres', 'RETO AL CONOCIMIENTO FRANELAS PUNCERES.jpg'),
(11, 'Contraloría Municipio Santa Barbara', 'SANTA barbara.jpg'),
(12, 'Contraloría Municipio Sotillo', 'RETO AL CONOCIMIENTO FRANELAS SOTILLO.jpg'),
(13, 'Contraloría Municipio Uracoa', 'Uracoa.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE IF NOT EXISTS `estadistica` (
  `CodRonda` varchar(1) NOT NULL DEFAULT '',
  `Encuentro` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo` int(10) unsigned NOT NULL DEFAULT '0',
  `FlagGano` varchar(1) NOT NULL DEFAULT '',
  `Puntos` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`CodRonda`,`Encuentro`,`Equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadistica`
--

INSERT INTO `estadistica` (`CodRonda`, `Encuentro`, `Equipo`, `FlagGano`, `Puntos`) VALUES
('1', 1, 0, 'N', 0),
('1', 1, 11, 'S', 4),
('1', 1, 12, 'N', 1),
('1', 2, 0, 'N', 0),
('1', 2, 2, 'S', 3),
('1', 2, 8, 'N', 2),
('1', 3, 0, 'N', 0),
('1', 3, 4, 'N', 3),
('1', 3, 7, 'S', 4),
('1', 4, 0, 'N', 0),
('1', 4, 3, 'N', 2),
('1', 4, 6, 'S', 3),
('1', 5, 0, 'N', 0),
('1', 5, 5, 'S', 2),
('1', 5, 10, 'N', 1),
('1', 6, 0, 'N', 0),
('1', 6, 1, 'N', 3),
('1', 6, 4, 'S', 4),
('2', 1, 0, 'N', 0),
('2', 1, 7, 'S', 7),
('2', 1, 11, 'N', 6),
('2', 2, 0, 'N', 0),
('2', 2, 2, 'S', 4),
('2', 2, 5, 'N', 0),
('2', 3, 0, 'N', 0),
('2', 3, 4, 'S', 2),
('2', 3, 6, 'N', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Ronda` varchar(1) NOT NULL DEFAULT '',
  `Equipo` int(10) unsigned NOT NULL DEFAULT '0',
  `Pregunta` int(10) unsigned NOT NULL,
  `FlagAcierto` varchar(1) NOT NULL DEFAULT 'N',
  `Encuentro` int(10) unsigned NOT NULL DEFAULT '0',
  `FlagValido` varchar(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `historial_uk_2` (`Ronda`,`Equipo`,`Pregunta`,`Encuentro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`Id`, `Ronda`, `Equipo`, `Pregunta`, `FlagAcierto`, `Encuentro`, `FlagValido`) VALUES
(1, '1', 11, 6, 'S', 1, 'S'),
(2, '1', 12, 8, 'N', 1, 'S'),
(3, '1', 11, 3, 'S', 1, 'S'),
(4, '1', 12, 16, 'N', 1, 'S'),
(5, '1', 11, 2, 'S', 1, 'S'),
(6, '1', 12, 5, 'N', 1, 'S'),
(7, '1', 11, 19, 'S', 1, 'S'),
(8, '1', 12, 14, 'S', 1, 'S'),
(9, '1', 2, 4, 'S', 2, 'S'),
(10, '1', 8, 7, 'N', 2, 'S'),
(11, '1', 2, 9, 'N', 2, 'S'),
(12, '1', 8, 10, 'N', 2, 'S'),
(13, '1', 2, 1, 'S', 2, 'S'),
(14, '1', 8, 34, 'S', 2, 'S'),
(15, '1', 2, 20, 'N', 2, 'N'),
(16, '1', 2, 11, 'S', 2, 'S'),
(17, '1', 8, 15, 'S', 2, 'S'),
(18, '1', 4, 22, 'S', 3, 'S'),
(19, '1', 7, 21, 'S', 3, 'S'),
(20, '1', 4, 27, 'S', 3, 'S'),
(21, '1', 7, 28, 'N', 3, 'N'),
(22, '1', 7, 25, 'S', 3, 'S'),
(23, '1', 4, 26, 'N', 3, 'S'),
(24, '1', 7, 24, 'S', 3, 'S'),
(25, '1', 4, 18, 'S', 3, 'S'),
(26, '1', 7, 23, 'S', 3, 'S'),
(27, '1', 6, 12, 'S', 4, 'S'),
(28, '1', 3, 13, 'S', 4, 'S'),
(29, '1', 6, 17, 'S', 4, 'S'),
(30, '1', 3, 29, 'N', 4, 'S'),
(31, '1', 6, 30, 'S', 4, 'S'),
(32, '1', 3, 31, 'S', 4, 'S'),
(33, '1', 6, 37, 'N', 4, 'S'),
(34, '1', 3, 36, 'N', 4, 'S'),
(35, '1', 5, 32, 'N', 5, 'S'),
(36, '1', 10, 60, 'N', 5, 'S'),
(37, '1', 5, 33, 'S', 5, 'S'),
(38, '1', 10, 35, 'N', 5, 'S'),
(39, '1', 5, 40, 'S', 5, 'S'),
(40, '1', 10, 43, 'S', 5, 'S'),
(41, '1', 5, 38, 'N', 5, 'S'),
(42, '1', 10, 39, 'N', 5, 'S'),
(43, '1', 1, 42, 'S', 6, 'S'),
(44, '1', 4, 41, 'S', 6, 'S'),
(45, '1', 1, 61, 'N', 6, 'S'),
(46, '1', 4, 45, 'S', 6, 'S'),
(47, '1', 1, 47, 'S', 6, 'S'),
(48, '1', 4, 46, 'S', 6, 'S'),
(49, '1', 1, 44, 'S', 6, 'S'),
(50, '1', 4, 48, 'S', 6, 'S'),
(51, '2', 7, 105, 'N', 1, 'S'),
(52, '2', 11, 102, 'N', 1, 'S'),
(53, '2', 7, 110, 'S', 1, 'S'),
(54, '2', 11, 103, 'S', 1, 'S'),
(55, '2', 7, 109, 'S', 1, 'S'),
(56, '2', 11, 108, 'S', 1, 'S'),
(57, '2', 7, 116, 'S', 1, 'S'),
(58, '2', 11, 106, 'S', 1, 'S'),
(59, '2', 7, 107, 'S', 1, 'S'),
(60, '2', 11, 104, 'S', 1, 'S'),
(61, '2', 7, 115, 'S', 1, 'S'),
(62, '2', 11, 113, 'S', 1, 'S'),
(63, '2', 7, 111, 'S', 1, 'S'),
(64, '2', 11, 114, 'S', 1, 'S'),
(65, '2', 7, 124, 'S', 1, 'S'),
(66, '2', 11, 119, 'N', 1, 'S'),
(67, '2', 2, 101, 'S', 2, 'S'),
(68, '2', 5, 120, 'N', 2, 'S'),
(69, '2', 2, 121, 'S', 2, 'S'),
(70, '2', 5, 112, 'N', 2, 'S'),
(71, '2', 2, 117, 'S', 2, 'S'),
(72, '2', 5, 122, 'N', 2, 'S'),
(73, '2', 2, 123, 'S', 2, 'S'),
(74, '2', 5, 118, 'N', 2, 'S'),
(75, '2', 6, 51, 'N', 3, 'S'),
(76, '2', 4, 60, 'S', 3, 'S'),
(77, '2', 6, 62, 'N', 3, 'S'),
(78, '2', 4, 58, 'N', 3, 'S'),
(79, '2', 6, 52, 'N', 3, 'S'),
(80, '2', 4, 56, 'N', 3, 'S'),
(81, '2', 6, 54, 'S', 3, 'S'),
(82, '2', 4, 65, 'S', 3, 'S'),
(83, '3', 7, 75, 'S', 1, 'S'),
(84, '3', 2, 74, 'S', 1, 'S'),
(85, '3', 4, 78, 'N', 1, 'N'),
(86, '3', 4, 82, 'S', 1, 'S'),
(87, '3', 7, 81, 'S', 1, 'S'),
(88, '3', 2, 80, 'N', 1, 'N'),
(89, '3', 2, 79, 'N', 1, 'N'),
(90, '3', 2, 77, 'N', 1, 'N'),
(91, '3', 2, 71, 'S', 1, 'S'),
(92, '3', 4, 85, 'S', 1, 'S'),
(93, '3', 7, 86, 'S', 1, 'S'),
(94, '3', 2, 73, 'N', 1, 'N'),
(95, '3', 2, 72, 'N', 1, 'N'),
(96, '3', 2, 83, 'S', 1, 'S'),
(97, '3', 4, 84, 'S', 1, 'S'),
(98, '3', 7, 87, 'S', 1, 'S'),
(99, '3', 2, 88, 'S', 1, 'S'),
(100, '3', 4, 155, 'S', 1, 'S'),
(101, '3', 7, 89, 'N', 1, 'S'),
(102, '3', 2, 154, 'S', 1, 'S'),
(103, '3', 4, 156, 'S', 1, 'S'),
(104, '3', 7, 158, 'S', 1, 'S'),
(105, '3', 2, 76, 'S', 1, 'S'),
(106, '3', 4, 160, 'S', 1, 'S'),
(107, '3', 7, 157, 'S', 1, 'S'),
(108, '3', 2, 159, 'S', 1, 'S'),
(109, '3', 4, 162, 'S', 1, 'S'),
(110, '3', 2, 161, 'S', 2, 'S'),
(111, '3', 4, 163, 'S', 2, 'S'),
(112, '3', 2, 164, 'N', 2, 'S'),
(113, '3', 4, 166, 'S', 2, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `Parametro` varchar(10) NOT NULL DEFAULT '',
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `Valor` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`Parametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`Parametro`, `Descripcion`, `Valor`) VALUES
('PRERONDA1', 'LIMITE DE PREGUNTAS RONDA ELIMINATORIA', '8'),
('PRERONDA2', 'LIMITE DE PREGUNTAS RONDA SEMIFINAL', '8'),
('PRERONDA3', 'LIMITE DE PREGUNTAS RONDA FINAL', '8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `Numero` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Pregunta` longtext NOT NULL,
  `OpcionA` longtext NOT NULL,
  `OpcionB` longtext NOT NULL,
  `OpcionC` longtext NOT NULL,
  `OpcionD` longtext NOT NULL,
  `Respuesta` varchar(1) NOT NULL DEFAULT '',
  `Puntos` int(2) unsigned NOT NULL DEFAULT '0',
  `Ronda` varchar(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`Numero`, `Pregunta`, `OpcionA`, `OpcionB`, `OpcionC`, `OpcionD`, `Respuesta`, `Puntos`, `Ronda`) VALUES
(1, 'La LOCGRSNCF establece que las acciones administrativas sancionatorias o resarcitorias derivadas de la presente Ley, prescribirán en el término de', 'Un (1) año.', 'Tres (3) años.', 'Cinco (5) años.', 'Siete (7) años.', 'C', 1, '1'),
(2, 'De conformidad a lo establecido en la LOCGRSNCF, el Órgano de Control Fiscal una vez formado un expediente y en base al informe de resultados, ¿Qué podrá ordenar mediante acto motivado?', 'Imponer la multa.', 'Una determinación de responsabilidad administrativa.', 'Formular el reparo correspondiente.', 'Todas las anteriores.', 'D', 1, '1'),
(3, 'De acuerdo a lo establecido en la LOCGRSNCF y conforme a los resultados del concurso público, ¿Quién designa a los titulares de las unidades de auditoria interna de los organismos de la Administración Pública?', 'El Contralor General de la República.', 'El Consejo Legislativo.', 'El Vicepresidente de la República.', 'Ninguna de las anteriores.', 'D', 1, '1'),
(4, 'Según la LOCGRSNCF, quienes estando obligados a rendir cuenta, no lo hicieren incurren en', 'Supuesto de multa.', 'Supuesto generador de responsabilidad administrativa.', 'Supuesto de formulación de reparo.', 'Todas las anteriores.', 'B', 1, '1'),
(5, 'Según la la LOCGRSNCF, sin perjuicio de responsabilidad civil o penal, y de lo que dispongan otras leyes, constituyen suspuestos generadores de responsabilidades administrativas', 'El no haber exigido garantía a quién deba prestarla o haberla aceptado insuficientemente', 'La adquisición de bienes, la contratación de obras o servicios con observancia total o parcial del procedimiento de selección', 'La omisión del control previo', 'Todas las anteriores', 'D', 1, '1'),
(6, 'Según lo establecido en la LOCGRSNCF, cuando la Contraloría General de la República ordene o esté practicando una actuación de control, ¿Qué deberán hacer los demás Órganos de Control Fiscal?', 'Realizar la actuación de manera conjunta', 'Suspender la actuación en curso.', 'Proseguir su labor fiscal.', 'Ninguna de las Anteriores.', 'B', 1, '1'),
(7, 'Según la LOCGRSNCF¿Qué deberan contener los reparos que formulen los organos de control fiscal?', 'La identificación de la actuación del órgano de control fiscal en la que se identificaron los resultados de daños al patrimonio de la empresa.', 'La identificación del remitente del reparo.', 'La determinación de la naturalez del reparo, con indicación de sus fundamentos. ', 'Ninguna de las Anteriores.', 'C', 1, '1'),
(8, 'La LOCGRSNCF establece que la Contraloría General de la República evaluará periódicamente a los órganos de control fiscal a los fines de determinar el grado de', 'Insconsistencia con que operan.', 'Deficienca con que operan.', 'Economía con que operan.', 'Todas las anteriores.', 'C', 1, '1'),
(9, 'Según la LOCGRSNCF, cuando surgen elementos de convicción o prueba que pudieran dar lugar a imposición de multas, el Órgano de Control Fiscal en el ámbito de sus competencias iniciará el procedimiento mediante', 'Auto de cierre.', 'Informe de resultados.', 'Auto de proceder', 'Ninguna de las Anteriores.', 'D', 1, '1'),
(10, 'Según la LOCGRSNCF, ¿A quienes podra solicitar  la CGR la Declaración Jurada de Patrimonio?', 'A empleados(as) de las empresas del sector Público y Privado', 'A los contribuyentes o  responsables, según el código organico tributario, y a quienes contraten, negocien o realicen operaciones relacionadas con el patrimonio público', 'A las empresas privadas', 'Todas las anteriores', 'B', 1, '1'),
(11, 'De conformidad a la LOCGRSNCF, ¿Que derecho operará, cuando los actos, hechos u omisiones que causen daño al patrimonio de los entes u organismos señalados en esta ley, sean imputables a varios sujetos?', 'Derecho a guardar silencio.', 'Derecho a la solidaridad.', 'Derecho a un abogado.', 'Ninguna de las anteriores.', 'B', 1, '1'),
(12, 'De acuerdo a lo establecido en la LOCGRSNCF y conforme a los resultados del concurso público, ¿Quién designa a los titulares de las unidades de auditoria interna de los organismos de la Administración Pública?', 'El Contralor General de la República.', 'El Consejo Legislativo.', 'El Vicepresidente de la República.', 'Ninguna de las anteriores.', 'D', 1, '1'),
(13, 'De acuerdo a la LOCGRSNCF, ¿A quién deberán notificar inmediatamente, los funcionarios encargados de hacer efectivas las liquidaciones de  reparos, cuando estos recauden por este concepto?', 'Al Organismo Público que fue afectado.', 'Al Seniat.', 'Al Banco Central de Venezuela.', 'Al Órgano de Control Fiscal que emitió el reparo.', 'D', 1, '1'),
(14, 'De acuerdo a la LOCGRSNCF, y a excepción del Contralor General de la República que tiempo de duración  señala la presente ley, podran ejercer  los titulares de los organos de control fiscal de los entes y organismos su función?', 'Durante 5 años', 'Durante 7 años', 'Durante 10', 'Ninguna de las anteriores.', 'A', 1, '1'),
(15, 'Según la LOCGRSNCF, ¿Cuál registro deberán consultar las máximas autoridades de los organismos de la Administración Pública antes de proceder a la designación de cualquier funcionario público?', 'El Registro Nacional Electoral.', 'El Registro Militar Obligatorio.', 'El Registro Nacional de Contrataciones.', 'El Registro de Inhabilitados de la CGR.', 'D', 1, '1'),
(16, 'Según la LOCGRSNCF, ¿De quién es la facultad exclusiva y excluyente de suspender del ejercicio del cargo a un funcionario público declarado responsable en lo administrativo?', 'Contralor Municipal.', 'Contralor Estadal.', 'Contralor General de la República.', 'Todos los anteriores.', 'C', 1, '1'),
(17, 'De conformidad con la LOCGRSNCF, las máximas autoridades, los niveles directivos y gerenciales de los organismos sometidos al control de la CGR, comprometen su responsabilidad administrativa cuando:', 'No dicten las normas y manuales de procedimientos.', 'No implanten un sistema de control interno.', 'No acaten las recomendaciones que contengan los informes de auditoría .', 'Todas las anteriores', 'D', 1, '1'),
(18, 'De acuerdo a lo pautado en el Art.35 de la LOCGRSNCF, ¿Para que sirve el control interno?', 'Para promover la eficiencia, economía y calidad en sus operaciones.', 'Para verificar la exactitud y veracidad de su información financiera y administrativa.', 'Para salvaguardar los recursos del organismo.', 'Todos los anteriores.', 'D', 1, '1'),
(19, 'Según la LOCGRSNCF, las cuentas deberán ser examinadas por el órgano de Control Fiscal en un plazo no mayor de:', 'Cuatro (4) años.', 'Seis (6) años.', 'Cinco(5) años.', 'Ninguna de las anteriores.', 'C', 1, '1'),
(20, 'Según lo establecido en la LOCGRSNCF, la responsabilidad penal se hará efectiva:', 'Con la decisión del Órgano Contralor.', 'Mediante la apertura del procedimiento administrativo.', 'De conformidad con las leyes existentes en la materia.', 'Todas las Anteriores.', 'C', 1, '1'),
(21, 'De acuerdo a LOCGRSNCF, ¿quién pueden introducir cambios en el proyecto de presupuesto de gastos que anualmente prepara la Contraloría General de la República?', 'El Ministerio del Poder Popular de Planificación.', 'La Asamblea Nacionaĺ', 'Consejo Legislativo.', 'Ninguna de las anteriores.', 'B', 1, '1'),
(22, 'Según la LOCGRSNCF, las Contralorías de los estado, de los distritos, distritos metropolitanos y municipios gozarán de:', 'Autonomía orgánica.', 'Autonomía administrativa.', 'Autonomía funcional.', 'Todas las anteriores.', 'D', 1, '1'),
(23, 'De acuerdo a lo previsto en la LOCGRSNCF, "en cuanto a la procedencia del recurso de revisión se aplicará lo dispuesto al respecto en":', 'La Ley contra la Corrupción.', 'La Ley Orgánica de Procedimientos Administrativos.', 'La Ley Contra Delitos Administrativos.', 'Ninguna de la anteriores.', 'B', 1, '1'),
(24, 'De conformidad a lo establecido en la LOCGRSNCF, en el informe de resultados, mediante auto motivado, se ordenará:', 'Formular el reparo correspondiente.', 'Imponer la multa.', 'Declarar la Responsabilidad Administrativa', 'Ninguna de las anteriores.', 'D', 1, '1'),
(25, 'De conformidad con la LOCGRSNCF, son órganos del Sistema Nacional Fiscal:', 'El consejo de la Judicatura.', 'La Contraloría de los Distritos Metropolitanos y de los Municipios.', 'Los Consejos Comunales.', 'La Asamblea Nacional.', 'B', 1, '1'),
(26, 'Según la LOCGRSNCF, las investigaciones a que se refiere el artículo 77 tendrán carácter:', 'Confidencial.', 'Vinculante.', 'Reservado.', 'Todas las anteriores.', 'C', 1, '1'),
(27, 'Según la LOCGRSNCF,¿ De cuanto es la multa que de acuerdo a la gravedad de la falta deben imponer los órganos de control fiscal en el ámbito de sus competencias?', '1.000 a 10.000 UT', '100 A 110 UT', '100 A 1.000 UT', '1 A 1.000 UT', 'C', 1, '1'),
(28, 'De conformidad a la LOCGRSNCF, ¿Que derecho operará, cuando los actos, hechos u omisiones que causen daño al patrimonio de los entes u organismos señalados en esta ley, sean imputables a varios sujetos?', 'Derecho a guardar silencio.', 'Derecho a la solidaridad.', 'Derecho a un abogado.', 'Ninguna de las anteriores.', 'B', 1, '1'),
(29, 'En atención a lo previsto en la LOCGRSNCF, son principios que rigen el Sistema Nacional de Control Fiscal los siguientes:', 'La cooperación.', 'La honestidad.', 'La no participación de la ciudadania en la gestión pública.', 'Ninguna de las Anteriores.', 'D', 1, '1'),
(30, 'De acuerdo a LOCGRSNCF, ¿Cuál de los siguientes debates pueden desvirtuar una prueba testimonial?', 'Debate contralor.', 'Debate ciudadano.', 'Debate grupal.', 'Debate Judicial.', 'D', 1, '1'),
(31, 'Según el Reglamento de la LOCGRSNCF, cada expediente que se forme con ocasión del ejercicio de la potestad de investigación deberá:', 'Estar compuesto de varias piezas.', 'Estar identificado con un número.', 'Tener los documentos que lo\nintegren foliados.', 'Todas las anteriores.', 'D', 1, '1'),
(32, 'Según el Reglamento de la LOCGRSNCF, luego de la recepción del expediente de irregularidades, ¿En cuanto tiempo se debe tramitar y resolver la solicitud de autorización para la remoción o destitución de los titulares de los órganos de control fiscal?', 'A los cinco (5) días hábiles.', 'A los quince (15) días hábiles.', 'A los treinta (30) días hábiles.', 'Cualquiera de las anteriores.', 'C', 1, '1'),
(33, 'De acuerdo al Reglamento de la LOCGRSNCF, durante el acto oral y público de una determinación de responsabilidades ¿Cuál de los siguientes temas podrán exponerse?', 'Los antecedentes del procedimiento administrativo.', 'Los actos y hechos que se imputan.', 'Los elementos probatorios que se disponen.', 'Todas los anteriores.', 'D', 1, '1'),
(34, 'Según el Reglamento de la LOCGRSNCF, ¿Quién podrá asumir cualquier tipo de control previo sobre los gastos destinados a la seguridad y defensa del estado?', 'La Contraloria del Estado', 'La contraloría Municipal.', 'La Contraloria General de la República', 'Ninguna de las anteriores.', 'C', 1, '1'),
(35, 'Según el Reglamento de la LOCGRSNCF, ¿Quienes se consideran funcionarios de alto nivel?', 'Los Titulares de los Institutos Autonomos Nacionales', 'Las máximas autoridades jerarquicas', 'El Presidente del Banco Central de Venezuela', 'Todas las anteriores', 'D', 1, '1'),
(36, 'Según el reglamento de LOCGRSNCF, en el ejercicio de las actividades de control sobre los gastos destinados a seguridad y defensa del estado ¿Qué deberá preservarse?', 'El carácter secreto de dichos gastos', 'El carácter público de dichos gastos', 'El carácter  vinculante de dichos gastos', 'ningún carácter', 'A', 1, '1'),
(37, 'De conformidad con el Reglamento de la LOCGRSNCF, los metodos del Control perceptivo sólo podrán usarse en ejercicio del:', 'Control Interno', 'Control de Gestion', 'Control Posterior', 'Todas las Anteriores', 'C', 1, '1'),
(38, 'De acuerdo al Reglamento de la LOCGRSNCF, la Potestad resarcitoria comprende la facultada para :', 'Reformular reparos', 'Formular reparos', 'Condicionar reparos', 'Establecer reparos', 'B', 1, '1'),
(39, 'De acuerdo al Reglamento de la LOCGRSNCF,Cuando el órgano de control fiscal, en el curso de las investigaciones que realice, necesita tomar declaraciones a cualquier persona, ordenará la comparecencia dentro de :', 'Cinco (5) días hábiles siguientes  a la fecha de su notificación', 'Quince (15) días seguidos suiguientes a la fecha de su notificación', 'Doce (12) días siguientes a la fecha de su notificación', 'Ninguna de las anteriores.', 'D', 1, '1'),
(40, 'De conformidad al Reglamento de LOCGRSNCF, ¿A quién le corresponderá ejercer el control fiscal externo posterior de los gastos destinados a la defensa y seguridad del estado?', 'A la Asamblea Nacional', 'A la Unidad de Auditoría Comunal Nacional.', 'A la Contraloria General de la República.', 'Al Ministerio Público', 'C', 1, '1'),
(41, 'De conformidad al Reglamento de LOCGRSNCF, ¿Qué se consideran circuntancias agravantes a los fines de imponer multas previstas en la Ley?', 'La reincidencia y la reiteración', 'La magnitud del perjuicio causado al patrimonio público', 'La condición de funcionario público', 'Todas la anteriores', 'D', 1, '1'),
(42, 'Según el Reglamento de la LOCGRSNC, el informe de resultados constituye un acto:', 'Con fuerza de definitiva', 'De mero Trámite', 'Sancionador', 'Ninguna de las anteriores.', 'B', 1, '1'),
(43, 'De acuerdo al Reglamento de la LOCGRSNCF, al menos ¿Cuál de las siguientes opciones deberá estar contenida en las Actas de inspección o Fiscalizaciones?', 'La identificación del funcionario actuante', 'Objeto de la actuación', 'Circunstancias de lugar y tiempo en que se produjo la inspección o fiscalización', 'Todos las anteriores', 'D', 1, '1'),
(44, 'Según el Reglamento de la LOCGRSNCF, ¿Cuál es el lapso que tienen los funcionarios interventores de la CGR para entregar los informes de su gestión en :', 'Diariamente', 'Cada  dos (2) años', 'Mensualmente', 'Cuando se pueda', 'C', 1, '1'),
(45, 'De conformidad al Reglamento de LOCGRSNCF, los órganos de control fiscal deberán realizar sus actuaciones de conformidad al:', 'Cronograma de actuaciones mensuales', 'Plan Estratégico Nacional', 'Plan Operativo Anual', 'Plan de trabajo semestral', 'C', 1, '1'),
(46, 'De acuerdo al Reglamento de la LOCGRSNCF, ¿De que forma debe considerarse la audiencia oral y publica del procedimiento de la Determinación de Responsabilidades? :', 'Una sola y única audiencia', 'Dos audiencias.', 'Tres audiencias.', 'Las que considere conveniente el titular de la dependencia competente de la determinación de responsabilidades.', 'A', 1, '1'),
(47, 'De conformidad al Reglamento de la LOCGRSNCF ¿Se considera una situación agravante de las multas impuestas, cuando el funcionario reincida en algunos de los supuestos que le generaron dichas sanciones dentro del término de:', 'Dos (2) años.', 'Tres (3) años.', 'Cuatro (4) años.', 'Cinco (5) años.', 'D', 1, '1'),
(48, 'De conformidad al Reglamento de la LOCGRSNCF, a los fines del cabal derecho a la defensa de los interesados legítimos, una vez recibido el oficio de notificación de la potestad investigativa ¿Cuál es el lapso que estos tendrán para exponer sus argumentos y promover pruebas?.', 'Cinco (5) días hábiles.', 'Diez (10) días hábiles.', 'Quince (15) días hábiles.', 'Veinte (20) días hábiles.', 'B', 1, '1'),
(49, 'De conformidad con el Reglamento de la LOCGRSNF, en el acto Oral y Público se permitirá:', 'El ingreso de menores de edad y armas de fuego.', 'Al público en general, sin ninguna restricción de personas.', 'La intervención de las personas que participen en el acto.', 'Ninguna de las anterioes.', 'C', 1, '1'),
(50, 'Según el Reglamento de la LOCGRSNCF, ¿A quién deben remitir los OCF externos, los expedientes de las actuaciones de control que llevan adelante, cuando surjan elementos de convicción que pudieran dar lugar a una determinación de responsabilidades administrativa, a funcionarios calificados como de alto nivel que se encuentren en ejercicio de su cargo?', 'Al tribunal disciplinario del Órgano de Control Fsical.', 'A la Comisión de Auditoría de la Asamblea Nacional.', 'A la Contraloría General de la República.', 'A la Defensoría del Pueblo.', 'C', 1, '1'),
(51, 'Según lo señalado en la Ley Contra la Corrupción, una vez que el Ministerio Público conoce de la existencia de que se ha incurrido en un presunto enriquecimiento ilícito, ¿Con qué procedimiento inicia la investigación correspondiente?', 'Con un auto de detención.', 'Con un auto de proceder.', 'Con un auto motivado.', 'Ninguna de las anteriores.', 'C', 1, '1'),
(52, 'Según lo previsto en la Ley Contra la Corrupción, ¿De cuánto es la multa con la cuál serán sancionados quienes omitieren presentar la Declaración Jurada de Patrimonio dentro del término previsto para ello:', 'De 1 a 5 U.T.', 'De 20 a 50 U.T.', 'De 50 a 100 U.T.', 'De 50 a 500 U.T.', 'D', 1, '1'),
(53, 'Según lo dispuesto en la Ley Contra la Corrupción, ¿Quién solicitará a la máxima autoridad del Ente u Organismo de que se trate, la aplicación de las medidas preventivas?', 'El Contralor General de la República.', 'El Presidente de la República.', 'El Presidente de la Asamblea Nacional.', 'El Defensor del Pueblo.', 'A', 1, '1'),
(54, 'Según lo señalado en la Ley Contra la Corrupción, ¿Qué se tomará en cuenta para determinar que un funcionario incurre en un enriquecimiento ilícito en el ejercicio de sus funciones?', 'La situación personal del investigado.', 'La situación patrimonial del investigado.', 'El estado civil del investigado.', 'Ninguna de las anteriores.', 'B', 1, '1'),
(55, 'Según la Ley Contra la Corrupción, ¿Con qué deberán los funcionarios y empleados públicos administrar y custodiar el patrimonio público?', 'Con decencia.', 'Con probidad.', 'Con honradez.', 'Toas las anteriores.', 'D', 1, '1'),
(56, 'De conformidad con la Ley Contra la Corrupción, los funcionarios y empleados públicos deberán utilizar los bienes y recursos públicos para los fines previstos en:', 'La Ley Orgánica de la Administración Pública.', 'Ley de la Función pública.', 'El Presupuesto Correspondiente', 'LOCGRSNCF', 'C', 1, '1'),
(57, 'Según la Ley Contra la Corrupción, ¿quienes deberán administrar y custodiar el patrimonio público con decencia, decoro, probidad y honradez?.', 'Las personas jurídicas', 'La CGR', 'Los funcionarios y empleados públicos.', 'Los particulares', 'C', 1, '1'),
(58, 'Según lo previsto en la Ley Contra la Corrupción, ¿los informes de auditorías patrimoniales, así como las pruebas obtenidas por la CGR, para verificar y cotejar las declaraciones juradas de patrimonio tendrán', 'Carácter vinculante', 'Fuerza probatoria.', 'Fuerza de Ley.', 'Ningún carácter.', 'B', 1, '1'),
(59, 'Según la Ley Contra la Corrupción, Cuál es la pena que deberá cumplir el funcionario público que por algún acto de sus funciones reciba para si mismo o para otro retribuciones u otra utilidad que no se le deban o cuya promesa acepte?', 'Prisión de 6 meses y multa de 500 U .T.', 'Prisión de 1 a 4 años y multa hasta del 50% de lo recibido o prometido', 'Prisión de1 a 6 años y multa del 100% de lo recibido prometido.', 'Ninguna de las anteriores.', 'B', 1, '1'),
(60, 'Según lo dispuesto en la Ley Contra la Corrupción, en la administración de los bienes y recursos públicos, los funcionarios y empleados públicos se regirán por los principios de :', 'Honestidad y Transparencia.', 'Participación, eficiencia y eficacia.', 'Legalidad, rendición de cuentas y responsabilidad.', 'Todas las anteriores.', 'D', 1, '1'),
(61, 'De acuerdo a la ley de Contrataciones Públicas. Consiste en el establecimiento de mecanismos de cooperación entre el órgano  o ente contratante y persona natural o jurídicas, en la combinación de esfuerzos, fortalezas y habilidades con objeto de abordar los problemas complejos del proceso productivo, en beneficio de ambas partes', 'Alianza comercial', 'Compromiso de responsabilidad social', 'Alianza estrátegica', 'Ninguna de la anteriores.', 'C', 1, '1'),
(62, 'De conformidad con lo establecido en la Ley de Contrataciones públicas. Los bienes objetos a requisición o comiso por efectos de la medida preventiva quedarán a disposición', 'De la Contraloría del estado', 'Del Ente u Organo Contratante', 'Del Proveedor', 'Ninguna de la anteriores.', 'B', 1, '1'),
(63, 'Según lo pautado en la Ley de Contrataciones Públicas, al menos ¿Cuántas ofertas que cumplan con las condiciones requeridas se necesitan para otorgar la adjudicación en la modalidad de consulta de precios?', 'Una (1) oferta', 'Dos (2) ofertas', 'Tres (3)  ofertas', 'Cuatro (4) ofertas', 'A', 1, '1'),
(64, 'De conformidad con lo establecido en la Ley de Contrataciones públicas. Se podrá proceder por modalidad de consulta de precios en el caso de ejecución de obras cuando:', 'El contrato a ser otorgado es por un precio estimado de hasta 30.000 U.T.', 'El contrato a ser otorgado es por un precio estimado superior a 20.000 U.T.', 'El contrato a ser otorgado es por un precio estimado superior a 30.000 U.T.', 'Ninguna de las anteriores.', 'D', 1, '1'),
(65, 'Según lo previsto en la Ley de Contrataciones Públicas, ¿A quién o quienes se les debe notificar la culminación de un procedimiento de contratación?', 'Al oferente que resulte con la primera opción', 'A los oferentes que no resulten descalificados', 'A los Oferentes descalificados.', 'A todos lo oferentes', 'D', 1, '1'),
(66, 'De acuerdo a lo establecido en la Ley de Contrataciones Públicas. De las ofertas evaluadas en un procedimiento de adquisición de bienes, los precios no superen entre ellas el 5% ¿Cuál debe preferirse para su selección?', 'La oferta que tenga la mejor garantía.', 'La que oferte el monto más económico.', 'La oferta que tenga mayor participación nacional en su capital', 'Todas las anteriores.', 'C', 1, '1'),
(67, 'Según la Ley de contrataciones Públicas, ¿El lapso que la comisión de contrataciones fijará para la preparación de la manifestación de voluntad de participar en una consulta de precio teniendo en cuenta la complejidad de una obra no podrá ser menor de', 'Dos (2) días hábiles.', 'Un (1) día hábil.', 'Cuatro (4) días hábiles.', 'Tres (3) días hábiles', 'C', 1, '1'),
(68, 'De acuerdo a lo pautado en la Ley de Contrataciones Públicas, en las comisiones de contrataciones estarán representadas las áreas:', 'Ciudadana, técnica y estadística', 'Jurídica, técnica y profesional.', 'Jurídica, técnica y económico financiera.', 'Jurídica, técnica y ambiental.', 'C', 1, '1'),
(69, 'De acuerdo a lo pautaddo en la Ley de Contrataciones Públicas, ¿Cual es el lapso para la firma de un contrato a partir de la notificación de la adjudicación?', 'Ocho (8) días hábiles', 'Cuatro (4) días hábiles', 'Diez (10) días hábiles.', 'Seis (6) días hábiles.', 'A', 1, '1'),
(70, 'Según la Ley de contrataciones Públicas, ¿Que carácter tienen los actos de recepción y apertura de sobres contentivos de las manifestaciones de voluntad y ofertas ?', 'Carácter comercial', 'Carácter de servicio', 'Carácter social', 'Ninguna de las anteriores.', 'D', 1, '1'),
(71, 'De acuerdo a lo establecido en la Ley de Contrataciones Públicas,¿El Servicio Nacional de Contrataciones  es un órgano:', 'Desconcentrado dependiente funcional.', 'Concentrado dependiente funcional y administrativa de la Comisión Contratante.', 'Desconcentrado dependiente funcional de la Comisión Central de Planificación', 'Ninguna de la anteriores.', 'C', 1, '3'),
(72, 'Según lo establecido en la LOCGRSNCF, la responsabilidad penal se hará efectiva:', 'Con la decisión del Órgano Contralor.', 'Mediante la apertura del procedimiento administrativo.', 'De conformidad con las leyes existentes en la materia.', 'Todas las Anteriores.', 'C', 1, '3'),
(73, 'De acuerdo a LOCGRSNCF, ¿quién pueden introducir cambios en el proyecto de presupuesto de gastos que anualmente prepara la Contraloría General de la República?', 'El Ministerio del Poder Popular de Planificación.', 'La Asamblea Nacionaĺ', 'Consejo Legislativo.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(74, 'Según la LOCGRSNCF, las Contralorías de los estado, de los distritos, distritos metropolitanos y municipios gozarán de:', 'Autonomía orgánica.', 'Autonomía administrativa.', 'Autonomía funcional.', 'Todas las anteriores.', 'D', 1, '3'),
(75, 'De acuerdo a lo previsto en la LOCGRSNCF, "en cuanto a la procedencia del recurso de revisión se aplicará lo dispuesto al respecto en":', 'La Ley contra la Corrupción.', 'La Ley Orgánica de Procedimientos Administrativos.', 'La Ley Contra Delitos Administrativos.', 'Ninguna de la anteriores.', 'B', 1, '3'),
(76, 'De conformidad a lo establecido en la LOCGRSNCF, en el informe de resultados, mediante auto motivado, se ordenará:', 'Formular el reparo correspondiente.', 'Imponer la multa.', 'Declarar la Responsabilidad Administrativa', 'Ninguna de las anteriores.', 'D', 1, '3'),
(77, 'De conformidad con la LOCGRSNCF, son órganos del Sistema Nacional Fiscal:', 'El consejo de la Judicatura.', 'La Contraloría de los Distritos Metropolitanos y de los Municipios.', 'Los Consejos Comunales.', 'La Asamblea Nacional.', 'B', 1, '3'),
(78, 'Según la LOCGRSNCF, las investigaciones a que se refiere el artículo 77 tendrán carácter:', 'Confidencial.', 'Vinculante.', 'Reservado.', 'Todas las anteriores.', 'C', 1, '3'),
(79, 'De conformidad a la LOCGRSNCF, ¿Que derecho operará, cuando los actos, hechos u omisiones que causen daño al patrimonio de los entes u organismos señalados en esta ley, sean imputables a varios sujetos?', 'Derecho a guardar silencio.', 'Derecho a la solidaridad.', 'Derecho a un abogado.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(80, 'De acuerdo a LOCGRSNCF, ¿Cuál de los siguientes debates pueden desvirtuar una prueba testimonial?', 'Debate contralor.', 'Debate ciudadano.', 'Debate grupal.', 'Debate Judicial.', 'D', 1, '3'),
(81, 'De conformidad a lo pautado en la Ley Organica de los Consejos Comunales, ¿Ante quién deberá formalizarse la solicitud de revocatoria de los voceros o voceras del Consejo comunal?', 'Ante el Comité de Seguridad y Defensa Integral', 'Ante la Unidad de Contraloría Social', 'Ante la Asamble de Ciudadanos y Ciudadanas', 'Ninguna de las anteriores.', 'B', 1, '3'),
(82, 'Señala la Ley Orgánica de los Consejos Comunales, ¿A que instancia del Consejo Comunal corresponde realizar la evaluación de su gestión comunitaria, y la vigilancia de las actividades que realiza?', 'El comité de seguridad y defensa integral.', 'La Unidad de Contraloría Social.', 'La Unidad Administrativa y Financiera Comunitaria.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(83, 'Según lo dispuesto en la Ley Orgánica de los Consejos Comunales, ¿Qué se requiere para postularse como vocero o vocera del Consejo comunal así como integrante de la comisión electoral?', 'Tener capacidad de trabajo colectivo con disposición y tiempo para el trabajo comunitario.', 'Estar inscrito en el registro electoral de la comunidad.', 'Espiritu unitario y compromiso con los intereses de la comunidad', 'Todas las anteriores', 'D', 1, '3'),
(84, 'Según lo señalado  en la Ley de los Consejos Comunales  referidos a  los recursos financieros, ¿Cuál de los siguientes es un fondo interno que debe manejar un consejo comunal?', 'Fondo de seguridad y defensa.', 'Fondo de ahorro y crédito social', 'Fondo de energía', 'Todas las anteriores', 'B', 1, '3'),
(85, 'En concordancia con la Ley Orgánica de los Consejos Comunales, ¿Cómo se clasifican los recursos financieros que manejan los Consejos Comunales?', 'En financieros y económicos.', 'En monetarios y especies.', 'En retornables u no retornables', 'Ninguna de la anteriores.', 'C', 1, '3'),
(86, 'De acuerdo a la Ley Orgánica de los Consejos Comunales, ¿Quién deberá regir el proceso electoral para la elección del primer consejo comunal?', 'La Asamblea de Ciudadanos y Ciudadanas.', 'El equipo electoral provisional.', 'El equipo promotor y el comité de trabajo.', 'El equipo electoral permanente', 'B', 1, '3'),
(87, 'Según lo pautado en la Ley Orgánica de los Consejos Comunales, A través de quién Los Consejos Comunales deben elaborar los proyectos socio productivos?', 'De los comités de economía comunal.', 'De los comités de medios alternativos comunitarios.', 'De los comités de seguridad y defensa integral', 'Todas la anteriores', 'A', 1, '3'),
(88, 'Según lo expresado en la Ley Orgánica de los Consejos Comunales, ¿Cuál es el fondo destinado para contribuir con el pago de los gastos que se generaen en la operatividad del Consejo comunal?', 'El Fondo de Ahorro y Crédito social.', 'El Fondo de Riesgo', 'El Fondo de Gastos Operativos y de Administración', 'Ninguna de la anteriores.', 'C', 1, '3'),
(89, 'Según la Ley Orgánica de los Consejos Comunales, el acta constitutiva del Consejo Comunal deberá contener', 'El nombre del Consejo Comunal, ambito geográfico con su ubicación y linderos.', 'iIdentificación con nombre, apellido y cédula de identidad de los  y las participantes en la asamblea constitutiva', 'Nombres de los habitantes del sector', 'Todas la anteriores', 'A', 1, '3'),
(90, 'De acuerdo a lo pautado en la Ley Orgánica de los Consejos Comunales, la organización, funcionamiento y acción de los consejos comunales se regirá  por los principios de:', 'Corresponsabilidad', 'Igualdad social y de género.', 'Libre debate de las ideas', 'Todas la anteriores', 'D', 1, '2'),
(91, 'De acuerdo a lo dispuesto en la Ley Orgánica del Poder Público Municipal, ¿Cual de los siguientes sistemas conforman la administración financiera de la Hacienda Pública Municipal?', 'Sistema de Bienes y Planificación.', 'Sistema de Presupuesto y Tesoreria.', 'Sistema de Contabilidad y Tributario.', 'Todas las anteriores.', 'D', 1, '2'),
(92, 'En concordancia con la Ley Orgánica del Poder Público Municipal, cuándo  se produce una falta absoluta del Contralor o Contralora Municipal ¿Quién nombra al Contralor interino?', 'La Contraloría General del la República.', 'La Contraloría del estado.', 'El Alcalde.', 'El Consejo Municipal.', 'D', 1, '2'),
(93, 'Expresa la Ley Orgánica del Poder Público Municipal ¿Que determinarán las Ordenanzas Municipales?', 'El régimen organizativo y funcional de los poderes municipales.', 'Las normativas para los concursos.', 'La participación de las comunidades.', 'El control presupuestario.', 'A', 1, '2'),
(94, 'La Ley Orgánica del Poder Público Municipal señala, la Contraloría Municipal actuará bajo la responsabilidad y dirección del contralor o contralora municipal, quien deberá:', 'Poseer no menos de dos años de experiencia en materia de control fiscal.', 'Ser mayor de veinte años.', 'Ser de reconocida solvencia moral.', 'Todas las anteriores.', 'C', 1, '2'),
(95, 'Señala la Ley Orgánica del Poder Público Municipal, ¿A través de que función se ejercerá el Poder Público Municipal?', 'La función financiera', 'La función organizadora.', 'La función de control estadal', 'Ninguna de las anteriores.', 'D', 1, '2'),
(96, 'Según la Ley Orgánica del Poder Público Municipal, ¿Bajo que norma legal el Municipio podrá solicitar al Poder Nacional o al Estado respectivo la transferencia de determinadas competencias?', 'La Constitución y la LOCGRSNCF.', 'La Constitución y la Ley de Descentralización.', 'La Constitución y la Ley Orgánica de la Administración Central.', 'Ninguna de las anteriores.', 'B', 1, '2'),
(97, 'La Ley Orgánica del Poder Público Municipal señala, ¿Cuál de los siguientes servicios públicos es competencia de los municipios y pueden ser prestados directamente por éstos?', 'Agua potable.', 'Electricidad.', 'Gas.', 'Todas las anteriores.', 'D', 1, '2'),
(98, 'Según la Ley Orgánica del Poder Público Municipal, ¿Cómo deben las autoridades del Municipio, presentar informes sobre su gestión y rendir cuentas?', 'De forma transparente.', 'Periódicamente.', 'Oportunamente.', 'Todas las anteriores', 'D', 1, '2'),
(99, 'La Ley Orgánica del Poder Público Municipal indica, el alcalde o alcaldesa deberá ser:', 'Venezolano o venezolana.', 'Mayor de veintidos años de edad.', 'Haber residido durante al menos un año en el municipio.', 'Todas las anteriores.', 'A', 1, '2'),
(100, 'Establece la Ley Orgánica del Poder Público Municipal, el Municipio ejercerá sus competencias mediante los siguientes instrumentos jurídicos:', 'Ordenanzas.', 'Acuerdos.', 'Reglamentos.', 'Todas las anteriores.', 'D', 1, '2'),
(101, 'De acuerdo a la LOCGRSNCF, el Contralor General de la República y con su previa autorización los titulares de los demás órganos de control fiscal externo, podrán adoptar en cualquier momento, mediante acto motivado,  las medidas', 'Cautelares que resulten necesarias cuando existe riesgo manifiesto de daño al patrimonio.', 'Sancionatorias que resulten necesarias cuando existe riesgo manifiesto de daño al patrimonio.', 'Preventivas que resulten necesarias cuando existe riesgo manifiesto de daño al patrimonio.', 'Ninguna de las anteriores.', 'C', 1, '2'),
(102, 'Según la LOCGRSNCF, ¿A partir de qué fecha el Contralor podrá delegar en funcionarios de la Contraloría el ejercicio de determinadas atribuciones?', 'Desde la fecha de aprobación de la delegación en Consejo de Ministros.', 'Desde la fecha de aprobación de la delegación en una Resolución Interna.', 'Desde la fecha de publicación de la delegación en la Gaceta Oficial de la República Bolivariana de Venezuela.', 'Ninguna de las anteriores.', 'C', 1, '2'),
(103, 'De acuerdo a lo establecido en la LOCGRSNCF, sin perjuicio de la responsabilidad civil o penal  ¿Cuál de los siguientes actos constituye un supuesto generador de responsabilidad administrativa?', 'La celebración de contratos por funcionarios públicos, por interpuesta persona  con los entes del Poder Público Nacional.', 'El no haber exigido garantía a quien deba prestarla o haberla aceptado insuficientemente.', 'Autorizar gastos en celebraciones y agasajos que no se correspondan con las necesidades estrictamente protocolares del organismo.', 'Todas las anteriores.', 'D', 1, '2'),
(104, 'De acuerdo a lo establecido en la LOCGRSNCF, ¿Cuál de los siguientes principios rige al Sistema Nacional de Control Fiscal?', 'La celeridad en las actuaciones de control fiscal, sin entrabar la gestión de la administración pública.', 'El carácter técnico  en el ejercicio del control fiscal', 'La participación ciudadana en la gestión contralora.', 'Todas las anteriores.', 'D', 1, '2'),
(105, 'Sin perjuicio de lo establecido en la LOCGRSNCF, ¿Qué objetivo persigue el Sistema Nacional de Control Fiscal?', 'Fortalecer la capacidad  del Estado para ejecutar eficazmente su función de gobierno.', 'Lograr la transparencia y la eficiencia en el manejo de los recursos del sector público.', 'Establecer la responsabilidad por la comisión de irregularidades relacionadas con la gestión de los órganos del Poder Público Nacional.', 'Todas las anteriores.', 'D', 1, '2'),
(106, 'De acuerdo al Reglamento de la LOCGRSNCF, se podrá designar mediante concurso público a:', 'Todos los titulares de los Órganos de Control Fiscal.', 'Todos los titulares de los Órganos de Control Fiscal, menos los de la Unidad de Auditoria Interna.', 'Todos los titulares de los Órganos de Control Fiscal, menos los Contralores Comunales.', 'Todos los titulares de los Órganos de Control Fiscal, menos el Contralor General de la República.', 'D', 1, '2'),
(107, 'De conformidad al Reglamento de la LOCGRSNCF, la auditoría de gestión está orientada a:', 'Evaluar los planes y programas de los órganos y entidades sujetos a control.', 'Evaluar el resultado de la acción administrativa de los órganos y entidades sujetos a control.', 'Evaluar el cumplimiento y los resultados de las políticas y decisiones\ngubernamentales.', 'Todas las anteriores.', 'D', 1, '2'),
(108, 'De acuerdo al Reglamento de la LOCGRSNCF, el funcionario interventor presentará tanto al Contralor General de la República como al Órgano de Control Fiscal intervenido:', 'Los informes mensuales de su gestión', 'El plan de acciones correctivas que hayan elaborado para implementar las recomendaciones contenidas en el informe respectivo.', 'Un informe sobre los resultados de su gestión', 'Todas las anteriores', 'D', 1, '2'),
(109, 'De acuerdo al Reglamento de la LOCGRSNCF, a los efectos de la formulación de reparos, la declaratoria de responsabilidad administrativa y la imposición de multa los órganos de control fiscal determinaran responsabilidad en:', 'En un mismo procedimiento todas la responsabilidades a que haya lugar, en torno a los hechos investigados.', 'En diferentes procedimientos todos los derechos a que tenga lugar.', 'Similar  proceso en cada una de las responsabilidades que sea en el sitio', 'Ninguna de las anteriores.', 'A', 1, '2'),
(110, 'De conformidad al Reglamento de LOCGRSNCF, ¿El procedimiento administrativo de determinación de responsabilidades podrá iniciarse como consecuencia:', 'Del ejercicio de las funciones de control y de la potestad de investigación.', 'Del ejercicio de la potestad de investigación y por denuncias de particulares.', 'A solicitud de cualquier organismo o empleado público.', 'Cualquiera de las anteriores.', 'D', 1, '2'),
(111, 'De acuerdo a lo establecido en el  Reglamento de la LOCGRSNCF, ¿Cuál de los siguientes se consideran beneficios esperados del control interno?', 'El incremento de la protección del patrimonio público.', 'La minimización de los riesgos de daños contra el patrimonio público.', 'El incremento de la eficiente utilización del patrimonio público.', 'Todas  las anteriores.', 'D', 1, '2'),
(112, 'Según el Reglamento de la LOCGRSNCF, ¿las medidas de intervención serán adoptadas por el Contralor General de la República mediante:', 'Resolucíón motivada que será notificada al interesado.', 'Una rueda de prensa y su publicación en al menos cinco (5) diarios de circulación nacional.', 'Oficio dirigido al funcionario afectado.', 'Ningunade la anteriores', 'A', 1, '2'),
(113, 'Según el Reglamento de la LOCGRSNCF, ¿Qué debe al menos contener un Auto de Proceder?', 'La identificación del órgano de control fiscal, así como la de la dependencia del mismo que efectuó la respectiva actuación de control.', 'La indicación de los elementos probatorios  recabados durante la respectiva actuación de control fiscal.', 'La orden de que sean notificados los interesados legítimos.', 'Todas las anteriores', 'D', 1, '2'),
(114, 'De acuerdo al Reglamento de la LOCGRSNCF, en ocasión del ejercicio de la Potestad de Investigación ¿Qué debe contener un Oficio de Notificación?', 'El señalamiento expreso a los interesados legítimos  o sus representantes legales que a partir dela fecha tendrán acceso al expediente.', 'La dependencia en que se encuentra, con su dirección exacta y el horario de atención al público.', 'El número del expediente', 'Todas las anteriores', 'D', 1, '2'),
(115, 'De acuerdo al Reglamento de la LOCGRSNCF, ¿Cuántos días hábiles tendrán las máximas autoridades de los órganos que reciban recomendaciones de los Organos de Control Fiscal, para solicitar por escrito la reconsideración y sustitución de dichas recomendaciones?', '15 días hábiles siguientes a la recepción del informe.', '20 días hábiles siguientes a la recepción del informe.', '25 días hábiles siguientes a la recepción del informe.', '30 días hábiles siguientes a la recepción del informe.', 'A', 1, '2'),
(116, 'De conformidad con la Ley Contra la Corrupción, ¿Quienes podrían ser sancionados, con multa de 50 a 500 U.T.?', 'Quienes omitieren presentar su curriculum a la máxima autoridad cuando se le solicite.', 'Quienes no participen los nombramientos, designaciones, tomas de posesiones, remociones o destituciones.', 'Quienes no estén inscritos en el Registro Militar Obligatorio.', 'Todas las anteriores.', 'B', 1, '2'),
(117, 'De conformidad con la Ley Contra la Corrupción, ¿Cómo se inicia un procedimiento administrativo sancionatorio?', 'Con medida preventiva de libertad.', 'Con auto motivado que contendrá una relación sucinta de los hechos.', 'Con multa de 50 a 500 Unidades Tributarias.', 'Ninguna de las anteriores.', 'B', 1, '2'),
(118, 'De acuerdo a lo establecido la Ley Contra la Corrupción, se considera patrimonio público aquel que corresponde por cualquier titulo a :', 'Los órganos y entes  a los que incumbe el ejercicio del Poder público en los distritos y distritos metropolitano.', 'El Banco central de Venezuela', 'Las demás personas  de derecho público nacional, estadales, distritales y municipales.', 'Todas las anteriores.', 'D', 1, '2'),
(119, '¿Qué personas, además de las mencionadas en el art. 3 de la Ley Contra la Corrupción podrán incurrir en erriquecimiento ilicito?', 'Aquellas que no se les hubiere exigido declaración jurada de patrimonio, de conformidad a lo previsto en esta ley.', 'Aquellas a los cuales se hubiere exigido declaración jurada de patrimonio , de conformidad con lo previsto en el art. 28 de esta ley', 'Aquellas que ilegalmente no obtengan algún lucro por concepto de ejecución de contratos celebrados con cualquiera de los entes  u organos indicados en el art. 4 de esta ley.', 'Todas las anteriores.', 'B', 1, '2'),
(120, 'De acuerdo a lo pautado en la Ley de Contrataciones Públicas, en la modalidad de concurso cerrado, el ente contratante deberá seleccionar para presentar ofertas al menos a:', 'Un (1) participante.', 'Cinco (5) participantes.', 'Tres (3) participantes.', 'Ninguna de las anteriores.', 'B', 1, '2'),
(121, 'Según lo previsto en la Ley de Contrataciones Públicas, se puede declarar nulo el otorgamiento de una adjudicación cuando:', 'Se declare desierta la contratación', 'Ninguna Oferta haya sido presentada', 'El otorgamiento se produzca mediante la violación de disposiciones legales', 'Todas las anteriores', 'C', 1, '2'),
(122, 'Según lo pautado en la Ley de Contrataciones Públicas, al menos el contratista  al recibir la notificación de rescisión del contrato deberá:', 'Finalizar la Obra y los trabajos y esperar el pago.', 'Paralizar los trabajos y no iniciar ningún otro.', 'Continuar la obra y trabajos hasta alcanzar el 75 % de su ejecución', 'Iniciar la obra nuevamente teniendo que deshacer los avances alcanzados.', 'B', 1, '2'),
(123, 'De conformidad con lo establecido en la Ley de Contrataciones públicas, las comisiones de contratación estarán integradas por :', 'Un número par de miembros principales con sus respectivos suplentes.', 'Un número impar de miembros principales con sus respectivos suplentes.', 'Un número impar de miembros hasta un máximo de cinco (5) sin suplentes.', 'Un número par de miembros principales hasta un máximo de seis (6) con suplentes.', 'B', 1, '2'),
(124, 'De conformidad con lo establecido en la Ley de Contrataciones públicas, los órganos o entes contratantes,una vez formalizada la contratación correspondiente deberán garantizar a los fines  de la administración del contrato los siguientes aspectos:', 'El cumplimiento de la fecha de inicio de la obra o suministro de bienes y servicios.', 'El compromiso de responsabilidad civil.', 'La evaluación de la actuación o desempeño del órgano contratante.', 'Ninguna de la anteriores.', 'A', 1, '2'),
(125, 'De conformidad con lo establecido en la Ley de Contrataciones públicas, puede procederse por concurso cerrado independientemente del monto de la contratación, cuando la máxima autoridad del órgano o ente contratante, mediante acto motivado justifique:', 'Si se trata de la adquisición de equipos altamente especializados destinados a la experimentación, investigación y educación.', 'Por razones de seguridad del Estado, calificada como tales, conforme a las disposiciones legales que regule la materia', 'Cuando de la información verificada en los archivos o base de datos suministrados por RNC, los bienes a adquirir los producen o venden cinco o menos fabricantes o proveedores.', 'Todas las anteriores.', 'D', 1, '2'),
(126, 'De acuerdo a lo establecido en la LOCGRSNCF, ¿Cuál de los siguientes principios rige al Sistema Nacional de Control Fiscal?', 'La celeridad en las actuaciones de control fiscal, sin entrabar la gestión de la administración pública.', 'El carácter técnico  en el ejercicio del control fiscal', 'La participación ciudadana en la gestión contralora.', 'Todas las anteriores.', 'D', 1, '2'),
(127, 'Según la LOCGRSNCF,¿ De cuanto es la multa que de acuerdo a la gravedad de la falta deben imponer los órganos de control fiscal en el ámbito de sus competencias?', '1.000 a 10.000 UT', '100 A 110 UT', '100 A 1.000 UT', '1 A 1.000 UT', 'C', 1, '2'),
(128, 'Según la LOCGRSNCF, ¿Cómo es designado el Contralor General de la República?', 'De conformidad con lo previsto en la Constitución de la República Bolivariana de Venezuela y la Ley Orgánica del Poder Ciudadano.', 'De acuerdo con lo previsto en la Constitución de la República Bolivariana de Venezuela y la Ley Orgánica del Poder Popular.', 'Según lo pautado en la Ley de Planificación y el Decreto con Fuerza de Ley de Defensoria Pública.', 'Ninguna de las anteriores.', 'A', 1, '2'),
(129, 'En atención a lo previsto en la LOCGRSNCF, son principios que rigen el Sistema Nacional de Control Fiscal los siguientes:', 'La cooperación.', 'La honestidad.', 'La no participación de la ciudadania en la gestión pública.', 'Ninguna de las Anteriores.', 'D', 1, '2'),
(130, 'En concordancia con la Ley Orgánica de los Consejos Comunales, ¿Cómo se realiza la  elección de los voceros o voceras de las unidades ejecutiva, administrativa y financiera comunitaria de un Consejo comunal?', 'Por mayoría simple con la participación del diez por ciento (10%) de los habilitantes de la comunidad mayores de quince años.', 'Por plancha o lista electoral', 'De manera uninominal', 'Todas las anteriores.', 'C', 1, '2'),
(131, 'Según la Ley Orgánica de los Consejos Comunales, a los fines de su funcionamiento debe estar integrado por', 'La Unidad de Contraloría Social.', 'La Unidad Ejecutiva.', 'La Asamblea de Ciudadanos y Ciudadanas del Consejo comunal.', 'Todas las anteriores', 'D', 1, '2'),
(132, 'Según lo señalado en  la Ley Orgánica de los Consejos Comunales, ¿En cuál caso procede la iniciativa de solicitud para la revocatoria de los voceros o voceras del consejo comunal?', 'Por la solicitud del 5% de la población mayor de quince (15) años habitantes de la comunidad', 'Por solicitud del Presidente de la Junta Parroquial.', 'Por solicitud del Presidente de la República.', 'Ninguna de las anteriores.', 'D', 1, '2'),
(133, 'De conformidad con lo previsto en la Ley Orgánica de los Consejos Comunales, ¿Cuánto tiempo deben esperar los voceros y voceras del consejo comunal, que hayan sido revocados de sus funciones, para poder postularse a una nueva elección?', 'Durante dos (2) períodos siguientes a la fecha de la revocatoria.', 'Durante los tres (3) períodos siguientes a la fecha de la revocatoria', 'Durante los cinco (5) períodos siguientes a la fecha de la revocatoria.', 'Ninguna de la anteriores.', 'A', 1, '2'),
(134, 'En concordancia con la Ley Orgánica de los Consejos Comunales, ¿Cuál de las siguientes  es una función del colectivo de  Coordinación Comunitaria?', 'Aprobar la creación de comités de trabajo u otras formas de organización comunitaria, con carácter permanente o temporal', 'Conocer, previa ejecución, la gestión de la Unidad Administrativa y finaciera Comunitaria del Consejo Comunal.', 'Organizar la realización del censo demográfico y socioeconómico de la comunidad.', 'Ninguna de la anteriores.', 'B', 1, '2'),
(135, 'De acuerdo a lo pautado en la Ley Orgánica de los Consejos Comunales, ¿Qué  preferencia podran dar lo órganos y entes de estado en sus relaciones con los consejos comunales?', 'Especial atención de los consejos comunales  en la formulación, ejecución y control de todas las políticas públicas', 'Preferencia en la transparencia de los servicios públicos.', 'Asignación privilegiada y preferente, en el presupuesto de los recursos públicos para la atención de los requerimientos formulados por los consejos comunales.', 'Todas la anteriores', 'D', 1, '2'),
(136, 'Contempla la Ley Orgánica del Poder Público Municipal, las parroquias y las otras entidades locales dentro del territorio municipal son demarcaciones creadas con el objeto de:', 'Desconcentrar la gestión municipal.', 'Promover la participación ciudadana.', 'Una mejor prestación de los servicios públicos municipales.', 'Todas las anteriores.', 'D', 1, '2'),
(137, 'Según la Ley Orgánica del Poder Público Municipal, ¿En cuanto tiempo debe ser convocado el concurso para elegir al Contralor Municipa,l a partir del momento de producirse la vacante del cargo?', 'Dentro de los 30 días hábiles siguientes.', 'Dentro de los 60 días hábiles siguientes.', 'Dentro de los 90 días hábiles siguientes.', 'Dentro de los 120 días hábiles siguientes.', 'A', 1, '2'),
(138, 'Según la Ley Orgánica del Poder Público Municipal, ¿Qué le corresponde hacer al Municipio en el ejercicio de su autonomía?', 'Crear parroquias y otras entidades locales.', 'Controlar, vigilar y fiscalizar los ingresos, gastos y bienes municipales.', 'Crear, recaudar e invertir sus ingresos.', 'Todas las anteriores.', 'D', 1, '2');
INSERT INTO `preguntas` (`Numero`, `Pregunta`, `OpcionA`, `OpcionB`, `OpcionC`, `OpcionD`, `Respuesta`, `Puntos`, `Ronda`) VALUES
(139, 'Señala la Ley Orgánica del Poder Público Municipal, son deberes y atribuciones del Concejo Municipal:', 'Iniciar, consultar a las comunidades, discutir y sancionar los proyectos de ordenanzas municipales.', 'Dictar y aprobar su Reglamento Interior y de debates.', 'Ejercer la potestad normativa tributaria del municipio.', 'Todas las anteriores.', 'D', 1, '2'),
(140, 'Señala la Ley Orgánica del Poder Público Municipal, ¿Cuántos ciudadanos inscritos en el Registro Electoral Permanente, deben opinar en el referendum para un proyecto de ley de creación, fusión o segregación de municipios, para que este sea aprobado?', '10% de los ciudadanos y ciudadanas inscritos.', '15% de los ciudadanos y ciudadanas inscritos.', '20% de los ciudadanos y ciudadanas inscritos.', '25% de los ciudadanos y ciudadanas inscritos.', 'D', 1, '2'),
(141, 'Establece la Ley Orgánica del Poder Público Municipal, ¿Cuál de las siguientes opciones es una atribución y obligación del alcalde o alcaldesa?', 'Cumplir y hacer cumplir la Constitución de la República Bolivariana de Venezuela.', 'Dirigir el gobierno y la administración municipal.', 'Dictar reglamentos, decretos, resoluciones y demás actos administrativos en la entidad local.', 'Todas las anteriores.', 'D', 1, '2'),
(142, 'Establece la Ley Orgánica del Poder Público Municipal, ¿Qué condición es necesaria para que el Consejo Legislativo pueda crear un Municipio?', 'Una población asentada establemente en un territorio determinado, con vínculos de vecindad permanente.', 'Percibir recursos del estado para la construcción de obras.', 'La aceptación de las comunidades organizadas.', 'Ninguna de las anteriores.', 'A', 1, '2'),
(143, 'Según la Ley Orgánica del Poder Público Municipal, ¿De quién podrá el Consejo Legislativo, oir opiniones en relación a los procesos de formación de las leyes estadales, relativas al régimen de los municipios?', 'De los alcaldes.', 'De los concejos municiplales y las juntas parroquiales.', 'De los ciudadanos y sus organizaciones .', 'Todas las anteriores.', 'D', 1, '2'),
(144, 'Señala la Ley Orgánica del Poder Público Municipal, las competencias de los municipios son:', 'Propias, además de delegadas y descentralizadas.', 'Subordinadas a la CGR.', 'Coordinadas por el Consejo de Planificación.', 'Todas las anteriores.', 'A', 1, '2'),
(145, 'De conformidad a la Ley Orgánica del Poder Público Municipal, ¿Cómo se ejercerán las competencias de los municipios cuya población sea predominantemente indígena?', 'Con objetividad e imparcialidad.', 'Con respeto a las costumbres de cada comunidad.', 'Con el control y la rectoria de la Asociación de Indígenas de Venezuela.', 'Ninguna de las anteriores.', 'B', 1, '2'),
(146, 'De acuerdo al Reglamento de Ccontrataciones Públicas. La contratación entre órganos y entes del Estado. ¿Que se deja de exigir para la adquisisción de biene, prestación de servicios y ejecución de obras, el cual se encuentra señalado en elñ art. 3 de la Ley de Contrataciones?', 'El compromiso de responsabilidad civil', 'El compromiso de responsabilidad social', 'El compromiso de responsabilidad ejecutiva', 'Ninguna de las Anteriores.', 'B', 1, '2'),
(147, 'De acuerdo al Reglamento de Contrataciones Públicas. Se debe realizar evaluación de desempeño a todos los proveedores y contratistas que hayan obtenido la adjudicación para el suministro de bienes  y prestación de servicios por un monto:', 'Superior a  4000 UT', 'Superior a  4500 UT', 'Menor a  4000 UT', 'Todas las anteriores.', 'A', 1, '2'),
(148, 'Según el ReGlamento de Contrataciones Públicas.Para las modalidades de concurso cerrado y consulta de precios para la contratación de obras, el tiempo máximo para la evaluación de las ofertas y elaboración del informe de recomendación será:', 'De tres (3) días hábiles', 'De cuatro (4) días hábiles', 'De siete días hábiles', 'Ninguna de las anteriores.', 'D', 1, '2'),
(149, 'De acuerdo al Reglamento de Contrataciones Públicas. En la evaluación de ofertas presentadas en las modalidades de selección de contratistas previstas en la Ley de Contrataciones Públicas,¿Que no debe utilizar a los efectos de otorgar valoración a las ofertas por comparación de precios, ni como causa de rechazo de la misma, salvo lo dispuesto en la mencionada Ley?', 'Los precios  unitarios', 'El presupuesto base', 'La oferta presentada', 'Ninguna de las Anteriores.', 'B', 1, '2'),
(150, 'De acuerdo al Reglamento de Contrataciones Públicas y lo previsto en el artículo 93 de la Ley de Contrataciones públicas.¿Quién debera firmar la Orden de compra u orden de servicio, cuando estas sean utilizadas como contrato en los procedimientos para la adquisisción de bienes o prestación de servicios?', 'Por la Administradora del órgano o ente', 'Por el Contralor (a) del Estado', 'Por el representante legal del benefiario de la adjudicación', 'Ninguna de las Anteriores.', 'C', 1, '2'),
(151, 'Según el Reglamento de Contrataciones Públicas.Además de las competencias establecidas en la Ley de Contrataciones Públicas, ¿Que atribuciones tiene el Servicios Nacional de Contratación?', 'Aprobar el Sistema Interno de Recursos Humanos del Servicio.', 'Presentar a la Comisión Central de Planificación, los proyectos, reglamentos uinternos relacionados con la Ley de Contrataciones Públicas', 'Verificar y evaluar los sistemas que establecen los órganos o entes contratantes', 'Todas las anteriores.', 'D', 1, '2'),
(152, 'De acuerdo al Reglamento de Contrataciones Públicas. ¿Que debe contener los expedientes de contratación?:', 'El contrato generado por la adjudicación', 'Informe de análisis y recomendación de la adjudicación  o declaratoria desierta.', 'Documento que autoriza el inicio del procedimiento', 'Todas las anteriores.', 'D', 1, '2'),
(153, 'De acuerdo al Reglamento de Contrataciones Públicas.y lo previsto en la Ley de Comtrataciopnes. ¿Que información debe contener el acta para dar inicio a la realización de un  concurso cerrado?', 'El monto estimado de la contratación.', 'Cronograma de ejecución de la modalidad de selección.', 'Estimado de contratación y calificación financiera.', 'Todas las anteriores.', 'D', 1, '2'),
(154, 'De acuerdo a la LOCGRSNCF, ¿Cuál de los siguientes entes u organismos está sujeto al Control de la Contraloría General de la República?', 'El Banco Central de Venezuela.', 'Las Universidades Privadas.', 'Las empresas e institutos privados nacionales, estatales, distritales y municipales.', 'Todos los anteriores.', 'A', 1, '3'),
(155, 'De acuerdo a lo establecido en la LOCGRSNCF, sin perjuicio de la responsabilidad civil o penal  ¿Cuál de los siguientes actos constituye un supuesto generador de responsabilidad administrativa?', 'La omisión del control previo', 'La retención o el retardo injustificado en el pago o en la tramitación de ordenes de pago', 'Autorizar gastos en celebraciones y agasajos que no correspondan con las necesidades estrictamente protocolares del organismo', 'Todas las anteriores.', 'D', 1, '3'),
(156, 'De conformidad con LOCGRSNCF, los Organos de Control Fiscal informarán de los resultados de sus actividades a', 'La Máxima Autoridad del Eejecutivo Nacional', 'Al registro Civil para su respectivo asiento en los libros.', 'A las entidades y autoridades que legalmente puedan adoptar las medidas correctivas necesarias', 'Todas las anteriores.', 'C', 1, '3'),
(157, 'De acuerdo a la LOCGRSNCF, la prescripción de las acciones administrativas sancionatorias o resarcitorias se pueden interrumpir por:', 'Por la información suministrada al imputado durante las investigaciones preliminares, conforme a lo previsto en el artículo 79 de esta ley.', 'Por la notificación a los interesados del auto de apertura del procedimiento para la determinación de responsabilidades, establecido en esta ley.', 'Por cualquier actuación fiscal notificada a los interesados en la que se haga constar la existencia de irregularidades.', 'Todas las anteriores.', 'D', 1, '3'),
(158, 'Según la LOCGRSNCF, ¿Cómo es designado el Contralor General de la República?', 'De conformidad con lo previsto en la Constitución de la República Bolivariana de Venezuela y la Ley Orgánica del Poder Ciudadano.', 'De acuerdo con lo previsto en la Constitución de la República Bolivariana de Venezuela y la Ley Orgánica del Poder Popular.', 'Según lo pautado en la Ley de Planificación y el Decreto con Fuerza de Ley de Defensoria Pública.', 'Ninguna de las anteriores.', 'A', 1, '3'),
(159, 'De acuerdo al Reglamento de la LOCGRSNCF, ¿Cuál de las siguientes  se considera una grave irregularidad, que pudiese generar una intervención del Contralor General de la República en un órgano de control fiscal?', 'La falta absoluta de planificación de sus actividades.', 'La reiterada falta de acciones de seguimiento respecto a sus propias\nobservaciones y recomendaciones.', 'La omisión absoluta e injustificada de la práctica de auditorías sobre los\nórganos y entidades sujetos a su control, durante un ejercicio fiscal.', 'Todas las anteriores.', 'D', 1, '3'),
(160, 'De acuerdo a lo establecido en el Reglamento de la LOCGRSNCF ¿Cuál de las siguientes se considera una circunstancia atenuante, a los fines de la imposición de las multas previstas en la Ley?', 'El haber sido advertido acerca de la irregularidad del acto, hecho u omisión\npor el que se comprometió su responsabilidad.', 'La reincidencia y la reiteración.', 'No haber sido objeto de alguna de las sanciones establecidas en la Ley.', 'Ninguna de las anteriores.', 'C', 1, '3'),
(161, 'De conformidad al Reglamento de la LOCGRSNCF,  ¿En cuánto tiempo los Ministros ordenadores de compromisos y pagos de gastos de seguridad y defensa del Estado, informarán sobre tales gastos a la Contraloría General de la República?', 'Dentro de los cinco (5) días hábiles siguientes al vencimiento de cada trimestre.', 'Dentro de los diez (10) días hábiles siguientes al vencimiento de cada trimestre.', 'Dentro de los quince (15) días hábiles siguientes al vencimiento de cada trimestre.', 'Ninguna de las anteriores.', 'A', 1, '3'),
(162, 'Según el Reglamento de la LOCGRSNCF,  ¿En cuánto tiempo los funcionarios pagadores de gastos destinados a la seguridad y defensa del Estado, darán cuenta al Ministro respectivo sobre la realización de tales pagos?', 'Dentro de los quince (15) días hábiles siguientes a la fecha en que sean efectuados.', 'Dentro de los treinta (30) días hábiles siguientes a la fecha en que sean efectuados.', 'Dentro de los sesenta (60) días hábiles siguientes a la fecha en que sean efectuados.', 'Ninguna de las anteriores.', 'A', 1, '3'),
(163, 'De acuerdo al Reglamento de la LOCGRSNCF, El Contralor General de la Republica podrá intervenir los organos de control fiscal y de los órganos y entidades cuando:', 'Las evaluaciones realizadas no sugiriesen graves irregularidades en el ejercicio de sus funciones', 'Cuando los examenes realizados sugiriesen grave descontrol en el ejercicio de sus funciones.', 'Cuando las evaluaciones preacticadas sugiriesen graves irregularidades en el ejercicio de sus funciones', 'Todas las anteriores', 'C', 1, '3'),
(164, 'De acuerdo al Reglamento de la LOCGRSNCF, la Notificación y publicación de las medidas de intervención seran adoptadas por:', 'El Contralor(a) del Estado, mediante Resolución motivada, sin ser notificado al interesado', 'Por el Contralor General de la Repúlica, mediante resolución motivada que será notificada al interesado, comunicada a las autoridades competentes y publicada en Gaceta Oficial de la República', 'Por el Contralor(a) del Estado, mediante resolución motivada que será notificada al interesado y publicada en Gaceta Oficial de la República', 'Ninguna de las anteriores.', 'B', 1, '3'),
(165, 'Según el Reglamento de la LOCGRSNCF, se entiende por Auto de proceder al:', 'Acto dictado por la autoridad competente que da inicio al procedimiento administrativo para la determinación de responsabilidades', 'Acto dictado por la Autoridad competente a través del cual se formaliza el ejercicio de la potestad investigativa.', 'Acto dictado por la autoridad competente a través del cual se inicia un procedimiento de selección de contratista', 'Ninguna de las anteriores.', 'B', 1, '3'),
(166, 'Según el Reglamento de la LOCGRSNCF, se entiende por Auto de inicio o apertura al:', 'Acto dictado por la autoridad competente a través del cual se inicia un procedimiento de selección de contratista', 'Conjunto de procedimientos ordenados de forma lógica que conducen a la producción de bienes o prestación de servicios.', 'Acto dictado por la autoridad competente que da inicio al procedimiento administrativo para la determinación de responsabilidades', 'Ninguna de las anteriores.', 'C', 1, '3'),
(167, 'De conformidad al Reglamento de la LOCGRSNCF ¿Cuándo podrá ser eleaborado por la dependencia competente del órgano de control fiscal el informe de resultados en la Potestad Investigativa?', 'Dentro de los veinte (20) días hábiles siguientes a la conclusión de la valoración jurídica.', 'Dentro de los quince (15) días hábiles siguientes a la conclusión del lapso probatorio.', 'Dentro de los diez (10) días hábiles siguientes a la conclusión del informe preliminar.', 'Dentro de los diez (10) días continuos siguientes a la conclusión de la auditoría.', 'B', 1, '3'),
(168, 'La ley Contra la Corrupción tiene por objeto', 'Regular la administración financiera.', 'Regular el derecho a la jubilación y pensión de los funcionarios o funcionarias y empleados publicos.', 'Regular las conductas de las personas.', 'El establecimiento de normas que rijan la conducta que deben asumir las personas sujetas a la misma, a los fines de salvaguardar el patrimonio publico.', 'D', 1, '3'),
(169, 'Según lo señalado en la Ley Contra la Corrupción, y sin perjuicio de las demás sanciones que sean procedentes, se suspenderá sin goce de sueldo por un lapso de hasta doce (12) meses a:', 'El funcionario que no presente la DJP hasta tanto demuestre que dió cumplimiento a la obligación.', 'El funcionario público que no suministre los documentos que exija la CGR, en la auditoría patrimonial.', 'El funcionario que de algún modo obstaculice o entrabe la práctica de alguna diligencia que deba efectuarse con motivo de la auditoría patrimonial.', 'Todas las anteriores.', 'D', 1, '3'),
(170, 'De acuerdo a lo establecido en la Ley contra la Corrupción, serán penados  con prisión de tres (3) meses a un (1) año los funcionarios públicos que :', 'Por si o interpuesta  persona se procuren alguna utilidad, ventaja o beneficio económico con acasión de las faltas administrativas previstas en el art 95 de la LOCGRSNCF.', 'Por si o interpuesta  persona se procuren alguna utilidad, ventaja o beneficio económico con acasión de las faltas administrativas previstas en el art 94 de la LOCGRSNCF.', 'Ordenen pagos por obras o servicios  realizados.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(171, 'Según la Ley Contra la Corrupción, ¿El funcionario o empleado público que haya sido condenado por cualesquiera de los delitos establecido en la presente Ley  quedará:', 'Inhabilitado para el ejecicio de la función pública, durante un periodod de dos (2) años y  no podrá Optar a cargo de elección popular o a cargos públicos alguno durante ese período.', 'Inhabilitado para el ejecicio de la función pública, durante un periodod de tres (3) años y  no podrá Optar a cargo de elección popular o a cargos públicos alguno durante ese período.', 'Inhabilitado para el ejecicio de la función pública, no podrá Optar a cargo de elección popular o a cargos públicos alguno, a partir del cumplimiento de la condena y hasta por cinco (5) años.', 'Ninguna de las anteriores.', 'C', 1, '3'),
(172, 'De acuerdo a lo establecido en la Ley Contra la Corrupción, el funcionario público que arbitrariamente exija o cobre algún impuesto o tasa, o que aún siendo legal, emplee para su cobranza medios no autorizados por la ley será penado con prisión:', 'De un (1) mes a un (1) año y multa de hasta el veinte por ciento  (20%) de lo cobrado o exigido.', 'De un (1) mes a dos (2) años y multa de hasta el veinte y cinco por ciento (25%) de lo cobrado o exigido.', 'De dos (2) mes a dos (2) años y multa de hasta el veinte por ciento (20%) de lo cobrado o exigido.', 'Ninguna de las anteriores.', 'A', 1, '3'),
(173, 'De acuerdo a lo establecido en la Ley de Contrataciones Públicas, Todos los documentos, informes, opiniones y demás actos que se reciban, generen o consideren en cada modalidad  de selección de contratistasdeben formar parte de :', 'Dos (2) expediente por cada contratación.', 'Debe ser archivado por la unidad técnica administrativa del organo o ente contratante.', 'De un (1) expediente por cada contratación y archivado por la unidad administrativa del órgano o ente contratante', 'Ninguna de la anteriores.', 'C', 1, '3'),
(174, 'De conformidad con lo establecido en la Ley de Contrataciones públicas, puede procederse por concurso cerrado independientemente del monto de la contratación, cuando la máxima autoridad del órgano o ente contratante, mediante acto motivado justifique:', 'Si se trata de la adquisición de equipos altamente especializados destinados a la experimentación, investigación y educación.', 'Por razones de seguridad del Estado, calificada como tales, conforme a las disposiciones legales que regule la materia', 'Cuando de la información verificada en los archivos o base de datos suministrados por RNC, los bienes a adquirir los producen o venden cinco o menos fabricantes o proveedores.', 'Todas las anteriores.', 'D', 1, '3'),
(175, 'De acuerdo a lo establecido en la Ley de Contrataciones Públicas,¿El Servicio Nacional de Contrataciones  es un órgano:', 'Desconcentrado dependiente funcional.', 'Concentrado dependiente funcional y administrativa de la Comisión Contratante.', 'Desconcentrado dependiente funcional de la Comisión Central de Planificación', 'Ninguna de la anteriores.', 'C', 1, '3'),
(176, 'De conformidad con lo establecido en la Ley de Contrataciones públicas, el pliego de condiciones debe contener al  menos determinación clara y precisa de', 'Criterios de calificación, su ponderación y la forma en que se cuantificarán dichos críterios.', 'Establecimiento del compromiso de responsabilidad social', 'Modelo de maifestación de voluntad, oferta y garantías', 'Todas las anteriores.', 'D', 1, '3'),
(177, 'Según la Ley de contrataciones Públicas, Quedan excluidos solo de la aplicación de las modalidades de selección de contratistas, los contratos que tengan por objetos', 'La prestación de servicios profesionales y laborales', 'La adquisición de obras artisticas, literarias o cientificas.', 'La prestación de servicios financieros y por entidades  regida por la ley sobre la materia', 'Todas las anteriores', 'D', 1, '3'),
(178, 'De conformidad con la Ley de Contrataciones Públicas, en cualquiera de las modalidades ¿Cuándo el órgano o ente contratante podrá suspender mediante acto motivado el procedimiento de contratación?', 'En cualquier momento.', 'Luego de haber adjudicado el procedimiento y haber firmado el contrato definitivo.', 'Antes de que tenga lugar la apertura de sobres contentivos de las manifestaciones de voluntad u ofertas.', 'Todas las anteriores.', 'C', 1, '3'),
(179, 'De conformidad con lo establecido en la Ley de Contrataciones públicas,el pliego de condiciones debe contener al  menos determinación clara y precisa de:', 'Criterios de calificación, su ponderación y la forma en que se cuantificarán dichos críterios.', 'Establecimiento del compromiso de responsabilidad civil.', 'El lapso y lugar en que los participantes podrán solicitar aclaratoria del pliego a la Unidad Contratante.', 'Todas las anteriores.', 'A', 1, '3'),
(180, 'De acuerdo a lo establecido en la Ley de Contrataciones Públicas,¿Cuáles de los siguientes, en el proceso posterior  del examen de evaluación son causales de supuestos rechazo de oferta? :', 'Que se presente sin el compromiso de responsabilidad.', 'Que suministre información falsa.', 'Que Tengan Omisiones o desviaciones sustanciales a los requisitos exigidos en el pliego de condiciones.', 'Todas las anteriores.', 'D', 1, '3'),
(181, 'De acuerdo a lo establecido en la LOCGRSNCF, sin perjuicio de la responsabilidad civil o penal  ¿Cuál de los siguientes actos constituye un supuesto generador de responsabilidad administrativa?', 'La celebración de contratos por funcionarios públicos, por interpuesta persona  con los entes del Poder Público Nacional.', 'El no haber exigido garantía a quien deba prestarla o haberla aceptado insuficientemente.', 'Autorizar gastos en celebraciones y agasajos que no se correspondan con las necesidades estrictamente protocolares del organismo.', 'Todas las anteriores.', 'D', 1, '3'),
(182, 'Sin perjuicio de lo establecido en la LOCGRSNCF, ¿Qué objetivo persigue el Sistema Nacional de Control Fiscal?', 'Fortalecer la capacidad  del Estado para ejecutar eficazmente su función de gobierno.', 'Lograr la transparencia y la eficiencia en el manejo de los recursos del sector público.', 'Establecer la responsabilidad por la comisión de irregularidades relacionadas con la gestión de los órganos del Poder Público Nacional.', 'Todas las anteriores.', 'D', 1, '3'),
(183, 'Conforme a lo establecido en la Ley Organica de los Consejos Comunales, ¿De dónde los Consejos Comunales podrán recibir de manera directa recursos finacieros?', 'Los que provengan de la administración  de los servicios públicos que le sean transferidos por el estado.', 'Los que sean transferidos por la República, los estados y los municipios.', 'Los generados por su actividad propia, incluido el producto del manejo financiero de todos sus recursos', 'Todas las anteriores.', 'D', 1, '3'),
(184, 'De conformidad con lo previsto en la Ley Orgánica de los Consejos Comunales, ¿Qué se entiende por colectivo de coordinación comunitaria?', 'Es la máxima instancia de liberación y decisión para el ejercicio del poder comunitario.', 'Es la instancia de articulación, trabajo conjunto y funcionamiento, conformado por los voceros y voceras de la Unidad Ejecutiva y Financiera Comunitaria y Unidad de Contraloría Social del Consejo comunal.', 'Es la instancia conformada por un grupo de ciudadanos y ciudadanas que asume la iniciativa de difundir , promover e informar la organización de su comunidad a los efectos de la constitución del Consejo comunal.', 'Todas las anteriores.', 'B', 1, '3'),
(185, 'En concordancia con lo expuesto en la Ley Orgánica de los Consejos Comunales, ¿Cómo se constituye el fondo de acción social para cubrir las necesidades sociales?', 'Mediante los intereses anuales cobrados de los créditos otorgados con recursos retornables del finciamiento.', 'Mediante los ingresos por concepto de los intereses y excedentes devengados de los recursos de inversión social no retornables.', 'Por medio de los recursos generados de la autogestión comunitaria', 'Todas las anteriores.', 'D', 1, '3'),
(186, 'De conformidad a lo pautado en la Ley Organica de los Consejos Comunales, ¿Qué se entiende por Ciclo Comunal?', 'A las acciones que exigen el cumplimiento de los objetivos y metas, aprobados por la Asamblea de Ciudadanos y Ciudadanas, de cada una de las unidades de trabajo que integran el consejo comunal.', 'Al proceso para hacer efectiva la participación popular y la planificación participativa que responde a las necesidades comunitarias y contribuye a su desarrollo', 'Al conjunto de actividades concretas orientadas a lograr uno o varios objetivos, para dar respuesta a las necesidades, aspiraciones y potecialidades de las comunidades.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(187, 'Según la Ley Orgánica de los Consejos Comunales, ¿En qué caso el Ministerio del Poder Popular con competencia en materia de participación ciudadana, podrá abstenerse de registrar un consejo comunal?', 'Cuando tenga por objeto finalidades distintas a las previstas en la presente ley.', 'Si no se acompañan los documentos exigidos en la presente Ley o si éstos presentan alguna deficiencia u omisión.', 'Si el Consejo Comunal no se ha constituido con la determinación exacta del ámbito geográfico o si dentro de éste ya existiere registrado un consejo comunal.', 'Todas las anteriores.', 'D', 1, '3'),
(188, 'Según la Ley Orgánica de los Consejos Comunales, a los fines de su funcionamiento debe estar integrado por', 'La Unidad de Contraloría Social.', 'La Unidad Ejecutiva.', 'La Asamblea de Ciudadanos y Ciudadanas del Consejo comunal.', 'Todas las anteriores', 'D', 1, '2'),
(189, 'Según lo establecido en la Ley Orgánica de los Consejos Comunales, ¿Qué atribución tendrá el Ministerio del Poder Popular con competencia en materia de participación ciudadana?', 'Prestar asistencia técnica en proceso del ciclo comunal.', 'El registro de los consejos comunales y la emisión del certificado correspondiente.', 'Diseñar y  coordinar  el sistema de información comunitario y los procedimientos referidos a la organización y desarrollo de los consejos comunales.', 'Todas las anteriores', 'D', 1, '3'),
(190, 'Según lo señalado en  la Ley Orgánica de los Consejos Comunales, ¿Cuál es el quórum que se necesita en la Asamblea de Ciudadanos y Ciudadanas para revocar un vocero del Consejo Comunal?', 'El treinta por ciento (30%) de la población mayor de quince (15) años de esa comunidad.', 'El veinte por ciento (20%) de la población mayor de quince (15) años de esa comunidad', 'El veinticinco por ciento (25%) de la población mayor de quince (15) años de esa comunidad.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(191, 'Según la Ley Orgánica del Poder Público Municipal, las parroquias y las otras entidades locales dentro del territorio municipal, sólo podrán ser creadas mediante ordenanza aprobada con una votación de:', 'La cuarta (1/4) parte como mínimo de los integrantes del Concejo Municipal.', 'Las tres cuartas (3/4) partes como mínimo de los integrantes del Concejo Municipal.', 'El cincuenta por ciento (50%), como mínimo de los integrantes del Concejo Municipal.', 'La mayoría absoluta como mínimo de los integrantes del Concejo Municipal.', 'B', 1, '3'),
(192, 'La Ley Orgánica del Poder Público Municipal señala, que el alcalde o alcaldesa es la primera autoridad civil y política en la jurisdicción municipal, y que además es:', 'Jefe del ejecutivo del Municipio.', 'Primera autoridad de la policía municipal.', 'Representante legal de la entidad municipal.', 'Todas las anteriores.', 'D', 1, '3'),
(193, 'Según la Ley Orgánica del Poder Público Municipal, ¿Qué funciones tendrá el sistema intermunicipal de recursos humanos?', 'Evitar las demandas realizadas por las personas a la alcaldia.', 'Facilitar el despido de las personas que trabajen en los organismos municipales.', 'Promover el desarrollo de carrera de los funcionarios municipales.', 'Todas las anteriores.', 'C', 1, '3'),
(194, 'Señala la Ley Orgánica del Poder Público Municipal,  para crear una parroquia u otra de las entidades locales dentro del Municipio, se requiere que en el territorio correspondiente exista:', 'Un Proyecto de Plan de Desarrollo Urbano.', 'Una población con residencia estable, igual o superior a la exigida en la ley estadal para tales fines.', 'Servicio públicos privatizados.', 'Ninguna de las anteriores.', 'B', 1, '3'),
(195, 'Según la Ley Orgánica del Poder Público Municipal, corresponden al Presidente o Presidenta del Concejo Municipal las atribuciones siguientes:', 'Convocar y dirigir las sesiones del Concejo Municipal y ejercer la representación del mismo.', 'Ejecutar el presupuesto del ejecutivo municipal.', 'Firmar junto al Contralor Municipal las resoluciones emanadas por el Consejo Municipal.', 'Ninguna de las anteriores.', 'A', 1, '3'),
(196, 'Expresa la Ley Orgánica del Poder Público Municipal, son atribuciones del contralor o contralora municipal', 'El control posterior de los organismos y entes descentralizados', 'El control de los resultados de la acción de control financiera  y ejecutiva con que operan las entidades sujetas a su control.', 'Elaborar el proyecto de presupuesto de gastos del Municipio.', 'Elaborar normas para el control del gasto público del ejecutivo municipal.', 'A', 1, '3'),
(197, 'De acuerdo a los pautado en la Ley Orgánica del Poder Público Municipal, ¿Qué funciones cumplirá la Policía Municipal?', 'La protección del medio ambiente y de la salubridad pública.', 'Controlar las estadísticas de población.', 'El control de espectáculos públicos.', 'El transporte y resguardo de sustancias tóxicas.', 'C', 1, '3'),
(198, 'A efectos del  Reglameto de la Ley de Contrataciones Públias, ¿que se entiende por Contrato marco?', 'Contrato mediante el cual se establecen los precios  unitarios de las partidas que conforman la adquisición  de bienes, prestación de servicios, ejecución de obras con un monto total máximo al contrato', 'Contrato mediante el cual se ejecutará por ordenes  de trabajo', 'Contrato mediante el cual se establecerán las condiciones y términos especificos de las cantidades a ejecutar, no existiendo la obligación por parte del örgano o ente contratante', 'Todas las anteriores.', 'D', 1, '3'),
(199, 'De acuerdo al Reglamento de Ccontrataciones Públicas.Por quien serán aprobadas las Alianzas Comerciales  y Estrategicas?', 'Por la Máxima autoridad del órgano o ente contratante.', 'Por la Dirección encargada de realizar la contratación.', 'Por la Direcciones autorizadas de realizar cualquier docmuentación para la contratación.', 'Ninguna de las Anteriores.', 'A', 1, '3'),
(200, 'A efectos del  Reglameto de la Ley de Contrataciones Públias, ¿Que atribuciones tiene la Comisión Comunal de Contrataciones?', 'Velar porque los procedimientos de contratación se realicen de conformidad a lo establecido en la legislación vigente que rige la materia', 'Recibir, abril y analizar o hacer que se analice todos los documentos relativos a la calificación  de oferentes.', 'Determinar las ofertas que en forma integral, resulten más convenientes, de conformidad a lo requisitos establecidos en la Ley de Contrataciones', 'Todas las anteriores.', 'D', 1, '3'),
(201, 'De acuerdo al Reglamento de Contrataciones Públicas. Son causa de falta absoluta de cualesquiera de los miembros de la Comisión de Contrataciones:', 'La suspensión como consecuencia del trámite de un procedimiento disciplinario.', 'El disfrute de vacaciones, reposo médico que no exceden de dos meses', 'cuando la misma sea durante el tiempo previsto, dentro de los lapsos de ejecución de ley', 'Ninguna de las Anteriores.', 'D', 1, '3'),
(202, 'Según el Reglamento de Contrataciones Públicas.El informe de recomendación de la Comisión de Contrataciones a que hace referncia el art. 70 de la Ley de Contrataciones debe contener además:', 'La modalidad de selección aplicada y su objeto', 'La aplicación de medidas de promoción de desarrollo económico, si fuere el caso', 'Lugar y fecha del informe, el cual será firmado por todos los miembros de la comisión y por el Secretario.', 'Ninguna de las anteriores.', 'D', 1, '3'),
(203, 'A efectos del  Reglameto de la Ley de Contrataciones Públias,Son causales de rechazo de las ofertas, además de las establecidas en la Ley de Contrataciones Públicas', 'La Ofertas cuyo período de validez sea menor al requerido.', 'La Ofertas que no estén acompañadas por la documentación exigida en las condiciones de la contratación', 'La Ofertas que presenten datos irregulares o ilógicos, que no permita la ejecución del contrato con el monto de la oferta.', 'Todas las anteriores.', 'D', 1, '3'),
(204, 'De acuerdo al Reglamento de Contrataciones Públicasy Además de lo previsto en el artículo 108 de la Ley de Contrataciones públicas, es causal de modificación del contrato lo siguiente', 'La emisión de ordenes que por su contenido afecten las condiciones del contrato', 'La emisión de resoluciones o reglamentos o decretos que por su contenido afecten las condiciones del contrato', 'Las Ofertas que presenten datos irregulares o ilógicos, que no permita la ejecución del contrato con el monto de la oferta.', 'Ninguna de las Anteriores.', 'B', 1, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE IF NOT EXISTS `resultados` (
  `CodRonda` varchar(1) NOT NULL DEFAULT '',
  `Numero` int(10) unsigned NOT NULL DEFAULT '0',
  `Puntos1` int(10) unsigned NOT NULL DEFAULT '0',
  `Puntos2` int(10) unsigned NOT NULL DEFAULT '0',
  `Puntos3` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`CodRonda`,`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`CodRonda`, `Numero`, `Puntos1`, `Puntos2`, `Puntos3`) VALUES
('1', 1, 4, 1, 0),
('1', 2, 3, 2, 0),
('1', 3, 3, 4, 0),
('1', 4, 3, 2, 0),
('1', 5, 2, 1, 0),
('1', 6, 3, 4, 0),
('2', 1, 7, 6, 0),
('2', 2, 4, 0, 0),
('2', 3, 1, 2, 0),
('3', 1, 6, 7, 7),
('3', 2, 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE IF NOT EXISTS `rondas` (
  `CodRonda` varchar(1) NOT NULL DEFAULT '',
  `Ronda` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`CodRonda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rondas`
--

INSERT INTO `rondas` (`CodRonda`, `Ronda`) VALUES
('1', 'ELIMINATORIA'),
('2', 'SEMI-FINAL'),
('3', 'FINAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `CodRonda` varchar(1) NOT NULL DEFAULT '',
  `Encuentro` int(10) unsigned NOT NULL DEFAULT '0',
  `Turno` varchar(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`CodRonda`,`Encuentro`,`Turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`CodRonda`, `Encuentro`, `Turno`) VALUES
('3', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
  `Equipo1` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo2` int(10) unsigned NOT NULL DEFAULT '0',
  `Equipo3` int(10) unsigned NOT NULL DEFAULT '0',
  `CodRonda` varchar(1) NOT NULL DEFAULT '',
  `Encuentro` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Encuentro`,`CodRonda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`Equipo1`, `Equipo2`, `Equipo3`, `CodRonda`, `Encuentro`) VALUES
(4, 4, 0, '1', 1),
(8, 8, 0, '2', 1),
(7, 7, 7, '3', 1),
(4, 4, 0, '1', 2),
(4, 4, 0, '2', 2),
(2, 2, 0, '3', 2),
(4, 4, 0, '1', 3),
(4, 4, 0, '2', 3),
(4, 4, 0, '1', 4),
(4, 4, 0, '1', 5),
(4, 4, 0, '1', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
