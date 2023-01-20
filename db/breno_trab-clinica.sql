-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20-Jan-2023 às 18:25
-- Versão do servidor: 8.0.27
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `breno_trab-clinica`
--
CREATE DATABASE IF NOT EXISTS `breno_trab-clinica` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `breno_trab-clinica`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id_administrator` int NOT NULL AUTO_INCREMENT,
  `fk_id_user` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_administrator`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `administrator`
--

INSERT INTO `administrator` (`id_administrator`, `fk_id_user`, `email`) VALUES
(9, 25, 'breno.miggiolaro@gmail.com'),
(8, 24, 'diniz.miggiolaro@gmail.com'),
(7, 22, 'breno.miggiolaro@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `appoiment`
--

DROP TABLE IF EXISTS `appoiment`;
CREATE TABLE IF NOT EXISTS `appoiment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paciente` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `appoiment`
--

INSERT INTO `appoiment` (`id`, `date`, `paciente`) VALUES
(1, 'hoje', 'Breno'),
(2, 'amanhã', 'Thiago'),
(3, 'ontem', 'Vinicius Mendes'),
(4, 'ontem2', 'Vinicius Diniz'),
(5, 'ontem3', 'Leandro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacients`
--

DROP TABLE IF EXISTS `pacients`;
CREATE TABLE IF NOT EXISTS `pacients` (
  `id_pacients` int NOT NULL AUTO_INCREMENT,
  `cpf` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_user` int NOT NULL,
  PRIMARY KEY (`id_pacients`),
  KEY `fk_id_user` (`fk_id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pacients`
--

INSERT INTO `pacients` (`id_pacients`, `cpf`, `email`, `fk_id_user`) VALUES
(2, '111.111.111-11', '', 26),
(4, '', '', 47);

-- --------------------------------------------------------

--
-- Estrutura da tabela `psychologist`
--

DROP TABLE IF EXISTS `psychologist`;
CREATE TABLE IF NOT EXISTS `psychologist` (
  `id_psychologist` int NOT NULL AUTO_INCREMENT,
  `fk_id_user` int NOT NULL,
  `crp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abord` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_psychologist`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `psychologist`
--

INSERT INTO `psychologist` (`id_psychologist`, `fk_id_user`, `crp`, `abord`, `email`) VALUES
(3, 23, '1', 'essa', 'breno.miggiolaro@gmail.com'),
(4, 50, '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretary`
--

DROP TABLE IF EXISTS `secretary`;
CREATE TABLE IF NOT EXISTS `secretary` (
  `id_secretary` int NOT NULL AUTO_INCREMENT,
  `fk_id_user` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_secretary`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `secretary`
--

INSERT INTO `secretary` (`id_secretary`, `fk_id_user`, `email`) VALUES
(2, 27, 'teste@teste.teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `title`, `picture`, `sex`, `is_active`) VALUES
(22, 'breno', '202cb962ac59075b964b07152d234b70', 'adm', 'default.png', 'm', 1),
(23, 'psicologo-teste', '202cb962ac59075b964b07152d234b70', 'psi', 'default.png', 'f', 0),
(24, 'diniz', 'caf1a3dfb505ffed0d024130f58c5cfa', 'adm', 'fef7f1965fe60edee7d6c1922159305c.jpg', 'm', 1),
(25, 'teste', '202cb962ac59075b964b07152d234b70', 'adm', 'tomswallpapers.com-23641.jpg', 'f', 0),
(26, 'teste-paciente', '202cb962ac59075b964b07152d234b70', 'paci', 'default.png', 'f', 1),
(27, 'teste-secretaria', '202cb962ac59075b964b07152d234b70', 'secre', 'default.png', 'm', 1),
(47, 'aaaa', '202cb962ac59075b964b07152d234b70', 'paci', '', 'm', 1),
(50, 'Ananda', '202cb962ac59075b964b07152d234b70', 'psi', '', 'f', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
