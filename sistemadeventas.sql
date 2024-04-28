-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2024 a las 03:27:13
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
-- Base de datos: `sistemadeventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_acategorias`
--

CREATE TABLE `tb_acategorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_acategorias`
--

INSERT INTO `tb_acategorias` (`id_categoria`, `nombre_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Camisas', '2024-01-15 16:31:50', '2024-03-02 00:08:40'),
(2, 'Calzados', '2024-01-15 14:37:59', '2024-02-24 20:56:25'),
(3, 'Seguridad Industrial', '2024-01-15 14:39:24', '2024-02-24 20:55:44'),
(4, 'Varios', '2024-04-08 22:29:00', '2024-04-08 22:29:00'),
(5, 'Invierno', '2024-01-15 14:44:26', '2024-02-24 20:56:04'),
(6, 'Campo', '2024-01-15 14:48:26', '2024-02-24 20:55:07'),
(7, 'Accesorios', '2024-01-15 22:19:19', '0000-00-00 00:00:00'),
(8, 'Seguridad Pesqueras', '2024-04-06 01:33:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_almacen`
--

CREATE TABLE `tb_almacen` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_compra` varchar(255) NOT NULL,
  `precio_venta` varchar(255) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `imagen` text DEFAULT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_almacen`
--

INSERT INTO `tb_almacen` (`id_producto`, `codigo`, `nombre`, `descripcion`, `stock`, `stock_minimo`, `stock_maximo`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `imagen`, `fyh_creacion`, `fyh_actualizacion`, `id_usuario`, `id_categoria`) VALUES
(1, 'p-00001', 'camisa cargo', 'camisa de gabardina manga larga', -9, 20, 100, '1800', '2500', '2024-02-20', '2024-02-22-10-37-15__camisaAzulGrafa.jpg', '0000-00-00 00:00:00', '2024-02-23 15:49:13', 3, 1),
(2, 'p-00002', 'Guante', 'Nitrilo de 3.5 mil, Sin Polvo. .5 pulgadas de longitud. Puño enrollado. ', 56, 4, 200, '1000', '2300', '2034-02-24', '2024-04-08-04-16-40__img_productossinimagen.jpg', '0000-00-00 00:00:00', '2024-04-08 16:16:40', 4, 3),
(3, 'p-00003', 'botas de cuero', 'botas protectoras de caña alta', 46, 20, 60, '3800', '4500', '2024-03-05', '2024-03-05-02-27-33__botasSeguridad.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 3),
(4, 'p-00004', 'casco', 'casco protector', 40, 10, 40, '1500', '2000', '2024-03-05', '2024-03-05-02-28-48__cascoBlanco.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 7),
(9, 'p-00008', 'Botin punta de acero. Pampero', 'El botin de acero Pampero es de los mejores del mercado.', 50, 10, 100, '5900', '12999', '2024-04-07', '2024-04-07-08-38-57__botinpampero.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 2),
(10, 'p-00009', 'Reloj de agua', 'Reloj sumergible', 20, 5, 50, '1480', '3000', '2024-04-07', '2024-04-08-04-17-34__img_productossinimagen.jpg', '0000-00-00 00:00:00', '2024-04-08 16:17:34', 3, 7),
(11, 'p-00010', 'Camisa Levis', 'Camisa para oficina marca Levis', 8, 5, 50, '5000', '10000', '2024-04-07', '2024-04-08-04-19-43__img_productossinimagen.jpg', '0000-00-00 00:00:00', '2024-04-08 16:19:43', 3, 1),
(12, 'p-00011', 'Boina de cuero ', 'Boina de gaucho de cuero', 10, 2, 50, '3000', '6000', '2024-04-08', '2024-04-08-04-19-30__img_productossinimagen.jpg', '0000-00-00 00:00:00', '2024-04-08 16:19:30', 3, 6),
(13, 'p-00010', 'Bufanda', 'Bufanda multicolo', 10, 2, 50, '3500', '7000', '2024-04-08', '2024-04-08-04-17-20__img_productossinimagen.jpg', '0000-00-00 00:00:00', '2024-04-08 16:17:20', 3, 1),
(15, 'p-00011', 'Mascara de gas', 'Mascaras Silver talles unico', 30, 5, 50, '13000', '20000', '0000-00-00', 'sinimagen.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 3),
(194, 'p-00012', 'Botas de Montaña', 'Botas resistentes para excursiones en la montaña.', 25, 10, 50, '3000', '5000', '2021-05-15', 'img_productossinimagen', '2023-02-18 08:36:21', '2023-08-21 14:27:45', 4, 3),
(195, 'p-00013', 'Camisa a Cuadros', 'Camisa de algodón a cuadros, ideal para uso diario.', 15, 5, 30, '2000', '3500', '2022-07-10', 'img_productossinimagen', '2023-11-30 11:45:33', '2023-12-25 09:18:12', 7, 1),
(196, 'p-00014', 'Gafas de Sol', 'Gafas de sol con protección UV, perfectas para el verano.', 35, 15, 50, '1500', '2500', '2020-12-28', 'img_productossinimagen', '2022-09-05 16:42:58', '2023-06-12 07:59:24', 3, 2),
(197, 'p-00015', 'Linterna LED', 'Linterna de mano con tecnología LED de alta luminosidad.', 40, 20, 60, '800', '1500', '2019-11-20', 'img_productossinimagen', '2022-03-14 09:23:17', '2022-12-01 12:50:09', 4, 7),
(198, 'p-00016', 'Botines de Cuero', 'Botines de cuero elegantes y duraderos.', 20, 10, 30, '4000', '6000', '2021-09-05', 'img_productossinimagen', '2023-03-18 13:28:45', '2023-10-22 17:55:37', 7, 3),
(199, 'p-00017', 'Mochila de Montaña', 'Mochila resistente con múltiples compartimentos para excursiones.', 30, 15, 40, '2500', '4000', '2020-08-10', 'img_productossinimagen', '2022-05-20 10:17:33', '2023-01-15 14:42:57', 3, 4),
(200, 'p-00018', 'Bufanda de Lana', 'Bufanda de lana suave y abrigada para el invierno.', 10, 5, 20, '1000', '2000', '2023-02-15', 'img_productossinimagen', '2023-11-27 08:55:21', '2024-01-03 16:30:45', 4, 6),
(201, 'p-00019', 'Zapatillas Deportivas', 'Zapatillas deportivas cómodas y resistentes.', 50, 30, 70, '3500', '5500', '2020-04-30', 'img_productossinimagen', '2022-02-04 14:37:52', '2023-09-10 10:20:28', 7, 3),
(202, 'p-00020', 'Gorra de Béisbol', 'Gorra de béisbol ajustable para protección solar.', 38, 25, 60, '1200', '1800', '2019-06-20', 'img_productossinimagen', '2022-01-08 11:28:36', '2022-11-15 15:45:12', 3, 1),
(203, 'p-00021', 'Chaqueta Impermeable', 'Chaqueta impermeable para días lluviosos.', 20, 10, 30, '5000', '8000', '2022-10-05', 'img_productossinimagen', '2023-08-14 09:34:27', '2023-12-20 12:15:50', 4, 5),
(204, 'p-00022', 'Termo de Acero Inoxidable', 'Termo de acero inoxidable para mantener las bebidas calientes.', 60, 40, 80, '1500', '3000', '2021-03-12', 'img_productossinimagen', '2023-01-05 13:20:45', '2023-10-28 16:55:30', 7, 8),
(205, 'p-00023', 'Pantalones Cargo', 'Pantalones cargo resistentes y con múltiples bolsillos.', 25, 15, 35, '2800', '4500', '2020-02-18', 'img_productossinimagen', '2022-06-25 08:47:59', '2023-04-01 11:30:22', 3, 2),
(206, 'p-00024', 'Reloj Inteligente', 'Reloj inteligente con múltiples funciones y pantalla táctil.', 30, 20, 40, '6000', '9000', '2021-08-30', 'img_productossinimagen', '2023-04-12 14:26:37', '2023-11-05 18:10:15', 4, 7),
(207, 'p-00025', 'Chaleco de Pesca', 'Chaleco de pesca con múltiples bolsillos y ajustable.', 15, 8, 20, '3500', '5500', '2023-04-20', 'img_productossinimagen', '2023-11-29 09:35:42', '2024-01-20 13:05:55', 7, 7),
(208, 'p-00026', 'Guantes Térmicos', 'Guantes térmicos ideales para actividades al aire libre en invierno.', 40, 25, 50, '1800', '2800', '2022-12-10', 'img_productossinimagen', '2023-09-15 11:40:28', '2024-02-02 15:20:40', 3, 6),
(209, 'p-00027', 'Cámara Deportiva', 'Cámara deportiva resistente al agua y con alta resolución.', 20, 10, 30, '4000', '7000', '2020-10-25', 'img_productossinimagen', '2022-07-04 16:55:37', '2023-03-08 18:30:45', 4, 7),
(210, 'p-00028', 'Botella Térmica', 'Botella térmica de acero inoxidable para mantener las bebidas frías.', 35, 20, 50, '1200', '2200', '2021-05-30', 'img_productossinimagen', '2023-01-18 08:20:12', '2023-10-15 10:45:28', 7, 8),
(211, 'p-00029', 'Canguro de Viaje', 'Canguro de viaje con múltiples compartimentos y ajustable.', 25, 15, 30, '2000', '3500', '2022-08-15', 'img_productossinimagen', '2023-05-22 12:40:55', '2024-01-10 14:25:40', 3, 3),
(212, 'p-00030', 'Paraguas Plegable', 'Paraguas plegable resistente al viento y compacto.', 50, 30, 60, '1500', '2500', '2020-11-12', 'img_productossinimagen', '2022-06-10 09:15:28', '2023-02-20 11:30:15', 4, 5),
(213, 'p-00031', 'Cinturón de Cuero', 'Cinturón de cuero clásico y duradero.', 30, 15, 40, '1800', '2800', '2021-09-20', 'img_productossinimagen', '2023-03-28 13:50:40', '2023-11-25 17:10:28', 7, 6),
(214, 'p-00032', 'Gorro de Lana', 'Gorro de lana suave y abrigado para el invierno.', 20, 10, 25, '1000', '1800', '2023-01-05', 'img_productossinimagen', '2023-08-10 10:25:18', '2024-02-15 14:40:55', 3, 6),
(215, 'p-00033', 'Zapatillas de Trekking', 'Zapatillas de trekking resistentes y con buena tracción.', 40, 25, 50, '4000', '6000', '2021-04-08', 'img_productossinimagen', '2023-01-12 09:35:28', '2023-09-18 11:50:20', 4, 3),
(216, 'p-00034', 'Manta de Picnic', 'Manta de picnic impermeable y con respaldo aislante.', 15, 8, 20, '2500', '4000', '2022-03-15', 'img_productossinimagen', '2023-11-22 14:20:45', '2024-01-28 18:05:30', 7, 5),
(217, 'p-00035', 'Cuchillo Multiusos', 'Cuchillo multiusos con múltiples funciones y hoja de acero inoxidable.', 25, 15, 30, '1800', '3000', '2020-09-10', 'img_productossinimagen', '2022-05-28 12:40:55', '2023-02-20 15:10:28', 3, 7),
(218, 'p-00036', 'Chubasquero Infantil', 'Chubasquero infantil con divertidos diseños y resistente al agua.', 30, 20, 40, '1200', '2000', '2021-06-25', 'img_productossinimagen', '2023-02-08 08:55:28', '2023-10-15 11:30:15', 4, 5),
(219, 'p-00037', 'Termo de Viaje', 'Termo de viaje de acero inoxidable con tapa aislante.', 40, 25, 50, '2000', '3500', '2020-08-20', 'img_productossinimagen', '2022-04-15 09:20:45', '2023-01-10 13:05:30', 7, 8),
(220, 'p-00038', 'Gorro de Natación', 'Gorro de natación ajustable y resistente al cloro.', 20, 10, 25, '500', '1200', '2022-11-30', 'img_productossinimagen', '2023-09-05 11:40:18', '2024-02-15 15:20:55', 3, 6),
(221, 'p-00039', 'Pantalones Vaqueros', 'Pantalones vaqueros clásicos y cómodos para uso diario.', 35, 20, 45, '2800', '4500', '2021-02-10', 'img_productossinimagen', '2023-10-18 13:25:30', '2024-01-25 17:10:28', 4, 2),
(222, 'p-00040', 'Saco de Dormir', 'Saco de dormir ligero y compacto para acampar.', 15, 8, 20, '3500', '5500', '2023-05-15', 'img_productossinimagen', '2024-01-22 09:35:28', '2024-03-10 11:50:20', 7, 4),
(223, 'p-00041', 'Cámara Fotográfica', 'Cámara fotográfica digital de alta resolución.', 25, 15, 30, '4000', '7000', '2020-12-08', 'img_productossinimagen', '2022-07-15 12:40:55', '2023-03-20 15:10:28', 3, 7),
(224, 'p-00042', 'Sudadera con Capucha', 'Sudadera con capucha y bolsillo canguro.', 20, 10, 25, '1500', '2500', '2022-06-20', 'img_productossinimagen', '2023-03-08 08:55:28', '2023-11-15 11:30:15', 4, 5),
(225, 'p-00043', 'Botiquín de Primeros Auxilios', 'Botiquín completo con material de primeros auxilios.', 40, 25, 50, '2000', '3500', '2021-01-30', 'img_productossinimagen', '2023-09-05 11:40:18', '2024-02-15 15:20:55', 7, 1),
(226, 'p-00044', 'Termómetro Digital', 'Termómetro digital para medir la temperatura corporal.', 30, 20, 40, '800', '1500', '2020-10-15', 'img_productossinimagen', '2022-05-20 13:25:30', '2023-02-25 17:10:28', 3, 1),
(227, 'p-00045', 'Mochila Escolar', 'Mochila escolar con compartimento para portátil y varios bolsillos.', 45, 30, 60, '3000', '5000', '2021-09-05', 'img_productossinimagen', '2023-04-12 14:20:45', '2023-12-20 18:05:30', 4, 1),
(228, 'p-00046', 'Reloj Despertador', 'Reloj despertador digital con luz LED y alarma.', 20, 10, 25, '500', '1200', '2022-12-30', 'img_productossinimagen', '2023-10-05 09:40:18', '2024-03-15 13:20:55', 7, 7),
(229, 'p-00047', 'Cartera de Cuero', 'Cartera de cuero con múltiples compartimentos y cierre de cremallera.', 25, 15, 30, '1800', '2800', '2022-03-15', 'img_productossinimagen', '2023-11-20 12:35:30', '2024-02-25 16:10:28', 3, 1),
(230, 'p-00048', 'Linterna Frontal', 'Linterna frontal recargable con luz LED y ajustable.', 30, 20, 40, '1000', '2000', '2021-06-20', 'img_productossinimagen', '2023-01-28 13:25:45', '2023-09-05 17:10:28', 4, 7),
(231, 'p-00049', 'Manta Eléctrica', 'Manta eléctrica con diferentes niveles de temperatura.', 15, 8, 20, '3500', '5500', '2023-01-10', 'img_productossinimagen', '2023-09-15 14:30:18', '2024-02-20 18:20:55', 7, 5),
(232, 'p-00050', 'Maletín de Viaje', 'Maletín de viaje con ruedas y asa retráctil.', 40, 25, 50, '4000', '7000', '2020-07-25', 'img_productossinimagen', '2022-04-30 10:40:28', '2023-01-05 15:20:45', 3, 4),
(233, 'p-00051', 'Gafas de Natación', 'Gafas de natación antivaho y con protección UV.', 20, 10, 25, '800', '1500', '2022-10-30', 'img_productossinimagen', '2023-07-05 11:45:18', '2024-01-10 14:30:55', 4, 8),
(234, 'p-00052', 'Mochila Táctica', 'Mochila táctica resistente al agua y con múltiples compartimentos.', 35, 20, 45, '2500', '4000', '2021-04-15', 'img_productossinimagen', '2023-01-22 14:25:30', '2023-09-28 18:10:28', 7, 4),
(235, 'p-00053', 'Bolsa de Dormir', 'Bolsa de dormir ligera y compacta para acampar.', 25, 15, 30, '3000', '5000', '2023-02-20', 'img_productossinimagen', '2023-10-25 09:30:45', '2024-04-01 13:20:55', 3, 4),
(236, 'p-00054', 'Cámara de Vigilancia', 'Cámara de vigilancia con visión nocturna y detección de movimiento.', 30, 20, 40, '6000', '9000', '2020-09-10', 'img_productossinimagen', '2022-06-15 12:35:18', '2023-02-20 16:20:28', 4, 7),
(237, 'p-00055', 'Estuche de Maquillaje', 'Estuche de maquillaje con espejo y compartimentos.', 15, 8, 20, '1200', '2000', '2022-05-05', 'img_productossinimagen', '2023-01-10 14:40:45', '2023-08-15 18:20:55', 7, 3),
(238, 'p-00056', 'Paraguas Transparente', 'Paraguas transparente con mango de plástico.', 40, 25, 50, '1000', '1800', '2021-01-20', 'img_productossinimagen', '2022-08-25 09:45:18', '2023-04-01 13:30:28', 3, 5),
(239, 'p-00057', 'Bolso Deportivo', 'Bolso deportivo con compartimentos y correa ajustable.', 20, 10, 25, '2500', '4000', '2023-03-30', 'img_productossinimagen', '2023-11-05 11:50:45', '2024-03-10 15:30:55', 4, 1),
(240, 'p-00058', 'Termómetro de Cocina', 'Termómetro de cocina digital para medir la temperatura de los alimentos.', 35, 20, 40, '800', '1500', '2020-07-15', 'img_productossinimagen', '2022-02-20 12:55:18', '2023-01-28 16:40:28', 7, 6),
(241, 'p-00059', 'Mochila Infantil', 'Mochila infantil con diseño de personajes infantiles.', 25, 15, 30, '1800', '2800', '2022-04-30', 'img_productossinimagen', '2023-01-05 14:40:45', '2023-09-10 18:20:55', 3, 1),
(242, 'p-00060', 'Set de Herramientas', 'Set de herramientas completo con destornilladores, alicates y más.', 30, 20, 40, '4000', '7000', '2021-01-10', 'img_productossinimagen', '2022-08-15 13:35:18', '2023-04-20 17:20:28', 4, 7),
(243, 'p-00061', 'Silla de Camping', 'Silla de camping plegable y resistente.', 15, 8, 20, '3500', '5500', '2023-06-20', 'img_productossinimagen', '2024-02-25 10:50:45', '2024-05-01 14:30:55', 7, 1),
(244, 'p-00062', 'Kit de Costura', 'Kit de costura con hilos, agujas y botones.', 40, 25, 50, '1000', '2000', '2020-10-30', 'img_productossinimagen', '2022-06-05 11:45:18', '2023-02-10 15:30:28', 3, 7),
(245, 'p-00063', 'Bicicleta Plegable', 'Bicicleta plegable de aluminio con cambios y frenos de disco.', 20, 10, 25, '5000', '8000', '2022-09-15', 'img_productossinimagen', '2023-04-20 14:40:45', '2023-12-25 18:20:55', 4, 8),
(246, 'p-00064', 'Máscara Facial', 'Máscara facial de arcilla para limpieza profunda de la piel.', 25, 15, 30, '1500', '2500', '2021-04-05', 'img_productossinimagen', '2022-11-10 15:35:18', '2023-07-15 19:20:28', 7, 1),
(247, 'p-00065', 'Gorro de Invierno', 'Gorro de invierno de lana con borlas.', 30, 20, 40, '800', '1500', '2020-11-20', 'img_productossinimagen', '2022-07-25 12:40:45', '2023-03-30 16:30:55', 3, 6),
(248, 'p-00066', 'Parches para Ropa', 'Parches adhesivos para reparar ropa.', 15, 8, 20, '500', '1200', '2023-03-15', 'img_productossinimagen', '2024-01-20 09:45:18', '2024-03-25 13:30:28', 4, 2),
(249, 'p-00067', 'Saco de Boxeo', 'Saco de boxeo de cuero reforzado y relleno resistente.', 40, 25, 50, '4000', '7000', '2021-02-05', 'img_productossinimagen', '2022-09-10 14:35:28', '2023-05-15 18:20:45', 7, 1),
(250, 'p-00068', 'Set de Té', 'Set de té con tetera, tazas y platillos.', 20, 10, 25, '2500', '4000', '2022-07-30', 'img_productossinimagen', '2023-04-05 15:40:45', '2023-12-10 19:30:55', 3, 2),
(251, 'p-00069', 'Colchoneta Inflable', 'Colchoneta inflable para piscina o playa.', 25, 15, 30, '1800', '2800', '2023-01-20', 'img_productossinimagen', '2023-09-25 16:45:18', '2024-03-01 20:30:28', 4, 2),
(252, 'p-00070', 'Tostadora Eléctrica', 'Tostadora eléctrica para hacer tostadas crujientes.', 30, 20, 40, '2000', '3500', '2020-12-15', 'img_productossinimagen', '2022-08-20 14:50:45', '2023-04-25 18:40:55', 7, 2),
(253, 'p-00071', 'Set de Pinceles', 'Set de pinceles de diferentes tamaños y cerdas.', 35, 20, 45, '1200', '2000', '2021-05-30', 'img_productossinimagen', '2023-01-05 16:55:18', '2023-09-10 20:40:28', 3, 5),
(254, 'p-00072', 'Pizarra Magnética', 'Pizarra magnética para escribir con marcadores.', 15, 8, 20, '3500', '5500', '2023-07-10', 'img_productossinimagen', '2024-03-15 10:45:45', '2024-05-20 14:30:55', 4, 6),
(255, 'p-00073', 'Set de Cuchillos', 'Set de cuchillos de cocina de acero inoxidable.', 25, 15, 30, '3000', '5000', '2020-09-25', 'img_productossinimagen', '2022-05-30 15:50:18', '2023-02-05 19:40:28', 7, 7),
(256, 'p-00074', 'Hervidor Eléctrico', 'Hervidor eléctrico para calentar agua rápidamente.', 40, 25, 50, '1800', '2800', '2021-01-30', 'img_productossinimagen', '2022-10-05 16:55:45', '2023-06-10 20:40:55', 3, 8),
(257, 'p-00075', 'Set de Brochas de Maquillaje', 'Set de brochas de maquillaje profesionales.', 20, 10, 25, '2500', '4000', '2022-08-05', 'img_productossinimagen', '2023-04-10 17:00:18', '2023-12-15 20:45:28', 4, 2),
(258, 'p-00076', 'Sartén Antiadherente', 'Sartén antiadherente de alta calidad y durabilidad.', 30, 20, 35, '2000', '3500', '2020-10-20', 'img_productossinimagen', '2022-06-25 16:55:45', '2023-02-28 20:40:55', 7, 3),
(259, 'p-00077', 'Set de Manicura', 'Set de manicura completo con cortaúñas, lima y pinzas.', 15, 8, 20, '800', '1500', '2023-08-10', 'img_productossinimagen', '2024-04-15 11:00:18', '2024-06-20 14:45:28', 3, 1),
(260, 'p-00078', 'Organizador de Joyas', 'Organizador de joyas con múltiples compartimentos.', 25, 15, 30, '1200', '2000', '2021-02-15', 'img_productossinimagen', '2022-09-20 17:05:45', '2023-05-25 20:50:55', 4, 2),
(261, 'p-00079', 'Cafetera Express', 'Cafetera express para preparar café en minutos.', 40, 25, 45, '3000', '5000', '2020-12-30', 'img_productossinimagen', '2022-08-05 17:10:18', '2023-04-10 20:55:28', 7, 3),
(262, 'p-00080', 'Set de Velas Aromáticas', 'Set de velas aromáticas para crear ambientes acogedores.', 20, 10, 25, '1800', '2800', '2022-09-30', 'img_productossinimagen', '2023-04-05 18:10:45', '2023-12-10 21:45:55', 3, 3),
(263, 'p-00081', 'Almohada de Viaje', 'Almohada de viaje ergonómica para descansar en los viajes.', 25, 15, 30, '500', '1200', '2023-03-25', 'img_productossinimagen', '2024-01-30 11:15:18', '2024-04-05 14:00:28', 4, 5),
(264, 'p-00082', 'Set de Tazas de Café', 'Set de tazas de café de porcelana con platillos.', 30, 20, 35, '800', '1500', '2020-11-10', 'img_productossinimagen', '2022-07-15 17:20:45', '2023-03-20 21:05:55', 7, 6),
(265, 'p-00083', 'Kit de Barbecue', 'Kit de barbecue con utensilios de acero inoxidable y estuche.', 15, 8, 20, '3500', '5500', '2023-05-30', 'img_productossinimagen', '2024-02-05 12:20:18', '2024-06-10 15:05:28', 3, 3),
(266, 'p-00084', 'Tetera de Hierro Fundido', 'Tetera de hierro fundido con filtro de acero inoxidable.', 40, 25, 50, '1500', '2500', '2021-02-25', 'img_productossinimagen', '2022-09-30 18:25:45', '2023-06-05 22:10:55', 4, 3),
(267, 'p-00085', 'Afeitadora Eléctrica', 'Afeitadora eléctrica recargable con cabezales giratorios.', 20, 10, 25, '2000', '3500', '2022-10-10', 'img_productossinimagen', '2023-05-15 17:30:18', '2024-01-20 21:15:28', 7, 3),
(268, 'p-00086', 'Set de Té Matcha', 'Set de té matcha con batidor de bambú y cuenco.', 25, 15, 30, '2500', '4000', '2021-06-05', 'img_productossinimagen', '2023-01-10 12:40:45', '2023-09-15 16:20:55', 3, 2),
(269, 'p-00087', 'Báscula Digital', 'Báscula digital para cocina con pantalla LCD.', 30, 20, 35, '800', '1500', '2020-12-20', 'img_productossinimagen', '2022-08-25 18:35:18', '2023-04-30 22:20:28', 4, 1),
(270, 'p-00088', 'Set de Vasos de Whisky', 'Set de vasos de whisky de cristal de alta calidad.', 35, 20, 40, '1800', '2800', '2021-07-05', 'img_productossinimagen', '2023-02-10 17:50:45', '2023-10-15 21:35:55', 7, 2),
(271, 'p-00089', 'Aparato de Abdominales', 'Aparato de abdominales plegable y ajustable.', 15, 8, 20, '3500', '5500', '2023-02-10', 'img_productossinimagen', '2023-10-15 11:00:18', '2024-04-20 14:45:28', 3, 8),
(272, 'p-00090', 'Termómetro de Frente', 'Termómetro de frente digital para medir la temperatura corporal.', 40, 25, 45, '1500', '2500', '2020-10-05', 'img_productossinimagen', '2022-06-10 17:55:45', '2023-02-15 21:40:55', 4, 1),
(273, 'p-00091', 'Set de Pinturas Acrílicas', 'Set de pinturas acrílicas de colores surtidos.', 20, 10, 25, '2000', '3500', '2022-08-20', 'img_productossinimagen', '2023-04-25 18:10:18', '2024-01-30 22:15:28', 7, 5),
(274, 'p-00092', 'Bandeja de Servicio', 'Bandeja de servicio de madera con asas.', 25, 15, 30, '800', '1500', '2021-02-25', 'img_productossinimagen', '2022-09-30 18:25:45', '2023-06-05 22:10:55', 3, 6),
(275, 'p-00093', 'Set de Herramientas para Barbacoa', 'Set de herramientas para barbacoa con estuche de aluminio.', 30, 20, 35, '2000', '3500', '2020-11-10', 'img_productossinimagen', '2022-07-15 17:40:18', '2023-03-20 21:25:28', 4, 7),
(276, 'p-00094', 'Hervidor de Agua', 'Hervidor de agua eléctrico de acero inoxidable.', 35, 20, 40, '1500', '2500', '2021-07-25', 'img_productossinimagen', '2023-02-28 18:55:45', '2023-11-05 22:40:55', 7, 2),
(277, 'p-00095', 'Kit de Limpieza de Zapatos', 'Kit de limpieza de zapatos con cepillos y cremas.', 15, 8, 20, '3500', '5500', '2023-03-20', 'img_productossinimagen', '2024-01-25 12:20:18', '2024-05-01 16:05:28', 3, 3),
(278, 'p-00096', 'Caja de Almacenamiento', 'Caja de almacenamiento de tela con tapa y asas.', 20, 10, 25, '800', '1500', '2022-08-05', 'img_productossinimagen', '2023-04-10 17:30:45', '2023-12-15 21:15:55', 4, 5),
(279, 'p-00097', 'Cepillo Eléctrico para Mascotas', 'Cepillo eléctrico para mascotas con cerdas suaves.', 25, 15, 30, '2000', '3500', '2021-03-10', 'img_productossinimagen', '2022-10-15 18:45:18', '2023-06-20 22:30:28', 7, 1),
(280, 'p-00098', 'Set de Utensilios de Cocina', 'Set de utensilios de cocina de silicona antiadherente.', 30, 20, 35, '1500', '2500', '2020-12-25', 'img_productossinimagen', '2022-07-30 18:40:45', '2023-04-05 22:25:55', 3, 2),
(281, 'p-00099', 'Set de Toallas de Baño', 'Set de toallas de baño de algodón egipcio.', 35, 20, 40, '3500', '5500', '2021-08-10', 'img_productossinimagen', '2023-03-15 19:55:18', '2023-11-20 23:40:28', 4, 5),
(282, 'p-00100', 'Batidora de Mano', 'Batidora de mano con accesorios para mezclar y triturar.', 40, 25, 50, '2000', '3500', '2020-10-30', 'img_productossinimagen', '2022-06-05 18:50:45', '2023-02-10 22:35:55', 7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_carrito`
--

CREATE TABLE `tb_carrito` (
  `id_carrito` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_carrito`
--

INSERT INTO `tb_carrito` (`id_carrito`, `nro_venta`, `id_producto`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(2, 1, 3, 2, '2024-04-04 15:09:46', '0000-00-00 00:00:00'),
(4, 1, 1, 3, '2024-04-04 21:03:37', '0000-00-00 00:00:00'),
(5, 2, 1, 2, '2024-04-10 09:57:40', '0000-00-00 00:00:00'),
(6, 2, 2, 2, '2024-04-10 10:14:29', '0000-00-00 00:00:00'),
(7, 3, 2, 2, '2024-04-10 20:15:37', '0000-00-00 00:00:00'),
(0, 18, 1, 1, '2024-04-14 02:55:30', '0000-00-00 00:00:00'),
(0, 20, 1, 1, '2024-04-14 13:41:07', '0000-00-00 00:00:00'),
(0, 20, 1, 1, '2024-04-14 13:41:21', '0000-00-00 00:00:00'),
(0, 20, 202, 1, '2024-04-14 13:53:51', '0000-00-00 00:00:00'),
(0, 24, 265, 1, '2024-04-14 16:42:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ciudades`
--

CREATE TABLE `tb_ciudades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_ciudades`
--

INSERT INTO `tb_ciudades` (`id`, `nombre`) VALUES
(1, 'La Plata'),
(2, 'Mar del Plata'),
(3, 'Bahía Blanca'),
(4, 'Tandil'),
(5, 'San Nicolás'),
(6, 'San Fernando del Valle de Catamarca'),
(7, 'San Antonio'),
(8, 'La Merced'),
(9, 'Andalgalá'),
(10, 'Tinogasta'),
(11, 'Resistencia'),
(12, 'Barranqueras'),
(13, 'Presidencia Roque Sáenz Peña'),
(14, 'Villa Ángela'),
(15, 'Charata'),
(16, 'Comodoro Rivadavia'),
(17, 'Trelew'),
(18, 'Puerto Madryn'),
(19, 'Esquel'),
(20, 'Rawson'),
(21, 'Córdoba'),
(22, 'Villa María'),
(23, 'Río Cuarto'),
(24, 'San Francisco'),
(25, 'Alta Gracia'),
(26, 'Corrientes'),
(27, 'Goya'),
(28, 'Mercedes'),
(29, 'Santo Tomé'),
(30, 'Curuzú Cuatiá'),
(31, 'Paraná'),
(32, 'Concordia'),
(33, 'Gualeguaychú'),
(34, 'Concepción del Uruguay'),
(35, 'Villaguay'),
(36, 'Formosa'),
(37, 'Clorinda'),
(38, 'Pirané'),
(39, 'Laguna Blanca'),
(40, 'El Colorado'),
(41, 'San Salvador de Jujuy'),
(42, 'Palpalá'),
(43, 'San Pedro'),
(44, 'Libertador General San Martín'),
(45, 'Humahuaca'),
(46, 'Santa Rosa'),
(47, 'General Pico'),
(48, 'Toay'),
(49, 'Realicó'),
(50, 'General Acha'),
(51, 'La Rioja'),
(52, 'Chilecito'),
(53, 'Aimogasta'),
(54, 'Villa Unión'),
(55, 'Chamical'),
(56, 'Mendoza'),
(57, 'San Rafael'),
(58, 'Godoy Cruz'),
(59, 'Luján de Cuyo'),
(60, 'Maipú'),
(61, 'Posadas'),
(62, 'Puerto Iguazú'),
(63, 'Eldorado'),
(64, 'Montecarlo'),
(65, 'San Vicente'),
(66, 'Neuquén'),
(67, 'Centenario'),
(68, 'Plottier'),
(69, 'Cutral Có'),
(70, 'Zapala'),
(71, 'Viedma'),
(72, 'San Carlos de Bariloche'),
(73, 'General Roca'),
(74, 'Cipolletti'),
(75, 'Allen'),
(76, 'Salta'),
(77, 'San Ramón de la Nueva Orán'),
(78, 'San Salvador de Jujuy'),
(79, 'Tartagal'),
(80, 'Cafayate'),
(81, 'San Juan'),
(82, 'Rivadavia'),
(83, 'Rawson'),
(84, 'Pocito'),
(85, 'Chimbas'),
(86, 'San Luis'),
(87, 'Villa Mercedes'),
(88, 'Merlo'),
(89, 'La Toma'),
(90, 'Juana Koslay'),
(91, 'Río Gallegos'),
(92, 'Caleta Olivia'),
(93, 'Puerto San Julián'),
(94, 'Pico Truncado'),
(95, 'Puerto Deseado'),
(96, 'Santa Fe'),
(97, 'Rosario'),
(98, 'Venado Tuerto'),
(99, 'Reconquista'),
(100, 'Rafaela'),
(101, 'Santiago del Estero'),
(102, 'La Banda'),
(103, 'Termas de Río Hondo'),
(104, 'Fernández'),
(105, 'Añatuya'),
(106, 'Ushuaia'),
(107, 'Río Grande'),
(108, 'Tolhuin'),
(109, 'Puerto Almanza'),
(110, 'San Sebastián'),
(111, 'San Miguel de Tucumán'),
(112, 'Concepción'),
(113, 'Yerba Buena'),
(114, 'Tafí Viejo'),
(115, 'Banda del Río Salí');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `saldo` decimal(6,2) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `saldo`, `id_persona`, `id_empresa`) VALUES
(3, 2345.00, NULL, 2),
(4, 2323.48, 48, NULL),
(6, 9999.99, 46, NULL),
(7, 0.00, 45, NULL),
(9, 0.00, NULL, 70),
(10, 0.00, NULL, 71),
(11, 0.00, NULL, 72),
(15, 0.00, 54, NULL),
(16, 0.00, 55, NULL),
(17, 0.00, 1, NULL),
(18, 0.00, 2, NULL),
(19, 0.00, 3, NULL),
(20, 0.00, 9, NULL),
(21, 0.00, 11, NULL),
(22, 0.00, 12, NULL),
(23, 0.00, 13, NULL),
(24, 0.00, 19, NULL),
(25, 0.00, 21, NULL),
(26, 0.00, 22, NULL),
(27, 0.00, 23, NULL),
(28, 0.00, 24, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nro_compra` int(11) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `comprobante` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio_compra` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_compras`
--

INSERT INTO `tb_compras` (`id_compra`, `id_producto`, `nro_compra`, `fecha_compra`, `id_proveedor`, `comprobante`, `id_usuario`, `precio_compra`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 1, 1, '2024-03-22 00:00:00', 1, 'q4234v34', 4, '12342', 1, '2024-03-22 21:21:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_domicilios`
--

CREATE TABLE `tb_domicilios` (
  `id_domicilio` int(11) NOT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `piso` varchar(5) DEFAULT NULL,
  `depto` varchar(2) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_domicilios`
--

INSERT INTO `tb_domicilios` (`id_domicilio`, `calle`, `numero`, `piso`, `depto`, `id_ciudad`, `id_provincia`) VALUES
(1, 'belgrano', '1345', '', '', 0, 0),
(2, 'Talleres Volcán', '2226', NULL, NULL, 95, 2),
(3, 'España', '2845', '3', '5', NULL, NULL),
(4, 'No hay registro', '', '', '', NULL, NULL),
(5, 'Ameghino', '2345', '', '', NULL, NULL),
(6, 'Ameghino', '2345', '', '', NULL, NULL),
(7, 'Ameghino', '2345', '', '', NULL, NULL),
(8, 'Talleres Volcánx', '1328', '', '', NULL, NULL),
(9, 'belgrano', '1567', '', '', NULL, NULL),
(10, 'Talleres Volcánx', '1234', '', '', NULL, NULL),
(11, 'Ameghino', '1245', '', '', NULL, NULL),
(12, 'Rivadavia', '2000', '', '', NULL, NULL),
(14, 'colon', '1755', '3', '', NULL, NULL),
(15, 'rivadavia', '1762', '', '', NULL, NULL),
(16, 'Alte Brown ', '1800', '', '', NULL, NULL),
(17, '', '', '', '', NULL, NULL),
(18, '', '', '', '', NULL, NULL),
(19, 'vdvfdv', '3453', '', '', NULL, NULL),
(20, 'Estrada', '1324', '', '', NULL, NULL),
(21, 'Mariano Moreno ', '1654', '2', 'B', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empresas`
--

CREATE TABLE `tb_empresas` (
  `id_empresa` int(11) NOT NULL,
  `cuit` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `id_domicilio` smallint(50) NOT NULL DEFAULT 4,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `persona_autorizada` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_empresas`
--

INSERT INTO `tb_empresas` (`id_empresa`, `cuit`, `nombre`, `razon_social`, `id_domicilio`, `telefono`, `email`, `persona_autorizada`) VALUES
(1, '20-7645869-9', 'Vieirasa', 'Vieira Argentina S.A.', 1, '2974345837', 'vieiraargentinasociedadanonima@gmail.com', 'Carlos Baute. 2976536432'),
(2, '20-10234567-9', 'Coserena', 'CO SE RE NA S.A.', 4, '2975443982', 'coserenasa@gmail.com', 'Alejandro Acuña. Tel. 2974567975. Nestor Benitez. '),
(3, '30-71234568-2', 'Bahia ', 'Bahia S.A.', 2, '4552-7844', 'ventas@bahia.com', 'Gonzalo Bustos. 2075674675'),
(4, '33-69345023-9', 'ADMINISTRACION FEDERAL DE INGRESOS PUBLICOS', 'ADMINISTRACION FEDERAL DE INGRESOS PUBLICOS', 2, '397656476', 'afip@gmail.com', 'Nestor Gutierrez '),
(5, '30-70852966-1', 'Argula S.A.', 'ARGULA_SA', 4, '4755-2411', 'info@argula.com', ''),
(6, '30-71234568-2', 'Bahía S.A.', 'BAHIA_SA', 4, '4552-7844', 'ventas@bahia.com', ''),
(7, '30-50000845-4', 'Banco CC', 'BANCO_CC', 4, '4567-8901', '', ''),
(8, '', 'BKP S.A.', 'BKP_SA', 4, '', '', ''),
(9, '', 'Correo Express SA', 'CORREO_EXPRESS_SA', 4, '', '', ''),
(10, '30-85471235-3', 'Crater S.R.L', 'CRATER_SRL', 4, '4785-9652', 'atencion@crater.com', ''),
(11, '30-50023142-4', 'Dunas S.A.', 'DUNAS_SA', 4, '4784-5114', 'info@dunas.com', ''),
(12, '30-65478123-5', 'Estrada S.A.', 'ESTRADA_SA', 4, '4874-4199', 'ventas@estrada.com', ''),
(13, '30-70412377-6', 'Fuxer S.R.L', 'FUXER_SRL', 4, '4788-5222', 'atencion@fuxer.com', ''),
(14, '20-18412344-7', 'Gabriel Castro', 'GABRIEL_CASTRO', 4, '4792-5447', 'atencion@gabrielcastro.com', ''),
(15, '', 'García Hnos S.A.', 'GARCIA_HNOS_SA', 4, '', '', ''),
(16, '30-57365208-4', 'González y Asociados SA', 'GONZALEZ_Y_ASOCIADOS_SA', 4, '', '', ''),
(17, '30-70065787-8', 'Hipermax S.A.', 'HIPERMAX_SA', 4, '48774122', 'info@hipermax.com', ''),
(18, '23-25647855-9', 'Ignacio Giménez', 'IGNACIO_GIMENEZ', 4, '47124577', 'ventas@ignaciogimenez.com', ''),
(19, '', 'Insumos Tecno SA', 'INSUMOS_TECNO_SA', 4, '', '', ''),
(20, '', 'Interactive S.A.', 'INTERACTIVE_SA', 4, '', '', ''),
(21, '30-69124499-3', 'ISP Canopler y Asoc.', 'ISP_CANOPLER_Y_ASOC', 4, '', '', ''),
(22, '30-69454936-1', 'Jonamex S.A.', 'JONAMEX_SA', 4, '', 'info@jonamex.com', ''),
(23, '20-22211017-4', 'José Torrente', 'JOSE_TORRENTE', 4, '', '', ''),
(24, '30-70992516-0', 'Kasiu S.A.', 'KASIU_SA', 4, '', 'ventas@kasiu.com', ''),
(25, '30-66507435-4', 'Ledesma S.A.I.C', 'LEDESMA_SAIC', 4, '', '', ''),
(26, '', 'Lidia Norma Marano', 'LIDIA_NORMA_MARANO', 4, '', '', ''),
(27, '30-55874122-4', 'Mirvan S.A.', 'MIRVAN_SA', 4, '', '', ''),
(28, '30-51424781-8', 'Palacios y Asociados', 'PALACIOS_Y_ASOCIADOS', 4, '', '', ''),
(29, '30-70021711-2', 'Rannochia S.R.L', 'RANNOCHIA_SRL', 4, '', '', ''),
(30, '30-63945397-5', 'Teléfonos S.A.', 'TELEFONOS_SA', 4, '', '', ''),
(31, '30-66945379-1', 'TelMax', 'TELMAX', 4, '', '', ''),
(32, '20-36724082-3', 'Transportes Jorgito S.A.', 'TRANSPORTES_JORGITO_SA', 4, '', '', ''),
(33, '30-54178541-4', 'Vixen S.A.', 'VIXEN_SA', 4, '', '', ''),
(34, '30-68731044-2', 'Worken SRL', 'WORKEN_SRL', 4, '', '', ''),
(35, '30-74859632-1', 'Construcciones del Sur S.A.', 'CONSTRUCCIONES_DEL_SUR_SA', 4, '4578-1234', 'info@construccionesdelsur.com', 'Carlos Rodríguez'),
(36, '30-82367415-6', 'Cafetería La Esquina', 'CAFETERIA_LA_ESQUINA', 4, '4567-8901', 'contacto@laesquina.com', 'María López'),
(37, '30-96235874-7', 'Distribuidora Central S.R.L.', 'DISTRIBUIDORA_CENTRAL_SRL', 4, '4789-1234', 'ventas@distribuidoracentral.com', 'Luis García'),
(38, '30-78523614-2', 'Hotel Plaza', 'HOTEL_PLAZA', 4, '4578-5678', 'reservas@hotelplaza.com', 'Ana Martínez'),
(39, '30-63257489-3', 'Panadería El Rosal', 'PANADERIA_EL_ROSAL', 4, '4567-9012', '', 'Juan Pérez'),
(40, '30-48573962-8', 'Transportes del Litoral S.A.', 'TRANSPORTES_DEL_LITORAL_SA', 4, '4789-5678', 'info@transporteslitoral.com', 'Lucía González'),
(41, '30-72589631-5', 'Imprenta Moderna', 'IMPRENTA_MODERNA', 4, '4578-9012', 'ventas@imprentamoderna.com', 'Pablo Fernández'),
(42, '30-96354782-4', 'Mueblería San Martín', 'MUEBLERIA_SAN_MARTIN', 4, '4567-1234', 'contacto@muebleriasanmartin.com', 'Elena Ruiz'),
(43, '30-78569314-1', 'Estudio Jurídico Suárez & Asociados', 'ESTUDIO_JURIDICO_SUAREZ_Y_ASOCIADOS', 4, '4789-9012', 'info@estudiosuarez.com', 'Gabriel Suárez'),
(44, '30-63287459-6', 'Farmacia del Sol', 'FARMACIA_DEL_SOL', 4, '4578-2345', 'contacto@farmaciadelsol.com', 'Laura Díaz'),
(45, '30-58621497-7', 'Ingeniería Industrial y Consultoría', 'INGENIERIA_INDUSTRIAL_Y_CONSULTORIA', 4, '4567-3456', 'info@ingenieriaindustrial.com', 'Diego López'),
(46, '30-74258963-8', 'Droguería San José', 'DROGUERIA_SAN_JOSE', 4, '4789-2345', 'ventas@drogueriasanjose.com', 'Marcela Pérez'),
(47, '30-96587412-3', 'Constructora y Desarrolladora Arquitectónica', 'CONSTRUCTORA_Y_DESARROLLADORA_ARQUITECTONICA', 4, '4578-3456', 'info@constructoradesarrolladora.com', 'Hernán Gómez'),
(48, '30-74125896-2', 'Taller Mecánico El Progreso', 'TALLER_MECANICO_EL_PROGRESO', 4, '4567-4567', 'contacto@tallerelprogreso.com', 'Carolina Castro'),
(49, '30-69874523-5', 'Veterinaria La Mascota Feliz', 'VETERINARIA_LA_MASCOTA_FELIZ', 4, '4789-3456', 'info@veterinariamascotafeliz.com', 'Mariano Martínez'),
(50, '30-85749632-1', 'Asesoría Contable y Fiscal García', 'ASESORIA_CONTABLE_Y_FISCAL_GARCIA', 4, '4578-4567', 'contacto@asesoriagarcia.com', 'Sofía García'),
(51, '30-63215987-4', 'Tienda de Ropa Fashion Style', 'TIENDA_DE_ROPA_FASHION_STYLE', 4, '4567-5678', 'ventas@fashionstyle.com', 'Roberto Sánchez'),
(52, '30-87459621-3', 'Estación de Servicio El Puma', 'ESTACION_DE_SERVICIO_EL_PUMA', 4, '4789-4567', 'info@elpuma.com', 'María Rodríguez'),
(53, '30-98741265-2', 'Centro de Estudios Los Andes', 'CENTRO_DE_ESTUDIOS_LOS_ANDES', 4, '4578-5678', 'info@centroestudiosandes.com', 'José López'),
(54, '30-65238479-1', 'Supermercado El Camino', 'SUPERMERCADO_EL_CAMINO', 4, '4567-6789', 'contacto@supermercadoelcamino.com', 'Ana González'),
(55, '30-78541236-4', 'Clínica Médica San Francisco', 'CLINICA_MEDICA_SAN_FRANCISCO', 4, '4789-5678', 'info@clinicasanfrancisco.com', 'Martín Pérez'),
(56, '30-36521487-5', 'Consultoría en Marketing Integral', 'CONSULTORIA_EN_MARKETING_INTEGRAL', 4, '4578-6789', 'contacto@marketingintegral.com', 'Valeria Rodríguez'),
(57, '30-85214763-2', 'Restaurante La Parrilla del Sur', 'RESTAURANTE_LA_PARRILLA_DEL_SUR', 4, '4567-7890', 'reservas@laparrilladelsur.com', 'Juan Martínez'),
(58, '30-98547123-1', 'Carnicería El Rancho', 'CARNICERIA_EL_RANCHO', 4, '4789-6789', 'contacto@carniceriaelrancho.com', 'María Fernández'),
(59, '30-74123698-5', 'Escuela de Idiomas Babel', 'ESCUELA_DE_IDIOMAS_BABEL', 4, '4578-7890', 'info@escuelababel.com', 'Pedro González'),
(60, '30-59874123-4', 'Estudio de Arquitectura Urbanística', 'ESTUDIO_DE_ARQUITECTURA_URBANISTICA', 4, '4567-8901', 'contacto@estudiourbanistica.com', 'Carolina Martínez'),
(61, '30-36985214-3', 'Gimnasio Fitness Center', 'GIMNASIO_FITNESS_CENTER', 4, '4789-7890', 'info@fitnesscenter.com', 'Andrés Suárez'),
(62, '20-984354-9', 'Escarlata', 'Escarlata S.A.', 4, '274563762', 'escarlatasa@gmail.com', 'Camilo Fuentes. 2974563782'),
(63, '20-33453654-9', 'Bacala', 'Bacala S.A.', 4, '975654352', 'bacalasa@gmail.com', 'Camilo Fuentes. 2974563782'),
(64, '20-9832485-9', 'Guliom', 'Guliom y Hermanos', 4, '02974032970', 'joseluisnievas123456@gmail.com', 'Carlos Olso. 2976536432'),
(65, '23-343546564-00', 'Bisonti', 'Bisonti S.A.', 4, '02974032970', 'joseluisnievas123456@gmail.com', 'Carlos Baute. 2976536432'),
(66, '20-3457647-9', 'Bitcoin', 'Bitcoin S.A.', 4, '2974573627', 'bitcoin@gmail.com', 'No tengo idea. 297456372'),
(67, '20-34567876-9', 'Gulom', 'Gulom S.A.', 4, '2974573627', 'gulomsa@gmail.com', 'Gloria'),
(70, '20-34567876-9', 'Iberconsa', 'Ibe}', 14, '2974573627', 'hiberconsasa@gmail.com', 'Chido Nahuelquin'),
(71, '20-7656345-7', 'Huerta', 'Huerta S.A.', 15, '2976547386', 'huertasa@gmail.com', 'Huerton suerton'),
(72, '20-32475643-9', 'Probando Cartel', 'Probando S.A.', 16, '2974573627', 'probandocartel@gmail.com', 'Pepe Nievas'),
(73, 'asd', 'asds', 'as', 17, 'asd', 'asdasd@d', 'asd'),
(74, 'dgdg', 'ads', 'asdasdfdgd', 18, 'dfgdfg', 'gdgdf@da', 'dwefwef'),
(75, 'grdg', 'sda', 'ggdrgdrgrgdr', 19, 'dgrgrd', 'gdgr@dfsdf.vl', 'sdvsdvdfvd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_envios`
--

CREATE TABLE `tb_envios` (
  `IdVenta` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_envios`
--

INSERT INTO `tb_envios` (`IdVenta`, `IdCliente`, `Direccion`, `estado`) VALUES
(5, 3, 'Salta 425', 'Pendiente de envio'),
(1, 9, 'Uruguay 1230', 'Enviado'),
(2, 4, 'Cjal Alonzo 950', 'Enviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_personas`
--

CREATE TABLE `tb_personas` (
  `id_persona` int(11) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_domicilio` smallint(6) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_personas`
--

INSERT INTO `tb_personas` (`id_persona`, `dni`, `nombre`, `apellido`, `telefono`, `email`, `id_domicilio`) VALUES
(1, 49293022, 'José Luis', 'Nievas', '2974032970', 'joseluisnievas@gmail.com', 2),
(2, 26219783, 'Verónica Alejandra', 'Diaz', '274310847', 'veronicaalejandradiaz@gmail.com', 2),
(3, 32465973, 'Juan Manuel', 'Perez', '2976546382', 'juanmanuelperez@gmail.com', 1),
(4, 40329841, 'María', 'González', '2977352845', 'mariagonzalez@hotmail.com', 1),
(5, 29874652, 'Carlos', 'López', '2975489321', 'carloslopez@yahoo.com', 1),
(6, 35678291, 'Ana', 'Martínez', '2976238745', 'anamartinez@gmail.com', 1),
(7, 28513974, 'Pedro', 'Rodríguez', '2974578231', 'pedrorodriguez@hotmail.com', 1),
(8, 41256983, 'Laura', 'Fernández', '2976758492', 'laurafernandez@yahoo.com', 1),
(9, 37468529, 'Diego', 'Sánchez', '2975829364', 'diegosanchez@gmail.com', 1),
(10, 42937851, 'Lucía', 'Pérez', '2977238456', 'luciaperez@hotmail.com', 1),
(11, 30678542, 'Sofía', 'Gómez', '2975983645', 'sofiagomez@yahoo.com', 1),
(12, 35896273, 'Manuel', 'Martín', '2976347852', 'manuelmartin@gmail.com', 1),
(13, 41758236, 'Elena', 'Díaz', '2977238456', 'elenadiaz@hotmail.com', 1),
(14, 29531876, 'Juan', 'Romero', '2975749238', 'juanromero@yahoo.com', 1),
(15, 36829475, 'Paula', 'Hernández', '2976452873', 'paulahernandez@gmail.com', 1),
(16, 40578293, 'Luis', 'Gutiérrez', '2977352649', 'luisgutierrez@hotmail.com', 1),
(17, 38162947, 'Carolina', 'Álvarez', '2975863792', 'carolinaalvarez@yahoo.com', 1),
(18, 41025739, 'Martín', 'Torres', '2976283745', 'martintorres@gmail.com', 1),
(19, 29736584, 'Marcela', 'Ruiz', '2975839264', 'marcelaruiz@hotmail.com', 1),
(20, 43527198, 'Jorge', 'Jiménez', '2977238456', 'jorgejimenez@yahoo.com', 1),
(21, 31264759, 'Andrea', 'Moreno', '2975846391', 'andreamoreno@gmail.com', 1),
(22, 37964128, 'Daniel', 'Castro', '2976457823', 'danielcastro@hotmail.com', 1),
(23, 40852637, 'Silvana', 'Ortega', '2977238456', 'silvanaortega@yahoo.com', 1),
(24, 32894716, 'Miguel', 'Suárez', '2975863412', 'miguelsuarez@gmail.com', 1),
(25, 41273895, 'Marina', 'Navarro', '2976728945', 'marinanavarro@hotmail.com', 1),
(26, 30428976, 'José', 'López', '2977358246', 'joselopez@yahoo.com', 1),
(27, 38974521, 'Valentina', 'García', '2975834672', 'valentinagarcia@gmail.com', 1),
(28, 41798532, 'Gabriel', 'Castillo', '2977238456', 'gabrielcastillo@hotmail.com', 1),
(29, 31325748, 'Camila', 'Fernández', '2975947283', 'camilafernandez@yahoo.com', 1),
(30, 39287451, 'Pablo', 'Gómez', '2976438752', 'pablogomez@gmail.com', 1),
(31, 43058296, 'Victoria', 'Díaz', '2977238456', 'victoriadiaz@hotmail.com', 1),
(32, 31846952, 'Javier', 'Martínez', '2975874392', 'javiermartinez@yahoo.com', 1),
(33, 39852471, 'Florencia', 'Romero', '2977329458', 'florenciaromero@gmail.com', 1),
(34, 42598763, 'Juan', 'Hernández', '2977238456', 'juanahernandez@hotmail.com', 1),
(35, 32418759, 'Carla', 'Gutiérrez', '2975764329', 'carlagutierrez@yahoo.com', 1),
(36, 40795236, 'Lucas', 'Sánchez', '2976543278', 'lucassanchez@gmail.com', 1),
(37, 33417859, 'Romina', 'González', '2977238456', 'rominagonzalez@hotmail.com', 1),
(38, 39284561, 'Facundo', 'Gómez', '2975896437', 'facundogomez@yahoo.com', 1),
(39, 42895137, 'Natalia', 'Torres', '2977238456', 'nataliatorres@gmail.com', 1),
(40, 31582946, 'Germán', 'Rodríguez', '2975382647', 'germanrodriguez@hotmail.com', 1),
(41, 40379125, 'Brenda', 'Suárez', '2977238456', 'brendasuarez@yahoo.com', 1),
(42, 33928571, 'Matías', 'López', '2975947382', 'matiaslopez@gmail.com', 1),
(43, 41963578, 'Romina', 'Martínez', '2977238456', 'rominamartinez@hotmail.com', 1),
(44, 32794856, 'Alejandro', 'García', '2975864219', 'alejandrogarcia@yahoo.com', 1),
(45, 40957283, 'Sol', 'Gómez', '2977238456', 'solgomez@gmail.com', 2),
(46, 34587291, 'Luciano', 'Fernández', '2975674329', 'lucianofernandez@hotmail.com', 1),
(47, 38892517, 'María', 'Díaz', '2977238456', 'mariadiaz@yahoo.com', 1),
(48, 31248795, 'Eduardo', 'Torresal', '31248795', 'eduardotorres@gmail.com', 1),
(49, 39475182, 'Solanges', 'Pérez', '39475182', 'solangeperez@hotmail.com', 1),
(50, 33182974, 'Federico', 'González', '2975728396', 'federicogonzalez@yahoo.com', 1),
(51, 41185693, 'Mariana', 'López', '2977238456', 'marianalopez@gmail.com', 1),
(52, 33798451, 'Maximiliano', 'Martínez', '2975863217', 'maximilianomartinez@hotmail.com', 1),
(54, 49765345, 'Anina Esmeralda', 'Azcurra', '2976543562', 'anina@gmail.com', 20),
(55, 2497653, 'Juan Carlos', 'Silva', '29756473453', 'juancsilva@gmail.com', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedores`
--

CREATE TABLE `tb_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `empresa` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_proveedores`
--

INSERT INTO `tb_proveedores` (`id_proveedor`, `nombre_proveedor`, `celular`, `telefono`, `empresa`, `email`, `direccion`, `fyh_creacion`, `fyh_actualizacion`, `id_empresa`, `id_persona`) VALUES
(1, 'Castillo Osvaldo', '3815605656', '011558699', 'Compaq S.A.', 'campaq@gmail.com', 'Alto del Parana 285', '2024-02-22 21:55:50', '2024-04-26 21:07:06', NULL, NULL),
(3, 'Agostino Roca', '381498586', '011252687', 'Techint', 'techint@gmail.com', 'Buenos Aires 155', '2024-02-22 22:39:32', '0000-00-00 00:00:00', NULL, NULL),
(6, 'Distribuidora Pampero', '297345645', '115674536', 'Pampero', 'distribucionespampero@gmail.com', 'Avda. Rostagno N° 1456', '2024-04-26 21:10:34', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_provincias`
--

CREATE TABLE `tb_provincias` (
  `id` tinyint(4) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_provincias`
--

INSERT INTO `tb_provincias` (`id`, `nombre`) VALUES
(1, 'Tierra del Fuego'),
(2, 'Santa Cruz'),
(3, 'Chubut'),
(4, 'Rio Negro'),
(5, 'Neuquen'),
(6, 'La Pampa'),
(7, 'San Luis'),
(8, 'Buenos Aires'),
(9, 'Entre Rios'),
(10, 'Santa Fe'),
(11, 'Cordoba'),
(12, 'Mendoza'),
(13, 'San Juan'),
(14, 'La Rioja'),
(15, 'Catamarca'),
(16, 'Tucuman'),
(17, 'Santiago del Estero'),
(18, 'Corrientes'),
(19, 'Chaco'),
(20, 'Misiones'),
(21, 'Formosa'),
(22, 'Jujuy'),
(23, 'Salta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id_rol`, `rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Administrador', '2024-01-04 18:44:11', '2024-01-04 18:44:11'),
(2, 'Contador', '2024-01-04 15:26:40', '0000-00-00 00:00:00'),
(3, 'Vendedor', '2024-01-04 15:27:19', '2024-01-04 16:29:40'),
(4, 'Almacen', '2024-01-04 15:29:41', '2024-01-04 18:07:17'),
(5, 'EyD', '2024-03-31 03:46:18', '2024-03-31 03:46:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password_user` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuarios`, `nombres`, `email`, `password_user`, `token`, `id_rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(3, 'Luciano Gilli', 'lucianogilli@gmail.com', '$2y$10$bntEgbORVnOvkNk7ysr7U.9X7s0oAhxXA5FZFxK4XVNqyqVNMkMru', '', 1, '2024-01-15 11:54:30', '2024-03-24 04:30:50'),
(4, 'Jose Nievas', 'josenievas@gmail.com', '$2y$10$ojD6/E7FaxXRuxt2GB5efuYf41kO/M/bnfM1vvYRunXOdjh4Fl1BK', '', 4, '2024-02-22 23:06:47', '0000-00-00 00:00:00'),
(7, 'El que vende', 'elquevende@gmail.com', '$2y$10$GS15wGw31OdfhQlnt2eFSu3yqZnyKrXgEEkvGhchIjrY/wPA1TBTe', '', 3, '2024-03-30 16:04:31', '0000-00-00 00:00:00'),
(8, 'Elqueenvia', 'elqueenvia@gmail.com', '$2y$10$T3QB51mL1YyaS6miumZnKOJfyQRaCgXjyrAEshtqpxprS3NtJbzAG', '', 5, '2024-04-19 00:49:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ventas`
--

CREATE TABLE `tb_ventas` (
  `id_venta` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total_pagado` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_ventas`
--

INSERT INTO `tb_ventas` (`id_venta`, `nro_venta`, `id_cliente`, `total_pagado`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 1, 9, 16000, '2024-04-10 09:42:33', '0000-00-00 00:00:00'),
(2, 2, 4, 14000, '2024-04-10 12:19:47', '0000-00-00 00:00:00'),
(5, 3, 3, 9000, '2024-04-10 20:16:07', '0000-00-00 00:00:00'),
(6, 3, 3, 9000, '2024-04-10 20:16:07', '0000-00-00 00:00:00'),
(0, 1, 7, 21900, '2024-04-13 15:02:35', '0000-00-00 00:00:00'),
(0, 1, 7, 21900, '2024-04-13 15:02:35', '0000-00-00 00:00:00'),
(0, 1, 7, 21900, '2024-04-13 15:02:35', '0000-00-00 00:00:00'),
(0, 1, 7, 21900, '2024-04-13 15:02:36', '0000-00-00 00:00:00'),
(0, 1, 9, 21900, '2024-04-14 00:59:36', '0000-00-00 00:00:00'),
(0, 1, 9, 21900, '2024-04-14 00:59:36', '0000-00-00 00:00:00'),
(0, 1, 9, 21900, '2024-04-14 00:59:36', '0000-00-00 00:00:00'),
(0, 1, 9, 21900, '2024-04-14 00:59:36', '0000-00-00 00:00:00'),
(0, 13, 11, 22500, '2024-04-14 01:18:12', '0000-00-00 00:00:00'),
(0, 13, 11, 22500, '2024-04-14 01:18:12', '0000-00-00 00:00:00'),
(0, 13, 11, 22500, '2024-04-14 01:18:12', '0000-00-00 00:00:00'),
(0, 16, 16, 0, '2024-04-14 01:32:00', '0000-00-00 00:00:00'),
(0, 17, 11, 0, '2024-04-14 02:28:11', '0000-00-00 00:00:00'),
(0, 18, 9, 2500, '2024-04-14 02:55:40', '0000-00-00 00:00:00'),
(0, 18, 9, 2500, '2024-04-14 02:55:40', '0000-00-00 00:00:00'),
(0, 20, 9, 6800, '2024-04-14 16:12:30', '0000-00-00 00:00:00'),
(0, 20, 9, 6800, '2024-04-14 16:12:30', '0000-00-00 00:00:00'),
(0, 20, 9, 6800, '2024-04-14 16:12:30', '0000-00-00 00:00:00'),
(0, 20, 9, 6800, '2024-04-14 16:12:30', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_acategorias`
--
ALTER TABLE `tb_acategorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tb_ciudades`
--
ALTER TABLE `tb_ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tb_domicilios`
--
ALTER TABLE `tb_domicilios`
  ADD PRIMARY KEY (`id_domicilio`);

--
-- Indices de la tabla `tb_empresas`
--
ALTER TABLE `tb_empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `tb_personas`
--
ALTER TABLE `tb_personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tb_provincias`
--
ALTER TABLE `tb_provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_acategorias`
--
ALTER TABLE `tb_acategorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT de la tabla `tb_ciudades`
--
ALTER TABLE `tb_ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_domicilios`
--
ALTER TABLE `tb_domicilios`
  MODIFY `id_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tb_empresas`
--
ALTER TABLE `tb_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `tb_personas`
--
ALTER TABLE `tb_personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_provincias`
--
ALTER TABLE `tb_provincias`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD CONSTRAINT `tb_almacen_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_acategorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_almacen_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD CONSTRAINT `tb_compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `tb_proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
