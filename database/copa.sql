-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Mar-2021 às 02:34
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `copa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `his`
--

CREATE TABLE `his` (
  `idhis` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `date` date NOT NULL,
  `evento` varchar(250) NOT NULL COMMENT '-Descricao do que o usuario fez'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patente`
--

CREATE TABLE `patente` (
  `idPatente` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `idtipo` int(11) NOT NULL,
  `situacao` int(11) NOT NULL COMMENT '1 invencao/pendente, 2 - patente/aprovado, 3 - revogada',
  `descricao` varchar(1000) NOT NULL COMMENT '-esse campo deve especificar a patente, de forma tecnica, clara e objetiva.',
  `dtaprovacao` date DEFAULT NULL,
  `dtfim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patenteajuste`
--

CREATE TABLE `patenteajuste` (
  `idpatente` int(11) NOT NULL,
  `idUsuarioSolicitacao` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `dtsolicitacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patenteproprietario`
--

CREATE TABLE `patenteproprietario` (
  `idpatenteproprietario` int(11) NOT NULL,
  `idpatente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `dtini` date NOT NULL,
  `dtfim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patentesolicitacao`
--

CREATE TABLE `patentesolicitacao` (
  `idsolicitacao` int(11) NOT NULL,
  `idpatente` int(11) NOT NULL,
  `idgruporecebimento` int(11) NOT NULL,
  `dtsolicitacao` date NOT NULL,
  `status` int(45) NOT NULL COMMENT '1 - pendente, 2 - concluida, 3 - cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `senhas`
--

CREATE TABLE `senhas` (
  `idsenhas` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `dtini` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 - Atual\n2 - Antiga'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `idtipo` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cpfcnpj` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `Sobrenome` varchar(200) DEFAULT NULL,
  `dataini` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 - Ativo, 2 - Exclusao logica',
  `idGrupo` int(11) NOT NULL COMMENT '-Tipo de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Índices para tabela `his`
--
ALTER TABLE `his`
  ADD PRIMARY KEY (`idhis`),
  ADD KEY `fk_usuario_idx` (`idUsuario`);

--
-- Índices para tabela `patente`
--
ALTER TABLE `patente`
  ADD PRIMARY KEY (`idPatente`),
  ADD KEY `fk_tipo_idx` (`idtipo`);

--
-- Índices para tabela `patenteajuste`
--
ALTER TABLE `patenteajuste`
  ADD PRIMARY KEY (`idpatente`),
  ADD KEY `fk_ajuste_user_idx` (`idUsuarioSolicitacao`);

--
-- Índices para tabela `patenteproprietario`
--
ALTER TABLE `patenteproprietario`
  ADD PRIMARY KEY (`idpatenteproprietario`),
  ADD KEY `fk_user_idx` (`idusuario`),
  ADD KEY `fk_patente_idx` (`idpatente`);

--
-- Índices para tabela `patentesolicitacao`
--
ALTER TABLE `patentesolicitacao`
  ADD PRIMARY KEY (`idsolicitacao`),
  ADD KEY `fk_patente_solicitacao` (`idpatente`),
  ADD KEY `fk_grupo_solicitacao_idx` (`idgruporecebimento`);

--
-- Índices para tabela `senhas`
--
ALTER TABLE `senhas`
  ADD PRIMARY KEY (`idsenhas`),
  ADD KEY `fk_usersenha_idx` (`idUsuario`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idtipo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `cpfcnpj_UNIQUE` (`cpfcnpj`),
  ADD KEY `fk_grupo_idx` (`idGrupo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `his`
--
ALTER TABLE `his`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `patente`
--
ALTER TABLE `patente`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`idtipo`) REFERENCES `tipo` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `patenteajuste`
--
ALTER TABLE `patenteajuste`
  ADD CONSTRAINT `fk_ajuste_user` FOREIGN KEY (`idUsuarioSolicitacao`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `patenteproprietario`
--
ALTER TABLE `patenteproprietario`
  ADD CONSTRAINT `fk_patente` FOREIGN KEY (`idpatente`) REFERENCES `patente` (`idPatente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `patentesolicitacao`
--
ALTER TABLE `patentesolicitacao`
  ADD CONSTRAINT `fk_grupo_solicitacao` FOREIGN KEY (`idgruporecebimento`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patente_solicitacao` FOREIGN KEY (`idpatente`) REFERENCES `patente` (`idPatente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `senhas`
--
ALTER TABLE `senhas`
  ADD CONSTRAINT `fk_usersenha` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
