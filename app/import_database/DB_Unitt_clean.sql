/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.59-0ubuntu0.14.04.1 : Database - unitt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`unitt` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `unitt`;

/*Table structure for table `areas` */

DROP TABLE IF EXISTS `areas`;

CREATE TABLE `areas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pai` int(11) unsigned DEFAULT NULL,
  `titulo` varchar(255) DEFAULT 'Not defined',
  `subtitulo` varchar(255) NOT NULL DEFAULT 'Not defined',
  `descricao` varchar(255) NOT NULL DEFAULT 'Not defined',
  `icon` varchar(60) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) DEFAULT NULL,
  `excluido` int(11) NOT NULL DEFAULT '0',
  `excluido_em` datetime DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL,
  `order_by` int(11) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pai` (`id_pai`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `areas` */

insert  into `areas`(`id`,`id_pai`,`titulo`,`subtitulo`,`descricao`,`icon`,`controller`,`url`,`super_admin`,`ativo`,`excluido`,`excluido_em`,`excluido_por`,`order_by`,`criado_em`,`criado_por`,`editado_em`,`editado_por`) values (11,0,'Central Areas','Master','Not defined','icon-fire','','',0,1,0,NULL,NULL,0,'2016-02-22 00:00:00',1,'2016-02-22 17:34:24',NULL),(12,11,'Areas','Define as areas do sistema','Areas do sistema','icon-list','Areas','areas',0,1,0,NULL,NULL,0,'2016-02-22 00:00:00',1,'2017-07-11 17:01:47',NULL),(13,11,'Usuários','Lista todos os usuários do painel','Todos os usuários do painel','icon-users','Usuarios','usuarios',0,1,0,NULL,NULL,1,'2016-02-22 17:39:07',NULL,'2016-02-22 17:39:07',NULL),(14,11,'Grupos','Grupos Usuários','Grupos Usuários','icon-users','GruposUsuarios','grupos-usuarios',0,1,0,NULL,NULL,0,'2016-02-22 19:13:03',NULL,'2017-07-21 15:34:29',NULL);

/*Table structure for table `dbo_application_brands` */

DROP TABLE IF EXISTS `dbo_application_brands`;

CREATE TABLE `dbo_application_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bgroup` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `logo` varchar(255) DEFAULT NULL,
  `catalogo` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_brands` */

/*Table structure for table `dbo_application_brands_group` */

DROP TABLE IF EXISTS `dbo_application_brands_group`;

CREATE TABLE `dbo_application_brands_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `logo` varchar(255) DEFAULT NULL,
  `catalogo` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_brands_group` */

/*Table structure for table `dbo_application_category` */

DROP TABLE IF EXISTS `dbo_application_category`;

CREATE TABLE `dbo_application_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `logo` varchar(255) DEFAULT NULL,
  `catalogo` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_category` */

/*Table structure for table `dbo_application_channel` */

DROP TABLE IF EXISTS `dbo_application_channel`;

CREATE TABLE `dbo_application_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_menu` int(10) DEFAULT NULL,
  `id_catalogo` int(11) DEFAULT NULL,
  `id_content` int(10) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `structure_for` varchar(255) DEFAULT NULL,
  `structure_controller_route` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_url_target` varchar(50) DEFAULT NULL,
  `html_menu_body` text,
  `access` varchar(1000) DEFAULT NULL,
  `rule_access` varchar(1000) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `id_pai` int(11) DEFAULT NULL,
  `ref_channel_router` varchar(1) DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_channel` */

/*Table structure for table `dbo_application_channel_relationship` */

DROP TABLE IF EXISTS `dbo_application_channel_relationship`;

CREATE TABLE `dbo_application_channel_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pai` int(11) DEFAULT NULL,
  `id_filho` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_channel_relationship` */

/*Table structure for table `dbo_application_channel_structure` */

DROP TABLE IF EXISTS `dbo_application_channel_structure`;

CREATE TABLE `dbo_application_channel_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_channel_structure` */

/*Table structure for table `dbo_application_clientes` */

DROP TABLE IF EXISTS `dbo_application_clientes`;

CREATE TABLE `dbo_application_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `tipo_cadastro` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `cnpj` varchar(50) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `inscricao_estadual` varchar(50) DEFAULT NULL,
  `ofertas` int(1) DEFAULT NULL,
  `termos` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ativo` int(1) DEFAULT '0',
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_clientes` */

/*Table structure for table `dbo_application_content` */

DROP TABLE IF EXISTS `dbo_application_content`;

