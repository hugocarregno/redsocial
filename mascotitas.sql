-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2019 a las 03:39:53
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usuarioUltMod` int(11) DEFAULT NULL,
  `fechaUltMod` date DEFAULT NULL,
  `usuarioAlta` int(11) NOT NULL,
  `fechaAlta` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `imagenPerfil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amistad`
--

CREATE TABLE `amistad` (
  `id` int(11) NOT NULL,
  `usuarioEmisor` int(11) NOT NULL,
  `usuarioReceptor` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denunciacomentario`
--

CREATE TABLE `denunciacomentario` (
  `idUsuario` int(11) NOT NULL,
  `idModerador` int(11) DEFAULT NULL,
  `idComentario` int(11) NOT NULL,
  `fechaDenuncia` datetime NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `fechaModeracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denunciapost`
--

CREATE TABLE `denunciapost` (
  `idUsuario` int(11) NOT NULL,
  `idModerador` int(11) DEFAULT NULL,
  `idPost` int(11) NOT NULL,
  `fechaDenuncia` datetime NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `fechaModeracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderador`
--

CREATE TABLE `moderador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usuarioUltMod` varchar(50) DEFAULT NULL,
  `fechaUltMod` date DEFAULT NULL,
  `usuarioAlta` int(11) NOT NULL,
  `fechaAlta` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `imagenPerfil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `foto1` varchar(200) NOT NULL,
  `foto2` varchar(200) DEFAULT NULL,
  `foto3` varchar(200) DEFAULT NULL,
  `adjunto` varchar(200) DEFAULT NULL,
  `palabraClave1` varchar(100) DEFAULT NULL,
  `palabraClave2` varchar(100) DEFAULT NULL,
  `palabraClave3` varchar(100) DEFAULT NULL,
  `visibilidad` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariositio`
--

CREATE TABLE `usuariositio` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usuarioUltMod` int(11) DEFAULT NULL,
  `fechaUltMod` date DEFAULT NULL,
  `fechaAlta` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `imagenPerfil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `amistad`
--
ALTER TABLE `amistad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor-usuariositio` (`usuarioEmisor`),
  ADD KEY `receptor-usuariositio` (`usuarioReceptor`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario-usuariositio` (`idUsuario`),
  ADD KEY `comentario-post` (`idPost`);

--
-- Indices de la tabla `denunciacomentario`
--
ALTER TABLE `denunciacomentario`
  ADD KEY `dc-usuariositio` (`idUsuario`),
  ADD KEY `dc-moderador` (`idModerador`),
  ADD KEY `dc-comentario` (`idComentario`);

--
-- Indices de la tabla `denunciapost`
--
ALTER TABLE `denunciapost`
  ADD KEY `dp-usuariositio` (`idUsuario`),
  ADD KEY `dp-moderador` (`idModerador`),
  ADD KEY `dp-post` (`idPost`);

--
-- Indices de la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderador-administrador` (`usuarioAlta`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post-usuariositio` (`idUsuario`);

--
-- Indices de la tabla `usuariositio`
--
ALTER TABLE `usuariositio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `amistad`
--
ALTER TABLE `amistad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moderador`
--
ALTER TABLE `moderador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuariositio`
--
ALTER TABLE `usuariositio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amistad`
--
ALTER TABLE `amistad`
  ADD CONSTRAINT `emisor-usuariositio` FOREIGN KEY (`usuarioEmisor`) REFERENCES `usuariositio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receptor-usuariositio` FOREIGN KEY (`usuarioReceptor`) REFERENCES `usuariositio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario-post` FOREIGN KEY (`idPost`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario-usuariositio` FOREIGN KEY (`idUsuario`) REFERENCES `usuariositio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `denunciacomentario`
--
ALTER TABLE `denunciacomentario`
  ADD CONSTRAINT `dc-comentario` FOREIGN KEY (`idComentario`) REFERENCES `comentario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dc-moderador` FOREIGN KEY (`idModerador`) REFERENCES `moderador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dc-usuariositio` FOREIGN KEY (`idUsuario`) REFERENCES `usuariositio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `denunciapost`
--
ALTER TABLE `denunciapost`
  ADD CONSTRAINT `dp-moderador` FOREIGN KEY (`idModerador`) REFERENCES `moderador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dp-post` FOREIGN KEY (`idPost`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dp-usuariositio` FOREIGN KEY (`idUsuario`) REFERENCES `usuariositio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD CONSTRAINT `moderador-administrador` FOREIGN KEY (`usuarioAlta`) REFERENCES `administrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post-usuariositio` FOREIGN KEY (`idUsuario`) REFERENCES `usuariositio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
