-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Out-2018 às 20:14
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estagio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome` text NOT NULL,
  `matricula` bigint(20) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `ano_entrada` int(11) NOT NULL,
  `ano_termino` int(11) NOT NULL,
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `matricula`, `id_curso`, `ano_entrada`, `ano_termino`, `obs`) VALUES
(1, '123', 123, 2, 123, 123, '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_empresa_status`
--

CREATE TABLE `aluno_empresa_status` (
  `id_aluno_empresa_status` int(11) NOT NULL,
  `id_empresa_estagio` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `data_inicio` text NOT NULL,
  `data_termino` text NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`) VALUES
(1, 'adm'),
(2, 'info'),
(3, 'AutomaÃ§Ã£o Industrial'),
(4, '123'),
(5, ''),
(6, ''),
(7, '123'),
(8, '123'),
(9, '123'),
(10, '123'),
(11, '123'),
(12, '123'),
(13, '123'),
(14, '1'),
(15, '1'),
(16, '1'),
(17, '1'),
(18, '1'),
(19, '1'),
(20, '1'),
(21, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nome` text NOT NULL,
  `CNPJ` bigint(20) NOT NULL,
  `site` text NOT NULL,
  `email` text NOT NULL,
  `endereco` text NOT NULL,
  `telefone` text NOT NULL,
  `uf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nome`, `CNPJ`, `site`, `email`, `endereco`, `telefone`, `uf`) VALUES
(2, '123132413', 0, '', '', '', '', 'AC'),
(3, 'sdadasfsaasfda', 0, '', '', '', '', 'AC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa_estagio`
--

CREATE TABLE `empresa_estagio` (
  `id_empresa_estagio` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `contato` text NOT NULL,
  `obs` text NOT NULL,
  `valor_bolsa` double NOT NULL,
  `data_informacao` text NOT NULL,
  `outros` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa_estagio`
--

INSERT INTO `empresa_estagio` (`id_empresa_estagio`, `id_empresa`, `titulo`, `id_curso`, `contato`, `obs`, `valor_bolsa`, `data_informacao`, `outros`) VALUES
(1, 2, '123', 3, '123', '123', 2131231, '123', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estatus`
--

CREATE TABLE `estatus` (
  `id_status` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estatus`
--

INSERT INTO `estatus` (`id_status`, `descricao`) VALUES
(1, 'sadassaf'),
(2, 'asdfasfssdf'),
(3, 'dsfsfs'),
(4, 'zcxzvxcvcbxcb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `fk_id_curso` (`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `aluno_empresa_status`
--
ALTER TABLE `aluno_empresa_status`
  ADD PRIMARY KEY (`id_aluno_empresa_status`),
  ADD KEY `fk_id_empresa_estagio` (`id_empresa_estagio`),
  ADD KEY `fk_id_aluno` (`id_aluno`),
  ADD KEY `fk_id_status` (`id_status`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indexes for table `empresa_estagio`
--
ALTER TABLE `empresa_estagio`
  ADD PRIMARY KEY (`id_empresa_estagio`),
  ADD KEY `fk_id_empresa` (`id_empresa`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aluno_empresa_status`
--
ALTER TABLE `aluno_empresa_status`
  MODIFY `id_aluno_empresa_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `empresa_estagio`
--
ALTER TABLE `empresa_estagio`
  MODIFY `id_empresa_estagio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `aluno_empresa_status`
--
ALTER TABLE `aluno_empresa_status`
  ADD CONSTRAINT `fk_id_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_empresa_estagio` FOREIGN KEY (`id_empresa_estagio`) REFERENCES `empresa_estagio` (`id_empresa_estagio`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_status` FOREIGN KEY (`id_status`) REFERENCES `estatus` (`id_status`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `empresa_estagio`
--
ALTER TABLE `empresa_estagio`
  ADD CONSTRAINT `fk_id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
