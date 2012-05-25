-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 24, 2012 as 03:14 PM
-- Versão do Servidor: 5.1.62
-- Versão do PHP: 5.3.5-1ubuntu7.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `leviatan`
--

CREATE DATABASE IF NOT EXISTS leviatan

-- --------------------------------------------------------

--
-- Estrutura da tabela `expense_groups`
--

CREATE TABLE IF NOT EXISTS `expense_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `functional_units`
--

CREATE TABLE IF NOT EXISTS `functional_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `group_types`
--

CREATE TABLE IF NOT EXISTS `group_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `input_categories`
--

CREATE TABLE IF NOT EXISTS `input_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `input_subcategories`
--

CREATE TABLE IF NOT EXISTS `input_subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `input_category_id` (`input_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `input_subcategories`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_class_id` int(11) NOT NULL,
  `pngc_code_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `items`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `item_classes`
--

CREATE TABLE IF NOT EXISTS `item_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group_id` int(11) NOT NULL,
  `keycode` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_group_id` (`item_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=569 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `item_groups`
--

CREATE TABLE IF NOT EXISTS `item_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_type_id` int(11) NOT NULL,
  `key` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_type_id` (`group_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `measure_types`
--

CREATE TABLE IF NOT EXISTS `measure_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pngc_codes`
--

CREATE TABLE IF NOT EXISTS `pngc_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keycode` varchar(255) NOT NULL,
  `expense_group_id` int(11) NOT NULL,
  `functional_unit_id` int(11) NOT NULL,
  `input_category_id` int(11) NOT NULL,
  `input_subcategory_id` int(11) NOT NULL,
  `measure_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_group_id` (`expense_group_id`),
  KEY `functional_unit_id` (`functional_unit_id`),
  KEY `input_category_id` (`input_category_id`),
  KEY `input_subcategory_id` (`input_subcategory_id`),
  KEY `measure_type_id` (`measure_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

