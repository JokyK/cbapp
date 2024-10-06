-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2024 a las 23:18:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio_bautista`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `nie` int(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `grado` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`nie`, `nombre`, `apellidos`, `grado`) VALUES
(100000001, 'Carlos Alberto', 'Pérez García', '1ERO'),
(100000002, 'María Elena', 'López Hernández', '1ERO'),
(100000003, 'Juan Carlos', 'Martínez Cruz', '1ERO'),
(100000004, 'Ana Beatriz', 'Gómez Rivera', '1ERO'),
(100000005, 'José Luis', 'Díaz Morales', '1ERO'),
(100000006, 'Luis Antonio', 'Ramírez Pérez', '1ERO'),
(100000007, 'Elena Patricia', 'Sánchez López', '1ERO'),
(100000008, 'Ricardo José', 'Ortega Jiménez', '1ERO'),
(100000009, 'Carmen Sofía', 'Sosa Castillo', '1ERO'),
(100000010, 'Miguel Ángel', 'Castro Pérez', '1ERO'),
(100000011, 'Laura Isabel', 'Reyes Rivera', '1ERO'),
(100000012, 'Javier Alejandro', 'Vargas Castillo', '1ERO'),
(100000013, 'Adriana Fernanda', 'Ortiz García', '1ERO'),
(100000014, 'Héctor Manuel', 'Mendoza Sánchez', '1ERO'),
(100000015, 'Daniel Enrique', 'Cruz Méndez', '1ERO'),
(100000016, 'Sofía Mariana', 'García Romero', '1ERO'),
(100000017, 'Carlos Emilio', 'Navarro Salinas', '1ERO'),
(100000018, 'Lucía Esperanza', 'Valencia Pérez', '1ERO'),
(100000019, 'Alberto Javier', 'Ruiz Delgado', '1ERO'),
(100000020, 'Gabriela Victoria', 'Vega Torres', '1ERO'),
(100000021, 'Juan Manuel', 'Molina López', '2NDO'),
(100000022, 'Verónica Isabel', 'Ramírez Castillo', '2NDO'),
(100000023, 'Antonio José', 'Torres García', '2NDO'),
(100000024, 'Sara Paola', 'Hernández Rivas', '2NDO'),
(100000025, 'Miguel Eduardo', 'Guzmán Rodríguez', '2NDO'),
(100000026, 'Patricia Alejandra', 'Mendoza Ortega', '2NDO'),
(100000027, 'Luis Fernando', 'Martínez Campos', '2NDO'),
(100000028, 'Gabriel Adrián', 'Rivera Morales', '2NDO'),
(100000029, 'Claudia Daniela', 'Gómez Herrera', '2NDO'),
(100000030, 'Carlos Andrés', 'Pineda Rodríguez', '2NDO'),
(100000031, 'Raquel Beatriz', 'Navarro Argueta', '2NDO'),
(100000032, 'Santiago Alberto', 'Figueroa Flores', '2NDO'),
(100000033, 'Mónica Leticia', 'Carranza Campos', '2NDO'),
(100000034, 'Pedro Elías', 'Mendoza Aguilar', '2NDO'),
(100000035, 'Luis Rafael', 'Sánchez Escobar', '2NDO'),
(100000036, 'Elisa Carolina', 'Vega Méndez', '2NDO'),
(100000037, 'Jorge Esteban', 'Aguilar Castillo', '2NDO'),
(100000038, 'Laura Gabriela', 'Luna Pérez', '2NDO'),
(100000039, 'Samuel Antonio', 'Mejía López', '2NDO'),
(100000040, 'Fernanda Isabel', 'Zamora Fuentes', '2NDO'),
(100000041, 'Carlos Eduardo', 'Martínez Hernández', '3ERO'),
(100000042, 'Ana Patricia', 'González Romero', '3ERO'),
(100000043, 'José Andrés', 'Rodríguez Cruz', '3ERO'),
(100000044, 'Sofía Marcela', 'Vargas Torres', '3ERO'),
(100000045, 'Emilio Antonio', 'Zelaya Flores', '3ERO'),
(100000046, 'Mariana Isabel', 'Ríos Moreno', '3ERO'),
(100000047, 'José Rafael', 'Cruz Pérez', '3ERO'),
(100000048, 'Lucía Fernanda', 'Torres Pineda', '3ERO'),
(100000049, 'Samuel Alejandro', 'Gómez Fuentes', '3ERO'),
(100000050, 'Gabriela Cristina', 'Castro Romero', '3ERO'),
(100000051, 'Carlos Antonio', 'Morales Herrera', '3ERO'),
(100000052, 'Mónica Raquel', 'Sánchez López', '3ERO'),
(100000053, 'Roberto Carlos', 'Navarro Reyes', '3ERO'),
(100000054, 'Daniela Paola', 'López Salinas', '3ERO'),
(100000055, 'Diego Alejandro', 'Cruz Medina', '3ERO'),
(100000056, 'Carolina Leticia', 'Lemus Figueroa', '3ERO'),
(100000057, 'Luis Miguel', 'Hernández García', '3ERO'),
(100000058, 'Juan David', 'Velásquez Morales', '3ERO'),
(100000059, 'Adriana Carolina', 'Rivas Aguilar', '3ERO'),
(100000060, 'José Fernando', 'López Castillo', '3ERO'),
(100000061, 'Jorge Luis', 'Ramírez Martínez', '4RTO'),
(100000062, 'Karla María', 'Pérez Guzmán', '4RTO'),
(100000063, 'Luis Eduardo', 'Hernández Flores', '4RTO'),
(100000064, 'Daniela Beatriz', 'García López', '4RTO'),
(100000065, 'Roberto Carlos', 'Morales Sánchez', '4RTO'),
(100000066, 'Gabriela Patricia', 'Ramos Díaz', '4RTO'),
(100000067, 'Alejandro José', 'Vargas Ortega', '4RTO'),
(100000068, 'Sofía Carolina', 'Cruz Pérez', '4RTO'),
(100000069, 'Carlos Enrique', 'López Figueroa', '4RTO'),
(100000070, 'Andrea Fernanda', 'Rivera Castillo', '4RTO'),
(100000071, 'José Manuel', 'Mendoza Gómez', '4RTO'),
(100000072, 'María Teresa', 'Ramírez Martínez', '4RTO'),
(100000073, 'Juan Pablo', 'Torres Morales', '4RTO'),
(100000074, 'Ana Sofía', 'Velásquez Hernández', '4RTO'),
(100000075, 'David Andrés', 'Mejía Vásquez', '4RTO'),
(100000076, 'Lucía Isabel', 'Gutiérrez Cruz', '4RTO'),
(100000077, 'Santiago Alejandro', 'Rivas López', '4RTO'),
(100000078, 'Carmen Leticia', 'Gómez Sánchez', '4RTO'),
(100000079, 'José Antonio', 'Molina Fernández', '4RTO'),
(100000080, 'Marcos Rafael', 'Lemus Torres', '4RTO'),
(100000081, 'Luis Fernando', 'Sánchez López', '5NTO'),
(100000082, 'Ana Carolina', 'Hernández Martínez', '5NTO'),
(100000083, 'Roberto Antonio', 'Pérez García', '5NTO'),
(100000084, 'Laura Isabel', 'Castro Morales', '5NTO'),
(100000085, 'Javier Alejandro', 'Vargas Castillo', '5NTO'),
(100000086, 'Gabriela Beatriz', 'Navarro Cruz', '5NTO'),
(100000087, 'Daniel Eduardo', 'Mendoza Ortiz', '5NTO'),
(100000088, 'Sofía Marcela', 'Ruiz Pineda', '5NTO'),
(100000089, 'Carlos Andrés', 'Figueroa Torres', '5NTO'),
(100000090, 'Mónica Patricia', 'Ramos Méndez', '5NTO'),
(100000091, 'Jorge Luis', 'Martínez Rivas', '5NTO'),
(100000092, 'Patricia Alejandra', 'López Sánchez', '5NTO'),
(100000093, 'José Alfredo', 'Cruz Hernández', '5NTO'),
(100000094, 'María Fernanda', 'Torres Aguilar', '5NTO'),
(100000095, 'Carlos Daniel', 'Ortega Ramos', '5NTO'),
(100000096, 'Adriana Sofía', 'Gómez Medina', '5NTO'),
(100000097, 'Luis Emilio', 'Reyes Martínez', '5NTO'),
(100000098, 'Claudia Isabel', 'Navarro Velásquez', '5NTO'),
(100000099, 'José Miguel', 'Rivas López', '5NTO'),
(100000100, 'Elena Patricia', 'Ruiz González', '5NTO'),
(100000101, 'Mario Alberto', 'Cruz Hernández', '6XTO'),
(100000102, 'Paola Isabel', 'Pérez Gutiérrez', '6XTO'),
(100000103, 'Luis Alejandro', 'Torres Mendoza', '6XTO'),
(100000104, 'Daniela Sofía', 'García Salinas', '6XTO'),
(100000105, 'Carlos Enrique', 'Sánchez López', '6XTO'),
(100000106, 'Gabriela Marcela', 'Vargas Morales', '6XTO'),
(100000107, 'Roberto Andrés', 'Mejía Castillo', '6XTO'),
(100000108, 'Sofía Beatriz', 'Pineda Ortega', '6XTO'),
(100000109, 'Javier Emilio', 'Zamora Cruz', '6XTO'),
(100000110, 'Lucía Fernanda', 'Ramírez Torres', '6XTO'),
(100000111, 'Carlos David', 'Hernández Flores', '6XTO'),
(100000112, 'María Elena', 'Ortega Martínez', '6XTO'),
(100000113, 'Luis Eduardo', 'Castillo Pérez', '6XTO'),
(100000114, 'Andrea Patricia', 'Reyes Morales', '6XTO'),
(100000115, 'Juan Manuel', 'Rodríguez Sánchez', '6XTO'),
(100000116, 'Ana Gabriela', 'Morales Rivas', '6XTO'),
(100000117, 'Jorge Alejandro', 'Pérez Vásquez', '6XTO'),
(100000118, 'Mariana Isabel', 'Navarro Figueroa', '6XTO'),
(100000119, 'Carlos Alberto', 'Ramos Aguilar', '6XTO'),
(100000120, 'Sofía Patricia', 'López García', '6XTO'),
(100000121, 'Carlos Andrés', 'López Hernández', '7IMO'),
(100000122, 'María Fernanda', 'Sánchez López', '7IMO'),
(100000123, 'Luis Fernando', 'Gómez Martínez', '7IMO'),
(100000124, 'Ana Patricia', 'Castro Pérez', '7IMO'),
(100000125, 'Javier Alejandro', 'Hernández Torres', '7IMO'),
(100000126, 'Gabriela Sofía', 'Ramos Castillo', '7IMO'),
(100000127, 'José Manuel', 'Vargas Sánchez', '7IMO'),
(100000128, 'Sofía Beatriz', 'Navarro García', '7IMO'),
(100000129, 'Carlos Emilio', 'Pérez Rivas', '7IMO'),
(100000130, 'Daniela Isabel', 'Ramírez Morales', '7IMO'),
(100000131, 'Luis Eduardo', 'González Mejía', '7IMO'),
(100000132, 'Claudia Isabel', 'Martínez Romero', '7IMO'),
(100000133, 'Jorge Luis', 'Sosa Díaz', '7IMO'),
(100000134, 'Paola Andrea', 'Ortega Cruz', '7IMO'),
(100000135, 'Carlos Alberto', 'Vega López', '7IMO'),
(100000136, 'Lucía Fernanda', 'Aguilar Campos', '7IMO'),
(100000137, 'Roberto Carlos', 'Mendoza Flores', '7IMO'),
(100000138, 'María Alejandra', 'Morales Castillo', '7IMO'),
(100000139, 'José David', 'Pineda Hernández', '7IMO'),
(100000140, 'Laura Isabel', 'Reyes Vásquez', '7IMO'),
(100000141, 'Miguel Ángel', 'Sánchez López', '8AVO'),
(100000142, 'Ana Beatriz', 'Hernández Gómez', '8AVO'),
(100000143, 'Carlos Eduardo', 'Martínez Rivas', '8AVO'),
(100000144, 'María Elena', 'Pérez Morales', '8AVO'),
(100000145, 'Luis Enrique', 'Cruz Castillo', '8AVO'),
(100000146, 'Patricia Alejandra', 'Torres Ramírez', '8AVO'),
(100000147, 'Jorge Luis', 'González Rivera', '8AVO'),
(100000148, 'Gabriela Paola', 'Navarro López', '8AVO'),
(100000149, 'José Manuel', 'Ramos Martínez', '8AVO'),
(100000150, 'Lucía Fernanda', 'Gómez Salinas', '8AVO'),
(100000151, 'Carlos Andrés', 'Ortega Vargas', '8AVO'),
(100000152, 'Mónica Isabel', 'Vega Figueroa', '8AVO'),
(100000153, 'Daniel Eduardo', 'López Ruiz', '8AVO'),
(100000154, 'Sofía Carolina', 'Hernández Mejía', '8AVO'),
(100000155, 'Luis Alberto', 'Martínez Aguilar', '8AVO'),
(100000156, 'Laura Patricia', 'Guzmán Castillo', '8AVO'),
(100000157, 'Juan Carlos', 'Cruz Pineda', '8AVO'),
(100000158, 'Gabriela Marcela', 'Vásquez López', '8AVO'),
(100000159, 'Carlos Emilio', 'Navarro Sánchez', '8AVO'),
(100000160, 'María Fernanda', 'García López', '8AVO'),
(100000161, 'Jorge Alejandro', 'Martínez Pérez', '9ENO'),
(100000162, 'Claudia Patricia', 'Sánchez Ramírez', '9ENO'),
(100000163, 'José Luis', 'Hernández Vargas', '9ENO'),
(100000164, 'Ana Isabel', 'Vega Castillo', '9ENO'),
(100000165, 'Carlos Alberto', 'González López', '9ENO'),
(100000166, 'María Teresa', 'Cruz Martínez', '9ENO'),
(100000167, 'Luis Enrique', 'Navarro Gómez', '9ENO'),
(100000168, 'Sofía Carolina', 'Ramos Hernández', '9ENO'),
(100000169, 'José Manuel', 'Gómez Pérez', '9ENO'),
(100000170, 'Gabriela Paola', 'Torres Vargas', '9ENO'),
(100000171, 'Daniel Eduardo', 'Vargas Salinas', '9ENO'),
(100000172, 'Mónica Isabel', 'Pineda Rodríguez', '9ENO'),
(100000173, 'Carlos Emilio', 'Reyes López', '9ENO'),
(100000174, 'Laura Fernanda', 'Ortega Ramírez', '9ENO'),
(100000175, 'Luis Fernando', 'Sánchez Morales', '9ENO'),
(100000176, 'Ana Patricia', 'Morales Figueroa', '9ENO'),
(100000177, 'Jorge Antonio', 'Aguilar Pérez', '9ENO'),
(100000178, 'Sofía Marcela', 'Pérez Cruz', '9ENO'),
(100000179, 'Carlos Enrique', 'Ramírez Hernández', '9ENO'),
(100000180, 'María Isabel', 'López Martínez', '9ENO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `codigo` varchar(4) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`codigo`, `nombre`) VALUES
('1ERO', 'Primero'),
('2NDO', 'Segundo'),
('3ERO', 'Tercero'),
('4RTO', 'Cuarto'),
('5NTO', 'Quinto'),
('6XTO', 'Sexto'),
('7IMO', 'Septimo'),
('8AVO', 'Octavo'),
('9ENO', 'Noveno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `dui` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `celular` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`dui`, `nombre`, `apellidos`, `correo`, `contrasena`, `celular`) VALUES
('000000001', 'Kevin', 'Fulanito', 'kevin@gmail.com', '1234', 11112222),
('000000002', 'Dinora Carolina', 'Erazo de Chicas', 'carolina@gmail.com', '1234', 1111),
('000000003', 'Katlyn', 'Mijango', 'katlyn@gmail.com', '1234', 2222),
('000000004', 'Jose Neftaly', 'Soto Rivas', 'soto@gmai.com', '1234', 3333),
('07', 'Admin', 'CB', 'cbadmin@gmail.com', 'cbadmin123', 7777),
('123456789', 'Lucia Esther', 'De Paz de Chicas', 'lchicas2020@gmail.com', '1234', 12345678),
('987654321', 'Sandra Magaly', 'Mijango', 'test@test.com', '1234', 12345678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros_grados`
--