CREATE TABLE `dbo_application_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ref` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `title_content` varchar(255) DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `url_absolute` varchar(500) DEFAULT NULL,
  `busca` varchar(255) DEFAULT NULL,
  `metatitle` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `metakeyworks` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `metadescriptions` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `facebook_title` varchar(1000) DEFAULT NULL,
  `facebook_descriptions` varchar(1000) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image_content` varchar(255) DEFAULT NULL,
  `image_background` varchar(255) DEFAULT NULL,
  `image_ico` varchar(255) DEFAULT NULL,
  `review` varchar(2000) DEFAULT NULL,
  `content` text CHARACTER SET latin1,
  `tracking_ga` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `likeit` int(11) DEFAULT '0',
  `content_type` int(11) DEFAULT NULL,
  `content_section` varchar(80) DEFAULT NULL,
  `list_mode` int(1) DEFAULT '0',
  `next_page` varchar(150) DEFAULT NULL,
  `txt_button` varchar(150) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `publicated_at` datetime DEFAULT NULL COMMENT 'Data Publicação',
  `updated_at` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0' COMMENT 'Enable / Disable Content',
  PRIMARY KEY (`id`,`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_content` */

/*Table structure for table `dbo_application_content_addon` */

DROP TABLE IF EXISTS `dbo_application_content_addon`;

CREATE TABLE `dbo_application_content_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ref` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image_content` varchar(255) DEFAULT NULL,
  `image_background` varchar(255) DEFAULT NULL,
  `review` varchar(2000) DEFAULT NULL,
  `content` text CHARACTER SET latin1,
  `content_type` int(11) DEFAULT NULL,
  `content_section` varchar(80) DEFAULT NULL,
  `list_mode` int(1) DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `publicated_at` datetime DEFAULT NULL COMMENT 'Data Publicação',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0' COMMENT 'Enable / Disable Content',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_content_addon` */

/*Table structure for table `dbo_application_events` */

DROP TABLE IF EXISTS `dbo_application_events`;

CREATE TABLE `dbo_application_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id event',
  `id_to` int(11) DEFAULT NULL,
  `id_from` int(11) DEFAULT NULL,
  `name_from` varchar(255) DEFAULT NULL,
  `reference_token` varchar(100) DEFAULT NULL,
  `title_event` varchar(255) DEFAULT NULL,
  `date_event` datetime DEFAULT NULL,
  `date_ini` datetime DEFAULT NULL,
  `date_fim` datetime DEFAULT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `long` varchar(10) DEFAULT NULL,
  `latit` varchar(10) DEFAULT NULL,
  `type_event` int(11) DEFAULT NULL COMMENT 'Compromissoes e Financeiro',
  `recurrent` int(1) DEFAULT '0',
  `recurrent_period` varchar(50) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `obs` mediumtext,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_events` */

/*Table structure for table `dbo_application_faq` */

DROP TABLE IF EXISTS `dbo_application_faq`;

CREATE TABLE `dbo_application_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `answer` text,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_faq` */

/*Table structure for table `dbo_application_forms` */

DROP TABLE IF EXISTS `dbo_application_forms`;

CREATE TABLE `dbo_application_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_channel` int(11) DEFAULT NULL,
  `form_name` varchar(255) DEFAULT NULL,
  `form_description` varchar(255) DEFAULT NULL,
  `form_destinatario_nome` varchar(255) DEFAULT NULL,
  `form_destinatario_email` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_forms` */

insert  into `dbo_application_forms`(`id`,`id_channel`,`form_name`,`form_description`,`form_destinatario_nome`,`form_destinatario_email`,`created_at`,`___D_E_L_E_T_E_D___`) values (1,6,'FormContato',NULL,NULL,NULL,'2014-03-18 16:41:48',0);

/*Table structure for table `dbo_application_forms_itens` */

DROP TABLE IF EXISTS `dbo_application_forms_itens`;

CREATE TABLE `dbo_application_forms_itens` (
  `id_form_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `field_type` varchar(255) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_id` varchar(255) DEFAULT NULL,
  `field_class` varchar(255) DEFAULT NULL,
  `field_required` int(1) DEFAULT '0',
  `field_placeholder` varchar(255) DEFAULT NULL,
  `field_options_values` text,
  `intPosition` int(11) NOT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id_form_item`,`intPosition`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_forms_itens` */

insert  into `dbo_application_forms_itens`(`id_form_item`,`id_form`,`name`,`field_type`,`field_name`,`field_id`,`field_class`,`field_required`,`field_placeholder`,`field_options_values`,`intPosition`,`___D_E_L_E_T_E_D___`) values (1,1,'Nome','text','nome','nome',NULL,0,'Nome',NULL,1,0),(2,1,'E-mail','text','email','email',NULL,0,'E-mail',NULL,2,0),(3,1,'Telefone','text','telefone','telefone',NULL,0,'Telefone',NULL,3,0),(4,1,'Razão Social','text','razao','razao',NULL,1,'Informe a razão social',NULL,4,1),(5,1,'CNPJ','text','cnpj','cnpj',NULL,1,'Informe seu CNPJ',NULL,5,1),(6,1,'Inscrição Estadual','text','insc_est','insc_est',NULL,0,'Informe a Inscrição Estatudal',NULL,6,1),(7,1,'CEP','text','cep','cep',NULL,0,'Informe seu CEP',NULL,7,1),(8,1,'Endereço','text','endereco','endereco',NULL,0,'Informe seu Endereço',NULL,8,1),(9,1,'CPF','text','cpf','cpf',NULL,1,'Informe seu CPF',NULL,9,1),(10,1,'RG','text','rg','rg',NULL,0,'Informe seu RG',NULL,10,1),(11,1,'Bairro','text','bairro','bairro',NULL,0,'Informe seu Bairro',NULL,11,1),(12,1,'Cidade','text','cidade','cidade',NULL,0,'Informe sua Cidade',NULL,12,0),(13,1,'Estado','text','estado','estado',NULL,0,'Informe seu Estado',NULL,13,0),(14,1,'Assunto','select','assunto','assunto',NULL,0,'Informe o Assunto','{\"elogio\":\"Elogio\",\"critica\":\"Crítica\",\"orcamento\":\"Orçamento\"}',14,0),(15,1,'Data de Nascimento','text','data_nascimento','data_nascimento',NULL,0,'Informe seu Nascimento',NULL,15,1),(16,1,'Sexo','radio','sexo','sexo',NULL,0,'Informe o Sexo','{\"masculino\":masculino,\"feminino\":feminino}',16,1),(17,1,'Mensagem','textarea','mensagem','mensagem',NULL,0,'Informe a mensagem',NULL,17,0);

/*Table structure for table `dbo_application_gallery` */

DROP TABLE IF EXISTS `dbo_application_gallery`;

CREATE TABLE `dbo_application_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_channel` int(11) DEFAULT '0',
  `id_content` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `ano` varchar(10) DEFAULT NULL,
  `intPosition` int(11) DEFAULT NULL,
  `dt_publication` datetime DEFAULT NULL,
  `dt_update` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_gallery` */

