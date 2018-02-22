-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2016 at 07:00 PM
-- Server version: 5.7.10
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the8co`
--

-- --------------------------------------------------------

--
-- Table structure for table `aph_urls`
--

CREATE TABLE `aph_urls` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aph_urls`
--

INSERT INTO `aph_urls` (`id`, `id_marca`, `url`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 1, 'slimcaps.com.br/mob_promo', 1, '2016-02-18 00:00:00', 1, '2016-02-18 20:59:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `id_pai` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT 'Not defined',
  `subtitulo` varchar(255) NOT NULL DEFAULT 'Not defined',
  `descricao` varchar(255) NOT NULL DEFAULT 'Not defined',
  `icon` varchar(60) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `order_by` int(11) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `id_pai`, `titulo`, `subtitulo`, `descricao`, `icon`, `controller`, `url`, `ativo`, `order_by`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, NULL, 'Empresas', 'Todas as empresas pertencetes a THE8CO.', 'Registros de todas as empresas', 'icon-rocket', 'Empresas', 'empresas', 1, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(2, NULL, 'Marcas', 'Todas as marcas pertencetes a THE8CO.', 'Registros de todas as marcas', 'icon-tag', 'Marcas', 'marcas', 1, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(3, NULL, 'Produtos', 'Todos os produtos THE8CO', 'Registro de todos os produtos', 'icon-layers', 'Produtos', 'produtos', 1, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(4, NULL, 'Campanhas', 'Todas as campanhas de THE8CO', 'Registro de todas as campanhas', 'icon-fire', 'Campanhas', 'campanhas', 1, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(5, NULL, 'Promoções', 'Todos os cupons de THE8CO', 'Todos os cupons de THE8CO', 'icon-tag', 'Promocoes', 'promocoes', 1, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(6, NULL, 'Clientes', '', '', 'icon-users', 'Clientes', 'clientes', 0, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(7, NULL, 'Pedidos', '', '', 'icon-basket-loaded', 'Pedidos', 'pedidos', 0, 0, '2016-01-22 00:00:00', 1, NULL, NULL),
(8, NULL, 'Kits', 'Todos os kits THE8CO', 'Todos os kits THE8CO', 'icon-social-dropbox', 'Kits', 'kits', 1, 0, '2016-02-11 00:00:00', 1, NULL, NULL),
(9, NULL, 'Aphrodite', 'Módulo de criação de URLs', '', 'icon-magic-wand', '', '', 1, 0, '2016-02-18 00:00:00', 1, NULL, NULL),
(10, 9, 'URLs', 'Cadastro de URLs', 'Cadastro de URLs', 'icon-link', 'Aphroditeurls', 'aphrodite-urls', 1, 3, '2016-02-18 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campanhas`
--

CREATE TABLE `campanhas` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `inicia_em` datetime DEFAULT NULL,
  `expira_em` datetime DEFAULT NULL,
  `all_urls` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campanhas`
--

INSERT INTO `campanhas` (`id`, `id_marca`, `nome`, `inicia_em`, `expira_em`, `all_urls`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 1, 'Campanha páscoa', '2016-02-15 00:00:00', '2016-02-20 00:00:00', 1, 1, '2016-02-15 00:00:00', 1, '2016-02-19 17:17:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campanhas_kits`
--

CREATE TABLE `campanhas_kits` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `id_kit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campanhas_kits`
--

INSERT INTO `campanhas_kits` (`id`, `id_campanha`, `id_kit`) VALUES
(21, 1, 1),
(22, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `campanhas_produtos`
--

CREATE TABLE `campanhas_produtos` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campanhas_produtos`
--

INSERT INTO `campanhas_produtos` (`id`, `id_campanha`, `id_produto`, `preco`, `parcelas`) VALUES
(15, 1, 1, '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `campanhas_termos`
--

CREATE TABLE `campanhas_termos` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `id_termo` int(11) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `campanhas_urls`
--

CREATE TABLE `campanhas_urls` (
  `id` int(11) NOT NULL,
  `id_url` int(11) DEFAULT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `parametro` varchar(60) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `valor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campanhas_urls`
--

INSERT INTO `campanhas_urls` (`id`, `id_url`, `id_campanha`, `parametro`, `tipo`, `valor`) VALUES
(23, 1, 1, 'utm_barba', ' ', 'teste'),
(24, 1, 1, 'utm_teste', ' ', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(255) DEFAULT NULL,
  `nome_fantasia` varchar(255) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `endereco_completo` varchar(255) NOT NULL,
  `endereco_fantasia` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `data_abertura` date NOT NULL,
  `responsaveis` text NOT NULL,
  `emails_contato` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `razao_social`, `nome_fantasia`, `cnpj`, `endereco_completo`, `endereco_fantasia`, `telefone`, `celular`, `fax`, `data_abertura`, `responsaveis`, `emails_contato`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(4, 'LA FIORI', 'La Fiori', '12.514.847/0001-73', 'Av. Brigadeiro Faria Lima, 1461, 17o. andar, Torre Sul, cj 171, Plataforma 02, 01452-002 Jd. Paulistano - São Paulo - SP - Brasil', 'Av. Brigadeiro Faria Lima, 1461, 17o. andar, Torre Sul, cj 171, Plataforma 02, 01452-002 Jd. Paulistano - São Paulo - SP - Brasil', '(11) 1111-1111', '(22) 2222-22222', '(33) 3333-3333', '2016-01-30', '{"1":{"nome":"Felipe Camargo","telefone":"(11) 9999-99999","funcao":"Diretor","email":"felipe.camargo@the8co.com.br"},"2":{"nome":"Felipe Sulimam","telefone":"(11) 9271-98217","funcao":"Diretor","email":"felipe.sulimam@the8co.com.br"}}', '{"1":{"nome":"Felipe Camargo","email":"felipe.camargo@the8co.com.br"}}', 1, '2016-01-26 00:00:00', 1, '2016-01-28 20:00:55', NULL),
(5, 'BARBA TESTE LTDA', 'Barbearia do barba', NULL, '', '', '', '', '', '2016-02-02', '', '', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grupos_usuarios`
--

CREATE TABLE `grupos_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`id`, `nome`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 'Administrador', '2016-01-22 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kits`
--

CREATE TABLE `kits` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `dias_consumo` int(11) DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `altura` decimal(10,2) DEFAULT NULL,
  `largura` decimal(10,2) DEFAULT NULL,
  `comprimento` decimal(10,2) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kits`
--

INSERT INTO `kits` (`id`, `id_marca`, `nome`, `dias_consumo`, `peso`, `altura`, `largura`, `comprimento`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 1, 'Kit Teste', 10, '10.00', '10.00', '10.00', '10.00', 1, '2016-02-11 00:00:00', 1, '2016-02-18 18:39:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kits_descricoes`
--

CREATE TABLE `kits_descricoes` (
  `id` int(11) NOT NULL,
  `id_kit` int(11) DEFAULT NULL,
  `texto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kits_descricoes`
--

INSERT INTO `kits_descricoes` (`id`, `id_kit`, `texto`) VALUES
(109, 1, 'asasdadasd'),
(110, 1, 'asdasdasdasdasd2'),
(111, 1, 'qeqasdasdadadas6');

-- --------------------------------------------------------

--
-- Table structure for table `kits_imagens`
--

CREATE TABLE `kits_imagens` (
  `id` int(11) NOT NULL,
  `id_kit` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `alt` varchar(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kits_imagens`
--

INSERT INTO `kits_imagens` (`id`, `id_kit`, `imagem`, `alt`, `ativo`) VALUES
(2, 1, 'kit444444.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kits_precos`
--

CREATE TABLE `kits_precos` (
  `id` int(11) NOT NULL,
  `id_kit` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kits_precos`
--

INSERT INTO `kits_precos` (`id`, `id_kit`, `preco`, `parcelas`, `ativo`) VALUES
(188, 1, '11.65', 1, 0),
(189, 1, '456.65', 2, 0),
(190, 1, '45.99', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kits_produtos`
--

CREATE TABLE `kits_produtos` (
  `id` int(11) NOT NULL,
  `id_kit` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `telefones` text,
  `responsaveis` text,
  `emails` text,
  `configuracoes` text,
  `ativo` tinyint(1) DEFAULT '0',
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`id`, `id_empresa`, `nome`, `url`, `telefones`, `responsaveis`, `emails`, `configuracoes`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 4, 'Slimcaps', 'slimcaps.com.br', '[{"nome":"Barba","telefone":"(19) 9482-5758"},{"nome":"Barba 2","telefone":"(11) 2937-12837"}]', '[{"nome":"Resp 1","telefone":"(98) 2289-83983","funcao":"Lalala","email":"lalala@lalala.com.br"},{"nome":"Resp 2","telefone":"(92) 8392-83928","funcao":"Lelelel","email":"laalal@lalslas.com.br"}]', '[{"nome":"Lucas","email":"lucas@lucas.com.br"},{"nome":"Lucas b","email":"Lucasb@lucasb.com.br"}]', '[{"nome":"Config 2","value":"Teste 2"}]', 1, NULL, NULL, '2016-02-18 19:54:28', NULL),
(2, 5, 'Barba Hair', 'barbahair.com.br', '[]', '[]', '[]', '[]', 1, '2016-02-18 00:00:00', 1, '2016-02-18 19:54:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `dias_consumo` int(11) DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `altura` decimal(10,2) DEFAULT NULL,
  `largura` decimal(10,2) DEFAULT NULL,
  `comprimento` decimal(10,2) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `id_marca`, `nome`, `sku`, `dias_consumo`, `peso`, `altura`, `largura`, `comprimento`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 1, 'Slimcaps Day', 'DJL2983', 20, '500.21', '10.00', '20.00', '12.00', 1, '2016-02-02 00:00:00', 1, '2016-02-12 18:55:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produtos_descricoes`
--

CREATE TABLE `produtos_descricoes` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `texto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos_descricoes`
--

INSERT INTO `produtos_descricoes` (`id`, `id_produto`, `texto`) VALUES
(40, 1, 'teste 1'),
(41, 1, 'teste 2'),
(42, 1, 'teste 3');

-- --------------------------------------------------------

--
-- Table structure for table `produtos_imagens`
--

CREATE TABLE `produtos_imagens` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `alt` varchar(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos_imagens`
--

INSERT INTO `produtos_imagens` (`id`, `id_produto`, `imagem`, `alt`, `ativo`) VALUES
(3, 1, 'rato.jpg', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produtos_precos`
--

CREATE TABLE `produtos_precos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos_precos`
--

INSERT INTO `produtos_precos` (`id`, `id_produto`, `preco`, `parcelas`, `ativo`) VALUES
(121, 1, '10.45', 3, 0),
(122, 1, '56.90', 6, 0),
(123, 1, '34.34', 3, 1),
(124, 1, '23.22', 3, 0),
(125, 1, '32.32', 2, 0),
(126, 1, '23.22', 23, 0),
(127, 1, '11.11', 1, 0),
(128, 1, '0.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promocoes`
--

CREATE TABLE `promocoes` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `inicia_em` datetime DEFAULT NULL,
  `expira_em` datetime DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promocoes`
--

INSERT INTO `promocoes` (`id`, `id_marca`, `nome`, `inicia_em`, `expira_em`, `ativo`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 1, '10% de desconto', '2016-02-02 00:00:00', '2090-02-02 00:00:00', 1, '2016-02-19 17:38:41', NULL, '2016-02-19 17:46:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocoes_urls`
--

CREATE TABLE `promocoes_urls` (
  `id` int(11) NOT NULL,
  `id_url` int(11) DEFAULT NULL,
  `id_promocao` int(11) DEFAULT NULL,
  `parametro` varchar(60) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `valor` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) DEFAULT NULL,
  `payload` text,
  `last_activity` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `templates_emails`
--

CREATE TABLE `templates_emails` (
  `id` int(11) NOT NULL,
  `id_parceiro` int(11) DEFAULT NULL,
  `titulo` varchar(60) DEFAULT NULL,
  `html` text,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates_emails`
--

INSERT INTO `templates_emails` (`id`, `id_parceiro`, `titulo`, `html`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, NULL, 'Template de teste', '<html><body>Teste de e-mail dinamico!<br /><br />Nome: {{nome}}<br />Idade: {{idade}}<br />Sexo: {{sexo}}<br /></body></html>', '2016-01-18 00:00:00', 1, NULL, NULL),
(2, NULL, 'Esqueci minha senha', '<html><body><h1>Esqueci minha senha</h1><br /><br />Olá {{nome}} {{sobrenome}}, a sua nova senha é:<br /><br /><b>{{nova_senha}}</b>', '2016-01-20 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `termos`
--

CREATE TABLE `termos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `sobrenome` varchar(80) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `criado_por` int(11) DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `editado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_grupo`, `nome`, `sobrenome`, `email`, `cpf`, `logradouro`, `numero`, `cep`, `complemento`, `telefone`, `celular`, `username`, `password`, `superadmin`, `remember_token`, `criado_em`, `criado_por`, `editado_em`, `editado_por`) VALUES
(1, 1, 'Lucas Barbieri', 'Barbieri', 'lucas.barbieri@bbrands.com.br', '33796145809', 'Rua Belfort Mattos', '37', '02259110', 'Casa', '(11) 2247-1914', '(11) 9948-25758', 'barba', '$2y$10$4dH3KAdTz7xmsXumuSp91ugiTdxbA7pmz/AAxwn0O2lkxVwXzb5lm', 1, 'U28rJJuyKJ0IWUanjBTeicznC6EzuZSoPuFmnpXsPAOiajNoZEQmifJ1gCiO', '2016-01-18 00:00:00', 1, '2016-01-24 06:35:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aph_urls`
--
ALTER TABLE `aph_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanhas`
--
ALTER TABLE `campanhas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanhas_kits`
--
ALTER TABLE `campanhas_kits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanhas_produtos`
--
ALTER TABLE `campanhas_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanhas_termos`
--
ALTER TABLE `campanhas_termos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanhas_urls`
--
ALTER TABLE `campanhas_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kits`
--
ALTER TABLE `kits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kits_descricoes`
--
ALTER TABLE `kits_descricoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kits_imagens`
--
ALTER TABLE `kits_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kits_precos`
--
ALTER TABLE `kits_precos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kits_produtos`
--
ALTER TABLE `kits_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos_descricoes`
--
ALTER TABLE `produtos_descricoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos_imagens`
--
ALTER TABLE `produtos_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos_precos`
--
ALTER TABLE `produtos_precos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocoes`
--
ALTER TABLE `promocoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocoes_urls`
--
ALTER TABLE `promocoes_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `templates_emails`
--
ALTER TABLE `templates_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termos`
--
ALTER TABLE `termos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aph_urls`
--
ALTER TABLE `aph_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `campanhas`
--
ALTER TABLE `campanhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `campanhas_kits`
--
ALTER TABLE `campanhas_kits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `campanhas_produtos`
--
ALTER TABLE `campanhas_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `campanhas_termos`
--
ALTER TABLE `campanhas_termos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campanhas_urls`
--
ALTER TABLE `campanhas_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kits`
--
ALTER TABLE `kits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kits_descricoes`
--
ALTER TABLE `kits_descricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `kits_imagens`
--
ALTER TABLE `kits_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kits_precos`
--
ALTER TABLE `kits_precos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `kits_produtos`
--
ALTER TABLE `kits_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produtos_descricoes`
--
ALTER TABLE `produtos_descricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `produtos_imagens`
--
ALTER TABLE `produtos_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produtos_precos`
--
ALTER TABLE `produtos_precos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `promocoes`
--
ALTER TABLE `promocoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `promocoes_urls`
--
ALTER TABLE `promocoes_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `templates_emails`
--
ALTER TABLE `templates_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `termos`
--
ALTER TABLE `termos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
