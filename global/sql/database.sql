--
-- Base de données :  `projetPHP`
--
CREATE DATABASE IF NOT EXISTS `projetPHP` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projetPHP`;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
`idMessage` smallint(2) unsigned NOT NULL,
  `dateMessage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `texteMessage` varchar(140) NOT NULL,
  `idUtilisateur` smallint(2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

DROP TABLE IF EXISTS `suivre`;
CREATE TABLE IF NOT EXISTS `suivre` (
  `idUtilisateurSuivi` smallint(2) unsigned NOT NULL DEFAULT '0',
  `idUtilisateurSuivant` smallint(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
`idUtilisateur` smallint(2) NOT NULL,
  `identifiantUtilisateur` varchar(16) NOT NULL,
  `emailUtilisateur` varchar(255) NOT NULL,
  `motDePasseUtilisateur` varchar(255) NOT NULL COMMENT 'crypté en sha1 + grain de sable',
  `numTelUtilisateur` varchar(16) DEFAULT NULL,
  `descriptionUtilisateur` varchar(255) DEFAULT NULL,
  `photoUtilisateur` varchar(16) DEFAULT NULL COMMENT 'adresse de la photo stockée en local',
  `dateNaissanceUtilisateur` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`idMessage`), ADD KEY `contrainte_messages_utilisateurs` (`idUtilisateur`);

--
-- Index pour la table `suivre`
--
ALTER TABLE `suivre`
 ADD PRIMARY KEY (`idUtilisateurSuivi`,`idUtilisateurSuivant`), ADD KEY `contrainte_suivre_utilisateurs2` (`idUtilisateurSuivant`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
 ADD PRIMARY KEY (`idUtilisateur`), ADD UNIQUE KEY `identifiantUtilisateur` (`identifiantUtilisateur`), ADD UNIQUE KEY `emailUtilisateur` (`emailUtilisateur`);