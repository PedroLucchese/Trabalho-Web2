-- db_loja.uf definition

CREATE TABLE `uf` (
  `ID_UF` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID UNIDADE FEDERATIVA',
  `UF` varchar(2) NOT NULL COMMENT 'UF ABREVIADO',
  `UF_DESC` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='CADASTRO DE UNIDADE FEDERATIVA';


-- db_loja.cidades definition

CREATE TABLE `cidades` (
  `ID_CIDADE` int(3) NOT NULL AUTO_INCREMENT,
  `DESC_CIDADE` varchar(25) NOT NULL,
  `ID_UF` int(2) NOT NULL,
  PRIMARY KEY (`ID_CIDADE`),
  KEY `cidades_FK` (`ID_UF`),
  CONSTRAINT `cidades_FK` FOREIGN KEY (`ID_UF`) REFERENCES `uf` (`ID_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- db_loja.endereco definition

CREATE TABLE `endereco` (
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
  KEY `endereco_uf_fk` (`ID_UF`),
  CONSTRAINT `endereco_cidade_fk` FOREIGN KEY (`ID_CIDADE`) REFERENCES `cidades` (`ID_CIDADE`),
  CONSTRAINT `endereco_uf_fk` FOREIGN KEY (`ID_UF`) REFERENCES `uf` (`ID_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE ENDEREÇOS DE CLIENTES';


-- db_loja.fornecedor definition

CREATE TABLE `fornecedor` (
  `ID_FORNECEDOR` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID FORNECEDOR',
  `DESCRICAO` varchar(50) NOT NULL COMMENT 'NOME / DESCRICAO',
  `TELEFONE` varchar(11) NOT NULL COMMENT 'TELEFONE',
  `EMAIL` varchar(25) NOT NULL COMMENT 'EMAIL',
  `ID_ENDERECO` int(4) NOT NULL COMMENT 'ID_ENDERECO TABELA DE ENDERECOS',
  PRIMARY KEY (`ID_FORNECEDOR`),
  KEY `FORNECEDOR_ENDERECO_FK` (`ID_ENDERECO`),
  CONSTRAINT `FORNECEDOR_ENDERECO_FK` FOREIGN KEY (`ID_ENDERECO`) REFERENCES `endereco` (`ID_ENDERECO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE FORNECEDORES';


-- db_loja.produto definition

CREATE TABLE `produto` (
  `ID_PRODUTO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID PRODUTO',
  `PRODUTO_DESCRICAO` varchar(50) NOT NULL COMMENT 'DESCRICAO DO PRODUTO',
  `FOTO` bit(1) NOT NULL,
  `ID_FORNECEDOR` int(4) NOT NULL COMMENT 'ID DO FORNECEDOR TABELA DE FORNECEDORES',
  PRIMARY KEY (`ID_PRODUTO`),
  KEY `PRODUTO_FORNECEDOR_FK` (`ID_FORNECEDOR`),
  CONSTRAINT `PRODUTO_FORNECEDOR_FK` FOREIGN KEY (`ID_FORNECEDOR`) REFERENCES `fornecedor` (`ID_FORNECEDOR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- db_loja.cliente definition

CREATE TABLE `cliente` (
  `ID_USUARIO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID USUARIO',
  `NOME` varchar(50) NOT NULL COMMENT 'NOME CLIENTE',
  `EMAIL` varchar(30) NOT NULL COMMENT 'EMAIL CADASTRO CLIENTE',
  `TELEFONE` varchar(11) NOT NULL COMMENT 'TELEFONE CLIENTE',
  `CARTAO_CREDITO` varchar(16) NOT NULL COMMENT 'NUMERO CARTÃO CLIENTE',
  `TIPO_USUARIO` int(1) NOT NULL COMMENT 'TIPO USUARIO (1 - CLIENTE) (2 - ADMINISTRADOR)',
  `ID_ENDERECO` int(4) NOT NULL,
  `SENHA` varchar(50) NOT NULL COMMENT 'Senha do cadastro',
  PRIMARY KEY (`ID_USUARIO`),
  KEY `cliente_FK` (`ID_ENDERECO`),
  CONSTRAINT `cliente_FK` FOREIGN KEY (`ID_ENDERECO`) REFERENCES `endereco` (`ID_ENDERECO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE CADASTRO DE CLIENTES E USUÁRIOS';


-- db_loja.estoque definition

CREATE TABLE `estoque` (
  `ID_PRODUTO` int(4) NOT NULL COMMENT 'ID PRODUTO TABELA PRODUTOS',
  `QUANTIDADE` decimal(10,0) NOT NULL COMMENT 'QUANTIDADE',
  `PREÇO` decimal(10,0) NOT NULL COMMENT 'PREÇO',
  KEY `PRODUTO_ESTOQUE_FK` (`ID_PRODUTO`),
  CONSTRAINT `PRODUTO_ESTOQUE_FK` FOREIGN KEY (`ID_PRODUTO`) REFERENCES `produto` (`ID_PRODUTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de estoques';


-- db_loja.pedido definition

CREATE TABLE `pedido` (
  `ID_PEDIDO` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID PEDIDO',
  `ID_USUARIO` int(4) NOT NULL COMMENT 'ID CLIENTE TABELA DE CLIENTES',
  `DATA_EMISSAO` date NOT NULL COMMENT 'DATA EMISSAO PEDIDO',
  `DATA_ENTREGA` date NOT NULL COMMENT 'DATA EMISSAO PEDIDO',
  `SITUACAO` decimal(1,0) NOT NULL COMMENT 'SITUACAO PEDIDO (1 - PENDENTE , 2 - ENVIADO , 3 - CANCELADO )',
  PRIMARY KEY (`ID_PEDIDO`),
  KEY `PEDIDO_CLIENTE_FK` (`ID_USUARIO`),
  CONSTRAINT `PEDIDO_CLIENTE_FK` FOREIGN KEY (`ID_USUARIO`) REFERENCES `cliente` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- db_loja.item_pedido definition

CREATE TABLE `item_pedido` (
  `ID_PRODUTO` int(4) NOT NULL COMMENT 'ID PRODUTO TABELA DE PRODUTOS',
  `ID_PEDIDO` int(4) NOT NULL COMMENT 'ID_PEDIDO TABELA DE PEDIDOS',
  `QUANTIDADE` decimal(10,0) NOT NULL COMMENT 'QUANTIDADE',
  `PREÇO` decimal(10,0) NOT NULL,
  KEY `ITEMPEDIDO_PRODUTO_FK` (`ID_PRODUTO`),
  KEY `ITEMPEDIDO_PEDIDO_FK` (`ID_PEDIDO`),
  CONSTRAINT `ITEMPEDIDO_PEDIDO_FK` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedido` (`ID_PEDIDO`),
  CONSTRAINT `ITEMPEDIDO_PRODUTO_FK` FOREIGN KEY (`ID_PRODUTO`) REFERENCES `produto` (`ID_PRODUTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABELA DE ITENS DO PEDIDO';