/*Table structure for table `dbo_application_gallery_image` */

DROP TABLE IF EXISTS `dbo_application_gallery_image`;

CREATE TABLE `dbo_application_gallery_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gallery` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `legend` varchar(255) DEFAULT NULL,
  `cover` int(1) DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`,`id_gallery`),
  UNIQUE KEY `id_image_gallery` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_gallery_image` */

insert  into `dbo_application_gallery_image`(`id`,`id_gallery`,`image`,`image_path`,`legend`,`cover`,`published_at`,`___D_E_L_E_T_E_D___`) values (1,1,'_DSC0098.JPG','uploads/gallery/1/',NULL,0,NULL,0),(2,1,'_DSC0102.JPG','uploads/gallery/1/',NULL,0,NULL,0),(3,1,'_DSC0256.JPG','uploads/gallery/1/',NULL,0,NULL,0),(4,1,'_DSC0280.JPG','uploads/gallery/1/',NULL,0,NULL,0),(5,1,'_DSC0304.JPG','uploads/gallery/1/',NULL,0,NULL,0),(6,1,'_DSC0328.JPG','uploads/gallery/1/',NULL,1,NULL,0);

/*Table structure for table `dbo_application_hottopics` */

DROP TABLE IF EXISTS `dbo_application_hottopics`;

CREATE TABLE `dbo_application_hottopics` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `order` int(2) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `excerpt` varchar(256) DEFAULT NULL,
  `description` text,
  `insert` datetime NOT NULL,
  `update` datetime DEFAULT NULL,
  `highlight` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `del` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_hot_topics_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_hottopics` */

/*Table structure for table `dbo_application_log` */

DROP TABLE IF EXISTS `dbo_application_log`;

CREATE TABLE `dbo_application_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_access` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `ip_address` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `when` datetime DEFAULT NULL,
  `token_data` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `token_authenticated` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_log` */

/*Table structure for table `dbo_application_midia` */

DROP TABLE IF EXISTS `dbo_application_midia`;

CREATE TABLE `dbo_application_midia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `title` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `metatitle` varchar(255) DEFAULT NULL,
  `metakeyworks` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `metadescriptions` varchar(500) DEFAULT NULL,
  `slug` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `image_cover` varchar(255) DEFAULT NULL,
  `excerpt` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `position` int(11) DEFAULT NULL,
  `tag_search` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `insert` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `del` int(1) DEFAULT '0',
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_publications_users1_idx` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_midia` */

/*Table structure for table `dbo_application_newslatter` */

DROP TABLE IF EXISTS `dbo_application_newslatter`;

CREATE TABLE `dbo_application_newslatter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_newslatter` */

/*Table structure for table `dbo_application_noticias` */

DROP TABLE IF EXISTS `dbo_application_noticias`;

CREATE TABLE `dbo_application_noticias` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `group_id` int(10) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `metatitle` varchar(255) DEFAULT NULL,
  `metakeyworks` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `metadescriptions` varchar(500) DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `author` varchar(255) DEFAULT 'Desconhecido',
  `image_cover` varchar(255) DEFAULT NULL,
  `content` text CHARACTER SET latin1 COMMENT '	',
  `position` int(11) DEFAULT NULL,
  `excerpt` text CHARACTER SET latin1,
  `date` datetime DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tag_search` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `insert` datetime DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT '...',
  `update` datetime DEFAULT NULL,
  `highlight` int(1) DEFAULT '0',
  `ativo` tinyint(1) DEFAULT '1',
  `del` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_news_users1_idx` (`user_id`),
  KEY `fk_news_groups1_idx` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_noticias` */

/*Table structure for table `dbo_application_optin` */

