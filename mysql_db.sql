-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `cfgtemas` (
`id` int(10) unsigned NOT NULL,
  `tema_id` varchar(128) DEFAULT NULL,
  `cfg_name` varchar(128) DEFAULT NULL,
  `cfg_value` longtext
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `cfgtemas`
--

INSERT INTO `cfgtemas` (`id`, `tema_id`, `cfg_name`, `cfg_value`) VALUES
(1, '0', 'page_about', 'Sobre nosotros'),
(2, '0', 'about_title', 'Sobre nosotros...'),
(3, '0', 'about_subtitle', 'Texto por defecto'),
(4, '0', 'about_content', 'Texto por defecto'),
(5, '0', 'news_title', 'Noticias'),
(6, '0', 'news_content', 'Texto por defecto'),
(7, '0', 'news_maxposts', '3'),
(8, '0', 'contact_title', 'Contacto'),
(9, '0', 'contact_content', 'Texto por defecto'),
(10, '0', 'contact_email', 'asdasd@as.com'),
(11, '0', 'page_news', 'Noticias'),
(12, '0', 'page_contact', 'Contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(10) unsigned NOT NULL,
  `cfg_name` varchar(128) DEFAULT NULL,
  `cfg_value` longtext
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `cfg_name`, `cfg_value`) VALUES
(1, 'titulo', 'Oxigen'),
(2, 'descripcion', 'Soy una descripcion, cambiame :D'),
(3, 'nombre', 'Oxigen'),
(4, 'logo', '42'),
(5, 'tema', '0'),
(6, 'registro', '1'),
(7, 'url', 'http://localhost/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE IF NOT EXISTS `media` (
`id` int(10) unsigned NOT NULL,
  `url` varchar(512) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `url`) VALUES
(39, 'media/imagen/40e964ed1d3fd0f685a1d19e5f80c7894423cb1c.png'),
(42, 'media/imagen/350daa4023e2d4e5d11fcd20952bd7729253ec18.png'),
(43, 'media/imagen/350daa4023e2d4e5d11fcd20952bd7729253ec17.jpg');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
`id` int(10) unsigned NOT NULL,
  `titulo` varchar(128) DEFAULT NULL,
  `contenido` text
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `titulo`, `contenido`) VALUES
(1, 'P&aacute;gina de muestra', 'Esta es una p&aacute;gina de muestra. puede crear y modificar paginas en el dashboard en la seccion de p&aacute;ginas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `titulo` varchar(128) DEFAULT NULL,
  `contenido` text,
  `autor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tags` varchar(256) DEFAULT NULL,
  `img` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `contenido`, `autor`, `fecha`, `tags`, `img`) VALUES
(9, 'Bienvenido!', 'Este es un post de prueba. puede crear mas ingresando al dashboard en la seccion de &quot;Posts&quot;.', 1, '2016-03-08', '', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secadm`
--

CREATE TABLE IF NOT EXISTS `secadm` (
`id` int(10) unsigned NOT NULL,
  `titulo` varchar(128) DEFAULT NULL,
  `archivo` varchar(128) DEFAULT NULL,
  `padre` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `secadm`
--

INSERT INTO `secadm` (`id`, `titulo`, `archivo`, `padre`) VALUES
(1, 'Inicio', 'inicio.php', 1),
(2, 'Posts', NULL, 1),
(3, 'Listado', 'posts.php', 0),
(4, 'Agregar Post', 'addpost.php', 0),
(5, 'Usuarios', 'users.php', 1),
(6, 'Páginas', NULL, 1),
(7, 'Listado', 'pages.php', 0),
(8, 'Agregar Página', 'addpage.php', 0),
(9, 'Temas', NULL, 1),
(10, 'Cambiar Tema', 'temas.php', 0),
(11, 'Config. del Tema', 'temacfg.php', 0),
(12, 'Configuración', 'cfg.php', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE IF NOT EXISTS `temas` (
`id` int(10) unsigned NOT NULL,
  `titulo` varchar(128) DEFAULT NULL,
  `descripcion` varchar(128) DEFAULT NULL,
  `autor` varchar(128) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `carpeta` varchar(64) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `titulo`, `descripcion`, `autor`, `fecha`, `carpeta`) VALUES
(0, 'Readonly', 'Tema por defecto del Sistema', 'Oxigen', '2016-02-26', 'readonly');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(10) unsigned NOT NULL,
  `usuario` varchar(14) DEFAULT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `img` int(11) DEFAULT NULL,
  `nombre` varchar(64) DEFAULT NULL,
  `apellido` varchar(64) DEFAULT NULL,
  `privilegio` int(11) DEFAULT NULL,
  `activo` int(11) NOT NULL,
  `bloqueado` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `email`, `img`, `nombre`, `apellido`, `privilegio`, `activo`, `bloqueado`) VALUES
(1, 'admin', 'admin', 'admin@email.com', 39, 'Usuario', 'Administrador', 1, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cfgtemas`
--
ALTER TABLE `cfgtemas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secadm`
--
ALTER TABLE `secadm`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `carpeta` (`carpeta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cfgtemas`
--
ALTER TABLE `cfgtemas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `secadm`
--
ALTER TABLE `secadm`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
