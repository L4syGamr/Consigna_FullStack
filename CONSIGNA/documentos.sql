SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `sigsm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sigsm`;

DROP TABLE IF EXISTS `documentos`;

CREATE TABLE `documentos` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(150) NOT NULL,
  `TIPO` enum('indicacion','informacion') NOT NULL,
  `CEDULA_PACIENTE` varchar(8) NOT NULL,
  `FECHA_EMISION` date NOT NULL,
  `RUTA_ARCHIVO` varchar(150) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `documentos` (`ID`, `TITULO`, `TIPO`, `CEDULA_PACIENTE`, `FECHA_EMISION`, `RUTA_ARCHIVO`, `ACTIVO`) VALUES
(1, 'ESTUDIO VIRUELA DEL MONO', 'informacion', '58491927', '2026-09-29', 'documentos/informacion/EVDM.pdf', 0),
(2, 'GUIA HERRAMIENTAS QUIRURGICAS', 'indicacion', '58487612', '2026-09-29', 'documentos/indicacion/CIRUGIA_MATERIALES.pdf', 0),
(3, 'PRESCRIPCION MEDICACION ANTIBIOTCO FLUCENAZOL', 'indicacion', '55651822', '2026-09-29', 'documentos/indicacion/ANTIBIOTICO_FLUCENAZOL.pdf', 0),
(4, 'ESTUDIO GRIPE AMARILLA', 'indicacion', '45345321', '0000-00-00', 'documentos/indicacion/Screenshot 2026-08-22 014559.png.pdf', 0),
(5, 'ESTUDIO GRIPE AMARILLA', 'indicacion', '12312321', '0000-00-00', 'documentos/indicacion/ESTUDIO VIRUELA DEL MONO.pdf', 0),
(6, 'ESTUDIO GRIPE AMARILLA', 'indicacion', '', '0000-00-00', 'documentos/indicacion/.pdf', 0),
(7, 'ESTUDIO GRIPE AMARILLA', 'informacion', '73428423', '0000-00-00', 'documentos/informacion/.pdf', 0),
(8, 'ESTUDIO GRIPE AMARILLA', 'indicacion', '37724328', '0000-00-00', 'documentos/indicacion/Screenshot 2026-07-30 220128.png.pdf', 0),
(9, 'ACTUALIZACION DE OPERATIVOS HOSPITALARIOS', 'indicacion', '38234923', '0000-00-00', 'documentos/indicacion/DADADA.pdf', 0),
(10, '~W~', 'informacion', '34237428', '0000-00-00', 'documentos/informacion/ESTUDIO_MUY_IMPORTANTE.pdf', 0),
(12, '[[pppp', 'informacion', '45873453', '0000-00-00', 'documentos/informacion/NOOOO.pdf', 0),
(13, 'ESTUDIO GRIPE AMARILLA', 'indicacion', '34283482', '2026-09-30', 'documentos/indicacion/ESTUDIO_IMPORTANTE.pdf', 1),
(14, 'TIPOS DE SANGRE', 'informacion', '11111111', '2026-09-30', 'documentos/informacion/GENERAL.pdf', 1),
(15, 'ACTUALIZACION DE OPERATIVOS HOSPITALARIOS', 'indicacion', '00000000', '2026-09-30', 'documentos/indicacion/REPORTE.pdf', 1),
(16, 'PREVENCIONES', 'informacion', '34923394', '2026-09-30', 'documentos/informacion/ESTUDIO_IMPORTANTE.pdf', 1);

ALTER TABLE `documentos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RUTA_ARCHIVO` (`RUTA_ARCHIVO`);

ALTER TABLE `documentos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;