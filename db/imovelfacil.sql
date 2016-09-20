-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: marambaia2
-- Source Schemata: marambaia2
-- Created: Mon Dec  8 14:24:53 2014
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;;

-- ----------------------------------------------------------------------------
-- Schema marambaia2
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `marambaia2` ;
CREATE SCHEMA IF NOT EXISTS `marambaia2` ;

-- ----------------------------------------------------------------------------
-- Table marambaia2.arquivos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`arquivos` (
  `id_arquivo` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pagina` INT(10) UNSIGNED NOT NULL,
  `id_conteudo` INT(10) UNSIGNED NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `tipo` VARCHAR(10) NOT NULL,
  `extensao` VARCHAR(5) NULL DEFAULT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `principal` TINYINT(1) NULL DEFAULT '0',
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_arquivo`),
  INDEX `fk_arquivos_paginas1_idx` (`id_pagina` ASC),
  INDEX `fk_arquivos_conteudos1_idx` (`id_conteudo` ASC),
  CONSTRAINT `fk_arquivos_conteudos1`
    FOREIGN KEY (`id_conteudo`)
    REFERENCES `marambaia2`.`conteudos` (`id_conteudo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_arquivos_paginas1`
    FOREIGN KEY (`id_pagina`)
    REFERENCES `marambaia2`.`paginas` (`id_pagina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 27
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.conteudos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`conteudos` (
  `id_conteudo` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categoria` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_tipo` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_tag` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_localidade` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `autor` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT(1) NOT NULL,
  `bairro` VARCHAR(255) NULL DEFAULT NULL,
  `ordem` INT(10) NULL DEFAULT NULL,
  `quartos` INT(10) NULL DEFAULT '0',
  `banheiros` INT(10) NULL DEFAULT '0',
  `suites` INT(10) NULL DEFAULT '0',
  `garagem` INT(10) NULL DEFAULT '0',
  `area_construida` DECIMAL(10,2) NULL DEFAULT '0.00',
  `area_total` DECIMAL(10,2) NULL DEFAULT '0.00',
  `iptu` DECIMAL(10,2) NULL DEFAULT '0.00',
  `preco` DECIMAL(10,2) NULL DEFAULT '0.00',
  `condominio` DECIMAL(10,2) NULL DEFAULT '0.00',
  `destaque` TINYINT(1) NOT NULL DEFAULT '0',
  `ano` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id_conteudo`),
  INDEX `fk_conteudos_categorias1_idx` (`id_categoria` ASC),
  INDEX `fk_conteudos_tipos1_idx` (`id_tipo` ASC),
  INDEX `fk_conteudos_tags1_idx` (`id_tag` ASC),
  INDEX `fk_conteudos_localidades1_idx` (`id_localidade` ASC),
  CONSTRAINT `fk_conteudos_categorias1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `marambaia2`.`categorias` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudos_localidades1`
    FOREIGN KEY (`id_localidade`)
    REFERENCES `marambaia2`.`localidades` (`id_localidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudos_tags1`
    FOREIGN KEY (`id_tag`)
    REFERENCES `marambaia2`.`tags` (`id_tag`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudos_tipos1`
    FOREIGN KEY (`id_tipo`)
    REFERENCES `marambaia2`.`tipos` (`id_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.paginas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`paginas` (
  `id_pagina` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) UNSIGNED NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `nivel_exibicao` TINYINT(1) NOT NULL COMMENT '1 - Menu destaques\n2 - Menu principal\n3 - Menu lateral\n4 - Submenu\n5 - Nenhum',
  `status` TINYINT(1) NOT NULL,
  `filho_de` INT(10) NOT NULL DEFAULT '0',
  `ordem` INT(10) NOT NULL DEFAULT '0',
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pagina`),
  UNIQUE INDEX `id_paginas_UNIQUE` (`id_pagina` ASC),
  INDEX `fk_paginas_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_paginas_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `marambaia2`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 29
DEFAULT CHARACTER SET = utf8
COMMENT = 'Tabela de Páginas';

-- ----------------------------------------------------------------------------
-- Table marambaia2.caracteristicas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`caracteristicas` (
  `id_caracteristica` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_conteudo` INT(10) UNSIGNED NOT NULL,
  `nome` TEXT NOT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_caracteristica`),
  INDEX `fk_caracteristicas_conteudos1_idx` (`id_conteudo` ASC),
  CONSTRAINT `fk_caracteristicas_conteudos1`
    FOREIGN KEY (`id_conteudo`)
    REFERENCES `marambaia2`.`conteudos` (`id_conteudo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.categorias
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`categorias` (
  `id_categoria` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.ci_sessions
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT '0',
  `ip_address` VARCHAR(16) NOT NULL DEFAULT '0',
  `user_agent` VARCHAR(254) NOT NULL,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`session_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.cidades
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`cidades` (
  `id_cidade` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_estado` INT(10) UNSIGNED NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  INDEX `fk_cidades_estados1_idx` (`id_estado` ASC),
  CONSTRAINT `fk_cidades_estados1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `marambaia2`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.estados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`estados` (
  `id_estado` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uf` VARCHAR(2) NULL DEFAULT NULL,
  `nome` VARCHAR(75) NOT NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.contato_usuarios
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`contato_usuarios` (
  `id_contato_usuario` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) UNSIGNED NOT NULL,
  `tel_principal` VARCHAR(15) NULL DEFAULT NULL,
  `tel_celular` VARCHAR(15) NULL DEFAULT NULL,
  `tel_comercial` VARCHAR(15) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `url` VARCHAR(100) NULL DEFAULT NULL,
  `tel_contato` VARCHAR(100) NULL DEFAULT NULL,
  `nome_contato` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_contato_usuario`),
  INDEX `fk_contato_usuario_usuarios_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_contato_usuario_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `marambaia2`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.usuarios
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`usuarios` (
  `id_usuario` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  `nome` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Nome do usuário || Razão Social',
  `sobrenome` VARCHAR(255) NULL DEFAULT NULL,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(1) NOT NULL COMMENT 'M = Masculino\nF = Feminino',
  `cpf_cnpj` VARCHAR(20) NOT NULL DEFAULT '000.000.000-00' COMMENT 'CPF || CNPJ',
  `id_ie` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Identidade || Inscrição Estadual',
  `data_nascimento` TIMESTAMP NULL DEFAULT NULL,
  `registrado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `chave_ativacao` VARCHAR(60) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.localidades
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`localidades` (
  `id_localidade` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_estado` INT(10) UNSIGNED NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_localidade`),
  INDEX `fk_localidades_estados1_idx` (`id_estado` ASC),
  CONSTRAINT `fk_localidades_estados1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `marambaia2`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.tags
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`tags` (
  `id_tag` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `data_alteracao` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tag`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.tipos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`tipos` (
  `id_tipo` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.depoimentos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`depoimentos` (
  `id_depoimento` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) UNSIGNED NOT NULL,
  `autor` VARCHAR(255) NULL DEFAULT NULL,
  `ordem` INT(10) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `texto` VARCHAR(255) NOT NULL,
  `status` TINYINT(4) NOT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_depoimento`),
  INDEX `fk_depoimentos_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_depoimentos_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `marambaia2`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.mensagens
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`mensagens` (
  `id_mensagem` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `telefone` VARCHAR(45) NULL DEFAULT NULL,
  `texto` TEXT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mensagem`))
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.opcoes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`opcoes` (
  `id_opcao` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) UNSIGNED NOT NULL,
  `nome` VARCHAR(64) NOT NULL,
  `valor` LONGTEXT NULL DEFAULT NULL,
  `ordem` INT(10) NULL DEFAULT NULL,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_opcao`),
  INDEX `fk_opcoes_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_opcoes_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `marambaia2`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table marambaia2.tipo_usuarios
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `marambaia2`.`tipo_usuarios` (
  `id_tipo_usuario` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) UNSIGNED NOT NULL,
  `nome` VARCHAR(15) NOT NULL COMMENT 'ADMIN\nCLIENTE\nEDITOR',
  `descrição` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`, `id_usuario`),
  INDEX `fk_tipo_usuarios_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_tipo_usuarios_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `marambaia2`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
SET FOREIGN_KEY_CHECKS = 1;;
