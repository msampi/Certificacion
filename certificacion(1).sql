-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-10-2016 a las 21:20:14
-- Versión del servidor: 5.6.28
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `certificacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo`, `description`, `created_at`, `updated_at`) VALUES
(4, 'People Experts', '', '<p>Descripcion<br></p>', '2016-09-29 02:29:24', '2016-09-29 02:29:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competency`
--

CREATE TABLE `competency` (
  `id` int(10) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `post_id` int(10) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competency_items`
--

CREATE TABLE `competency_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `competency_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `objectives_rating_id` int(11) NOT NULL,
  `competitions_rating_id` int(11) NOT NULL,
  `valorations_rating_id` int(11) NOT NULL,
  `start_year_start` datetime NOT NULL,
  `start_year_end` datetime NOT NULL,
  `half_year_start` datetime NOT NULL,
  `half_year_end` datetime NOT NULL,
  `end_year_start` datetime NOT NULL,
  `end_year_end` datetime NOT NULL,
  `vis_half_year_start` datetime DEFAULT NULL,
  `vis_half_year_end` datetime DEFAULT NULL,
  `vis_end_year_start` datetime DEFAULT NULL,
  `vis_end_year_end` datetime DEFAULT NULL,
  `visualization` tinyint(4) NOT NULL,
  `welcome_message_id` int(11) NOT NULL,
  `register_message_id` int(11) NOT NULL,
  `recovery_message_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation_users`
--

CREATE TABLE `evaluation_users` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `started` tinyint(4) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category` varchar(256) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `subject` text CHARACTER SET latin1 NOT NULL,
  `from` varchar(256) CHARACTER SET latin1 NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `subject`, `from`, `message`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '{"1":"Registro de Usuario (default)","2":"User registration (default)"}', '{"1":"client_name","2":"client_name"}', '{"1":"<p>Estimado user_name,&nbsp; user_last_name.<\\/p><p>client_name le da la bienvenida al registro de nuestra plataforma.<\\/p><p>Su clave de acceso a la misma es: user_password con nombre de usuario: user_email.<\\/p><p>Puede ingresar mediante el siguiente enlace: web_link<\\/p><p>Gracias<\\/p><p>El equipo de client_name<br><\\/p>","2":""}', 0, '2016-09-30 19:17:44', '2016-09-30 19:49:12'),
(2, '{"1":"Bienvenida a evaluaci\\u00f3n (default)","2":"Evaluation welcome (default)"}', '{"1":"client_name","2":"client_name"}', '{"1":"<p><\\/p><p>Estimado user_name,  user_last_name.<\\/p><p>client_name le da la bienvenida a la evaluacion evaluation_name.<\\/p><p>Puede ingresar mediante el siguiente enlace: web_link<\\/p><p>Gracias<\\/p><p>El equipo de client_name<\\/p><br><p><\\/p>","2":""}', 0, '2016-09-30 19:45:16', '2016-09-30 19:47:31'),
(3, '{"1":"Recuperacion de clave (default)","2":"Password recovery (default)"}', '{"1":"client_name","2":"client_name"}', '{"1":"<p><\\/p><p>Estimado user_name,  user_last_name.<\\/p><p>Su contrase\\u00f1a se ha restablecido correctamente. Su nueva contrase\\u00f1a es: user_password<br><\\/p><p>Puede ingresar mediante el siguiente enlace: web_link<\\/p><p>Gracias<\\/p><p>El equipo de client_name<\\/p><br><p><\\/p>","2":""}', 0, '2016-09-30 19:48:46', '2016-09-30 19:48:46'),
(4, '{"1":"Bienvenida People Experts","2":""}', '{"1":"People Experts","2":""}', '{"1":"<p>lalalalal<br><\\/p>","2":""}', 4, '2016-10-03 14:35:07', '2016-10-04 16:14:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'rating porcentual', '2016-09-29 03:34:32', '2016-09-29 03:34:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rating_values`
--

CREATE TABLE `rating_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `rating_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', NULL, NULL),
(2, 'Cliente', NULL, NULL),
(3, 'Participante', NULL, NULL),
(4, 'Consultor', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trackings`
--

CREATE TABLE `trackings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracking_actions`
--

CREATE TABLE `tracking_actions` (
  `id` int(11) NOT NULL,
  `tracking_id` int(11) NOT NULL,
  `browser` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `action` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_message_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `dni`, `remember_token`, `client_id`, `code`, `role_id`, `image`, `country`, `city`, `area`, `department`, `register_message_id`, `created_at`, `updated_at`) VALUES
(2, 'Consultor', 'Consultor', 'consultor@consultor.com', '$2y$10$BN3V4y23SA5wq1mr.cm/LOtS4MYKvaNYvCew0FN9ZcogeaC1WhenG', '25141390', '29Usg1KZg0ZykFREd7KKflnoaXth00idfIIQJYQWBKLih6JkSISyuYT0U4EM', 4, '245159', 4, '', 'Argentina', 'Capital Federal', '223', 'dep', 0, '2016-05-22 04:23:31', '2016-10-24 17:22:08'),
(31, 'Superadmin', 'Superadmin', 'superadmin@superadmin.com', '$2a$04$KESIUGZkNuMzn37XuoYdPu4w.rrCHTO.f8zFf65k59SwqZK6owcbi', '29141390', 'xSHKVBn6hm5oUtNuJhhiz7G5Ve32EaDPEwPnIx2HYsiqiX9tLs2LRUOkxvGy', 0, '245158', 1, '', 'AR', 'Tandil', '223', 'dep', 0, '2016-05-22 04:23:31', '2016-10-24 17:33:21'),
(36, 'Cliente', 'Cliente', 'cliente@cliente.com', '$2a$04$KESIUGZkNuMzn37XuoYdPu4w.rrCHTO.f8zFf65k59SwqZK6owcbi', '29141190', 'temCNDlnDjCp3nU7pjir8zZEW3GKg02ZYOvDl4aGgLm9PLEHSo8kLUzxjP2f', 4, '255859', 2, '', 'AR', 'Tandil', '223', 'dep', 0, '2016-05-22 04:23:31', '2016-10-24 15:38:21'),
(38, 'Participante', 'Participante', 'participante@participante.com', '$2y$10$BN3V4y23SA5wq1mr.cm/LOtS4MYKvaNYvCew0FN9ZcogeaC1WhenG', '25141330', 'HTHTxJnTASiqFUoJcD7B2bsV2kWsM542gU0pTZRTjTM5OVanwhiIdrpjDczP', 4, '243159', 3, '', 'Argentina', 'Capital Federal', '223', 'dep', 0, '2016-05-22 04:23:31', '2016-10-24 17:22:00'),
(39, 'test', 'test', 'evaluador1@centromultimedia.com.ar', '$2y$10$NvATdGzNF9BjKePb.f6Ra.1l1HqChnDTyq6UPNUV.r9UQaKkCspyK', '2314214', NULL, 4, '876876', 4, NULL, '', '', '', '', 0, '2016-10-24 17:21:03', '2016-10-24 17:21:03'),
(40, 'Juan', 'Lopez', 'juan@lopez.com', '$2y$10$dB.ZVgibc8rLUQ40oQ7RneAoukTYR9fWwtE0MZM05QfPd/RUau3j.', '65765723', NULL, 4, '3453454', 2, NULL, 'Argentina', 'Buenos Aires', '', '', 0, '2016-10-24 17:32:13', '2016-10-24 17:32:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `competency`
--
ALTER TABLE `competency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competitions_post_foreign_key` (`post_id`);

--
-- Indices de la tabla `competency_items`
--
ALTER TABLE `competency_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `behaviours_competition_id_foreign` (`competency_id`);

--
-- Indices de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluation_users`
--
ALTER TABLE `evaluation_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rating_values`
--
ALTER TABLE `rating_values`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trackings`
--
ALTER TABLE `trackings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tracking_actions`
--
ALTER TABLE `tracking_actions`
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
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `competency`
--
ALTER TABLE `competency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `competency_items`
--
ALTER TABLE `competency_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluation_users`
--
ALTER TABLE `evaluation_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rating_values`
--
ALTER TABLE `rating_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `trackings`
--
ALTER TABLE `trackings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tracking_actions`
--
ALTER TABLE `tracking_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
