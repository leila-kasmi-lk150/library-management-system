-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2025 at 09:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_borrow_due_date` ()   BEGIN
    INSERT INTO notifications (idUser, idBook, send, message)
    SELECT idUser, idBook, '1', 'Return the book, the specified period has been exceeded'
    FROM borrow
    WHERE dateReturn < CURDATE() AND isReturn = '0';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_borrow_gp_due_date` ()   BEGIN
    INSERT INTO notifications_gp (idUser, idGP, send, message)
    SELECT idUser, idGP, '1', 'Return the GP, the specified period has been exceeded'
    FROM borrow_gp
    WHERE dateReturn < CURDATE() AND isReturn = '0';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `process_expired_requests` ()   BEGIN
    -- Delete expired requests
    DELETE FROM request WHERE DATEDIFF(CURDATE(), dateRequest) > 1;
    
    -- Update the nbrCopy in books table
    UPDATE books
    SET nbrCopy = nbrCopy + 1
    WHERE idBook IN (SELECT idBook FROM request WHERE DATEDIFF(CURDATE(), dateRequest) > 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `process_expired_requests_gp` ()   BEGIN
    -- Delete expired requests
    DELETE FROM request_gp WHERE DATEDIFF(CURDATE(), dateRequest) > 1;
    
    -- Update the nbrCopy in books table
    UPDATE graduation_project
    SET nbrCopy = nbrCopy + 1
    WHERE idGP IN (SELECT idGP FROM request_gp WHERE DATEDIFF(CURDATE(), dateRequest) > 1);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `idAuthor` int(11) NOT NULL,
  `author` varchar(250) NOT NULL,
  `aboutAuthor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`idAuthor`, `author`, `aboutAuthor`) VALUES
(1, 'Alain Bretto', ''),
(2, 'Jacques Zahnd', ''),
(3, 'Luisa Iturrioz', ''),
(4, 'Howard Keller', ''),
(5, 'Norbert Verdier', ''),
(6, 'Luc Bougé', ''),
(7, 'Jean-Louis Krivine', ''),
(8, 'Claude Benzaken', ''),
(9, 'رفاه شهاب الحمداني', ''),
(10, 'Michel Quercia', ''),
(11, 'Rémy Nicolai', ''),
(12, 'Olivier Bordellès', ''),
(13, 'Jacques Faraut', ''),
(14, 'Pierre Wassef', ''),
(15, 'André Brown', ''),
(16, 'Michel Aumiaux', ''),
(17, 'Pierre Damphousse', ''),
(18, 'Pierre Meunier', 'Pierre Meunier, né le 15 août 1908 à Dijon et décédé le 16 avril 1996 à Arnay-le-Duc (Côte-d\'Or), est un homme politique français, membre de la Résistance intérieure française et compagnon de Jean Moulin. Il fut député de gauche de la Côte-d\'Or de 1946 à 1958, conseiller général du canton d\'Arnay-le-Duc entre 1945 et 1985 et maire d\'Arnay-le-Duc de 1971 à 1983.'),
(19, 'Alain Jeanneret', ''),
(20, 'Fidèle Ayissi Etémé', ''),
(21, 'Roger Duquette', ''),
(22, 'Hervé Queffélec', ''),
(23, 'Roger Godement', 'Roger Godement, né le 1er octobre 19211 au Havre, est un mathématicien français, connu pour ses travaux en analyse fonctionnelle, topologie algébrique et théorie des groupes, ainsi que pour ses nombreux livres portant sur des sujets très variés à des niveaux accessibles aux étudiants des premières années d\'université.'),
(24, 'Jean Saint Raymond', ''),
(25, 'Georges Flory', ''),
(26, 'Chorlay Renaud', ''),
(27, 'Jean-Denis Eiden', ''),
(28, 'Robet Deltheil', ''),
(29, 'Pierre Nicaise', ''),
(30, 'Zoghman Mebkhout\r\n', ''),
(31, 'Oscar Zariski', ''),
(32, 'N. Bourbaki', ''),
(33, 'Jacques Pichon', ''),
(34, 'Elie Cartan', ''),
(35, 'Claude Godbillon', ''),
(36, 'Thierry Legay', ''),
(37, 'José Ouin', ''),
(38, 'Mouny Samy Modeliar', ''),
(39, 'Jonas Koko', ''),
(40, 'Jean-Claude Martin', ''),
(41, 'Steeve Sarfati', ''),
(42, 'Henri Lombardi', ''),
(43, 'BOUBAKEUR BENAHMED', ''),
(44, 'Luc Verschueren', ''),
(45, 'Samuel Nicolay', ''),
(46, 'Erich L. Lehmann', ''),
(47, 'Frédéric Sturm', ''),
(48, 'Damien Vergnaud', ''),
(49, 'Gérald Tenenbaum', ''),
(50, 'Jean-Pierre Escofier', ''),
(51, 'Anne Cortella', ''),
(52, 'Maurice Gaultier', ''),
(53, 'Sylvie Guerre', ''),
(54, 'André Giroux', ''),
(55, 'Alain Yger', ''),
(56, 'Charlotte Scribot', ''),
(57, 'Léonard Todjihounde', ''),
(58, 'François Rouvière', ''),
(59, 'Bouchaïb Radi', ''),
(60, 'Jean-Pierre Demailly', ''),
(65, 'Jean-François Delmas', ''),
(66, 'Christophe Chesneau', ''),
(67, 'Fabienne Comte', ''),
(68, 'Adjengue', ''),
(69, 'Pierre Audibert', ''),
(70, 'Thomas Cormen', ''),
(71, 'Nicolas Flasque', ''),
(72, 'Jacques Rappaz', ''),
(73, 'Bijan Mohammadi', ''),
(74, 'Jean-Noël Foussard', ''),
(75, 'Richard Mauduit', ''),
(76, 'Francis Meunier', ''),
(77, 'Lucien Borel', ''),
(78, 'Saidane', ''),
(79, 'Ahmed Benssada', ''),
(80, 'Louis Pinchard', ''),
(81, 'Dalibard Jean', ''),
(82, 'Cazes, Alain; Delacroix, Joelle', ''),
(83, 'Joelle Delacroix', ''),
(84, 'Servane Heudiard', ''),
(85, 'André Pérez', ''),
(86, 'Christophe Aubry', ''),
(87, 'Claude Servin', ''),
(88, 'Nazim Benbourahla', ''),
(89, 'Franck Ebel', ''),
(90, 'Yaël Cohen-Hadria', ''),
(91, 'Olivier Rollet', ''),
(92, 'Vincent Granet', ''),
(93, 'Brout Guillaume', ''),
(94, 'Guillaume Brout', ''),
(95, 'Denis Matarazzo', ''),
(96, 'Olivier Hennebelle', ''),
(97, 'Olivier Heurtel', ''),
(98, 'Gautheron, Yves', ''),
(99, 'Hugues Bersini ', 'Membre de l\'Académie Royale de Belgique, Hugues Bersini enseigne l\'informatique et la programmation aux facultés polytechnique et Solvay de l\'Université Libre de Bruxelles, dont il dirige le laboratoire d\'intelligence Artificielle. Il est l\'auteur de très nombreuses publications (systèmes complexes, génie logiciel, sciences cognitives et bioinformatique) et de plusieurs ouvrages d\'introduction à la programmation, l\'intelligence artificielle et les systèmes complexes qui font aujourd\'hui autorité dans le monde académique.'),
(100, 'Benoit Habert', ''),
(101, 'Satzinger John W', ''),
(102, 'Ammar Attoui', ''),
(103, 'Marie-Pierre Beal', ''),
(104, 'Castellani, Xavier', ''),
(105, 'Daniel Bernard', ''),
(106, 'David Cassidy', ''),
(107, 'Brian Clegg', ''),
(108, 'Étienne Klein', ''),
(109, 'Robert Leighton', ''),
(110, 'Richecoeur', ''),
(111, 'Bruno Chéron ', 'Bruno Chéron, docteur ès Sciences, est professeur à l\'Université de Rouen où il enseigne la thermodynamique, les transferts thermiques et la physique des plasmas. Il est également chargé de cours de transferts thermiques et de physique des lasers à l\'école supérieure en génie électrique (ESIGELEQ). Il a enseigné la conduction et la convection thermiques à l\'INSA de Rouen de 1987 à 1994. Ses travaux de recherche sont consacrés à l\'étude expérimentale de plasmas supersoniques basse pression en situations de jet libre et de couche limite, à la caractérisation des sources et de jets de plasmas et à la valorisation de déchets par plasmas atmosphériques.'),
(112, 'Dominique François', ''),
(113, 'Jean-Pierre Trotignon', ''),
(114, 'Michel Géradin', ''),
(115, 'Georges Venizelos', ''),
(116, 'Michel Del Pedro', ''),
(117, 'Pascal Hémon', 'Pascal Hémon est Ingénieur de Recherches du CNRS au Laboratoire d\'Hydrodynamique de l\'École Polytechnique. Ses travaux de recherches portent sur les phénomènes aéroélastiques, en particulier pour les effets du vent sur les structures de génie civil.'),
(118, 'Jacques Morel', ''),
(119, 'René Lafrance', ''),
(120, 'Landaou Lev Davidovitch', ''),
(121, 'Samir Khène', ''),
(122, 'J.N. Reddy ', ''),
(123, 'AJosé-Philippe Pérez', ''),
(124, 'Ion Paraschivoiu', ''),
(125, 'Valérie Léger', ''),
(126, 'Christian Frère', ''),
(127, 'Morand Henri J.-P', ''),
(128, 'Roux Paul ', ''),
(129, 'Sylvie Le Boiteux', 'Sylvie Le Boiteux, professeur à l\'université Bordeaux 1.'),
(130, 'Cégep Vanier', 'Cégep Vanier, Canada\r\n\r\nTitulaire d\'un baccalauréat en physique de l\'Université de Montréal et de deux maîtrises (astrophysique et histoire des sciences) de l\'Université Harvard, il enseigne l\'astronomie et la physique au collège de Maisonneuve (Québec).\r\n\r\nDocteur en astrophysique de l\'Université de Montréal, il enseigne l\'astronomie et la physique au collège Édouard-Montpetit (Québec).\r\n\r\nCégep régional de Lanaudière à L\'Assomption, Canada'),
(131, 'Benson ', ''),
(132, 'Romain Maciejko', ''),
(133, 'Emile Biémont', ''),
(134, 'Collectif Tec et Doc', ''),
(135, 'Claude Chèze', ''),
(136, 'Michel Henry', ''),
(137, 'Daniel Blanc ', ''),
(138, 'Antoine Georges', 'Né en 1961, Antoine Georges est physicien. D\'abord chercheur au Laboratoire de physique théorique de l\'École normale supérieure, il est devenu, en 2003, professeur de physique à l\'École Polytechnique. Depuis 2009, il est professeur au Collège de France, titulaire de la chaire de Physique de la matière condensée.'),
(139, 'Donald Allan MacQuarrie', ''),
(143, 'Llllll', ''),
(144, 'Llllllkklkkkkllkklknnk Nklkklkl', ''),
(145, 'Leila Kadmi', ''),
(146, 'Khadidja2', 'kkkkkkkk'),
(147, 'Cecile Fabre', ''),
(148, 'Fabrice Issac', ''),
(149, 'Stephen D. Burd ', ''),
(150, 'Alain Cazes', 'Alain Cazes était maître de conférences en informatique au Conservatoire national des Arts et Métiers. Il est docteur en informatique.'),
(151, 'Jean-Pierre Regourd', ''),
(152, 'Gérard Haas', ''),
(153, 'Joffrey Clarhaut', ''),
(154, 'Nicolas DUPOTY', ''),
(155, 'Jérôme Hennecart', ''),
(156, 'Frédéric VICOGNE', 'Frédéric VICOGNE : Enseignant en électronique, informatique et numérique. Responsable du module gestion et administration Linux de la licence CDAISI. Concepteur hardware et software de circuits numériques 32 bits. Spécialiste en radio-transmission numérique.'),
(157, 'Emmanuel Auclair', ''),
(158, 'Jean-Paul Logé', ''),
(159, 'Stéphane Balac', ''),
(160, 'Daniel Lines', ''),
(161, 'Harris Benson', ''),
(162, 'Jean-Laurent Peube', ''),
(163, 'Abraham Bers', ''),
(164, 'Jean-Paul Parisot', ''),
(165, 'Eugene Hecht', ''),
(166, 'Yunus A. Cengel', ''),
(167, 'Christos Comninellis', ''),
(168, 'Jean-Marie Tarascon', 'Jean-Marie Tarascon est professeur au Collège de France à la chaire \"Chimie du solide et énergie\". Il dirige également le RS2E (Réseau français sur le stockage électrochimique de l\'énergie).'),
(169, 'Jean Coudert', ''),
(170, 'Daniel Fredon', ''),
(171, 'Bruno Fosset', ''),
(172, 'Philippe Espau', ''),
(173, 'Michel Soustelle', ''),
(174, 'André Bachellerie', ''),
(175, 'T. Fillon', ''),
(176, 'Thierry Finot', ''),
(177, 'Paul Rigny', ''),
(178, 'Mefteh-A', ''),
(179, 'Romain Barbe', ''),
(180, 'Douglas A. Skoog', ''),
(181, 'Jean Ducret', ''),
(182, 'Alan G. Sharpe', ''),
(183, 'Laura Sigg', ''),
(184, 'Saïda Semsari ', ''),
(185, 'Paul Arnaud', ''),
(186, 'Guitton-Shum', ''),
(187, 'K. Peter C', ''),
(188, 'Didier Rioux', ''),
(189, 'Claude Esnouf', ''),
(190, 'William Clegg', ''),
(191, 'Jean-Marc Montel', '');

-- --------------------------------------------------------

--
-- Table structure for table `authors_gp`
--

CREATE TABLE `authors_gp` (
  `idAGP` int(11) NOT NULL,
  `codeUser` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `idGP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors_gp`
--

INSERT INTO `authors_gp` (`idAGP`, `codeUser`, `name`, `idGP`) VALUES
(1, 1, 'Leila Kasmi', 1),
(12, 2, 'khadidja Bouaka', 1),
(44, 0, 'Chahtou Ahmed', 21),
(45, 0, 'Guennoun, Mhamed', 22),
(46, 0, 'Guennoun Oualid', 22),
(47, 0, 'Bentata Zahira', 23),
(48, 0, 'Bahi Fatima', 23),
(49, 0, 'Gaidi Amel', 24),
(50, 0, 'Elmaoussi Rachida', 24),
(51, 0, 'Mokhtar Kharroubi, Leila', 25),
(52, 0, 'Anab Ali', 26),
(53, 0, 'Mostghanemi  Asmaa', 26),
(54, 0, 'Aris Fatima El Zohra ', 27),
(55, 0, 'Benmessabih Nour El Houda', 27),
(56, 0, 'Ameur Kheira', 28),
(57, 0, 'Alem Nora', 28),
(58, 0, 'Belarbi Khadidja', 29),
(59, 0, 'Ezzine Amina', 29),
(60, 0, 'Ababsa Aicha', 30),
(61, 0, 'Hichour Madani', 31),
(62, 0, 'El Gouteni Mohamed El Amine', 32),
(63, 0, 'Abou Souhila', 33),
(64, 0, 'Abou Souhila', 34),
(65, 0, 'Baira Melouka', 35);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `idBook` int(11) NOT NULL,
  `nameBook` text NOT NULL,
  `parallelTitele` text NOT NULL,
  `image` text NOT NULL,
  `summary` longtext NOT NULL,
  `hardCover` int(11) NOT NULL,
  `idPublisher` int(11) NOT NULL,
  `dateOfPublisher` year(4) NOT NULL,
  `idLanguage` int(11) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `idAuthors` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `nbrBook` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `nbrCopy` int(11) NOT NULL DEFAULT `quantity`
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`idBook`, `nameBook`, `parallelTitele`, `image`, `summary`, `hardCover`, `idPublisher`, `dateOfPublisher`, `idLanguage`, `isbn`, `quantity`, `idAuthors`, `idType`, `nbrBook`, `idCategorie`, `nbrCopy`) VALUES
(1, 'Éléments de théorie des graphes', '', 'IMG-6436ecaf3d9944.37667782.jpg', 'Ce livre est une introduction développée à la théorie des graphes. Autour de cette théorie se développe aujourd\'hui l\'un des domaines les plus féconds et les plus dynamiques des mahématiques et de l\'informatique. La théorie des graphes permet de répr', 372, 8, '2012', 3, '9782746248502', 3, 1, 2, 1, 2, 3),
(2, 'Logique élémentaire', 'Cours de base pour informaticiens', 'IMG-6436ecd5a00955.24513739.jpg', 'L’informaticien doit être capable de raisonner sur des objets tels que programmes, structures de données, systèmes, processus, circuits logiques, et il a besoin pour cela d’un outil de base. Essentiellement pédagogique, cet ouvrage se propose donc d’', 432, 7, '1998', 3, '9782889142033', 2, 2, 2, 2, 2, 2),
(3, 'Modèles logiques et systèmes d\'intelligence articielle', '', 'IMG-6436edb9188bb3.90938938.jpg', 'Théorie de la démonstration et sémantique de la programmation logique; logique mathématique, modale, intuitionniste, temporelle propositionnelle.', 352, 3, '1990', 3, '9782746235687', 4, 3, 2, 3, 2, 4),
(4, 'MATHCAD 7', 'MANUEL DE L\'UTLISATEUR', 'IMG-6436eebcd89056.33101590.png', 'Mathcad Prime is the industry’s leading engineering math software. You use it to perform highly accurate calculations easily, and then preserve, share, and reuse those calculation so that you get the most from your important intellectual property.', 0, 4, '1997', 3, '21474836472', 4, 4, 2, 4, 2, 4),
(5, 'Faire des Mathématiques avec MATHEMATICA', 'Mathématiques pratiques', 'IMG-6436ef7617c8d2.48897981.png', 'L\'ouvrage apprend concrètement à utiliser efficacement un logiciel de calcul formel pour résoudre des problèmes scientifiques.\r\nUne première partie d\'initiation permet une familiarisation rapide et efficace avec le logiciel Mathématica, et la manipul', 160, 2, '2001', 3, '21474836473', 5, 5, 2, 5, 2, 5),
(6, 'Algorithmique', 'Exercices corrigés (ANNALES ENS & POLYTECHNIQUE)', 'IMG-6436efcd67a002.50554796.jpg', '38 exercices corrigés posés à l\'épreuve orale d\'informatique du concours d\'entrée à l\'ENS Lyon. Plus qu\'un livre d\'annales corrigées, cet ouvrage est un recueil d\'exercices d\'algorithmes qui intéressera également les élèves de 1er cycle des universit', 144, 2, '1993', 3, '21474836474', 3, 6, 2, 6, 2, 3),
(7, 'Lambda-calcul', 'types et modèles', 'IMG-6436eff7cf7613.27070064.jpg', 'Les liens etroits qu\'entretient le lambda-calcul de church avec la logique et en particulier avec la theorie de la demonstration, en font un outil abstrait particulierement adequat a l\'etude de l\'execution des programmes. Le propos de la these est de', 176, 1, '1997', 3, '9782225820915', 3, 7, 2, 7, 2, 3),
(8, 'Systèmes formels', 'Introduction à la logique et à la théorie des langages', 'IMG-6436f02503a4a0.25397107.webp', 'Cette introduction aux fondements logiques de l\'informatique décrit les mécanismes de production d\'énoncés du double point de vue syntaxique et sémantique. L\'auteur comble une lacune due au rôle nécessairement dominant de l\'algorithmique, la programm', 166, 1, '1991', 3, '9782225825675', 2, 8, 2, 8, 2, 2),
(9, 'المحاكاة الحاسوبية', '', 'IMG-6436f148968ff4.06999056.jpg', 'إن التطورات الحديثة في مجال الحاسبات وهندسة البرامجيات قد وفرت تقنيات عالية في محاكاة التطبيقات العلمية واعطائها صورة صورة أقرب إلى الواقع حيث أصبح واضحا أنه لاغنى عن هذه التقنيات في دراسات وتحليل المسائل العلمية في مجالات الحياة كاملة . لذا تعد المح', 260, 6, '2002', 1, '0', 2, 9, 2, 9, 2, 2),
(10, 'nouveaux exercices d\'algorithmique', '', 'IMG-6436f19622ad14.08267252.png', 'Si l\'apprentissage de l\'informatique requiert une solide base théorique, on ne peut pas l\'envisager sans une exploration par la pratique.\r\nCes cent trois exercices et ces cinq problèmes d\'algorithmique répondent à cette nécessité.\r\n\r\nIls recouvrent l', 142, 9, '2000', 3, '9782711789900', 2, 10, 2, 10, 2, 2),
(11, 'Fractions et polynômes', 'problèmes à combiner', 'IMG-643c2bd0c1c8c1.03528753.jpg', 'Cet ouvrage s\'adresse aux étudiants des classes préparatoires scientifiques ou du premier cycle universitaire, aux professeurs enseignant à ce niveau et aux candidats à l\'agrégation. Il est constitué d\'énoncés corrigés qui se combinent pour former de', 208, 2, '1998', 3, '9782729894856', 1, 11, 4, 7, 2, 1),
(12, 'Thèmes d\'arithmétique', 'Avec plus de 85 exercices corrigés', 'IMG-643c2b93618db2.40364684.jpg', 'L\'arithmétique est l\'une des branches des mathématiques les plus fascinantes, car elle permet à celui qui l\'étudie, professionnel ou amateur, de mettre en avant sa créativité et son imagination pour tenter de résoudre un problème donné, en n\'ayant à', 288, 2, '2006', 3, '9782729827144', 3, 12, 4, 6, 2, 3),
(13, 'Arithmétique', 'Cours, Exercices et Travaux Pratiques sur Micro-ordinateur', 'IMG-643c299a290821.12613637.jpg', 'Ce fascicule d\'Arithmétique, destiné aux étudiants et aux enseignants des filières Mathématiques des premiers cycles des universités ou des classes préparatoires scientifiques, propose, outre un cours et des exercices classiques sur les entiers, les', 96, 2, '1998', 3, '9782729890124', 1, 13, 4, 2, 2, 1),
(14, 'Arithmétique pour l\'informatique - Algèbre', 'Cours et exercices corrigés - Licence 2 et 3 mathématiques et informatique', 'IMG-643c2964a91874.19444534.jpg', 'Rédigé à l\'attention des étudiants en deuxième et troisième années de Licence de mathématiques et d\'informatique, ce cours d\'arithmétique est illustré de plus de 130 exercices corrigés. Il développe notamment les propriétés fondamentales de l\'ensembl', 212, 9, '2014', 3, '9782311009965', 1, 14, 4, 1, 2, 1),
(15, 'Mathématiques financières', '', 'IMG-643c2a89690b00.55929249.png', 'Ce livre a pour objectif de donner une méthodologie et des outils mathématiques pour aborder les problèmes de base de la finance et des mathématiques financières. En effet, un des concepts fondamentaux de la finance est celui de la valeur de l\'argent', 338, 5, '1983', 3, '9780075484660', 3, 15, 4, 3, 2, 3),
(16, 'LOGIQUE ARITHMETIQUE ET TECHNIQUES SYNCHRONES', 'Arithmétique binaire et décimale, Conception synchrone des ASICs et des FPGAs', 'IMG-643c2b21cdbe51.01364999.png', 'Ce cours présente les algorithmes fondamentaux de l\'arithmétique et les méthodes les plus récentes de conception synchrone de systèmes logiques. Les algorithmes d\'arithmétique binaire et décimale et les schémas associés sont présentés en première par', 0, 1, '1996', 3, '9782225852275', 2, 16, 4, 4, 2, 2),
(17, 'Découvrir l\'arithmétique', '', 'IMG-643c2b6498d1c6.83947256.jpg', 'Découvrir l\'arithmétique s\'adresse à l\'étudiant entrant à l\'université ou en classe préparatoire, voire à l\'étudiant de lycée. Par l\'importance de l\'arithmétique et de son histoire, il est aussi destiné aux candidats des concours, avec une pensée par', 122, 2, '2000', 3, '9782729879952', 2, 17, 4, 5, 2, 2),
(18, 'Cours et exercices d\'analyse', 'topologie, analyse fonctionnelle et matricielle', 'IMG-643c2c243851e4.65059484.jpg', 'Cet ouvrage de Cours et exercices de topologie et d\'analyse fonctionnelle et matricielle a été rédigé à partir des exigences du programme et des questions posées aux écrits et aux oraux des concours d\'entrée aux Grandes Ecoles : X, ENS, Mines-Ponts..', 352, 10, '2014', 3, '9782364930940', 1, 18, 5, 1, 2, 1),
(19, 'Invitation à la topologie algébrique', 'Tome 1 - Homologie', 'IMG-643c2c528a6415.79141776.jpg', 'Ce livre en deux tomes est une introduction à la topologie algébrique et plus particulièrement à la théorie de l\'homologie. Celle-ci associe à chaque espace topologique un module dont les propriétés algébriques reflètent celles de l\'espace considéré.', 297, 10, '2014', 3, '9782364931268', 1, 19, 5, 2, 2, 1),
(20, 'Invitation à la topologie algébrique 2', 'Tome 2 - Cohomologie, variétés', 'IMG-643c2c8aedff15.59146237.jpg', 'Le Tome II de ce livre introduit la cohomologie, qui est une théorie duale de l\'homologie, et examine les liens avec cette dernière ainsi que les divers produits construits sur les modules d\'homologie et de cohomologie. Nous étudions en détail les va', 297, 10, '2014', 3, '9782364931275', 1, 19, 5, 3, 2, 1),
(21, 'Introduction à la topologie générale', '', 'IMG-643c2cc1cb0a45.00622568.jpg', 'Cet ouvrage est le second volume de l\'ouvrage intitulé Cours d\'algèbre et topologie générale à l\'usage des étudiants de mathématiques et informatique. Il met en place les éléments essentiels à toute utilisation théorique ou pratique des notions de ba', 196, 11, '2009', 3, '9782705668921', 1, 20, 5, 4, 2, 1),
(22, 'Topométrie générale', '', 'IMG-643c2cf9d934d9.82378269.jpg', 'La matière se divise en six parties qui représentent autant de dimensions de la topométrie générale. Dans la première partie, les auteurs posent les bases de la discipline et fournissent des renseignements de nature paratopométrique. La deuxième part', 652, 12, '1996', 3, '9782553005701', 1, 21, 5, 5, 2, 1),
(23, 'Topologie', 'Cours et exercices corrigés4eme édition', 'IMG-643c2eb2399a36.76053721.jpg', 'Ce livre présente les notions et définitions de base de la topologie. Dans cette 6e édition, les concepts sont introduits de façon plus progressive pour s\'adapter aux besoins des étudiants, des exercices corrigés ont été renouvelés et des conseils mé', 352, 13, '2020', 3, '9782100577729', 2, 22, 5, 6, 2, 2),
(24, 'Topologie algébrique et théorie des faisceaux', '', 'IMG-6445868b1422d1.19504200.jpg', 'De toutes les idées qui circulent dans les milieux mathématiques actuels, celle de publier un ouvrage de référence consacré à la théorie des faisceaux est assurément l\'une des moins originales : la plupart des spécialistes de cette théorie en ont eu', 284, 11, '2006', 3, '9782705612528', 3, 23, 5, 8, 2, 3),
(25, 'Topologie, calcul différentiel et variable complexe', 'Cours et exercices', 'IMG-6445858027b062.71204044.jpg', '\"L\'ouvrage de Jean Saint Raymond aura à l\'évidence un réel impact sur plusieurs générations d\'étudiants.\"\r\nHervé Queffélec\r\n\r\nÉcrit par un des professeurs les plus appréciés du campus parisien de Jussieu, ce cours de licence \"L3\" vient à point pour r', 478, 14, '2008', 3, '9782916352039', 3, 24, 5, 9, 2, 3),
(26, 'topologie et d\'analyse', 'Exercices de topologie et d\'analyseTome 1', 'IMG-64458523aa9924.37055222.jpg', 'Propriétés des réels ; suites\r\nEspaces topologiques\r\nEspaces métriques\r\nEspaces vectoriels normés\r\nFonctions d\'une variable réelle\r\nFonctions usuelles ; développements limités et étude de fonctions\r\nIntégrale simple\r\nSuites et espaces de fonctions', 0, 9, '1995', 3, '9782711721450', 1, 25, 5, 10, 2, 1),
(27, 'Géométrie et topologie différentielles', '(1918-1932)', 'IMG-64458b924d2fb8.81753653.jpg', 'Ce recueil regroupe des textes mathématiques, publiés dans les années 1920, qui posent les bases des conceptions actuelles dans plusieurs branches de cette science : géométrie différentielle (notion de variété, notion de connexion), topologie différe', 366, 11, '2015', 3, '9782705681067', 1, 26, 7, 1, 2, 1),
(28, 'Géométrie analytique classique', '', 'IMG-64458bc10026e5.49892265.jpg', 'Un ouvrage destiné aux candidats des concours des grandes écoles, Capes et agrégation, reprenant les concepts fondamentaux de la géométrie avec une approche raisonnée de cette discipline, considérée autrement que comme une simple reformulation des én', 508, 14, '2009', 3, '9782916352084', 1, 27, 7, 2, 2, 1),
(29, 'Compléments de géométrie', '', 'IMG-64458bf2a71c21.83531431.jpg', 'géométrie métrique, géométrie projective, géométrie anallagmatique', 462, 15, '2012', 3, '9782876473478', 2, 28, 7, 3, 2, 2),
(30, 'Courbes algébriques planes, cubiques et cycliques', '', 'IMG-64458c22ac5066.20878817.jpg', '«Vingt fois sur le métier remettez votre ouvrage, polissez-le et sans cesse le repolissez», écrivait Boileau. Précepte qu\'applique P. Nicaise avec cette édition revue et augmentée de ses Courbes algébriques planes, cubiques et cycliques, qui s\'enrich', 642, 7, '2015', 3, '9782753904194', 6, 29, 7, 4, 2, 6),
(31, 'Systémes diffèrentiels', 'le formalisme des six opérations de Grothendieck pour les Dx- modules cohérents', 'IMG-6446d76c9bd0c8.25877713.png', 'L\'objectif de ce mémoire est l\'étude qualitative de quelques classes de systèmes différentiels planaires polynômiaux. Les résultats obtenus dans cette étude concernent la nature des points d\'équilibre, le portrait de phase et l\'existence et la non ex', 335, 11, '1989', 3, '9782705660499', 1, 30, 7, 5, 2, 1),
(32, 'Le problème des modules pour les branches planes', 'Cours donné au centre de mathématiques de l\'ecole polytechnique', 'IMG-6446d89eef7dd8.66789356.png', 'Appendice par Bernard Teissier. Sommaire : Préliminaires. Invariants d\'équisingularité. Représentaions paramétriques. L\'espace des modules. Études des exemples suivants. Le point de vue de la théorie des déformations.', 212, 11, '1997', 3, '9782705660369', 1, 31, 7, 6, 2, 1),
(33, 'Varietes Differentielles et Analytiques', 'Fascicule De Resultats', 'IMG-6446d979758bd8.16926912.png', 'Variétés différentielles et analytiques\r\nFascicule de résultats\r\nLes Éléments de mathématique de Nicolas BOURBAKI ont pour objet une présentation rigoureuse, systématique et sans prérequis des mathématiques depuis leurs fondements.\r\nCe fascicule rass', 182, 1, '2007', 3, '9782225828461', 1, 32, 7, 7, 2, 1),
(34, 'Les courbes dans le plan et dans l\'espace', '', 'IMG-6446d9b7708d58.36266726.png', 'fonctions valeurs dans un espace de dimension n, courbes en coordonnées polaires, courbes données par une équation paramétrique dans le plan et dans l\'espace, familles de courbes dépendant d\'un paramétre', 313, 2, '2002', 3, '2729886441', 5, 33, 7, 8, 2, 5),
(35, 'Les Systemes Differentiels Exterieurs et Leurs Applications Geometriques', '', 'IMG-6446da870636a4.97688163.jpg', 'Volume 994 de Actualités scientifiques et industrielles\r\nVolume 12 de Actualités scientifiques et industrielles. Exposés de géométrie\r\nVolume 12 de Exposés de géométrie', 214, 11, '1945', 3, '0', 2, 34, 7, 9, 2, 2),
(36, 'Géométrie différentielle et mécanique analytique', '', 'IMG-6446daf09192b6.70288112.jpg', 'Les exposés sont fort abstraits et présentés dans un cadre très génial... clairs, voire même attrayants... L\'ouvrage est d\'une haute teneur scientifique, remarquable de concision et de précision.', 184, 11, '2018', 3, '9782402626057', 4, 35, 7, 10, 2, 4),
(37, 'Mathématiques PSI', '', 'IMG-642aec401610b1.33090618.jpg', 'Des fiches de cours, des conseils méthodologiques et des exercices avec leurs corrigés.', 504, 2, '2015', 3, '9782340006652', 1, 36, 1, 1, 2, 1),
(38, 'Mathématiques - pour le DUT génie civil', 'Rappels de cours et exercices corrigés - Conforme au nouveau programme 2013', 'IMG-6436ea911122e1.21338588.jpg', 'Cet ouvrage s\'adresse aux étudiants de D.U.T. Génie civil, aux enseignants ainsi qu\'à tous ceux qui souhaitent se remettre à niveau dans le cadre de la préparation d\'un examen. De par la présence de rappels de cours, d\'exercices et de travaux pratiqu', 558, 2, '2013', 3, '9782729882495', 1, 37, 1, 2, 2, 0),
(39, 'Mathématiques du DUT informatique', 'Cours, exemples, codes sources, exercices corrigés, projets informatiques, guide de programmation en C, Python, Java, HTML, PHP et Bash', 'IMG-6436ead6d2b8e4.25462874.jpg', 'Conforme au nouveau programme.\r\n\r\nPour les étudiants préparant le DUT informatique (mais aussi les DUT R&T (Recherche et Technologies) et réseaux de communication), les étudiants de licence mathématiques et informatique, les élèves de classes prépara', 326, 2, '2015', 3, '9782340003767', 1, 38, 1, 3, 2, 1),
(40, 'Approximation numérique avec MATLAB', 'Programmation vectorisée, équations aux dérivées partielles - Calcul scientifique', 'IMG-6436eb2065d9a2.75471656.jpg', 'Pour tous ceux qui utilisent le calcul scientifique, l\'ouvrage (qui suppose quelques connaissances en analyse numérique), développe de façon progressive les techniques de programmation MATLAB pour l\'approximation numérique des équations aux dérivées', 312, 2, '2011', 3, '9782340004030', 4, 39, 1, 4, 2, 4),
(41, 'Mathématiques et informatique 2', '2e année ecs - licences scientifiques', 'IMG-6436eb564f7a29.50002897.jpg', 'Une approche novatrice pour parfaitement assimiler un cours et réussir vos épreuves de concours. Les méthodes pour acquérir l\'essentiel et assimiler en profondeur. M et A vous propose une approche pédagogique progressive, claire et directe afin de ré', 0, 16, '2011', 3, '9782743013813', 2, 40, 1, 5, 2, 2),
(42, 'L\'essentiel des maths HEC', 'ECS prépa commerciale voie scientifique', 'IMG-6436ec62b259e3.02283873.jpg', 'La réussite en mathématiques aux concours commerciaux passe d\'abord et avant tout par une excellente connaissance du cours, c\'est-à-dire de l\'ensemble des définitions, théorèmes et propriétés au programme.\r\n\r\nMais encore faut-il être en mesure d\'avoi', 200, 17, '2016', 3, '9782749535036', 4, 41, 1, 10, 2, 3),
(43, 'Mathématiques et informatique 1', 'ECS 1re année', 'IMG-6436eb9544b552.56483600.jpg', 'Une approche novatrice pour parfaitement assimiler un cours et réussir vos épreuves de concours\r\nMéthodes\r\nPour acquérir l\'essentiel et assimiler en profondeur\r\nM&A vous propose une approche pédagogique progressive, claire et directe afin de résoudre', 544, 16, '2011', 3, '9782743013639', 1, 40, 1, 6, 2, 1),
(44, 'Epistémologie mathématique', '', 'IMG-6436ec385679b3.49448926.jpg', 'L\'épistémologie est la philosophie des sciences.\r\n\r\nL\'épistémologie mathématique a pour but de réfléchir à ce que l\'on fait vraiment quand on fait des mathématiques, et d\'analyser le rapport entre cette pratique et la pratique des autres sciences. Le', 0, 2, '2011', 3, '9782729870454', 2, 42, 1, 9, 2, 2),
(46, 'Toutes les mathématiques', 'MP/MP*Cours, exercices corrigés - Nouveau programme', 'IMG-6436ebd1b69797.97572077.jpg', 'Ce livre est découpé en 3 parties :\r\n\r\nrécapitulatifs approfondis de MPSI ;\r\nau coeur du programme de MP ;\r\nenrichissements culturels, interdisciplinaires et hors programmes MP.', 882, 2, '2014', 3, '9782340000384', 4, 44, 1, 7, 2, 4),
(47, 'Les nombres', 'Construction basée sur la théorie des ensembles en vue d\'ériger les fondements de l\'analyse', 'IMG-643c25e10cafb1.99938747.jpg', 'Si tout un chacun possède une idée intuitive de ce qu\'est un nombre, il aura fallu attendre le début du XXe siècle pour obtenir une définition rigoureuse. Puisque le mathématicien élabore des concepts à partir d\'autres introduits antérieurement, rien', 306, 11, '2015', 3, '9782705690953', 1, 45, 3, 1, 2, 1),
(48, 'Mathématiques pour l\'étudiant de première année', 'Algèbre et géométrie', 'IMG-643c2613c38c94.53707692.jpg', 'Manuel : niveau L1, cours et exercices corrigés. L\'apprentissage pratique précède les fondements théoriques. De nombreuses figures et schémas.\r\n\r\nOutil de référence : niveaux Licence et Capes. Un index très détaillé. Chaque chapitre peut être abordé', 592, 18, '2016', 3, '9782842252090', 1, 46, 3, 2, 2, 1),
(49, 'Exercices d\'algèbre et d\'analyse', '154 exercices corrigés de première année', 'IMG-643c27738bd0d0.70872653.jpg', 'Ce livre d\'exercices corrigés d\'algèbre et d\'analyse s\'adresse de manière plus spécifique aux élèves de première année des cycles préparatoires intégrés des écoles d\'ingénieurs mais il peut être utilisé avec profit par tout étudiant se destinant à de', 432, 7, '2015', 3, '9782889151523', 1, 47, 3, 4, 2, 1),
(50, 'Algebre - analyse probabilites', '', 'IMG-643c265452e572.67223871.jpg', 'Cet ouvrage d\'exercices avec solutions à l\'usage des candidats aux concours d\'entrée aux grandes écoles, mais aussi des candidats au CAPES ou à l\'Agrégation est constitué de 10 chapitres, chacun commençant par quelques rappels de cours, tout énoncé é', 456, 10, '2015', 3, '9782364931923', 1, 18, 3, 3, 2, 1),
(51, 'Exercices et problèmes de cryptographie', '', 'IMG-643c280802eb21.56714561.jpg', 'Cet ouvrage s’adresse aux étudiants de second cycle d’informatique ou de mathématiques ainsi qu’aux élèves en écoles d’ingénieurs.\r\n\r\nLe bagage informatique et mathématique requis pour aborder le livre est celui que l’on acquiert lors des deux premiè', 304, 13, '2018', 3, '9782100787111', 1, 48, 3, 5, 2, 1),
(52, 'Introduction à la théorie analytique et probabiliste des nombres', '', 'IMG-643c2845993846.25973109.jpg', 'Introduction à la théorie analytique et probabiliste des nombresSolide initiation aux méthodes analytiques et probabilistes de l\'arithmétique, ce livre constitue une référence indispensable.Ne s\'appuyant que sur les connaissances traditionnellement e', 592, 19, '2015', 3, '9782701196565', 3, 49, 3, 6, 2, 3),
(53, 'Toute l\'algèbre de la licence', 'Cours et exercices corrigés', 'IMG-643c2894015da9.00377205.jpg', 'Cet ouvrage présente toute l\'algèbre des trois premières années d\'université : espace vectoriel, application linéaire, techniques de calcul, bases, matrices, groupes et géométrie affine. L\'auteur discute dans un premier temps de quelques exemples qui', 736, 13, '2020', 3, '9782100556717', 3, 50, 3, 7, 2, 3),
(54, 'Théorie des groupes', 'Cours et exercices corrigés – L3 & Master', 'IMG-643c28cd7f2832.34034488.jpg', 'En mathématique, plus précisément en algèbre générale, la théorie des groupes est la discipline qui étudie les structures algébriques appelées groupes. Le développement de la théorie des groupes est issu de la théorie des nombres, de la théorie des é', 204, 9, '2011', 3, '9782311002775', 1, 51, 3, 8, 2, 1),
(55, 'Algèbre - Exercices et problèmes - Licence', 'Rappels de cours - Exercices et problèmes avec corrigés détaillés - Fiches de révision', 'IMG-643c290bc0cd18.92575661.jpg', 'Cet ouvrage se propose d\'accompagner l\'étudiant en Licence (Mathématiques, Sciences de la Matière) dans son assimilation des connaissances. Dans chaque chapitre, le lecteur trouvera :\r\n\r\nUn rappel de cours concis\r\nDes énoncés d\'exercices et de problè', 446, 13, '2008', 3, '9782100515523', 3, 52, 3, 10, 2, 3),
(56, 'Toute l\'analyse de la licence', '2e éd.- cours et exercices corrigés', 'IMG-644586fda03e42.96192437.jpg', 'Cet ouvrage présente les éléments principaux d’analyse enseignés en Licence en prenant comme point de départ la construction des nombres réels. Les objets de l’analyse sont définis les uns après les autres : suites, fonctions continues, dérivables, i', 672, 13, '2020', 3, '9782100811694', 1, 50, 6, 1, 2, 1),
(57, 'Initiation à l\'analyse et à l\'algèbre en L1', 'Cours et exercices corrigés', 'IMG-644587495cb985.86252675.jpg', 'L\'analyse et l\'algèbre présentées dans ce livre sont des outils de base pour démarrer des études universitaires après un bac scientifique. Certaines notions ont déjà été vues en terminale mais on les reprend ici de façon plus approfondie.', 256, 2, '2015', 3, '9782340006591', 1, 53, 6, 2, 2, 1),
(58, 'Initiation à l\'analyse complexe', 'Cours et exercices corrigés', 'IMG-644588a1edd837.63207191.jpg', 'Cet ouvrage présente, sans autre connaissance préalable pour le lecteur qu\'une certaine familiarité avec l\'analyse mathématique, l\'essentiel de la théorie des fonctions d\'une variable complexe. Il conviendra donc aux étudiants universitaires de licen', 144, 2, '2014', 3, '9782340002135', 1, 54, 6, 3, 2, 1),
(59, 'Analyse complexe', 'Un regard analytique et géométrique enrichi de 230 exercices corrigés', 'IMG-644589011b3191.68580124.jpg', 'Cet ouvrage décline l\'analyse complexe en une variable au niveau master. Organisé en quatre chapitres, il reflète un point de vue qui se veut autant géométrique qu\'analytique (mais aussi culturel) et se fixe pour objectif de mettre en lumière le rôle', 408, 2, '2014', 3, '9782340000292', 1, 55, 6, 4, 2, 1),
(60, 'Initiation à l\'analyse mathématique', 'Cours et exercices corrigés', 'IMG-64458961003769.00342157.jpg', 'Les fondements de l\'analyse mathématique, avec plus de 350 exercices corrigés, ton informel mais rigoureux, pour les étudiants en L2 et L3 et les élèves d\'écoles d\'ingénieur.', 456, 2, '2015', 3, '9782340003644', 4, 54, 6, 5, 2, 4),
(61, 'Mini manuel d\'analyse', 'L1, IUT - Cours et exercices corrigés', 'IMG-64458b442f4c50.16250004.jpg', 'Cet ouvrage de la collection \"Mini Manuel\" présente tous les aspects de l\'analyse abordés en première année de Licence (filières mathématiques et Sciences de la matière). Des conseils méthodologiques mettent en évidence la démarche. En fin de chapitr', 226, 13, '2010', 3, '9782100545636', 1, 56, 6, 10, 2, 1),
(62, 'Calcul différentiel', 'Cours et exercices corrigés', 'IMG-6445899a949f73.30564103.jpg', 'Topologie élémentaire pour la licence de mathématiques\r\n\r\nLe calcul différentiel est un outil dont tout mathématicien, quelle que soit sa spécialité, doit en posséder les rudiments. Même les spécialistes de mathématiques discrètes ne peuvent s\'en pas', 354, 10, '2015', 3, '9782364935075', 1, 57, 6, 6, 2, 1),
(63, 'Petit guide de calcul différentiel', 'A l\'usage de la licence et de l\'agrégation', 'IMG-64458b11720a84.72841902.jpg', '133 exercices et leurs corrigés détaillés, commentés, illustrés de 190 croquis, sont proposés au lecteur (qui n\'en demandait pas tant...) dans cette troisième édition, revue et corrigée. C\'est avant tout par la pratique d\'exemples, de difficulté vari', 440, 18, '2015', 3, '9782842251864', 4, 58, 6, 9, 2, 4),
(64, 'Éléments d\'analyse', 'Calcul intégral et différentielCours, exercices et problèmes de synthèse corrigés', 'IMG-64458add7e7967.40858962.jpg', 'Les éléments d\'analyse présentés constituent l\'essentiel des enseignements de mathématiques en première année des écoles d\'ingénieurs avec classe préparatoire intégrée (INSA, UTT, ENSAM) et en premiers cycles universitaires scientifiques orientés ver', 230, 2, '2009', 3, '9782729852795', 1, 59, 6, 8, 2, 1),
(65, 'Analyse numérique et équations différentielles', '', 'IMG-64458aa6aba6f4.47129742.jpg', 'Cet ouvrage est la quatrième édition d\'un livre devenu aujourd\'hui un classique sur la théorie des équations différentielles ordinaires. Le cours théorique de base est accompagné d\'un exposé détaillé des méthodes numériques qui permettent de résoudre', 400, 20, '2016', 3, '9782759819263', 1, 60, 6, 7, 2, 1),
(66, 'Introduction au calcul des probabilités et à la statistique', 'Exercices, problèmes et corrections', 'IMG-6446e5112d4dd5.22435879.jpg', 'Cet ouvrage d\'exercices et de problèmes corrigés se fixe pour but d\'illustrer les concepts de base des probabilités et de la statistique mathématique présentés dans l\'ouvrage Introduction au calcul des probabilités et à la statistique. Il présente des exercices de manipulation qui permettent d\'appréhender les concepts du cours (variables aléatoires, théorèmes asymptotiques, modèles gaussiens, estimations paramétriques, tests, régions de confiance). Il comporte également une part importante d\'exercices et de problèmes de modélisation avec des applications diverses dans plusieurs domaines scientifiques (mathématiques, physique, sciences de l\'ingénieur, sciences du vivant, économie...).', 448, 21, '2016', 3, '9782722509436', 3, 65, 9, 10, 2, 3),
(67, 'Probabilités discrètes', 'recueil d\'exercices corrigés, licence 1-2', 'IMG-6446e4b0dd3184.19689689.jpg', 'Cet ouvrage est un recueil de 332 exercices entièrement corrigés sur les probabilités discrètes. Il répond à une demande forte des étudiants de Licence 1 et Licence 2. Les exercices proposés viennent d\'horizons divers (sujets d\'examens, classiques revisités, problèmes concrets). Leur présence dans ce recueil repose essentiellement sur des critères pédagogiques. Ils sont classés par thèmes allant du plus simple (dénombrement, probabilités de base) au plus évolué (couples de variables aléatoires réelles discrètes, vecteurs de variables aléatoires réelles discrètes).\r\n\r\nLes bases des probabilités abordées en Terminale sont rappelées et font l\'objet de nombreux exercices. La difficulté est progressive tout en restant bien dosée. Fait rare : chacun des 332 exercices est corrigé dans les moindres détails. Toutes les formules utilisées sont rappelées à la fin de l\'ouvrage sous la forme d\'un formulaire clair, précis et concis.', 316, 21, '2016', 3, '9782340010031', 4, 66, 9, 9, 2, 4),
(68, 'Estimation non-paramétrique', '', 'IMG-6446e4459cd690.30640785.jpg', 'Cet ouvrage, nouveau en son genre, traite, en français, d\'estimation non paramétrique à un niveau accessible à des étudiants de Master. Seules quelques connaissances élémentaires en probabilités sont nécessaires pour aborder ce cours très clair et détaillé.', 120, 22, '2015', 3, '978236693283', 3, 67, 9, 8, 2, 3),
(69, 'Probabilités discrètes', 'Cours et exercices - Mathématiques spéciales MP, MP*, PSI*, CAPES, Agrégation', 'IMG-6446e3b701e290.35809112.jpg', 'Ce recueil est un ouvrage de cours et exercices concernant les probabilités discrètes autrement dit les variables aléatoires essentiellement réelles à valeur dans un ensemble fini ou dénombrable.', 330, 10, '2015', 3, '9782364931732', 3, 18, 9, 7, 2, 3),
(70, 'Methodes statistiques', 'Concepts, applications et exercices', 'IMG-6446e3344f6a69.07863282.jpg', 'Méthodes statistiques - Concepts, applications et exercices présente de façon synthétique un large éventail de méthodes statistiques rarement réunies dans un même ouvrage : inférence paramétrique, tests non paramétriques, analyse de séries chronologiques, analyse de régression, analyse de variance et analyse en composantes principales.', 546, 23, '2014', 3, '9782553016738', 2, 68, 9, 6, 2, 2),
(71, 'Algorithmes et théorie des nombres', 'Cours, exercices corrigés, avec programmes en langage C', 'IMG-6446db58270aa6.27516534.jpg', 'Ce livre présente une approche graduelle, théorique et pratique de l\'arithmétique, Commençant par les problèmes de division et par l\'algorithme d\'Euclide comme on les apprend au lycée, il monte progressivement en puissance. Il traite notamment le théorème chinois, les problèmes de factorisation, la cryptographie, la fonction de Möbius et les récurrences modulaires, pour aboutir aux notions de crible quadratique, de courbes elliptiques et de vecteurs courts dans un réseau de points.', 432, 2, '2014', 3, '9782729886721', 1, 69, 8, 1, 2, 1),
(72, 'Algorithmes', 'Notions de base', 'IMG-6446db8ac13127.66197758.jpg', 'Explications du fonctionnement des algorithmes et de leur évaluation. L\'ouvrage décrit également comment modéliser un problème de façon à ce qu\'il puisse être résolu par ordinateur.', 240, 13, '2013', 3, '9782100701513', 8, 70, 8, 2, 2, 8),
(73, 'Exercices et problèmes d\'algorithmique numérique', 'rappels de cours, exercices et problèmes avec corrigés détaillés', 'IMG-6446dbbf5b1da5.36121087.jpg', 'Aujourd\'hui le calcul scientifique et les méthodes numériques sont omniprésents dans les sciences de l\'ingénieur. Face à un problème qui nécessite une grosse puissance ce calcul la première étape consiste à l\'étudier d\'un point de vue mathématique. Puis la stratégie de résolution étant établie l\'étape suivante consiste à élaborer les algorithmes de calcul qui seront mis en oeuvre dans les programmes de calcul.', 212, 13, '2011', 3, '9782100556038', 3, 71, 8, 3, 2, 3),
(74, 'Introduction à l\'analyse numérique', '', 'IMG-6446dc0f7baa63.10015617.jpg', 'Cet ouvrage présente une introduction aux notions mathématiques nécessaires à l\'utilisation des méthodes numériques employées dans les sciences de l\'ingénieur.', 254, 7, '2017', 3, '9782880748517', 2, 72, 8, 4, 2, 2),
(75, 'Pratique de la simulation numérique', 'Série conception', 'IMG-6446df216a1b17.18319346.jpg', 'La simulation numérique est aujourd\'hui un outil incontournable de compréhension du réel et d\'aide à la conception. Les progrès des ordinateurs permettent la simulation réaliste et, parfois, l\'optimisation de systèmes complexes. Encore faut-il savoir utiliser cet outil. Choisir le bon schéma, construire le maillage adapté ne sont pas possibles sans une bonne compréhension des méthodes', 420, 13, '2003', 3, '9782100064076', 1, 73, 8, 6, 2, 1),
(81, 'Architecture des machines et des systèmes informatiques', '', 'IMG-642ac7a24c3bb4.10946314.png', 'This book presents the functioning of a computer at the hardware and operating system level. The computer is thus studied from its highest level - that of the programming language and the system interface - to its lowest level - that of binary execution and electronic components.\r\nFor each function or component of the machine, the basic concepts are presented and illustrated by architectures based on known processors or operating systems.\r\n\r\nEach part ends with a series of corrected exercises.\r\n\r\nThis sixth edition includes a few new exercises and a more in-depth look at operating system concepts, including process synchronization and the command language for processes and files.\r\n\r\nTranslated with www.DeepL.com/Translator (free version)', 544, 13, '2018', 3, '9782100727056', 4, 83, 11, 1, 1, 4),
(82, 'Le grand manuel de l\'ordinateur portable', '', 'IMG-642acf93671cb1.51247478.jpg', 'Alors ça y est ? Vous avez acheté un ordinateur portable pour vous mettre à l\'informatique et à l\'Internet ? Bravo ! Grâce à ce livre pratique, très illustré et rédigé avec des mots simples, vous vous familiariserez en douceur avec votre nouveau compagnon et apprendrez à l\'utiliser en toute facilité. Très bientôt, vous serez aussi à l\'aise avec le clavier qu\'avec Windows Vista, et vous pourrez aller où bon vous semble sur le Web !', 350, 25, '2008', 3, '9782754010009', 3, 84, 11, 7, 1, 3),
(83, 'Architecture des réseaux fixe', '', 'IMG-642accb55a7a18.66311272.jpg', 'Si les concepts de base de l\'architecture des réseaux fixes locaux LAN sont relativement simples à appréhender, la tâche s\'avère plus complexe pour les réseaux étendus WAN puisque plusieurs technologies, parfois concurrentes, coexistent actuellement. La normalisation a certes établi des protocoles, mais la structure du réseau dans sa globalité est spécifique pour chaque concepteur.\r\n\r\nCet ouvrage présente les principales technologies employées dans les différentes composantes du réseau WAN :\r\n\r\nles systèmes de transmission sur paires métalliques (xDSL), sur fibres optiques (EFM et GPON) et radioélectriques (Wi-Fi) qui caractérisent le réseau d\'accès ;\r\nla technologie Ethernet, adaptée aux besoins des opérateurs et largement déployée dans le réseau d\'agrégation ;\r\nles technologies MPLS-VPN (VPN de niveau 3 ou VPN IP) et VPLS (VPN de niveau 2 ou VPN Ethernet) utilisées par le coeur de réseau ;\r\nle système de transmission sur fibre optique OTN servant dans le réseau d\'agrégation et le coeur de réseau.', 320, 26, '2011', 3, '9782746225145', 1, 85, 11, 3, 1, 1),
(84, 'Créez votre premier site web', 'De la conception à la réalisation', 'IMG-642acd5c2a2704.66009682.jpg', 'Aujourd\'hui, que vous soyez particulier, en charge d\'une association, artisan ou responsable d\'une petite entreprise, vous serez amené, à un moment ou à un autre, à créer votre site pour présenter vos hobbies, votre activité, votre entreprise... Nous disposons de tous les moyens techniques mais la mise en place d\'un tel projet reste malgré tout une tâche ardue pour qui n\'est pas du métier. Ce livre a pour objectif de vous apprendre à concevoir et à réaliser votre projet de A à Z. Il se compose de deux parties, méthodologique et pratique.\r\n\r\nVous commencerez par découvrir ce qu\'est un site web : quelles sont les technologies exploitées, quels sont les différents types de contenus que l\'on peut afficher et comment les mettre en oeuvre ? Vous découvrirez les différentes possibilités pour créer le site et leurs implications techniques. Les CMS (Content Management System) permettent de créer et de gérer des sites web sans connaissance technique et sont aujourd\'hui la solution la plus utilisée : nous vous donnons des indications pour le choix du CMS à utiliser selon les fonctionnalités que vous souhaitez implanter dans votre site (multilinguisme, création de champs personnalisés, droits des utilisateurs, gestion des médias...) : nous verrons les solutions proposées par plusieurs CMS (Joomla!, WordPress, SPIP, PluXml, Zwii...) pour chacun de ces critères.\r\n\r\nUne fois le choix de la technologie effectué, il est essentiel de s\'attacher à l\'ergonomie, au design de votre site ainsi qu\'à la navigation entre les pages afin de concevoir un site web convivial et attractif.\r\n\r\nIl est tout aussi important de bien maîtriser le contenu rédactionnel et d\'optimiser vos pages pour un référencement efficace dans les moteurs de recherche.\r\n\r\nLa dernière étape de cette partie méthodologique concerne le choix d\'un hébergement, l\'estimation des besoins techniques, le travail avec les acteurs du projet et le suivi de la réalisation du site.\r\n\r\nDans la deuxième partie du livre, vous aurez l\'occasion de mettre en pratique tous ces concepts car vous réaliserez étape par étape le site web d\'une association à l\'aide de la version en ligne du CMS WordPress, wordpress.com qui permet de créer un site web avec facilité et efficacité. Une fois ce projet terminé, vous disposerez de toute la théorie et de toute la pratique nécessaire à la réalisation de votre premier site web.', 360, 27, '2018', 3, '9782409011788', 1, 86, 11, 4, 1, 1),
(85, 'Aide-mémoire des réseaux et télécoms', '', 'IMG-642ace2a986eb4.65053540.jpg', 'Les réseaux sont aujourd\'hui indispensables au fonctionnement quotidien de toutes les entreprises : une \"panne de réseau\" et c\'est le système d\'information et l\'activite économique qui se retrouvent paralysés.\r\n\r\nDans ce contexte cet aide-mémoire constitue un véritable référentiel auquel le professionnel pourra faire appel lorsque le besoin de revoir un concept rapidement mais en détail sera nécessaire.\r\n\r\nIl rassemble l\'essentiel des connaissances et des données utiles qui se rencontrent dans sa pratique quotidienne d\'un ingénieur réseau pour la conception, l\'installation ou la maintenance de réseaux (locaux ou étendus) ou d\'infrastructures télécoms.', 400, 13, '2012', 3, '9782100582167', 3, 87, 11, 5, 1, 3),
(86, 'Android 5', 'Les fondamentaux du développement d\'applications Java', 'IMG-642ad8bad69f02.24575053.jpg', 'Ce livre est destiné aux développeurs, même débutants, qui souhaitent connaître et maîtriser le développement d\'applications Java sur Android 5 (en versions 5.0.x - alias Lollipop - au moment de l\'écriture). Sa lecture nécessite des connaissances basiques en programmation Java et XML mais aucun prérequis particulier sur Android.\r\nAprès une présentation de la plateforme Android et des principes de programmation qui lui sont spécifiques, vous apprendrez à installer et configurer l\'environnement de développement (Android Studio et SDK Android). Vous évoluerez ensuite de façon progressive afin de connaître toutes les briques essentielles à la création d\'applications Android. Ainsi, vous apprendrez à créer des interfaces de plus en plus complexes (layouts, ressources, ActionBar, menus, listes, popups, webview, etc.), à découvrir les nouveautés de la version 5 d\'Android (Material Design, Toolbar, CardView, Notifications Android Wear ...), à gérer la navigation et la communication entre les différentes interfaces d\'une application ou entre plusieurs applications. Vous découvrirez les méthodes de création d\'interfaces personnalisées (gestion des thèmes, animations, police) ainsi que la gestion des différents évènements utilisateurs (clic, rotation, etc.). Vous apprendrez à optimiser le code de l\'application, ses interfaces et à gérer la fragmentation de la plateforme (versions d\'Android, taille et résolution des écrans, différences matérielles, etc.). Vous verrez comment récupérer des données nécessaires à une application (webservice, gestion de la connectivité, parsing Xml / Json), les stocker (sharedPreferences, fichiers, base de données SQLite) et les partager avec d\'autres applications (ContentProvider, Intent, etc.). Vous pourrez créer et interagir avec des cartes (Google Map, localisation, conversion position/adresse).\r\nEnfin, vous apprendrez à gérer les différents traitements et interactions effectués dans une application et à identifier ceux qui doivent s\'exécuter en tâches de fond (AsyncTask, Thread, Service, Broadcast Receiver, Widget, etc.) ainsi que les méthodes d\'accès aux différentes fonctionnalités d\'un appareil sous Android (appels, sms, caméra, accéléromètre, Bluetooth, etc.).\r\nTous les exemples présentés dans le livre sont disponibles en téléchargement sur le site www.editions-eni.fr.', 430, 27, '2015', 3, '9782746094444', 4, 88, 12, 1, 1, 4),
(87, 'Cyberdéfense', 'La sécurité de l\'informatique industrielle (domotique, industrie, transports)', 'IMG-642adc98b4e621.84167872.jpg', 'Ce livre sur la cyberdéfense s\'adresse à toute personne sensibilisée au concept de la sécurité dans le domaine industriel. Il a pour objectif d\'initier le lecteur aux techniques les plus courantes des attaquants pour lui apprendre comment se défendre. En effet, si la sécurité de l\'informatique de gestion (applications, sites, bases de données...) nous est maintenant familière, la sécurité de l\'informatique industrielle est un domaine beaucoup moins traditionnel avec des périphériques tels que des robots, des capteurs divers, des actionneurs, des panneaux d\'affichage, de la supervision, etc. Elle commence à la maison avec la domotique et ses concepts s\'étendent bien sûr à l\'industrie et aux transports.\r\n\r\nDans un premier temps, les auteurs décrivent les protocoles de communication particuliers qui régissent les échanges dans ce domaine et détaillent quelques techniques basiques de hacking appliquées aux systèmes industriels et les contre-mesures à mettre en place. Les méthodes de recherches sont expliquées ainsi que certaines attaques possibles avec une bibliothèque particulière nommée scapy du langage Python (pour les novices, un chapitre rapide sur la prise en main de Python est présent). Enfin, un chapitre montrera les protocoles et failles des moyens de transport ferroviaires.\r\n\r\nDans la lignée du livre Ethical Hacking dans la même collection, les auteurs de ce livre sur la Cyberdéfense ont à coeur d\'alerter chacun sur la sécurité de l\'informatique industrielle : \"apprendre l\'attaque pour mieux se défendre\" est toujours leur adage. Hackers blancs dans l\'âme, ils ouvrent au lecteur les portes de la connaissance underground.', 600, 27, '2015', 3, '9782746097889', 8, 89, 12, 2, 1, 8),
(88, 'Guide juridique informatique et libertés', 'Collecte, traitement et sécurité des données dans l\'univers numérique : ce que vous devez savoir', 'IMG-642add0251ce32.77525194.jpg', 'L\'univers numérique est un univers international, fluctuant et aux acteurs multiples. Les données sont partout, elles sont produites, exploitées et consommées par tous : fichiers clients ou prospects, listes de fournisseurs, formulaires, annuaires, organigrammes, vidéosurveillance, géolocalisation des clients, des salariés, dossiers des ressources humaines, intranet, messagerie électronique, procédures anti-blanchiment, Cloud Computing, biométrie, réseaux sociaux interentreprises...\r\n\r\nElles ont une valeur marchande considérable et seront au coeur des enjeux financiers et économiques du XXIème siècle. L\'écosystème numérique est complexe et a besoin pour prospérer de confiance.\r\n\r\nLa mise en conformité avec la loi Informatique et libertés permet à ces acteurs de rassurer les consommateurs et les internautes, population volatile et exigeante qui revendique plus de transparence de la part des acteurs numériques.\r\n\r\nAinsi, la protection des données personnelles dépasse le prisme réducteur de la contrainte légale et est perçue de plus en plus comme un avantage concurrentiel. Parallèlement, dans les entreprises, la question de la protection des données personnelles glisse du domaine de la direction juridique ou informatique vers celle de la direction marketing, commerciale, ressources humaines voire de la direction générale.\r\n\r\nL\'objectif de cet ouvrage est de guider les acteurs de l\'univers numérique, les consommateurs et les internautes à travers :\r\n\r\nles définitions et les notions-clés nécessaires à la compréhension de la loi Informatique et libertés : données personnelles, traitement, responsable de traitements, CIL, CNIL, données sensibles, données interdites, formalités préalables, dispenses...\r\nles conditions d\'applicabilité de cette loi, y compris pour les traitements de données au-delà des frontières françaises\r\nla stratégie digitale à adopter sur les réseaux sociaux\r\nles best practices en matière d\'e-mailing, de cookies ou de géolocalisation\r\nles outils à mettre en place pour assurer la sécurité et la confidentialité des données\r\nles différentes délibérations de la CNIL, la commission de contrôle, de sensibilisation et de sanction des manquements à la loi Informatique et libertés\r\nles clés de la mise en conformité des fichiers des entreprises pour garantir un équilibre entre la protection de la vie privée et la valorisation des données collectées par l\'entreprise.\r\nLe Guide juridique Informatique et Libertés est à jour des dernières évolutions doctrinales, législatives et jurisprudentielles sur les failles de sécurité, les cookies, la géolocalisation, le Cloud Computing, le traitement des données sensibles et les réseaux sociaux.', 500, 27, '2012', 3, '9782746076532', 1, 90, 12, 3, 1, 1),
(89, 'Apprendre à développer un site web avec PHP et MySQL', 'Exercices pratiques et corrigés (3ième édition)', 'IMG-642add90533ec3.69441699.jpg', 'Ce livre s\'adresse à un public de développeurs débutants connaissant déjà le HTML et les CSS et qui souhaitent bien comprendre le fonctionnement d\'une application web pour créer leurs propres sites web dynamiques avec PHP et MySQL.\r\nDans une première partie, le lecteur installera son environnement de développement EasyPHP puis découvrira les bases du langage PHP (en version 7 au moment de l\'écriture), ses principales fonctions et structures de contrôles, ainsi que des explications sur la transmission des données entre les pages et sur la librairie graphique (les effets spéciaux sur une image). Ces apports théoriques sont accompagnés de nombreux exemples.\r\nIl en est de même dans la deuxième partie du livre, consacrée au langage SQL. Le lecteur découvrira ce qu\'est une base de données MySQL et les différentes méthodes pour y accéder avec PHP (PDO, SQL Avancé) et comment assurer la sécurité de la base. Un chapitre est également consacré aux premiers pas sur la Programmation Orientée Objetet un autre à la gestion de la configuration et des performances.\r\nPour que le lecteur puisse se forger une première expérience significative, l\'auteur a préparé de nombreux exercices à la fin de chaque chapitre (exemples : comme créer un blog, une newsletter, un site de gestion...) et propose aussi leurs corrigés.\r\nDes éléments complémentaires sont en téléchargement sur le site www.editions-eni.fr.', 576, 27, '2015', 3, '9782746098268', 1, 91, 12, 4, 1, 1),
(90, 'Aide-mémoire de Java', '', 'IMG-642adf9dc20fb3.41327424.jpg', 'Etudiants en formation initiale ou continue, cet ouvrage constitue une base de référence pour vous initier au monde Java.\r\n\r\nLes fonctionnalités de ce langage sont abordées de façon didactique, suivant une progression logique. L\'ensemble des possibilités offertes par Java 1.6 est ainsi couvert : du modèle objet à l\'environnement de programmation, des processus aux entrées-sorties, des API aux exceptions, de la généricité au graphisme. Chaque notion est illustrée par un ou plusieurs exemples et cas pratiques.\r\n\r\nAucune connaissance en Java n\'est pré-requise. Vous pouvez donc aborder cet ouvrage en toute quiétude, pour mieux réussir vos examens et développer les bons réflexes de programmation en Java !', 278, 13, '2008', 3, '9782100727131', 1, 92, 12, 5, 1, 1);
INSERT INTO `books` (`idBook`, `nameBook`, `parallelTitele`, `image`, `summary`, `hardCover`, `idPublisher`, `dateOfPublisher`, `idLanguage`, `isbn`, `quantity`, `idAuthors`, `idType`, `nbrBook`, `idCategorie`, `nbrCopy`) VALUES
(92, 'HTML5 et JavaScript', 'Développez Des Applications Pour Le Windows Store', 'IMG-642ae01cb57a41.57186459.jpg', 'Préface de Pierre LAGARDE - Solutions Architect - Microsoft France\r\n\r\nCe livre s\'adresse aux développeurs désirant apprendre les mécanismes du développement d\'applications pour le Windows Store (sous Windows 8 et 8.1) avec HTML5, CSS et JavaScript. Des connaissances de base sur les technologies HTML5, CSS et JavaScript sont un prérequis indispensable pour tirer le meilleur parti possible de ce livre.\r\n\r\nL\'auteur présente les différents aspects de la conception d\'une application pour le Windows Store avec HTML5 et JavaScript dans un environnement Visual Studio, les particularités liées à Windows 8.1 sont citées tout au long du livre. Il démarre par une brève introduction et une mise en situation du marché puis, il continue par une introduction aux applications JavaScript pour le Windows Store, des notions de base sur la construction d\'une application jusqu\'à l\'intégration de fonctionnalités avancées et propres au système (comme l\'implémentation des contrats de recherche et de partage ou encore l\'utilisation des vignettes).\r\n\r\nEnsuite, l\'auteur développe plus particulièrement l\'utilisation de ressources distantes notamment à travers la consommation de services Web, et vous apprend à rendre votre application internationale et accessible.\r\n\r\nEnfin, le livre se termine par le packaging et le déploiement de votre application sur le Windows Store. Il présente également les différentes manières de générer du revenu avec une application, que ce soit par l\'intégration de publicités ou de fonctionnalités d\'achat intégré.\r\n\r\nPour chaque chapitre, l\'auteur propose en téléchargement sur le site www.editions-eni.fr, un ou plusieurs projets qui illustrent les concepts présentés. Vous serez ainsi à même de tester des fonctionnalités clés telles que : les notions fondamentales de WinJS et l\'utilisation des principaux contrôles, la gestion de la navigation, l\'interrogation de services Web, la manipulation de fichiers et le stockage, l\'intégration de la recherche et du partage, l\'impression, l\'utilisation de périphériques et de capteurs, la localisation et la globalisation.', 400, 27, '2013', 3, '9782746084490', 5, 94, 13, 1, 1, 5),
(93, 'Apprenez les langages HTML5, CSS3 et JavaScript pour créer votre premier site web', '', 'IMG-642ae0708a8701.28382400.jpg', 'Ce livre s\'adresse à de grands débutants en développement informatique, qui n\'ont jamais programmé avec HTML5, CSS3 et JavaScript. Ces trois langages sont traités dans le livre, en partant vraiment de zéro et en allant jusqu\'à un niveau suffisant pour que le lecteur soit autonome. L\'auteur guide le débutant en lui enseignant des méthodes efficaces et actuelles pour créer son premier site web.', 295, 27, '2014', 3, '9782409036392', 1, 95, 13, 2, 1, 1),
(94, 'HTML5, CSS3 et JavaScript', 'Développez Vos Sites Pour Les Terminaux Mobiles', 'IMG-642ae0c7e8cb01.45210543.jpg', '\"Ce livre s\'adresse aux concepteurs ou développeurs de sites web qui, déjà familiers des nouvelles normes HTML5 et CSS3, souhaitent migrer ou créer un site internet parfaitement adapté aux terminaux mobiles. Ce livre va leur permettre de bien appréhender les différences entre les deux mondes, de mieux comprendre les attentes de l\'internaute mobile (le mobinaute), de bien mesurer les avantages à développer pour ce type d\'appareil mais aussi les problèmes que cela engendre.\r\nChapitre après chapitre, le lecteur découvrira :\r\n- les avantages de la norme HTML5 dans le monde mobile (mode hors-ligne, spécificité des formulaires, etc.),\r\n- les avantages du CSS3 pour une meilleure adaptation du site au terminal de consultation (media queries),\r\n- les nouvelles fonctions JavaScript particulièrement utiles pour une utilisation nomade (géolocalisation, canvas).\r\nL\'auteur a choisi d\'écrire ce livre comme une formation en détaillant toutes les étapes pour créer ou migrer vers un site mobile. Les mobinautes sont de plus en plus nombreux et les sites internet se doivent d\'être complètement adaptés à ces nouveaux utilisateurs.\r\nPour chaque exemple du livre, sur le site www.editions-eni.fr vous pourrez télécharger les fichiers sources (HTML, CSS, JavaScript) et les ressources (images, audios, vidéos) pour les exécuter. Vous trouverez également en téléchargement un exemple plus complet, utilisé tout au long du livre, vous donnant un premier aperçu d\'un site mobile et vous permettant de mieux appréhender les nouveautés de ces langages.\r\n\r\nLes chapitres du livre :\r\nIntroduction - Particularité des sites mobiles - Premiers pas - Créer un site mobile : HTML5 - Créer un site mobile : CSS3 - Créer un site mobile : JavaScript - Aller plus loin - Aller plus vite - Site normal vers site mobile - Transformer un site en application native\"', 400, 27, '2012', 3, '9782746076495', 1, 96, 13, 3, 1, 1),
(95, 'PHP et MySQL', 'Maîtrisez Le Développement D\'un Site Web Dynamique Et Interactif', 'IMG-642ae1e677c312.29070501.jpg', 'Ce livre sur PHP et MySQL s\'adresse aux concepteurs et développeurs qui souhaitent utiliser PHP et MySQL pour développer un site Web dynamique et interactif.\r\n\r\nDans la première partie du livre, l\'auteur présente la mise en oeuvre d\'une base de données MySQL : langage SQL (Structured Query Language), utilisation des fonctions MySQL, construction d\'une base de données (tables, index, vues), sans oublier les techniques avancées comme la recherche en texte intégral ou le développement de procédures stockées.\r\n\r\nDans la deuxième partie du livre, après une présentation des fonctionnalités de base du langage PHP, l\'auteur se focalise sur les besoins spécifiques du développement de sites dynamiques et interactifs en s\'attachant à apporter des réponses précises et complètes aux problématiques habituelles : gestion des formulaires, gestion des sessions, envoi de courriers électroniques et bien sûr accès à une base de données MySQL.\r\n\r\nAbondamment illustré d\'exemples commentés, ce livre (écrit sur les versions 7 de PHP et 5.7 de MySQL) est à la fois complet et synthétique et vous permet d\'aller droit au but.\r\n\r\nDes éléments complémentaires sont en téléchargement sur le site www.editions-eni.fr.', 700, 27, '2016', 3, '9782409002557', 1, 97, 13, 4, 1, 1),
(97, 'HTML5 et PHP 5', 'Développez Des Applications Web Performantes : Exploitez Les Dernières Nouveautés Des Langages', 'IMG-642ae262bff023.02585802.jpg', 'Ce livre s\'adresse à un public de développeurs souhaitant mettre à niveau et approfondir leurs connaissances sur HTML et PHP et tirer le meilleur parti des dernières nouveautés de ces langages pour réaliser des applications web solides et performantes.\r\n\r\nCes deux piliers du web ont connu de grandes évolutions ces dernières années : HTML se fait l\'acteur d\'une nouvelle génération d\'applications web et mobiles, PHP s\'est professionnalisé en intégrant notamment un modèle objet complet ; il est à présent le langage utilisé par l\'immense majorité des gestionnaires de contenu (CMS) et des frameworks.\r\n\r\nVous découvrirez au fil des chapitres :\r\n\r\nLes nouvelles possibilités offertes par HTML5 : comment intégrer facilement des éléments multimédia (vidéos, sons, images...), faire un pas en avant dans le web sémantique, comprendre les enjeux de l\'accessibilité du web, construire des formulaires efficaces et user friendly, connaître la puissance des nouvelles API Javascript qu\'offre HTML5.\r\nComment aller plus loin dans PHP : vous apprendrez à professionnaliser votre code avec un tour d\'horizon des évolutions du langage depuis PHP4, notamment en exploitant le modèle objet, en utilisant des Design Patterns reconnus et en adoptant les bonnes pratiques pour de meilleurs développements.\r\nComment s\'opèrent les échanges entre un serveur et un navigateur et leurs nouveaux modes d\'échange : requêtes AJAX, communication par WebSockets, Server-Sent Events, comment se passer du serveur avec les applications déconnectées.\r\nEt, en fin de lecture, toutes les clés et les apports méthodologiques essentiels pour construire une application fiable selon la méthode MVC, pour prendre en main la gestion des erreurs et pour vous prémunir des attaques afin de sécuriser vos développements.\r\nDes éléments complémentaires sont en téléchargement sur le site www.editions-eni.fr.', 400, 27, '2014', 3, '9782746091191', 3, 98, 13, 6, 1, 3),
(99, 'De l\'écrit au numérique ', 'Constituer, Normaliser Et Exploiter Les Corpus Électroniques', 'IMG-642981d8a92a82.26037609.jfif', 'Dans les années à venir la masse de documents papier existants (texte et images) deviendra inexploitable sans des traitements informatiques efficaces pour nettoyer, baliser, structurer, créer des liens entre documents. Cet ouvrage explique comment exploiter et normaliser.\r\nSommaire :\r\nDes données brutes aux textes utilisables. Les textes gisement d\'information. Rendre les textes comparables. Chercher, filtrer, trier. Des nettoyages nécessaires aux balisages incontournables. Constituer et documenter un corpus. Problèmes juridiques. Caractériser les données textuelles. Normaliser. Du codage physique à une représentation logique : SGML. Hypertextes et normes HTML. Combiner les traitements. Motifs, recherches, filtrages. Outils de base. Outils extensibles. Segmenter. Séquences répétées et \"attirance\" entre mots. Structurer. Grammaire et langage.', 328, 28, '1998', 3, '9782225829536', 1, 100, 10, 1, 1, 1),
(100, 'Analyse et conception de systèmes d\'information', '', 'IMG-642982f5944b98.01572505.jpg', 'Cet ouvrage exceptionnel présente la couverture la plus complète et la plus équilibrée qui soit de l\'analyse et de la conception de systèmes d\'information. Cette deuxième édition insiste davantage sur les rôles et les techniques de la gestion de projets, tout en continuant de traiter des concepts et des techniques des approches structurées classiques et orientées objets du développement de systèmes. Les enseignants ont la possibilité de couvrir une approche plutôt qu\'une autre ou les deux en parallèle, en se référant aux exemples appropriés de l\'étude de cas intégrée et actualisée dans chaque chapitre. L\'analyse structurée moderne, le langage de modélisation unifié (UML), le RUP (Rational Unified Process), le développement axé sur le Web, la programmation extrême, la sécurité Internet et la planification des ressources d\'entreprise (ERP) sont tous traités dans le contexte du cycle chronologique de développement de systèmes. Tout au long de ce livre, les auteurs mettent l\'accent sur des principes fondamentaux, tout en discutant des divers environnements de développement du monde actuel.', 728, 29, '2003', 3, '9782893772509', 1, 101, 10, 2, 1, 1),
(101, 'Architecture des systèmes sur puce', ' Processeurs Synthétisables, CAO VLSI, Norme VCI, Environnements ISE Et Quartus', 'IMG-642983267f2d83.77761989.jpg', 'À la jonction du software et du hardware, l\'ouvrage présente les composants de la prochaine génération d\'ordinateurs.\r\n\r\nIl s\'adresse aux industriels et ingénieurs désireux de s\'initier rapidement à l\'assembleur du processeur synthétisable. Il permet d\'acquérir le recul nécessaire vis-à-vis des différentes technologies de circuits logiques imprimables.\r\n\r\nIl s\'adresse également aux étudiants des niveaux licence et master pour l\'apprentissage de l\'assembleur et de l\'architecture des systèmes informatiques. L\'intérêt majeur d\'un environnement de type Quartus-II et des processeurs synthétisables est que, contrairement aux processeurs classiques, ils offrent un support idéal pour mieux appliquer et concrétiser rapidement les concepts théoriques.\r\n\r\nPour préserver une certaine neutralité, l\'ouvrage développe une présentation équilibrée des environnements les plus connus, comme ISE de Xilinx et Quartus II d\'Altera.', 315, 2, '2005', 3, '9782729823184', 6, 102, 10, 3, 1, 6),
(102, 'Codage symbolique', '', 'IMG-64298376065111.63072430.jpg', 'Les codages de modulation (codages d\'adaptation au canal ou codages pour canaux contraints) sont des codages symboliques qui permettent de transformer une suite de symboles en une suite dont les symboles satisfont diverses contraintes, imposées le plus souvent par des systèmes physiques. Les applications pratiques en sont nombreuses. Ils sont par exemple utilisés dans les systèmes d\'enregistrement magnétique ou optique. Cet ouvrage étudie les principales méthodes constructives récentes de codage pour canaux contraints. Pour la première fois, ce livre rend compte de la méthode des pôles. Les outils mathématiques, nécessaires à la construction de ces codages, notamment la théorie des automates et la dynamique symbolique, sont préalablement décrits. Exceptée une culture générale de base en mathématique, la lecture de ce livre ne nécessite donc pas de connaissances particulières. Sauf exception, tout résultat est démontré. Des notes bibliographiques complètent chaque chapitre. Cet ouvrage s\'adresse aussi bien aux chercheurs et aux étudiants en 2e et 3e cycles d\'enseignement supérieur en informatique et en mathématiques qu\'aux ingénieurs développant des systèmes de communication ou d\'enregistrement.', 204, 13, '1993', 3, '9782225841736', 1, 103, 10, 4, 1, 0),
(103, 'Methode generale d\'analyse d\'une application informatique', '', 'IMG-642ac4ac2ecbe1.03193763.jpg', '', 0, 1, '1982', 3, '9782225803703', 1, 104, 10, 5, 1, 1),
(104, 'La physique dans le mille', '1.000 exercices corrigés en MP, PSI, PC, PT', 'IMG-646a27cdc147f6.48966477.jpg', 'Ces 1 000 exercices couvrent les programmes des classes préparatoires aux grandes écoles scientifiques MP, PC, PSI et PT. Ils sont accompagnés de leur solution détaillée.\r\n\r\nLes exercices mettent l\'accent sur la physique concrète, le rôle de la symétrie, la notion de modèle, l\'étude de la pertinence d\'un modèle, sa validation avec les ordres de grandeur et les applications numériques.\r\n\r\nLes exercices sont généralement rangés par discipline mais certains sont regroupés autour d\'un thème comme : la cycloïde, le vecteur excentricité, le théorème du Viriel, les invariants adiabatiques, etc.\r\n\r\nL\'ensemble forme un livre idéal pour approfondir le cours, réviser et préparer aussi bien l\'écrit que l\'oral des concours d\'entrée aux grandes écoles scientifiques.\r\n\r\nIl sera également fort utile aux étudiants des filières scientifiques universitaires et particulièrement à ceux qui préparent les concours de l\'enseignement (CAPES et agrégation).', 1056, 2, '2016', 3, '9782340010000', 4, 105, 14, 1, 3, 4),
(105, 'Comprendre la physique', '', 'IMG-646a284b014aa9.60282076.jpg', 'La physique, une discipline ardue réservée à quelques initiés ? Un monde incompréhensible pour qui n\'a pas de formation en mathématiques ? Des théories aussi abstraites qu\'hermétiques ? Détrompez-vous : vous faire Comprendre la physique, tel est l\'engagement des auteurs de ce livre passionnant, quel que soit votre bagage scientifique de départ. Au terme de ces pages, vous aurez acquis, sans effort, une solide culture en sciences physiques, des lois et des principes.\r\n\r\nTout spécifiquement conçu pour un lectorat non scientifique, Comprendre la physique est l\'aboutissement du célèbre Project Physics course américain, dont l\'objectif est de rendre la physique plus attrayante, et accessible à tous. Suivant le développement historique des idées, il replace les principaux concepts dans un cadre humaniste, explique l\'origine des principes fondateurs, ainsi que les limites auxquelles ceux-ci se heurtent. Très didactique et richement illustré, il propose de nombreuses questions d\'auto-évaluation en fin de chaque chapitre, afin de permettre au lecteur de vérifier les connaissances acquises.\r\n\r\nDisponible pour la première fois en langue française, cette référence de l\'enseignement en physique s\'adresse aussi aux étudiants en sciences souhaitant parfaire leur culture générale, ainsi qu\'aux enseignants, qui trouveront là de nombreuses pistes pour adapter leurs cours aux besoins de leur auditoire.', 812, 30, '2014', 3, '9782889150830', 4, 106, 14, 2, 3, 4),
(106, '3 minutes pour comprendre les 50 plus grandes théories de la physique quantique', '', 'IMG-646a28c5672429.06989095.jpg', 'Vous savez tout sur le chat de Schrôdinger, mais connaissez-vous son équation ? Comment fonctionnent le laser, le transistor et le microscope électronique ? A quoi pourra servir un ordinateur quantique ? Ce guide fascinant sur la physique quantique révèle les origines de certaines des plus grandes découvertes scientifiques et vous permettra de réfléchir à l\'avenir de la physique et de la technologie. Cet ouvrage de \"vulgarisation intelligente\" met les plus grands physiciens au défi d\'expliquer les 5o plus grandes théories de la physique quantique en 30 secondes, 2 pages, 300 mots et 1 image, soit 3 minutes en tout pour comprendre ! Vous découvrirez aussi les grands scientifiques qui ont passé leur vie à voir plus loin que la réalité en tentant de percer les mystères du monde quantique. Vous en apprendrez suffisamment pour discuter avec assurance du principe d\'indétermination et dénouer l\'énigme de l\'intrication quantique !', 160, 31, '2015', 3, '9782702911228', 1, 107, 14, 4, 3, 1),
(107, 'La physique des infinis', '', 'IMG-646a29479a6159.54390588.jpg', 'Écrire l\'histoire de l\'Univers, tel est l\'objectif commun des physiciens des particules et des astrophysiciens. Pour y parvenir, deux approches s\'épaulent : la voie de l\'infiniment petit, que l\'on emprunte via de gigantesques accélérateurs de particules, et celle de l\'infiniment grand, dont le laboratoire est l\'Univers.\r\n\r\nUn Univers qui est bien loin d\'avoir livré tous ses secrets. On connaît à peine 4,8% de la matière qui le constitue, le reste étant composé de matière noire (25,8%) et d\'énergie noire (69,4%), toutes deux de nature inconnue. Et si la récente découverte du boson de Higgs valide le Modèle standard de la physique des particules, celui-ci est toujours incomplet et doit être étendu à ou dépassé.\r\n\r\nEst-on arrivé au bout du jeu de poupées russes de la matière ? Quelles sont les particules manquantes ? Faut-il revoir les lois fondamentales ? Quels instruments faut-il mettre en oeuvre pour accéder à cette \"nouvelle physique\" ? Comment parler de Super Big Science aux citoyens et aux décideurs politiques ?\r\n\r\nEntre mécanique quantique et relativité générale, entre infiniment petit et infiniment grand, la physique des infinis démonte des certitudes et ouvre des perspectives inédites. Au-delà des enjeux scientifiques, elle nous permet d\'accéder à des questionnements culturels et philosophiques sur la nature de la réalité et sur le concept d\'origine de l\'Univers. Dans un dialogue passionnant, les auteurs nous invitent à débattre avec eux de cette quête de l\'infini, et à penser le monde vertigineusement.', 210, 32, '2013', 3, '9782360120352', 1, 108, 14, 5, 3, 1),
(108, 'Le cours de physique de Feynman. Mécanique 1', '', 'IMG-646a29d13adc65.78337855.jpg', 'L’ampleur du succès qu’a rencontré le « Cours de physique de Feynman » dès sa parution s’explique par son caractère fondamentalement novateur. Richard Feynman, qui fut professeur d’université dès l’âge de vingt-quatre ans, a exprimé dans ce cours, avant d’obtenir le prix Nobel de Physique, une vision expérimentale et extrêmement personnelle de l’enseignement de la physique. Cette vision a, depuis, remporté l’adhésion des physiciens du monde entier, faisant de cet ouvrage un grand classique. \r\nCe cours en cinq volumes (Électromagnétisme 1, Électromagnétisme 2, Mécanique 1, Mécanique 2, Mécanique quantique) s’adresse aux étudiants de tous niveaux qui y trouveront aussi bien les notions de base débarrassées de tout appareil mathématique inutile, que les avancées les plus modernes de cette science passionnante qu’est la physique.\r\nCette nouvelle édition corrigée bénéficie en outre d’une mise en page plus aérée pour un meilleur confort de lecture.', 400, 13, '2022', 3, '9782100848966', 5, 109, 14, 6, 3, 5),
(109, 'Mécanique des fluides, aérodynamique : équations générales, écoulements laminaires et turbulents autour d\'un profil, couche limite, niveau C', '', 'IMG-646a34dc991a48.12673727.jpg', 'Partant des équations de Navier-Stokes, dont la recherche d’une solution exacte reste un défi mathématique, l’aérodynamique, moyennant certaines hypothèses, étudie le mouvement des fluides autour d’un objet et calcule les efforts exercés sur cet objet.\r\nL’ouvrage expose ces hypothèses et ces calculs. La première étape est donc l’exposé des définitions et des équation générales de la mécanique des fluides. Puis le livre s’emploie à montrer comment on peut résoudre ces équations, dans des cas particuliers d’écoulements autour d’obstacles et au voisinage des parois.\r\nL’ouvrage s’attache à expliquer les phénomènes physiques observés expérimentalement et à montrer comment ces observations permettent de simplifier des équations complexes, qu’on ne saurait pas résoudre autrement. Il illustre sur des cas concrets comment les calculs peuvent alors aboutir analytiquement.\r\nLes différents chapitres traitent successivement les écoulements bi-dimensionnels et tri-dimensionnels, laminaires et turbulents. L’ensemble permet ainsi, pour un profil d’aile quelconque, de calculer les forces de portance et de trainée, de façon approchée mais fiable.', 240, 2, '2013', 3, '9782729877958', 3, 110, 17, 1, 3, 3),
(110, 'Théorie cinétique. Gaz et plasmas', '', 'IMG-646a3580c87ae0.85660701.jpg', 'Le spectacle de la matière à l\'échelle microscopique décourage le déterminisme. Comprendre comment les modèles probabilistes élaborés par Maxwell et Boltzmann à partir des lois du hasard permettent de prédire l\'état et l\'évolution des systèmes physiques à l\'échelle macroscopique, tel est l\'objectif de cet ouvrage destiné aux élèves des classes préparatoires et des écoles d\'ingénieurs, aux étudiants de premier et de deuxième cycle universitaire, et aux enseignants de physique et de mécanique.\r\n\r\nLa première partie de ce livre présente les concepts fondamentaux de la théorie cinétique : état d\'équilibre, fonctions de distribution de la vitesse et de l\'énergie, grandeurs moyennes, écarts type, flux et densités de flux et coefficients de transport. Ces notions sont appliquées en phase gazeuse, puis étendues à des milieux dont le passage du monde de la recherche à celui de l\'industrie est aujourd\'hui accompli : les plasmas cinétiques.\r\n\r\nLa seconde partie propose 34 problèmes et leurs corrigés, présentés dans un ordre directement inspiré de celui du résumé de cours. Le lecteur accède ainsi à une grande variété de situations physiques couvrant une large gamme de pression et de température. Cette richesse révèle l\'appartenance de l\'auteur à un laboratoire du CNRS (le CORIA, Complexe de Recherche Interprofessionnel en Aérothermochimie) qui nourrit ses compétences de l\'apport réciproque de la recherche fondamentale et de la recherche appliquée.\r\n\r\nAu sommaire\r\nRésumé de cours\r\nDynamique des collisions binaires\r\nDistribution des vitesses à l\'équilibre\r\nFlux et densité de flux à l\'équilibre\r\nValidité du modèle du gaz parfait\r\nEquilibre thermodynamique local\r\nModèle du plasma cinétique\r\nProblèmes corrigés\r\n34 exemples\r\nAnnexes\r\nIndex', 222, 2, '2001', 3, '9782868833693', 1, 111, 17, 2, 3, 1),
(111, 'Comportement mécanique des matériaux', '', 'IMG-646a3617007538.41469355.jpg', 'Les avancées techniques requièrent une excellente maîtrise des matériaux utilisés. Le défi est de mieux comprendre leur comportement mécanique et plus particulièrement les relations entre leurs micro-structures et leurs propriétés à l\'échelle macroscopique. Cet ouvrage apporte les éléments pour relever ce défi. Partant des mécanismes de déformation, il remonte aux lois de comportement macroscopique en cherchant à établir des relations quantitatives, en tout cas à révéler les phénomènes physiques qui sous-tendent les comportements rhéologiques. Les auteurs ont inclus les développements les plus récents, notamment sur les matériaux hétérogènes (alliages métalliques, polymères, composites).\r\n\r\nChacun des chapitres est consacré à une grande classe de comportement : élastique puis plastique dans ce premier volume ; comportement viscoélastique, comportement viscoplastique, endommagements, dans le second volume (on y trouvera en outre des notions de mécanique de la rupture et de mécanique du contact). Les outils de base (mécanique des milieux continus, cristallographie, changements de phase) sont décrits en annexes. On trouvera également, de nombreux exercices en fin de chapitres, pour la bonne compréhension des sujets traités. Une illustration abondante facilite la lecture de l\'ouvrage.\r\n\r\nComportement mécanique des matériaux est le fruit du DEA \"Mécanique et Matériaux\" de la région parisienne. Il s\'adresse aussi aux élèves-ingénieurs, ingénieurs et chercheurs. Les développements mathématiques y sont d\'un accès facile. Les réelles difficultés, dont la maîtrise n\'est pas exempte d\'aspects passionnants, résident dans les fréquents changements d\'échelle et dans le sens physique auquel il est fait appel.', 508, 26, '2009', 3, '9782746223486', 2, 112, 17, 3, 3, 2),
(112, 'Matières plastiques', '', 'IMG-646a36afe92fb5.39365623.jpg', '', 240, 33, '2006', 3, '9782091795812', 1, 113, 17, 4, 3, 1),
(113, 'Mechanical vibrations', '', 'IMG-646a3810d6afa7.82873849.jpg', 'Mechanical Vibrations: Theory and Application to Structural Dynamics, Third Edition is a comprehensively updated new edition of the popular textbook. It presents the theory of vibrations in the context of structural analysis and covers applications in mechanical and aerospace engineering. Although keeping the same overall structure, the content of this new edition has been significantly revised in order to cover new topics, enhance focus on selected important issues, provide sets of exercises and improve the quality of presentation.\r\n\r\nWithout being exhaustive (see the Introduction for a comprehensive list), some key features include: \r\n\r\nA systematic approach to dynamic reduction and substructuring, based on duality between mechanical and admittance concepts\r\nAn introduction to experimental modal analysis and identification methods\r\nAn improved, more physical presentation of wave propagation phenomena\r\nA comprehensive presentation of current practice for solving large eigenproblems, focusing on the efficient linear solution of large, sparse and possibly singular systems\r\nA deeply revised description of time integration schemes, providing framework for the rigorous accuracy/stability analysis of now widely used algorithms such as HHT and Generalized–\r\nSolved exercises and end of chapter homework problems\r\nA companion website hosting supplementary material\r\nWith revised, coherent and uniform notation, Mechanical Vibrations: Theory and Application to Structural Dynamics, Third Edition is a must–have textbook for graduate students working with vibration in mechanical, aerospace and civil engineering, and is also an excellent reference for researchers and industry practitioners.', 616, 34, '2015', 2, '9781118900208', 1, 114, 18, 1, 3, 1),
(114, 'Vibrations des structures ', '', 'IMG-646a386370c5a6.49233677.jpg', 'L\'ouvrage : niveau B (IUP - Licence).\r\n\r\nIssu d\'un cours dispensé au CNAM par l\'auteur, l\'ouvrage apporte les connaissances indispensables pour : prévoir le comportement d\'une structure ; créer un modèle spatial par discrétisation ; donner sa réponse temporelle ; développer une analyse modale ; traiter des applications industrielles.\r\n\r\nDe façon claire et précise, il analyse successivement les vibrations à un, deux, puis n degrés de liberté, libres et excitées, avec différents types d\'amortissement. Il développe également la modélisation des vibrations des structures et l\'analyse modale expérimentale. Chaque chapitre est complété par de très nombreux exercices résolus.', 225, 2, '2011', 3, '9782729863357', 1, 115, 18, 2, 3, 1),
(115, 'Mécanique vibratoire', '', 'IMG-646a38bc4edec6.55055885.jpg', 'Les phénomènes vibratoires jouent un rôle important dans la plupart des domaines de la physique appliquée : mécanique, électricité, optique, acoustique, etc. Cet ouvrage a pour objet les vibrations des systèmes mécaniques linéaires et discrets, c\'est-à-dire ne comportant qu\'un nombre fini de degrés de liberté. Les méthodes d\'analyse exposées conviennent également à l\'étude d\'autres phénomènes vibratoires linéaires.\r\nUn exposé rigoureux et exhaustif des bases de la mécanique des systèmes discrets linéaires est l\'objectif essentiel recherché par les auteurs. Il s\'agit de mettre à disposition des étudiants ingénieurs, comme des praticiens, un ouvrage de base permettant une bonne compréhension de la dynamique des structures, en particulier de l\'analyse modale.', 264, 30, '1993', 3, '9782880742430', 1, 116, 18, 3, 3, 1),
(117, 'Vibrations des machines et diagnostic de leur état mécanique', '', 'IMG-646a3b4dba4192.24408613.jpg', '\"Il n\'est de bonne machine, tant qu\'elle souffre de vibrations.\" On peut ainsi exprimer, sous forme de maxime le souci permanent de tous ceux qui ont à créer ou à utiliser des systèmes mécaniques et qui rencontrent dans les phénomènes vibratoires un obstacle majeur à la bonne qualité de fonctionnement des appareils.\r\n\r\nLe mal qu\'ils doivent combattre revêt de multiples visages. Ici ce seront les efforts alternés qui, par effet de fatigue au sein de la matière ou de fretting entre deux surfaces accolées, entraîneront la fissuration puis la rupture des pièces ; ailleurs l\'excès des amplitudes fera naître le risque de contacts dangereux entre les parties fixes et mobiles d\'une machine tournante, ou pour le moins, celui d\'usures accélérées; dans d\'autres cas encore, les vibrations transporteront avec elles une énergie acoustiquement gênante.\r\n\r\nCependant les principaux problèmes ne résident pas tant dans la diversité des risques encourus que dans la complexité des mouvements observés et des facteurs en oeuvre, qui rend difficile de démêler l\'écheveau des effets et des causes.\r\n\r\nAussi le présent ouvrage de Jacques MOREL mérite-t-il un accueil particulièrement chaleureux parce qu\'il répond avec talent à un besoin jusqu\'ici très mal servi par la littérature technique en se proposant de nous instruire dans l\'art de diagnostiquer une maladie vibratoire et de la guérir.\r\n\r\nL\'originalité de ce projet appelait une démarche inhabituelle qui vise essentiellement à aiguiser le sens physique du lecteur. Sans négliger aucune des ressources de la théorie mais en évitant le poids de ses développements mathématiques, l\'auteur a privilégié l\'illustration de tous les liens qui existent entre la nature profonde des phénomènes et leurs manifestations accessibles par la mesure. C\'est par cette voie, dépassant délibérément le cadre des situations idéalisées et rigoureusement modéli-sables que se crée progressivement un climat d\'intimité avec la physique vivante des vibrations et que des facteurs aussi complexes que l\'intervention du système solide - mais déformable - avec son environnement fluide, viennent s\'intégrer dans une vision intuitive des choses.', 404, 35, '1992', 3, '9782212016260', 1, 118, 18, 15, 3, 1),
(118, 'Physique 1 - mécanique', '', 'IMG-646a2ac90f6422.19478768.jpg', 'Les trois tomes de cette collection originale, testée et éprouvée en classe, mettent en oeuvre une approche intégrée de l\'enseignement de la physique au collégial et sont adaptés à la réalité de l\'étudiant d\'aujourd\'hui.\r\nActuelle, attrayante et efficace, la facture visuelle des ouvrages facilite la compréhension de la matière.\r\nLes concepts abordés dans les chapitres vont du concret vers l\'abstrait et les explications s\'appuient sur des exemples réalistes. L\'étudiant est guidé dans son apprentissage au moyen de notions théoriques rigoureusement présentées et d\'une stratégie de résolution de problèmes appliquée dans les nombreux exemples résolus. Ces qualités pédagogiques permettront à l\'étudiant de réussir ses cours de physique au collégial et de se distinguer à l\'université.\r\n\r\nDe plus, la collection est accompagnée de ressources exceptionnelles et inédites :\r\n* les solutionnaires détaillés des questions, exercices et problèmes ;\r\n* des problèmes de synthèse conceptuels qui facilitent l\'intégration de la matière vue dans différents chapitres ;\r\n* des défis animés qui relient la matière du manuel à de nombreuses simulations interactives en ligne.\r\nCette collection marque la véritable entrée des manuels de physique dans l\'ère numérique, en bénéficiant des multiples et incomparables avantages offerts par la plateforme i+ interactif.', 492, 36, '2015', 3, '9782804193690', 1, 119, 15, 1, 3, 1),
(119, 'Physique théorique : mécanique', '', 'IMG-646a2bdd9a3bb4.09146830.jpg', 'Cet ouvrage est le sixième tome du cours de Physique théorique universellement connu des grands physiciens soviétiques Lev Landau, Prix Lénine et Nobel, et Evguéni Lifchitz, Prix Lénine et Lomonossov.\r\nCe tome traite de la mécanique des fluides, c’est-à-dire de la théorie du mouvement des liquides et des gaz. À la différence des autres ouvrages consacrés à ce sujet, la mécanique des fluides est ici exposée en tant que partie de la physique théorique. Les auteurs abordent tour à tour la théorie de la propagation de la chaleur, la théorie de la diffusion dans les liquides, l’acoustique, la théorie de la combustion ainsi que l’hydrodynamique relativiste et l’hydrodynamique relativiste et l’hydrodynamique du suprafluide.\r\nCes sujets sont traités de façon originale et l’exposé en est complet et très clair. Chaque partie est illustrée par des exemples et des problèmes.\r\nL’ouvrage est destiné aux physiciens et aux élèves des facultés de physique et de mathématiques.', 752, 2, '1994', 3, '9782729894023', 7, 120, 15, 2, 3, 7),
(120, 'Mécanique du point matériel', 'Cours Et 201 Exercices Corrigés 1ere Année LMD', 'IMG-646a2cb9ae9c74.81911168.jpg', 'Cet ouvrage donne un aperçu aussi complet que possible des concepts de la mécanique du point matériel. Il est destiné aux étudiants des troncs communs des sciences de la matière (SM), mathématiques et informatique (MI), et sciences et techniques (ST). Il est conforme au programme de physique du premier semestre. Il est divisé en deux chapitres. Le premier présente les systèmes d\'unités, l\'analyse dimensionnelle, les incertitudes, l\'analyse vectorielle, les systèmes de coordonnées et les opérateurs gradient, divergence, laplacien et rotationnel ; le second traite de la cinématique et de la dynamique du point matériel, point géométrique doué d\'une masse inertielle. Cet ouvrage a été conçu avec un souci accru de pédagogie et la volonté de rendre les concepts de la mécanique du point simples et accessibles aux étudiants des différents troncs communs. Chaque chapitre se termine par des exercices résolus minutieusement choisis dont l\'objectif est de permettre à l\'étudiant de tester sa propre compréhension du cours et de développer ses capacités d\'analyse et de critique.', 580, 37, '2015', 3, '9782753902558', 1, 121, 15, 3, 3, 1),
(121, 'Mécanique des milieux continus', 'Introduction Aux Principes Et Applications', 'IMG-646a2d8b3e0e83.93653250.jpg', 'Une introduction élémentaire à la physique des milieux continus et à ses applications dans des domaines aussi variés que le transfert thermique, la mécanique des fluides ou l\'élasticité.', 263, 36, '2013', 3, '9782804175559', 4, 122, 15, 4, 3, 4),
(122, 'Mécanique : fondements et applications, avec 320 exercices et problèmes résolus', 'Licence, Classes Préparatoires, Capes-Agrégation', 'IMG-646a2f897e4273.29880989.jpg', 'Cet ouvrage, découpé en 32 chapitres, rassemble, en un seul volume, les fondements et les applications de la mécanique.\r\nLa première partie est centrée sur la mécanique du corpuscule soumis à des forces. Dans la deuxième, on présente la mécanique des N particules en interaction ; dans ce contexte, la complexité de l’étude et tout l’intérêt de l’approximation du problème à deux corps sont soulignés. Dans la troisième partie, plus technique, on développe la mécanique générale des solides indéformables. Enfin, la dernière partie porte sur la mécanique des fluides.\r\nCe livre s’inscrit dans la collection « Fondements et applications » en physique ; aussi est-il découpé en leçons quasi autonomes, illustrées par de nombreux exemples d’applications et prolongées par plus de 320 exercices et problèmes résolus.\r\nCette septième édition, revue et corrigée à la lumière des avancées de la physique, s’enrichit de nouveaux exercices et problèmes, ainsi que d’exemples de simulations sous MATLAB.\r\nCe manuel s’adresse plus particulièrement aux étudiants de licence, classes préparatoires, IUT et INSA. Par sa présentation didactique, la mise en avant de l’aspect expérimental, la prise en compte des ordres de grandeur et de l’analyse dimensionnelle, les références historiques, il intéressera certainement l’ensemble de la communauté éducative en mécanique, à tous les niveaux d’enseignement, parmi eux évidemment les futurs enseignants (CAPES et Agrégation).', 832, 13, '2022', 3, '9782100839223', 2, 123, 15, 5, 3, 2),
(123, 'Mécanique des fluides', '', 'IMG-646a30a135a6d9.50353422.jpg', 'Cet ouvrage est destiné aux étudiants de premier cycle en génie mécanique qui suivent un cours d\'introduction à la mécanique des fluides. Il peut être utile également aux étudiants d\'autres branches du génie et aux praticiens qui désirent se familiariser avec les bases de cette discipline ou bien rafraîchir leurs connaissances.\r\n\r\nIl présente les notions essentielles de la statique, de la cinématique et de la dynamique des fluides. Le volume couvre l\'hydrostatique, les lignes de courant, la continuité, les écoulements à potentiel, les équations de la quantité de mouvement sous forme intégrale, les équations d\'Euler et de Navier-Stokes, l\'analyse dimensionnelle, les écoulements compressibles, les couches limites laminaires et finalement les problèmes d\'hydraulique.\r\n\r\nLes auteurs ont rédigé ce manuel avec le souci pédagogique de faire alterner du début à la fin l\'exposé d\'un aspect de la théorie avec la présentation de nombreux exemples résolus, à l\'instar des ouvrages nord-américains, tout en gardant le texte concis.\r\n\r\nLe lecteur pourra par ailleurs vérifier ses connaissances à l\'aide d\'une liste de problèmes à la fin de chaque chapitre.', 450, 23, '2004', 3, '9782553011351', 3, 124, 16, 1, 3, 3),
(124, 'Physique appliquée, Vol. 1. Les bases et l\'électronique de puissance', 'BTS Électrotechnique : Résumés De Cours, Exercices Et Contrôles Corrigés', 'IMG-646a321c4185b9.70268523.jpg', 'Dans les ouvrages de la collection Contrôle continu vous trouverez :\r\n\r\ndes résumés de cours, pour réviser rapidement\r\ndes exercices corrigés, variés et progressifs pour vous entraîner et tester vos connaissances\r\ndes problèmes avec résolution pour se préparer efficacement aux contrôles écrits de votre classe.', 420, 2, '2010', 3, '9782729853716', 1, 125, 16, 2, 0, 1),
(125, 'Écoulements et réactions chimiques', 'Applications aux mélanges hétérogènes réactifs', 'IMG-646a32e4564381.50192596.jpg', 'Les écoulements avec réactions chimiques peuvent intervenir dans des domaines variés tels que la combustion, le génie des procédés, l\'aéronautique, l\'environnement atmosphérique et aquatique. Les interactions induites entre écoulement fluide, échange thermique et réaction chimique sont telles que dans de nombreuses applications, il n\'est pas possible de traiter ces aspects séparément. L\'aérodynamique, la thermodynamique et la chimie sont ainsi sollicitées en permanence, ce qui a conduit à la création d\'un domaine scientifique appelé l\' \"aérothermochimie\" . Cet ouvrage analyse la mise en place, pour ces milieux, de systèmes cohérents d\'équations avec leurs conditions aux limites et aux interfaces permettant de modéliser et de faire face aux situations complexes. Il propose l\'étude des fluides simples, des mélanges réactifs et des interfaces et lignes. Plusieurs annexes permettent de développer certaines notations mathématiques, mais également la thermodynamique et les méthodes de la mécanique.', 352, 38, '2012', 3, '9782746245860', 1, 0, 16, 5, 3, 1),
(126, 'Physique des écoulements et des transferts - Volume 2', 'Eléments de mécanique des fluides et de thermique', 'IMG-646a33bbdb1f29.25583702.jpg', 'Les écoulements avec réactions chimiques peuvent intervenir dans des domaines variés tels que la combustion, le génie des procédés, l\'aéronautique, l\'environnement atmosphérique et aquatique. Les interactions induites entre écoulement fluide, échange thermique et réaction chimique sont telles que dans de nombreuses applications, il n\'est pas possible de traiter ces aspects séparément. L\'aérodynamique, la thermodynamique et la chimie sont ainsi sollicitées en permanence, ce qui a conduit à la création d\'un domaine scientifique appelé l\' \"aérothermochimie\" . Cet ouvrage analyse la mise en place, pour ces milieux, de systèmes cohérents d\'équations avec leurs conditions aux limites et aux interfaces permettant de modéliser et de faire face aux situations complexes. Il propose l\'étude des fluides simples, des mélanges réactifs et des interfaces et lignes. Plusieurs annexes permettent de développer certaines notations mathématiques, mais également la thermodynamique et les méthodes de la mécanique.', 352, 38, '2012', 3, '9782746215412', 1, 0, 16, 5, 3, 1),
(130, 'Optique en 26 fiches', '', 'IMG-646a3c20d75932.35274874.jpg', 'Des principes aux applications\r\n\r\nComment aller à l\'essentiel, comprendre les méthodes et les démarches avant de les mettre en application ?\r\n\r\nConçue pour faciliter aussi bien l\'apprentissage que la révision, la collection Express vous propose une présentation simple et concise de l\'optique géométrique en 26 fiches pédagogiques.\r\n\r\nChaque fiche comporte :\r\n\r\nLes idées clés à connaître,\r\nLa méthode à mettre en oeuvre,\r\nDes applications sous forme d\'exercices corrigés.', 158, 13, '2008', 3, '9782100517886', 2, 129, 19, 1, 3, 2),
(131, 'Physique III - Ondes, optique et physique moderne (manuel + solutionnaire numérique)', '', 'IMG-646a3cc8ae49c9.12244927.jpg', 'Cette édition préserve les caractéristiques qui ont fait la force de la précédente, comme la clarté et la concision du texte, l\'intégration d\'éléments d\'histoire des sciences, la rigueur du code de couleurs dans les figures.\r\nCette 5e édition de la série Physique, jouissant d\'une solide réputation, a été très largement revue afin d\'en améliorer encore la qualité. Le lecteur retrouvera les principales qualités de ces ouvrages : rigueur et clarté du texte, intégration d\'éléments, histoire des sciences, qualité de la mise en page, réalisme des figures et variété des exercices.\r\n\r\nDes applications de la physique aux sciences de la vie\r\n\r\nPlus de 250 applications, réparties entre les trois tomes, mettent en valeur la pertinence et l\'importance de la physique dans divers domaines des sciences de la vie et de la santé. Facilement repérables grâce à une icône, ces applications prennent la forme d\'exemples ou d\'exercices, mais aussi de passages directement intégrés au texte principal.\r\n\r\nUn texte qui cible les erreurs conceptuelles fréquentes\r\n\r\nLa plupart des étudiants commencent leurs études en physique avec en tête des idées préconçues erronées mais dont ils sont convaincus, par exemple leur propre version des lois du mouvement. La 5e édition cible systématiquement les erreurs conceptuelles les plus fréquentes et les confronte au raisonnement adéquat.\r\n\r\nPlus de 200 nouvelles figures\r\n\r\nLa variété des illustrations, qui était déjà une force des éditions précédentes, a été encore rehaussée d\'un cran. Plusieurs des nouvelles figures permettent de mieux appréhender des concepts difficiles, comme la notion de bras de levier ou le raisonnement géométrique qui conduit à ? = d sin ? dans l\'expérience de Young.\r\n\r\n Plus de 150 nouveaux exemples, exercices et problèmes\r\n\r\nLes nouveautés de la 5e édition ne se reflètent pas seulement dans le texte des chapitres, mais aussi dans le travail proposé à l\'étudiant. En plus des applications aux sciences de la vie, nous avons ajouté des exemples et des exercices portant sur les thèmes qui en comportaient peu.', 666, 39, '2016', 3, '9782804155148', 6, 130, 19, 2, 3, 6),
(133, 'Introduction à l\'optique quantique', '', 'IMG-646a3d75598d51.74397929.jpg', 'L\'étude du rayonnement lumineux a amené une remise en cause des idées reçues et a servi de point de départ à la physique des quanta. Mais, malgré les progrès technologiques prodigieux des dernières décennies, la notion de photon reste mal comprise et sujette à bien des paradoxes, du moins, en apparence. L\'objectif de cet ouvrage est de transmettre au lecteur les fondements nécessaires pour aborder l\'étude de ce domaine captivant. Il retrace d\'abord les origines de la mécanique quantique et des progrès historiques qui ont mené les connaissances à leur état actuel. Il s\'attaque ensuite à l\'étude des fluctuations quantiques, aux notions liées au vide et aux états cohérents ainsi qu\'à l\'obtention des états comprimés à l\'aide de l\'optique non linéaire. Il discute aussi du paradoxe EPR, des inégalités de Bell, de la non-démolition quantique, de la cryptographie quantique et des représentations quantiques, et aborde le sujet de l\'électrodynamique quantique. L\'ouvrage s\'adresse aux étudiants en génie, aux ingénieurs praticiens et aux scientifiques qui, possédant une formation de base en mécanique quantique, souhaitent acquérir rapidement un niveau de compétence appréciable en optique quantique.', 334, 40, '2008', 3, '9782553014185', 1, 132, 19, 4, 3, 1),
(134, 'Spectroscopie atomique', 'Instrumentation et structures atomiques', 'IMG-646a3dc5b69a93.53755579.jpg', '\"Un regard nouveau sur une science ancienne ! Voilà un ouvrage qui synthétise les principaux domaines de la spectroscopie atomique, une science en évolution rapide et spectaculaire depuis plusieurs décennies.\"\r\n\r\nUne partie des secrets véhiculés par la lumière nous est transmise par la spectroscopie. Depuis l\'époque de Newton, considéré comme le père de la spectroscopie, jusqu\'au XXIe siècle, cette science a connu des avancées multiples et souvent très spectaculaires. Un seul exemple : il suffit de penser à l\'impact extraordinaire et universel dû à la découverte du laser ! Le but du présent ouvrage est, en partant de considérations historiques, de décrire l\'état actuel de cette discipline dont les méthodes apparaissent comme un outil indispensable dans de multiples domaines. Depuis l\'analyse des spectres astrophysiques enregistrés par le Hubble Space Télescope jusqu\'à l\'étude des oeuvres d\'art en archéométrie, en ne négligeant pas les contributions relatives à l\'environnement, à la métrologie, aux recherches à caractère militaire, à l\'industrie des matériaux ou aux sciences biomédicales, la spectroscopie a accru de manière considérable son impact sur de multiples domaines qui relèvent des sciences pures et appliquées.\r\n\r\nCet ouvrage a pour ambition de synthétiser les principaux aspects de cette science en mutation.\r\n\r\nLa première partie initie le lecteur à l\'instrumentation à laquelle il est fait appel pour disperser la lumière et elle décrit ensuite les principales sources ainsi que les détecteurs de radiation. La seconde partie étudie les structures et les spectres atomiques, des plus simples au plus complexes. Elle s\'attarde aussi sur l\'interaction de la radiation avec les atomes ou sur l\'effet des champs extérieurs qu\'ils soient électriques ou magnétiques.\r\n\r\nCe livre s\'adresse aux étudiants en 3e année de Licence et en Master de physique, de chimie, de biologie, et en écoles d\'ingénieurs. Il intéressera également les chercheurs et doctorants ayant pour objet d\'étude cette matière ou plus spécialisés en astrophysique.\r\n\r\nLes \"plus\"\r\nOuvrage détaillé mais synthétique\r\nIl tient compte des développements récents dans le domaine\r\nOrienté vers l\'expérience et vers la théorie\r\nRigoureux tout en étant accessible pour le lecteur débutant en la matière', 540, 36, '2006', 3, '9782804150358', 4, 133, 19, 5, 3, 4),
(135, 'Les bases de la thermodynamique: Cours et exercices corrigés', '', 'IMG-646a3e94a1d928.14535637.jpg', 'La thermodynamique est une discipline nouvelle, et souvent difficile à appréhender, pour les étudiants qui commencent leurs études supérieures. Pour rendre cette matière plus attrayante et faciliter son assimilation, les principes fondamentaux sont introduits progressivement en s\'appuyant sur des applications concrètes. L\'outil mathématique est réduit à l\'essentiel. Grâce à des définitions claires, de très nombreux exemples et des exercices corrigés en relation étroite avec le cours, ce livre permet à chacun de comprendre et de maîtriser les concepts fondamentaux de la thermodynamique.\r\nDans cette nouvelle édition actualisée, le chapitre sur les fluides réels purs a été revu  et complété pour les parties utilisation des équations cubiques, grandeurs résiduelles et diagrammes thermodynamiques. De même, le chapitre sur les machines thermiques a été réécrit pour être plus proche des installations réelles.\r\nDe nouveaux exercices sont proposés.', 260, 13, '2015', 3, '9782100833139', 4, 134, 20, 1, 3, 4);
INSERT INTO `books` (`idBook`, `nameBook`, `parallelTitele`, `image`, `summary`, `hardCover`, `idPublisher`, `dateOfPublisher`, `idLanguage`, `isbn`, `quantity`, `idAuthors`, `idType`, `nbrBook`, `idCategorie`, `nbrCopy`) VALUES
(136, 'Aide-mémoire de thermodynamique', 'Principes Et Relations Fondamentales, Propriétés Des Corps Purs Et Des Mélanges, Cycles Thermodynamiques, Combustion', 'IMG-646a3f25efdaf0.06265007.jpg', 'Cet aide-mémoire regroupe de façon synthétique et illustrée toutes les définitions, équations et méthodes à connaître pour appliquer les concepts de la thermodynamique.\r\n\r\nDe nombreux tableaux de données sur les propriétés thermodynamiques des corps sont détaillés.\r\n\r\nCette 4e édition constitue un outil de travail indispensable pour les ingénieurs et techniciens en énergétique et en mécanique, ainsi que les étudiants et élèves-ingénieurs du domaine.', 304, 13, '2018', 3, '9782100775897', 7, 76, 20, 4, 3, 7),
(137, 'Thermodynamique et énergétique - 1 - De l\'énergie à l\'exergie', '', 'IMG-646a3f9506c7a9.12068781.jpg', 'L\'objectif de cet ouvrage est de faciliter la compréhension et l\'enseignement de la thermodynamique de l\'ingénieur. Une large part est consacrée au phénomène d\'irréversibilité et à la notion d\'entropie. Une formulation mathématique précise de ce concept permet d\'appliquer le Deuxième Principe de la thermodynamique d\'une façon pratique et efficace.\r\n\r\nUne théorie générale de l\'exergie est exposée. Les méthodes d\'analyse sont développées pour permettre à l\'ingénieur de traiter avec clairvoyance les problèmes très actuels de gestion et d\'économie de l\'énergie.\r\n\r\nDe nombreuses applications pratiques sont présentées, en vue d\'illustrer l\'aspect pratique des théories mises en oeuvre (chambres de combustion, chaudières, turbines, compresseurs, transmetteurs d\'énergie thermique, cycles, moteurs, piles à combustible, pompes à chaleur, climatisation, réfrigération...).\r\n\r\nCette nouvelle édition entièrement revue et augmentée reprend en grande partie le contenu des précédentes éditions, avec un nouvel ordonnancement des chapitres, avec des notations compatibles avec les principaux logiciels de traitement de texte, avec des extensions portant sur la formulation des principes de la thermodynamique et des propriétés de fluides, enfin avec l\'analyse exergétique notamment des processus réactifs et de nouveaux exemples d\'application.', 815, 30, '2005', 3, '9782880745455', 4, 77, 20, 5, 3, 4),
(138, 'La thermodynamique des principes aux applications', 'Principes, Systèmes Simples, Utilisation', 'IMG-646a403a4357c5.95836640.jpg', 'Ouvrage de référence développant une construction progressive rigoureuse de la thermodynamique, des principes aux applications\r\n\r\nSont proposées l’approche microscopique partant de la structure de la matière et l’approche macroscopique procédant par déductions logiques d’un minimum d’hypothèses : les principes. Pour contenir en germes les concepts et les lois générales, les énoncés retenus pour ces principes sont donc ceux qui traduisent clairement leur signification profonde, à savoir la définition de trois grandeurs fondamentales : la température (principe zéro), l’énergie (premier principe) et l’entropie (deuxième principe). S’en déduisent alors immédiatement une définition de la chaleur, ainsi que des corollaires expliquant l’évolution générale des systèmes.\r\n\r\nDans une partie distincte, les propriétés spécifiques des systèmes simples sont associées aux principes pour étudier dans chaque cas les échanges énergétiques. Sont ainsi traités les phases fermées, le gaz parfait, les écoulements monophasiques, les états d’un système à un constituant et l’utilisation des diagrammes.\r\n\r\nEnfin, les résultats acquis sont exploités dans les applications types : gaz réels, air humide, tuyères et machines motrices et réceptrices.\r\n\r\nPar son enchaînement logique strict, l’ouvrage offre sur la thermodynamique une vue d’ensemble claire et précise.', 288, 2, '2011', 3, '9782729861032', 3, 135, 20, 6, 3, 3),
(139, 'Thermodynamique', 'Applications aux systèmes physicochimiques - Cours et exercices corrigés', 'IMG-646a4138717781.08957647.png', 'Cet ouvrage aborde les phénomènes de mélange de constituants répartis dans plusieurs phases en équilibre, où des réactions chimiques peuvent se produire. Ainsi, il s\'intéresse aux fondements des procédés des industries chimiques, biotechnologiques et pharmaceutiques, mais aussi à de nombreuses situations de la vie courante.\r\n\r\nCe cours est un exposé clair et précis, illustré de 40 exercices originaux choisis pour leur valeur pédagogique et illustrant, pour la plupart, des cas concrets et familiers. S\'adressant à un public qui a déjà appréhendé les bases de la thermodynamique, il est aussi exhaustif que possible, toutefois un soin particulier est apporté à la lisibilité pour dégager les notions essentielles.', 304, 13, '2015', 3, '9782804101251', 2, 74, 20, 7, 3, 2),
(140, 'Le cours de physique de Feynman - Électromagnétisme 2', '', 'IMG-646a522e2419f1.46243644.jpg', '\"L\'ampleur du succès qu\'a rencontré le Cours de physique de Feynman\"\"\r\ndès sa parution s\'explique par son caractère fondamentalement novateur\r\n. Richard Feynman, qui fut professeur d\'université dès l\'âge de vingt-\r\nquatre ans, a exprimé dans ce cours, avant d\'obtenir le prix Nobel de\r\nPhysique, une vision expérimentale et extrêmement personnelle de l\'ens\r\neignement de la physique. Cette vision a, depuis, remporté l\'adhésion\r\ndes physiciens du monde entier, faisant de cet ouvrage un grand classi\r\nque.Cette nouvelle édition corrigée bénéficie d\'un chapitre supplément\r\naire sur les espaces courbes et d\'une mise en page plus aérée pour un\r\nmeilleur confort de lecture.\"\"\"', 480, 13, '2017', 3, '9782100806362', 7, 109, 21, 3, 3, 7),
(141, 'Mini manuel d\'électromagnétisme', 'Electrostatique - Magnétostatique - L1/L2, IUT - Cours + Exos corrigés', 'IMG-646a52b7793ae1.91643932.jpg', 'Comment aller à l\'essentiel, comprendre les méthodes et les principes avant de les mettre en application ?\r\nConçus pour faciliter aussi bien l\'apprentissage que la révision, les Mini Manuels proposent un cours concis et richement illustré pour vous accompagner jusqu\'à l\'examen. Des exemples sous forme d\'encarts, des mises en garde, des méthodes et des exercices corrigés complètent le cours.\r\n\r\nCe Mini Manuel d\'Électromagnétisme rassemble les connaissances essentielles à tout étudiant en L1/L2 (Sciences de la Matière, Sciences de la Vie et Santé) ou préparant un DUT.', 208, 13, '2009', 3, '9782100518562', 4, 136, 21, 14, 3, 4),
(142, 'Précis de physique nucléaire', '', 'IMG-646a54a054d382.13168025.jpg', 'Cet ouvrage de synthèse expose les notions de base de la physique du noyau et des domaines qui l\'entourent.\r\n\r\nAprès avoir présenté un panorama général, l\'auteur étudie les noyaux, les particules et leurs interactions, en allant jusqu\'aux particules ultra-relativistes. La radioactivité naturelle et la radioactivité artificielle sont ensuite abordées, ainsi que les principaux modes d\'émission radioactive. L\'auteur se tourne ensuite vers des questions plus précises : les sources de rayonnement, la pénétration des particules dans la matière, la détection considérée d\'un point de vue global, la radiométrie, et enfin la dosimétrie, si importante en radioprotection.\r\n\r\nCette nouvelle présentation de la 2e édition a fait l\'objet de quelques corrections consistant à une actualisation des informations.', 213, 13, '2004', 3, '9782100075287', 4, 137, 21, 15, 3, 4),
(143, 'Le champ électrique dans le vide', 'Classes préparatoires scientifiques - Premiers cycles universitaires', 'IMG-646a569b2c7f77.78721769.jpg', 'Enseignée en première année, l\'électrostatique dans le vide constitue la base des connaissances. C\'est le modèle théorique qui va permettre d\'aborder ensuite l\'étude du champ électrique dans la matière.\r\n\r\nNouveau manuel de physique conforme à l\'esprit actuel de l\'enseignement supérieur scientifique\r\n\r\nexposé très progressif des notions fondamentales\r\ndonnées théoriques indispensables\r\nnombreux exemples très développés.\r\nOuvrage clairement organisé pour y trouver rapidement tout ce dont on peut avoir immédiatement besoin et livre de référence, il fournira aussi à ses utilisateurs le moyen efficace d\'acquérir une démarche personnelle.', 130, 9, '1995', 3, '9782711740956', 5, 138, 21, 19, 3, 5),
(144, 'Manuel de physique générale Sup et Spé', '', 'IMG-646a570f536643.79773241.jpg', 'Premier tome d\'un manuel de Physique destiné aux étudiants des Classes Préparatoires aux Grandes Écoles et du Premier Cycle des Universités, issu de plusieurs années d\'expérience d\'enseignement et de participation à des jurys de concours d\'entrée dans les Grandes Écoles, ce cours d\'électromagnétisme se propose de présenter l\'ensemble de cette discipline telle qu\'elle figure au programme officiel des classes de Mathématiques Supérieures et Spéciales, y compris les développements spécifiques des programmes P et P\', en quatre parties :\r\n– l\'Électrostatique (y compris la partie qui figure au programme des classes de Mathématiques Supérieures) ;\r\n– les lois de la Magnétostatique ;\r\n– l\'étude des régimes électromagnétiques variables (Induction électromagnétique, Équations de Maxwell) ;\r\n– l\'étude électromagnétique des milieux matériels diélectriques et magnétiques (spécifique du programme P, P\').\r\nL\'ensemble est précédé d\'une introduction à l\'outil mathématique nécessaire à la compréhension de la suite. L\'ambition de cet ouvrage est d\'amener les étudiants à comprendre d\'abord et à appliquer ensuite ; il est donc complété de 137 exercices totalement corrigés. Ce livre n\'a pas d\'autre ambition que d\'aider les étudiants dans la difficile tâche de leur préparation aux concours d\'entrée aux Grandes Écoles.', 336, 2, '1993', 3, '9782729843120', 3, 128, 21, 23, 3, 3),
(149, 'Méthodes quasi-newton et applications', '', 'IMG-6436ec059c9185.35412298.jpg', 'Si les méthodes quasi-Newton sont bien connues en dimension finie, elles le sont moins en dimension infinie. Les problèmes de contrôle optimal, de calculs des variations et d\'identification des systèmes sont naturellement posés en dimension infinie.', 120, 23, '2013', 3, '9783841621795', 1, 43, 1, 8, 2, 1),
(167, 'Exercices de chimie générale', '400 exercices avec solutions - 140 QCM corrigés', 'IMG-646a5855a2d1d0.09475051.jpg', 'Cet ouvrage contient près de 400 exercices, qui permettront au lecteur non seulement d\'apprendre à résoudre des problèmes de chimie, mais aussi de savoir réagir aux résultats.\r\n\r\nPublic : Large public d\'étudiants et professeurs en chimie, sciences du vivant, science des matériaux et physique', 352, 30, '2010', 3, '9782880748821', 2, 0, 22, 10, 4, 2),
(168, 'Chimie du solide et énergie', 'Exemples et avenir d\'une science milénaire', 'IMG-646a59664097a2.23278954.jpg', 'Depuis l\'Antiquité, l\'homme utilise des procédés pour transformer les matériaux de son environnement en fonction de ses besoins. La chimie du solide, qui était initialement une série de recettes, est devenue, après les découvertes scientifiques du XIXe siècle, une véritable science de la matière et de ses transformations. Elle permet aujourd\'hui d\'élaborer des matériaux performants et éco-compatibles pour transporter ou stocker l\'énergie. La chimie du solide joue ainsi un rôle majeur dans les réponses que la science devra apporter aux préoccupations nouvelles de l\'humanité, notamment aux problématiques environnementales.', 0, 42, '2014', 3, '9782213682037', 3, 0, 22, 9, 4, 3),
(169, 'L\'oxygène dans tous ses états', '', 'IMG-646a5a4cd4a2f2.07377754.jpg', 'Et si l\'oxygène nous contait son histoire ? Juste retour des choses pour celui sans qui la vie serait impossible. Représentant 21 % du volume atmosphérique terrestre et 87 % de la masse des océans, il est tout simplement un acteur indispensable de notre monde. Sans lui, point de Terre et d\'humanité ! Quels rôles joue-t-il ? Quelles sont ses relations avec les autres molécules ? Efficace et originale, une autobiographie bien particulière que celle d\'O! Le professeur Jean Coudert signe un brillant ouvrage de vulgarisation scientifique qui ne sacrifie en rien à la précision. Environnement, nutrition, santé: toutes les problématiques sont abordées. Un style agréable pour une mine d\'informations, s\'adressant aux lecteurs de tout âge.', 150, 43, '2010', 3, '9782748355819', 2, 0, 22, 8, 4, 2),
(170, 'Toute la PCSI en fiches - Maths - Physique - Chimie', '', 'IMG-646a5afd139ae1.86840325.jpg', 'Les \"Tout-en-un\" J\'intègre proposent les résumés du cours de classes préparatoires scientifiques nécessaires pour aller à l\'essentiel et réviser en clin d\'oeil.\r\n\r\nEntièrement conforme à la réforme des programmes 2013, Toute la PCSI en fiches sera le compagnon indispensable pour réviser vos DS ou vos khôlles.', 590, 13, '2013', 3, '9782100600601', 3, 0, 22, 7, 4, 3),
(171, 'Chimie - Tout-en-un - PSI-PSI', 'Conforme au nouveau programme', 'IMG-646a5be496a483.18561240.jpg', 'Les \"Tout-en-un\" J\'intègre vous proposent le cours de référence en classes préparatoires scientifiques, ainsi que de nombreux exercices et problèmes intégralement résolus.\r\n\r\nEntièrement réécrits pour être conformes à la réforme des programmes 2014, les ouvrages J\'intègre sont les compagnons de votre réussité.', 544, 13, '2014', 3, '9782100713714', 1, 0, 22, 6, 4, 1),
(172, 'Réaction chimique', '', 'IMG-646a5d998fa806.27159404.jpg', '', 200, 44, '2007', 3, '9782363410238', 1, 0, 23, 2, 4, 1),
(173, 'Cinétique chimique - éléments fondamentaux', '', 'IMG-646a5e48355712.64341556.jpg', 'Les changements de comportements et de possibilités dus à l\'utilisation d\'une informatique avancée dans les laboratoires ont bousculé la tradition de la cinétique chimique, entraînant ainsi de profondes mutations dans la discipline.', 234, 26, '2011', 3, '9782746230026', 2, 0, 23, 3, 4, 2),
(174, 'Thermodynamique, tome 2', 'Deuxiéme principe et applications deug scientifiques', 'IMG-646a5f633502f8.93685546.jpg', '', 224, 45, '1998', 3, '9782200230487', 1, 0, 23, 22, 4, 1),
(175, 'Qcm chimie physique et organique pour lyon ed 2014', '', 'IMG-646a609868b100.16806936.jpg', '', 366, 46, '2014', 3, '9782818312384', 3, 0, 23, 5, 4, 3),
(176, 'himie PCSI : nouveaux programmes 2021', '', 'IMG-646a61cfcbb0f2.84594360.jpg', 'Cet ouvrage a pour objectifs de permettre aux étudiants en PCSI de réviser leur cours de Chimie et de l\'assimiler par la mise en application des notions. Dans chaque chapitre, correspondant à peu près à une semaine de cours', 696, 2, '2021', 3, '9782729895082', 1, 0, 23, 5, 4, 1),
(177, 'Santé et environnement', '', 'IMG-646a6322760011.68082930.jpg', 'Cet ouvrage présente la chimie impliquée dans la sécurité en termes de prévention ou d\'intervention des risques dans les domaines sanitaire et environnemental.\r\n\r\nNous sommes entourés de substances chimiques qu\'elles soient industrielles ou naturelles et leur expertise est nécessaire pour préserver notre environnement et notre santé.', 220, 20, '2016', 3, '9782759818488', 2, 0, 24, 10, 4, 2),
(178, 'Identification de prenylamine et ses métabolites par gc/ndp et gc/ms', '', 'IMG-646a63f5995699.28662472.jpg', 'La Prenylamine, médicament utilisé comme produit dopant, est totalement métabolisé. Ses métabolites ont été identifiés dans des excrétions urinaires humaines. En effet, suite à une extraction liquide-liquide appropriée, les échantillons ont été d\'abord analysés par chromatographie en phase gazeuse munie d\'un détecteur NPD (GC/NPD) et leur identité a été, par la suite, confirmée par un système de chromatographie en phase gazeuse couplé à un spectromètre de masse (GS/MS).Les résultats obtenus montrent l\'adéquation des protocoles d\'extraction et des techniques analytiques employés pour l\'identification des substances cibles. Une étude cinétique effectuée sur des prélèvements urinaires a révélé que le métabolite caractéristique de la Prenylamine, à savoir le diphenylpropylamine, ainsi que la cathine et la norephedrine sont lentement éliminés par le corps humain contrairement à l\'amphétamine.', 92, 47, '2015', 3, '9783841747990', 2, 0, 24, 9, 4, 2),
(179, 'Optimal Automated Process Fault Analysis', '', 'IMG-646a654cb0eef4.33486617.jpg', 'Tested and proven strategy to develop optimal automated process fault analyzers\r\n\r\nProcess fault analyzers monitor process operations in order to identify the underlying causes of operational problems. Several diagnostic strategies exist for automating process fault analysis; however, automated fault analysis is still not widely used within the processing industries due to problems of cost and performance as well as the difficulty of modeling process behavior at needed levels of detail.', 244, 48, '2012', 2, '9781118372319', 1, 0, 24, 7, 4, 1),
(180, 'La chimie expérimentale - Volume 2', '', 'IMG-646a6623d00a37.72347123.jpg', 'Plus qu\'un simple recueil d\'expériences, ce nouvel ouvrage de chimie a été conçu pour accompagner la pratique expérimentale des candidats aux CAPES de sciences physiques et à l\'agrégation de physique. Les candidats à l\'agrégation de chimie y trouveront également des pages qui les concernent.', 294, 13, '2007', 3, '9782100513772', 1, 0, 24, 5, 4, 1),
(181, 'Exercices de chimie analytique', '', 'IMG-646a6792147232.76835309.jpg', 'Cet ouvrage se propose d\'accompagner l\'étudiant en Licence ou en IUT  de Chimie ainsi qu\'en PAES dans son assimilation des connaissances.\r\n\r\nDans chaque chapitre, l\'étudiant trouvera : un rappel de cours ; des énoncés d\'exercices classés par ordre de difficulté croissante ; une rubrique \"Du mal à démarrer ?\". Pour chaque question, une indication est proposée afin d\'aider l\'étudiant à bien commencer la résolution de l\'exercice ; les solutions détaillées des exercices.', 293, 13, '2011', 3, '9782100556137', 1, 0, 25, 1, 4, 1),
(182, 'Chimie analytique', '', 'IMG-646a68554bc9a2.63592769.jpg', '', 1116, 36, '2012', 3, '9782804162955', 3, 0, 25, 2, 4, 3),
(183, 'Sécurité et prévention des risques en laboratoires de chimie et de biologie', '', 'IMG-646a69da8e9106.48057583.jpg', 'Cette troisième édition, entièrement actualisée et considérablement augmentée pour prendre en compte la plupart des risques présents dans les laboratoires, intègre les nouvelles exigences réglementaires françaises et européennes et tient compte de l\'évolution des connaissances dans le domaine des risques professionnels. Elle conserve les qualités et les principes fondamentaux qui ont fait le succès international des deux premières éditions du \"Picot-Grenouillet\".', 1120, 16, '2016', 3, '9782743010690', 2, 0, 25, 12, 4, 2),
(184, 'Chimie inorganique', '', 'IMG-646a6b7b0fb3f1.46431986.jpg', 'Conçus pour faciliter l\'apprentissage des notions essentielles, les Mini Manuels proposent un coursconcis et richement illustré, des exemples, des mises en garde et des méthodes pour vous accompagner jusqu\'à l\'examen. Enfin, des exercices corrigés vous permettent de tester vos connaissances.', 260, 13, '2020', 3, '9782100807666', 2, 0, 26, 1, 4, 2),
(185, 'Chimie inorganique', '', 'IMG-646a6c6162c402.57594108.jpg', 'Chimie Inorganique de Housecroft & Sharpe s\'est imposé comme le manuel de référence dans ce domaine et a été complètement mis à jour dans cette troisième édition. Conçu pour les étudiants, Chimie inorganique met l\'accent sur l\'enseignement des principes fondamentaux de la chimie inorganique d\'une façon moderne et pertinente.', 1089, 36, '2010', 3, '9782804162184', 2, 0, 26, 2, 4, 2),
(186, 'Chimie des milieux aquatiques', '', 'IMG-646a6d3cc10319.42459976.jpg', 'La chimie des milieux aquatiques étudie la nature des substances dissoutes et en suspension dans les eaux naturelles et autres systèmes aquatiques, ainsi que les équilibres chimiques et les processus physico-chimiques dans lesquels ces substances sont impliquées. Cette discipline tient aussi compte des processus biologiques, géochimiques et physiques dans ces milieux.', 528, 13, '2022', 3, '9782100843084', 2, 0, 26, 5, 4, 2),
(187, 'Chimie et écologie : les eaux naturelles', 'Chimie, équilibres fondamentaux, pollutions', 'IMG-646a7256518c52.40901069.jpg', 'Ouvrage de référence pour les filières de l\'environnement, le livre s\'articule autour de trois axes principaux, avec des informations permettant au lecteur une prompte compréhension de la chimie des eaux. Il décrit en détail les équilibres fondamentaux, les eaux naturelles et les pollutions qui interviennent dans des mécanismes réactionnels plus ou moins spontanés et naturels, ou causés par le contexte environnemental.', 164, 2, '2016', 3, '9782340011977', 2, 0, 26, 4, 4, 2),
(188, 'Les cours de Paul Arnaud', 'Exercices résolus de chimie organique', 'IMG-646a7848456880.75403030.jpg', 'Ce recueil d\'exercices résolus couvre les bases de la chimie organique : structure des molécules, isomérie, stéréochimie, mécanismes réactionnels, fonctions simples, principales fonctions multiples et mixtes.\r\nIl constitue un complément naturel à la 19e édition du Cours de chimie organique des mêmes auteurs, mais il peut être utilisé indépendamment de celui-ci.\r\nCette nouvelle édition actualisée s\'enrichit d\'exercices supplémentaires.', 432, 13, '2022', 3, '9782100851249', 1, 0, 27, 6, 4, 1),
(189, 'Qcm + chimie organique ed 2014 paris 6', '', 'IMG-646a79693be276.27572572.jpg', '', 150, 46, '2014', 3, '9782818312193', 3, 0, 27, 9, 4, 3),
(190, 'Chimie organique', 'Cours avec 350 questions et exercices corrigés', 'IMG-646a7a6ca1d537.13637154.jpg', 'Nouvelle édition de ce cours tout en couleur, qui ne suppose aucun préalable en chimie organique. Ce cours de référence s\'attache à montrer, de manière très pédagogique, l\'existence et la régularité des relations entre la structure et la réactivité. La description des principaux mécanismes réactionnels est au service de la meilleure compréhension. Cette nouvelle édition met l\'accent sur les outils de détermination et les grandes familles des mécanismes réactionnels et sur le rôle du solvant. Un nouveau chapitre concerne la chimie et l\'environnement.', 729, 13, '2009', 3, '9782100526475', 2, 0, 27, 11, 4, 2),
(191, 'Traité de chimie organique', '', 'IMG-646a7b470729d4.66711206.jpg', 'Dans cette sixième édition, on retrouve à nouveau un niveau d\'excellence qui fait la force de cette référence internationale en chimie organique. Ce livre se veut exhaustif, comprenant en cela une description claire et détaillée des diverses méthodes spectroscopiques (dont la résonance magnétique nucléaire et la spectrométrie de masse).', 1418, 36, '2015', 3, '9782804190446', 2, 0, 27, 11, 4, 2),
(192, 'Introduction à la cristallochimie', 'Solide cristallisé et empilements compacts', 'IMG-646a7c8e3253f1.36422586.jpg', 'L\'ouvrage est de niveau A (IUT - BTS - 1er cycle)\r\n\r\nFacile à appréhender sans nombreux prérequis spécifiques l\'ouvrage est une initiation à la description de l\'état solide, passage obligé pour de nombreux étudiants scientifiques.\r\n\r\nLe premier chapitre introduit les paramètres caractéristiques. Puis il les utilise pour construire une description structurale des solides. Il traite de la périodicité cristalline. Il présente également les techniques courantes de synthèse des solides et les lois fondamentales à la base de la détermination des structures.', 158, 2, '2007', 3, '9782729836559', 2, 0, 28, 3, 4, 2),
(193, 'Le cristal et ses doubles', '', 'IMG-646a7d1ceac005.58783381.jpg', '', 363, 18, '2010', 3, '9782271070494', 3, 0, 28, 4, 4, 3),
(194, 'Physique - Cristallographie et diffraction', 'Application à la diffraction électronique - Cours exercices corrigés', 'IMG-646a7ded120fc0.93560705.jpg', 'Consacré à la diffraction par les cristaux, l\'ouvrage développe en application une présentation théorique et technologique des techniques basées sur la seule diffraction des électrons.\r\n\r\nDestiné d\'abord aux seconds cycles des Universités et aux Écoles d\'ingénieurs, il ne fait appel qu\'aux notions de physique exposées en classes préparatoires. Il permet néanmoins une lecture à deux niveaux : un niveau découverte et un niveau approfondissement (sans toutefois aller jusqu\'à présenter des développements très en pointe), pour des lecteurs désireux de compléter leur formation initiale ou de revisiter des méthodes plus actuelles.', 240, 2, '2018', 3, '9782340023383', 1, 0, 28, 5, 4, 1),
(195, 'Cristallographie aux rayons X', '', 'IMG-646a7e8a4c5c25.90198040.jpg', 'Ce livre a pour objectif d\'apporter une initiation à la technique de résolution de structure par cristallographie aux rayons X aux étudiants en chimie. Il n\'a pas été conçu comme un manuel pratique pour les chercheurs du domaine. L\'approche choisie est d\'introduire les principes et les concepts fondamentaux, de montrer comment ils sont utilisés en pratique, et ensuite d\'illustrer avec des cas concrets dans des études. Quelques sujets relatifs à la cristallographie sont discutés dans le dernier chapitre.', 132, 20, '2018', 3, '9782759821105', 5, 0, 28, 5, 4, 5),
(196, 'Minéralogie', 'Cours et exercices corrigés', 'IMG-646a7fd4488d34.48301146.jpg', 'Cet ouvrage est conçu comme un livre de base, utile à tous ceux qui on\r\nt besoin de comprendre le minéral. Reprenant les concepts à un niveau\r\nélémentaire, il ne suppose connues que les bases essentielles acquises\r\ndans le secondaire.', 224, 13, '2014', 3, '9782100600120', 5, 0, 29, 1, 4, 5),
(200, 'leila', 'test', 'IMG-64727395723790.85543143.', '', 0, 25, '2023', 1, '', 22, 0, 10, 12233, 1, 22);

--
-- Triggers `books`
--
DELIMITER $$
CREATE TRIGGER `update_notification` AFTER UPDATE ON `books` FOR EACH ROW BEGIN 
IF NEW.nbrCopy > 1 THEN
UPDATE notifications SET send = 1 WHERE idBook=NEW.idBook;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `idB` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `dateGet` date NOT NULL DEFAULT current_timestamp(),
  `dateReturn` date NOT NULL,
  `Action` varchar(50) NOT NULL,
  `isReturn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`idB`, `idUser`, `idBook`, `dateGet`, `dateReturn`, `Action`, `isReturn`) VALUES
