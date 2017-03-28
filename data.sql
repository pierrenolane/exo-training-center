-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Mars 2017 à 23:05
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fyprbqhq_perso`
--

--
-- Contenu de la table `f2000fr_trainingcenter_calendar_offday`
--

INSERT INTO `f2000fr_trainingcenter_calendar_offday` (`id`, `training_id`, `day`, `period`) VALUES
(6, 1, '2017-02-03 00:00:00', 2),
(9, 1, '2017-02-10 00:00:00', 2),
(8, 1, '2017-02-17 00:00:00', 2),
(10, 1, '2017-02-24 00:00:00', 2),
(11, 1, '2017-03-03 00:00:00', 2),
(12, 1, '2017-03-10 00:00:00', 2),
(13, 1, '2017-03-17 00:00:00', 2),
(14, 1, '2017-03-24 00:00:00', 2);

--
-- Contenu de la table `f2000fr_trainingcenter_calendar_tm`
--

INSERT INTO `f2000fr_trainingcenter_calendar_tm` (`id`, `training_module_id`, `day`, `period`) VALUES
(1, 1, '2017-01-30 00:00:00', 1),
(2, 2, '2017-01-30 00:00:00', 1),
(3, 3, '2017-01-30 00:00:00', 1),
(4, 4, '2017-01-30 00:00:00', 2),
(5, 5, '2017-01-30 00:00:00', 2),
(6, 6, '2017-01-31 00:00:00', 1),
(7, 7, '2017-01-31 00:00:00', 1),
(11, 7, '2017-02-01 00:00:00', 1),
(8, 8, '2017-01-31 00:00:00', 2),
(9, 9, '2017-02-01 00:00:00', 2),
(10, 10, '2017-02-01 00:00:00', 2),
(13, 11, '2017-02-02 00:00:00', 1),
(12, 11, '2017-02-02 00:00:00', 2),
(14, 11, '2017-02-03 00:00:00', 1),
(15, 12, '2017-02-07 00:00:00', 2),
(20, 12, '2017-02-08 00:00:00', 1),
(16, 13, '2017-02-06 00:00:00', 1),
(17, 14, '2017-02-06 00:00:00', 1),
(18, 14, '2017-02-06 00:00:00', 2),
(19, 14, '2017-02-07 00:00:00', 1),
(21, 15, '2017-02-08 00:00:00', 2),
(22, 16, '2017-02-09 00:00:00', 1),
(23, 17, '2017-02-09 00:00:00', 2),
(29, 17, '2017-02-10 00:00:00', 1),
(24, 18, '2017-02-13 00:00:00', 2),
(31, 18, '2017-02-14 00:00:00', 1),
(25, 19, '2017-02-14 00:00:00', 2),
(26, 20, '2017-02-14 00:00:00', 2),
(27, 21, '2017-02-15 00:00:00', 1),
(32, 21, '2017-02-15 00:00:00', 2),
(28, 22, '2017-02-16 00:00:00', 1),
(33, 22, '2017-02-16 00:00:00', 2),
(30, 23, '2017-02-13 00:00:00', 1),
(34, 24, '2017-02-17 00:00:00', 1),
(35, 25, '2017-02-17 00:00:00', 1),
(36, 26, '2017-02-17 00:00:00', 1),
(37, 27, '2017-02-17 00:00:00', 1),
(38, 28, '2017-02-20 00:00:00', 1),
(39, 29, '2017-02-20 00:00:00', 2),
(40, 30, '2017-02-21 00:00:00', 1),
(41, 31, '2017-02-21 00:00:00', 1),
(42, 32, '2017-02-21 00:00:00', 2),
(47, 33, '2017-02-21 00:00:00', 2),
(46, 33, '2017-02-22 00:00:00', 1),
(43, 33, '2017-02-22 00:00:00', 2),
(44, 33, '2017-02-23 00:00:00', 1),
(45, 33, '2017-02-23 00:00:00', 2),
(48, 34, '2017-02-24 00:00:00', 1),
(49, 35, '2017-02-24 00:00:00', 1),
(50, 36, '2017-02-24 00:00:00', 1),
(51, 37, '2017-02-24 00:00:00', 1),
(52, 38, '2017-02-27 00:00:00', 1),
(53, 39, '2017-02-27 00:00:00', 1),
(54, 40, '2017-02-27 00:00:00', 2),
(55, 41, '2017-02-27 00:00:00', 2),
(56, 42, '2017-02-28 00:00:00', 1),
(57, 43, '2017-02-28 00:00:00', 2),
(58, 44, '2017-03-01 00:00:00', 1),
(60, 44, '2017-03-01 00:00:00', 2),
(59, 45, '2017-03-02 00:00:00', 1),
(61, 45, '2017-03-02 00:00:00', 2),
(62, 46, '2017-03-03 00:00:00', 1),
(63, 47, '2017-03-06 00:00:00', 1),
(64, 47, '2017-03-06 00:00:00', 2),
(65, 47, '2017-03-07 00:00:00', 1),
(66, 47, '2017-03-07 00:00:00', 2),
(67, 47, '2017-03-08 00:00:00', 1),
(68, 47, '2017-03-08 00:00:00', 2),
(69, 47, '2017-03-09 00:00:00', 1),
(70, 47, '2017-03-09 00:00:00', 2),
(71, 47, '2017-03-10 00:00:00', 1),
(73, 47, '2017-03-13 00:00:00', 1),
(74, 47, '2017-03-13 00:00:00', 2),
(75, 47, '2017-03-14 00:00:00', 1),
(76, 47, '2017-03-14 00:00:00', 2),
(77, 47, '2017-03-15 00:00:00', 1),
(78, 47, '2017-03-15 00:00:00', 2),
(79, 47, '2017-03-16 00:00:00', 1),
(80, 47, '2017-03-16 00:00:00', 2),
(81, 47, '2017-03-17 00:00:00', 1),
(82, 47, '2017-03-20 00:00:00', 1),
(84, 47, '2017-03-20 00:00:00', 2),
(83, 47, '2017-03-21 00:00:00', 1),
(85, 47, '2017-03-21 00:00:00', 2),
(86, 47, '2017-03-22 00:00:00', 1),
(87, 47, '2017-03-22 00:00:00', 2),
(88, 47, '2017-03-23 00:00:00', 1),
(89, 47, '2017-03-23 00:00:00', 2),
(90, 47, '2017-03-24 00:00:00', 1),
(91, 47, '2017-03-27 00:00:00', 1),
(96, 47, '2017-03-27 00:00:00', 2),
(92, 47, '2017-03-28 00:00:00', 1),
(95, 47, '2017-03-28 00:00:00', 2),
(93, 47, '2017-03-29 00:00:00', 1),
(94, 47, '2017-03-29 00:00:00', 2);

--
-- Contenu de la table `f2000fr_trainingcenter_category`
--

INSERT INTO `f2000fr_trainingcenter_category` (`id`, `parent_id`, `name`) VALUES
(1, NULL, 'Formation'),
(2, NULL, 'Développement web'),
(3, 2, 'Général'),
(4, 2, 'Ergonomie'),
(5, 15, 'HTML'),
(6, 15, 'CSS'),
(7, 15, 'JS'),
(8, 15, 'PHP'),
(9, 15, 'SQL'),
(10, 15, 'PHP/SQL'),
(11, 2, 'Sécurité'),
(12, 2, 'Outils'),
(13, 2, 'Symfony'),
(14, 2, 'Méthodologie'),
(15, 2, 'Langages');

--
-- Contenu de la table `f2000fr_trainingcenter_exercice`
--

INSERT INTO `f2000fr_trainingcenter_exercice` (`id`, `module_id`, `reference`, `name`, `description`, `how_to`, `clue`) VALUES
(1, 1, 'EXO1', 'Présentation du groupe', 'Apprendre à se connaître par le dialogue', 'Discussion en binôme (20 min) et présentation oral de son collègue (5 min)\n-	Qui ? (prénom, âge)\n-	Ses passions ?\n-	Notions connues parmi : HTML, CSS, PHP, JS, SQL\n-	Parcours professionnel ?\n-	Pourquoi cette formation ?', NULL),
(2, 1, 'EXO2', 'Installation et configuration des postes', 'Installation des postes et des outils (Notepad++)', 'Découverte assistée\n-	Vérification poste\n-	Connexion internet \n-	Installation des logiciels', NULL),
(14, 5, 'EXO1', 'Réalisation d’un CV au format HTML', 'Découverte des outils (Notepad++) et réalisation d’exercices HTML', '- Réalisation d’un CV\n--> Découvrir le rendu sur plusieurs navigateurs\n--> Notion d’encodage\n\n- Réalisation d’un tableau', 'Balises utiles :  <img>, <hx>, <ul>, <li>, <a>, <table>, <tr>, <td>'),
(15, 6, 'EXO2', 'Réalisation d’une page au format HTML', 'Réalisation d’exercices HTML avancés', '- Basé sur la page des annonces du site « LeBonCoin »\n- Analyse puis réalisation du template de base (logo, menu, annonces, footer)', 'Vous pouvez définir une "bordure" sur tout les "div" afin d''y voir plus clair dans l''architecture de votre page.\nPour cela, rajoutez le code suivant dans la balise "<head>"\n<style>\ndiv {border: 1px solid black;}\n</style>'),
(16, 7, 'EXO1', 'Réalisation d’un CV au format HTML/CSS', 'Réalisation d’exercices HTML/CSS', '- Réalisation d''un CV au format HTML\n- Amélioration du CV via des règles CSS', NULL),
(17, 9, 'EXO1', 'Réalisation d’une page au format HTML/CSS', 'Réalisation d’exercices CSS avancés', '-	Réalisation d’une page complexe au format HTML\n-	Amélioration de la page via des règles CSS \n-	Visualisation du résultat sur différents navigateurs', 'Vous pouvez définir une "bordure" sur tout les "div" afin d''y voir plus clair dans l''architecture de votre page.\nAinsi que des couleurs d''arrière-plan pour distinguer les différents éléments de votre page.\n\nExemple :\n<style>\ndiv {border: 1px solid black;}\nheader {background: red;}\nfooter {background: yellow;}\n</style>'),
(18, 10, 'EXO1', 'Mise en page centrée en 2 colonnes, header et pied de page', 'Problématique : Mise en page centrée en 2 colonnes, header et pied de page', '<body>\n	<header>\n		<!-- Ceci est mon haut de page -->\n	</header>\n	<aside>\n		<!-- Ceci est ma colonne latérale -->\n	</aside>\n	<section>\n		<!-- Ceci est mon contenu principal -->\n		<h2>Mon titre</h2>\n	</section>\n	<footer>\n		<!-- Ceci est mon pied de page -->\n	</footer>\n<body>', 'Au moins trois solutions possibles :\n- absolute + marge\n- float + marge\n- float + float'),
(20, 12, 'EXO1', 'Réalisation d’une page responsive', 'Mise en pratique des media-queries', 'Pré-requis :\n-	Réalisation d’une page complexe au format HTML\n-	Amélioration via des règles CSS\n\nVersion responsive simple :\n- Menu vertical sur mobile\n- Mise en width 100% des éléments section/aside et retour dans le flux normal', NULL),
(21, 12, 'EXO2', 'Réalisation d’un mini-site responsive', 'Réalisation d’un site multipage avec formulaire', '-	Page DétailAnnonce\n-	Page Contact', NULL),
(22, 13, 'EXO1', 'Réalisation du storyboard d’une page responsive', 'Réalisation d’un storyboard pour une page responsive', NULL, NULL),
(23, 13, 'EXO2', 'Réalisation du storyboard d’un mini-site', 'Réalisation d’un storyboard pour un site multipage', NULL, NULL),
(24, 13, 'EXO3', 'Réalisation du storyboard d’un mini-site responsive', 'Réalisation d’un storyboard pour un site multipage responsive', NULL, NULL),
(25, 9, 'EXO2', 'Réalisation d’un mini-site au format HTML/CSS', 'Réalisation d’exercices CSS avancés', 'Création de la page "détail annonce"', NULL),
(26, 6, 'EXO1', 'Réalisation d’un CV au format HTML', 'Découverte des outils (Notepad++) et réalisation d’exercices HTML', '- Réalisation d’un CV\n--> Découvrir le rendu sur plusieurs navigateurs\n--> Notion d’encodage\n\n- Réalisation d’un tableau', 'Balises utiles : <img>, <hx>, <ul>, <li>, <a>, <table>, <tr>, <td> \nHTML5 : <section>, <aside>, <header>'),
(27, 10, 'EXO2', 'Quatre colonnes fluides de même hauteur centrées horizontalement', 'Problématique : Quatre colonnes fluides de même hauteur centrées horizontalement', '<header>...</header>\n\n<section id="decouverte">...</section>\n<section id="start">...</section>\n<section id="services">...</section>\n<section id="power">...</section>	\n\n<footer>...</footer>', 'Au moins trois solutions possibles :\n- "absolute + marges"\n- "table/table-cell"\n- "inline-block"'),
(28, 12, 'EXO3', 'Réalisation d''une page d''impression optimisée', 'Pouvoir imprimer facilement la page des annonces', 'Media querie "print"', 'Enlever le header/footer et les filtres'),
(29, 14, 'EXO1', 'Réalisation d''une page web responsive', 'Découvrir Bootstrap et réaliser une page web responsive', NULL, NULL),
(30, 14, 'EXO2', 'Réalisation d’un mini-site responsive', 'Réalisation d’un site multipage avec Bootstrap', '-	Page DétailAnnonce\n-	Page Contact', NULL),
(31, 17, 'EXO1', 'Prise en main de JS', 'Prise en main du langage Javascript', '- Boucle de 1 à 10 ; Afficher le compteur à chaque pas et la parité du compteur\n- Boucle de 0 à n ; Tant que l''utilisateur veut jouer ; Afficher le compteur à chaque pas\n- Quizz 2+2 = ?', NULL),
(32, 17, 'EXO2', 'Utilisation intermédiaire de JS', 'Manipulation des évènements via JS \nManipulation du DOM/CSS via JS', '-	div « boutons » permettant de changer, au clic, la couleur d’arrière-plan d’un autre div', NULL),
(33, 18, 'EXO1', 'Prise en main de JQuery', 'Manipulation des évènements via JQuery\nManipulation du DOM/CSS via JQuery', '- div « boutons » permettant de changer, au clic, la couleur d’arrière-plan d’un autre div', NULL),
(34, 17, 'EXO3', 'Créer un formulaire interactif', 'Créer un formulaire d''inscription avec des contrôles personnalisés', 'Sexe : Un sexe doit être sélectionné\nNom : Pas moins de 2 caractères\nPrénom : Pas moins de 2 caractères\nÂge : Un nombre compris entre 5 et 140\nPseudo : Pas moins de 4 caractères\nMot de passe : Pas moins de 6 caractères\nMot de passe (confirmation) : Doit être identique au premier mot de passe\nPays : Un pays doit être sélectionné\nSi l''utilisateur souhaite recevoir des mails : Pas de condition', 'Créer une fonction de validation pour chacun des champs et appeler ces fonctions à chaque modification du formulaire'),
(35, 18, 'EXO2', 'Créer un formulaire interactif', 'Créer un formulaire d''inscription avec des contrôles personnalisés', 'Sexe : Un sexe doit être sélectionné\nNom : Pas moins de 2 caractères\nPrénom : Pas moins de 2 caractères\nÂge : Un nombre compris entre 5 et 140\nPseudo : Pas moins de 4 caractères\nMot de passe : Pas moins de 6 caractères\nMot de passe (confirmation) : Doit être identique au premier mot de passe\nPays : Un pays doit être sélectionné\nSi l''utilisateur souhaite recevoir des mails : Pas de condition', 'Créer une fonction de validation pour chacun des champs et appeler ces fonctions à chaque modification du formulaire'),
(36, 20, 'EXO1', 'Inclusion de fichiers en PHP (header/footer)', 'Découverte de la fonction include( )', 'Créer deux nouveaux fichiers header.php et footer.php pour y déplacer le code correspondant\nInclure ces fichiers dans les pages index.php et detail_annonce.php', NULL),
(37, 20, 'EXO2', 'Affichage dynamique en PHP', 'Prise en main de PHP pour de l’affichage dynamique', NULL, NULL),
(38, 21, 'EXO1', 'Passage de paramètres via PHP', 'Mise en pratique de GET', NULL, NULL),
(39, 21, 'EXO2', 'Le formulaire de connexion', 'Mise en pratique de GET/POST', NULL, NULL),
(40, 22, 'EXO1', 'Découverte de sessions', 'Mise en pratique des sessions', NULL, NULL),
(41, 22, 'EXO2', 'Le formulaire de connexion persistant', 'Mise en pratique des sessions', 'Faire persister les informations de connexions de l''utilisateur', NULL),
(42, 23, 'EXO1', 'Le journal des connexions', 'Création d’un fichier de log journalier', 'Créer un dossier /log et un fichier par jour (« 2016-04-22.log »)\nContenu du fichier :\n2016-04-22 09 :00 :10#192.0.0.0\n2016-04-22 09 :02 :10#192.0.0.0\n2016-04-22 09 :03 :10#192.0.0.0\n\nAfficher en bas du site :\n« XX connexions depuis ce matin ; YY connexions au total »', NULL),
(43, 23, 'EXO2', 'Stocker les comptes utilisateurs via des fichiers', 'Mise en pratique des fichiers', 'Créer un dossier /users et un fichier par utilisateur inscrit (« contact@F2000.fr.user »)\nContenu du fichier :\nemail:contact@f2000.fr\npassword:formateur', NULL),
(44, 19, 'EXO1', 'Prise en main d’AJAX', 'Mise à jour d’une page via des requêtes AJAX', NULL, NULL),
(45, 19, 'EXO2', 'Pagination en Ajax', 'Utiliser Ajax pour afficher des annonces à la volée', 'Afficher les annonces suivantes via Ajax\n=> Identifier et isoler la partie à mettre à jour (vue partielle) et la mettre dans un "container"\n=> Créer un bouton pour l''utilisateur afin de demander les annonces suivantes\n=> Au clic, effectuer l''appel AJAX et récupérer notre nouvelle vue partielle\n=> Remplacer le contenu du "container" par la nouvelle vue (ou l''ajouter à la suite)', '- Utiliser array_slice ( ) pour afficher un tableau partielle\n- Utiliser un paramètre "offset" afin de définir la position actuelle dans notre tableau d''annonces\n- Stocker ce paramètre dans un attribut personnalisé de notre bouton et mettre à jour la valeur à chaque clic de l''utilisateur'),
(46, 27, 'EXO1', 'Création d’une classe Annonce', 'Découverte des classes en PHP', 'Transformation du tableau représentant l''annonce en un objet de classe Annonce\n\n1. Créer une classe Annonce (fichier : /class/Annonce.php)\n\n2. Créer les propriétés nécessaires (id, title, etc.) et les getteurs/setteurs associés\n\n3. Modifier le fichier data.php pour utiliser la classe Annonce au lieu des sous-tableaux\n\n4. Modifier les différentes vues pour récupérer les bonnes informations de vos annonces', 'Penser à inclure votre classe dans les fichiers index.php/ajax.php'),
(47, 28, 'EXO1', 'Stockage des entités Annonce via la sérialisation', 'Découverte de la sérialisation en PHP', '- Enregistrer les annonces déjà existantes dans des fichiers textes\n- Créer un formulaire de dépôt d’annonce\n- Gérer l’enregistrement de l’annonce dans un fichier texte\n-> Via une méthode Annonce->save( )\n-> Charger les annonces via une méthode load()', NULL),
(48, 31, 'EXO1', 'Mise en pratique des expressions régulières', 'Découverte des expressions régulières en PHP', NULL, NULL),
(49, 30, 'EXO1', 'Upload d''un fichier image', 'Découvrir l''upload de fichiers en PHP', 'Modifier le formulaire de dépôt d''annonce pour permettre l''envoi d''une image', NULL),
(50, 32, 'EXO1', 'Mise en pratique de l’autoload', 'Découverte de l’autoload en PHP', 'Créer un autoloader pour nos classes Annonce et User', 'spl_autoload_register'),
(51, 33, 'EXO1', 'Mise en pratique des espaces de noms', 'Découverte des espaces de noms en PHP', 'Créer un namespace "Leboncoin" pour nos classes Annonce et User\nModifier le code en fonction', 'Attention à DateTime dans la classe Annonce'),
(52, 34, 'EXO1', 'Mise en pratique des exceptions', 'Découverte des exceptions', NULL, NULL),
(53, 35, 'EXO1', 'Mise en pratique de PHPUnit', 'Découverte de PHPUnit', NULL, NULL),
(54, 36, 'EXO1', 'Requêtages basiques', 'Découverte des instructions SQL basiques', '-	Créer une base de données "Library"\n-	Créer une table "Users" : id, last_name, first_name, city, age, created_date\n-	Insertion, modification et suppression de données basiques', NULL),
(55, 37, 'EXO1', 'Requêtages intermédiaires', 'Découverte des instructions SQL intermédiaires', '-	Créer une table "Books" : id, title, author, id_user\n-	Lier la table Utilisateurs à Livres via un champ "id_user" dans la table "Books" (+ clé étrangère)', NULL),
(56, 38, 'EXO1', 'Requêtages avancés', 'Découverte des instructions SQL avancés', '-	Récupérer des informations multi-tables', NULL),
(57, 39, 'EXO1', 'Séparation des concepts Repository-Entity', 'Séparer la structure de la classe (Entity) de son stockage (Repository)', 'Déplacer les méthodes load ( ) et save ( ) dans une classe xManager', NULL),
(58, 40, 'EXO1', 'Les fonctions MySQL natives', 'Découverte des fonctions MySQL natives', 'Modifier les méthodes load ( ) et save ( ) pour utiliser la base de données', NULL),
(59, 41, 'EXO1', 'La librarie PDO via une variable référence', 'Découverte de la librarie PDO en utilisant une référence sur l''objet PDO', 'Créer une fonction connectDb( ) pour se connecter à la BDD et passer l''objet PDO à AnnoncesManager\nModifier les méthodes load ( ) et save ( ) pour utiliser la base de données', 'Créer une propriété privée (et le setter associé) pour stocker l''objet PDO dans AnnoncesManager'),
(60, 41, 'EXO2', 'La librarie PDO via un Singleton', 'Découverte de la librarie PDO en utilisant un Singleton', 'Créer un singleton DbManager servant d''encapsulation à notre objet PDO\nUtiliser ensuite ce singleton directement dans AnnoncesManager.', 'Effectuez la connexion à la BDD lors de la création du Singleton DbManager'),
(61, 41, 'EXO3', 'Création de filtres', 'Créer de nouvelles fonction pour filtrer nos annonces', NULL, NULL),
(62, 42, 'EXO1', 'Découvrir quelques failles de sécurité', 'Apprendre par l''exemple', NULL, NULL),
(63, 43, 'EXO1', 'Découverte de Github', 'Découverte de GIT via Github', 'https://git-scm.com/download/win\n\nhttps://guides.github.com/activities/hello-world', NULL),
(64, 44, 'EXO1', 'La gestion de bugs avec Github', 'Découverte de la gestion de bugs via l’outil interne de Github', NULL, NULL),
(65, 46, 'EXO1', 'Installation de Symfony', 'Découverte de Symfony', 'Création d’une route SANS paramètre et du controller/action associés\nCréation de la réponse associée (brute)\n\nCréation d’une route AVEC paramètre et du controller/action associés\nCréation de la réponse associée (brute)', NULL),
(66, 47, 'EXO1', 'Découverte de Symfony/Twig', 'Découverte de Twig via la solution Symfony', 'Création d’une route SANS paramètre et du controller/action associés\nCréation de la vue associée (TWIG)\n\nCréation d’une route AVEC paramètre et du controller/action associés\nCréation de la vue associée (TWIG)', NULL),
(67, 48, 'EXO1', 'Découverte de Symfony/La console', 'Découverte de la console Symfony', 'php app/console generate:bundle\nphp app/console generate:controller', NULL),
(68, 49, 'EXO1', 'Découverte de Symfony/Doctrine', 'Découverte de Doctrine via la solution Symfony', '== Le mapping ==\nRajouter les données de mapping sur l''entité Annonce déjà créée\nGénérer les getters/setters : php app/console doctrine:generate:entities AppBundle/...\n\n== La base de données ==\nphp app/console doctrine:schema:update --dump-sql\nphp app/console doctrine:schema:update --force\n\n== Les entités ==\nGet, update, delete\n\n== Créer une entité “User” via la console ==\nphp app/console doctrine:generate:entity', NULL),
(69, 49, 'EXO2', 'Les relations avec Symfony/Doctrine', 'Découverte des relations avec Doctrine via la solution Symfony', 'Lier les classes Annonce et User via une relation oneToMany', NULL),
(70, 50, 'EXO1', 'Découverte de Symfony/Form', 'Découverte des formulaires via la solution Symfony', 'Créer le formulaire de dépôt d’annonce avec upload de fichiers\n\nCréer le formulaire d’enregistrement, de connexion et la persistance de l’utilisateur via la session', NULL),
(72, 47, 'EXO2', 'Reprise Leboncoin', 'S''approprier TWIG', 'Refaire le site Leboncoin grâce à Symfony, Twig et Boostrap :\n- Réaliser en premier lieu le template global (header, footer)\n- Définir ensuite les principales URLs (accueil, détail annonce, dépôt annonce)\n- Créer l''entité Annonce\n- Réaliser les actions associées\n- Réaliser les views associées', NULL),
(73, 52, 'EXO1', 'Projet Symfony initial', 'Utiliser Symfony pour construire le jeu de plateau', NULL, NULL),
(74, 52, 'EXO2', 'Projet Symfony - Plateau de jeu', 'Réaliser un plateau de jeu via Symfony', 'Créer les entités User, Game\nCréer les models Board, Case, Player\n\nGérer l''inscription d''un utilisateur\nGérer la connexion d''un utilisateur\n\nGérer la création d''une partie multi-joueurs ET solo\nGérer l''ajout d''un joueur dans le cas d''une partie multi-joueurs\n\nGérer le démarrage de la partie\nGérer les déplacements des joueurs\n\nGérer l''abandon de la partie', NULL);

--
-- Contenu de la table `f2000fr_trainingcenter_module`
--

INSERT INTO `f2000fr_trainingcenter_module` (`id`, `category_id`, `quizz_id`, `reference`, `name`, `description`, `keypoints`, `duration`, `ressources`, `private_content`, `created_date`, `updated_date`) VALUES
(1, 1, NULL, 'FP-DW-8SEM', 'Formation Développeur Web 8 semaines', 'Formation de perfectionnement au métier de Développeur Web (8 semaines)', '- HTML pour le fond (contenu, éléments logiques)\r\n- CSS pour la forme (apparence des  éléments) \r\n- JS pour l’interactivité de votre site internet et ainsi interagir avec l’utilisateur\r\n- PHP pour rendre dynamique votre site internet\r\n- SQL pour stocker vos informations et celles de vos utilisateurs', NULL, 'http://www.metiers.internet.gouv.fr', NULL, '2017-01-25 11:22:06', '2017-03-16 17:17:06'),
(3, 3, NULL, 'DW-INFO1', 'Les métiers web VS Le développeur web', 'Présentation des différents métiers web et plus précisément du rôle du Développeur Web et de ces interactions avec les autres métiers.', '- De nombreux métiers existent dans le domaine web\r\n- Des compétences transverses sont souvent demandées\r\n- Le Développeur Web propose et réalise une solution technique répondant au besoin du client\r\n- Plusieurs langages de programmation existent avec leurs avantages/inconvénients\r\n- Plusieurs moyens de réalisation technique existent avec leurs avantages/inconvénients', NULL, '- http://www.metiers.internet.gouv.fr', NULL, '2017-01-29 18:46:38', '2017-01-29 18:46:38'),
(4, 3, NULL, 'DW-INFO2', 'Les langages web', 'Présentation du rôle des différents langages web (HTML, CSS, JS, PHP, SQL) et de la manière dont ils interagissent entre eux.', '-	Différences client/serveur\r\n-	Langages client : HTML/CSS/JS\r\n-	Langages serveur : PHP/SQL', NULL, '- http://fr.wikipedia.org/wiki/Hypertext_Markup_Language\r\n- http://fr.wikipedia.org/wiki/Feuilles_de_style_en_cascade \r\n- http://fr.wikipedia.org/wiki/JavaScript\r\n- http://fr.wikipedia.org/wiki/PHP\r\n- http://fr.wikipedia.org/wiki/Structured_Query_Language', NULL, '2017-01-29 19:00:30', '2017-01-29 19:08:02'),
(5, 5, NULL, 'DW-HTML1', 'Les bases du langage HTML', 'Présentation des principales balises HTML\r\nComportements des balises (« block » vs « inline »)', '-	HTML : format de données conçu pour représenter les pages web\r\n-	Langage composé de balises et d’attributs\r\n-	Formalisme à respecter pour un bon référencement', NULL, '- http://fr.wikipedia.org/wiki/Hypertext_Markup_Language\r\n- https://openclassrooms.com/courses/apprenez-a-creer-votre-site-web-avec-html5-et-css3/memento-des-balises-html', NULL, '2017-01-29 19:18:32', '2017-01-29 19:18:32'),
(6, 5, NULL, 'DW-HTML2', 'Nouveautés HTML5', 'Présentation des nouveautés HTML5', '- HTML5 : définir une sémantique propre au sein d’un document HTML', NULL, '- http://www.alsacreations.com/article/lire/1376-html5-section-article-nav-header-footer-aside.html\r\n- http://www.alsacreations.com/xmedia/tuto/html5/sections/index.html\r\n- http://dev.w3.org/html5/markup', NULL, '2017-01-29 19:34:09', '2017-01-29 19:39:50'),
(7, 6, 15, 'DW-CSS1', 'Les bases du langage CSS', 'Présentation des principaux mots-clés et sélecteurs CSS', '- CSS : décrire la présentation (mise en forme) d’un document HTML', NULL, '- http://fr.wikipedia.org/wiki/Feuilles_de_style_en_cascade\r\n- http://www.noupe.com/design/15-css-habits-to-develop-for-frustration-free-coding.html\r\n- https://www.w3.org/Style/Examples/007/units.fr.html', 'Se renseigner un peu plus sur les unités de valeur !!', '2017-01-29 20:03:35', '2017-02-05 16:29:51'),
(9, 6, 16, 'DW-CSS2', 'Nouveautés CSS3', 'Présentation des nouveautés CSS3', '-	CSS3 : rajouter des effets visuels avancés\r\n-	CSS3 : faciliter le responsive-design grâce aux media-queries', NULL, '- http://gafish.fr/nouveautes-css3\r\n- http://www.alsacreations.com/article/lire/930-css3-media-queries.html', NULL, '2017-01-29 20:15:10', '2017-01-29 20:18:15'),
(10, 6, NULL, 'DW-CSS3', 'CSS intermédiaire (position/display)', 'Présentation des principaux positionnements en CSS et  des principales méthodes d’affichage en CSS', '- Position "static" : comportement par défaut\r\n- Position "relative" : décalage par rapport à la position de référence ; peut servir de référence à d''autres éléments positionnés en "absolute"\r\n- Position "absolute" : positionnement "en dehors du flux", par rapport à son premier ancêtre positionné (relative ou fixed)\r\n- Position "fixed" : positionnement par rapport à la fenêtre du navigateur\r\n- Éléments flottants : à éviter de manière générale', NULL, '- http://www.alsacreations.com/article/lire/533-initiation-au-positionnement-en-css-partie-1.html\r\n- http://www.alsacreations.com/tuto/lire/608-initiation-au-positionnement-css-partie-2.html\r\n- http://www.alsacreations.com/article/lire/53-guide-de-survie-du-positionnement-css.html\r\n- http://www.xul.fr/css/position.php\r\n- https://openclassrooms.com/courses/apprenez-a-creer-votre-site-web-avec-html5-et-css3/la-mise-en-page-avec-flexbox', NULL, '2017-01-29 20:38:40', '2017-01-31 21:05:09'),
(12, 6, NULL, 'DW-CSS4', 'Le responsive-design', 'Présentation du responsive-design', '- Simplifier la mise à jour du site (version unique)\r\n- Optimiser le design suivant le support (doigts/taille des boutons ; espace visuel)\r\n- Optimiser le chargement suivant le support (taille et poids des images)', NULL, '- http://fr.slideshare.net/UX-REPUBLIC/05-les-10-bonnes-pratiques-du-responsive-design-adrien-franceskini\r\n- http://davidl.fr/webdesign.html\r\n- https://startupeers.co/responsive-web-design-decryptage-bonnes-pratiques-ecommerce\r\n- http://www.ecommercemag.fr/Thematique/strategies-omni-canal-1009/Breves/Sept-conseils-pour-concevoir-un-site-en-responsive-design-51102.htm', NULL, '2017-01-29 20:54:53', '2017-02-01 16:43:17'),
(13, 4, NULL, 'DW-ERGO1', 'Le storyboarding', 'Présentation du storyboarding', '- Le storyboarding permet de comprendre le point de vue fonctionnel et ergonomique des différents écrans d’un projet web', NULL, '- http://fr.slideshare.net/SuperFiction/storyboarding-for-the-web-methodology-and-tools', NULL, '2017-01-29 21:05:15', '2017-02-01 10:22:42'),
(14, 6, NULL, 'DW-CSS5', 'Découverte de Bootstrap', 'Présentation de la solution Bootstrap', '- Permet de simplifier la conception d''un site intérêt en ayant un ensemble de classes prédéfinies\r\n- Permet de simplifier le rendu "responsive" d''un site internet', NULL, '- http://getbootstrap.com\r\n- http://getbootstrap.com/getting-started/#examples\r\n- http://getbootstrap.com/components\r\n- https://openclassrooms.com/courses/prenez-en-main-bootstrap', 'Une colonne peut contenir une nouvelle "row" et ainsi se rediviser en 12', '2017-02-01 16:47:46', '2017-02-05 19:17:31'),
(15, 15, NULL, 'DW-PROG1', 'Découverte des langages de programmation', 'Présentation des notions générales de programmation', '- Variables : typées ou non typées suivant les langages\r\n- Types simples/complexes : dépend des langages (tableau/liste/objet)\r\n- Opérateurs mathématiques\r\n- Conditions/boucles/fonctions', NULL, NULL, NULL, '2017-02-05 19:18:02', '2017-02-05 19:24:19'),
(16, 15, NULL, 'DW-PROG2', 'Les expressions régulières', 'Présentation du concept d’expression régulière', '- Masque (chaine de caractère) permettant de valider ou non une chaine de caractère', NULL, '- http://fr.wikipedia.org/wiki/Expression_rationnelle\r\n- http://regexpal.com', NULL, '2017-02-05 19:19:39', '2017-02-05 19:19:39'),
(17, 7, NULL, 'DW-JS1', 'Les bases de langage JS', 'Présentation des notions de programmation spécifiques à JS', '- Langage de scripting principalement employé dans les pages web interactives\r\n- Interactions avec l’utilisateur (évènements, modification du DOM)', NULL, '- http://fr.wikipedia.org/wiki/JavaScript', 'Attention à l''exo 3 : bien présenter le processus d''optimisation', '2017-02-05 19:26:04', '2017-02-07 08:45:32'),
(18, 7, NULL, 'DW-JS2', 'La bibliothèque JQuery', 'Présentation de la bibliothèque JQuery', '- Facilite le traitement du javascript\r\n==> Modification du DOM/CSS\r\n==> Événements\r\n==> Effets visuels et animations\r\n==> Ajax', NULL, '- http://fr.wikipedia.org/wiki/JQuery\r\n- https://jquery.com', NULL, '2017-02-05 20:04:15', '2017-02-05 20:50:09'),
(19, 7, NULL, 'DW-JS3', 'Les requêtes AJAX', 'Présentation des requêtes AJAX en JS natif et via JQuery', '- Requêtes asynchrones envoyées, en arrière-plan, par le navigateur au serveur', NULL, '- http://fr.wikipedia.org/wiki/Ajax_%28informatique%29', NULL, '2017-02-05 21:49:28', '2017-02-09 22:31:07'),
(20, 8, NULL, 'DW-PHP1', 'Les bases du langage PHP', 'Présentation des notions de programmation spécifiques à PHP', '- Langage de programmation utilisé principalement pour produire des pages Web dynamiques', NULL, '- http://fr.wikipedia.org/wiki/PHP', NULL, '2017-02-05 21:54:45', '2017-02-05 21:54:45'),
(21, 8, NULL, 'DW-PHP2', 'Le passage de paramètres via PHP', 'Présentation des méthodes GET/POST', '- GET : Passage de paramètres dans l''url\r\n- POST : Passage de paramètres dans les données POST', NULL, '- http://www.w3schools.com/Tags/ref_httpmethods.asp', NULL, '2017-02-05 22:22:39', '2017-02-09 21:46:22'),
(22, 8, NULL, 'DW-PHP3', 'Sessions et cookies', 'Présentation des sessions et des cookies', '- Sessions : données persistantes côté serveur (non modifiable par l''utilisateur)\r\n- Cookies : données persistantes côté client (modifiable par l''utilisateur)', NULL, '- https://php.developpez.com/cours/sessions', NULL, '2017-02-05 22:52:14', '2017-02-05 22:52:14'),
(23, 8, NULL, 'DW-PHP4', 'Manipulation de fichiers via PHP', 'Manipuler les fichiers grâce à PHP', '- Attention aux gros fichiers : ne pas utiliser file( ) mais une boucle\r\n- Ne pas oublier de fermer le fichier !', NULL, '- http://php.net/manual/fr/ref.filesystem.php', NULL, '2017-02-05 23:01:19', '2017-02-09 21:46:12'),
(24, 4, NULL, 'DW-ERGO2', 'Notions d''ergonomie web', 'Présentation des principes d’ergonomie', NULL, NULL, '- http://www.matthieu-tranvan.fr/e-commerce/7-principes-fondamentaux-design-web-site-ergonomie.html\r\n- http://mariekuter.com/cours-construire-un-site-utilisable-bonnes-pratiques-et-outils-de-lergonomie-web', NULL, '2017-02-12 17:56:24', '2017-02-12 17:56:24'),
(25, 3, NULL, 'DW-INFO3', 'Les protocoles web', 'Présentation des protocoles web', NULL, NULL, '- http://fr.wikipedia.org/wiki/Hypertext_Transfer_Protocol\r\n- http://fr.wikipedia.org/wiki/Liste_des_codes_HTTP', NULL, '2017-02-12 17:57:48', '2017-02-12 17:57:48'),
(26, 3, NULL, 'DW-INFO4', 'Les formats de données génériques', 'Présentation des principaux formats de données génériques', '- JSON : principalement utilisé pour la communication via AJAX (navigateur <=> serveur)\r\n- XML : principalement utilisé par les applications lourdes (ex : flux RSS)\r\n- YAML : principalement utilisé pour des fichiers de configuration\r\n- Annotations (PHP Only) : principalement utilisé pour surcharger le code PHP par des informations annexes (infos DB par exemple)', NULL, '- http://fr.wikipedia.org/wiki/JavaScript_Object_Notation\r\n- http://fr.wikipedia.org/wiki/Extensible_Markup_Language\r\n- http://fr.wikipedia.org/wiki/YAML\r\n- https://code.google.com/archive/p/addendum/wikis/ShortTutorialByExample.wiki', NULL, '2017-02-12 18:07:25', '2017-02-24 10:41:36'),
(27, 8, NULL, 'DW-PHP5', 'Les classes PHP', 'Présentation des classes en PHP', '- Une classe possède des attributs et des fonctions\r\n- Chacun d''eux a une visibilité particulière (publique/privée)\r\n- Le mot-clé "$this" fait référence à l''instance courante', NULL, NULL, NULL, '2017-02-12 18:10:03', '2017-02-14 13:53:46'),
(28, 8, NULL, 'DW-PHP6', 'La sérialisation en PHP', 'Présentation du concept de sérialisation en PHP', '- La sérialisation permet de « transtyper » et de linéariser un objet\r\n- serialize ( ) / unserialize ( )', NULL, NULL, NULL, '2017-02-12 18:54:56', '2017-02-12 18:54:56'),
(29, 8, NULL, 'DW-PHP7', 'L’héritage en PHP', 'Présentation du concept d’héritage PHP, les classes abstraites', '- Une classe fille héritent des propriétés et des comportements de sa classe parente. Elle peut redéfinir certains comportements et en ajouter d''autres.\r\n- Une classe abstraite permet de définir des comportements que devront respecter les classes qui en héritent. Une classe abstraite ne peut pas être instanciée.', NULL, '- https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/l-heritage-3', NULL, '2017-02-12 19:08:57', '2017-02-12 19:08:57'),
(30, 8, NULL, 'DW-PHP8', 'L’upload de fichiers en PHP', 'Présentation de l’upload de fichiers', '- Le formulaire doit utilisé la méthode POST et définir l''attribut enctype\r\n- On récupère les données du fichier via la variable globale $_FILES\r\n- On doit déplacer le fichier temporaire via la fonction move_uploaded_file ( )', NULL, NULL, NULL, '2017-02-12 19:14:15', '2017-02-12 21:08:50'),
(31, 8, NULL, 'DW-PHP9', 'Les expressions régulières en PHP', 'Présentation du concept d’expression régulière', '- Les regex doivent êtres entourées de délimiteurs\r\n- Fonctions a retenir : preg_match / preg_match_all / preg_replace', NULL, '- http://fr.wikipedia.org/wiki/Expression_rationnelle\r\n- http://regexpal.com', NULL, '2017-02-12 19:30:46', '2017-02-12 20:41:06'),
(32, 8, NULL, 'DW-PHP11', 'Auto-chargement de classes (autoload)', 'Présentation de l''autoload', '- Les fichiers de classes doivent suivre une nomenclature précise afin de pouvoir être inclus de manière dynamique', NULL, '- http://php.net/manual/fr/language.oop5.autoload.php\r\n- https://www.grafikart.fr/formations/programmation-objet-php/autoload', NULL, '2017-02-14 19:26:09', '2017-02-14 20:10:48'),
(33, 8, NULL, 'DW-PHP10', 'Les namespaces (espaces de noms)', 'Présentation des espaces de nom', '- Permet d’empêcher la collision de noms entre votre code et des bibliothèques tierces', NULL, '- http://php.net/manual/fr/language.namespaces.rationale.php', NULL, '2017-02-14 20:11:52', '2017-02-14 20:13:07'),
(34, 8, NULL, 'DW-PHP12', 'Les exceptions en PHP', 'Présentation des exceptions', '- try / catch / finally', NULL, '- http://php.net/manual/fr/language.exceptions.php', NULL, '2017-02-14 20:30:53', '2017-02-14 20:31:13'),
(35, 8, NULL, 'DW-PHP13', 'Les tests unitaires en PHP via PHPUnit', 'Présentation des tests unitaires et de PHPUnit', '- Les tests unitaires permettent de rendre votre code plus robuste et d''empêcher les régressions de code', NULL, '- https://openclassrooms.com/courses/decouvrez-le-framework-php-laravel/les-tests-unitaires-4\r\n- https://phpunit.de/getting-started.html', NULL, '2017-02-14 20:38:08', '2017-02-14 20:39:23'),
(36, 9, NULL, 'DW-SQL1', 'Les bases du langage SQL', 'Présentation du langage SQL', '- Il existe plusieurs SGBD, le plus connu étant MySQL\r\n- Instructions basiques (CRUD) : SELECT, INSERT, UPDATE, DELETE', NULL, '- http://fr.wikipedia.org/wiki/Syst%C3%A8me_de_gestion_de_base_de_donn%C3%A9es\r\n- http://fr.wikipedia.org/wiki/Structured_Query_Language\r\n- http://www.w3schools.com/sql/', NULL, '2017-02-19 19:56:54', '2017-02-19 19:56:54'),
(37, 9, NULL, 'DW-SQL2', 'SQL intermédiaire', 'Présentation des agrégats et de l’instruction GROUP BY', '- Agrégats : COUNT ( * ), MAX, MIN, AVG, SUM\r\n- Instruction GROUP BY : permet de grouper les résultats par lots', NULL, NULL, NULL, '2017-02-19 20:08:15', '2017-02-19 20:08:15'),
(38, 9, NULL, 'DW-SQL3', 'SQL avancé', 'Présentation des jointures, des unions et des clés primaires/étrangères', '- MyISAM est très rapide pour des recherches de texte\r\n- InnoDB permet une gestion plus complexe de la base de données (transactions, clés étrangères)\r\n- Les index permettent d''indexer du contenu et de faire des recherches plus rapide', NULL, '- http://sql.sh/cours/jointures', NULL, '2017-02-19 20:30:36', '2017-02-19 20:30:36'),
(39, 10, NULL, 'DW-PHP-SQL1', 'Concepts de modélisation SQL en PHP', 'Concept de séparation Stockage des données VS Structure des données\r\nConcept d’hydratation', '- Bonne pratique : séparer le stockage des données (Repository) et la structure des données (Entity)\r\n- Concept d''hydratation : fonction permettant de remplir une classe via un tableau de données ayant pour clés les attributs de la classe', NULL, NULL, NULL, '2017-02-19 20:39:48', '2017-02-19 20:39:48'),
(40, 10, NULL, 'DW-PHP-SQL2', 'Les fonctions natives MySQL en PHP', 'Présentation des fonctions natives PHP pour travailler avec MySQL', '- Fonctions globales permettant de communiquer avec une base MySQL', NULL, NULL, NULL, '2017-02-19 21:01:33', '2017-02-19 21:01:33'),
(41, 10, NULL, 'DW-PHP-SQL3', 'La librairie PDO', 'Présentation de la librarie PDO', '- Extension PHP permettant l’abstraction du SGBD utilisé', NULL, '- http://php.net/manual/fr/book.pdo.php\r\n- https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/lire-des-donnees-2\r\n- https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/ecrire-des-donnees-2\r\n- https://openclassrooms.com/courses/pdo-comprendre-et-corriger-les-erreurs-les-plus-frequentes', NULL, '2017-02-19 21:08:21', '2017-02-21 20:10:18'),
(42, 11, NULL, 'DW-SECU1', 'Notions générales de sécurité', 'Bonnes pratiques de sécurité', '- Ne jamais stocker un mot de passe en clair (rainbow tables\r\n- Se protéger des attaques XSS et CSRF\r\n- Se protéger des injections SQL', NULL, '- http://fr.wikipedia.org/wiki/Cross-site_scripting\r\n- http://fr.wikipedia.org/wiki/Cross-Site_Request_Forgery\r\n- http://fr.wikipedia.org/wiki/Injection_SQL', NULL, '2017-02-19 21:23:07', '2017-02-19 21:23:07'),
(43, 12, NULL, 'DW-TOOLS1', 'Les logiciels de gestion de versions', 'Présentation des outils de gestion de versions', '- Permet de gérer facilement un projet à plusieurs (historique des changements, gestion des conflits, etc.)\r\n- GIT : outil décentralisé (travail possible hors-ligne)\r\n- SVN : outil centralisé', NULL, '- http://learngitbranching.js.org\r\n- http://fr.wikipedia.org/wiki/Git\r\n- https://fr.wikipedia.org/wiki/Apache_Subversion', NULL, '2017-02-26 20:16:08', '2017-02-27 10:40:53'),
(44, 12, NULL, 'DW-TOOLS2', 'Les logiciels de gestion de bugs', 'Présentation des outils de gestion de bugs', '- Sert à historiser et traiter rapidement les problèmes', NULL, '- http://www.redmine.org\r\n- https://www.atlassian.com/software/jira\r\n- http://www.mantisbt.org/', NULL, '2017-02-26 20:21:42', '2017-02-26 20:21:42'),
(45, 12, NULL, 'DW-TOOLS3', 'Les frameworks', 'Présentation des frameworks ; Comparaison Symfony VS Zend Framework', '- Framework : ensemble de composants permettant de créer les fondations d’un logiciel\r\n- Architecture unifiée et répondant aux bonnes pratiques\r\n- Modulaire, sécurisé, performant, communautaire', NULL, '- https://fr.wikipedia.org/wiki/Framework\r\n- http://symfony.com\r\n- https://framework.zend.com', NULL, '2017-02-26 20:26:29', '2017-02-26 20:26:29'),
(46, 13, NULL, 'DW-SYM1', 'Les bases de Symfony', 'Présentation de Symfony', '- Symfony : Build your App, not your Tools\r\n- Framework : ensemble de composants permettant de créer les fondations d’un logiciel\r\n- MVC, Routage, formulaires, validation, vues, classes, ORM', NULL, '- https://symfony.com/doc/current/index.html\r\n- https://getcomposer.org/download', NULL, '2017-02-26 20:30:53', '2017-02-27 08:31:17'),
(47, 13, NULL, 'DW-SYM2', 'Symfony et Twig', 'Présentation de Twig', '- Twig : The flexible, fast, and secure template engine for PHP', NULL, '- http://twig.sensiolabs.org\r\n- http://alexandre.clain.info/twig-les-filtres-disponibles', NULL, '2017-02-26 20:41:06', '2017-02-26 20:47:31'),
(48, 13, NULL, 'DW-SYM3', 'Symfony et la console', 'Présentation de la console de Symfony', '- php bin/console cache:clear\r\n- php bin/console generate:bundle\r\n- php bin/console generate:controller', NULL, '- http://symfony.com/doc/current/bundles/SensioGeneratorBundle/commands/generate_bundle.html\r\n- http://symfony.com/doc/current/bundles/SensioGeneratorBundle/commands/generate_controller.html', NULL, '2017-02-26 20:50:56', '2017-02-26 20:50:56'),
(49, 13, NULL, 'DW-SYM4', 'Symfony et Doctrine', 'Présentation de Doctrine', '- Doctrine : Lien entre les entités PHP et la base de données (ORM)\r\n- Doctrine : Abstraction complète de la base de donnée (DBAL)', NULL, '- https://symfony.com/doc/master/doctrine.html', NULL, '2017-02-26 20:53:58', '2017-03-02 08:57:19'),
(50, 13, NULL, 'DW-SYM5', 'Symfony et les formulaires', 'Présentation des formulaires avec Symfony', '- Structure déjà existante pour faciliter la gestion des formulaires', NULL, '- http://symfony.com/doc/current/book/forms.html\r\n- http://symfony.com/doc/current/reference/forms/twig_reference.html\r\n- https://symfony.com/doc/current/reference/constraints.html\r\n- http://symfony.com/doc/current/book/validation.html', NULL, '2017-02-26 21:12:03', '2017-03-02 11:46:35'),
(51, 14, NULL, 'DW-METH1', 'Découverte de l''UML', 'Découverte de l''UML', '- Langage de modélisation graphique à base de pictogrammes conçu pour fournir une méthode normalisée pour visualiser la conception d''un système.\r\n- A retenir : \r\n---> diagramme de classes\r\n---> diagramme des cas d''utilisation\r\n---> diagramme de séquence', NULL, '- https://fr.wikipedia.org/wiki/UML_(informatique)\r\n- https://fr.wikipedia.org/wiki/Diagramme_de_classes\r\n- https://fr.wikipedia.org/wiki/Diagramme_des_cas_d''utilisation\r\n- https://fr.wikipedia.org/wiki/Diagramme_de_séquence', NULL, '2017-03-01 23:33:58', '2017-03-01 23:34:46'),
(52, 2, 14, 'DW-PROJ1', 'Projet web "Jeu de plateau"', 'Créer un jeu de plateau en groupe via les technologies suivantes : Symfony/Doctrine/Twig ; HTML/CSS/JQuery/PHP/SQL', '- Concevoir une étude projet (cahier des charges, diagramme de classe, storyboard)\r\n- Répartir les tâches dans un groupe\r\n- Création de l''ébauche du projet dans un temps 1\r\n- Amélioration du projet dans un temps 2\r\n- Finalisation du projet et présentation dans un temps 3', NULL, '- https://fr.wikipedia.org/wiki/Cahier_des_charges\r\n- https://fr.wikipedia.org/wiki/Diagramme_de_Gantt\r\n- https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2/deployer-son-site-symfony2-en-production', NULL, '2017-03-07 08:34:26', '2017-03-14 19:30:37');

--
-- Contenu de la table `f2000fr_trainingcenter_qcm_question`
--

INSERT INTO `f2000fr_trainingcenter_qcm_question` (`id`, `quizz_id`, `name`) VALUES
(18, 14, 'Q1'),
(19, 14, 'Q2'),
(20, 15, 'A quoi sert le langage CSS ?'),
(21, 15, 'Où est-il conseillé de placer le code CSS ?'),
(22, 15, 'Quelles règles CSS sont valides ?'),
(23, 15, 'Quel est le sélecteur à utiliser pour faire référence à une classe ?'),
(24, 15, 'Quelle instruction permet de mettre un élément en gras ?');

--
-- Contenu de la table `f2000fr_trainingcenter_qcm_quizz`
--

INSERT INTO `f2000fr_trainingcenter_qcm_quizz` (`id`, `reference`, `name`) VALUES
(14, 'DW-PROJ1', 'Projet web "Jeu de plateau"'),
(15, 'DW-CSS1', 'Les bases du langage CSS'),
(16, 'DW-CSS2', 'Nouveautés CSS3');

--
-- Contenu de la table `f2000fr_trainingcenter_qcm_response`
--

INSERT INTO `f2000fr_trainingcenter_qcm_response` (`id`, `question_id`, `name`, `valid`) VALUES
(27, 18, 'dfgfd', 1),
(28, 18, 'gfdgfd', 0),
(29, 19, 'gfdgfd', 0),
(30, 19, 'gfd', 1),
(31, 19, 'gfd', 0),
(32, 20, 'A réaliser des pages dynamiques', 0),
(33, 20, 'A mettre en forme les documents web', 1),
(34, 20, 'A insérer du contenu dans une page internet', 0),
(35, 21, 'Dans le <body>', 0),
(36, 21, 'Entre les balises <head>', 0),
(37, 21, 'Dans un fichier externe', 1),
(38, 22, 'body {color: black;}', 1),
(39, 22, '<a style="color :black;"> </a>', 1),
(40, 22, 'body : (color :black)', 0),
(41, 23, 'Le sélecteur .', 1),
(42, 23, 'Le sélecteur #', 0),
(43, 23, 'Le sélecteur *', 0),
(44, 24, 'font :bold ;', 0),
(45, 24, 'font-weight :bold ;', 1),
(46, 24, 'style :bold ;', 0);

--
-- Contenu de la table `f2000fr_trainingcenter_training`
--

INSERT INTO `f2000fr_trainingcenter_training` (`id`, `name`, `client`, `sponsor`, `description`, `location`, `private`, `start_date`, `end_date`, `created_date`, `updated_date`) VALUES
(1, 'Développement web', 'Pôle Emploi', 'AFPA', 'Horaires de formation (35h/sem.) :\r\n- de 8h30 à 12h30 et de 13h30 à 17h15 du lundi au jeudi\r\n- de 8h30 à 12h30 le vendredi\r\n\r\nRéférents :\r\n- AFPA (Jacques MASSOUH - jacques.massouh@afpa.fr)\r\n- Pôle Emploi (Nathalie RUSCA - nathalie.rusca@pole-emploi.fr)\r\n- Pôle Emploi (Sophie PICHOT - sophie.pichot@pole-emploi.fr)\r\n\r\nFormation assurée par F2000.FR (Fabien LOUIS - contact@f2000.fr - 06.87.97.43.54)', '16 Place Romée de Villeneuve - 13090 Aix En Provence', 0, '2017-01-30 00:00:00', '2017-03-29 23:59:59', '2016-11-25 13:23:17', '2017-03-27 21:55:29');

--
-- Contenu de la table `f2000fr_trainingcenter_training_module`
--

INSERT INTO `f2000fr_trainingcenter_training_module` (`id`, `training_id`, `module_id`, `restricted`) VALUES
(1, 1, 1, 0),
(2, 1, 3, 0),
(3, 1, 4, 0),
(4, 1, 5, 0),
(5, 1, 6, 0),
(6, 1, 7, 0),
(7, 1, 9, 0),
(8, 1, 10, 0),
(9, 1, 13, 0),
(10, 1, 12, 0),
(11, 1, 14, 0),
(12, 1, 18, 0),
(13, 1, 15, 0),
(14, 1, 17, 0),
(15, 1, 20, 0),
(16, 1, 21, 0),
(17, 1, 22, 0),
(18, 1, 19, 0),
(19, 1, 27, 0),
(20, 1, 29, 0),
(21, 1, 28, 0),
(22, 1, 30, 0),
(23, 1, 23, 0),
(24, 1, 33, 0),
(25, 1, 32, 0),
(26, 1, 16, 0),
(27, 1, 31, 0),
(28, 1, 36, 0),
(29, 1, 37, 0),
(30, 1, 38, 0),
(31, 1, 39, 0),
(32, 1, 40, 0),
(33, 1, 41, 0),
(34, 1, 34, 0),
(35, 1, 25, 0),
(36, 1, 26, 0),
(37, 1, 42, 0),
(38, 1, 43, 0),
(39, 1, 44, 0),
(40, 1, 45, 0),
(41, 1, 46, 0),
(42, 1, 47, 0),
(43, 1, 48, 0),
(44, 1, 49, 0),
(45, 1, 50, 0),
(46, 1, 51, 0),
(47, 1, 52, 0);

--
-- Contenu de la table `f2000fr_trainingcenter_user`
--

INSERT INTO `f2000fr_trainingcenter_user` (`id`, `login`, `password`, `first_name`, `last_name`, `email`, `comment`, `role`, `status`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'admin', 'Fabien', 'LOUIS', 'contact@f2000.fr', 'Connaissances correctes (HTML/CSS)\r\nTrès bonne motivation', 3, 1, '2016-07-06 00:00:00', '2017-03-26 19:32:12'),
(2, 'manager', 'manager', 'Manager', 'LOUIS', 'manager@f2000.fr', NULL, 2, 1, '0000-00-00 00:00:00', '2017-02-08 13:31:10'),
(3, 'student', 'student', 'Student', 'LOUIS', 'student@f2000.fr', NULL, 1, 1, '0000-00-00 00:00:00', '2017-03-26 21:34:40');

--
-- Contenu de la table `f2000fr_trainingcenter_users_trainings`
--

INSERT INTO `f2000fr_trainingcenter_users_trainings` (`user_id`, `training_id`) VALUES
(3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
