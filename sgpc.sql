-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2023 a las 23:35:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgpc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fechaComentario` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL,
  `idProyecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `descripcion`, `fechaComentario`, `idUsuario`, `idTarea`, `idProyecto`) VALUES
(1, 'Comentario 1', '2023-01-05', 1, 1, 1),
(2, 'Comentario 2', '2023-02-10', 2, 2, 2),
(3, 'Comentario 3', '2023-03-15', 3, 3, 3),
(4, 'Comentario 4', '2023-04-20', 4, 4, 4),
(5, 'Comentario 5', '2023-05-25', 5, 5, 5),
(6, 'Comentario 6', '2023-06-30', 6, 6, 6),
(7, 'Comentario 7', '2023-07-05', 7, 7, 7),
(8, 'Comentario 8', '2023-08-10', 8, 8, 8),
(9, 'Comentario 9', '2023-09-15', 9, 9, 9),
(10, 'Comentario 10', '2023-10-20', 10, 10, 10),
(11, 'Comentario 11', '2023-11-25', 11, 11, 11),
(12, 'Comentario 12', '2023-12-30', 12, 12, 12),
(13, 'Comentario 13', '2024-01-05', 13, 13, 13),
(14, 'Comentario 14', '2024-02-10', 14, 14, 14),
(15, 'Comentario 15', '2024-03-15', 15, 15, 15),
(16, 'Comentario 16', '2023-01-15', 1, 16, 1),
(17, 'Comentario 17', '2023-02-20', 2, 17, 2),
(18, 'Comentario 18', '2023-03-25', 3, 18, 3),
(19, 'Comentario 19', '2023-04-30', 4, 19, 4),
(20, 'Comentario 20', '2023-06-05', 5, 20, 5),
(21, 'Comentario 21', '2023-07-10', 6, 21, 6),
(22, 'Comentario 22', '2023-08-15', 7, 22, 7),
(23, 'Comentario 23', '2023-09-20', 8, 23, 8),
(24, 'Comentario 24', '2023-10-25', 9, 24, 9),
(25, 'Comentario 25', '2023-11-30', 10, 25, 10),
(26, 'Comentario 26', '2024-01-05', 11, 26, 11),
(27, 'Comentario 27', '2024-02-10', 12, 27, 12),
(28, 'Comentario 28', '2024-03-15', 13, 28, 13),
(29, 'Comentario 29', '2024-04-20', 14, 29, 14),
(30, 'Comentario 30', '2024-05-25', 15, 30, 15),
(31, 'Comentario 31', '2024-06-01', 1, 1, 1),
(32, 'Comentario 32', '2024-06-02', 2, 2, 2),
(33, 'Comentario 33', '2024-06-03', 3, 3, 3),
(34, 'Comentario 34', '2024-06-04', 4, 4, 4),
(35, 'Comentario 35', '2024-06-05', 5, 5, 5),
(36, 'Comentario 36', '2024-06-06', 6, 6, 6),
(37, 'Comentario 37', '2024-06-07', 7, 7, 7),
(38, 'Comentario 38', '2024-06-08', 8, 8, 8),
(39, 'Comentario 39', '2024-06-09', 9, 9, 9),
(40, 'Comentario 40', '2024-06-10', 10, 10, 10),
(41, 'Comentario 41', '2024-06-11', 11, 11, 11),
(42, 'Comentario 42', '2024-06-12', 12, 12, 12),
(43, 'Comentario 43', '2024-06-13', 13, 13, 13),
(44, 'Comentario 44', '2024-06-14', 14, 14, 14),
(45, 'Comentario 45', '2024-06-15', 15, 15, 15),
(49, 'mmm', '2023-11-20', 3, 17, NULL),
(50, 'gato', '2023-11-20', 3, 17, NULL),
(51, 'gato 2', '2023-11-20', 3, 17, NULL),
(52, 'gato 3', '2023-11-20', 3, 17, NULL),
(53, 'gato 4\r\n', '2023-11-20', 3, 17, NULL),
(54, 'gaton5', '2023-11-20', 3, 17, NULL),
(55, 'gaton6', '2023-11-20', 3, 17, NULL),
(56, 'gaton7', '2023-11-20', 3, 17, NULL),
(57, 'gaton8', '2023-11-20', 3, 17, NULL),
(58, 'gaton9', '2023-11-20', 3, 17, NULL),
(59, 'gaton11', '2023-11-20', 3, 17, NULL),
(60, 'gaton12', '2023-11-20', 3, 17, NULL),
(61, 'gaton13', '2023-11-20', 3, 17, NULL),
(62, 'gaton13', '2023-11-20', 3, 17, NULL),
(63, 'gaton14', '2023-11-20', 3, 17, NULL),
(64, 'gaton15', '2023-11-20', 3, 17, NULL),
(65, 'gato 16', '2023-11-20', 3, 17, NULL),
(66, 'prueba hoy', '2023-11-22', 3, 17, NULL),
(67, 'ksajosajdjd', '2023-11-23', 1, 25, NULL),
(68, 'alkwfwanf', '2023-11-23', 1, 25, NULL),
(69, 'sakjfdsa', '2023-11-23', 2, 25, NULL),
(70, 'ieahufnwf', '2023-11-23', 3, 35, NULL),
(71, 'kasnfjanf\r\n', '2023-11-23', 3, 35, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `codigo` char(5) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`codigo`, `nombre`) VALUES
('ACT', 'Activo'),
('CAN', 'Cancelado'),
('FIN', 'Finalizado'),
('PEN', 'Pendiente'),
('RET', 'Retrasado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificacion`
--

CREATE TABLE `modificacion` (
  `idModificacion` int(11) NOT NULL,
  `descripcionModificacion` varchar(200) DEFAULT NULL,
  `fechaModificacion` date NOT NULL,
  `idProyecto` int(11) DEFAULT NULL,
  `idTarea` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `accion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modificacion`
--

INSERT INTO `modificacion` (`idModificacion`, `descripcionModificacion`, `fechaModificacion`, `idProyecto`, `idTarea`, `idUsuario`, `accion`) VALUES
(1, 'Modificación 1', '2023-01-05', 1, NULL, 1, 'EDITAR'),
(2, 'Modificación 2', '2023-02-10', 2, NULL, 2, 'ELIMINAR'),
(3, 'Modificación 3', '2023-03-15', 3, NULL, 3, 'AGREGAR'),
(4, 'Modificación 4', '2023-04-20', NULL, 4, 4, 'EDITAR'),
(5, 'Modificación 5', '2023-05-25', NULL, 5, 5, 'ELIMINAR'),
(6, 'Modificación 6', '2023-06-30', 6, NULL, 6, 'AGREGAR'),
(7, 'Modificación 7', '2023-07-05', 7, NULL, 7, 'EDITAR'),
(8, 'Modificación 8', '2023-08-10', NULL, 8, 8, 'ELIMINAR'),
(9, 'Modificación 9', '2023-09-15', NULL, 9, 9, 'AGREGAR'),
(10, 'Modificación 10', '2023-10-20', 10, NULL, 10, 'EDITAR'),
(11, 'Modificación 11', '2023-11-25', 11, NULL, 11, 'ELIMINAR'),
(12, 'Modificación 12', '2023-12-30', NULL, 12, 12, 'AGREGAR'),
(13, 'Modificación 13', '2024-01-05', 13, NULL, 13, 'EDITAR'),
(14, 'Modificación 14', '2024-02-10', NULL, 14, 14, 'ELIMINAR'),
(15, 'Modificación 15', '2024-03-15', NULL, 15, 15, 'AGREGAR'),
(16, 'Modificación 16', '2023-01-15', 16, NULL, 1, 'EDITAR'),
(17, 'Modificación 17', '2023-02-20', 17, NULL, 2, 'ELIMINAR'),
(18, 'Modificación 18', '2023-03-25', 18, NULL, 3, 'AGREGAR'),
(19, 'Modificación 19', '2023-04-30', NULL, 19, 4, 'EDITAR'),
(20, 'Modificación 20', '2023-06-05', NULL, 20, 5, 'ELIMINAR'),
(21, 'Modificación 21', '2023-07-10', 21, NULL, 6, 'AGREGAR'),
(22, 'Modificación 22', '2023-08-15', 22, NULL, 7, 'EDITAR'),
(23, 'Modificación 23', '2023-09-20', NULL, 23, 8, 'ELIMINAR'),
(24, 'Modificación 24', '2023-10-25', NULL, 24, 9, 'AGREGAR'),
(25, 'Modificación 25', '2023-11-30', 25, NULL, 10, 'EDITAR'),
(26, 'Modificación 26', '2024-01-05', 26, NULL, 11, 'ELIMINAR'),
(27, 'Modificación 27', '2024-02-10', NULL, 27, 12, 'AGREGAR'),
(28, 'Modificación 28', '2024-03-15', 28, NULL, 13, 'EDITAR'),
(29, 'Modificación 29', '2024-04-20', NULL, 29, 14, 'ELIMINAR'),
(30, 'Modificación 30', '2024-05-25', NULL, 30, 15, 'AGREGAR'),
(31, 'Modificación 31', '2024-06-01', 1, NULL, 1, 'EDITAR'),
(32, 'Modificación 32', '2024-06-02', NULL, 2, 2, 'ELIMINAR'),
(33, 'Modificación 33', '2024-06-03', 3, NULL, 3, 'AGREGAR'),
(34, 'Modificación 34', '2024-06-04', NULL, 4, 4, 'EDITAR'),
(35, 'Modificación 35', '2024-06-05', NULL, 5, 5, 'ELIMINAR'),
(36, 'Modificación 36', '2024-06-06', 6, NULL, 6, 'AGREGAR'),
(37, 'Modificación 37', '2024-06-07', 7, NULL, 7, 'EDITAR'),
(38, 'Modificación 38', '2024-06-08', NULL, 8, 8, 'ELIMINAR'),
(39, 'Modificación 39', '2024-06-09', NULL, 9, 9, 'AGREGAR'),
(40, 'Modificación 40', '2024-06-10', 10, NULL, 10, 'EDITAR'),
(41, 'Modificación 41', '2024-06-11', 11, NULL, 11, 'ELIMINAR'),
(42, 'Modificación 42', '2024-06-12', NULL, 12, 12, 'AGREGAR'),
(43, 'Modificación 43', '2024-06-13', 13, NULL, 13, 'EDITAR'),
(44, 'Modificación 44', '2024-06-14', NULL, 14, 14, 'ELIMINAR'),
(45, 'Modificación 45', '2024-06-15', NULL, 15, 15, 'AGREGAR'),
(46, 'Tarea creada: caja', '2023-11-23', NULL, NULL, 1, 'crear'),
(47, 'Tarea creada: 11', '2023-11-23', NULL, NULL, 1, 'crear'),
(48, 'Tarea \"11\" asignada a Juan', '2023-11-23', NULL, NULL, 1, 'asignar'),
(49, 'Tarea creada: 11', '2023-11-23', NULL, NULL, 1, 'crear'),
(50, 'Tarea \"11\" asignada a Juan', '2023-11-23', NULL, NULL, 1, 'asignar'),
(51, 'Tarea creada: 11', '2023-11-23', NULL, NULL, 1, 'crear'),
(52, 'Tarea \"11\" asignada a Juan', '2023-11-23', NULL, NULL, 1, 'asignar'),
(53, 'Tarea creada: m', '2023-11-23', NULL, NULL, 1, 'crear'),
(54, 'Tarea \"m\" asignada a Carlos', '2023-11-23', NULL, NULL, 1, 'asignar'),
(55, 'El título de la tarea cambió de Tarea 1 a Tarea 11', '2023-11-23', NULL, NULL, 1, 'modificar'),
(56, 'El título de la tarea cambió de Tarea 11 a Tarea 111', '2023-11-23', NULL, NULL, 1, 'modificar'),
(57, 'El título de la tarea cambió de Tarea 111 a Tarea 1112', '2023-11-23', NULL, NULL, 1, 'modificar'),
(58, 'El título de la tarea cambió de Tarea 1112 a Tarea 11125', '2023-11-23', NULL, NULL, 1, 'modificar'),
(59, 'Tarea creada: Tarea carlos', '2023-11-23', NULL, NULL, 1, 'crear'),
(60, 'Tarea \"Tarea carlos\" asignada a Ana', '2023-11-23', NULL, NULL, 1, 'asignar'),
(61, 'La descripción de la tarea cambió de m a islas', '2023-11-23', NULL, NULL, 1, 'modificar'),
(62, 'Proyecto creado: Oxxo', '2023-11-23', 61, NULL, 1, 'crear'),
(63, 'Proyecto creado: djaljfaf', '2023-11-23', 62, NULL, 1, 'crear'),
(64, 'Tarea creada: Pozos', '2023-11-23', NULL, NULL, 1, 'crear'),
(65, 'Tarea \"Pozos\" asignada a Ana', '2023-11-23', NULL, NULL, 1, 'asignar'),
(66, 'Tarea creada: oisanfw', '2023-11-23', NULL, NULL, 1, 'crear'),
(67, 'Tarea \"oisanfw\" asignada a Ana', '2023-11-23', NULL, NULL, 1, 'asignar'),
(68, 'Tarea creada: awknmf', '2023-11-23', NULL, NULL, 1, 'crear'),
(69, 'Tarea \"awknmf\" asignada a Valeria', '2023-11-23', NULL, NULL, 1, 'asignar'),
(70, 'Proyecto creado: SAFSAFA', '2023-11-23', 63, NULL, 1, 'crear'),
(71, 'El estado del proyecto cambió de CAN a FIN', '2023-11-23', 63, NULL, 1, 'modificar'),
(72, 'El estado de la tarea cambió de RET a FIN', '2023-11-23', NULL, NULL, 1, 'modificar'),
(73, 'Proyecto creado: poewfkeamf', '2023-11-23', 64, NULL, 1, 'crear'),
(74, 'Proyecto creado: poewfkeamf', '2023-11-23', 65, NULL, 1, 'crear'),
(75, 'Proyecto creado: poewfkeamf', '2023-11-23', 66, NULL, 1, 'crear'),
(76, 'Proyecto creado: dsleq', '2023-11-23', 67, NULL, 1, 'crear'),
(77, 'Proyecto creado: efm', '2023-11-23', 68, NULL, 1, 'crear'),
(78, 'Proyecto creado: kewqjfoinq', '2023-11-23', 69, NULL, 1, 'crear'),
(79, 'Proyecto creado: oianfeanf', '2023-11-23', 70, NULL, 1, 'crear'),
(80, 'Tarea creada: smflva svl', '2023-11-23', NULL, NULL, 1, 'crear'),
(81, 'Tarea \"smflva svl\" asignada a Alejandro', '2023-11-23', NULL, NULL, 1, 'asignar'),
(82, 'Proyecto creado: mlkea', '2023-11-23', 71, NULL, 1, 'crear'),
(83, 'Proyecto creado: anoqgff', '2023-11-23', 72, NULL, 1, 'crear'),
(84, 'Proyecto creado: anoqgff', '2023-11-23', 73, NULL, 1, 'crear'),
(85, 'Proyecto creado: dsanf', '2023-11-23', 74, NULL, 1, 'crear'),
(86, 'Proyecto creado: jewign', '2023-11-23', 75, NULL, 1, 'crear'),
(87, 'Proyecto creado: muchachoquehace', '2023-11-23', 76, NULL, 1, 'crear'),
(88, 'Proyecto creado: aoijf', '2023-11-23', 77, NULL, 1, 'crear');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idProyecto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `estado` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`idProyecto`, `nombre`, `descripcion`, `ubicacion`, `fechaInicio`, `fechaFinal`, `estado`) VALUES
(1, 'Proyecto A', 'Descripción del Proyecto A', 'Ubicación A', '2023-01-01', '2023-01-22', 'PEN'),
(2, 'Proyecto B', 'Descripción del Proyecto B', 'Ubicación B', '2023-02-01', '2023-04-29', 'RET'),
(3, 'Proyecto C', 'Descripción del Proyecto C', 'Ubicación C', '2023-03-01', '2023-05-01', 'FIN'),
(4, 'Proyecto D', 'Descripción del Proyecto D', 'Ubicación D', '2023-04-01', '2023-06-01', 'RET'),
(5, 'Proyecto E', 'Descripción del Proyecto E', 'Ubicación E', '2023-05-01', '2023-07-01', 'RET'),
(6, 'Proyecto F', 'Descripción del Proyecto F', 'Ubicación F', '2023-06-01', '2023-08-01', 'FIN'),
(7, 'Proyecto G', 'Descripción del Proyecto G', 'Ubicación G', '2023-07-01', '2023-09-01', 'RET'),
(8, 'Proyecto H', 'Descripción del Proyecto H', 'Ubicación H', '2023-08-01', '2023-10-01', 'RET'),
(9, 'Proyecto I', 'Descripción del Proyecto I', 'Ubicación I', '2023-09-01', '2023-11-01', 'FIN'),
(10, 'Proyecto J', 'Descripción del Proyecto J', 'Ubicación J', '2023-10-01', '2023-12-01', 'ACT'),
(11, 'Proyecto K', 'Descripción del Proyecto K', 'Ubicación K', '2023-11-01', '2024-01-01', 'PEN'),
(12, 'Proyecto L', 'Descripción del Proyecto L', 'Ubicación L', '2023-12-01', '2024-02-01', 'FIN'),
(13, 'Proyecto M', 'Descripción del Proyecto M', 'Ubicación M', '2024-01-01', '2024-03-01', 'ACT'),
(14, 'Proyecto N', 'Descripción del Proyecto N', 'Ubicación N', '2024-02-01', '2024-04-01', 'PEN'),
(15, 'Proyecto O', 'Descripción del Proyecto O', 'Ubicación O', '2024-03-01', '2024-05-01', 'FIN'),
(16, 'Proyecto P', 'Descripción del Proyecto P', 'Ubicación P', '2024-04-01', '2024-06-01', 'PEN'),
(17, 'Proyecto Q', 'Descripción del Proyecto Q', 'Ubicación Q', '2024-05-01', '2024-07-01', 'FIN'),
(18, 'Proyecto R', 'Descripción del Proyecto R', 'Ubicación R', '2024-06-01', '2024-08-01', 'ACT'),
(19, 'Proyecto S', 'Descripción del Proyecto S', 'Ubicación S', '2024-07-01', '2024-09-01', 'PEN'),
(20, 'Proyecto T', 'Descripción del Proyecto T', 'Ubicación T', '2024-08-01', '2024-10-01', 'FIN'),
(21, 'Proyecto U', 'Descripción del Proyecto U', 'Ubicación U', '2024-09-01', '2024-11-01', 'ACT'),
(22, 'Proyecto V', 'Descripción del Proyecto V', 'Ubicación V', '2024-10-01', '2024-12-01', 'PEN'),
(23, 'Proyecto W', 'Descripción del Proyecto W', 'Ubicación W', '2024-11-01', '2025-01-01', 'FIN'),
(24, 'Proyecto X', 'Descripción del Proyecto X', 'Ubicación X', '2024-12-01', '2025-02-01', 'ACT'),
(25, 'Proyecto Y', 'Descripción del Proyecto Y', 'Ubicación Y', '2025-01-01', '2025-03-01', 'PEN'),
(26, 'Proyecto Z', 'Descripción del Proyecto Z', 'Ubicación Z', '2025-02-01', '2025-04-01', 'RET'),
(27, 'Proyecto AA', 'Descripción del Proyecto AA', 'Ubicación AA', '2025-03-01', '2025-05-01', 'ACT'),
(28, 'Proyecto BB', 'Descripción del Proyecto BB', 'Ubicación BB', '2025-04-01', '2025-06-01', 'PEN'),
(29, 'Proyecto CC', 'Descripción del Proyecto CC', 'Ubicación CC', '2025-05-01', '2025-07-01', 'FIN'),
(30, 'Proyecto DD', 'Descripción del Proyecto DD', 'Ubicación DD', '2025-06-01', '2025-08-01', 'ACT'),
(31, 'Casa', 'Casa', 'Casa', '2023-11-24', '2023-11-30', 'ACT'),
(32, 'Casa', 'Casa en la playa', 'Rosarito, bc', '2023-11-24', '2023-11-30', 'ACT'),
(33, 'Casa', 'Casa en la playa', 'Rosarito, bc', '2023-11-24', '2023-11-30', 'ACT'),
(34, 'gomita', 'Casa', 'Tijuana', '2023-11-24', '2023-11-30', 'ACT'),
(35, 'goma', 'Casa en la playa', 'Tijuana', '2023-11-25', '2023-11-30', 'ACT'),
(36, 'goma', 'Casa', ',m,m', '2023-11-23', '2023-11-30', 'ACT'),
(37, 'gomita', 'Casa en la playa', 'g', '2023-11-25', '2023-11-29', 'ACT'),
(38, 'Casa', 'Casa', 'g', '2023-11-24', '2023-11-29', 'ACT'),
(39, 'mmm', 'mm', 'mmm', '2023-11-24', '2023-11-30', 'ACT'),
(40, 'Ego', 'ego', 'ego', '2023-11-24', '2023-11-30', 'ACT'),
(41, 'Uno', 'uno', 'uno', '2023-11-24', '2023-11-30', 'ACT'),
(42, 'Prueba', 'prueba', 'prueba', '2023-11-26', '2023-12-29', 'ACT'),
(43, 'Casa', 'ego', ',m,m', '2023-11-25', '2023-11-30', 'ACT'),
(44, 'Casa', 'ego', ',m,m', '2023-11-25', '2023-11-30', 'ACT'),
(45, 'Casa', 'ego', ',m,m', '2023-11-25', '2023-11-30', 'ACT'),
(46, 'goma', 'Casa en la playa', 'Rosarito, bc', '2023-12-08', '2024-01-07', 'ACT'),
(47, 'Casa', 'Casa', 'Tijuana', '2023-11-24', '2023-12-08', 'ACT'),
(48, 'l', 'kjfn', 'kfj', '2023-11-24', '2023-12-08', 'ACT'),
(49, 'nd', 'kjndvv', 'mcf,m', '2023-11-25', '2023-12-09', 'ACT'),
(50, 'Casa', 'Casa en la playa', 'Rosarito, bc', '2023-11-30', '2023-11-30', 'ACT'),
(51, 'Casa Playa', 'ego', 'g', '2023-11-24', '2023-12-08', 'ACT'),
(52, 'oxxo doble', 'construir  un oxxo encima de otro oxxo', 'the moon', '2023-12-15', '2023-12-30', 'ACT'),
(53, 'oxxo dos', 'gato', 'gato', '2023-11-24', '2023-11-24', 'ACT'),
(54, 'Casa', 'Casa', 'Rosarito, bc', '2023-11-24', '2023-12-02', 'ACT'),
(55, 'Casa', 'Casa', 'Rosarito, bc', '2023-11-23', '2023-12-02', 'ACT'),
(56, 'Casa', 'Casa', 'Rosarito, bc', '2023-11-23', '2023-11-23', 'ACT'),
(57, 'gomitas', 'gato', 'g', '2023-11-23', '2023-11-24', 'ACT'),
(58, 'm', ',', ',', '2023-11-25', '2023-12-08', 'ACT'),
(59, 'Casa', 'gato', 'Tijuana', '2023-12-02', '2023-12-07', 'ACT'),
(60, 'kk', 'kmkm', 'mflm', '2023-11-24', '2023-12-08', 'ACT'),
(61, 'Oxxo', 'Construir un oxxo ', 'Calle melozobas', '2023-11-24', '2023-12-08', 'ACT'),
(62, 'djaljfaf', 'iknwifniwaf', 'iwifniwqnf', '2023-11-24', '2023-12-01', 'ACT'),
(63, 'SAFSAFA', 'FDAFDF', 'DSFaf', '2023-11-24', '2023-12-01', 'FIN'),
(64, 'poewfkeamf', 'ngewqpg', 'jenfoiqef', '2023-11-24', '2023-12-09', 'ACT'),
(65, 'poewfkeamf', 'ngewqpg', 'jenfoiqef', '2023-11-24', '2023-12-09', 'ACT'),
(66, 'poewfkeamf', 'ngewqpg', 'jenfoiqef', '2023-11-24', '2023-12-09', 'ACT'),
(67, 'dsleq', 'nfkjewqf', 'nfkin', '2023-11-25', '2023-12-08', 'ACT'),
(68, 'efm', 'owmfnpewq', 'owmfpwqfom', '2023-11-24', '2023-12-08', 'ACT'),
(69, 'kewqjfoinq', 'qfniewqn', 'oiwqnfoiwqf', '2023-11-25', '2023-11-30', 'ACT'),
(70, 'oianfeanf', 'engfjewng', 'kengqn', '2023-11-24', '2023-12-08', 'ACT'),
(71, 'mlkea', 'mfwafm', 'saooa', '2023-11-24', '2023-12-01', 'ACT'),
(72, 'anoqgff', 'knewlkfewq', 'pkewmfnmpi', '2023-12-01', '2023-12-02', 'ACT'),
(73, 'anoqgff', 'knewlkfewq', 'pkewmfnmpi', '2023-12-01', '2023-12-02', 'ACT'),
(74, 'dsanf', 'lkjenfokjeqn', 'wkegn', '2023-11-29', '2023-12-07', 'ACT'),
(75, 'jewign', 'ewifqoif', 'wofiqo', '2023-12-09', '2024-01-05', 'ACT'),
(76, 'muchachoquehace', 'ewqnmf', 'Calle melozo', '2023-11-30', '2023-12-02', 'ACT'),
(77, 'aoijf', 'poiejfoi', 'oefpoiq', '2023-11-25', '2023-11-30', 'ACT');

--
-- Disparadores `proyecto`
--
DELIMITER $$
CREATE TRIGGER `ProyectoCreado` AFTER INSERT ON `proyecto` FOR EACH ROW BEGIN
    INSERT INTO Modificacion (
        descripcionModificacion,
        fechaModificacion,
        idProyecto,
        idUsuario,
        accion
    )
    VALUES (
        CONCAT('Proyecto creado: ', NEW.nombre), 
        CURDATE(), 
        NEW.idProyecto,
        1, 
        'crear'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ProyectoModificado` AFTER UPDATE ON `proyecto` FOR EACH ROW BEGIN
    IF OLD.nombre <> NEW.nombre THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion)
        VALUES (CONCAT('El nombre del proyecto cambió de ', OLD.nombre, ' a ', NEW.nombre), CURDATE(), NEW.idProyecto, 1, 'modificar');
    END IF;
    IF OLD.descripcion <> NEW.descripcion THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion)
        VALUES (CONCAT('La descripción del proyecto cambió de ', OLD.descripcion, ' a ', NEW.descripcion), CURDATE(), NEW.idProyecto, 1, 'modificar');
    END IF;
    IF OLD.ubicacion <> NEW.ubicacion THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion)
        VALUES (CONCAT('La ubicación del proyecto cambió de ', OLD.ubicacion, ' a ', NEW.ubicacion), CURDATE(), NEW.idProyecto, 1, 'modificar');
    END IF;
    IF OLD.fechaInicio <> NEW.fechaInicio THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion)
        VALUES (CONCAT('La fecha de inicio cambió de ', OLD.fechaInicio, ' a ', NEW.fechaInicio), CURDATE(), NEW.idProyecto, 1, 'modificar');
    END IF;
    IF OLD.fechaFinal <> NEW.fechaFinal THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion)
        VALUES (CONCAT('La fecha de finalización cambió de ', OLD.fechaFinal, ' a ', NEW.fechaFinal), CURDATE(), NEW.idProyecto, 1, 'modificar');
    END IF;
    IF OLD.estado <> NEW.estado THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion)
        VALUES (CONCAT('El estado del proyecto cambió de ', OLD.estado, ' a ', NEW.estado), CURDATE(), NEW.idProyecto, 1, 'modificar');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectotarea`
--

CREATE TABLE `proyectotarea` (
  `idProyecto` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectotarea`
--

INSERT INTO `proyectotarea` (`idProyecto`, `idTarea`, `fechaInicio`, `fechaFinal`) VALUES
(1, 1, '2023-01-01', '2023-01-27'),
(1, 16, '2023-01-10', '2023-01-20'),
(1, 17, '2024-04-15', '2024-04-25'),
(1, 18, '2024-04-20', '2024-04-30'),
(1, 73, '2023-12-01', '2023-12-09'),
(1, 74, '2023-11-24', '2023-11-25'),
(1, 75, '2023-11-24', '2023-11-25'),
(1, 76, '2023-11-24', '2023-11-25'),
(1, 77, '2023-12-03', '2023-12-08'),
(2, 2, '2023-02-01', '2023-02-10'),
(2, 17, '2023-02-10', '2023-02-20'),
(2, 19, '2024-05-15', '2024-05-25'),
(2, 20, '2024-05-20', '2024-05-30'),
(2, 31, '2023-04-20', '2023-05-12'),
(2, 32, '2023-04-20', '2023-09-12'),
(2, 33, '2023-04-20', '2023-10-12'),
(2, 34, '2023-04-20', '2023-11-17'),
(2, 35, '2023-04-20', '2023-11-18'),
(2, 49, '2023-11-24', '2023-12-09'),
(2, 56, '2023-11-17', '2023-12-05'),
(2, 57, '2023-11-17', '2023-12-05'),
(2, 58, '2023-02-11', '2023-03-10'),
(2, 78, '2023-12-01', '2023-12-08'),
(3, 3, '2023-03-01', '2023-03-10'),
(3, 18, '2023-03-10', '2023-03-20'),
(3, 21, '2024-06-15', '2024-06-25'),
(3, 22, '2024-06-20', '2024-06-30'),
(3, 59, '2023-03-10', '2023-04-13'),
(3, 60, '2023-03-10', '2023-04-13'),
(3, 61, '2023-03-10', '2023-04-13'),
(3, 62, '2023-03-10', '2023-04-13'),
(3, 63, '2023-03-10', '2023-04-13'),
(3, 64, '2023-03-10', '2023-04-13'),
(3, 65, '2023-04-14', '2023-04-07'),
(4, 4, '2023-04-01', '2023-04-10'),
(4, 19, '2023-04-10', '2023-04-20'),
(4, 23, '2024-07-15', '2024-07-25'),
(4, 24, '2024-07-20', '2024-07-30'),
(4, 66, '2023-04-21', '2023-05-10'),
(5, 5, '2023-05-01', '2023-05-10'),
(5, 20, '2023-05-10', '2023-05-20'),
(5, 25, '2024-08-15', '2024-08-25'),
(5, 26, '2024-08-20', '2024-08-30'),
(5, 70, '2023-05-19', '2023-06-08'),
(6, 6, '2023-06-01', '2023-06-10'),
(6, 21, '2023-06-10', '2023-06-20'),
(6, 27, '2024-09-15', '2024-09-25'),
(6, 28, '2024-09-20', '2024-09-30'),
(7, 7, '2023-07-01', '2023-07-10'),
(7, 22, '2023-07-10', '2023-07-20'),
(7, 29, '2024-10-15', '2024-10-25'),
(7, 30, '2024-10-20', '2024-10-30'),
(8, 8, '2023-08-01', '2023-08-10'),
(8, 16, '2024-11-15', '2024-11-25'),
(8, 23, '2023-08-10', '2023-08-20'),
(9, 9, '2023-09-01', '2023-09-10'),
(9, 24, '2023-09-10', '2023-09-20'),
(10, 10, '2023-10-01', '2023-10-10'),
(10, 25, '2023-10-10', '2023-10-20'),
(11, 11, '2023-11-01', '2023-11-10'),
(11, 26, '2023-11-10', '2023-11-20'),
(12, 12, '2023-12-01', '2023-12-10'),
(12, 27, '2023-12-10', '2023-12-20'),
(13, 13, '2024-01-01', '2024-01-10'),
(13, 28, '2024-01-10', '2024-01-20'),
(14, 14, '2024-02-01', '2024-02-10'),
(14, 29, '2024-02-10', '2024-02-20'),
(15, 15, '2024-03-01', '2024-03-10'),
(15, 30, '2024-03-10', '2024-03-20'),
(40, 36, '2023-11-23', '2023-11-30'),
(42, 37, '2023-12-23', '2023-11-30'),
(45, 38, '2023-12-01', '2023-12-08'),
(45, 39, '2023-11-30', '2023-12-08'),
(45, 40, '2023-12-02', '2023-12-07'),
(46, 41, '2023-11-30', '2023-12-09'),
(46, 42, '2023-12-09', '2023-12-10'),
(48, 46, '2023-11-30', '2023-12-09'),
(48, 47, '2023-11-30', '2023-12-09'),
(49, 48, '2023-11-24', '2023-12-07'),
(51, 50, '2023-11-24', '2023-12-09'),
(51, 51, '2023-11-24', '2023-12-08'),
(52, 52, '2023-11-24', '2023-12-08'),
(56, 53, '2023-11-24', '2023-11-24'),
(56, 54, '2023-11-30', '2023-12-09'),
(56, 55, '2023-11-24', '2023-12-08'),
(58, 67, '2023-12-01', '2023-12-08'),
(58, 68, '2023-12-01', '2023-12-08'),
(58, 69, '2023-12-01', '2023-12-08'),
(60, 71, '2023-11-30', '2023-12-08'),
(60, 72, '2023-11-30', '2023-12-08'),
(62, 79, '2023-11-24', '2023-11-30'),
(62, 80, '2023-12-01', '2023-12-01'),
(62, 81, '2023-12-21', '2024-01-05'),
(70, 82, '2023-12-01', '2023-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idTarea` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` char(3) NOT NULL,
  `idProyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`idTarea`, `titulo`, `descripcion`, `estado`, `idProyecto`) VALUES
(1, 'Tarea 11125', 'Descripción de la Tarea 1', 'RET', 1),
(2, 'Tarea 2', 'Descripción de la Tarea 2', 'RET', 2),
(3, 'Tarea 3', 'Descripción de la Tarea 3', 'FIN', 3),
(4, 'Tarea 4', 'Descripción de la Tarea 4', 'RET', 4),
(5, 'Tarea 5', 'Descripción de la Tarea 5', 'RET', 5),
(6, 'Tarea 6', 'Descripción de la Tarea 6', 'FIN', 6),
(7, 'Tarea 7', 'Descripción de la Tarea 7', 'RET', 7),
(8, 'Tarea 8', 'Descripción de la Tarea 8', 'RET', 8),
(9, 'Tarea 9', 'Descripción de la Tarea 9', 'FIN', 9),
(10, 'Tarea 10', 'Descripción de la Tarea 10', 'RET', 10),
(11, 'Tarea 11', 'Descripción de la Tarea 11', 'PEN', 11),
(12, 'Tarea 12', 'Descripción de la Tarea 12', 'FIN', 12),
(13, 'Tarea 13', 'Descripción de la Tarea 13', 'ACT', 13),
(14, 'Tarea 14', 'Descripción de la Tarea 14', 'PEN', 14),
(15, 'Tarea 15', 'Descripción de la Tarea 15', 'FIN', 15),
(16, 'Tarea 16', 'Descripción de la Tarea 16', 'RET', 1),
(17, 'Tarea 17', 'Descripción de la Tarea 17', 'FIN', 2),
(18, 'Tarea 18', 'Descripción de la Tarea 18', 'FIN', 3),
(19, 'Tarea 19', 'Descripción de la Tarea 19', 'RET', 4),
(20, 'Tarea 20', 'Descripción de la Tarea 20', 'RET', 5),
(21, 'Tarea 21', 'Descripción de la Tarea 21', 'FIN', 6),
(22, 'Tarea 22', 'Descripción de la Tarea 22', 'RET', 7),
(23, 'Tarea 23', 'Descripción de la Tarea 23', 'RET', 8),
(24, 'Tarea 24', 'Descripción de la Tarea 24', 'FIN', 9),
(25, 'Tarea 25', 'Descripción de la Tarea 25', 'RET', 10),
(26, 'Tarea 26', 'Descripción de la Tarea 26', 'RET', 11),
(27, 'Tarea 27', 'Descripción de la Tarea 27', 'FIN', 12),
(28, 'Tarea 28', 'Descripción de la Tarea 28', 'RET', 13),
(29, 'Tarea 29', 'Descripción de la Tarea 29', 'RET', 14),
(30, 'Tarea 30', 'Descripción de la Tarea 30', 'FIN', 15),
(31, 'Construccion 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'FIN', 2),
(32, 'Construccion 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'RET', 2),
(33, 'Construccion 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'FIN', 2),
(34, 'Construccion 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'RET', 2),
(35, 'Construccion 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'FIN', 2),
(36, 'caja', 'Caja', 'ACT', 40),
(37, 'Tarea carlos', 'kalo', 'FIN', 42),
(38, 'hola', 'hola', 'ACT', 45),
(39, 'hola 2', 'hola 2', 'ACT', 45),
(40, 'hola 3', 'hola 3', 'ACT', 45),
(41, 'Tarea carlos', 'kalo', 'ACT', 46),
(42, 'hola 3', 'hola 3', 'ACT', 46),
(45, 'caja', 'Caja', 'ACT', 48),
(46, 'caja', 'Caja', 'CAN', 48),
(47, 'caja2', 'Caja', 'CAN', 48),
(48, 'hola 3', 'hola 3', 'FIN', 49),
(49, 'Tarea carlos', 'kalo', 'ACT', 2),
(50, 'caja2', '2', 'ACT', 51),
(51, 'secuestro', 'secuestro bebe', 'ACT', 51),
(52, 'caja', 'Caja', 'ACT', 52),
(53, 'hola 3', 'hola', 'ACT', 56),
(54, 'Tarea carlos', 'hola', 'ACT', 56),
(55, 'hola', 'hola 2', 'ACT', 56),
(56, 'Tarea carlos', 'kalo', 'ACT', 2),
(57, 'Tarea carlos', 'kalo', 'ACT', 2),
(58, 'caja2', 'mnm', 'ACT', 2),
(59, 'Tarea ccc', 'Tarea ccc', 'ACT', 3),
(60, 'Tarea ccc', 'Tarea ccc', 'ACT', 3),
(61, 'Tarea ccc5', 'Tarea ccc', 'ACT', 3),
(62, 'Tarea ccc57', 'Tarea ccc', 'ACT', 3),
(63, 'Tarea ccc578', 'Tarea ccc', 'ACT', 3),
(64, 'Tarea ccc5789', 'Tarea ccc', 'ACT', 3),
(65, 'gatosss', 'gatoss', 'ACT', 3),
(66, 'Carrito', 'Juan', 'ACT', 4),
(67, 'Casa', '12', 'ACT', 58),
(68, 'Casa', '12', 'ACT', 58),
(69, 'Casa', '12', 'ACT', 58),
(70, 'Tarea carlos', 'hola', 'ACT', 5),
(71, 'm', 'm', 'ACT', 60),
(72, 'm', 'm', 'ACT', 60),
(73, 'caja', 'Tarea ccc', 'ACT', 1),
(74, '11', '11', 'ACT', 1),
(75, '11', '11', 'ACT', 1),
(76, '11', '11', 'ACT', 1),
(77, 'm', 'islas', 'ACT', 1),
(78, 'Tarea carlos', 'Tarea ccc', 'ACT', 2),
(79, 'Pozos', 'odm', 'ACT', 62),
(80, 'oisanfw', 'negpeqngi', 'ACT', 62),
(81, 'awknmf', 'mekpregm', 'ACT', 62),
(82, 'smflva svl', 'dsa vf', 'ACT', 70);

--
-- Disparadores `tarea`
--
DELIMITER $$
CREATE TRIGGER `TareaCreada` AFTER INSERT ON `tarea` FOR EACH ROW BEGIN
    INSERT INTO Modificacion (
        descripcionModificacion,
        fechaModificacion,
        idUsuario,
        accion
    )
    VALUES (
        CONCAT('Tarea creada: ', NEW.titulo), -- Se usa el título de la tarea para la descripción
        CURDATE(), -- Fecha y hora actuales
        1, -- ID de usuario ficticio, asumiendo que no tienes esta información en la tabla 'Tarea'
        'crear'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TareaModificada` AFTER UPDATE ON `tarea` FOR EACH ROW BEGIN
    IF OLD.titulo <> NEW.titulo THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idUsuario, accion)
        VALUES (CONCAT('El título de la tarea cambió de ', OLD.titulo, ' a ', NEW.titulo), CURDATE(),1, 'modificar');
    END IF;
    IF OLD.descripcion <> NEW.descripcion THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion,idUsuario, accion)
        VALUES (CONCAT('La descripción de la tarea cambió de ', OLD.descripcion, ' a ', NEW.descripcion), CURDATE(),1, 'modificar');
    END IF;
    IF OLD.estado <> NEW.estado THEN
        INSERT INTO Modificacion (descripcionModificacion, fechaModificacion,idUsuario, accion)
        VALUES (CONCAT('El estado de la tarea cambió de ', OLD.estado, ' a ', NEW.estado), CURDATE(),1, 'modificar');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTu` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTu`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Arquitecto'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidoPat` varchar(50) NOT NULL,
  `apellidoMat` varchar(50) NOT NULL,
  `numTel` char(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidoPat`, `apellidoMat`, `numTel`, `email`, `contrasena`, `idTipoUsuario`) VALUES
(1, 'Juan', 'Perez', 'Gomez', '123456789', 'juan.perez@email.com', '123', 1),
(2, 'Ana', 'Gonzalez', 'Lopez', '987654321', 'ana.gonzalez@email.com', '123', 2),
(3, 'Carlos', 'Martinez', 'Rodriguez', '456789123', 'carlos.martinez@email.com', '123', 3),
(4, 'Luis', 'Hernandez', 'Lopez', '321654987', 'luis.hernandez@email.com', 'contrasenaabc', 1),
(5, 'Elena', 'Gutierrez', 'Gomez', '789123456', 'elena.gutierrez@email.com', 'contrasenadef', 2),
(6, 'Marina', 'Sanchez', 'Rodriguez', '987123654', 'marina.sanchez@email.com', 'contrasena123abc', 3),
(7, 'David', 'Lopez', 'Gonzalez', '654321789', 'david.lopez@email.com', 'contrasena456def', 1),
(8, 'Laura', 'Ramirez', 'Martinez', '123789456', 'laura.ramirez@email.com', 'contrasena789abc', 2),
(9, 'Pablo', 'Torres', 'Fernandez', '321789654', 'pablo.torres@email.com', 'contrasenaabc123', 3),
(10, 'Sara', 'Castro', 'Hernandez', '789654321', 'sara.castro@email.com', 'contrasenadef456', 1),
(11, 'Alejandro', 'Diaz', 'Perez', '654789321', 'alejandro.diaz@email.com', 'contrasena123abc789', 2),
(12, 'Carmen', 'Ortega', 'Gutierrez', '987321654', 'carmen.ortega@email.com', 'contrasena456def123', 3),
(13, 'Javier', 'Ruiz', 'Sanchez', '789654123', 'javier.ruiz@email.com', 'contrasena789abc456', 1),
(14, 'Isabel', 'Molina', 'Torres', '321789654', 'isabel.molina@email.com', 'contrasenaabc123def', 2),
(15, 'Roberto', 'Lopez', 'Fernandez', '654123789', 'roberto.lopez@email.com', 'contrasena456def789', 3),
(16, 'Natalia', 'Gomez', 'Rodriguez', '987654321', 'natalia.gomez@email.com', 'contrasena123', 1),
(17, 'Roberto', 'Fernandez', 'Perez', '123456789', 'roberto.fernandez@email.com', 'contrasena456', 2),
(18, 'Valeria', 'Lopez', 'Martinez', '456789123', 'valeria.lopez@email.com', 'contrasena789', 3),
(19, 'Felipe', 'Rodriguez', 'Hernandez', '321654987', 'felipe.rodriguez@email.com', 'contrasenaabc', 1),
(20, 'Lucia', 'Martinez', 'Sanchez', '789123456', 'lucia.martinez@email.com', 'contrasenadef', 2),
(21, 'Andres', 'Gutierrez', 'Gomez', '987123654', 'andres.gutierrez@email.com', 'contrasena123abc', 3),
(22, 'Isabella', 'Sanchez', 'Rodriguez', '654321789', 'isabella.sanchez@email.com', 'contrasena456def', 1),
(23, 'Mateo', 'Ramirez', 'Martinez', '123789456', 'mateo.ramirez@email.com', 'contrasena789abc', 2),
(24, 'Camila', 'Torres', 'Fernandez', '321789654', 'camila.torres@email.com', 'contrasenaabc123', 3),
(25, 'Santiago', 'Castro', 'Hernandez', '789654321', 'santiago.castro@email.com', 'contrasenadef456', 1),
(26, 'Valentina', 'Diaz', 'Perez', '654789321', 'valentina.diaz@email.com', 'contrasena123abc789', 2),
(27, 'Daniel', 'Ortega', 'Gutierrez', '987321654', 'daniel.ortega@email.com', 'contrasena456def123', 3),
(28, 'Renata', 'Ruiz', 'Sanchez', '789654123', 'renata.ruiz@email.com', 'contrasena789abc456', 1),
(29, 'Leonardo', 'Molina', 'Torres', '321789654', 'leonardo.molina@email.com', 'contrasenaabc123def', 2),
(30, 'Mia', 'Lopez', 'Fernandez', '654123789', 'mia.lopez@email.com', 'contrasena456def789', 3),
(31, 'Erik', 'Beltran', 'Ramirez', '664-266-6454', 'erik@gmail.com', '1234', 1),
(32, 'juan', 'Sanchez', 'mn', '897-767-5757', 'm@g.mm', '9Kzp3qVC', 1),
(33, 'kd', 'jkddb', 'kjd', '908-908-9899', 'jkjwhdfwdkjh@jhdbfjh.c', 'CBZRn4uS', 1),
(34, 'mmmnm', 'mmnmm', 'mmm', '099-789-7878', 'M@m.m', 'QmjFrodC', 3),
(35, 'Ramon', 'Marquez', 'Materno', '666-464-6464', 'ramon@mail.com', 'q8M1TVqA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioproyecto`
--

CREATE TABLE `usuarioproyecto` (
  `idUsuario` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarioproyecto`
--

INSERT INTO `usuarioproyecto` (`idUsuario`, `idProyecto`) VALUES
(1, 1),
(1, 3),
(1, 15),
(1, 16),
(1, 35),
(1, 48),
(1, 49),
(1, 51),
(1, 52),
(1, 56),
(2, 1),
(2, 2),
(2, 17),
(2, 36),
(2, 62),
(3, 1),
(3, 2),
(3, 3),
(3, 18),
(3, 42),
(4, 1),
(4, 3),
(4, 4),
(4, 19),
(4, 49),
(4, 51),
(4, 56),
(5, 1),
(5, 4),
(5, 5),
(5, 20),
(6, 1),
(6, 5),
(6, 6),
(6, 21),
(7, 1),
(7, 6),
(7, 7),
(7, 22),
(8, 1),
(8, 7),
(8, 8),
(8, 23),
(9, 1),
(9, 8),
(9, 9),
(9, 24),
(9, 62),
(10, 1),
(10, 9),
(10, 10),
(10, 25),
(11, 1),
(11, 10),
(11, 11),
(11, 26),
(11, 70),
(12, 11),
(12, 12),
(12, 27),
(13, 12),
(13, 13),
(13, 28),
(14, 13),
(14, 14),
(14, 29),
(15, 14),
(15, 15),
(15, 30),
(18, 62),
(20, 62),
(21, 40),
(24, 37),
(24, 38),
(24, 40),
(24, 45),
(27, 37),
(27, 38),
(27, 39),
(27, 45),
(27, 46),
(27, 62),
(28, 70),
(29, 52),
(29, 70),
(30, 37),
(30, 38),
(30, 39),
(30, 45),
(30, 52),
(30, 58),
(30, 60),
(32, 70),
(34, 5),
(34, 62);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariotarea`
--

CREATE TABLE `usuariotarea` (
  `idUsuario` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuariotarea`
--

INSERT INTO `usuariotarea` (`idUsuario`, `idTarea`) VALUES
(1, 1),
(1, 16),
(1, 30),
(1, 48),
(1, 50),
(1, 53),
(1, 54),
(1, 55),
(1, 74),
(1, 75),
(1, 76),
(2, 2),
(2, 16),
(2, 17),
(2, 78),
(2, 79),
(2, 80),
(3, 3),
(3, 17),
(3, 18),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 37),
(3, 77),
(4, 4),
(4, 18),
(4, 19),
(4, 51),
(5, 5),
(5, 19),
(5, 20),
(6, 6),
(6, 20),
(6, 21),
(7, 7),
(7, 21),
(7, 22),
(8, 8),
(8, 22),
(8, 23),
(9, 9),
(9, 23),
(9, 24),
(10, 10),
(10, 24),
(10, 25),
(11, 11),
(11, 25),
(11, 26),
(11, 82),
(12, 12),
(12, 26),
(12, 27),
(13, 13),
(13, 27),
(13, 28),
(14, 14),
(14, 28),
(14, 29),
(15, 15),
(15, 29),
(15, 30),
(18, 81),
(21, 36),
(24, 38),
(24, 39),
(27, 40),
(27, 41),
(27, 42),
(30, 67),
(30, 68),
(30, 69),
(30, 71),
(30, 72);

--
-- Disparadores `usuariotarea`
--
DELIMITER $$
CREATE TRIGGER `AsignacionTareaUsuario` AFTER INSERT ON `usuariotarea` FOR EACH ROW BEGIN
    DECLARE nombreUsuario VARCHAR(30);
    DECLARE tituloTarea VARCHAR(40);

    -- Obtener el nombre del usuario
    SELECT nombre INTO nombreUsuario FROM Usuario WHERE idUsuario = NEW.idUsuario;

    -- Obtener el título de la tarea
    SELECT titulo INTO tituloTarea FROM Tarea WHERE idTarea = NEW.idTarea;

    -- Insertar en la tabla Modificación
    INSERT INTO Modificacion (
        descripcionModificacion,
        fechaModificacion,
        idUsuario,
        accion
    )
    VALUES (
        CONCAT('Tarea "', tituloTarea, '" asignada a ', nombreUsuario),
        CURDATE(),
        1,
        'asignar'
    );
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTarea` (`idTarea`),
  ADD KEY `idProyecto` (`idProyecto`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `modificacion`
--
ALTER TABLE `modificacion`
  ADD PRIMARY KEY (`idModificacion`),
  ADD KEY `idProyecto` (`idProyecto`),
  ADD KEY `idTarea` (`idTarea`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idProyecto`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `proyectotarea`
--
ALTER TABLE `proyectotarea`
  ADD PRIMARY KEY (`idProyecto`,`idTarea`),
  ADD KEY `idTarea` (`idTarea`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`idTarea`),
  ADD KEY `estado` (`estado`),
  ADD KEY `idProyecto` (`idProyecto`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`);

--
-- Indices de la tabla `usuarioproyecto`
--
ALTER TABLE `usuarioproyecto`
  ADD PRIMARY KEY (`idUsuario`,`idProyecto`),
  ADD KEY `idProyecto` (`idProyecto`);

--
-- Indices de la tabla `usuariotarea`
--
ALTER TABLE `usuariotarea`
  ADD PRIMARY KEY (`idUsuario`,`idTarea`),
  ADD KEY `idTarea` (`idTarea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `modificacion`
--
ALTER TABLE `modificacion`
  MODIFY `idModificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `Comentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `Comentario_ibfk_2` FOREIGN KEY (`idTarea`) REFERENCES `tarea` (`idTarea`),
  ADD CONSTRAINT `Comentario_ibfk_3` FOREIGN KEY (`idProyecto`) REFERENCES `proyecto` (`idProyecto`);

--
-- Filtros para la tabla `modificacion`
--
ALTER TABLE `modificacion`
  ADD CONSTRAINT `Modificacion_ibfk_1` FOREIGN KEY (`idProyecto`) REFERENCES `proyecto` (`idProyecto`),
  ADD CONSTRAINT `Modificacion_ibfk_2` FOREIGN KEY (`idTarea`) REFERENCES `tarea` (`idTarea`),
  ADD CONSTRAINT `Modificacion_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `Proyecto_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`codigo`);

--
-- Filtros para la tabla `proyectotarea`
--
ALTER TABLE `proyectotarea`
  ADD CONSTRAINT `ProyectoTarea_ibfk_1` FOREIGN KEY (`idProyecto`) REFERENCES `proyecto` (`idProyecto`),
  ADD CONSTRAINT `ProyectoTarea_ibfk_2` FOREIGN KEY (`idTarea`) REFERENCES `tarea` (`idTarea`);

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `Tarea_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`codigo`),
  ADD CONSTRAINT `Tarea_ibfk_2` FOREIGN KEY (`idProyecto`) REFERENCES `proyecto` (`idProyecto`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTu`);

--
-- Filtros para la tabla `usuarioproyecto`
--
ALTER TABLE `usuarioproyecto`
  ADD CONSTRAINT `UsuarioProyecto_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `UsuarioProyecto_ibfk_2` FOREIGN KEY (`idProyecto`) REFERENCES `proyecto` (`idProyecto`);

--
-- Filtros para la tabla `usuariotarea`
--
ALTER TABLE `usuariotarea`
  ADD CONSTRAINT `UsuarioTarea_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `UsuarioTarea_ibfk_2` FOREIGN KEY (`idTarea`) REFERENCES `tarea` (`idTarea`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `EventoRetraso` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-11-19 17:32:56' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Actualizar estado de las tareas retrasadas que no han finalizado
    UPDATE Tarea t
    SET t.estado = 'RET'
    WHERE t.idTarea IN (
        SELECT pt.idTarea
        FROM ProyectoTarea pt
        JOIN Tarea t ON pt.idTarea = t.idTarea
        JOIN Proyecto p ON pt.idProyecto = p.idProyecto
        WHERE p.fechaFinal < CURRENT_DATE AND t.estado != 'RET' AND t.estado != 'FIN'
    );

    -- Actualizar estado de los proyectos retrasados que no han finalizado
    UPDATE Proyecto p
    SET p.estado = 'RET'
    WHERE p.fechaFinal < CURRENT_DATE AND p.estado != 'RET' AND p.estado != 'FIN';
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
