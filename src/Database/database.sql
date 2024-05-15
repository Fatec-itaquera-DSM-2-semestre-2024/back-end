drop database if exists `fatec`;
create database `fatec`;
use `fatec`; 
--
-- Table structure for table `codigo`
--

DROP TABLE IF EXISTS `codigo`;
CREATE TABLE `codigo` (
  `idtoken` int NOT NULL AUTO_INCREMENT,
  `email` varchar(145) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `expira` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idtoken`)
);


--
-- Table structure for table `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE `perfis` (
  `id` char(40) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ;


--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` char(40) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `perfil` varchar(55) DEFAULT NULL,
  `ativo` int DEFAULT '1',
  `twofactor` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ;
--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE `permissoes` (
  `id` char(40) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ;

--
-- Table structure for table `perfilpermissoes`
--

DROP TABLE IF EXISTS `perfilpermissoes`;
CREATE TABLE `perfilpermissoes` (
  `perfilid` char(40) NOT NULL,
  `permissao_id` char(40) NOT NULL,
  PRIMARY KEY (`perfilid`,`permissao_id`),
  KEY `fk_permss_idx` (`permissao_id`),
  CONSTRAINT `fk_perfil_perm` FOREIGN KEY (`perfilid`) REFERENCES `perfis` (`id`),
  CONSTRAINT `fk_permss` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`)
) ;

select * from usuarios;
select * from perfis;
insert into usuarios values (1, 'daniel', 'daniel@gmail.com', '123', 'comum', 1, 0);