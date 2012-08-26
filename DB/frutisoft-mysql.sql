-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-08-2012 a las 21:56:29
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `frutisoft`
--
CREATE DATABASE IF NOT EXISTS `frutisoft` ;

USE `frutisoft`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CARGOS`
--

CREATE TABLE IF NOT EXISTS `CARGOS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `CARGOS`
--

INSERT INTO `CARGOS` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Ingeniero AgrÃ³nomo'),
(3, 'TÃ©cnico Agropecuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CUIDADOS`
--

CREATE TABLE IF NOT EXISTS `CUIDADOS` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_programada` date NOT NULL,
  `cantidad` decimal(12,2) DEFAULT NULL,
  `fecha_aplicacion` date DEFAULT NULL,
  `plan_de_cultivo` int(10) NOT NULL,
  `estado` int(2) NOT NULL,
  `tipo_cuidado` int(2) NOT NULL,
  `tipo_abono` int(2) DEFAULT NULL,
  `tipo_fumigacion` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`,`plan_de_cultivo`),
  KEY `FK_CUIDADO_ESTADO_C` (`estado`),
  KEY `FK_CUIDADO_TIPO_ABONO` (`tipo_abono`),
  KEY `FK_CUIDADO_TIPO_C` (`tipo_cuidado`),
  KEY `FK_CUIDADO_TIPO_FUMIGACION` (`tipo_fumigacion`),
  KEY `FK_P_CULTIVO_T_CUIDADO` (`plan_de_cultivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMPLEADOS`
--

CREATE TABLE IF NOT EXISTS `EMPLEADOS` (
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `salario` decimal(12,2) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `cargo` int(2) NOT NULL,
  PRIMARY KEY (`identificacion`),
  KEY `FK_EMPLEADO_CARGO` (`cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `EMPLEADOS`
--

INSERT INTO `EMPLEADOS` (`identificacion`, `nombre`, `salario`, `email`, `telefono`, `cargo`) VALUES
('1128427130', 'L Cosmos Osorno', 3000000.00, 'lkosmos@gmail.com', '121212', 1),
('123', 'Juan Carlos Orozco', 2500000.50, 'juanco@gmail.com', '312249695', 1),
('1234', 'SofÃ­a', 3400000.00, 'sofiam11@hotmail.com', '312045692', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ENCARGADOS`
--

CREATE TABLE IF NOT EXISTS `ENCARGADOS` (
  `identificacion` varchar(15) NOT NULL,
  `plan_de_cultivo` int(10) NOT NULL,
  PRIMARY KEY (`plan_de_cultivo`,`identificacion`),
  KEY `FK_EMPLEADO_ENCARGADO` (`identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADOS_PLANES_CULTIVO`
--

CREATE TABLE IF NOT EXISTS `ESTADOS_PLANES_CULTIVO` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO_CUIDADOS`
--

CREATE TABLE IF NOT EXISTS `ESTADO_CUIDADOS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ESTADO_CUIDADOS`
--

INSERT INTO `ESTADO_CUIDADOS` (`id`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO_HECTAREAS`
--

CREATE TABLE IF NOT EXISTS `ESTADO_HECTAREAS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ESTADO_HECTAREAS`
--

INSERT INTO `ESTADO_HECTAREAS` (`id`, `nombre`) VALUES
(1, 'Sin preparación'),
(2, 'Disponible'),
(3, 'Ocupada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO_PEDIDOS`
--

CREATE TABLE IF NOT EXISTS `ESTADO_PEDIDOS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `ESTADO_PEDIDOS`
--

INSERT INTO `ESTADO_PEDIDOS` (`id`, `nombre`) VALUES
(1, 'En espera'),
(2, 'En progreso'),
(11, 'Cancelado'),
(12, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FINCAS`
--

CREATE TABLE IF NOT EXISTS `FINCAS` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `identificacion` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FINCA__IDX` (`identificacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `FINCAS`
--

INSERT INTO `FINCAS` (`id`, `nombre`, `ubicacion`, `telefono`, `identificacion`) VALUES
(1, 'Manuelita', 'Santa fÃ© de Antioquia', NULL, '123'),
(8, 'Cosmos', 'San JerÃ³nimo', '2394056', NULL),
(14, 'Casa Blanca', 'SopetrÃ¡n', '', '1128427130');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HECTAREAS`
--

CREATE TABLE IF NOT EXISTS `HECTAREAS` (
  `id` int(4) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `estado` int(2) NOT NULL,
  `finca` int(3) NOT NULL,
  PRIMARY KEY (`finca`,`id`),
  KEY `FK_ESTADO_HECTAREA` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `HECTAREAS`
--

INSERT INTO `HECTAREAS` (`id`, `ubicacion`, `estado`, `finca`) VALUES
(1, 'Zona 1', 1, 1),
(2, 'Zona 1', 1, 1),
(3, 'Zona 2', 1, 1),
(4, 'Zona 3', 2, 1),
(1, NULL, 1, 8),
(2, NULL, 1, 8),
(3, NULL, 1, 8),
(4, NULL, 1, 8),
(5, NULL, 1, 8),
(6, NULL, 1, 8),
(1, NULL, 1, 14),
(2, NULL, 1, 14),
(3, NULL, 1, 14),
(4, NULL, 1, 14),
(5, NULL, 1, 14),
(6, NULL, 1, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HECTAREAS_X_PLAN_CULTIVO`
--

CREATE TABLE IF NOT EXISTS `HECTAREAS_X_PLAN_CULTIVO` (
  `plan_de_cultivo` int(10) NOT NULL,
  `hectarea` int(4) NOT NULL,
  `finca` int(3) NOT NULL,
  PRIMARY KEY (`finca`,`plan_de_cultivo`,`hectarea`),
  KEY `FK_PLAN_CULTIVO_X` (`plan_de_cultivo`),
  KEY `FK_HECTAREA_X` (`finca`,`hectarea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INFORMES_REVISIONES`
--

CREATE TABLE IF NOT EXISTS `INFORMES_REVISIONES` (
  `numero` int(10) NOT NULL,
  `estado_cultivo` varchar(255) DEFAULT NULL,
  `porcentaje_plaga` decimal(4,2) DEFAULT NULL,
  `fecha_informe` date DEFAULT NULL,
  `identificacion` varchar(15) DEFAULT NULL,
  `id_cuidado` int(10) NOT NULL,
  `plan_de_cultivo` int(10) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_CUIDADO_REVISION` (`id_cuidado`,`plan_de_cultivo`),
  KEY `FK_ENCARGADO_REVISION` (`identificacion`,`plan_de_cultivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PEDIDOS`
--

CREATE TABLE IF NOT EXISTS `PEDIDOS` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(6,2) NOT NULL,
  `fecha_realizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_esperada` date NOT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `estado` int(2) NOT NULL DEFAULT '1',
  `producto` int(3) NOT NULL,
  `finca` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ESTADO_PEDIDO` (`estado`),
  KEY `FK_FINCA_PEDIDO` (`finca`),
  KEY `FK_PRODUCTO_PEDIDO` (`producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `PEDIDOS`
--

INSERT INTO `PEDIDOS` (`id`, `cantidad`, `fecha_realizacion`, `fecha_esperada`, `fecha_entrega`, `estado`, `producto`, `finca`) VALUES
(1, 10.00, '2012-08-10 02:18:37', '2012-09-01', NULL, 1, 1, 1),
(7, 44.00, '2012-08-12 22:35:14', '2012-08-17', NULL, 1, 3, 1),
(8, 44.00, '2012-08-12 22:35:26', '2012-08-21', NULL, 1, 2, 1),
(9, 4.00, '2012-08-12 22:48:19', '2012-08-22', NULL, 1, 1, 1),
(11, 30.00, '2012-08-12 23:42:14', '2012-10-17', NULL, 1, 3, 1),
(12, 55.07, '2012-08-13 03:07:45', '2012-11-21', NULL, 1, 1, 1),
(13, 55.55, '2012-08-13 03:07:59', '2012-08-30', NULL, 1, 1, 1),
(14, 44.58, '2012-08-13 03:11:34', '2012-08-29', NULL, 1, 2, 1),
(15, 55.00, '2012-08-13 03:49:14', '2012-08-20', NULL, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PLAGAS`
--

CREATE TABLE IF NOT EXISTS `PLAGAS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PLAGAS_AFECTADAS`
--

CREATE TABLE IF NOT EXISTS `PLAGAS_AFECTADAS` (
  `tipo_fumigacion` int(2) NOT NULL,
  `plaga` int(2) NOT NULL,
  PRIMARY KEY (`tipo_fumigacion`,`plaga`),
  KEY `FK_PLAGA_PLAGA_AFECT` (`plaga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PLANES_DE_CULTIVO`
--

CREATE TABLE IF NOT EXISTS `PLANES_DE_CULTIVO` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `estado` int(2) NOT NULL,
  `pedido` int(10) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` decimal(12,2) DEFAULT NULL,
  `fecha_cosecha` date DEFAULT NULL,
  `identificacion` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_EMPLEADO_P_CULTIVO` (`identificacion`),
  KEY `FK_ESTADO_PLAN_CULTIVO` (`estado`),
  KEY `FK_PEDIDO_PLAN_CULTIVO` (`pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRODUCTOS`
--

CREATE TABLE IF NOT EXISTS `PRODUCTOS` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `PRODUCTOS`
--

INSERT INTO `PRODUCTOS` (`id`, `nombre`) VALUES
(1, 'Tomate de Ã¡rbol'),
(2, 'Guayaba'),
(3, 'Aguacate'),
(11, 'Banano'),
(12, 'MaracuyÃ¡');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_ABONOS`
--

CREATE TABLE IF NOT EXISTS `TIPO_ABONOS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `TIPO_ABONOS`
--

INSERT INTO `TIPO_ABONOS` (`id`, `nombre`) VALUES
(1, 'Boñiga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_CUIDADOS`
--

CREATE TABLE IF NOT EXISTS `TIPO_CUIDADOS` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_FUMIGACIONES`
--

CREATE TABLE IF NOT EXISTS `TIPO_FUMIGACIONES` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CUIDADOS`
--
ALTER TABLE `CUIDADOS`
  ADD CONSTRAINT `FK_CUIDADO_ESTADO_C` FOREIGN KEY (`estado`) REFERENCES `ESTADO_CUIDADOS` (`id`),
  ADD CONSTRAINT `FK_CUIDADO_TIPO_ABONO` FOREIGN KEY (`tipo_abono`) REFERENCES `TIPO_ABONOS` (`id`),
  ADD CONSTRAINT `FK_CUIDADO_TIPO_C` FOREIGN KEY (`tipo_cuidado`) REFERENCES `TIPO_CUIDADOS` (`id`),
  ADD CONSTRAINT `FK_CUIDADO_TIPO_FUMIGACION` FOREIGN KEY (`tipo_fumigacion`) REFERENCES `TIPO_FUMIGACIONES` (`id`),
  ADD CONSTRAINT `FK_P_CULTIVO_T_CUIDADO` FOREIGN KEY (`plan_de_cultivo`) REFERENCES `PLANES_DE_CULTIVO` (`id`);

--
-- Filtros para la tabla `EMPLEADOS`
--
ALTER TABLE `EMPLEADOS`
  ADD CONSTRAINT `FK_EMPLEADO_CARGO` FOREIGN KEY (`cargo`) REFERENCES `CARGOS` (`id`);

--
-- Filtros para la tabla `ENCARGADOS`
--
ALTER TABLE `ENCARGADOS`
  ADD CONSTRAINT `FK_EMPLEADO_ENCARGADO` FOREIGN KEY (`identificacion`) REFERENCES `EMPLEADOS` (`identificacion`),
  ADD CONSTRAINT `FK_PLAN_CULTIVO_ENCARGADO` FOREIGN KEY (`plan_de_cultivo`) REFERENCES `PLANES_DE_CULTIVO` (`id`);

--
-- Filtros para la tabla `FINCAS`
--
ALTER TABLE `FINCAS`
  ADD CONSTRAINT `FK_EMPLEADO_FINCA` FOREIGN KEY (`identificacion`) REFERENCES `EMPLEADOS` (`identificacion`);

--
-- Filtros para la tabla `HECTAREAS`
--
ALTER TABLE `HECTAREAS`
  ADD CONSTRAINT `FK_ESTADO_HECTAREA` FOREIGN KEY (`estado`) REFERENCES `ESTADO_HECTAREAS` (`id`),
  ADD CONSTRAINT `FK_FINCA_HECTAREA` FOREIGN KEY (`finca`) REFERENCES `FINCAS` (`id`);

--
-- Filtros para la tabla `HECTAREAS_X_PLAN_CULTIVO`
--
ALTER TABLE `HECTAREAS_X_PLAN_CULTIVO`
  ADD CONSTRAINT `FK_HECTAREA_X` FOREIGN KEY (`finca`, `hectarea`) REFERENCES `HECTAREAS` (`finca`, `id`),
  ADD CONSTRAINT `FK_PLAN_CULTIVO_X` FOREIGN KEY (`plan_de_cultivo`) REFERENCES `PLANES_DE_CULTIVO` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `INFORMES_REVISIONES`
--
ALTER TABLE `INFORMES_REVISIONES`
  ADD CONSTRAINT `FK_CUIDADO_REVISION` FOREIGN KEY (`id_cuidado`, `plan_de_cultivo`) REFERENCES `CUIDADOS` (`id`, `plan_de_cultivo`),
  ADD CONSTRAINT `FK_ENCARGADO_REVISION` FOREIGN KEY (`identificacion`, `plan_de_cultivo`) REFERENCES `ENCARGADOS` (`identificacion`, `plan_de_cultivo`);

--
-- Filtros para la tabla `PEDIDOS`
--
ALTER TABLE `PEDIDOS`
  ADD CONSTRAINT `FK_ESTADO_PEDIDO` FOREIGN KEY (`estado`) REFERENCES `ESTADO_PEDIDOS` (`id`),
  ADD CONSTRAINT `FK_FINCA_PEDIDO` FOREIGN KEY (`finca`) REFERENCES `FINCAS` (`id`),
  ADD CONSTRAINT `FK_PRODUCTO_PEDIDO` FOREIGN KEY (`producto`) REFERENCES `PRODUCTOS` (`id`);

--
-- Filtros para la tabla `PLAGAS_AFECTADAS`
--
ALTER TABLE `PLAGAS_AFECTADAS`
  ADD CONSTRAINT `FK_PLAGA_PLAGA_AFECT` FOREIGN KEY (`plaga`) REFERENCES `PLAGAS` (`id`),
  ADD CONSTRAINT `FK_TIPO_FUM_PLAGA` FOREIGN KEY (`tipo_fumigacion`) REFERENCES `TIPO_FUMIGACIONES` (`id`);

--
-- Filtros para la tabla `PLANES_DE_CULTIVO`
--
ALTER TABLE `PLANES_DE_CULTIVO`
  ADD CONSTRAINT `FK_EMPLEADO_P_CULTIVO` FOREIGN KEY (`identificacion`) REFERENCES `EMPLEADOS` (`identificacion`),
  ADD CONSTRAINT `FK_ESTADO_PLAN_CULTIVO` FOREIGN KEY (`estado`) REFERENCES `ESTADOS_PLANES_CULTIVO` (`id`),
  ADD CONSTRAINT `FK_PEDIDO_PLAN_CULTIVO` FOREIGN KEY (`pedido`) REFERENCES `PEDIDOS` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
