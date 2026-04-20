-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2026 a las 00:36:00
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
-- Base de datos: `galeria_de_arte_digital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `id_artista` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_fallecimiento` date DEFAULT NULL,
  `corriente_artistica` varchar(50) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `biografia` text NOT NULL,
  `imagen` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`id_artista`, `nombre_completo`, `fecha_nacimiento`, `fecha_fallecimiento`, `corriente_artistica`, `nacionalidad`, `biografia`, `imagen`) VALUES
(1, 'Claude Monet', '1840-11-14', '1926-12-05', 'Impresionismo', 'Frances', 'Pintor francés, fundador del impresionismo. Maestro de la luz y el color, célebre por su serie Nenúfares y las vistas de la Catedral de Rouen.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Claude_Monet_1899_Nadar_crop.jpg/250px-Claude_Monet_1899_Nadar_crop.jpg'),
(2, 'Guillermo Bert', '1959-02-28', NULL, 'Arte Conceptual, Arte de Instalación', 'Chileno', 'Chileno nacido en 1959, vive en Los Ángeles. Artista multimedia que fusiona tecnología, textiles indígenas y escultura para visibilizar la identidad y migración latina.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\Guillermo-Bert-2019.png'),
(3, 'Leonardo Da Vinci', '1452-04-15', '1519-05-02', 'Renacimiento', 'Italiano', 'Leonardo da Vinci (Vinci, Italia, 1452 - Amboise, Francia, 1519) fue un genio renacentista italiano considerado uno de los artistas más influyentes de la historia. Pintor, escultor, arquitecto, científico e inventor, su curiosidad no conocía límites.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\da_vinci.png'),
(4, 'Michelangelo Merisi da Caravaggio', '1571-09-29', '1610-07-18', 'Barroco', 'Italiano', 'Fue uno de los pintores más revolucionarios y controvertidos del Barroco italiano.\r\nArtísticamente, transformó la pintura occidental con dos aportaciones fundamentales: el tenebrismo — uso extremo del contraste entre luz y sombra — y el naturalismo, representando figuras religiosas con rostros y cuerpos de personas comunes, alejándose completamente de la idealización renacentista. Sus modelos eran frecuentemente mendigos, prostitutas y gente de la calle.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\caravaggio.png'),
(5, 'Andy Warhol', '1928-08-06', '1987-02-22', 'Arte Pop, Arte Moderno', 'Estadounidense', 'Artista plástico y actor estadounidense que desempeñó un papel crucial en el nacimiento y desarrollo del pop art.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\andy_warhol.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id_obra` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `año_creacion` int(4) NOT NULL,
  `tecnica` varchar(50) NOT NULL,
  `soporte` varchar(50) NOT NULL,
  `corriente_artistica` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `id_artista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id_obra`, `nombre`, `año_creacion`, `tecnica`, `soporte`, `corriente_artistica`, `descripcion`, `imagen`, `id_artista`) VALUES