CREATE TABLE `maestros_grados` (
  `dui_maestro` varchar(9) NOT NULL,
  `cod_grado` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros_grados`
--

INSERT INTO `maestros_grados` (`dui_maestro`, `cod_grado`) VALUES
('987654321', '7IMO'),
('987654321', '8AVO'),
('987654321', '9ENO'),
('123456789', '9ENO'),
('07', '1ERO'),
('07', '2NDO'),
('07', '3ERO'),
('07', '4RTO'),
('07', '5NTO'),
('07', '6XTO'),
('07', '7IMO'),
('07', '8AVO'),
('07', '9ENO'),
('000000002', '7IMO'),
('000000002', '8AVO'),
('000000002', '9ENO'),
('000000001', '7IMO'),
('000000001', '8AVO'),
('000000001', '9ENO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros_materias`
--

CREATE TABLE `maestros_materias` (
  `dui_maestro` varchar(9) NOT NULL,
  `cod_materia` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros_materias`
--

INSERT INTO `maestros_materias` (`dui_maestro`, `cod_materia`) VALUES
('123456789', 'OTC'),
('987654321', 'ING'),
('987654321', 'CSMA'),
('000000002', 'SOCI'),
('000000002', 'MORA'),
('000000001', 'EDFI'),
('000000001', 'LENG'),
('07', 'COMP'),
('07', 'CSMA'),
('07', 'EDFI'),
('07', 'GEOM'),
('07', 'ING'),
('07', 'LENG'),
('07', 'MATE'),
('07', 'MORA'),
('07', 'ORTG'),
('07', 'OTC'),
('07', 'SOCI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `codigo` varchar(4) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`codigo`, `nombre`) VALUES
('COMP', 'Computación'),
('CSMA', 'Ciencias'),
('EDFI', 'Educación Física'),
('GEOM', 'Geometria'),
('ING', 'Ingles'),
('LENG', 'Lenguaje'),
('MATE', 'Matemáticas'),
('MORA', 'Moral'),
('ORTG', 'Ortografia'),
('OTC', 'Orientación Cristian'),
('SOCI', 'Sociales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `nie` int(11) DEFAULT NULL,
  `grado` varchar(50) DEFAULT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  `tipo_actividad` enum('cotidiana','integradora','examen') DEFAULT NULL,
  `nombre_actividad` varchar(100) DEFAULT NULL,
  `nota` decimal(4,2) DEFAULT NULL,
  `maestro` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `codigo` varchar(4) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`codigo`, `nombre`) VALUES
('1PER', 'Primero'),
('2PER', 'Segundo'),
('3PER', 'Tercero');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`nie`),
  ADD KEY `grado` (`grado`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `apellidos` (`apellidos`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo` (`codigo`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`dui`);

--
-- Indices de la tabla `maestros_grados`
--
ALTER TABLE `maestros_grados`
  ADD KEY `dui_maestro` (`dui_maestro`),
  ADD KEY `cod_grado` (`cod_grado`);

--
-- Indices de la tabla `maestros_materias`
--
ALTER TABLE `maestros_materias`
  ADD KEY `dui_maestro` (`dui_maestro`),
  ADD KEY `cod_materia` (`cod_materia`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nie` (`nie`),
  ADD KEY `periodo` (`periodo`),
  ADD KEY `materia` (`materia`),
  ADD KEY `grado` (`grado`),
  ADD KEY `maestro` (`maestro`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_3` FOREIGN KEY (`grado`) REFERENCES `grados` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maestros_grados`
--
ALTER TABLE `maestros_grados`
  ADD CONSTRAINT `maestros_grados_ibfk_1` FOREIGN KEY (`dui_maestro`) REFERENCES `maestros` (`dui`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maestros_grados_ibfk_2` FOREIGN KEY (`cod_grado`) REFERENCES `grados` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maestros_materias`
--
ALTER TABLE `maestros_materias`
  ADD CONSTRAINT `maestros_materias_ibfk_1` FOREIGN KEY (`dui_maestro`) REFERENCES `maestros` (`dui`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maestros_materias_ibfk_2` FOREIGN KEY (`cod_materia`) REFERENCES `materias` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`nie`) REFERENCES `alumnos` (`nie`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`grado`) REFERENCES `grados` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_6` FOREIGN KEY (`maestro`) REFERENCES `maestros` (`dui`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_7` FOREIGN KEY (`materia`) REFERENCES `materias` (`codigo`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
