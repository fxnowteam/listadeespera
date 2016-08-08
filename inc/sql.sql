-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 08-Ago-2016 às 13:38
-- Versão do servidor: 5.5.49-0+deb8u1
-- PHP Version: 5.6.22-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `listadeespera`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id` int(11) NOT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `listadeespera`
--

CREATE TABLE IF NOT EXISTS `listadeespera` (
`id` int(11) NOT NULL,
  `pessoa` varchar(128) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `urgencia` int(1) DEFAULT NULL,
  `anotacoes` text,
  `grupo` int(11) DEFAULT NULL,
  `datachamada` datetime DEFAULT NULL,
  `confirmado` int(1) DEFAULT NULL,
  `naoveio` int(1) DEFAULT NULL,
  `naoconcluiu` int(1) DEFAULT NULL,
  `datadesistencia` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE IF NOT EXISTS `pessoas` (
`id` int(11) NOT NULL,
  `chave` varchar(128) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `sexo` int(1) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `fone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listadeespera`
--
ALTER TABLE `listadeespera`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `listadeespera`
--
ALTER TABLE `listadeespera`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
