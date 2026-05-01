/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `password` char(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedores_id`) VALUES
(15, 'Casa de Lujo en el Lago ACTUALIZADOo', '3500000.00', 'e6d427caa589eabed753db9bcfeee0de.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 5, 5, 2, '2026-03-28', 12),
(16, 'Casa con alberca', '3250000.00', '06dc6f6ffc7729b33334231b30090c05.jpg', 'Casa con alberca y acabados de lujo en la ciudad, excelente oportunidad', 3, 2, 1, '2026-03-28', 10),
(17, 'Casa Terminados de Lujo', '3500000.00', '3243725e3d4099f4915c6e9408759fad.jpg', 'Casa con diseño moderno, así como tecnología inteligente y amueblada', 4, 3, 3, '2026-03-28', 9),
(36, ' Casa en una Cueva - En Oferta', '2222.00', '365f7a322596b21d2fa3e7185b985b36.jpg', 'Más allá de ser una cueva posee una excelente vista como puede apreciarse en la imagen ', 1, 1, 1, '2026-04-19', 5),
(38, ' Gran Residencia', '50590000.00', 'a0dbbef633c3cd955d53e9cf22d481bb.jpg', 'Residencia ubicada en zona limítrofe, totalmente amueblada con excelente vista. ', 9, 9, 6, '2026-04-20', 13),
(39, ' Apartamento de Lujo', '6000000.00', 'fe96fd312e8150ee960689f272c4aff2.jpg', 'Apartamento de lujo ubicado en zona céntrica, completamente amueblado listo para estrenar', 3, 2, 2, '2026-04-20', 5);
INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(2, 'correo@correo.com', '$2y$10$X39JVWI5uZXDnIRxvsWJ8uIKvWEhB6nRlFE1O3zcz.zOio6kTsfmW');
INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `celular`, `email`, `imagen`, `creado`) VALUES
(5, ' Jhon', 'Snow', '+59894000000', 'correocorreo@correo.com', 'ebab45cb1d50efbf4e195d79d0e83bd5.jpg', '2026-04-19'),
(9, ' Luis', 'Morales', '+59894000000', 'correocorre3o@correo.com', '17c354588ed1e59b2b1e291d5186e763.jpg', '2026-04-20'),
(10, ' María', 'Rodriguez', '+59894000000', 'correocorreo@correo.com', '621288d47b67b3d6cb3ca98b39908f34.jpg', '2026-04-20'),
(12, ' Juan', 'Roth', '+59894000000', 'correocorreo@correo.com', 'b5aa9988e4cc71e43fe87444d63bb5f6.jpg', '2026-04-20'),
(13, ' Camila', 'Lima', '+59894000001', 'correocorreo@correo.com', 'ffc7f98e069b24f1d7fe70e0399bd5a2.jpg', '2026-04-20');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;