DROP TABLE IF EXISTS `dbo_application_optin`;

CREATE TABLE `dbo_application_optin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `telefone` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `razao` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `cnpj` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `insc_est` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `rg` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `assunto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` int(1) DEFAULT NULL,
  `mensagem` text COLLATE latin1_general_ci,
  `type` int(11) DEFAULT NULL,
  `info` mediumtext COLLATE latin1_general_ci,
  `ip` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `curriculo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `dbo_application_optin` */

/*Table structure for table `dbo_application_optin_answered` */

DROP TABLE IF EXISTS `dbo_application_optin_answered`;

CREATE TABLE `dbo_application_optin_answered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  `answered` varchar(255) DEFAULT NULL,
  `date_answered` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_optin_answered` */

/*Table structure for table `dbo_application_page` */

DROP TABLE IF EXISTS `dbo_application_page`;

CREATE TABLE `dbo_application_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ref` varchar(100) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `title_content` varchar(255) DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `url_absolute` varchar(255) DEFAULT NULL,
  `metatitle` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `metakeyworks` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `metadescriptions` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `facebook_title` varchar(1000) DEFAULT NULL,
  `facebook_descriptions` varchar(1000) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image_content` varchar(255) DEFAULT NULL,
  `image_background` varchar(255) DEFAULT NULL,
  `review` varchar(2000) DEFAULT NULL,
  `style` text,
  `script` text,
  `content` text CHARACTER SET latin1,
  `tracking_ga` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `likeit` int(11) DEFAULT '0',
  `content_type` int(11) DEFAULT NULL,
  `content_section` varchar(80) DEFAULT NULL,
  `list_mode` int(1) DEFAULT '0',
  `next_page` varchar(150) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `position` int(11) DEFAULT NULL,
  `publicated_at` datetime DEFAULT NULL COMMENT 'Data Publicação',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0' COMMENT 'Enable / Disable Content',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_page` */

/*Table structure for table `dbo_application_partner_groups` */

DROP TABLE IF EXISTS `dbo_application_partner_groups`;

CREATE TABLE `dbo_application_partner_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `subgroup` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_partner_groups` */

/*Table structure for table `dbo_application_partners` */

DROP TABLE IF EXISTS `dbo_application_partners`;

