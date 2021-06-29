-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29-Jun-2021 às 16:52
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_loja`
--
CREATE DATABASE IF NOT EXISTS `db_loja` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_loja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

DROP TABLE IF EXISTS `cidades`;
CREATE TABLE IF NOT EXISTS `cidades` (
  `ID_CIDADE` int(3) NOT NULL AUTO_INCREMENT,
  `NOME_CIDADE` varchar(25) NOT NULL,
  `ID_UF` int(2) NOT NULL,
  PRIMARY KEY (`ID_CIDADE`),
  KEY `cidades_FK` (`ID_UF`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `ID_ENDERECO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID ENDERECO',
  `RUA` varchar(100) NOT NULL COMMENT 'RUA',
  `NUMERO` int(6) NOT NULL COMMENT 'NUMERO RESIDENCIA',
  `COMPLEMENTO` varchar(100) DEFAULT NULL COMMENT 'COMPLEMENTO ENDEREÇO',
  `BAIRRO` varchar(50) NOT NULL COMMENT 'BAIRRO ENDEREÇO',
  `CEP` varchar(8) NOT NULL COMMENT 'CEP ENDEREÇO',
  `ID_CIDADE` int(6) NOT NULL COMMENT 'COD_CIDADE TABELA DE CIDADES',
  `ID_UF` int(2) NOT NULL COMMENT 'COD_UF TABELA DE UF',
  PRIMARY KEY (`ID_ENDERECO`),
  KEY `endereco_cidade_fk` (`ID_CIDADE`),
  KEY `endereco_uf_fk` (`ID_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE ENDEREÇOS DE CLIENTES';

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `idProduto` bigint(20) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` double NOT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`idProduto`, `quantidade`, `preco`) VALUES
(1, 20, 40),
(2, 3, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `ID_FORNECEDOR` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID FORNECEDOR',
  `NOME` varchar(50) NOT NULL,
  `DESCRICAO` varchar(50) NOT NULL COMMENT 'NOME / DESCRICAO',
  `TELEFONE` varchar(11) NOT NULL COMMENT 'TELEFONE',
  `EMAIL` varchar(80) NOT NULL COMMENT 'EMAIL',
  PRIMARY KEY (`ID_FORNECEDOR`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='TABELA DE FORNECEDORES';

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`ID_FORNECEDOR`, `NOME`, `DESCRICAO`, `TELEFONE`, `EMAIL`) VALUES
(12, 'Amazon', 'E-commerce', '54999507127', 'pedro130300@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

DROP TABLE IF EXISTS `item_pedido`;
CREATE TABLE IF NOT EXISTS `item_pedido` (
  `ID_PRODUTO` int(4) NOT NULL COMMENT 'ID PRODUTO TABELA DE PRODUTOS',
  `ID_PEDIDO` int(4) NOT NULL COMMENT 'ID_PEDIDO TABELA DE PEDIDOS',
  `QUANTIDADE` int(11) NOT NULL COMMENT 'QUANTIDADE',
  `PRECO` float NOT NULL,
  KEY `ITEMPEDIDO_PRODUTO_FK` (`ID_PRODUTO`),
  KEY `ITEMPEDIDO_PEDIDO_FK` (`ID_PEDIDO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE ITENS DO PEDIDO';

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`ID_PRODUTO`, `ID_PEDIDO`, `QUANTIDADE`, `PRECO`) VALUES
(2, 1, 2, 40),
(1, 1, 10, 400),
(2, 1, 2, 40),
(2, 1, 1, 20),
(2, 1, 1, 20),
(2, 2, 1, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `numero` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID PEDIDO',
  `ID_USUARIO` int(4) NOT NULL COMMENT 'ID CLIENTE TABELA DE CLIENTES',
  `DATA_EMISSAO` date NOT NULL COMMENT 'DATA EMISSAO PEDIDO',
  `DATA_ENTREGA` date NOT NULL COMMENT 'DATA EMISSAO PEDIDO',
  `SITUACAO` varchar(20) NOT NULL COMMENT 'SITUACAO PEDIDO (1 - PENDENTE , 2 - ENVIADO , 3 - CANCELADO )',
  PRIMARY KEY (`numero`),
  KEY `PEDIDO_CLIENTE_FK` (`numero`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`numero`, `ID_USUARIO`, `DATA_EMISSAO`, `DATA_ENTREGA`, `SITUACAO`) VALUES
(1, 1, '2021-06-29', '2021-07-29', 'Novo'),
(2, 1, '2021-06-29', '2021-07-29', 'Novo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `ID_PRODUTO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID PRODUTO',
  `ID_FORNECEDOR` int(4) DEFAULT NULL COMMENT 'ID DO FORNECEDOR TABELA DE FORNECEDORES',
  `COD_PRODUTO` int(4) NOT NULL,
  `PRODUTO_DESCRICAO` varchar(50) NOT NULL COMMENT 'DESCRICAO DO PRODUTO',
  `NOME` varchar(100) NOT NULL COMMENT 'Nome do Produto',
  `imagem` varchar(300) NOT NULL,
  PRIMARY KEY (`ID_PRODUTO`),
  UNIQUE KEY `COD_PRODUTO` (`COD_PRODUTO`),
  KEY `PRODUTO_FORNECEDOR_FK` (`ID_FORNECEDOR`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`ID_PRODUTO`, `ID_FORNECEDOR`, `COD_PRODUTO`, `PRODUTO_DESCRICAO`, `NOME`, `imagem`) VALUES
(1, 12, 1234, 'Cadeira preta', 'Cadeira', '../uploads/Rhino.png'),
(2, 12, 1088, 'Chaveiro dos Guri', 'Chaveiro', '../uploads/1283728.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

DROP TABLE IF EXISTS `uf`;
CREATE TABLE IF NOT EXISTS `uf` (
  `ID_UF` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID UNIDADE FEDERATIVA',
  `UF` varchar(2) NOT NULL COMMENT 'UF ABREVIADO',
  `UF_NOME` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='CADASTRO DE UNIDADE FEDERATIVA';

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID USUARIO',
  `NOME` varchar(50) NOT NULL COMMENT 'NOME CLIENTE',
  `EMAIL` varchar(30) NOT NULL COMMENT 'EMAIL CADASTRO CLIENTE',
  `TELEFONE` varchar(11) NOT NULL COMMENT 'TELEFONE CLIENTE',
  `SENHA` varchar(50) NOT NULL COMMENT 'Senha do cadastro',
  `TIPO_USUARIO` int(1) NOT NULL COMMENT 'TIPO USUARIO (1 - CLIENTE) (2 - ADMINISTRADOR)',
  `NUM_CARTAO_CREDITO` varchar(16) NOT NULL COMMENT 'NUMERO CARTÃO CLIENTE',
  `CVV_CARTAO` int(3) NOT NULL COMMENT 'Codigo Verificador Cartão',
  `NOME_TITULAR_CARTAO` varchar(100) NOT NULL,
  `DATA_VENCIMENTO_CARTAO` date NOT NULL COMMENT 'Data de vencimento cartão',
  `CPF` varchar(11) NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='TABELA DE CADASTRO DE CLIENTES E USUÁRIOS';

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `NOME`, `EMAIL`, `TELEFONE`, `SENHA`, `TIPO_USUARIO`, `NUM_CARTAO_CREDITO`, `CVV_CARTAO`, `NOME_TITULAR_CARTAO`, `DATA_VENCIMENTO_CARTAO`, `CPF`) VALUES
(1, 'Pedro Henrique Lucchese', 'pedro130300@gmail.com', '54999507127', 'senha', 2, '0000111122223333', 123, 'Pedro Henrique Lucchese', '2021-06-24', '04984717050');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `PRODUTO_FORNECEDOR_FK` FOREIGN KEY (`ID_FORNECEDOR`) REFERENCES `fornecedor` (`ID_FORNECEDOR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
