/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `imagen` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `contenido` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `creado` date DEFAULT NULL,
  `usuarioId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioId_id` (`usuarioId`),
  CONSTRAINT `usuarioId` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Propiedades_vendedores_idx` (`vendedores_id`),
  CONSTRAINT `fk_Propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `password` char(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `celular` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

INSERT INTO `blog` (`id`, `titulo`, `imagen`, `descripcion`, `contenido`, `creado`, `usuarioId`) VALUES
(2, 'Terraza en el techo de tu casas', '21bc03eaf37f25f5c9c43e7e4ac8e1d8.jpg', 'Descripción breve que al menos contiene 20 caracteres', 'Fusce venenatis nulla in varius varius. Donec pellentesque pharetra eros nec mattis. Cras eget neque at ligula egestas rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse suscipit quam orci, non aliquet lectus faucibus vel. Maecenas commodo malesuada arcu vel consectetur. Nullam eu enim molestie, luctus ante varius, semper tortor. Aliquam dignissim convallis erat nec ultrices. Suspendisse non orci ornare, commodo purus sed, efficitur mi. Fusce tincidunt ultricies aliquet. Sed eu luctus lacus. Aenean molestie dictum neque at rutrum. Aenean dignissim in urna eu vestibulum. Mauris id ligula non dui consectetur posuere.\r\n\r\nMorbi at faucibus mauris. Curabitur mattis, eros vitae tincidunt gravida, neque velit imperdiet nibh, id condimentum nibh augue eu nunc. Morbi consequat justo ipsum, sit amet semper risus eleifend a. Morbi ornare iaculis iaculis. Etiam mollis suscipit neque vitae semper. Nam imperdiet auctor egestas. Nulla pellentesque, dui eget euismod porta, augue tellus commodo magna, id consequat magna purus a urna.', '2026-05-01', 2),
(3, ' Guía para la decoración de tu hogar', '5f70876d9312b5d8463d83cca7f9d610.jpg', 'Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio', 'Phasellus interdum ornare velit, eget sollicitudin metus finibus id. Ut eu velit nec eros fermentum tincidunt. Vivamus elementum pulvinar nisi, vitae dapibus tortor imperdiet eget. In mattis felis dolor, in vulputate ante dictum in. Proin tempor condimentum risus, cursus rhoncus metus tempus in. Pellentesque vel mauris libero. Proin aliquam venenatis justo eget dapibus. Aliquam tempor pretium elementum. Suspendisse arcu eros, viverra in mauris sed, condimentum dictum ante.\r\n\r\nAliquam euismod, ipsum aliquam posuere vehicula, odio sem tincidunt augue, quis varius ante eros vitae velit. Vestibulum nec nisl feugiat, elementum felis vitae, imperdiet odio. Donec commodo, urna vitae sollicitudin elementum, lacus elit viverra justo, nec finibus risus ex in arcu. Pellentesque molestie suscipit arcu, ac finibus sem finibus ac. Proin tincidunt erat in ligula luctus, eget sodales neque porta. Ut velit sapien, pulvinar nec volutpat fermentum, pellentesque at diam. Vestibulum est quam, aliquet vitae suscipit in, congue id augue. Etiam vitae erat nisi. Pellentesque ut turpis non nisi tempus suscipit. Etiam ut rhoncus est. Nunc pharetra lorem ipsum, eu auctor dolor tempus a. Duis vel nisi eu felis fringilla vestibulum. Proin semper, odio quis sodales fermentum, dui lacus lacinia nibh, id porttitor purus ante at massa. Integer pretium consequat mollis. Aliquam cursus blandit arcu nec malesuada.', '2026-05-01', 2),
(4, ' Tercer titulo Blog', '1f45ecf87540b4d67a86113cd2f4ff8f.jpg', 'Descripción breve que al menos contiene 20 caracteres', 'Phasellus enim justo, pulvinar sit amet sodales id, ullamcorper at nisl. Aenean bibendum mattis bibendum. Integer egestas, dolor tempor sagittis egestas, nunc tortor lacinia libero, in accumsan urna odio sed nulla. Aenean facilisis ultricies ligula a feugiat. Curabitur vestibulum nulla egestas est luctus vestibulum. Integer pharetra arcu vitae augue commodo bibendum. Sed in semper ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et sem vel quam consectetur pharetra.\r\n\r\nEtiam ut accumsan lorem. Maecenas pulvinar, purus sed fringilla iaculis, nibh erat vestibulum urna, eget sodales augue ex ut nibh. Sed dapibus molestie malesuada. Suspendisse consectetur tellus in malesuada molestie. Donec sed laoreet lacus, vitae placerat leo. Ut ut aliquet elit. Nam posuere dui mi, vitae facilisis turpis facilisis eu. Nulla facilisi.', '2026-05-01', 2),
(5, ' Cuarto Titulo blog', 'f0a262efe0aadd80d0db411f96525456.jpg', 'Descripción breve que al menos contiene 20 caracteres', 'Ut lacus ante, dictum at posuere vel, dapibus nec risus. Donec bibendum non magna eget rhoncus. Ut suscipit augue et tortor efficitur, eget semper neque bibendum. Quisque tempor dui tellus, sed imperdiet massa venenatis quis. Suspendisse sed risus eleifend, rhoncus nunc id, ornare justo. Integer gravida mauris nulla, ac pellentesque lacus laoreet a. Proin sed vestibulum ex, id sodales tellus. Quisque augue erat, ultrices nec nibh lacinia, fermentum luctus orci. Praesent vulputate ipsum felis, sed posuere diam finibus bibendum. Nunc lacinia, massa a condimentum feugiat, neque nunc vulputate purus, vel convallis tellus sapien ac ex. Fusce maximus diam a sem luctus lobortis. Integer consequat leo at lectus aliquet, vitae porttitor turpis feugiat. Pellentesque eros ipsum, iaculis id lectus non, egestas eleifend odio. Duis varius diam quis odio porta, quis mollis odio semper. Integer eu ullamcorper velit.\r\n\r\nCras sit amet vulputate nisl, nec interdum nibh. Quisque in mattis enim, sit amet vehicula leo. Aenean imperdiet at dolor non dictum. In eget sollicitudin dui. In congue ipsum in ex molestie ultrices. Nulla fermentum mauris vel iaculis laoreet. Nam vehicula lacus lacus, congue placerat nibh aliquam non. Mauris luctus et leo et consectetur. Curabitur id venenatis libero. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam nec efficitur orci. Sed tincidunt ipsum sit amet erat maximus suscipit. Donec condimentum est et dolor scelerisque, nec dignissim libero cursus. Morbi est nibh, luctus sit amet odio eget, maximus sodales purus. Sed malesuada nisl at varius aliquam.', '2026-05-01', 2);
INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedores_id`) VALUES
(15, 'Casa de Lujo en el Lago', '3500000.00', '682a1c92cec48c5d5112be81c3688b08.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 5, 5, 2, '2026-03-28', 12),
(16, 'Casa con alberca', '3250000.00', '06dc6f6ffc7729b33334231b30090c05.jpg', 'Casa con alberca y acabados de lujo en la ciudad, excelente oportunidad', 3, 2, 1, '2026-03-28', 10),
(17, 'Casa Terminados de Lujo', '3500000.00', '3243725e3d4099f4915c6e9408759fad.jpg', 'Casa con diseño moderno, así como tecnología inteligente y amueblada', 4, 3, 3, '2026-03-28', 9),
(36, ' Casa a las afueras', '2221996.00', '28820df61e77335166f950cff667aefb.jpg', 'Más allá de estar situada en la periferia de la ciudad posee una excelente vista como puede apreciarse en la imagen ', 2, 1, 1, '2026-04-19', 15),
(38, ' Gran Residencia', '50590000.00', 'a0dbbef633c3cd955d53e9cf22d481bb.jpg', 'Residencia ubicada en zona limítrofe, totalmente amueblada con excelente vista. ', 9, 9, 6, '2026-04-20', 13),
(49, ' Casa a Estrenar', '52000000.00', 'e35d6b686156a2df3f21ecfb14498617.jpg', 'Casa completamente amueblada en barrio ubicado en zona norte', 3, 2, 1, '2026-05-01', 13);
INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`) VALUES
(2, 'correo@correo.com', '$2y$10$X39JVWI5uZXDnIRxvsWJ8uIKvWEhB6nRlFE1O3zcz.zOio6kTsfmW', 'Admin');
INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `celular`, `email`, `imagen`, `creado`) VALUES
(9, ' Luís', 'Morales', '+59894000000', 'correocorre3o@correo.com', '17c354588ed1e59b2b1e291d5186e763.jpg', '2026-04-20'),
(10, ' María', 'Rodriguez', '+59894000000', 'correocorreo@correo.com', '621288d47b67b3d6cb3ca98b39908f34.jpg', '2026-04-20'),
(12, ' Juan', 'Roth', '+59894000000', 'correocorreo@correo.com', 'b5aa9988e4cc71e43fe87444d63bb5f6.jpg', '2026-04-20'),
(13, ' Camila', 'Lima', '+59894000001', 'correocorreo@correo.com', 'ffc7f98e069b24f1d7fe70e0399bd5a2.jpg', '2026-04-20'),
(15, '  Jhon', 'Snow', '+59894000000', 'jhonsnow@correo.com', '2261bde77ad19f24485849c61aa795ec.jpg', '2026-05-01');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;