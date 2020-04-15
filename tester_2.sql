/*
MySQL Data Transfer
Source Host: localhost
Source Database: tester_2
Target Host: localhost
Target Database: tester_2
Date: 18.1.2019 14:58:55
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for konfigurace_testu
-- ----------------------------
DROP TABLE IF EXISTS `konfigurace_testu`;
CREATE TABLE `konfigurace_testu` (
  `uid_konfigurace_testu` varchar(13) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `popis_testu` varchar(120) DEFAULT '',
  `nazev_testu` varchar(120) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT '',
  `paralel_v_session_spustitelny` tinyint(1) NOT NULL DEFAULT '0',
  `id_sada_otazek_fk` int(11) unsigned NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid_konfigurace_testu`),
  KEY `id_sada_otazek_FK` (`id_sada_otazek_fk`),
  CONSTRAINT `konfigurace_testu_ibfk_2` FOREIGN KEY (`id_sada_otazek_fk`) REFERENCES `sada_otazek` (`id_sada_otazek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for odpoved
-- ----------------------------
DROP TABLE IF EXISTS `odpoved`;
CREATE TABLE `odpoved` (
  `id_odpoved` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_prubeh_testu_fk` int(11) unsigned NOT NULL,
  `stav_tabbedu` text,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_odpoved`),
  KEY `id_spusteny_test_fk` (`id_prubeh_testu_fk`),
  CONSTRAINT `odpoved_ibfk_1` FOREIGN KEY (`id_prubeh_testu_fk`) REFERENCES `prubeh_testu` (`id_prubeh_testu`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for odpoved_na_otazku
-- ----------------------------
DROP TABLE IF EXISTS `odpoved_na_otazku`;
CREATE TABLE `odpoved_na_otazku` (
  `id_odpoved_na_otazku` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_prubeh_testu_fk` int(11) unsigned NOT NULL,
  `identifikator_odpovedi` int(11) NOT NULL,
  `hodnota` int(11) NOT NULL,
  PRIMARY KEY (`id_odpoved_na_otazku`),
  KEY `id_spusteny_test_fk` (`id_prubeh_testu_fk`),
  CONSTRAINT `odpoved_na_otazku_ibfk_1` FOREIGN KEY (`id_prubeh_testu_fk`) REFERENCES `prubeh_testu` (`id_prubeh_testu`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for odpovedi
-- ----------------------------
DROP TABLE IF EXISTS `odpovedi`;
CREATE TABLE `odpovedi` (
  `id_odpovedi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pozadavek_fk` int(11) unsigned DEFAULT NULL,
  `inserted` timestamp NULL DEFAULT NULL,
  `uloha01` int(10) unsigned DEFAULT NULL,
  `uloha02` int(10) unsigned DEFAULT NULL,
  `uloha03` int(10) unsigned DEFAULT NULL,
  `uloha04` int(10) unsigned DEFAULT NULL,
  `uloha05` int(10) unsigned DEFAULT NULL,
  `uloha06` int(10) unsigned DEFAULT NULL,
  `uloha07` int(10) unsigned DEFAULT NULL,
  `uloha08` int(10) unsigned DEFAULT NULL,
  `uloha09` int(10) unsigned DEFAULT NULL,
  `uloha10` int(10) unsigned DEFAULT NULL,
  `uloha11` int(10) unsigned DEFAULT NULL,
  `uloha12` int(10) unsigned DEFAULT NULL,
  `uloha13` int(10) unsigned DEFAULT NULL,
  `uloha14` int(10) unsigned DEFAULT NULL,
  `uloha15` int(10) unsigned DEFAULT NULL,
  `uloha16` int(10) unsigned DEFAULT NULL,
  `uloha17` int(10) unsigned DEFAULT NULL,
  `uloha18` int(10) unsigned DEFAULT NULL,
  `uloha19` int(10) DEFAULT NULL,
  `uloha20` int(10) DEFAULT NULL,
  `uloha21` int(10) DEFAULT NULL,
  `uloha22` int(10) DEFAULT NULL,
  `uloha23` int(10) DEFAULT NULL,
  `uloha24` int(10) DEFAULT NULL,
  `uloha25` int(10) DEFAULT NULL,
  `uloha26` int(10) DEFAULT NULL,
  `uloha27` int(10) DEFAULT NULL,
  `uloha28` int(10) DEFAULT NULL,
  `uloha29` int(10) DEFAULT NULL,
  `uloha30` int(10) DEFAULT NULL,
  `uloha31` int(10) DEFAULT NULL,
  `uloha32` int(10) DEFAULT NULL,
  `uloha33` int(10) DEFAULT NULL,
  `uloha34` int(10) DEFAULT NULL,
  `uloha35` int(10) DEFAULT NULL,
  `uloha36` int(10) DEFAULT NULL,
  `uloha37` int(10) DEFAULT NULL,
  `uloha38` int(10) DEFAULT NULL,
  `uloha39` int(10) DEFAULT NULL,
  `uloha40` int(10) DEFAULT NULL,
  `uloha41` int(10) DEFAULT NULL,
  `uloha42` int(10) DEFAULT NULL,
  `uloha43` int(10) DEFAULT NULL,
  `uloha44` int(10) DEFAULT NULL,
  `uloha45` int(10) DEFAULT NULL,
  `uloha46` int(10) DEFAULT NULL,
  `uloha47` int(10) DEFAULT NULL,
  `uloha48` int(10) DEFAULT NULL,
  `uloha49` int(10) DEFAULT NULL,
  `uloha50` int(10) DEFAULT NULL,
  `uloha51` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_odpovedi`),
  KEY `id_os_FK` (`id_pozadavek_fk`),
  CONSTRAINT `odpovedi_ibfk_1` FOREIGN KEY (`id_pozadavek_fk`) REFERENCES `pozadavek` (`id_pozadavek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Table structure for pozadavek
-- ----------------------------
DROP TABLE IF EXISTS `pozadavek`;
CREATE TABLE `pozadavek` (
  `id_pozadavek` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_request` int(11) unsigned DEFAULT NULL,
  `kampane_id_vzb_osoba_kampan` int(11) NOT NULL,
  `otisk` varchar(500) COLLATE utf8_czech_ci DEFAULT NULL,
  `identifikace_nepotrebnysloupes` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
  `inserted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pozadavek`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Table structure for prubeh_testu
-- ----------------------------
DROP TABLE IF EXISTS `prubeh_testu`;
CREATE TABLE `prubeh_testu` (
  `id_prubeh_testu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `identifikator_ticketu_fk` varchar(50) NOT NULL,
  `identifikator_konfigurace_testu_fk` varchar(13) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `cas_spusteni` datetime DEFAULT NULL,
  `pole_navic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_prubeh_testu`),
  KEY `identifikator_ticketu_fk` (`identifikator_ticketu_fk`),
  KEY `identifikator_konfigurace_testu_fk` (`identifikator_konfigurace_testu_fk`),
  CONSTRAINT `identifikator_ticketu_ibfk_30` FOREIGN KEY (`identifikator_ticketu_fk`) REFERENCES `ticket_pouzity` (`identifikator_ticketu`),
  CONSTRAINT `prubeh_testu_ibfk_1` FOREIGN KEY (`identifikator_konfigurace_testu_fk`) REFERENCES `konfigurace_testu` (`uid_konfigurace_testu`)
) ENGINE=InnoDB AUTO_INCREMENT=752 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for request
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `id_request` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pozadavek_fk` int(11) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `request_uri` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `request_time` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `remote_addr` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `query_string` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `input` varchar(1024) COLLATE utf8_czech_ci DEFAULT NULL,
  `get_identifikace` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `session_identifikace` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `kontrola_ok` tinyint(4) DEFAULT NULL,
  `die` varchar(512) COLLATE utf8_czech_ci DEFAULT NULL,
  `debug` varchar(1024) COLLATE utf8_czech_ci DEFAULT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kampane_id_vzb_osoba_kampan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_request`),
  KEY `id_pozadavek_FK` (`id_pozadavek_fk`),
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_pozadavek_fk`) REFERENCES `pozadavek` (`id_pozadavek`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Table structure for sada_otazek
-- ----------------------------
DROP TABLE IF EXISTS `sada_otazek`;
CREATE TABLE `sada_otazek` (
  `id_sada_otazek` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nazev_sady` varchar(120) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_sada_otazek`),
  KEY `nazev_sady` (`nazev_sady`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ticket_pouzity
-- ----------------------------
DROP TABLE IF EXISTS `ticket_pouzity`;
CREATE TABLE `ticket_pouzity` (
  `identifikator_ticketu` varchar(50) NOT NULL,
  `tmst` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`identifikator_ticketu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- View structure for konstrukce_pro_vyhodnoceni
-- ----------------------------
DROP VIEW IF EXISTS `konstrukce_pro_vyhodnoceni`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `konstrukce_pro_vyhodnoceni` AS select `tester_2`.`odpovedi`.`id_odpovedi` AS `te_od_id_odpovedi`,`tester_2`.`odpovedi`.`id_pozadavek_fk` AS `te_od_id_pozadavek_FK`,`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` AS `te_po_id_vzb`,`kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `ka_vzb_id_vzb_osoba_kampan`,`kampane_2`.`kampan`.`id_kampan` AS `ka_ka_id_kampan`,`kampane_2`.`kampan`.`kampan_nazev` AS `ka_ka_nazev`,`kampane_2`.`infotestmail`.`test_nazev` AS `test_nazev`,`kampane_2`.`infotestmail`.`test_jmeno_souboru` AS `test_jmeno_souboru`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `ka_vzb_id_osoba_FK`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) left join `kampane_2`.`kampan` on((`kampane_2`.`kampan`.`id_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`))) left join `kampane_2`.`infotestmail` on((`kampane_2`.`infotestmail`.`id_infotestmail` = `kampane_2`.`kampan`.`id_infotestmail_FK`))) where ((`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 35) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 36)) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_odpovedi
-- ----------------------------
DROP VIEW IF EXISTS `v_odpovedi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_odpovedi` AS select `tester_2`.`odpovedi`.`id_odpovedi` AS `id_odpovedi`,`tester_2`.`odpovedi`.`id_pozadavek_fk` AS `id_pozadavek_FK`,`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` AS `pozadavek_id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `vzb_id_vzb_osoba_kampan`,`kampane_2`.`kampan`.`id_kampan` AS `id_kampan`,`kampane_2`.`kampan`.`kampan_nazev` AS `kampan_nazev`,`kampane_2`.`infotestmail`.`test_nazev` AS `test_nazev`,`kampane_2`.`infotestmail`.`test_jmeno_souboru` AS `test_jmeno_souboru`,`kampane_2`.`osoba`.`id_osoba` AS `osoba_id_osoba`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51` from ((((((`tester_2`.`odpovedi` left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`id_pozadavek` = `tester_2`.`odpovedi`.`id_pozadavek_fk`))) left join `kampane_2`.`vzb_osoba_kampan` on((`kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` = `tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan`))) left join `kampane_2`.`kampan` on((`kampane_2`.`kampan`.`id_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`))) left join `kampane_2`.`infotestmail` on((`kampane_2`.`infotestmail`.`id_infotestmail` = `kampane_2`.`kampan`.`id_infotestmail_FK`))) left join `kampane_2`.`osoba` on((`kampane_2`.`osoba`.`id_osoba` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`osoba`.`id_osoba`)));

-- ----------------------------
-- View structure for v_odpovedi_testutrost___z_testeru
-- ----------------------------
DROP VIEW IF EXISTS `v_odpovedi_testutrost___z_testeru`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_odpovedi_testutrost___z_testeru` AS select `kampane`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane`.`osoba_central`.`jmeno` AS `jmeno`,`kampane`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane`.`osoba_central`.`prihl_jmeno` AS `prihl_jmeno`,`kampane`.`osoba_central`.`identifikace` AS `identifikace`,`tester`.`os`.`id_os` AS `tester_os_id_os`,`tester`.`os`.`identifikace` AS `tester_os_identifikace`,`tester`.`os`.`otisk` AS `tester_os_otisk__zacal_si_s_testem`,`tester`.`odpovedi`.`uloha01` AS `uloha01`,`tester`.`odpovedi`.`uloha02` AS `uloha02`,`tester`.`odpovedi`.`uloha03` AS `uloha03`,`tester`.`odpovedi`.`uloha04` AS `uloha04`,`tester`.`odpovedi`.`uloha05` AS `uloha05`,`tester`.`odpovedi`.`uloha06` AS `uloha06`,`tester`.`odpovedi`.`uloha07` AS `uloha07`,`tester`.`odpovedi`.`uloha08` AS `uloha08`,`tester`.`odpovedi`.`uloha09` AS `uloha09`,`tester`.`odpovedi`.`uloha10` AS `uloha10`,`tester`.`odpovedi`.`uloha11` AS `uloha11`,`tester`.`odpovedi`.`uloha12` AS `uloha12`,`tester`.`odpovedi`.`uloha13` AS `uloha13`,`tester`.`odpovedi`.`uloha14` AS `uloha14`,`tester`.`odpovedi`.`uloha15` AS `uloha15`,`tester`.`odpovedi`.`uloha16` AS `uloha16`,`tester`.`odpovedi`.`uloha17` AS `uloha17`,`tester`.`odpovedi`.`uloha18` AS `uloha18` from ((((`tester`.`odpovedi` left join `tester`.`os` on((`tester`.`os`.`id_os` = `tester`.`odpovedi`.`id_os_FK`))) left join `kampane`.`osoba_central` on((`kampane`.`osoba_central`.`identifikace` = `tester`.`os`.`identifikace`))) left join `kampane`.`osoba` on((`kampane`.`osoba`.`id_osoba` = `kampane`.`osoba_central`.`id_osoba_FK`))) left join `kampane`.`vzb_osoba_kampan` on((`kampane`.`vzb_osoba_kampan`.`id_osoba_FK` = `kampane`.`osoba`.`id_osoba`))) where ((`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 3) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 4) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 5) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 6) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 7) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 8));

-- ----------------------------
-- View structure for v_prubeh_odpovedi_eissmann_31_32
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_eissmann_31_32`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_eissmann_31_32` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where ((`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 31) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 32) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 2)) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_prubeh_odpovedi_projektsjazyky_33_34
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_projektsjazyky_33_34`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_projektsjazyky_33_34` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`id_odpovedi` AS `id_odpovedi`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where ((`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 33) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 34)) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_prubeh_odpovedi_projektsjazyky_35_36
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_projektsjazyky_35_36`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_projektsjazyky_35_36` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`id_odpovedi` AS `id_odpovedi`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where ((`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 35) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 36)) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_prubeh_odpovedi_rip_39
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_rip_39`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_rip_39` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`id_odpovedi` AS `id_odpovedi`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 39) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_prubeh_odpovedi_rip_40
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_rip_40`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_rip_40` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`id_odpovedi` AS `id_odpovedi`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 40) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_prubeh_odpovedi_stock
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_stock`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_stock` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where ((`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 29) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 30) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 2)) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_prubeh_odpovedi_vkampani_mde
-- ----------------------------
DROP VIEW IF EXISTS `v_prubeh_odpovedi_vkampani_mde`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_prubeh_odpovedi_vkampani_mde` AS select `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK` AS `id_osoba_FK`,`kampane_2`.`vzb_osoba_kampan`.`datumcas_odeslani` AS `datumcas_odeslani`,`kampane_2`.`osoba_central`.`jmeno` AS `jmeno`,`kampane_2`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane_2`.`osoba_central`.`mail` AS `mail`,`tester_2`.`pozadavek`.`id_pozadavek` AS `id_pozadavek`,`tester_2`.`pozadavek`.`otisk` AS `tester_pozadavek_otisk_zacal_si_s_testem`,`tester_2`.`pozadavek`.`inserted` AS `pozadavek_inserted`,`tester_2`.`odpovedi`.`inserted` AS `odpovedi_inserted`,`tester_2`.`odpovedi`.`uloha01` AS `uloha01`,`tester_2`.`odpovedi`.`uloha02` AS `uloha02`,`tester_2`.`odpovedi`.`uloha03` AS `uloha03`,`tester_2`.`odpovedi`.`uloha04` AS `uloha04`,`tester_2`.`odpovedi`.`uloha05` AS `uloha05`,`tester_2`.`odpovedi`.`uloha06` AS `uloha06`,`tester_2`.`odpovedi`.`uloha07` AS `uloha07`,`tester_2`.`odpovedi`.`uloha08` AS `uloha08`,`tester_2`.`odpovedi`.`uloha09` AS `uloha09`,`tester_2`.`odpovedi`.`uloha10` AS `uloha10`,`tester_2`.`odpovedi`.`uloha11` AS `uloha11`,`tester_2`.`odpovedi`.`uloha12` AS `uloha12`,`tester_2`.`odpovedi`.`uloha13` AS `uloha13`,`tester_2`.`odpovedi`.`uloha14` AS `uloha14`,`tester_2`.`odpovedi`.`uloha15` AS `uloha15`,`tester_2`.`odpovedi`.`uloha16` AS `uloha16`,`tester_2`.`odpovedi`.`uloha17` AS `uloha17`,`tester_2`.`odpovedi`.`uloha18` AS `uloha18`,`tester_2`.`odpovedi`.`uloha19` AS `uloha19`,`tester_2`.`odpovedi`.`uloha20` AS `uloha20`,`tester_2`.`odpovedi`.`uloha21` AS `uloha21`,`tester_2`.`odpovedi`.`uloha22` AS `uloha22`,`tester_2`.`odpovedi`.`uloha23` AS `uloha23`,`tester_2`.`odpovedi`.`uloha24` AS `uloha24`,`tester_2`.`odpovedi`.`uloha25` AS `uloha25`,`tester_2`.`odpovedi`.`uloha26` AS `uloha26`,`tester_2`.`odpovedi`.`uloha27` AS `uloha27`,`tester_2`.`odpovedi`.`uloha28` AS `uloha28`,`tester_2`.`odpovedi`.`uloha29` AS `uloha29`,`tester_2`.`odpovedi`.`uloha30` AS `uloha30`,`tester_2`.`odpovedi`.`uloha31` AS `uloha31`,`tester_2`.`odpovedi`.`uloha32` AS `uloha32`,`tester_2`.`odpovedi`.`uloha33` AS `uloha33`,`tester_2`.`odpovedi`.`uloha34` AS `uloha34`,`tester_2`.`odpovedi`.`uloha35` AS `uloha35`,`tester_2`.`odpovedi`.`uloha36` AS `uloha36`,`tester_2`.`odpovedi`.`uloha37` AS `uloha37`,`tester_2`.`odpovedi`.`uloha38` AS `uloha38`,`tester_2`.`odpovedi`.`uloha39` AS `uloha39`,`tester_2`.`odpovedi`.`uloha40` AS `uloha40`,`tester_2`.`odpovedi`.`uloha41` AS `uloha41`,`tester_2`.`odpovedi`.`uloha42` AS `uloha42`,`tester_2`.`odpovedi`.`uloha43` AS `uloha43`,`tester_2`.`odpovedi`.`uloha44` AS `uloha44`,`tester_2`.`odpovedi`.`uloha45` AS `uloha45`,`tester_2`.`odpovedi`.`uloha46` AS `uloha46`,`tester_2`.`odpovedi`.`uloha47` AS `uloha47`,`tester_2`.`odpovedi`.`uloha48` AS `uloha48`,`tester_2`.`odpovedi`.`uloha49` AS `uloha49`,`tester_2`.`odpovedi`.`uloha50` AS `uloha50`,`tester_2`.`odpovedi`.`uloha51` AS `uloha51`,`kampane_2`.`vzb_osoba_kampan`.`pokus` AS `pokus` from (((`kampane_2`.`vzb_osoba_kampan` left join `kampane_2`.`osoba_central` on((`kampane_2`.`osoba_central`.`id_osoba_FK` = `kampane_2`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester_2`.`pozadavek` on((`tester_2`.`pozadavek`.`kampane_id_vzb_osoba_kampan` = `kampane_2`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan`))) left join `tester_2`.`odpovedi` on((`tester_2`.`odpovedi`.`id_pozadavek_fk` = `tester_2`.`pozadavek`.`id_pozadavek`))) where ((`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 9) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 10) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 11) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 12) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 13) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 14) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 15) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 16) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 17) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 18) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 19) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 20) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 21) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 22) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 23) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 24) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 25) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 26) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 27) or (`kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK` = 28)) order by `kampane_2`.`vzb_osoba_kampan`.`id_kampan_FK`,`kampane_2`.`osoba_central`.`prijmeni`;

-- ----------------------------
-- View structure for v_ucastnici_testutrost_a_odpovedi___z_kampane
-- ----------------------------
DROP VIEW IF EXISTS `v_ucastnici_testutrost_a_odpovedi___z_kampane`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_ucastnici_testutrost_a_odpovedi___z_kampane` AS select `kampane`.`vzb_osoba_kampan`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` AS `id_kampan_FK`,`kampane`.`osoba_central`.`jmeno` AS `jmeno`,`kampane`.`osoba_central`.`prijmeni` AS `prijmeni`,`kampane`.`osoba_central`.`prihl_jmeno` AS `prihl_jmeno`,`kampane`.`osoba_central`.`identifikace` AS `kampane_osoba_central_identifikace`,`tester`.`os`.`id_os` AS `tester_os_id_os`,`tester`.`os`.`identifikace` AS `tester_os_identifikace`,`tester`.`os`.`otisk` AS `tester_os_otisk_zacal_si_s_testem`,`tester`.`odpovedi`.`uloha01` AS `uloha01`,`tester`.`odpovedi`.`uloha02` AS `uloha02`,`tester`.`odpovedi`.`uloha03` AS `uloha03`,`tester`.`odpovedi`.`uloha04` AS `uloha04`,`tester`.`odpovedi`.`uloha05` AS `uloha05`,`tester`.`odpovedi`.`uloha06` AS `uloha06`,`tester`.`odpovedi`.`uloha07` AS `uloha07`,`tester`.`odpovedi`.`uloha08` AS `uloha08`,`tester`.`odpovedi`.`uloha09` AS `uloha09`,`tester`.`odpovedi`.`uloha10` AS `uloha10`,`tester`.`odpovedi`.`uloha11` AS `uloha11`,`tester`.`odpovedi`.`uloha12` AS `uloha12`,`tester`.`odpovedi`.`uloha13` AS `uloha13`,`tester`.`odpovedi`.`uloha14` AS `uloha14`,`tester`.`odpovedi`.`uloha15` AS `uloha15`,`tester`.`odpovedi`.`uloha16` AS `uloha16`,`tester`.`odpovedi`.`uloha17` AS `uloha17`,`tester`.`odpovedi`.`uloha18` AS `uloha18` from (((`kampane`.`vzb_osoba_kampan` left join `kampane`.`osoba_central` on((`kampane`.`osoba_central`.`id_osoba_FK` = `kampane`.`vzb_osoba_kampan`.`id_osoba_FK`))) left join `tester`.`os` on((`tester`.`os`.`identifikace` = `kampane`.`osoba_central`.`identifikace`))) left join `tester`.`odpovedi` on((`tester`.`odpovedi`.`id_os_FK` = `tester`.`os`.`id_os`))) where ((`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 3) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 4) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 5) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 6) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 7) or (`kampane`.`vzb_osoba_kampan`.`id_kampan_FK` = 8));

-- ----------------------------
-- View structure for view_kampane_2
-- ----------------------------
DROP VIEW IF EXISTS `view_kampane_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kampane_2` AS select `vzb`.`id_vzb_osoba_kampan` AS `id_vzb_osoba_kampan`,`vzb`.`id_kampan_FK` AS `id_kampan_FK`,`vzb`.`id_osoba_FK` AS `id_osoba_FK`,`vzb`.`datumcas_odeslani` AS `datumcas_odeslani`,`kamp`.`kampan_nazev` AS `kampan_nazev`,`kamp`.`kampan_datum` AS `kampan_datum`,`kamp`.`kampan_popis` AS `kampan_popis`,`osoba_centr`.`prijmeni` AS `prijmeni`,`osoba_centr`.`jmeno` AS `jmeno`,`info`.`test_nazev` AS `test_nazev`,`info`.`test_jmeno_souboru` AS `test_jmeno_souboru`,`zakaz`.`zakaznik_nazev` AS `zakaznik_nazev` from (((((`kampane_2`.`vzb_osoba_kampan` `vzb` left join `kampane_2`.`kampan` `kamp` on((`kamp`.`id_kampan` = `vzb`.`id_kampan_FK`))) left join `kampane_2`.`infotestmail` `info` on((`info`.`id_infotestmail` = `kamp`.`id_infotestmail_FK`))) left join `kampane_2`.`zakaznik` `zakaz` on((`zakaz`.`id_zakaznik` = `info`.`id_zakaznik_FK`))) left join `kampane_2`.`osoba` on((`kampane_2`.`osoba`.`id_osoba` = `vzb`.`id_osoba_FK`))) left join `kampane_2`.`osoba_central` `osoba_centr` on((`osoba_centr`.`id_osoba_FK` = `kampane_2`.`osoba`.`id_osoba`))) where (`kamp`.`aktivni` = 1) order by `kamp`.`id_kampan`,`zakaz`.`id_zakaznik`;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `konfigurace_testu` (`uid_konfigurace_testu`, `popis_testu`, `nazev_testu`, `paralel_v_session_spustitelny`, `id_sada_otazek_fk`, `valid`) VALUES ('5aba2c1fe2c87', 'Svobodova oprava databáze', 'Anglický test - objektový', '0', '1', '0');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('1', '625', null, '2018-12-10 13:34:33');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('2', '626', null, '2018-12-11 11:39:21');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('3', '627', null, '2018-12-11 13:03:55');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('4', '628', null, '2018-12-11 13:11:25');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('5', '629', null, '2018-12-11 14:10:11');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('6', '630', null, '2018-12-11 14:10:28');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('7', '631', null, '2018-12-11 14:14:23');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('8', '632', null, '2018-12-11 14:15:54');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('9', '633', null, '2018-12-11 14:16:49');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('10', '634', null, '2018-12-11 14:31:05');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('11', '635', null, '2018-12-11 14:50:10');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('12', '636', null, '2018-12-11 14:55:16');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('13', '637', null, '2018-12-11 14:57:45');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('14', '639', null, '2018-12-11 15:00:08');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('15', '641', null, '2018-12-11 15:11:38');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('16', '642', null, '2018-12-11 15:18:07');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('17', '643', null, '2018-12-11 15:33:16');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('18', '644', null, '2018-12-11 15:33:39');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('19', '645', null, '2018-12-11 15:50:08');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('20', '646', null, '2018-12-11 15:54:42');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('21', '647', null, '2018-12-11 15:55:55');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('22', '648', null, '2018-12-12 10:40:17');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('23', '649', null, '2018-12-12 12:11:36');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('24', '650', null, '2018-12-12 12:58:28');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('25', '651', null, '2018-12-12 12:59:56');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('26', '652', null, '2018-12-12 13:47:53');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('27', '653', null, '2018-12-12 13:55:41');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('28', '654', null, '2018-12-12 14:25:58');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('29', '656', null, '2018-12-12 15:24:57');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('30', '657', null, '2018-12-12 15:31:14');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('31', '658', null, '2018-12-12 15:36:23');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('32', '660', null, '2018-12-12 15:52:38');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('33', '660', null, '2018-12-12 15:56:42');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('34', '660', null, '2018-12-12 16:54:06');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('35', '661', null, '2018-12-13 14:10:29');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('36', '662', null, '2018-12-13 14:12:24');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('37', '663', null, '2018-12-13 14:15:17');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('38', '664', null, '2018-12-13 14:28:18');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('39', '664', null, '2018-12-13 14:28:28');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('40', '664', null, '2018-12-13 15:02:40');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('41', '664', null, '2018-12-13 15:02:47');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('42', '664', null, '2018-12-13 15:02:58');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('43', '667', null, '2018-12-13 16:24:37');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('44', '668', null, '2018-12-13 16:49:19');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('45', '669', null, '2018-12-13 16:53:16');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('46', '683', null, '2018-12-14 14:59:46');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('47', '685', null, '2018-12-14 16:30:24');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('48', '686', null, '2018-12-14 16:36:41');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('49', '687', null, '2018-12-14 17:00:15');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('50', '688', null, '2018-12-17 09:00:28');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('51', '689', null, '2018-12-17 15:00:53');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('52', '690', null, '2018-12-17 16:49:44');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('53', '694', null, '2018-12-17 17:11:49');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('54', '712', null, '2018-12-18 15:37:41');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('55', '713', null, '2018-12-18 16:02:40');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('56', '721', null, '2018-12-19 09:29:00');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('57', '722', null, '2018-12-19 09:30:28');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('58', '723', null, '2018-12-19 09:36:10');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('59', '728', null, '2018-12-19 11:51:52');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('60', '729', null, '2018-12-19 12:01:08');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('61', '730', null, '2018-12-19 12:21:18');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('62', '731', null, '2018-12-19 12:26:31');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('63', '733', null, '2018-12-19 15:57:51');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('64', '734', null, '2018-12-19 15:59:33');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('65', '735', null, '2018-12-19 16:07:30');
INSERT INTO `odpoved` (`id_odpoved`, `id_prubeh_testu_fk`, `stav_tabbedu`, `inserted`) VALUES ('66', '751', null, '2019-01-14 11:56:10');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('1', '626', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('2', '626', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('3', '626', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('4', '626', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('5', '626', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('6', '627', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('7', '627', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('8', '627', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('9', '627', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('10', '627', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('11', '628', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('12', '628', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('13', '628', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('14', '628', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('15', '628', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('16', '629', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('17', '629', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('18', '629', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('19', '629', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('20', '629', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('21', '630', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('22', '630', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('23', '630', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('24', '630', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('25', '630', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('26', '631', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('27', '631', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('28', '631', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('29', '631', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('30', '631', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('31', '632', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('32', '632', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('33', '632', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('34', '632', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('35', '632', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('36', '633', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('37', '633', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('38', '633', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('39', '633', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('40', '633', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('41', '634', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('42', '634', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('43', '634', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('44', '634', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('45', '634', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('46', '635', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('47', '635', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('48', '635', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('49', '635', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('50', '635', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('51', '636', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('52', '636', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('53', '636', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('54', '636', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('55', '636', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('56', '637', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('57', '637', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('58', '637', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('59', '637', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('60', '637', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('61', '639', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('62', '639', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('63', '639', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('64', '639', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('65', '639', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('66', '641', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('67', '641', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('68', '641', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('69', '641', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('70', '641', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('71', '642', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('72', '642', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('73', '642', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('74', '642', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('75', '642', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('76', '643', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('77', '643', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('78', '643', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('79', '643', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('80', '643', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('81', '644', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('82', '644', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('83', '644', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('84', '644', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('85', '644', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('86', '645', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('87', '645', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('88', '645', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('89', '645', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('90', '645', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('91', '646', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('92', '646', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('93', '646', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('94', '646', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('95', '646', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('96', '647', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('97', '647', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('98', '647', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('99', '647', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('100', '647', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('101', '648', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('102', '648', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('103', '648', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('104', '648', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('105', '648', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('106', '649', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('107', '649', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('108', '649', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('109', '649', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('110', '649', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('111', '650', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('112', '650', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('113', '650', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('114', '650', '4', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('115', '650', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('116', '651', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('117', '651', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('118', '651', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('119', '651', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('120', '651', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('121', '652', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('122', '652', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('123', '652', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('124', '652', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('125', '652', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('126', '653', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('127', '653', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('128', '653', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('129', '653', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('130', '653', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('131', '654', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('132', '654', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('133', '654', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('134', '654', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('135', '654', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('136', '656', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('137', '656', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('138', '656', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('139', '656', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('140', '656', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('141', '657', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('142', '657', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('143', '657', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('144', '657', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('145', '657', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('146', '658', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('147', '658', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('148', '658', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('149', '658', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('150', '658', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('151', '660', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('152', '660', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('153', '660', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('154', '660', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('155', '660', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('156', '660', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('157', '660', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('158', '660', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('159', '660', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('160', '660', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('161', '660', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('162', '660', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('163', '660', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('164', '660', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('165', '660', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('166', '661', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('167', '661', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('168', '661', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('169', '661', '4', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('170', '661', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('171', '662', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('172', '662', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('173', '662', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('174', '662', '4', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('175', '662', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('176', '663', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('177', '663', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('178', '663', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('179', '663', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('180', '663', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('181', '664', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('182', '664', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('183', '664', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('184', '664', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('185', '664', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('186', '664', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('187', '664', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('188', '664', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('189', '664', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('190', '664', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('191', '664', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('192', '664', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('193', '664', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('194', '664', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('195', '664', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('196', '664', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('197', '664', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('198', '664', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('199', '664', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('200', '664', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('201', '664', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('202', '664', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('203', '664', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('204', '664', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('205', '664', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('206', '667', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('207', '667', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('208', '667', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('209', '667', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('210', '667', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('211', '668', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('212', '668', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('213', '668', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('214', '668', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('215', '668', '5', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('216', '669', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('217', '669', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('218', '669', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('219', '669', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('220', '669', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('221', '683', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('222', '683', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('223', '683', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('224', '683', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('225', '683', '5', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('226', '685', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('227', '685', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('228', '685', '1', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('229', '685', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('230', '685', '5', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('231', '686', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('232', '686', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('233', '686', '1', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('234', '686', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('235', '686', '5', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('236', '687', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('237', '687', '12', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('238', '687', '1', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('239', '687', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('240', '687', '5', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('241', '688', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('242', '688', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('243', '688', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('244', '688', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('245', '688', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('246', '689', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('247', '689', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('248', '689', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('249', '689', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('250', '689', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('251', '690', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('252', '690', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('253', '690', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('254', '690', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('255', '690', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('256', '694', '11', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('257', '694', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('258', '694', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('259', '694', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('260', '694', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('261', '712', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('262', '712', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('263', '712', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('264', '712', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('265', '712', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('266', '713', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('267', '713', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('268', '713', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('269', '713', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('270', '713', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('271', '721', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('272', '721', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('273', '721', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('274', '721', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('275', '721', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('276', '722', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('277', '722', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('278', '722', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('279', '722', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('280', '722', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('281', '723', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('282', '723', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('283', '723', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('284', '723', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('285', '723', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('286', '728', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('287', '728', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('288', '728', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('289', '728', '4', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('290', '728', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('291', '729', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('292', '729', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('293', '729', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('294', '729', '4', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('295', '729', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('296', '730', '11', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('297', '730', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('298', '730', '1', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('299', '730', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('300', '730', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('301', '731', '11', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('302', '731', '12', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('303', '731', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('304', '731', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('305', '731', '5', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('306', '733', '11', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('307', '733', '12', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('308', '733', '1', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('309', '733', '4', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('310', '733', '5', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('311', '734', '11', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('312', '734', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('313', '734', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('314', '734', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('315', '734', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('316', '735', '11', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('317', '735', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('318', '735', '1', '3');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('319', '735', '4', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('320', '735', '5', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('321', '751', '11', '1');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('322', '751', '12', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('323', '751', '1', '4');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('324', '751', '4', '2');
INSERT INTO `odpoved_na_otazku` (`id_odpoved_na_otazku`, `id_prubeh_testu_fk`, `identifikator_odpovedi`, `hodnota`) VALUES ('325', '751', '5', '4');
INSERT INTO `pozadavek` (`id_pozadavek`, `id_request`, `kampane_id_vzb_osoba_kampan`, `otisk`, `identifikace_nepotrebnysloupes`, `inserted`) VALUES ('1', '10', '1279', 'rhkla3gk41rujjcmr7vbio3tfa', '', '2019-01-18 13:54:43');
INSERT INTO `pozadavek` (`id_pozadavek`, `id_request`, `kampane_id_vzb_osoba_kampan`, `otisk`, `identifikace_nepotrebnysloupes`, `inserted`) VALUES ('2', '11', '1279', 'ij4kohlu2m8juss67ve288452e', '', '2019-01-18 14:51:08');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('611', '1544106777', '5aba2c1fe2c87', '2018-12-06 15:32:58', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('612', '1544110889', '5aba2c1fe2c87', '2018-12-06 16:41:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('613', '1544170953', '5aba2c1fe2c87', '2018-12-07 09:22:38', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('614', '1544177603', '5aba2c1fe2c87', '2018-12-07 11:13:25', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('615', '1544178010', '5aba2c1fe2c87', '2018-12-07 11:20:12', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('616', '1544177694', '5aba2c1fe2c87', '2018-12-07 11:57:27', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('617', '1544191209', '5aba2c1fe2c87', '2018-12-07 15:00:11', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('618', '1544191432', '5aba2c1fe2c87', '2018-12-07 15:04:00', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('619', '1544191648', '5aba2c1fe2c87', '2018-12-07 15:07:30', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('620', '1544193444', '5aba2c1fe2c87', '2018-12-07 15:37:26', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('621', '1544198600', '5aba2c1fe2c87', '2018-12-07 17:03:23', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('622', '1544437988', '5aba2c1fe2c87', '2018-12-10 11:33:42', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('623', '1544444115', '5aba2c1fe2c87', '2018-12-10 13:15:18', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('624', '1544444261', '5aba2c1fe2c87', '2018-12-10 13:17:43', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('625', '1544445270', '5aba2c1fe2c87', '2018-12-10 13:34:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('626', '1544524742', '5aba2c1fe2c87', '2018-12-11 11:39:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('627', '1544529829', '5aba2c1fe2c87', '2018-12-11 13:03:53', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('628', '1544530281', '5aba2c1fe2c87', '2018-12-11 13:11:23', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('629', '1544533806', '5aba2c1fe2c87', '2018-12-11 14:10:07', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('630', '1544533824', '5aba2c1fe2c87', '2018-12-11 14:10:26', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('631', '1544534058', '5aba2c1fe2c87', '2018-12-11 14:14:20', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('632', '1544534150', '5aba2c1fe2c87', '2018-12-11 14:15:52', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('633', '1544534184', '5aba2c1fe2c87', '2018-12-11 14:16:26', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('634', '1544535062', '5aba2c1fe2c87', '2018-12-11 14:31:03', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('635', '1544536207', '5aba2c1fe2c87', '2018-12-11 14:50:08', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('636', '1544536513', '5aba2c1fe2c87', '2018-12-11 14:55:15', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('637', '1544536661', '5aba2c1fe2c87', '2018-12-11 14:57:43', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('638', '1544536681', '5aba2c1fe2c87', '2018-12-11 14:58:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('639', '1544536804', '5aba2c1fe2c87', '2018-12-11 15:00:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('640', '1544537269', '5aba2c1fe2c87', '2018-12-11 15:07:51', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('641', '1544537494', '5aba2c1fe2c87', '2018-12-11 15:11:36', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('642', '1544537694', '5aba2c1fe2c87', '2018-12-11 15:17:13', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('643', '1544538793', '5aba2c1fe2c87', '2018-12-11 15:33:14', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('644', '1544538815', '5aba2c1fe2c87', '2018-12-11 15:33:38', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('645', '1544539801', '5aba2c1fe2c87', '2018-12-11 15:50:03', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('646', '1544540079', '5aba2c1fe2c87', '2018-12-11 15:54:41', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('647', '1544540152', '5aba2c1fe2c87', '2018-12-11 15:55:53', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('648', '1544607585', '5aba2c1fe2c87', '2018-12-12 10:39:50', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('649', '1544613090', '5aba2c1fe2c87', '2018-12-12 12:11:34', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('650', '1544615905', '5aba2c1fe2c87', '2018-12-12 12:58:26', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('651', '1544615934', '5aba2c1fe2c87', '2018-12-12 12:59:00', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('652', '1544618837', '5aba2c1fe2c87', '2018-12-12 13:47:18', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('653', '1544619337', '5aba2c1fe2c87', '2018-12-12 13:55:39', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('654', '1544621084', '5aba2c1fe2c87', '2018-12-12 14:24:56', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('655', '1544621930', '5aba2c1fe2c87', '2018-12-12 14:48:24', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('656', '1544624693', '5aba2c1fe2c87', '2018-12-12 15:24:55', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('657', '1544625069', '5aba2c1fe2c87', '2018-12-12 15:31:12', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('658', '1544625380', '5aba2c1fe2c87', '2018-12-12 15:36:21', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('659', '1544626114', '5aba2c1fe2c87', '2018-12-12 15:48:36', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('660', '1544626347', '5aba2c1fe2c87', '2018-12-12 15:52:29', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('661', '1544706577', '5aba2c1fe2c87', '2018-12-13 14:09:45', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('662', '1544706740', '5aba2c1fe2c87', '2018-12-13 14:12:22', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('663', '1544706852', '5aba2c1fe2c87', '2018-12-13 14:14:14', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('664', '1544707076', '5aba2c1fe2c87', '2018-12-13 14:17:59', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('665', '1544714514', '5aba2c1fe2c87', '2018-12-13 16:21:55', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('666', '1544714609', '5aba2c1fe2c87', '2018-12-13 16:23:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('667', '1544714667', '5aba2c1fe2c87', '2018-12-13 16:24:29', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('668', '1544716148', '5aba2c1fe2c87', '2018-12-13 16:49:10', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('669', '1544716369', '5aba2c1fe2c87', '2018-12-13 16:52:51', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('670', '1544717281', '5aba2c1fe2c87', '2018-12-13 17:08:04', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('671', '1544717385', '5aba2c1fe2c87', '2018-12-13 17:09:46', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('672', '1544771256', '5aba2c1fe2c87', '2018-12-14 08:07:42', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('673', '1544772310', '5aba2c1fe2c87', '2018-12-14 08:25:12', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('674', '1544779880', '5aba2c1fe2c87', '2018-12-14 10:32:50', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('675', '1544782607', '5aba2c1fe2c87', '2018-12-14 11:16:48', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('676', '1544783703', '5aba2c1fe2c87', '2018-12-14 11:35:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('677', '1544787812', '5aba2c1fe2c87', '2018-12-14 12:43:37', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('678', '1544788046', '5aba2c1fe2c87', '2018-12-14 12:47:27', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('679', '1544790337', '5aba2c1fe2c87', '2018-12-14 13:25:38', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('680', '1544790457', '5aba2c1fe2c87', '2018-12-14 13:27:38', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('681', '1544790987', '5aba2c1fe2c87', '2018-12-14 13:36:29', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('682', '1544791061', '5aba2c1fe2c87', '2018-12-14 13:37:43', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('683', '1544795962', '5aba2c1fe2c87', '2018-12-14 14:59:23', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('684', '1544798692', '5aba2c1fe2c87', '2018-12-14 15:44:54', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('685', '1544801405', '5aba2c1fe2c87', '2018-12-14 16:30:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('686', '1544801501', '5aba2c1fe2c87', '2018-12-14 16:31:42', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('687', '1544803211', '5aba2c1fe2c87', '2018-12-14 17:00:13', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('688', '1545033586', '5aba2c1fe2c87', '2018-12-17 08:59:52', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('689', '1545055239', '5aba2c1fe2c87', '2018-12-17 15:00:43', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('690', '1545061774', '5aba2c1fe2c87', '2018-12-17 16:49:37', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('691', '1545061844', '5aba2c1fe2c87', '2018-12-17 16:50:49', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('692', '1545062341', '5aba2c1fe2c87', '2018-12-17 16:59:03', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('693', '1545062366', '5aba2c1fe2c87', '2018-12-17 16:59:27', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('694', '1545062449', '5aba2c1fe2c87', '2018-12-17 17:00:50', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('695', '1545127453', '5aba2c1fe2c87', '2018-12-18 11:06:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('696', '1545132053', '5aba2c1fe2c87', '2018-12-18 12:20:59', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('697', '1545132876', '5aba2c1fe2c87', '2018-12-18 12:34:38', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('698', '1545133058', '5aba2c1fe2c87', '2018-12-18 12:37:43', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('699', '1545133489', '5aba2c1fe2c87', '2018-12-18 12:44:58', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('700', '1545133834', '5aba2c1fe2c87', '2018-12-18 12:50:39', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('701', '1545133917', '5aba2c1fe2c87', '2018-12-18 12:52:05', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('702', '1545134012', '5aba2c1fe2c87', '2018-12-18 12:53:38', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('703', '1545136454', '5aba2c1fe2c87', '2018-12-18 13:46:42', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('704', '1545137264', '5aba2c1fe2c87', '2018-12-18 13:47:54', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('705', '1545137437', '5aba2c1fe2c87', '2018-12-18 13:51:52', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('706', '1545137642', '5aba2c1fe2c87', '2018-12-18 13:54:13', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('707', '1545137735', '5aba2c1fe2c87', '2018-12-18 13:55:41', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('708', '1545138209', '5aba2c1fe2c87', '2018-12-18 14:03:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('709', '1545138481', '5aba2c1fe2c87', '2018-12-18 14:08:03', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('710', '1545138693', '5aba2c1fe2c87', '2018-12-18 14:11:35', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('711', '1545138795', '5aba2c1fe2c87', '2018-12-18 14:13:17', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('712', '1545140002', '5aba2c1fe2c87', '2018-12-18 14:33:24', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('713', '1545145349', '5aba2c1fe2c87', '2018-12-18 16:02:31', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('714', '1545145443', '5aba2c1fe2c87', '2018-12-18 16:04:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('715', '1545145845', '5aba2c1fe2c87', '2018-12-18 16:10:54', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('716', '1545145905', '5aba2c1fe2c87', '2018-12-18 16:11:48', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('717', '1545146360', '5aba2c1fe2c87', '2018-12-18 16:19:22', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('718', '1545146757', '5aba2c1fe2c87', '2018-12-18 16:25:59', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('719', '1545203943', '5aba2c1fe2c87', '2018-12-19 08:19:08', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('720', '1545204311', '5aba2c1fe2c87', '2018-12-19 08:25:12', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('721', '1545204548', '5aba2c1fe2c87', '2018-12-19 08:29:10', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('722', '1545208223', '5aba2c1fe2c87', '2018-12-19 09:30:25', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('723', '1545208565', '5aba2c1fe2c87', '2018-12-19 09:36:07', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('724', '1545209255', '5aba2c1fe2c87', '2018-12-19 09:48:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('725', '1545214779', '5aba2c1fe2c87', '2018-12-19 11:19:41', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('726', '1545215161', '5aba2c1fe2c87', '2018-12-19 11:26:06', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('727', '1545215744', '5aba2c1fe2c87', '2018-12-19 11:35:53', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('728', '1545216680', '5aba2c1fe2c87', '2018-12-19 11:51:21', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('729', '1545217264', '5aba2c1fe2c87', '2018-12-19 12:01:05', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('730', '1545218457', '5aba2c1fe2c87', '2018-12-19 12:20:59', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('731', '1545218765', '5aba2c1fe2c87', '2018-12-19 12:26:08', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('732', '1545231436', '5aba2c1fe2c87', '2018-12-19 15:57:19', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('733', '1545231464', '5aba2c1fe2c87', '2018-12-19 15:57:47', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('734', '1545231529', '5aba2c1fe2c87', '2018-12-19 15:58:52', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('735', '1545232045', '5aba2c1fe2c87', '2018-12-19 16:07:27', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('736', '1545312516', '5aba2c1fe2c87', '2018-12-20 14:28:44', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('737', '1546526924', '5aba2c1fe2c87', '2019-01-03 15:48:50', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('738', '1546599660', '5aba2c1fe2c87', '2019-01-04 12:01:05', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('739', '1547134980', '5aba2c1fe2c87', '2019-01-10 16:43:30', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('740', '1547135035', '5aba2c1fe2c87', '2019-01-10 16:43:57', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('741', '1547135050', '5aba2c1fe2c87', '2019-01-10 16:44:28', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('742', '1547135206', '5aba2c1fe2c87', '2019-01-10 16:47:07', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('743', '1547135244', '5aba2c1fe2c87', '2019-01-10 16:47:27', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('744', '1547135312', '5aba2c1fe2c87', '2019-01-10 16:48:33', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('745', '1547135329', '5aba2c1fe2c87', '2019-01-10 16:48:51', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('746', '1547135345', '5aba2c1fe2c87', '2019-01-10 16:49:07', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('747', '1547458915', '5aba2c1fe2c87', '2019-01-14 10:41:58', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('748', '1547462013', '5aba2c1fe2c87', '2019-01-14 11:33:36', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('749', '1547462075', '5aba2c1fe2c87', '2019-01-14 11:34:36', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('750', '1547462833', '5aba2c1fe2c87', '2019-01-14 11:47:15', 'Něco do pole navic2.');
INSERT INTO `prubeh_testu` (`id_prubeh_testu`, `identifikator_ticketu_fk`, `identifikator_konfigurace_testu_fk`, `cas_spusteni`, `pole_navic`) VALUES ('751', '1547463347', '5aba2c1fe2c87', '2019-01-14 11:55:49', 'Něco do pole navic2.');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('1', '1', '::1', '/Tester/Tester/Test1zN.php?test=1279', '1547816083,897', '::1', 'test=1279', null, '1279', '1279', '1', null, 'Je argument [identifikace]: 1279není v session [identifikace] ---> prvni spusteni v prohlizeci s argumentem', '2019-01-18 13:54:43', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('2', '1', '::1', '/Tester/Tester/Test1zN.php', '1547816323,659', '::1', null, '_qf__01=&uloha01=4&_qf_01_submit=Pokra%C4%8Dovat', null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:43', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('3', '1', '::1', '/Tester/Tester/Test1zN.php?_qf_02_display=true', '1547816323,797', '::1', '_qf_02_display=true', null, null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:43', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('4', '1', '::1', '/Tester/Tester/Test1zN.php', '1547816325,85', '::1', null, '_qf__02=&uloha02=4&_qf_02_submit=Pokra%C4%8Dovat', null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:45', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('5', '1', '::1', '/Tester/Tester/Test1zN.php?_qf_03_display=true', '1547816325,95', '::1', '_qf_03_display=true', null, null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:45', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('6', '1', '::1', '/Tester/Tester/Test1zN.php', '1547816328,358', '::1', null, '_qf__03=&_qf_03_51=51', null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:48', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('7', '1', '::1', '/Tester/Tester/Test1zN.php?_qf_51_display=true', '1547816328,427', '::1', '_qf_51_display=true', null, null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:48', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('8', '1', '::1', '/Tester/Tester/Test1zN.php', '1547816329,261', '::1', null, '_qf__51=&_qf_51_submit=Pokra%C4%8Dovat', null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:49', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('9', '1', '::1', '/Tester/Tester/Test1zN.php', '1547816333,462', '::1', null, '_qf__51=&uloha51=1&_qf_51_submit=Pokra%C4%8Dovat', null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:53', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('10', '1', '::1', '/Tester/Tester/Test1zN.php?_qf_03_display=true', '1547816333,54', '::1', '_qf_03_display=true', null, null, '1279', '1', null, 'Neni argument [identifikace] , ale je  v session [identifikace]: 1279 ---- tzn. uz sla runda kolem<br/>', '2019-01-18 13:58:53', '1279');
INSERT INTO `request` (`id_request`, `id_pozadavek_fk`, `ip`, `request_uri`, `request_time`, `remote_addr`, `query_string`, `input`, `get_identifikace`, `session_identifikace`, `kontrola_ok`, `die`, `debug`, `inserted`, `kampane_id_vzb_osoba_kampan`) VALUES ('11', '2', '::1', '/Tester/Tester/Test1zN.php?test=1279', '1547819468,136', '::1', 'test=1279', null, '1279', '1279', '1', null, 'Je argument [identifikace]: 1279není v session [identifikace] ---> prvni spusteni v prohlizeci s argumentem', '2019-01-18 14:51:08', '1279');
INSERT INTO `sada_otazek` (`id_sada_otazek`, `nazev_sady`) VALUES ('1', 'AJ_testovaci');
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544103682', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544104063', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544104488', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544105718', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544106777', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544110889', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544170953', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544177603', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544177694', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544178010', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544191209', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544191432', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544191648', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544193444', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544198600', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544437988', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544444115', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544444261', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544445270', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544524742', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544529829', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544530281', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544533806', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544533824', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544534058', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544534150', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544534184', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544535062', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544536207', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544536513', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544536661', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544536681', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544536804', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544537269', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544537494', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544537694', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544538793', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544538815', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544539801', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544540079', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544540152', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544607585', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544613090', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544615905', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544615934', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544618837', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544619337', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544621084', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544621930', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544624693', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544625069', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544625380', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544626114', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544626347', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544706577', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544706740', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544706852', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544707076', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544714514', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544714609', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544714667', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544716148', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544716369', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544717281', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544717385', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544771256', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544772310', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544779880', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544782607', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544783703', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544787812', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544788046', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544790337', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544790457', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544790987', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544791061', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544795962', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544798692', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544801405', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544801501', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1544803211', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545033586', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545055239', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545061774', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545061844', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545062341', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545062366', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545062449', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545127453', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545132053', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545132876', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545133058', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545133489', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545133834', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545133917', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545134012', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545136454', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545137264', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545137437', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545137642', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545137735', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545138209', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545138481', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545138693', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545138795', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545140002', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545145349', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545145443', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545145845', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545145905', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545146360', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545146757', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545203943', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545204311', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545204548', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545208223', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545208565', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545209255', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545214779', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545215161', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545215744', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545216680', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545217264', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545218457', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545218765', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545231436', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545231464', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545231529', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545232045', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1545312516', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1546526924', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1546599660', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547134980', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135035', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135050', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135206', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135244', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135312', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135329', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547135345', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547458915', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547462013', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547462075', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547462833', null);
INSERT INTO `ticket_pouzity` (`identifikator_ticketu`, `tmst`) VALUES ('1547463347', null);