(3, 'Impresión, sol naciente', 1872, 'Óleo', 'Lienzo', 'Impresionismo', 'La obra muestra un puerto en Le Havre, la ciudad natal de Monet. Con un énfasis en la luz y el color, la pieza retrata los efectos de un amanecer nebuloso en el agua. Las siluetas de dos botes de remos aparecen en primer plano, mientras que el fondo se compone de las difusas siluetas de barcos y chimeneas industriales.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\impresion_sol_naciente_MONET.png', 1),
(4, 'Autoretrato con boina', 1886, 'Óleo', 'Lienzo', 'Impresionismo', 'Autorretrato serio y austero. Monet se muestra con boina oscura, barba blanca y mirada directa. Pinceladas sueltas capturan luz y carácter con economía expresiva.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\autoretrato-con-boina-MONET.png', 1),
(5, 'El puente japonés', 1899, 'Óleo', 'Lienzo', 'Impresionismo', 'Además de capturar la sencilla de elegancia de la estructura, la pieza es una celebración del follaje de su jardín, que incluye sauces llorones, lavanda y nenúfares.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\el_puente_japones_MONET.png', 1),
(7, 'The Warriors', 2023, 'Escaneo 3D, Tecnología láser', 'Madera', 'Arte con Tecnología, Arte de instalación con dimen', 'La obra busca honrar a los trabajadores esenciales, particulamente individuos latinoamericanos viviendo en Estados Unidos, y sus labores fundamentales durante la pandemia de COVID-19.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\the_warriors_BERT.png', 2),
(8, 'Encoded Textiles', 2010, 'Tejido artesanal tradicional, Codificación digital', 'Textil, Soporte digital', 'Arte activista y descolonial contemporáneo', 'En la serie Textiles Codificados, Guillermo Bert mantiene vivas las tradiciones culturales usando tecnología moderna para dar voz a personas marginadas, silenciadas e invisibilizadas. En el corazón de esta serie se encuentra el proceso creativo de la codificación: el acto de incorporar mensajes en el tejido de las obras mismas y, en el sentido tecnológico, de convertir símbolos en lenguaje digital. ', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\encoded_textiles_BERT.png', 2),
(9, 'La Gioconda (Mona Lisa)', 1503, 'Óleo', 'Tabla', 'Renacimiento', 'La obra representa a una mujer de media figura, identificada tradicionalmente como Lisa Gherardini, esposa de un comerciante florentino.\r\nLa figura aparece sentada, con las manos cruzadas sobre el regazo y una leve sonrisa enigmática que ha fascinado al mundo durante siglos. Viste ropas oscuras y un velo transparente sobre el cabello, propio de la moda de la época.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\la_gioconda_DAVINCI.png', 3),
(10, 'Hombre de Vitruvio', 1490, 'Dibujo a pluma y tinta', 'Papel', 'Renacimiento', 'Este dibujo combina arte y ciencia, explorando la anatomía y las proporciones perfectas del cuerpo humano. Representa una figura masculina desnuda inscrita en un círculo y un cuadrado, basada en las descripciones del arquitecto romano Vitruvio sobre la armonía geométrica.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\hombre_de_vitruvio_DAVINCI.png', 3),
(11, 'Narciso', 1599, 'Óleo', 'Lienzo', 'Barroco', 'Representa el célebre mito griego del joven que se enamora de su propio reflejo. El reflejo en el agua es la clave narrativa: Narciso y su imagen forman un círculo casi perfecto, simbolizando el encierro del ego sobre sí mismo, la trampa del amor propio que conduce a la muerte.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\narciso_caravaggio.png', 4),
(12, 'La Cabeza de Medusa', 1597, 'Óleo', 'Lienzo y rodela de madera de álamo', 'Barroco', 'Representa el instante preciso de la decapitación de la Gorgona, capturando su rostro en un grito de terror y sangre, pintado con un realismo dramático y claroscuro característicos del autor.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\cabeza_medusa_CARAVAGGIO.png', 4),
(13, 'Shot Marilyns', 1964, 'Serigrafía (acrílico y tinta serigráfica)', 'Lienzo', 'Arte Pop', 'Son una serie de cinco famosas serigrafías de Andy Warhol que retratan a Marilyn Monroe, marcadas por un incidente donde la artista Dorothy Podber disparó con un revólver a cuatro de ellas en \"The Factory\". La Shot Sage Blue Marilyn se vendió en 2022 por US$195 millones, siendo una de las obras de arte más caras de la historia.', 'C:\\xampp\\htdocs\\web2\\TPE1\\img\\shot_marylins_WARHOL.png', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`id_artista`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id_obra`),
  ADD KEY `id_artista` (`id_artista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `id_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id_obra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `obras`
--
ALTER TABLE `obras`
  ADD CONSTRAINT `obras_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artista` (`id_artista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
