-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Mar-2017 às 05:13
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duraprice`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `fornecedor_id` int(11) NOT NULL,
  `fornecedor_nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`fornecedor_id`, `fornecedor_nome`, `descricao`, `data_cadastro`) VALUES
(1, 'Bic Brasil', 'Bic é uma empresa francesa com sede em Clichy. Fundada em 1945, é conhecida por fabricar produtos à base de plásticos, incluindo isqueiros, canetas, aparelhos de barbear mas também caiaques.', '2017-03-14'),
(2, 'Fabber Castell', 'Fabrica Lápis', '2017-03-15'),
(3, 'Xamequinho', 'Fabricante de Papel', '2017-03-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `preco_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `preco_anterior` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_entrada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`preco_id`, `produto_id`, `fornecedor_id`, `preco`, `preco_anterior`, `usuario_id`, `data_entrada`) VALUES
(1, 1, 1, '1.20', '0.00', 1, '2017-03-14 00:00:00'),
(2, 1, 1, '1.29', NULL, 1, '2017-03-14 22:52:46'),
(3, 1, 1, '1.25', NULL, 1, '2017-03-14 22:54:04'),
(4, 1, 1, '1.36', NULL, 1, '2017-03-14 22:54:39'),
(5, 1, 1, '1.45', NULL, 1, '2017-03-14 22:57:29'),
(6, 1, 1, '1.35', NULL, 1, '2017-03-14 23:20:29'),
(7, 1, 2, '1.56', NULL, 1, '2017-03-15 00:18:25'),
(8, 4, 2, '0.58', NULL, 1, '2017-03-15 00:33:42'),
(9, 4, 2, '1.36', NULL, 1, '2017-03-15 00:35:48'),
(10, 4, 2, '0.89', NULL, 1, '2017-03-15 00:36:08'),
(11, 4, 1, '0.89', NULL, 1, '2017-03-15 00:36:17'),
(12, 1, 2, '2.69', NULL, 1, '2017-03-15 19:52:38'),
(13, 1, 2, '2.68', NULL, 1, '2017-03-15 19:52:59'),
(14, 1, 1, '1.23', NULL, 1, '2017-03-15 23:24:13'),
(15, 4, 2, '1.25', NULL, 1, '2017-03-15 23:46:36'),
(16, 4, 1, '1.32', NULL, 1, '2017-03-15 23:48:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL,
  `produto_nome` varchar(100) NOT NULL,
  `data_cadastro` date NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `produto_nome`, `data_cadastro`, `descricao`) VALUES
(1, 'Caneta Hidrográfica Azul', '2017-03-14', 'É uma caneta azul.'),
(4, 'Lápis Fabber Castell', '2017-03-15', 'É um lápis de escrever');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` tinyint(4) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nome`, `username`, `password`) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`preco_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produto_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `preco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
