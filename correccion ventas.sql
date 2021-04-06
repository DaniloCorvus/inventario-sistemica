-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para operac_local
CREATE DATABASE IF NOT EXISTS `operac_local` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `operac_local`;

-- Volcando estructura para tabla operac_local.detalles
CREATE TABLE IF NOT EXISTS `detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inventario_id` int(10) unsigned DEFAULT NULL,
  `venta_id` int(10) unsigned DEFAULT NULL,
  `cantidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `impuesto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rtFuente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla operac_local.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_promesa` date DEFAULT NULL,
  `fecha_autorizado` date DEFAULT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `fecha_entregado` date DEFAULT NULL,
  `valor_cotizado` double(50,2) DEFAULT NULL,
  `valor_aprobado` double(50,2) DEFAULT NULL,
  `valor_cargo_cliente` double(50,2) DEFAULT NULL,
  `dinero_recibido` double(50,2) DEFAULT NULL,
  `happycallestado_id` int(11) DEFAULT NULL,
  `happycall_calificacion` int(11) DEFAULT NULL,
  `observacion_happy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_factura` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa_id` bigint(20) unsigned DEFAULT NULL,
  `total_bruto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_impuesto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `condiciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_letras` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clausulas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_rtFuente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