CREATE TABLE `dbo_application_partners` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `partner_group_id` int(10) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `curriculum` varchar(255) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(155) DEFAULT NULL,
  `image_alt` varchar(256) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `publicated_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `del` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_partiners_users1_idx` (`user_id`),
  KEY `fk_partners_partner_groups1_idx` (`partner_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_partners` */

/*Table structure for table `dbo_application_pressrelease` */

DROP TABLE IF EXISTS `dbo_application_pressrelease`;

CREATE TABLE `dbo_application_pressrelease` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `title` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `metatitle` varchar(255) DEFAULT NULL,
  `metakeyworks` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `metadescriptions` varchar(500) DEFAULT NULL,
  `excerpt` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `tag_search` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `image_cover` varchar(255) DEFAULT NULL,
  `insert` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `ativo` int(1) DEFAULT '1',
  `del` int(1) DEFAULT '0',
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_publications_users1_idx` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_pressrelease` */

/*Table structure for table `dbo_application_publications` */

DROP TABLE IF EXISTS `dbo_application_publications`;

CREATE TABLE `dbo_application_publications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(128) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `metatitle` varchar(1000) DEFAULT NULL,
  `metakeyworks` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `metadescriptions` varchar(1000) DEFAULT NULL,
  `tracking_ga` varchar(100) DEFAULT NULL,
  `image_cover` varchar(255) DEFAULT NULL,
  `excerpt` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `tag_search` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `insert` datetime NOT NULL,
  `update` datetime DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `del` int(1) NOT NULL DEFAULT '0',
  `___D_E_L_E_T_E_D___` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_publications_users1_idx` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_publications` */

/*Table structure for table `dbo_application_sessionhandler` */

DROP TABLE IF EXISTS `dbo_application_sessionhandler`;

CREATE TABLE `dbo_application_sessionhandler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `pagina` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `referer` varchar(255) DEFAULT NULL,
  `id_session_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `dbo_application_sessionhandler` */

/*Table structure for table `dbo_application_settings` */

DROP TABLE IF EXISTS `dbo_application_settings`;

CREATE TABLE `dbo_application_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `razao_social` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_fantasia` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cnpj` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nm_endereco` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `bairro` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cidade` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `uf` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `pais` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `boilerplate` mediumtext COLLATE latin1_general_ci,
  `disclaimer` mediumtext COLLATE latin1_general_ci,
  `responsavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `dominio` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `protocolo` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `descriptions` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `keywords` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `googlesiteverification` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Logo  Geral do  Site',
  `logo_header` varchar(255) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Logo para o Header',
  `logo_footer` varchar(255) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Logo para o Footer',
  `footer` mediumtext COLLATE latin1_general_ci,
  `email_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `twitter_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `facebook_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `linkedin_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `pinteres_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `googleplus_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `skype_account` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_site` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `smtp_server` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `int_auth` int(1) DEFAULT '0',
  `login_auth` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `pass_auth` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `ga` text COLLATE latin1_general_ci,
  `analyticstrack` text COLLATE latin1_general_ci,
  `name_dispacher_notification` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `dbo_application_settings` */

insert  into `dbo_application_settings`(`id`,`language`,`razao_social`,`nome_fantasia`,`cnpj`,`cep`,`endereco`,`nm_endereco`,`complemento`,`bairro`,`cidade`,`uf`,`pais`,`boilerplate`,`disclaimer`,`responsavel`,`phone`,`title`,`dominio`,`protocolo`,`descriptions`,`keywords`,`googlesiteverification`,`logo`,`logo_header`,`logo_footer`,`footer`,`email_account`,`twitter_account`,`facebook_account`,`linkedin_account`,`pinteres_account`,`googleplus_account`,`skype_account`,`email_site`,`smtp_server`,`int_auth`,`login_auth`,`pass_auth`,`ga`,`analyticstrack`,`name_dispacher_notification`,`latitude`,`longitude`,`___D_E_L_E_T_E_D___`) values (1,'pt-br','ICTS Gestão de Riscos Consultoria e Serviços','ICTS Gestão de Riscos Consultoria e Serviços','0000000','04576-080',' James Joule','65','5º andar','Cidade Monções','São Paulo','SP','Brasil','<p>A ICTS &eacute; uma empresa brasileira de consultoria, auditoria interna e servi&ccedil;os em gest&atilde;o de riscos e de neg&oacute;cios com a mais abrangente atua&ccedil;&atilde;o no mercado nacional. Propicia aos seus clientes prote&ccedil;&atilde;o no presente e confian&ccedil;a no futuro. Sua atua&ccedil;&atilde;o inclui tr&ecirc;s focos: Protiviti, firma-membro(*) da Protiviti Inc., com servi&ccedil;os de Auditoria interna, Consultoria em Riscos, Neg&oacute;cios e Tecnologia; ICTS Outsourcing, com opera&ccedil;&otilde;es de Gest&atilde;o de Riscos e Compliance; ICTS Security, com consultoria e gest&atilde;o de servi&ccedil;os de seguran&ccedil;a pessoal e corporativos. Empresa Pr&oacute;-&Eacute;tica em 2015, 2016 e 2017, a ICTS conta, no Brasil, com mais de 300 profissionais e presta servi&ccedil;os a mais de 40% das empresas classificadas entre as 500 Maiores da Exame. Atende a empresas no territ&oacute;rio nacional e no exterior a partir de escrit&oacute;rios em S&atilde;o Paulo, Rio de Janeiro e Barueri.</p>\r\n','<p>ICTS. Todos os direitos reservados. Os Direitos de Propriedade Intelectual nas p&aacute;ginas do site da ICTS e o conte&uacute;do dispon&iacute;vel atrav&eacute;s das mesmas pertencem &agrave; ICTS, bem como todos os outros direitos de propriedade intelectual, direitos autorais, sobre patentes e bancos de dados, direitos sobre marcas, projetos, know-how e informa&ccedil;&otilde;es confidenciais registradas ou n&atilde;o registradas. (*) Firmas-membro Protiviti s&atilde;o entidades jur&iacute;dicas independentes que operam sob o nome Protiviti. Cada firma-membro da rede constitui uma pessoa jur&iacute;dica aut&ocirc;noma, n&atilde;o representa outras empresas da rede Protiviti e n&atilde;o t&ecirc;m autoridade para obrigar ou vincular outras empresas na rede Protiviti.</p>\r\n','Irani','+55 11 2198.4200','ICTS – Auditoria e Consultoria em Gestão de Riscos e Compliance','unitt.local','http://','A ICTS é uma empresa de consultoria, auditoria e serviços em gestão de riscos. Mais ampla atuação do mercado em Compliance, auditoria interna, prevenção à fraude, segurança de TI e gestão da segurança.','risco de negócio, canal de denúncias, auditoria interna, gestão de segurança, investigação empresarial, segurança de TI','','images/logos/Logo_ICTS_com_business_descriptor_branco.png','img/logo/Logo_ICTS_180x60px.svg','images/logos/Logo_ICTS_com_business_descriptor_branco.png','<div class=\"col-md-3 col-sm-6 col-xs-12 marbo-resp4\">\r\n<h6 class=\"white caps font-weight7 margin-bottom3 left\">S&atilde;o Paulo</h6>\r\n\r\n<p class=\"clearfix\">&nbsp;</p>\r\n\r\n<ul class=\"none valign3 left white opacity3\">\r\n	<li>&nbsp; Rua James Joule, 65,<br />\r\n	Torre Sul - Berrini<br />\r\n	S&atilde;o Paulo - SP, Cep: 04576-080</li>\r\n	<li><!--<i class=\"fa fa-phone\"></i>  +55 (11) 2198-4200--></li>\r\n</ul>\r\n</div>\r\n<!-- end col -->\r\n\r\n<div class=\"col-md-3 col-sm-6 col-xs-12 marbo-resp4\">\r\n<h6 class=\"white caps font-weight7 margin-bottom3 clearfix left\">Rio de Janeiro</h6>\r\n\r\n<p class=\"clearfix\">&nbsp;</p>\r\n\r\n<ul class=\"none valign3 left white opacity3\">\r\n	<li>&nbsp; Av. Rio Branco, 109<br />\r\n	Conj. 702 - Centro<br />\r\n	Rio de Janeiro - RJ, Cep: 20040-004</li>\r\n	<li><!--<i class=\"fa fa-phone\"></i>  +55 (21) 2511.2651--></li>\r\n</ul>\r\n</div>\r\n<!-- end col -->\r\n\r\n<div class=\"col-md-3 col-sm-6 col-xs-12 marbo-resp4\">\r\n<h6 class=\"white caps font-weight7 margin-bottom3 clearfix left\">Alphaville</h6>\r\n\r\n<p class=\"clearfix\">&nbsp;</p>\r\n\r\n<ul class=\"none valign3 left white opacity3\">\r\n	<li>&nbsp; Al. Madeira, 222<br />\r\n	14&ordm; andar &ndash; Alphaville Industrial<br />\r\n	Barueri - SP, Cep: 06454-010</li>\r\n	<li><!--<i class=\"fa fa-phone\"></i>  +55 (11) 2198.4200--></li>\r\n</ul>\r\n</div>\r\n','contato@icts.com.br','https://twitter.com/icts_protiviti','https://www.facebook.com/ICTSProtiviti/','https://www.linkedin.com/company-beta/12466/','','','','web@icts.com.br','smtp.office365.com',1,'web@icts.com.br','&P7ph6GuduGa','<script>\r\n(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){\r\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\r\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\r\n  })(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');\r\n\r\n  ga(\'create\', \'UA-48127444-2\', \'auto\');\r\n  ga(\'send\', \'pageview\');\r\n\r\n</script>','<!-- Facebook Pixel Code -->\r\n<script>\r\n!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?\r\nn.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;\r\nn.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;\r\nt.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,\r\ndocument,\'script\',\'https://connect.facebook.net/en_US/fbevents.js\');\r\n\r\nfbq(\'init\', \'266070760456211\');\r\nfbq(\'track\', \"PageView\");</script>\r\n<noscript><img height=\"1\" width=\"1\" style=\"display:none\"\r\nsrc=\"https://www.facebook.com/tr?id=266070760456211&ev=PageView&noscript=1\"\r\n/></noscript>\r\n<!-- End Facebook Pixel Code -->\r\n\r\n<!-- Hotjar Tracking Code for http://icts.com.br/v2/por/home/index -->\r\n<script>\r\n    (function(h,o,t,j,a,r){\r\n	h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};\r\n	h._hjSettings={hjid:270044,hjsv:5};\r\n	a=o.getElementsByTagName(\'head\')[0];\r\n	r=o.createElement(\'script\');r.async=1;\r\n	r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;\r\n	a.appendChild(r);\r\n    })(window,document,\'//static.hotjar.com/c/hotjar-\',\'.js?sv=\');\r\n</script>',NULL,'-23.6113020','-46.6961160',0);

/*Table structure for table `dbo_application_slider_image` */

DROP TABLE IF EXISTS `dbo_application_slider_image`;

CREATE TABLE `dbo_application_slider_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_slider` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `attachment_path_file` varchar(255) DEFAULT NULL,
  `attachment_file` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `dimensao` varchar(50) DEFAULT NULL,
  `size_width` varchar(20) DEFAULT NULL,
  `size_height` varchar(20) DEFAULT NULL,
  `link_type` int(11) DEFAULT NULL,
  `url_slider` varchar(255) DEFAULT NULL,
  `url_target_slider` varchar(50) DEFAULT NULL,
  `txt_title` varchar(100) DEFAULT NULL,
  `txt_title_color` varchar(50) DEFAULT NULL,
  `txt_title_style` varchar(50) DEFAULT NULL,
  `txt_description` varchar(255) DEFAULT NULL,
  `txt_description_color` varchar(50) DEFAULT NULL,
  `txt_description_style` varchar(50) DEFAULT NULL,
  `btn_a_txt` varchar(50) DEFAULT NULL,
  `btn_a_txt_color` varchar(50) DEFAULT NULL,
  `btn_a_color` varchar(50) DEFAULT NULL,
  `btn_a_url` varchar(255) DEFAULT NULL,
  `btn_a_target` varchar(50) DEFAULT NULL,
  `btn_b_txt` varchar(50) DEFAULT NULL,
  `btn_b_txt_color` varchar(50) DEFAULT NULL,
  `btn_b_color` varchar(50) DEFAULT NULL,
  `btn_b_url` varchar(255) DEFAULT NULL,
  `btn_b_target` varchar(50) DEFAULT NULL,
  `int_position` varchar(150) DEFAULT NULL,
  `elementOne` varchar(500) DEFAULT NULL,
  `elementOne_style` varchar(50) DEFAULT NULL,
  `elementTwo` varchar(500) DEFAULT NULL,
  `elementTwo_style` varchar(50) DEFAULT NULL,
  `elementTwo_color` varchar(50) DEFAULT NULL,
  `elementThree` varchar(500) DEFAULT NULL,
  `elementThree_style` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbo_application_slider_image` */

/*Table structure for table `dbo_application_sliders` */

DROP TABLE IF EXISTS `dbo_application_sliders`;

CREATE TABLE `dbo_application_sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `duracao` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `transicao` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `___D_E_L_E_T_E_D___` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `dbo_application_sliders` */

/*Table structure for table `grupos_usuarios` */

DROP TABLE IF EXISTS `grupos_usuarios`;

CREATE TABLE `grupos_usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `excluido` int(11) NOT NULL DEFAULT '0',
  `excluido_em` datetime DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `editado_em` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `grupos_usuarios` */

insert  into `grupos_usuarios`(`id`,`nome`,`excluido`,`excluido_em`,`excluido_por`,`criado_em`,`editado_em`) values (1,'Administradores',0,NULL,NULL,'2016-02-24 00:00:00','0000-00-00 00:00:00'),(2,'Edtores',0,NULL,NULL,'2018-01-16 10:02:34','2018-01-16 10:02:36');

/*Table structure for table `usuario_logs` */

DROP TABLE IF EXISTS `usuario_logs`;

CREATE TABLE `usuario_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo_log` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `criado_em` datetime NOT NULL,
  `editado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `usuario_logs` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) unsigned DEFAULT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `sobrenome` varchar(80) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) DEFAULT NULL,
  `areas_permissoes` varchar(255) NOT NULL,
  `tasks_permissoes` varchar(255) DEFAULT NULL,
  `is_televendas` tinyint(1) NOT NULL DEFAULT '0',
  `is_backoffice` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `perfil` varchar(1000) DEFAULT NULL,
  `excluido` int(11) NOT NULL DEFAULT '0',
  `excluido_em` datetime DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`id_grupo`,`nome`,`sobrenome`,`email`,`cpf`,`logradouro`,`numero`,`cep`,`complemento`,`telefone`,`celular`,`username`,`password`,`superadmin`,`remember_token`,`areas_permissoes`,`tasks_permissoes`,`is_televendas`,`is_backoffice`,`ativo`,`perfil`,`excluido`,`excluido_em`,`excluido_por`,`criado_em`,`editado_em`) values (1,1,'Guilherme','','guilhemers@bbrands.com.br','','','','','','','','guilherme','$2y$10$8RET4pEZ..H3/BWj4qsKw.4L4F7yjoCij49lO/vmTEPqVT1c1TCXq',0,'YtbU2ZQnWo7Qa7qVARPqgZ8NjibugDHaMRtEIx5XGAXf33IgVEF6l2cKAa2S','60,84,63,64,101,91',NULL,0,0,1,NULL,0,NULL,NULL,'2016-09-14 10:55:22','2018-02-05 15:46:16'),(2,1,'Renan','G. da Silva','renan.silva@unitta.com.br','00000000000','596','596','04476000','Portão Amarelo','(11) 5674-2028','(11) 9709-63983','renan','$2y$10$IN4tXG21lhKci76FPM674u00rxKsdqd8ro8D2NkficgfOO0cJss9i',1,'rZbL5Sc9lbD86R32TxxSlaV3Hwl7ToFr3rBGaRh81OAyr5eEWfmUXy5fnNaX','',NULL,0,0,1,'',0,NULL,NULL,'2017-07-10 19:56:20','2018-02-15 13:23:45'),(3,0,'Rogerio ','Sutto','rogerio.sutto@unitta.com.br','','','176','04571-210','','','','rsutto','$2y$10$d1It9HS8t7Tf5.FQxF8Esew6rPvCdId4MKDeO3gU7R0EP3U91c4NC',1,NULL,'',NULL,1,1,1,NULL,0,NULL,NULL,'2017-07-10 20:22:04','2017-07-10 20:22:04');