(2, 31, 4, '2023-03-13', '2023-03-20', 'reed', 1),
(8, 32, 37, '2023-03-14', '2023-03-14', 'reed', 1),
(10, 32, 4, '2023-05-05', '2023-05-05', 'read', 1),
(11, 32, 37, '2023-05-05', '2023-05-05', 'read', 1),
(22, 31, 69, '2023-05-29', '2023-05-29', 'borrow', 1);

--
-- Triggers `borrow`
--
DELIMITER $$
CREATE TRIGGER `set_default_dateReurn` BEFORE INSERT ON `borrow` FOR EACH ROW BEGIN
SET NEW.dateReturn = DATE_ADD(NEW.dateGet, INTERVAL 7 DAY);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_check_return` AFTER INSERT ON `borrow` FOR EACH ROW BEGIN
    DECLARE v_idUser INT;
    DECLARE v_idBook INT;
    
    SELECT idUser, idBook
    INTO v_idUser, v_idBook
    FROM borrow
    WHERE idB = NEW.idB;
    
    IF NEW.dateReturn < CURDATE() AND NEW.isReturn = '0' THEN
        INSERT INTO notifications (idUser, idBook, send, message)
        VALUES (v_idUser, v_idBook, '1', 'Return the book, the specified period has been exceeded');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_gp`
