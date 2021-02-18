-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2021 a las 15:47:42
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jbb_reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(10) NOT NULL,
  `hora_inicial` datetime NOT NULL,
  `hora_final` datetime NOT NULL,
  `numero_cupos` tinyint(1) NOT NULL,
  `numero_cupos_restantes` tinyint(1) NOT NULL DEFAULT 0,
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Iniciada;2:En proceso;3:Cerrada',
  `disponible` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Si;2:No',
  `fecha_bloqueo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu`
--

CREATE TABLE `param_menu` (
  `id_menu` int(3) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_url` varchar(200) NOT NULL DEFAULT '0',
  `menu_icon` varchar(50) NOT NULL,
  `menu_order` int(1) NOT NULL,
  `menu_type` tinyint(1) NOT NULL COMMENT '1:Left; 2:Top',
  `menu_state` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active; 2:Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu`
--

INSERT INTO `param_menu` (`id_menu`, `menu_name`, `menu_url`, `menu_icon`, `menu_order`, `menu_type`, `menu_state`) VALUES
(1, 'Configuración', '', 'fa-gear', 2, 2, 1),
(2, '', '', 'fa-user', 6, 2, 1),
(3, 'Administrar acceso sistema', '', 'fa-cogs', 5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu_access`
--

CREATE TABLE `param_menu_access` (
  `id_access` int(3) NOT NULL,
  `fk_id_menu` int(3) NOT NULL,
  `fk_id_link` int(3) NOT NULL,
  `fk_id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu_access`
--

INSERT INTO `param_menu_access` (`id_access`, `fk_id_menu`, `fk_id_link`, `fk_id_role`) VALUES
(6, 1, 6, 99),
(7, 1, 7, 99),
(4, 2, 4, 99),
(5, 2, 5, 99),
(1, 3, 1, 99),
(2, 3, 2, 99),
(3, 3, 3, 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu_links`
--

CREATE TABLE `param_menu_links` (
  `id_link` int(3) NOT NULL,
  `fk_id_menu` int(3) NOT NULL,
  `link_name` varchar(100) NOT NULL,
  `link_url` varchar(200) NOT NULL,
  `link_icon` varchar(50) NOT NULL,
  `order` int(1) NOT NULL,
  `date_issue` datetime NOT NULL,
  `link_state` tinyint(1) NOT NULL COMMENT '1:Active;2:Inactive',
  `link_type` tinyint(1) NOT NULL COMMENT '1:System URL;2:Complete URL; 3:Divider; 4:Complete URL, Videos; 5:Complete URL, Manuals'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu_links`
--

INSERT INTO `param_menu_links` (`id_link`, `fk_id_menu`, `link_name`, `link_url`, `link_icon`, `order`, `date_issue`, `link_state`, `link_type`) VALUES
(1, 3, 'Enlaces Menú', 'access/menu', 'fa-link', 1, '2021-02-16 06:21:56', 1, 1),
(2, 3, 'Enlaces Submenú', 'access/links', 'fa-link', 2, '2021-02-16 06:21:56', 1, 1),
(3, 3, 'Acceso Roles', 'access/role_access', 'fa-puzzle-piece', 4, '2021-02-16 06:21:56', 1, 1),
(4, 2, 'Cambiar Contraseña', 'usuarios', 'fa-lock', 1, '2021-02-16 06:28:04', 1, 1),
(5, 2, 'Salir', 'menu/salir', 'fa-sign-out', 2, '2021-02-16 06:29:08', 1, 1),
(6, 1, 'Usuarios', 'settings/employee/1', 'fa-users', 1, '2021-02-16 08:39:49', 1, 1),
(7, 1, 'Horarios', 'settings/horarios', 'fa-briefcase', 2, '2021-02-16 08:52:26', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_role`
--

CREATE TABLE `param_role` (
  `id_role` int(1) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `style` varchar(50) NOT NULL,
  `dashboard_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_role`
--

INSERT INTO `param_role` (`id_role`, `role_name`, `description`, `style`, `dashboard_url`) VALUES
(1, 'Administrador', 'Se encarga de la configuracion del sistema. Cargar tabla de Usuarios.', 'text-success', 'dashboard/admin'),
(99, 'SUPER ADMIN', 'Con acceso a todo el sistema, encargaado de tablas parametricas del sistema.', 'text-danger', 'dashboard/admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(10) NOT NULL,
  `fk_id_horario` int(10) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `numero_contacto` varchar(12) NOT NULL,
  `numero_cupos_usados` tinyint(1) NOT NULL DEFAULT 0,
  `qr_code_img` varchar(250) NOT NULL,
  `qr_code_llave` varchar(30) NOT NULL,
  `estado_reserva` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Habilitado;2:Deshabilitado',
  `fecha_cancelacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_usuarios`
--

CREATE TABLE `reservas_usuarios` (
  `id_reserva_usuarios` int(10) NOT NULL,
  `fk_id_reserva` int(11) NOT NULL,
  `nombre_completo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `log_user` varchar(50) NOT NULL,
  `movil` varchar(12) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `state` int(1) NOT NULL DEFAULT 0 COMMENT '0: newUser; 1:active; 2:inactive',
  `fk_id_user_role` int(1) NOT NULL DEFAULT 7 COMMENT '99: Super Admin;',
  `photo` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `first_name`, `last_name`, `log_user`, `movil`, `email`, `password`, `state`, `fk_id_user_role`, `photo`) VALUES
(1, 'Benjamin', 'Motta', 'Bmottag', '4034089921', 'benmotta@gmail.com', '25446782e2ccaf0afdb03e5d61d0fbb9', 1, 99, 'images/usuarios/thumbs/1.JPG'),
(2, 'Administrador', 'Administrador', 'admin', '234523425', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_llave_contraseña`
--

CREATE TABLE `usuarios_llave_contraseña` (
  `id_llave` int(10) NOT NULL,
  `fk_id_user_ulc` int(10) NOT NULL,
  `email_user` varchar(70) NOT NULL,
  `llave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menu_type` (`menu_type`);

--
-- Indices de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  ADD PRIMARY KEY (`id_access`),
  ADD UNIQUE KEY `indice_principal` (`fk_id_menu`,`fk_id_link`,`fk_id_role`),
  ADD KEY `fk_id_menu` (`fk_id_menu`),
  ADD KEY `fk_id_role` (`fk_id_role`),
  ADD KEY `fk_id_link` (`fk_id_link`);

--
-- Indices de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  ADD PRIMARY KEY (`id_link`),
  ADD KEY `fk_id_menu` (`fk_id_menu`),
  ADD KEY `link_type` (`link_type`);

--
-- Indices de la tabla `param_role`
--
ALTER TABLE `param_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD UNIQUE KEY `qr_code_llave` (`qr_code_llave`),
  ADD KEY `fk_id_horario` (`fk_id_horario`);

--
-- Indices de la tabla `reservas_usuarios`
--
ALTER TABLE `reservas_usuarios`
  ADD PRIMARY KEY (`id_reserva_usuarios`),
  ADD KEY `fk_id_reserva` (`fk_id_reserva`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `log_user` (`log_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `perfil` (`fk_id_user_role`);

--
-- Indices de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  ADD PRIMARY KEY (`id_llave`),
  ADD KEY `fk_id_user_ulc` (`fk_id_user_ulc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `param_role`
--
ALTER TABLE `param_role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas_usuarios`
--
ALTER TABLE `reservas_usuarios`
  MODIFY `id_reserva_usuarios` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  MODIFY `id_llave` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  ADD CONSTRAINT `param_menu_access_ibfk_1` FOREIGN KEY (`fk_id_role`) REFERENCES `param_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `param_menu_access_ibfk_2` FOREIGN KEY (`fk_id_menu`) REFERENCES `param_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  ADD CONSTRAINT `param_menu_links_ibfk_1` FOREIGN KEY (`fk_id_menu`) REFERENCES `param_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`fk_id_horario`) REFERENCES `horarios` (`id_horario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas_usuarios`
--
ALTER TABLE `reservas_usuarios`
  ADD CONSTRAINT `reservas_usuarios_ibfk_1` FOREIGN KEY (`fk_id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
