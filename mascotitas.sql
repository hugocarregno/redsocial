-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2019 a las 16:44:30
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascotitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjunto`
--

CREATE TABLE `adjunto` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(64) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `fechaultmod` date NOT NULL,
  `fechaalta` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `imagenperfil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_usuario`, `usuario`, `password`, `fechaultmod`, `fechaalta`, `estado`, `nombre`, `apellido`, `sexo`, `mail`, `telefono`, `imagenperfil`) VALUES
(1, 'admin', 'admin', '2019-06-10', '2019-06-10', 1, 'jhon', 'mascotas', 1, 'jhon@gmail.com', '2657113322', 'administrador/admin2019-06-10.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denunciacomentario`
--

CREATE TABLE `denunciacomentario` (
  `id_usuario` int(11) NOT NULL,
  `id_moderador` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `fechadenuncia` date NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `fechamoderacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denunciapost`
--

CREATE TABLE `denunciapost` (
  `id_usuario` int(11) NOT NULL,
  `id_moderador` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `fechadenuncia` datetime NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `fechamoderacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `descripcion` varchar(64) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderador`
--

CREATE TABLE `moderador` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usuarioultmod` varchar(50) NOT NULL,
  `fechaultmod` date NOT NULL,
  `usuarioalta` int(11) NOT NULL,
  `fechaalta` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `imagenperfil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moderador`
--

INSERT INTO `moderador` (`id_usuario`, `usuario`, `password`, `usuarioultmod`, `fechaultmod`, `usuarioalta`, `fechaalta`, `estado`, `nombre`, `apellido`, `sexo`, `mail`, `telefono`, `imagenperfil`) VALUES
(1, 'mod1', 'mod1', '1', '2019-06-10', 1, '2019-06-10', 1, 'rosa', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabraclave`
--

CREATE TABLE `palabraclave` (
  `id` int(11) NOT NULL,
  `palabra` varchar(10) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sitio`
--

CREATE TABLE `usuario_sitio` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usuarioultmod` varchar(50) NOT NULL,
  `fechaultmod` date NOT NULL,
  `fechaalta` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `imagenperfil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_sitio`
--

INSERT INTO `usuario_sitio` (`id`, `usuario`, `password`, `usuarioultmod`, `fechaultmod`, `fechaalta`, `estado`, `nombre`, `apellido`, `sexo`, `mail`, `telefono`, `imagenperfil`) VALUES
(1, 'ro', 'qq', 'ro', '2019-06-10', '2019-06-10', 1, 'roberto', 'cp', 1, 'ro@gmail.com', '11223344', 'usuario_sitio/1.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adjunto`
--
ALTER TABLE `adjunto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post-adjunto` (`id_post`);

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `post-comentario` (`id_post`),
  ADD KEY `usuario_sitio-comentario` (`id_usuario`);

--
-- Indices de la tabla `denunciacomentario`
--
ALTER TABLE `denunciacomentario`
  ADD KEY `usuario` (`id_usuario`),
  ADD KEY `moderador` (`id_moderador`),
  ADD KEY `comentario` (`id_comentario`);

--
-- Indices de la tabla `denunciapost`
--
ALTER TABLE `denunciapost`
  ADD KEY `usuariositio` (`id_usuario`),
  ADD KEY `moderador-denunciapost` (`id_moderador`),
  ADD KEY `post-denunciapost` (`id_post`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `imagen-post` (`id_post`);

--
-- Indices de la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `moderador-administrador` (`usuarioalta`);

--
-- Indices de la tabla `palabraclave`
--
ALTER TABLE `palabraclave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post-palabraclave` (`id_post`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `usuariositio-post` (`id_usuario`);

--
-- Indices de la tabla `usuario_sitio`
--
ALTER TABLE `usuario_sitio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adjunto`
--
ALTER TABLE `adjunto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moderador`
--
ALTER TABLE `moderador`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `palabraclave`
--
ALTER TABLE `palabraclave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_sitio`
--
ALTER TABLE `usuario_sitio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adjunto`
--
ALTER TABLE `adjunto`
  ADD CONSTRAINT `post-adjunto` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `post-comentario` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_sitio-comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_sitio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `denunciacomentario`
--
ALTER TABLE `denunciacomentario`
  ADD CONSTRAINT `comentario` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id_comentario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moderador` FOREIGN KEY (`id_moderador`) REFERENCES `moderador` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_sitio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `denunciapost`
--
ALTER TABLE `denunciapost`
  ADD CONSTRAINT `moderador-denunciapost` FOREIGN KEY (`id_moderador`) REFERENCES `moderador` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post-denunciapost` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariositio` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_sitio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen-post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD CONSTRAINT `moderador-administrador` FOREIGN KEY (`usuarioalta`) REFERENCES `administrador` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `palabraclave`
--
ALTER TABLE `palabraclave`
  ADD CONSTRAINT `post-palabraclave` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `usuariositio-post` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_sitio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