/*Table structure for table `vw_grouped_partners` */

DROP TABLE IF EXISTS `vw_grouped_partners`;

/*!50001 DROP VIEW IF EXISTS `vw_grouped_partners` */;
/*!50001 DROP TABLE IF EXISTS `vw_grouped_partners` */;

/*!50001 CREATE TABLE  `vw_grouped_partners`(
 `id` int(10) ,
 `name` varchar(128) ,
 `slug` varchar(128) ,
 `email` varchar(128) ,
 `description` text ,
 `image` varchar(155) ,
 `image_alt` varchar(256) ,
 `ativo` int(1) ,
 `position` int(11) ,
 `grupo` varchar(64) ,
 `class_group` int(11) ,
 `subgroup` varchar(64) 
)*/;

/*Table structure for table `vw_sliders` */

DROP TABLE IF EXISTS `vw_sliders`;

/*!50001 DROP VIEW IF EXISTS `vw_sliders` */;
/*!50001 DROP TABLE IF EXISTS `vw_sliders` */;

/*!50001 CREATE TABLE  `vw_sliders`(
 `id` int(11) ,
 `id_slider` int(11) ,
 `image` varchar(255) ,
 `attachment_path_file` varchar(255) ,
 `attachment_file` varchar(255) ,
 `title` varchar(255) ,
 `dimensao` varchar(50) ,
 `size_width` varchar(20) ,
 `size_height` varchar(20) ,
 `link_type` int(11) ,
 `url_slider` varchar(255) ,
 `url_target_slider` varchar(50) ,
 `txt_title` varchar(100) ,
 `txt_title_color` varchar(50) ,
 `txt_title_style` varchar(50) ,
 `txt_description` varchar(255) ,
 `txt_description_color` varchar(50) ,
 `txt_description_style` varchar(50) ,
 `btn_a_txt` varchar(50) ,
 `btn_a_txt_color` varchar(50) ,
 `btn_a_color` varchar(50) ,
 `btn_a_url` varchar(255) ,
 `btn_a_target` varchar(50) ,
 `btn_b_txt` varchar(50) ,
 `btn_b_txt_color` varchar(50) ,
 `btn_b_color` varchar(50) ,
 `btn_b_url` varchar(255) ,
 `btn_b_target` varchar(50) ,
 `int_position` varchar(150) ,
 `elementOne` varchar(500) ,
 `elementOne_style` varchar(50) ,
 `elementTwo` varchar(500) ,
 `elementTwo_style` varchar(50) ,
 `elementTwo_color` varchar(50) ,
 `elementThree` varchar(500) ,
 `created_at` datetime ,
 `updated_at` datetime ,
 `___D_E_L_E_T_E_D___` int(1) ,
 `slider_title` varchar(255) ,
 `duracao` varchar(20) ,
 `transicao` varchar(50) 
)*/;

