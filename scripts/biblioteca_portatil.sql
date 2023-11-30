-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Nov-2023 às 19:29
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca_portatil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT 'identificador de comentário ',
  `texto` varchar(30) NOT NULL COMMENT 'texto ',
  `usuario_id` bigint(10) UNSIGNED NOT NULL COMMENT 'identificador do usuário',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'data de criação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela de comentário';

--
-- Extraindo dados da tabela `comentario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT 'Identificador do livro',
  `titulo` varchar(100) NOT NULL COMMENT 'Titulo do livro',
  `imagem` varchar(100) NOT NULL COMMENT 'Imagem',
  `usuario_id` bigint(10) UNSIGNED NOT NULL COMMENT 'Usuário id',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data de criação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela de livros';

--
-- Extraindo dados da tabela `livro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT 'Identificador do usuário',
  `nome` varchar(100) NOT NULL COMMENT 'Nome do usuário',
  `email` varchar(80) NOT NULL COMMENT 'Email',
  `foto` varchar(100) NOT NULL COMMENT 'foto do usuario',
  `senha` varchar(2000) NOT NULL COMMENT 'Senha',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data de criação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela usuários ';

--
-- Extraindo dados da tabela `usuario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_livros`
--

CREATE TABLE `usuario_livros` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT 'id dos livros do usuário',
  `usuario_id` bigint(10) UNSIGNED NOT NULL COMMENT 'id do usuário',
  `livro_id` bigint(10) UNSIGNED NOT NULL COMMENT 'id do livro',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data de criação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Livros que o usuário possuí';

--
-- Extraindo dados da tabela `usuario_livros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_livros_desejados`
--

CREATE TABLE `usuario_livros_desejados` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT 'id dos livros do usuário',
  `usuario_id` bigint(10) UNSIGNED NOT NULL COMMENT 'id do usuário',
  `livro_id` bigint(10) UNSIGNED NOT NULL COMMENT 'id do livro',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data de criação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Livros que o usuário deseja comprar';

--
-- Extraindo dados da tabela `usuario_livros_desejados`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_usuario` (`usuario_id`);

--
-- Índices para tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livro_usuario` (`usuario_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `usuario_livros`
--
ALTER TABLE `usuario_livros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`livro_id`),
  ADD KEY `usuario_livros_fk` (`livro_id`);

--
-- Índices para tabela `usuario_livros_desejados`
--
ALTER TABLE `usuario_livros_desejados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`livro_id`),
  ADD KEY `usuario_livros_desejados_fk` (`livro_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'identificador de comentário ', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador do livro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador do usuário', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuario_livros`
--
ALTER TABLE `usuario_livros`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id dos livros do usuário', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuario_livros_desejados`
--
ALTER TABLE `usuario_livros_desejados`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id dos livros do usuário', AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_livros`
--
ALTER TABLE `usuario_livros`
  ADD CONSTRAINT `usuario_livros_fk` FOREIGN KEY (`livro_id`) REFERENCES `livro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_livros_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_livros_desejados`
--
ALTER TABLE `usuario_livros_desejados`
  ADD CONSTRAINT `usuario_livros_desejados_fk` FOREIGN KEY (`livro_id`) REFERENCES `livro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_livros_desejados_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
