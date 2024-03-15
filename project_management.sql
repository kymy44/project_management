-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2024 a las 17:40:54
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
-- Base de datos: `project_management`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_positions`
--

CREATE TABLE `job_positions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `job_positions`
--

INSERT INTO `job_positions` (`id`, `name`) VALUES
(3, 'administrator'),
(1, 'coordinator'),
(2, 'staff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `coordinator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `coordinator_id`) VALUES
(1, 'Pro1', 'asdfasdfasdfasdf', 2),
(2, 'pro22', 'asd', 3),
(3, 'asdas', 'asdasd', 2),
(5, 'pro2', 'asdas', 3),
(10, 'pro22', 'sdfgsdf', 3),
(11, 'tarea 7', 'asdfasd', 2),
(13, 'proyectoprueba', 'asdasd', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `start_date`, `deadline`, `project_id`) VALUES
(1, 'ghk', 'asdghjk', '2024-03-06', '2024-03-26', 1),
(2, 'tareasdasd', 'asdasdas', '2024-03-05', '2024-03-19', 1),
(3, 'fghdfgh', 'dfghdfg', '2024-03-29', '2024-03-29', 2),
(4, 'tarea4', '44444', '2024-03-12', '2024-03-19', 2),
(5, 'tarea5', '55555', '2024-03-12', '2024-03-12', 2),
(9, 'Tarea 4', 'Descripción de la tarea 4', '2024-03-20', '2024-03-30', 2),
(14, 'dfhfgh', 'dfghdfgfh', '2024-03-12', '2024-04-03', 5),
(17, 'asdf', 'asdf', '2024-03-20', '2024-03-26', 11),
(18, 'asd', 'sdfgsdf', '2024-03-13', '2024-03-27', 3),
(19, 'tarea2', 'dfg', '2024-03-22', '2024-03-21', 1),
(20, 'tareaprueba', 'sdafsdf', '2024-03-07', '2024-03-27', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `job_id` int(11) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `last_name`, `job_id`, `password_hash`) VALUES
(1, 'ADMINPRUEBA', 'nombreAdmin', 'ApeAdmin', 3, 'abc123.'),
(2, 'coordPrueba1', 'nombreCoord1', 'apeCoord1', 1, 'abc123.'),
(3, 'coordPrueba2', 'nombreCoord2', 'apeCoord2', 1, 'abc123.'),
(4, 'staffPrueba1', 'nombreStaff1', 'apeStaff1', 2, 'abc123.'),
(5, 'staffPrueba2', 'nombreStaff1', 'apeStaff2', 2, 'abc123.'),
(9, 'qwe', 'qwe', 'qwe', 2, '$2y$10$MFqMLW5fvc.WT0RgTHnNmu6sDoS00K6XYm537UyJ/78pUffYHwuje'),
(11, 'personal', 'Personal', 'Apellido', 2, '123.abc'),
(12, 'coordinador', 'Coordinador', 'Apellido', 1, '123.abc'),
(13, 'administrador', 'Administrador', 'Apellido', 3, '123.abc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_tasks`
--

CREATE TABLE `users_tasks` (
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_tasks`
--

INSERT INTO `users_tasks` (`user_id`, `task_id`) VALUES
(4, 5),
(4, 14),
(5, 1),
(5, 2),
(5, 4),
(5, 5),
(5, 14),
(9, 1),
(9, 3),
(9, 14),
(9, 18),
(11, 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `job_positions`
--
ALTER TABLE `job_positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coordinator_id` (`coordinator_id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `project_id` (`project_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `job_id` (`job_id`);

--
-- Indices de la tabla `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD PRIMARY KEY (`user_id`,`task_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`coordinator_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_positions` (`id`);

--
-- Filtros para la tabla `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD CONSTRAINT `users_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
