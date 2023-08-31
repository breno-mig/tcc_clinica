-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db-mysql:3306
-- Tempo de geração: 05/06/2023 às 22:21
-- Versão do servidor: 8.0.32
-- Versão do PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc_clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `appoiment`
--

CREATE TABLE `appoiment` (
  `id_appoiment` int NOT NULL,
  `booking_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `id_psychologist` int NOT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `id_pacient` int NOT NULL,
  `observation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `appoiment`
--

INSERT INTO `appoiment` (`id_appoiment`, `booking_date`, `is_active`, `id_psychologist`, `appointment_date`, `id_pacient`, `observation`) VALUES
(1, '2023-06-13 15:00:00', 1, 3, '2023-05-29 19:06:39', 7, 'ola'),
(2, '2023-06-01 12:00:00', 1, 8, '2023-05-29 22:29:20', 7, ''),
(3, '2023-06-09 00:00:00', 1, 3, '2023-05-31 17:01:12', 10, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `profile`
--

CREATE TABLE `profile` (
  `id_profile` int NOT NULL,
  `permissions` json DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `profile`
--

INSERT INTO `profile` (`id_profile`, `permissions`, `extra`, `name`, `is_active`) VALUES
(1, '{\"access_to_user\": {\"edit\": true, \"view\": true, \"insert\": true}, \"access_to_notes\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_patient\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_appoiment\": {\"edit\": false, \"view\": false, \"insert\": false}}', '{}', 'adm', 1),
(2, '{\"access_to_user\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_notes\": {\"edit\": true, \"view\": true, \"insert\": true}, \"access_to_patient\": {\"edit\": true, \"view\": true, \"insert\": true}, \"access_to_appoiment\": {\"edit\": true, \"view\": true, \"insert\": true}}', '{}', 'psi', 1),
(3, '{\"access_to_user\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_notes\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_patient\": {\"edit\": true, \"view\": true, \"insert\": true}, \"access_to_appoiment\": {\"edit\": true, \"view\": true, \"insert\": true}}', '{}', 'secre', 1),
(4, '{\"access_to_user\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_notes\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_patient\": {\"edit\": false, \"view\": false, \"insert\": false}, \"access_to_appoiment\": {\"edit\": true, \"view\": true, \"insert\": true}}', '{}', 'paci', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `document` varchar(45) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `id_profile` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `sex`, `picture`, `email`, `is_active`, `document`, `birth_date`, `registration_date`, `id_profile`) VALUES
(1, 'breno', '$2y$13$Ac3qbbt23NXei7x7yBwxL.6aRMkdZuUIxDlK5/7sCWA61E/iMVzQC', 'm', 'Foto-Perfil.jpg', 'breno.miggiolaro@gmail.com', 1, '47913195835', '2002-07-13 00:00:00', '2023-05-18 00:00:00', 1),
(3, 'daniel', '$2y$13$j2717UqAnjDEu6/xTdVAxOIepme3Pj/MvW.4kz6qR/sLvibPy07N.', 'm', 'Design-sem-nome-85.png', 'breno.miggiolaro@gmail.com', 1, '01234567890', '2002-07-13 00:00:00', '2023-05-22 20:17:25', 2),
(5, 'alessandra', '$2y$13$GhdvW5NhSkuqeBfO0ct0We.BIKeI7iQYbcNpVuYZbKO.5y8hF.w0G', 'f', 'default.png', 'teste@teste.com', 1, '38454464557', '2002-07-13 00:00:00', '2023-05-22 20:29:32', 3),
(7, 'kaue', '$2y$13$g2iHK4ma0tXd1aDGOaVUrO6XAUn83PJ4yMmre2INkd4CAuEifYpga', 'm', '1607195.jpg', 'teste@teste.com', 1, '28822756096', '2002-07-13 00:00:00', '2023-05-23 00:36:10', 4),
(8, 'ananda', '$2y$13$DTlvHh1zZWFhx7sn/OTh9O5TSMobeeBHD4yc/O9esH7aIFOo9IRrG', 'f', '1969-chevrolet-c-k-chevrolet-c-k-truck-chevrolet-wallpaper.jpg', 'teste@teste.com', 1, '41666399000', '2002-07-13 00:00:00', '2023-05-23 03:57:27', 2),
(9, 'renato', '$2y$13$2QfFGxhKEc5cp5epuwcHx.FktjOC9wVeVceIo/3/FwF6MDXySmwGu', 'm', 'default.png', 'renato@fatec.com', 1, '40513952004', '2000-01-01 00:00:00', '2023-05-31 16:35:22', 1),
(10, 'lucas', '$2y$13$YP1K.yhTmmpQD3b8BatbzuHfrIeGDcvj1ONlxsldcDNhEZ6fjM1Y6', 'm', 'default.png', 'lucas@fatec.com', 1, '90191825018', '2000-01-01 00:00:00', '2023-05-31 16:57:18', 4),
(11, 'renata', '$2y$13$e5RgO.6Kh/bebEb7PZCvgu9Sql3ME7I92KSkHgGlOepaTqW24M4Oy', 'f', 'default.png', 'renata@email.com', 1, '24126312048', '2000-01-01 00:00:00', '2023-05-31 16:58:22', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `appoiment`
--
ALTER TABLE `appoiment`
  ADD PRIMARY KEY (`id_appoiment`,`id_psychologist`,`id_pacient`),
  ADD UNIQUE KEY `id_appoiment_UNIQUE` (`id_appoiment`),
  ADD KEY `fk_appoiment_user1_idx` (`id_psychologist`),
  ADD KEY `fk_appoiment_user2_idx` (`id_pacient`);

--
-- Índices de tabela `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD UNIQUE KEY `id_profile_UNIQUE` (`id_profile`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`,`id_profile`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `id_user_UNIQUE` (`id_user`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`),
  ADD UNIQUE KEY `document_UNIQUE` (`document`),
  ADD KEY `fk_user_profile_idx` (`id_profile`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `appoiment`
--
ALTER TABLE `appoiment`
  MODIFY `id_appoiment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `appoiment`
--
ALTER TABLE `appoiment`
  ADD CONSTRAINT `fk_appoiment_user1` FOREIGN KEY (`id_psychologist`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_appoiment_user2` FOREIGN KEY (`id_pacient`) REFERENCES `user` (`id_user`);

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