/*View structure for view vw_grouped_partners */

/*!50001 DROP TABLE IF EXISTS `vw_grouped_partners` */;
/*!50001 DROP VIEW IF EXISTS `vw_grouped_partners` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`ictsportal`@`%` SQL SECURITY DEFINER VIEW `vw_grouped_partners` AS (select `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`slug` AS `slug`,`p`.`email` AS `email`,`p`.`description` AS `description`,`p`.`image` AS `image`,`p`.`image_alt` AS `image_alt`,`p`.`ativo` AS `ativo`,`p`.`position` AS `position`,`g`.`title` AS `grupo`,`g`.`position` AS `class_group`,`g`.`subgroup` AS `subgroup` from (`dbo_application_partners` `p` join `dbo_application_partner_groups` `g` on((`p`.`partner_group_id` = `g`.`id`))) group by `p`.`name` order by `p`.`position`) */;

/*View structure for view vw_sliders */

/*!50001 DROP TABLE IF EXISTS `vw_sliders` */;
/*!50001 DROP VIEW IF EXISTS `vw_sliders` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`ictsportal`@`%` SQL SECURITY DEFINER VIEW `vw_sliders` AS (select `i`.`id` AS `id`,`i`.`id_slider` AS `id_slider`,`i`.`image` AS `image`,`i`.`attachment_path_file` AS `attachment_path_file`,`i`.`attachment_file` AS `attachment_file`,`i`.`title` AS `title`,`i`.`dimensao` AS `dimensao`,`i`.`size_width` AS `size_width`,`i`.`size_height` AS `size_height`,`i`.`link_type` AS `link_type`,`i`.`url_slider` AS `url_slider`,`i`.`url_target_slider` AS `url_target_slider`,`i`.`txt_title` AS `txt_title`,`i`.`txt_title_color` AS `txt_title_color`,`i`.`txt_title_style` AS `txt_title_style`,`i`.`txt_description` AS `txt_description`,`i`.`txt_description_color` AS `txt_description_color`,`i`.`txt_description_style` AS `txt_description_style`,`i`.`btn_a_txt` AS `btn_a_txt`,`i`.`btn_a_txt_color` AS `btn_a_txt_color`,`i`.`btn_a_color` AS `btn_a_color`,`i`.`btn_a_url` AS `btn_a_url`,`i`.`btn_a_target` AS `btn_a_target`,`i`.`btn_b_txt` AS `btn_b_txt`,`i`.`btn_b_txt_color` AS `btn_b_txt_color`,`i`.`btn_b_color` AS `btn_b_color`,`i`.`btn_b_url` AS `btn_b_url`,`i`.`btn_b_target` AS `btn_b_target`,`i`.`int_position` AS `int_position`,`i`.`elementOne` AS `elementOne`,`i`.`elementOne_style` AS `elementOne_style`,`i`.`elementTwo` AS `elementTwo`,`i`.`elementTwo_style` AS `elementTwo_style`,`i`.`elementTwo_color` AS `elementTwo_color`,`i`.`elementThree` AS `elementThree`,`i`.`created_at` AS `created_at`,`i`.`updated_at` AS `updated_at`,`i`.`___D_E_L_E_T_E_D___` AS `___D_E_L_E_T_E_D___`,`s`.`title` AS `slider_title`,`s`.`duracao` AS `duracao`,`s`.`transicao` AS `transicao` from (`dbo_application_sliders` `s` join `dbo_application_slider_image` `i` on((`i`.`id_slider` = `s`.`id`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