--

CREATE TABLE `borrow_gp` (
  `idBGP` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idGP` int(11) NOT NULL,
  `dateGet` date NOT NULL DEFAULT current_timestamp(),
  `dateReturn` date NOT NULL,
  `Action` varchar(50) NOT NULL,
  `isReturn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_gp`
--

INSERT INTO `borrow_gp` (`idBGP`, `idUser`, `idGP`, `dateGet`, `dateReturn`, `Action`, `isReturn`) VALUES
(2, 31, 1, '2023-05-05', '2023-05-05', 'reed', 1);

--
-- Triggers `borrow_gp`
--
DELIMITER $$
CREATE TRIGGER `set_default_dateReturn_gp` BEFORE INSERT ON `borrow_gp` FOR EACH ROW BEGIN
SET NEW.dateReturn = DATE_SUB(NEW.dateGet, INTERVAL 7 DAY);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `categorie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `categorie`) VALUES
(1, 'Computer Science'),
(2, 'Maths'),
(3, 'Physics'),
(4, 'Chemistry');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `idC` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`idC`, `idBook`, `idUser`, `comment`, `date`) VALUES
(2, 50, 32, 'nkjnnsdn c odsdsjjd dvjidjdvj vlkjdwvjkldf', '2023-05-03 21:15:35'),
(10, 50, 31, 'kesgkg nkklf,kh,kbf bkbkbfk  2020', '2023-05-04 11:43:14'),
(13, 89, 31, 'This Book is good for those interested in programming websites', '2023-05-13 12:52:34'),
(14, 69, 31, 'good book', '2023-05-18 22:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `comments_gp`
--

CREATE TABLE `comments_gp` (
  `idCGP` int(11) NOT NULL,
  `idGP` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments_gp`
--

INSERT INTO `comments_gp` (`idCGP`, `idGP`, `idUser`, `comment`, `date`) VALUES
(3, 1, 31, 'Well done', '2023-05-05 14:55:19'),
(4, 1, 32, 'I like it', '2023-05-13 13:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `graduation_project`
--

CREATE TABLE `graduation_project` (
  `idGP` int(11) NOT NULL,
  `coteG` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `year` year(4) NOT NULL,
  `level` varchar(50) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `idLanguage` int(11) NOT NULL,
  `resume` text NOT NULL,
  `nbrCopy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graduation_project`
--

INSERT INTO `graduation_project` (`idGP`, `coteG`, `title`, `year`, `level`, `idCategorie`, `qte`, `idLanguage`, `resume`, `nbrCopy`) VALUES
(1, 'INFO150', 'Library Management system', '2023', 'bachelors', 1, 2, 2, 'A library management system is software that is designed to manage all the functions of a library. It helps librarian to maintain the database of new books and the books that are borrowed by members along with their due dates.', 2),
(21, 'MA175', 'Existence globale, stabilité et explosion en temps fini des solutions de certaines équations d\'évolution non linéaires', '2021', 'master', 2, 3, 3, '', 0),
(22, 'MA119', 'Pollution de l\'air et problème semi infini', '2019', 'master', 2, 1, 3, '', 0),
(23, 'MA120', 'Etude d\'une équoition elliptique semi - linéaire', '2019', 'master', 2, 2, 3, '', 0),
(24, 'MA121', 'Analyse Microlocale des Opérateurs Pseudo-Différentiels ', '2019', 'master', 2, 3, 3, '', 0),
(25, 'MA122', 'Sur l\'existence de solutions et de solutions extrémales d\'équations diérentielles et intégrales fonctionnelles ', '2019', 'master', 2, 2, 3, '', 0),
(26, 'CH01', 'La copolymérisation de l\'alcool benzilyque avec l\'oxide de cyclohexène en présence de Maghnite', '2016', 'master', 4, 3, 3, '', 0),
(27, 'CH02', 'Synthèse et caractérisation des polymères hydrosolubles et biodégradables', '2016', 'master', 4, 3, 3, '', 0),
(28, 'CH03', 'Copolymérisation de pyrrole avec le 2-Nitrocinnamaldéhyde catalysée par la Maghnite', '2016', 'master', 4, 2, 3, '', 0),
(29, 'CH04', 'Etude des propriétés d\'extraits des principes actifs d\'écorces des racines de Berberis vulgaris', '2016', 'master', 4, 2, 3, '', 0),
(30, 'CH05', 'Etude in vitro de la cristallisation oxalo - calcique par l\'influence des extraits d\'une plante médicinale', '2016', 'master', 4, 2, 3, '', 0),
(31, 'PH01', 'Etude par la méthode ab- initio des propriétés élèctroniques et magnétique de Zn1-xMnxSiAs2 et ZnSi1-xMnxAs2 avec x= 0.125', '2014', 'master', 3, 2, 3, '', 0),
(32, 'PH02', 'l\'arrangement de spin de l\'état fondamental dans les composés magnétique', '2014', 'master', 3, 2, 3, '', 0),
(33, 'PH03', 'Densité de défauts dans les semi - conducteurs amorphes & microcristallin', '2014', 'bachelors', 3, 3, 3, '', 0),
(34, 'PH04', 'Densité de défauts dans les semi - conducteurs amorphes & microcristallin', '2014', 'master', 3, 2, 3, '', 0),
(35, 'PH05', 'Contribution à l\'étude théorique de la sructure hybride XGe2 (X=MnK, Cr)', '2014', 'master', 3, 3, 3, '', 0);

--
-- Triggers `graduation_project`
--
DELIMITER $$
CREATE TRIGGER `update_notifications_gp` AFTER UPDATE ON `graduation_project` FOR EACH ROW BEGIN
IF NEW.nbrCopy > 1 THEN
UPDATE notifications_gp SET send = 1 WHERE idGP = NEW.idGP;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `idLanguage` int(11) NOT NULL,
  `language` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`idLanguage`, `language`) VALUES
(1, 'Arabic'),
(2, 'English'),
(3, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `idN` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `send` tinyint(1) NOT NULL DEFAULT 0,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`idN`, `idUser`, `idBook`, `send`, `message`) VALUES
(5, 31, 40, 1, 'The Book Is Currently Available'),
(6, 31, 40, 1, 'Return the book, the specified period has been exceeded'),
(7, 31, 1, 1, 'lola'),
(8, 31, 40, 1, 'Return the book, the specified period has been exceeded');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_gp`
--

CREATE TABLE `notifications_gp` (
  `idNGP` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idGP` int(11) NOT NULL,
  `send` tinyint(1) NOT NULL DEFAULT 0,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `idPublisher` int(11) NOT NULL,
  `publisher` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`idPublisher`, `publisher`) VALUES
(1, 'MASSON'),
(2, 'ELLIPSES'),
(3, 'HERMES'),
(4, 'MATHSOFT'),
(5, 'MONTRÉAL'),
(6, 'دار المناهج للنشر والتوزيع'),
(7, 'PPUR'),
(8, 'SPRINGER'),
(9, 'VUIBERT'),
(10, 'CÉPADUÈS'),
(11, 'HERMANN'),
(12, 'EEPM'),
(13, 'DUNOD'),
(14, 'CALVAGE ET MOUNET'),
(15, 'JACQUES GABAY'),
(16, 'TEC ET DOC'),
(17, 'BRÉAL'),
(18, 'CASSINI'),
(19, 'BELIN'),
(20, 'EDP Sciences'),
(21, 'ENSTA'),
(22, 'SPARTACUS'),
(23, 'PRESSES INTERNATIONALES POLYTECHNIQUES'),
(24, 'OPU'),
(25, ' MES TOUT PREMIERS PAS'),
(26, 'HERMèS - LAVOISIER'),
(27, 'ENI'),
(28, 'INTEREDITIONS'),
(29, 'REYNALD GOULET'),
(30, 'PRESSES POLYTECHNIQUES ET UNIVERSITAIRES ROMANDES(PPUR)'),
(31, 'COURRIER DU LIVRE ; ILLUSTRATED éDITION'),
(32, 'LA VILLE BRULE'),
(33, 'NATHAN'),
(34, 'WILEY–BLACKWELL'),
(35, 'EYROLLES'),
(36, 'DE BOECK'),
(37, 'CONNAISSANCES ET SAVOIRS'),
(38, 'HERMES SCIENCE PUBLICATIONS '),
(39, 'DE BOECK SUP'),
(40, ' PRESSES POLYTECHNIQUE DE MONTRéAL '),
(42, 'FAYARD, COLLèGE DE FRANCE'),
(43, 'PUBLIBOOK'),
(44, 'ARCHéTYPE82'),
(45, 'FLASH'),
(46, 'VERNAZOBRES-GREGO'),
(47, 'EDITIONS UNIVERSITAIRES EUROPéENNES'),
(48, 'WILEY-AICHE');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `idR` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `dateRequest` date NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`idR`, `idUser`, `idBook`, `dateRequest`, `Action`) VALUES
(14, 32, 102, '2023-05-29', 'read');

--
-- Triggers `request`
--
DELIMITER $$
CREATE TRIGGER `update_Books` AFTER INSERT ON `request` FOR EACH ROW BEGIN 
IF NEW.dateRequest = DATE_SUB(NOW(), INTERVAL 1 DAY) THEN 
DELETE FROM request WHERE idR = NEW.idR;
UPDATE books SET nbrCopy = nbrCopy + 1 WHERE idBook = NEW.idBook;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `request_gp`
--

CREATE TABLE `request_gp` (
  `idRGP` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idGP` int(11) NOT NULL,
  `dateRequest` date NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `request_gp`
--
DELIMITER $$
CREATE TRIGGER `update_gp` AFTER INSERT ON `request_gp` FOR EACH ROW BEGIN
IF NEW.dateRequest = DATE_SUB(NOW(), INTERVAL 1 DAY) THEN
DELETE FROM request_gp WHERE idRGP = NEW.idRGP;
UPDATE graduation_project SET nbrCopy = nbrCopy + 1 WHERE idGP = NEW.idGP;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `idS` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`idS`, `idUser`, `idBook`) VALUES
(5, 31, 50);

-- --------------------------------------------------------

--
-- Table structure for table `saved_gp`
--

CREATE TABLE `saved_gp` (
  `idSGP` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idGP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `typebook`
--

CREATE TABLE `typebook` (
  `idType` int(11) NOT NULL,
  `typeBook` varchar(250) NOT NULL,
  `nbrTypeBook` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typebook`
--

INSERT INTO `typebook` (`idType`, `typeBook`, `nbrTypeBook`, `idCategorie`) VALUES
(1, 'Pure mathematics', 510, 2),
(2, 'General principles of mathematics', 511, 2),
(3, 'Algebra', 512, 2),
(4, 'Arithmetic', 513, 2),
(5, 'Topology', 514, 2),
(6, 'Analyse', 515, 2),
(7, 'Geometry', 516, 2),
(8, 'Numerical analysis', 518, 2),
(9, 'Applied mathematics, probability', 519, 2),
(10, 'The systems', 3, 1),
(11, 'Computer data processing', 4, 1),
(12, 'Data Organization, Computer Programming, Programs', 5, 1),
(13, 'Particular computing methods', 6, 1),
(14, 'Classical physics', 530, 3),
(15, 'Solid mechanics', 531, 3),
(16, 'Mechanics of fluids and liquids', 532, 3),
(17, 'Pneumatic', 533, 3),
(18, 'Physics of sound and related vibrations', 534, 3),
(19, 'Light, infrared and ultraviolet phenomena', 535, 3),
(20, 'Physics of heat', 536, 3),
(21, 'Physics of electricity and electromagnetism', 537, 3),
(22, 'Chemistry and related sciences', 540, 4),
(23, 'Thermodynamics', 541, 4),
(24, 'Experimental chemistry', 542, 4),
(25, 'Analytical Chemistry', 543, 4),
(26, 'Inorganic chemistry', 546, 4),
(27, 'Organic chemistry', 547, 4),
(28, 'Crystallography', 548, 4),
(29, 'Mineralogy', 549, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `passWord` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `PlaceOfBirth` varchar(250) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `adress` varchar(250) NOT NULL,
  `codeUser` int(11) NOT NULL,
  `specialty` varchar(250) NOT NULL,
  `level` varchar(250) NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT 0,
  `registeredAt` date NOT NULL DEFAULT current_timestamp(),
  `imageUser` text NOT NULL,
  `userType` varchar(25) NOT NULL,
  `code` mediumint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `passWord`, `email`, `firstName`, `lastName`, `dateOfBirth`, `PlaceOfBirth`, `phone`, `adress`, `codeUser`, `specialty`, `level`, `block`, `registeredAt`, `imageUser`, `userType`, `code`) VALUES
(1, 'admin', 'libraryunivmascara@gmail.com', 'admin', 'admin', '2012-10-09', 'mascara', '22222', 'Library, C47H+JCW, Av. Cheikh El Khaldi, Mascara 29000', 256662, 'algerien', '', 0, '2022-11-16', 'user.png', 'admin', 0),
(31, 'leila', 'leilakasmi150@gmail.com', 'Leila', 'Kasmi', '2002-09-06', 'Mascara', '1111', 'Mascara', 1, 'Computer Science', 'L3', 0, '2023-02-18', 'Leila - 2023.05.20 - 09.08.44pm.jpg', 'student', 513159),
(32, 'khadidja', 'khadidjabouaka@gmail.com', 'Khadidja ', 'Bouaka', '2002-01-01', 'Mascara', '22222', 'Mascara', 2, 'Computer Science', 'L3', 0, '2023-02-18', 'user.png', 'student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `writ`
--

CREATE TABLE `writ` (
  `idW` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `idAuthor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writ`
--

INSERT INTO `writ` (`idW`, `idBook`, `idAuthor`) VALUES
(26, 99, 100),
(27, 99, 147),
(28, 99, 148),
(29, 100, 101),
(30, 100, 149),
(31, 101, 102),
(32, 102, 103),
(33, 103, 104),
(34, 18, 18),
(35, 50, 18),
(36, 69, 18),
(37, 81, 73),
(38, 81, 83),
(39, 81, 150),
(40, 83, 85),
(41, 84, 86),
(42, 85, 87),
(43, 82, 84),
(44, 86, 88),
(45, 90, 92),
(46, 90, 151),
(47, 89, 91),
(48, 88, 90),
(49, 88, 152),
(50, 87, 153),
(51, 87, 154),
(52, 87, 89),
(53, 87, 155),
(54, 92, 94),
(55, 93, 95),
(56, 94, 96),
(57, 95, 97),
(58, 97, 98),
(59, 37, 36),
(60, 37, 157),
(61, 38, 37),
(62, 39, 38),
(63, 40, 39),
(64, 41, 40),
(65, 43, 134),
(66, 46, 44),
(67, 46, 158),
(68, 149, 43),
(69, 44, 42),
(70, 42, 41),
(71, 1, 1),
(72, 1, 0),
(73, 2, 2),
(74, 3, 80),
(75, 4, 4),
(76, 5, 5),
(77, 6, 6),
(78, 7, 7),
(79, 8, 8),
(80, 9, 9),
(81, 10, 10),
(82, 55, 114),
(83, 54, 51),
(84, 47, 45),
(85, 48, 46),
(86, 53, 50),
(87, 49, 186),
(88, 49, 159),
(89, 49, 47),
(90, 51, 48),
(91, 52, 49),
(92, 55, 52),
(93, 11, 11),
(94, 12, 12),
(95, 14, 14),
(96, 13, 13),
(97, 15, 15),
(98, 16, 16),
(99, 17, 17),
(100, 19, 19),
(101, 19, 160),
(102, 20, 19),
(103, 20, 160),
(104, 21, 20),
(105, 22, 21),
(106, 23, 22),
(107, 24, 23),
(108, 25, 24),
(109, 26, 25),
(110, 61, 56),
(111, 56, 50),
(112, 57, 53),
(113, 58, 54),
(114, 59, 55),
(115, 60, 54),
(116, 62, 57),
(117, 65, 60),
(118, 64, 59),
(119, 63, 58),
(120, 27, 26),
(121, 28, 27),
(122, 29, 28),
(123, 30, 29),
(124, 31, 30),
(125, 32, 31),
(126, 33, 32),
(127, 34, 33),
(128, 35, 34),
(129, 36, 35),
(130, 71, 69),
(131, 72, 70),
(132, 73, 71),
(133, 74, 72),
(134, 75, 73),
(135, 70, 68),
(136, 68, 67),
(137, 67, 66),
(138, 66, 66),
(139, 104, 105),
(140, 105, 106),
(141, 106, 107),
(142, 107, 108),
(143, 108, 75),
(144, 118, 161),
(145, 119, 120),
(146, 120, 121),
(147, 121, 122),
(148, 122, 123),
(149, 123, 124),
(150, 124, 125),
(151, 125, 21),
(152, 126, 162),
(153, 109, 110),
(154, 110, 7),
(155, 111, 112),
(156, 112, 113),
(157, 113, 114),
(158, 114, 115),
(159, 115, 116),
(160, 117, 118),
(161, 130, 164),
(162, 131, 133),
(163, 133, 132),
(164, 134, 133),
(165, 135, 74),
(166, 136, 76),
(167, 137, 77),
(168, 138, 135),
(169, 139, 166),
(170, 140, 109),
(171, 141, 136),
(172, 142, 137),
(173, 143, 33),
(174, 144, 128),
(175, 167, 167),
(176, 168, 168),
(177, 169, 169),
(178, 170, 170),
(179, 171, 171),
(180, 172, 172),
(181, 173, 173),
(182, 174, 174),
(183, 175, 175),
(184, 176, 176),
(185, 177, 177),
(186, 178, 178),
(187, 179, 75),
(188, 180, 179),
(189, 181, 114),
(190, 182, 180),
(191, 183, 181),
(192, 184, 65),
(193, 185, 182),
(194, 186, 183),
(195, 187, 184),
(196, 188, 185),
(197, 189, 186),
(198, 190, 185),
(199, 191, 187),
(200, 192, 188),
(201, 193, 40),
(202, 194, 189),
(203, 195, 190),
(204, 196, 191),
(215, 200, 5),
(216, 200, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`idAuthor`);

--
-- Indexes for table `authors_gp`
--
ALTER TABLE `authors_gp`
  ADD PRIMARY KEY (`idAGP`),
  ADD KEY `fk_authorGP` (`idGP`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`idBook`),
  ADD KEY `fk_books_language` (`idLanguage`),
  ADD KEY `fk_books_typeBook` (`idType`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`idB`),
  ADD KEY `fk_borrw_idUser` (`idUser`),
  ADD KEY `fk_borrw_idBook` (`idBook`);

--
-- Indexes for table `borrow_gp`
--
ALTER TABLE `borrow_gp`
  ADD PRIMARY KEY (`idBGP`),
  ADD KEY `fk_borrw_gp_idUser` (`idUser`),
  ADD KEY `fk_borrw_gp_idgp` (`idGP`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idC`),
  ADD KEY `fk_comment_idUser` (`idUser`),
  ADD KEY `fk_comment_idBook` (`idBook`);

--
-- Indexes for table `comments_gp`
--
ALTER TABLE `comments_gp`
  ADD PRIMARY KEY (`idCGP`),
  ADD KEY `fk_commentgp_idUser` (`idUser`),
  ADD KEY `fk_comment_gp_idBook` (`idGP`);

--
-- Indexes for table `graduation_project`
--
ALTER TABLE `graduation_project`
  ADD PRIMARY KEY (`idGP`),
  ADD UNIQUE KEY `uniqueCoteG` (`coteG`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`idLanguage`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`idN`),
  ADD KEY `fk_noti_idUser` (`idUser`),
  ADD KEY `fk_noti_idBook` (`idBook`);

--
-- Indexes for table `notifications_gp`
--
ALTER TABLE `notifications_gp`
  ADD PRIMARY KEY (`idNGP`),
  ADD KEY `fk_noti_gp_idUser` (`idUser`),
  ADD KEY `fk_noti_gp_idBook` (`idGP`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`idPublisher`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`idR`);

--
-- Indexes for table `request_gp`
--
ALTER TABLE `request_gp`
  ADD PRIMARY KEY (`idRGP`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`idS`),
  ADD KEY `fk_saved_idUser` (`idUser`),
  ADD KEY `fk_saved_idBook` (`idBook`);

--
-- Indexes for table `saved_gp`
--
ALTER TABLE `saved_gp`
  ADD PRIMARY KEY (`idSGP`),
  ADD KEY `fk_saved_gp_idUser` (`idUser`),
  ADD KEY `fk_saved_gp_idBook` (`idGP`);

--
-- Indexes for table `typebook`
--
ALTER TABLE `typebook`
  ADD PRIMARY KEY (`idType`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `codeUserUnique` (`codeUser`);

--
-- Indexes for table `writ`
--
ALTER TABLE `writ`
  ADD PRIMARY KEY (`idW`),
  ADD KEY `fk_writ_idBook` (`idBook`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `authors_gp`
--
ALTER TABLE `authors_gp`
  MODIFY `idAGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `idB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `borrow_gp`
--
ALTER TABLE `borrow_gp`
  MODIFY `idBGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments_gp`
--
ALTER TABLE `comments_gp`
  MODIFY `idCGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `graduation_project`
--
ALTER TABLE `graduation_project`
  MODIFY `idGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `idLanguage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `idN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications_gp`
--
ALTER TABLE `notifications_gp`
  MODIFY `idNGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `idPublisher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `request_gp`
--
ALTER TABLE `request_gp`
  MODIFY `idRGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `saved_gp`
--
ALTER TABLE `saved_gp`
  MODIFY `idSGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `typebook`
--
ALTER TABLE `typebook`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `writ`
--
ALTER TABLE `writ`
  MODIFY `idW` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors_gp`
--
ALTER TABLE `authors_gp`
  ADD CONSTRAINT `fk_authorGP` FOREIGN KEY (`idGP`) REFERENCES `graduation_project` (`idGP`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_typeBook` FOREIGN KEY (`idType`) REFERENCES `typebook` (`idType`) ON DELETE CASCADE;

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `fk_borrw_idBook` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_borrw_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `borrow_gp`
--
ALTER TABLE `borrow_gp`
  ADD CONSTRAINT `fk_borrw_gp_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_borrw_gp_idgp` FOREIGN KEY (`idGP`) REFERENCES `graduation_project` (`idGP`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_idBook` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `comments_gp`
--
ALTER TABLE `comments_gp`
  ADD CONSTRAINT `fk_comment_gp_idBook` FOREIGN KEY (`idGP`) REFERENCES `graduation_project` (`idGP`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_commentgp_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_noti_idBook` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_noti_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `notifications_gp`
--
ALTER TABLE `notifications_gp`
  ADD CONSTRAINT `fk_noti_gp_idBook` FOREIGN KEY (`idGP`) REFERENCES `graduation_project` (`idGP`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_noti_gp_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `saved`
--
ALTER TABLE `saved`
  ADD CONSTRAINT `fk_saved_idBook` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_saved_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `saved_gp`
--
ALTER TABLE `saved_gp`
  ADD CONSTRAINT `fk_saved_gp_idBook` FOREIGN KEY (`idGP`) REFERENCES `graduation_project` (`idGP`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_saved_gp_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `writ`
--
ALTER TABLE `writ`
  ADD CONSTRAINT `fk_writ_idBook` FOREIGN KEY (`idBook`) REFERENCES `books` (`idBook`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `check_borrow_event` ON SCHEDULE EVERY 1 DAY STARTS '2023-05-21 22:42:13' ON COMPLETION NOT PRESERVE ENABLE DO CALL check_borrow_due_date()$$

CREATE DEFINER=`root`@`localhost` EVENT `check_borrow_gp_event` ON SCHEDULE EVERY 1 DAY STARTS '2023-05-21 22:50:22' ON COMPLETION NOT PRESERVE ENABLE DO CALL check_borrow_gp_due_date()$$

CREATE DEFINER=`root`@`localhost` EVENT `process_expired_requests_event` ON SCHEDULE EVERY 1 DAY STARTS '2023-05-21 23:01:16' ON COMPLETION NOT PRESERVE ENABLE DO CALL process_expired_requests()$$

CREATE DEFINER=`root`@`localhost` EVENT `process_expired_requests_gp_event` ON SCHEDULE EVERY 1 DAY STARTS '2023-05-21 23:05:12' ON COMPLETION NOT PRESERVE ENABLE DO CALL process_expired_requests_gp()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
