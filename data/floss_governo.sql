-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 31/07/2020 às 16:24
-- Versão do servidor: 8.0.21-0ubuntu0.20.04.3
-- Versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `floss_governo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_software`
--

CREATE TABLE `categoria_software` (
  `codigo` int NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `licenca`
--

CREATE TABLE `licenca` (
  `codigo` int NOT NULL,
  `nome` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `livre` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orgao`
--

CREATE TABLE `orgao` (
  `codigo` int NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipo_orgao` int NOT NULL,
  `compra` tinyint(1) NOT NULL DEFAULT '0',
  `justifica` tinyint(1) NOT NULL DEFAULT '0',
  `semresposta` tinyint(1) NOT NULL DEFAULT '0',
  `depende` tinyint(1) NOT NULL DEFAULT '0',
  `sigla` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `desenvolveusl` tinyint(1) NOT NULL DEFAULT '0',
  `pedidos` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `protocolo`
--

CREATE TABLE `protocolo` (
  `codigo` int NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `protocolo_orgao`
--

CREATE TABLE `protocolo_orgao` (
  `codigo_protocolo` int NOT NULL,
  `codigo_orgao` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `software`
--

CREATE TABLE `software` (
  `codigo` int NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codigo_categoria` int NOT NULL,
  `website` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codigo_licenca` int NOT NULL,
  `observacoes` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `software_orgao`
--

CREATE TABLE `software_orgao` (
  `codigo_software` int NOT NULL,
  `codigo_orgao` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_orgao`
--

CREATE TABLE `tipo_orgao` (
  `codigo` int NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria_software`
--
ALTER TABLE `categoria_software`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `licenca`
--
ALTER TABLE `licenca`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `orgao`
--
ALTER TABLE `orgao`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `protocolo`
--
ALTER TABLE `protocolo`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `protocolo_orgao`
--
ALTER TABLE `protocolo_orgao`
  ADD PRIMARY KEY (`codigo_protocolo`,`codigo_orgao`);

--
-- Índices de tabela `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `software_orgao`
--
ALTER TABLE `software_orgao`
  ADD PRIMARY KEY (`codigo_software`,`codigo_orgao`);

--
-- Índices de tabela `tipo_orgao`
--
ALTER TABLE `tipo_orgao`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria_software`
--
ALTER TABLE `categoria_software`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `licenca`
--
ALTER TABLE `licenca`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orgao`
--
ALTER TABLE `orgao`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `protocolo`
--
ALTER TABLE `protocolo`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `software`
--
ALTER TABLE `software`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_orgao`
--
ALTER TABLE `tipo_orgao`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
