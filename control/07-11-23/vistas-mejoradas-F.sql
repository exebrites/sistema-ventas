-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2023 a las 15:16:37
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bocetos`
--

CREATE TABLE `bocetos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negocio` varchar(255) NOT NULL,
  `objetivo` varchar(255) NOT NULL,
  `publico` varchar(255) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `url_logo` varchar(255) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni`, `nombre`, `apellido`, `telefono`, `correo`, `created_at`, `updated_at`) VALUES
(1, '123', 'exe', 'asd', 'asd', 'exequielbrites8@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `url_comprobantes` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`id`, `pedido_id`, `url_comprobantes`, `created_at`, `updated_at`) VALUES
(1, 2, '/storage/I1ORca3ue2ml9Oyd83BdBlNXWqnBsgSlEZxNhlNB.png', '2023-11-07 15:24:15', '2023-11-07 15:24:15'),
(2, 3, '/storage/X8DycEHMkCNvLFfRITJ6XdmqGPeIJ6UdsDXwLgKj.png', '2023-11-07 16:14:02', '2023-11-07 16:14:02'),
(3, 4, '/storage/s11bPzN400rvALJIEvSxCdBPA1ks0qojGBx1UZCZ.png', '2023-11-07 16:20:21', '2023-11-07 16:20:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 13, 25354.16, '2023-11-07 15:24:00', '2023-11-07 15:24:00'),
(2, 2, 1, 3, 10179.00, '2023-11-07 15:24:00', '2023-11-07 15:24:00'),
(3, 3, 2, 4, 7801.28, '2023-11-07 16:12:23', '2023-11-07 16:12:23'),
(4, 3, 1, 1, 3393.00, '2023-11-07 16:12:23', '2023-11-07 16:12:23'),
(5, 4, 2, 2, 3900.64, '2023-11-07 16:19:21', '2023-11-07 16:19:21'),
(6, 4, 1, 1, 3393.00, '2023-11-07 16:19:21', '2023-11-07 16:19:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disenios`
--

CREATE TABLE `disenios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detallePedido_id` bigint(20) UNSIGNED NOT NULL,
  `url_imagen` varchar(255) DEFAULT NULL,
  `url_disenio` varchar(255) DEFAULT NULL,
  `disenio_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `disenios`
--

INSERT INTO `disenios` (`id`, `detallePedido_id`, `url_imagen`, `url_disenio`, `disenio_estado`, `created_at`, `updated_at`) VALUES
(1, 1, '/storage/bwY2ixY16EDpDplHCt1bgcM0JD5BC8hhPYT5MOe9.jpg', '/storage/HL3kMnmYv48zjAogbl3IA8VEaJ0wrSIQ2LS1CqfJ.jpg', 1, '2023-11-07 15:24:00', '2023-11-07 15:56:58'),
(2, 2, '/storage/hr1iiVZNLXDA5tDQEfLKQha6uB0pF263N0RB7YHH.jpg', NULL, 1, '2023-11-07 15:24:00', '2023-11-07 15:24:00'),
(3, 3, '/storage/P6TeWMbUBMfkSyRefEWnsWBymEm04fjJb2HXo5iJ.jpg', NULL, 1, '2023-11-07 16:12:23', '2023-11-07 16:12:23'),
(4, 4, '/storage/pVJTs9GphLbYNSxCADudBbaw3qVnwOlbruHdED9p.jpg', NULL, 1, '2023-11-07 16:12:23', '2023-11-07 16:12:23'),
(5, 5, '/storage/fCG0VUrIfOZP26nDYlrUhKFgV66kuYXDO2FT1pDn.jpg', NULL, 1, '2023-11-07 16:19:21', '2023-11-07 16:19:21'),
(6, 6, '/storage/xImrz9J69FeL2X9iKQkFxLMxe7g5zDfUEAJ9C66V.jpg', '/storage/f3dOMJ5007sjgegKcX6PiHXInUEUC0TxjfR13sFt.jpg', 1, '2023-11-07 16:19:21', '2023-11-07 16:25:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` char(255) NOT NULL,
  `recepcion` varchar(255) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `local` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `pedido_id`, `direccion`, `telefono`, `recepcion`, `nota`, `local`, `created_at`, `updated_at`) VALUES
(1, 2, 'sdf', 'sdf', 'sdf', 'sdf', 1, '2023-11-07 15:59:24', '2023-11-07 15:59:24'),
(2, 3, 'barrio andresito Apostoles', '58-544413', 'exequiel', 'sin comentarios', 1, '2023-11-07 16:16:38', '2023-11-07 16:16:38'),
(3, 4, 'barrio andresito Apostoles', '58-544413', 'exequiel', 'sin comentarios', 1, '2023-11-07 16:22:28', '2023-11-07 16:22:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2023_09_12_222502_create_clientes_table', 1),
(14, '2023_09_12_222519_create_pedidos_table', 1),
(15, '2023_09_12_222605_create_productos_table', 1),
(16, '2023_10_31_141714_create_detalle_pedidos_table', 2),
(17, '2023_10_24_034728_create_bocetos_table', 3),
(18, '2023_10_24_135856_create_comprobantes_table', 4),
(19, '2023_10_30_203649_create_entregas_table', 5),
(20, '2023_09_12_222617_create_disenios_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clientes_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `clientes_id`, `fecha_inicio`, `fecha_entrega`, `estado`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL, 'inicio', '2023-11-07 15:24:00', '2023-11-07 15:59:24'),
(3, 1, NULL, NULL, 'inicio', '2023-11-07 16:12:23', '2023-11-07 16:16:38'),
(4, 1, NULL, NULL, 'inicio', '2023-11-07 16:19:21', '2023-11-07 16:22:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `name`, `slug`, `price`, `description`, `category_id`, `image_path`, `alias`, `created_at`, `updated_at`) VALUES
(1, 'Almanaque Anillado', 'almanaque-anillado', 3393, 'Almanaque Anillado 14 x 15 cm', 1, '/storage/dHILNFqAWu2t1RqIkeBzDasA53X5MyGmcIdCq9IV.jpg', 'AA14x15', '2023-11-07 15:21:53', '2023-11-07 15:21:53'),
(2, 'Carpetas de Presentación', 'carpeta-presentacion', 1950.32, ' 30 x 40 cm', 1, '/storage/gRiyp82dYfxgMtYymZxmASznBk8GWWD1b6NiEOr5.jpg', 'CP30x40', '2023-11-07 15:21:53', '2023-11-07 15:21:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'exequiel brites', 'exequielbrites8@gmail.com', NULL, '$2y$10$l2Mct/SzHEvvGR06GoO.ku6Fx2v.O3XfLqHJraK/4SJi0vxrYkkLy', NULL, '2023-11-07 15:22:24', '2023-11-07 15:22:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bocetos`
--
ALTER TABLE `bocetos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comprobantes_pedido_id_foreign` (`pedido_id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `detalle_pedidos_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `disenios`
--
ALTER TABLE `disenios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disenios_detallepedido_id_foreign` (`detallePedido_id`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entregas_pedido_id_unique` (`pedido_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_clientes_id_foreign` (`clientes_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bocetos`
--
ALTER TABLE `bocetos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `disenios`
--
ALTER TABLE `disenios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD CONSTRAINT `comprobantes_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalle_pedidos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `disenios`
--
ALTER TABLE `disenios`
  ADD CONSTRAINT `disenios_detallepedido_id_foreign` FOREIGN KEY (`detallePedido_id`) REFERENCES `detalle_pedidos` (`id`);

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
