-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28-Abr-2021 às 01:46
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `ID_PRODUTO` int(4) NOT NULL COMMENT 'ID PRODUTO TABELA PRODUTOS',
  `QUANTIDADE` float NOT NULL COMMENT 'QUANTIDADE',
  `PREÇO` float NOT NULL COMMENT 'PREÇO',
  KEY `PRODUTO_ESTOQUE_FK` (`ID_PRODUTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de estoques';

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='TABELA DE FORNECEDORES';

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`ID_FORNECEDOR`, `NOME`, `DESCRICAO`, `TELEFONE`, `EMAIL`) VALUES
(6, 'Pedro Henrique Lucchese', 'Fornecedor admin', '54999507127', 'pedro130300@gmail.com'),
(8, 'Alexandre Lucchese', 'Fornecedor admin', '54999974761', 'alexandre.lucchese7@gmail.com'),
(9, 'Casas bahia', 'Fornecedor de mÃ³veis', '54999507127', 'pedro130300@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

DROP TABLE IF EXISTS `item_pedido`;
CREATE TABLE IF NOT EXISTS `item_pedido` (
  `ID_PRODUTO` int(4) NOT NULL COMMENT 'ID PRODUTO TABELA DE PRODUTOS',
  `ID_PEDIDO` int(4) NOT NULL COMMENT 'ID_PEDIDO TABELA DE PEDIDOS',
  `QUANTIDADE` float NOT NULL COMMENT 'QUANTIDADE',
  `PREÇO` float NOT NULL,
  KEY `ITEMPEDIDO_PRODUTO_FK` (`ID_PRODUTO`),
  KEY `ITEMPEDIDO_PEDIDO_FK` (`ID_PEDIDO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE ITENS DO PEDIDO';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `ID_PEDIDO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID PEDIDO',
  `ID_USUARIO` int(4) NOT NULL COMMENT 'ID CLIENTE TABELA DE CLIENTES',
  `DATA_EMISSAO` date NOT NULL COMMENT 'DATA EMISSAO PEDIDO',
  `DATA_ENTREGA` date NOT NULL COMMENT 'DATA EMISSAO PEDIDO',
  `SITUACAO` int(11) NOT NULL COMMENT 'SITUACAO PEDIDO (1 - PENDENTE , 2 - ENVIADO , 3 - CANCELADO )',
  PRIMARY KEY (`ID_PEDIDO`),
  KEY `PEDIDO_CLIENTE_FK` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`ID_PRODUTO`),
  UNIQUE KEY `COD_PRODUTO` (`COD_PRODUTO`),
  KEY `PRODUTO_FORNECEDOR_FK` (`ID_FORNECEDOR`)
) ENGINE=InnoDB AUTO_INCREMENT=1016 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`ID_PRODUTO`, `ID_FORNECEDOR`, `COD_PRODUTO`, `PRODUTO_DESCRICAO`, `NOME`) VALUES
(1014, 8, 1, 'Cadeira preta', 'Cadeira');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='TABELA DE CADASTRO DE CLIENTES E USUÁRIOS';

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `NOME`, `EMAIL`, `TELEFONE`, `SENHA`, `TIPO_USUARIO`, `NUM_CARTAO_CREDITO`, `CVV_CARTAO`, `NOME_TITULAR_CARTAO`, `DATA_VENCIMENTO_CARTAO`, `CPF`) VALUES
(6, 'Pedro Henrique Lucchese', 'pedro130300@gmail.com', '54999507127', 'senha', 1, '0000111122223333', 123, 'Pedro Henrique Lucchese', '2021-04-21', '04984717050');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `cidades_FK` FOREIGN KEY (`ID_UF`) REFERENCES `uf` (`ID_UF`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_cidade_fk` FOREIGN KEY (`ID_CIDADE`) REFERENCES `cidades` (`ID_CIDADE`),
  ADD CONSTRAINT `endereco_uf_fk` FOREIGN KEY (`ID_UF`) REFERENCES `uf` (`ID_UF`);

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `PRODUTO_ESTOQUE_FK` FOREIGN KEY (`ID_PRODUTO`) REFERENCES `produto` (`ID_PRODUTO`);

--
-- Limitadores para a tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `ITEMPEDIDO_PEDIDO_FK` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedido` (`ID_PEDIDO`),
  ADD CONSTRAINT `ITEMPEDIDO_PRODUTO_FK` FOREIGN KEY (`ID_PRODUTO`) REFERENCES `produto` (`ID_PRODUTO`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `PEDIDO_CLIENTE_FK` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `PRODUTO_FORNECEDOR_FK` FOREIGN KEY (`ID_FORNECEDOR`) REFERENCES `fornecedor` (`ID_FORNECEDOR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
