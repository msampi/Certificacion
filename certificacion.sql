-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-03-2017 a las 00:59:19
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
-- Estructura de tabla para la tabla `autoperceptions`
--

CREATE TABLE `autoperceptions` (
  `id` int(11) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `rating_id` int(11) NOT NULL,
  `client_id` int(11) UNSIGNED DEFAULT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `reference` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoperception_items`
--

CREATE TABLE `autoperception_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `autoperception_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoperception_reviews`
--

CREATE TABLE `autoperception_reviews` (
  `id` int(11) NOT NULL,
  `autoperception_item_id` int(10) UNSIGNED NOT NULL,
  `competitor_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo`, `description`, `color`, `created_at`, `updated_at`) VALUES
(4, 'People Experts', 't3ic58rmx8ptagkmxvznbytl7emr7haufkhwsrmje832e922b5.jpeg', '<p>Descripcion<br></p>', '#eb8d2e', '2016-09-29 02:29:24', '2016-12-14 02:27:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencies`
--

CREATE TABLE `competencies` (
  `id` int(11) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `reference` text COLLATE utf8_unicode_ci,
  `client_id` int(11) UNSIGNED DEFAULT NULL,
  `competency_group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competency_groups`
--

CREATE TABLE `competency_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `competency_groups`
--

INSERT INTO `competency_groups` (`id`, `name`, `client_id`, `created_at`, `updated_at`) VALUES
(3, 'Nuevo grupo', 0, '2016-12-01 18:22:46', '2016-12-01 18:22:46'),
(4, 'Nuevo grupo 2', 0, '2016-12-01 18:25:16', '2016-12-01 18:25:16'),
(5, 'Mentalidad Empresarial', 0, '2016-12-01 18:40:53', '2016-12-01 18:40:53'),
(6, 'Mentalidad de equipo', 0, '2016-12-06 12:17:06', '2016-12-06 12:17:06'),
(7, 'Mentalidad Social', 0, '2016-12-14 18:34:16', '2016-12-14 18:34:16'),
(8, 'Mentalidad ejecutiva', 4, '2016-12-14 18:35:23', '2016-12-14 18:35:23'),
(9, 'Grupo PE', 4, '2016-12-20 12:38:00', '2016-12-20 12:38:00'),
(10, 'Mentalidad ejecutiva', 5, '2016-12-20 14:25:53', '2016-12-20 14:25:53'),
(11, 'Mentalidad Empresarial', 5, '2016-12-20 14:26:44', '2016-12-20 14:26:44'),
(12, 'Mentalidad empresarial', 4, '2017-02-08 14:19:18', '2017-02-08 14:19:18'),
(13, 'Orientación y Satisfacción del Cliente', 4, '2017-02-08 14:19:18', '2017-02-08 14:19:18'),
(14, 'Orientación a Objetivos', 4, '2017-02-08 14:19:18', '2017-02-08 14:19:18'),
(15, 'Hablidades Sociales', 4, '2017-02-08 14:19:18', '2017-02-08 14:19:18'),
(16, 'Valores Personales', 4, '2017-02-08 14:19:18', '2017-02-08 14:19:18'),
(17, 'Mentalidad de equipo', 1, '2017-02-08 14:22:11', '2017-02-08 14:22:11'),
(18, 'Mentalidad de equipo', 4, '2017-03-10 13:19:46', '2017-03-10 13:19:46'),
(19, 'Mentalidad empresarial', NULL, '2017-03-10 17:09:25', '2017-03-10 17:09:25'),
(20, 'Mentalidad de equipo', NULL, '2017-03-10 17:09:25', '2017-03-10 17:09:25'),
(21, 'Mentalidad empresarial', 1, '2017-03-10 17:20:14', '2017-03-10 17:20:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competency_items`
--

CREATE TABLE `competency_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `positive` text COLLATE utf8_unicode_ci,
  `negative` text COLLATE utf8_unicode_ci,
  `competency_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competency_reviews`
--

CREATE TABLE `competency_reviews` (
  `id` int(11) NOT NULL,
  `consultant_review_id` int(11) NOT NULL,
  `competency_id` int(11) UNSIGNED NOT NULL,
  `competency_item_id` int(10) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultant_reviews`
--

CREATE TABLE `consultant_reviews` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `consultant_id` int(11) UNSIGNED NOT NULL,
  `competitor_id` int(11) UNSIGNED NOT NULL,
  `consultant_type` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `evaluation_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `rating_id` int(11) NOT NULL,
  `welcome_message_id` int(11) NOT NULL,
  `register_message_id` int(11) NOT NULL,
  `recovery_message_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation_exercises`
--

CREATE TABLE `evaluation_exercises` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) UNSIGNED NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `status_competitor` tinyint(4) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation_users`
--

CREATE TABLE `evaluation_users` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) UNSIGNED NOT NULL,
  `competitor_id` int(11) UNSIGNED DEFAULT NULL,
  `primary_consultant_id` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `secondary_consultant_id` int(11) UNSIGNED DEFAULT NULL,
  `started` tinyint(4) NOT NULL,
  `ecase_register` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `exercise_type_id` int(11) NOT NULL,
  `instructions` varchar(255) NOT NULL,
  `competitor_pdf` varchar(255) NOT NULL,
  `consultant_pdf` varchar(255) NOT NULL,
  `client_id` int(11) UNSIGNED DEFAULT NULL,
  `rating_id` int(11) NOT NULL,
  `external_link` text NOT NULL,
  `simulation_id` int(11) NOT NULL,
  `simulation_name` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercise_autoperceptions`
--

CREATE TABLE `exercise_autoperceptions` (
  `id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `autoperception_id` int(11) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercise_competencies`
--

CREATE TABLE `exercise_competencies` (
  `id` int(11) NOT NULL,
  `competency_group_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercise_questionaries`
--

CREATE TABLE `exercise_questionaries` (
  `id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `questionary_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercise_types`
--

CREATE TABLE `exercise_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exercise_types`
--

INSERT INTO `exercise_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Role Play', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Custionario de Autopercepción', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Cuestionario de conocimientos', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Entrevista por competencias', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'E-Cases', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Link Externo', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `from` varchar(256) CHARACTER SET latin1 NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `subject`, `from`, `message`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 'Registro de usuario (default)', 'People Experts', 'Estimado user_name user_last_name. <br><br>Su registo en la plataforma de Assessment ha sido realizada con exito. <br><br>En breve recibira otro correo para poder establecer su clave y tener acceso a la plataforma.<br><br><br>', 0, '2016-11-04 17:21:12', '2016-12-09 13:52:13'),
(2, 'Bienvenida a la evaluacion (default)', 'People Experts', '<p>Estima user_name user_last_name</p><p>Le damos la bienvenida a la evaluacion evaluation_name<br></p>', 0, '2016-12-09 13:53:30', '2017-03-15 21:46:27');

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

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jramirez@gmail.com', 'a97adc567d7431d6e55ee0fc8ac0649b864ef9ca04fe954c99d3ae18c4ef6394', '2016-12-09 23:30:53'),
('jfarias@gmail.com', 'dc722254b73a37d6f8174fb9a317dfcb8c4ed59c146ca78cb8a6001c6155d6ce', '2016-12-09 23:31:04'),
('consultor@consultor.com', '328b0a917ee1e3677a1ceeea78868e7585194bbef4c23441f846c2d008ced39a', '2017-03-14 02:00:56'),
('consultor2@consultor.com', 'bf10d26c4620db9231ce40c707df081bb4069ccec5e54bf39bdc3ac72f66e06a', '2017-03-14 02:01:08'),
('participante@participante.com', '04f27ce92f74ad3289d3725c59ffdbda8f83f7cf9973b0bf736ef56d0a20d433', '2017-03-14 02:01:20'),
('matiassampietro@hotmail.com', '6c31b02c783685b14567b4ff348c00598c387fbcc41ac4fc15e53921edb0a90c', '2017-03-14 02:38:11'),
('cliente@cliente.com', 'c02baea67b992b7dcea2be432412f390d7ed299846c71a7b37fc5712198ea9c4', '2017-03-16 00:59:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questionaries`
--

CREATE TABLE `questionaries` (
  `id` int(11) NOT NULL,
  `import_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `client_id` int(11) UNSIGNED DEFAULT NULL,
  `instructions` text,
  `reference` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `questionaries`
--

INSERT INTO `questionaries` (`id`, `import_id`, `name`, `client_id`, `instructions`, `reference`, `created_at`, `updated_at`) VALUES
(48, 1, 'cuestionario 1', NULL, 'instrucciones', 'referencia', '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(49, 2, 'cuestionario 2', NULL, 'instrucciones', 'referencia', '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(50, 3, 'cuestionario 3', NULL, 'instrucciones', 'referencia', '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(51, 5, 'test comillas', NULL, 'intrucciones \'comillas simples\' y "comillas dobles" etc etc.', NULL, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(52, 1, 'cuestionario 1', 4, 'instrucciones', 'referencia', '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(53, 2, 'cuestionario 2', 4, 'instrucciones', 'referencia', '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(54, 3, 'cuestionario 3', 4, 'instrucciones', 'referencia', '2017-03-10 17:41:45', '2017-03-10 17:41:45'),
(55, 5, 'test comillas', 4, 'intrucciones \'comillas simples\' y "comillas dobles" etc etc.', NULL, '2017-03-10 17:41:45', '2017-03-10 17:41:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questionary_types`
--

CREATE TABLE `questionary_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `questionary_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `question`, `questionary_id`, `created_at`, `updated_at`) VALUES
(181, 'pregunta1', 48, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(182, 'pregunta 1', 48, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(183, 'pregunta 2', 48, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(184, 'pregunta1', 49, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(185, 'pregunta 1', 49, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(186, 'pregunta 2', 49, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(187, 'pregunta2', 49, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(188, 'pregunta1', 50, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(189, 'intrucciones \'comillas simples\' y "comillas dobles" etc etc.', 51, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(190, 'pregunta1', 52, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(191, 'pregunta 1', 52, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(192, 'pregunta 2', 52, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(193, 'pregunta1', 53, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(194, 'pregunta 1', 53, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(195, 'pregunta 2', 53, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(196, 'pregunta2', 53, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(197, 'pregunta1', 54, '2017-03-10 17:41:45', '2017-03-10 17:41:45'),
(198, 'intrucciones \'comillas simples\' y "comillas dobles" etc etc.', 55, '2017-03-10 17:41:45', '2017-03-10 17:41:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL,
  `option` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `correct` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `question_options`
--

INSERT INTO `question_options` (`id`, `option`, `question_id`, `correct`, `created_at`, `updated_at`) VALUES
(556, 'opcion1', 181, 1, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(557, 'opcion2', 182, 0, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(558, 'opcion1', 184, 1, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(559, 'opcion2', 185, 0, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(560, 'opcion1', 186, 1, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(561, 'opcion2', 187, 0, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(562, 'opcion3', 186, 0, '2017-03-10 17:15:57', '2017-03-10 17:15:57'),
(563, 'opcion1', 190, 1, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(564, 'opcion2', 191, 0, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(565, 'opcion1', 193, 1, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(566, 'opcion2', 194, 0, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(567, 'opcion1', 195, 1, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(568, 'opcion2', 196, 0, '2017-03-10 17:41:44', '2017-03-10 17:41:44'),
(569, 'opcion3', 195, 0, '2017-03-10 17:41:45', '2017-03-10 17:41:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_reviews`
--

CREATE TABLE `question_reviews` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `competitor_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `question_option_id` int(11) DEFAULT NULL,
  `value` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rating_values`
--

CREATE TABLE `rating_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `rating_id` int(11) UNSIGNED NOT NULL,
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
  `user_id` int(11) UNSIGNED NOT NULL,
  `evaluation_id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
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
  `client_id` int(11) UNSIGNED DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(31, 'Superadmin', 'Superadmin', 'superadmin@superadmin.com', '$2a$04$KESIUGZkNuMzn37XuoYdPu4w.rrCHTO.f8zFf65k59SwqZK6owcbi', '29141390', 'cUCsXBRXDaFcUtlaRzLRIMOlptuD3GQsxciy14B4587mFyDiY71uPdv0ggP6', NULL, '245158', 1, '', 'AR', 'Tandil', '223', 'dep', 0, '2016-05-22 04:23:31', '2017-03-16 02:43:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autoperceptions`
--
ALTER TABLE `autoperceptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indices de la tabla `autoperception_items`
--
ALTER TABLE `autoperception_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autoperception_id` (`autoperception_id`);

--
-- Indices de la tabla `autoperception_reviews`
--
ALTER TABLE `autoperception_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `autoperception_item_id` (`autoperception_item_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `competencies`
--
ALTER TABLE `competencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indices de la tabla `competency_groups`
--
ALTER TABLE `competency_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `competency_items`
--
ALTER TABLE `competency_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competency_id` (`competency_id`);

--
-- Indices de la tabla `competency_reviews`
--
ALTER TABLE `competency_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competency_id` (`competency_id`),
  ADD KEY `competency_item_id` (`competency_item_id`);

--
-- Indices de la tabla `consultant_reviews`
--
ALTER TABLE `consultant_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`exercise_id`) USING BTREE,
  ADD KEY `consultant_id` (`consultant_id`),
  ADD KEY `competitor_id` (`competitor_id`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`evaluation_id`) USING BTREE;

--
-- Indices de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indices de la tabla `evaluation_exercises`
--
ALTER TABLE `evaluation_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_id` (`evaluation_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indices de la tabla `evaluation_users`
--
ALTER TABLE `evaluation_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_id` (`evaluation_id`),
  ADD KEY `competitor_id` (`competitor_id`),
  ADD KEY `primary_consultant_id` (`primary_consultant_id`),
  ADD KEY `secondary_consultant_id` (`secondary_consultant_id`);

--
-- Indices de la tabla `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indices de la tabla `exercise_autoperceptions`
--
ALTER TABLE `exercise_autoperceptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autoperception_id` (`autoperception_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indices de la tabla `exercise_competencies`
--
ALTER TABLE `exercise_competencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indices de la tabla `exercise_questionaries`
--
ALTER TABLE `exercise_questionaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exercise_id` (`exercise_id`),
  ADD KEY `questionary_id` (`questionary_id`);

--
-- Indices de la tabla `exercise_types`
--
ALTER TABLE `exercise_types`
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
-- Indices de la tabla `questionaries`
--
ALTER TABLE `questionaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`client_id`) USING BTREE;

--
-- Indices de la tabla `questionary_types`
--
ALTER TABLE `questionary_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionary_id` (`questionary_id`);

--
-- Indices de la tabla `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indices de la tabla `question_reviews`
--
ALTER TABLE `question_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rating_values`
--
ALTER TABLE `rating_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_id` (`rating_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trackings`
--
ALTER TABLE `trackings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `evaluation_id` (`evaluation_id`);

--
-- Indices de la tabla `tracking_actions`
--
ALTER TABLE `tracking_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracking_id` (`tracking_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autoperceptions`
--
ALTER TABLE `autoperceptions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `autoperception_items`
--
ALTER TABLE `autoperception_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT de la tabla `autoperception_reviews`
--
ALTER TABLE `autoperception_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `competencies`
--
ALTER TABLE `competencies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT de la tabla `competency_groups`
--
ALTER TABLE `competency_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `competency_items`
--
ALTER TABLE `competency_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT de la tabla `competency_reviews`
--
ALTER TABLE `competency_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `consultant_reviews`
--
ALTER TABLE `consultant_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `evaluation_exercises`
--
ALTER TABLE `evaluation_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `evaluation_users`
--
ALTER TABLE `evaluation_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `exercise_autoperceptions`
--
ALTER TABLE `exercise_autoperceptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exercise_competencies`
--
ALTER TABLE `exercise_competencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `exercise_questionaries`
--
ALTER TABLE `exercise_questionaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `questionaries`
--
ALTER TABLE `questionaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT de la tabla `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;
--
-- AUTO_INCREMENT de la tabla `question_reviews`
--
ALTER TABLE `question_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `rating_values`
--
ALTER TABLE `rating_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `trackings`
--
ALTER TABLE `trackings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tracking_actions`
--
ALTER TABLE `tracking_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autoperceptions`
--
ALTER TABLE `autoperceptions`
  ADD CONSTRAINT `autoperceptions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `autoperception_items`
--
ALTER TABLE `autoperception_items`
  ADD CONSTRAINT `autoperception_items_ibfk_1` FOREIGN KEY (`autoperception_id`) REFERENCES `autoperceptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `autoperception_reviews`
--
ALTER TABLE `autoperception_reviews`
  ADD CONSTRAINT `autoperception_reviews_ibfk_1` FOREIGN KEY (`autoperception_item_id`) REFERENCES `autoperception_items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `competencies`
--
ALTER TABLE `competencies`
  ADD CONSTRAINT `competencies_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `competency_items`
--
ALTER TABLE `competency_items`
  ADD CONSTRAINT `competency_items_ibfk_1` FOREIGN KEY (`competency_id`) REFERENCES `competencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `competency_reviews`
--
ALTER TABLE `competency_reviews`
  ADD CONSTRAINT `competency_reviews_ibfk_1` FOREIGN KEY (`competency_id`) REFERENCES `competencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competency_reviews_ibfk_2` FOREIGN KEY (`competency_item_id`) REFERENCES `competency_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consultant_reviews`
--
ALTER TABLE `consultant_reviews`
  ADD CONSTRAINT `consultant_reviews_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultant_reviews_ibfk_2` FOREIGN KEY (`consultant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultant_reviews_ibfk_3` FOREIGN KEY (`competitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluation_exercises`
--
ALTER TABLE `evaluation_exercises`
  ADD CONSTRAINT `evaluation_exercises_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_exercises_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluation_users`
--
ALTER TABLE `evaluation_users`
  ADD CONSTRAINT `evaluation_users_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_users_ibfk_2` FOREIGN KEY (`competitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_users_ibfk_3` FOREIGN KEY (`primary_consultant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `evaluation_users_ibfk_4` FOREIGN KEY (`secondary_consultant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `exercise_autoperceptions`
--
ALTER TABLE `exercise_autoperceptions`
  ADD CONSTRAINT `exercise_autoperceptions_ibfk_1` FOREIGN KEY (`autoperception_id`) REFERENCES `autoperceptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exercise_autoperceptions_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `exercise_competencies`
--
ALTER TABLE `exercise_competencies`
  ADD CONSTRAINT `exercise_competencies_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `exercise_questionaries`
--
ALTER TABLE `exercise_questionaries`
  ADD CONSTRAINT `exercise_questionaries_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exercise_questionaries_ibfk_2` FOREIGN KEY (`questionary_id`) REFERENCES `questionaries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `questionaries`
--
ALTER TABLE `questionaries`
  ADD CONSTRAINT `questionaries_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`questionary_id`) REFERENCES `questionaries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `question_reviews`
--
ALTER TABLE `question_reviews`
  ADD CONSTRAINT `question_reviews_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rating_values`
--
ALTER TABLE `rating_values`
  ADD CONSTRAINT `rating_values_ibfk_1` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trackings`
--
ALTER TABLE `trackings`
  ADD CONSTRAINT `trackings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trackings_ibfk_2` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tracking_actions`
--
ALTER TABLE `tracking_actions`
  ADD CONSTRAINT `tracking_actions_ibfk_1` FOREIGN KEY (`tracking_id`) REFERENCES `trackings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
