-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `alokasi_kelas`;
CREATE TABLE `alokasi_kelas` (
  `id_alokasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` varchar(255) NOT NULL,
  `id_murid` varchar(255) NOT NULL,
  `id_guru` varchar(255) NOT NULL,
  `id_mata_pelajaran` varchar(255) NOT NULL,
  `nilai_tugas` int(11) NOT NULL DEFAULT 0,
  `nilai_uts` int(11) NOT NULL DEFAULT 0,
  `nilai_uas` int(11) NOT NULL DEFAULT 0,
  `nilai_akhir` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_alokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id_guru` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `guru` (`id_guru`, `name`, `id_user`) VALUES
('G0001',	'Kaitlyn Vega',	2),
('G0002',	'Khadeejah Escobar',	3),
('G0003',	'Shivani Davison',	5),
('G0004',	'Aronas Wickens',	7),
('G0005',	'Evie-May Figueroa',	10),
('G0006',	'Cieran Terrell',	18),
('G0007',	'Iga Terry',	20),
('G0008',	'Leonardo Huffman',	21),
('G0009',	'Karishma Avalos',	22),
('G0010',	'Felicity Boyce',	24),
('G0011',	'Jermaine Atkinson',	25),
('G0012',	'Mitchell Hicks',	29),
('G0013',	'Dionne Kenny',	30),
('G0014',	'Alvin Campos',	32),
('G0015',	'Emer Corrigan',	33),
('G0016',	'Duke Pate',	36),
('G0017',	'Lia Hobbs',	38),
('G0018',	'Gurveer Shields',	40),
('G0019',	'Zunairah Hassan',	42),
('G0020',	'Russell Wade',	44),
('G0021',	'Keziah Little',	51),
('G0022',	'Annabella Dean',	52),
('G0023',	'Taya Barlow',	54),
('G0024',	'Greta Gregory',	55),
('G0025',	'Reema Kelly',	56),
('G0026',	'Patrycja Rollins',	61),
('G0027',	'Iqra Kline',	62),
('G0028',	'Aronas Dudley',	63),
('G0029',	'Sumayyah Lambert',	67),
('G0030',	'Prince Cole',	68),
('G0031',	'Nancy Savage',	69),
('G0032',	'Archer Gibbons',	70),
('G0033',	'Ellie-Louise Enriquez',	72),
('G0034',	'Nyla Corbett',	74),
('G0035',	'Opal Squires',	77),
('G0036',	'Mariyam Hester',	79),
('G0037',	'Alejandro Poole',	80),
('G0038',	'Michelle Gardiner',	82),
('G0039',	'Sienna Whitfield',	84),
('G0040',	'Evan Bull',	86),
('G0041',	'Lili Cameron',	87),
('G0042',	'Adyan Conley',	88),
('G0043',	'Gianluca Carrillo',	96),
('G0044',	'Tiffany Swift',	97);

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id_kelas` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `kelas` (`id_kelas`, `name`) VALUES
('K0001',	'A'),
('K0002',	'B'),
('K0003',	'C'),
('K0004',	'D'),
('K0005',	'E'),
('K0006',	'F'),
('K0007',	'G'),
('K0008',	'H'),
('K0009',	'I');

DROP TABLE IF EXISTS `mata_pelajaran`;
CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mata_pelajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `name`, `description`) VALUES
('MP0001',	'Matematika',	'Mata Pelajaran Matematika Kelas 10'),
('MP0002',	'Bahasa Indonesia',	'Mata Pelajaran Bahasa Indonesia Kelas 10'),
('MP0003',	'Bahasa Inggris',	'Mata pelajaran Bahasa Inggris Kelas 10'),
('MP0004',	'Fisika',	'Mata pelajaran Fisika Kelas 10'),
('MP0005',	'Kimia',	'Mata pelajaran Kimia Kelas 10'),
('MP0006',	'Biologi',	'Mata pelajaran Biologi Kelas 10'),
('MP0007',	'Sejarah',	'Mata pelajaran Sejarah Kelas 10'),
('MP0008',	'Pendidikan Agama Islam dan Budi Pekerti',	'Mata Pelajaran PAI Kelas 10'),
('MP0009',	'Ekonomi',	'Mata Pelajaran Ekonomi Kelas 10'),
('MP0010',	'Geografi',	'Mata Pelajaran Ekonomi Kelas 10'),
('MP0011',	'Bahasa Indonesia',	'Bahasa Indonesia Kelas 1'),
('MP0012',	'Pendidikan Jasmani Olahraga, dan Kesehatan',	''),
('MP0013',	'Prakarya',	'Prakarya Kelas 10'),
('MP0014',	'Teknologi Informasi dan Komunikasi',	'Mata Pelajaran TIK MA'),
('MP0015',	'Sosiologi',	'Sosiologi Kelas 10'),
('MP0016',	'Fisika',	'SMA'),
('MP0017',	'Kimia',	'SMA'),
('MP0018',	'Bahasa Jerman',	'-');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1,	'2020-05-10-231723',	'App\\Database\\Migrations\\CreateRoleTable',	'default',	'App',	1590862667,	1),
(2,	'2020-05-10-231730',	'App\\Database\\Migrations\\CreateUserTable',	'default',	'App',	1590862667,	1),
(3,	'2020-05-10-232138',	'App\\Database\\Migrations\\CreateKelasTable',	'default',	'App',	1590862667,	1),
(4,	'2020-05-10-234746',	'App\\Database\\Migrations\\CreateGuruTable',	'default',	'App',	1590862667,	1),
(5,	'2020-05-11-003214',	'App\\Database\\Migrations\\CreateMataPelajaranTable',	'default',	'App',	1590862667,	1),
(6,	'2020-05-11-003215',	'App\\Database\\Migrations\\CreateMuridTable',	'default',	'App',	1590862667,	1),
(7,	'2020-05-11-003216',	'App\\Database\\Migrations\\CreateAlokasiKelasTable',	'default',	'App',	1590862667,	1),
(8,	'2020-05-17-160846',	'App\\Database\\Migrations\\CreateNotificationTable',	'default',	'App',	1590862667,	1);

DROP TABLE IF EXISTS `murid`;
CREATE TABLE `murid` (
  `id_murid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_murid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `murid` (`id_murid`, `name`, `id_user`) VALUES
('M0001',	'Lidia Mcdonald',	4),
('M0002',	'Rumaisa Farrell',	6),
('M0003',	'Habib Bains',	8),
('M0004',	'Tayla Wade',	9),
('M0005',	'Maximillian Carlson',	11),
('M0006',	'Lilah Hebert',	12),
('M0007',	'Tamia York',	13),
('M0008',	'Charlton Hatfield',	14),
('M0009',	'Aled Rangel',	15),
('M0010',	'Mia Gomez',	16),
('M0011',	'Leticia Naylor',	17),
('M0012',	'Sierra Fowler',	19),
('M0013',	'Cecelia Davila',	23),
('M0014',	'Bronwyn Mackay',	26),
('M0015',	'Albi Hamilton',	27),
('M0016',	'Sumaya Thomas',	28),
('M0017',	'Brayden Buck',	31),
('M0018',	'Amelia-Mae Farrell',	34),
('M0019',	'Syeda Michael',	35),
('M0020',	'Lauryn Robles',	37),
('M0021',	'Khushi Downs',	39),
('M0022',	'Arslan Sparrow',	41),
('M0023',	'Savanna Holman',	43),
('M0024',	'Rabia Chamberlain',	45),
('M0025',	'Piers Portillo',	46),
('M0026',	'Anaya Wooten',	47),
('M0027',	'Shyam Mcdaniel',	48),
('M0028',	'Samara Wilde',	49),
('M0029',	'Dylan Carr',	50),
('M0030',	'Nazim Russell',	53),
('M0031',	'Usamah Mansell',	57),
('M0032',	'Bartosz Vickers',	58),
('M0033',	'Zidan Prentice',	59),
('M0034',	'Faizan Torres',	60),
('M0035',	'Nawal Mayer',	64),
('M0036',	'Nadia Christian',	65),
('M0037',	'Abbi Mohammed',	66),
('M0038',	'Iestyn Forster',	71),
('M0039',	'Alexa Bush',	73),
('M0040',	'Kory Luna',	75),
('M0041',	'Lyndon Anderson',	76),
('M0042',	'Finley Timms',	78),
('M0043',	'Allan Mcintosh',	81),
('M0044',	'Hakeem Blanchard',	83),
('M0045',	'Aahil Conner',	85),
('M0046',	'Jerry Norton',	89),
('M0047',	'Aiden Cummings',	90),
('M0048',	'Britney Higgs',	91),
('M0049',	'Taliah Kendall',	92),
('M0050',	'Derren Redman',	93),
('M0051',	'Atticus Carver',	94),
('M0052',	'Habiba Hirst',	95),
('M0053',	'Alexie Maynard',	98),
('M0054',	'Chelsey Zuniga',	99),
('M0055',	'Jenna Kavanagh',	100);

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `from_id_user` int(11) NOT NULL,
  `to_id_user` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `read` varchar(10) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id_notification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `role` (`id_role`, `name`, `description`) VALUES
('R0001',	'admin',	''),
('R0002',	'guru',	''),
('R0003',	'murid',	'');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `id_role` varchar(255) NOT NULL,
  `link_foto` varchar(255) NOT NULL DEFAULT 'http://bawang.epizy.com/assets/poster/default.png',
  `izin_edit` varchar(10) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id_user`),
  KEY `user_id_role_foreign` (`id_role`),
  CONSTRAINT `user_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id_user`, `email`, `password`, `name`, `birthdate`, `id_role`, `link_foto`, `izin_edit`) VALUES
(1,	'administrator@email.com',	'4194d1706ed1f408d5e02d672777019f4d5385c766a8c6ca8acba3167d36a7b9',	'Administrator',	'1968-11-28',	'R0001',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(2,	'kaitlyn@email.com',	'42a296fc88751910a7ac778096d1af842a38ca770509d1c47a89640404c54161',	'Kaitlyn Vega',	'1970-05-24',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(3,	'khadeejah@email.com',	'c82c46c756f8e264e1dd4a7f93c28798c3b4b119e6fe575c14629d4743d3f653',	'Khadeejah Escobar',	'1971-02-25',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(4,	'lidia@email.com',	'1552db05a75559105170dbecadb2613ca84776f7866d9436bd97ea1a80398667',	'Lidia Mcdonald',	'1972-09-18',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(5,	'shivani@email.com',	'4a725f6941094d5335fba91bfaf4a3bc161cc87df1f354c4c604e5a55cb2fbf4',	'Shivani Davison',	'1974-01-30',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(6,	'rumaisa@email.com',	'e1ed40b137b047a72946c19419d46ce769b2b6a36b55f2c740368f719553f519',	'Rumaisa Farrell',	'1975-04-22',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(7,	'aronas@email.com',	'c2719be0f8940042d36119607337cfd0e2f404733e7e562842a1aa51a055b942',	'Aronas Wickens',	'1975-12-10',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(8,	'habib@email.com',	'ad2fb6ad47733524d828935a7f3654c3b76b49626812110cb8caeeee6eea1d68',	'Habib Bains',	'1978-11-27',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(9,	'tayla@email.com',	'e0ce8a063409269462279123e68a3f53499713b74467c9ae185cc78bfd717661',	'Tayla Wade',	'1979-06-15',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(10,	'evie-may@email.com',	'7574467d8f20c4ae1753e5f5a6dfb5dcf49e60b059017e4403241cbe8e3f5b14',	'Evie-May Figueroa',	'1982-03-24',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(11,	'maximillian@email.com',	'a19baf9420ba75d1271d2ed283c03beea4fecbdfdfaddcb1b00ef7fb4b05f158',	'Maximillian Carlson',	'1982-10-20',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(12,	'lilah@email.com',	'9c6cb1e069641a3992b388c1121e8018a7a0e595da30eb6d6b3890bb309b543e',	'Lilah Hebert',	'1983-12-22',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(13,	'tamia@email.com',	'9645a48cca866c198464ebe6c21e73ed45347f5ed694f7667730947c6f839555',	'Tamia York',	'1984-11-06',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(14,	'charlton@email.com',	'e6608c0847924a1661e1fc721525d4d1b10b1e66e1b0ac3699a30722c624c1d9',	'Charlton Hatfield',	'1985-07-05',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(15,	'aled@email.com',	'e4a39972964499612d8a6d8da031dd74482f5bc2dfe82fd19f6e65b9b7771c77',	'Aled Rangel',	'1986-01-23',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(16,	'mia@email.com',	'a6ae07ad556c5f9348cc09c16ed17a437e65acc71e689c1b19f872f1dab3c9c1',	'Mia Gomez',	'1986-06-07',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(17,	'leticia@email.com',	'110591733245175eeaa72ea403048e6d897758261816730cd5373ce46143d714',	'Leticia Naylor',	'1986-12-21',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(18,	'cieran@email.com',	'901f96a6fb33963bbac482ce60ff6df91cefc25b762add9905087e5571cdce08',	'Cieran Terrell',	'1990-11-20',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(19,	'sierra@email.com',	'dca6ec9510fc0176c600bb5d75a919fba07877c74eb1a41b0530b330c5767648',	'Sierra Fowler',	'1991-10-19',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(20,	'iga@email.com',	'70af91c29db4ce0a5eb2d269b935f0055847e55f218816b0e4be8dbde1fa6c60',	'Iga Terry',	'1993-08-27',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(21,	'leonardo@email.com',	'18ccba186d8757c20cbf05d7a98b2c64f9f16eb64ea4a64659bbc5c9b7b3a7fe',	'Leonardo Huffman',	'1996-03-19',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(22,	'karishma@email.com',	'a3448fdb27dd568dedb608cd89e49db19e04ff30cf4f064e1b8b67372e502edb',	'Karishma Avalos',	'1998-03-11',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(23,	'cecelia@email.com',	'20fd1b781bb27ce6c98ae590f1d48b720c0426dce7d82a504d728f4b21c6e2ad',	'Cecelia Davila',	'1999-03-27',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(24,	'felicity@email.com',	'697d4a13b3e912facf3af081cc90ee47015f4bfc373ad8c64e21ac3ef7a3861f',	'Felicity Boyce',	'2002-04-13',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(25,	'jermaine@email.com',	'ad6322ed9b6d1d3276e3f63761e63f51f8a00ef090eccb5b1d78d61ed61841ac',	'Jermaine Atkinson',	'2004-08-20',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(26,	'bronwyn@email.com',	'd62473dbb2267aa78e1e38a1a13eec13927b936e6b9c254e28efd5013e68dba7',	'Bronwyn Mackay',	'1966-12-18',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(27,	'albi@email.com',	'51a83e1202c3e5aa7fc05537ca4311096746d53a2d50884bd3f5e0548f463b3f',	'Albi Hamilton',	'1968-09-25',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(28,	'sumaya@email.com',	'2e44e08484ab33f1a1ae6c5b975fdc1e2884fddf1715c4ba051db952857b20c6',	'Sumaya Thomas',	'1970-10-05',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(29,	'mitchell@email.com',	'8529ab6899015263573df683e57a9de269d60d38f9a5493152e1f53e8c5c2730',	'Mitchell Hicks',	'1971-04-07',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(30,	'dionne@email.com',	'6dbd3dc562ede75d1183f3f74a17c6faf35d6e7adb9dd0cb6139db5cb98597fc',	'Dionne Kenny',	'1971-07-13',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(31,	'brayden@email.com',	'4853d09094b717284a6d30a23ac37a819d89c3b2af011f21ed60ebea473e034f',	'Brayden Buck',	'1972-06-12',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(32,	'alvin@email.com',	'23eb127b3caf920d3dd72f834b35b73e5b8bda870b0d7147838d182b5a9dd789',	'Alvin Campos',	'1974-04-12',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(33,	'emer@email.com',	'f30aa4973e918ccb95242a384901669889b40a274744cb071ceeae275bd89da9',	'Emer Corrigan',	'1975-04-17',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(34,	'amelia-mae@email.com',	'f113c0499cf56e207bea30137305483d6186da240afee684c24867088810bf73',	'Amelia-Mae Farrell',	'1976-10-31',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(35,	'syeda@email.com',	'42c428d2ed23461c9e0a60d1ef2ca9cd9ecfb71b9e0d48a8ce43f2ff9c40b8bc',	'Syeda Michael',	'1977-02-13',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(36,	'duke@email.com',	'f6804460f509a765b8ad07dca8c787ec984109088953153b8540cc1bb8a1c432',	'Duke Pate',	'1978-05-04',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(37,	'lauryn@email.com',	'06042d7d705b279b9e4c638d0c72dfd8a9c4e13a59fce1d80fb1e712db3238c4',	'Lauryn Robles',	'1978-10-05',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(38,	'lia@email.com',	'bc86396b649631aa7b528ab04875a55886db5fb81b83168eea2c7dce277ed5c9',	'Lia Hobbs',	'1983-10-02',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(39,	'khushi@email.com',	'b6ed35e82cc571aa70dde3d57da6c7ed4cdd122be520c32c56c76fdb5566715d',	'Khushi Downs',	'1986-02-23',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(40,	'gurveer@email.com',	'c14a509caea160f91b1ea9b3d05e30cea3b502faaf3b0749fbf8537bb0225255',	'Gurveer Shields',	'1989-11-16',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(41,	'arslan@email.com',	'0be7018dbc14560c39dff0e1a4b74eb095403cdbde11d4206c0952da51792f64',	'Arslan Sparrow',	'1990-07-01',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(42,	'zunairah@email.com',	'ab2fd70161ec6b599fd7fb0225d5522ce9d8cfcb667f996e16e109e6c5322937',	'Zunairah Hassan',	'1994-10-30',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(43,	'savanna@email.com',	'062d5d619f2aebe204c136a6898de0ab08205cc32178bd2de2ed93cc89ede399',	'Savanna Holman',	'1995-04-30',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(44,	'russell@email.com',	'ec87d0e0735ce8d20ddf792630a066ab99a7e3370281adc2eba9c3192033ff7f',	'Russell Wade',	'1996-08-20',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(45,	'rabia@email.com',	'9c5478f7bb7bbeddf8703a970ec2db3941e74014a589fbe8076cac6158cbe27c',	'Rabia Chamberlain',	'1998-04-29',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(46,	'piers@email.com',	'073686035c76c8e19fa15f2245c37fc8a1483be14af027c4c457aa87fe21bd45',	'Piers Portillo',	'1999-10-15',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(47,	'anaya@email.com',	'2f40bdcc0b20c5e38771b2f918f64764c0c0ec6a8c0713463bd188486143e720',	'Anaya Wooten',	'2000-03-13',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(48,	'shyam@email.com',	'5648c5cdca917f5ad7fdd4cc82847e24e893e6ed7adb8f43e3ac0839e066ddf6',	'Shyam Mcdaniel',	'2005-09-30',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(49,	'samara@email.com',	'9ef100006f200f87ab417abbd87c2eeee16e6f1e491c2337c082411a2cadad6d',	'Samara Wilde',	'2006-04-04',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(50,	'dylan@email.com',	'c0e7aec81a1a194e9f54f6b297f6544041188c741ae8f55c2133b5c510a7dc1d',	'Dylan Carr',	'2006-08-21',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(51,	'keziah@email.com',	'f8027ed1de1765c97f8d826b113aa59ebf5b2871090f47feb695bbe95ecb45eb',	'Keziah Little',	'1969-01-30',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(52,	'annabella@email.com',	'f3266c6e94f8245e0a54ae718ddb4c4cca16a6fee61d465caa7e492ebe520094',	'Annabella Dean',	'1971-03-08',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(53,	'nazim@email.com',	'ed4a61cbe605be372226b6f7c4bfb6694823ad569293ab93dd3418724053eea0',	'Nazim Russell',	'1973-09-24',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(54,	'taya@email.com',	'6c42a85075d8a891b8cdd235cce5d0f49c58d3d94bb2106e3bff1fa98beee108',	'Taya Barlow',	'1973-10-26',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(55,	'greta@email.com',	'ebd0beb593e575046d45b519d9f03b4fe57c28001415a151c49a0a5e18dd5963',	'Greta Gregory',	'1974-04-25',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(56,	'reema@email.com',	'c60dc023765d31f4af77df90adcb4f8dc4f9eef9b1e9e236c6496fb34c7ec0b9',	'Reema Kelly',	'1975-03-13',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(57,	'usamah@email.com',	'8fb957675a083d29fc450e626ccafb6db6ec87f886a729e929ab1ba6cd6e7a0d',	'Usamah Mansell',	'1975-11-17',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(58,	'bartosz@email.com',	'cb1bb7da519c3d57e7ac473584f667a16d9e24faf148747cf0362183c8edc1ec',	'Bartosz Vickers',	'1979-04-19',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(59,	'zidan@email.com',	'231b4afd6bd1659e066d99f24b741d68025270cdb111a5258c2ef85c46c6c25f',	'Zidan Prentice',	'1981-11-24',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(60,	'faizan@email.com',	'a084a7e06dee42b19858e7407800275db2465f301922e49b6e462d5b514a1193',	'Faizan Torres',	'1982-10-14',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(61,	'patrycja@email.com',	'6bc6e9014e6f8f6da8e0f99a7fd50902b8819d8e01abeddd2756f4bc1a28e7a2',	'Patrycja Rollins',	'1983-06-16',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(62,	'iqra@email.com',	'ab75f0bd783308c9d24096973cb4f56ed139be6b1a4b9a7885beeac2a2c1bba4',	'Iqra Kline',	'1986-06-14',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(63,	'aronas@email.com',	'c2719be0f8940042d36119607337cfd0e2f404733e7e562842a1aa51a055b942',	'Aronas Dudley',	'1988-06-07',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(64,	'nawal@email.com',	'0e9d61bb82684076b3226eeca5207fcf6c31b0307a3794eff480e036af475433',	'Nawal Mayer',	'1988-08-01',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(65,	'nadia@email.com',	'dbaf86dd80e3bcd5fe4bdb15daa4bc47b66e00bddc2c8e5fa988a183d1ce1899',	'Nadia Christian',	'1991-05-29',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(66,	'abbi@email.com',	'a9c0e4f001df52af66d0979a71404b2a8792beb9f27215582814f4c1856a2155',	'Abbi Mohammed',	'1991-08-18',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(67,	'sumayyah@email.com',	'4ca62569c4df88ec722e9fc6cdfb9f9df1136356b25eab12611dd980d13756ea',	'Sumayyah Lambert',	'1992-06-09',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(68,	'prince@email.com',	'9bd2ef7a9ddbb22386f27f5f6885f8eeef6cdf57e96bbdef0f9e0421f1ec4654',	'Prince Cole',	'1994-05-30',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(69,	'nancy@email.com',	'1d78b370ad96e7a8091888d902360187bdea87ab6a4af003ec63c791894513ec',	'Nancy Savage',	'1995-03-07',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(70,	'archer@email.com',	'e226306f3f87b8f3f73a51521b0c74d7fb5837c4f1f790f99c0a239c9fe5250e',	'Archer Gibbons',	'1995-11-15',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(71,	'iestyn@email.com',	'3d09e4096e013e6a20478b8b22b3ef43fc716539e47ee359a74a4162666c86ae',	'Iestyn Forster',	'2000-04-26',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(72,	'ellie-louise@email.com',	'2ecf1dd6ab9931f08e7f714b436f8414ef07778e36d05a831e28309d9a97e7b8',	'Ellie-Louise Enriquez',	'2001-09-15',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(73,	'alexa@email.com',	'7764735c5d4d88ae3ef1c0d6c0a5769e4187c341895db19a82ba7d4e17b8c914',	'Alexa Bush',	'2003-08-19',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(74,	'nyla@email.com',	'2f9f827fb3124d1acd6ce58f571a7802c103493e0796800172e30fc080475e68',	'Nyla Corbett',	'2004-04-23',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(75,	'kory@email.com',	'81fb3daa5664581768b0f7f2115c5d59c4c902f1398d36a11723876173f0d682',	'Kory Luna',	'2008-06-29',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(76,	'lyndon@email.com',	'2978804e8e863540aee3f8fca65279b9b6dd2cb92bc488fa863e02dd77664f6b',	'Lyndon Anderson',	'1966-10-05',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(77,	'opal@email.com',	'bd3de56071621915839d1d455a12d7b6c8b625617587848e0b4787d316bdabbc',	'Opal Squires',	'1969-11-06',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(78,	'finley@email.com',	'a2f61b827f0d879aa587b71c98df9d19ecc512029a3b28e3381736c8e2114d48',	'Finley Timms',	'1969-11-08',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(79,	'mariyam@email.com',	'fe69f5b98eb46569fc4461db606056c09beb964de2afad60ffdddce08975b2bc',	'Mariyam Hester',	'1972-08-29',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(80,	'alejandro@email.com',	'a9010fd21a93c687b3c4c506313993b5a2ade87b719d09792b120a27b852f749',	'Alejandro Poole',	'1980-01-21',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(81,	'allan@email.com',	'5fd726bc56c3e86906cba8814a9b97d97f2ab209c48d2441ca5ac9e52b09e630',	'Allan Mcintosh',	'1985-03-11',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(82,	'michelle@email.com',	'01621148306fc8fb7c2b95eeb5c37e375f90db53cf8313ea87c9c34c05b7e0e5',	'Michelle Gardiner',	'1985-05-06',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(83,	'hakeem@email.com',	'f9ecf2b3968cf8210ca444272ca0b42e9f32ad34330d765fec6ad2727fc51aa5',	'Hakeem Blanchard',	'1985-05-25',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(84,	'sienna@email.com',	'f651106d90008d408b43c15c526ecf28061dbb08fd47397c8e7f3fb527df99be',	'Sienna Whitfield',	'1986-10-26',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(85,	'aahil@email.com',	'6cfbb4508c3d61eacb662a67e4ae751a0ef62478f9e23cf1e698777e84094805',	'Aahil Conner',	'1986-11-12',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(86,	'evan@email.com',	'ae74f72d212fb9871302a2459aeaf7b20bc2f792e4852be648a7d4e63967d9b1',	'Evan Bull',	'1987-04-21',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(87,	'lili@email.com',	'6c1ccd1f20742182387027bb4b72c4bfe4ca7e9247af5e7c0f1f8ce0f236724e',	'Lili Cameron',	'1989-10-14',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(88,	'adyan@email.com',	'8dc88026cb97a31beb8b767fd9dae4f475e201b4cb54b169b46ae390657edb1b',	'Adyan Conley',	'1990-02-25',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(89,	'jerry@email.com',	'3a5a2512949399115565867a73a413ec6ba215c8f2df385f78b33238a6639b7c',	'Jerry Norton',	'1990-04-14',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(90,	'aiden@email.com',	'3bf8fd1a8fc44d4a4d583aec4d69e1a21bf6818310d11ea5d105b107f1ad2669',	'Aiden Cummings',	'1992-02-10',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(91,	'britney@email.com',	'1f006e3414a8153fead977395cfab2e825d4f9541fb669c74e7088aa5dcad66e',	'Britney Higgs',	'1992-06-13',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(92,	'taliah@email.com',	'bc927bc50c1c60e8fb3c1b3a1e584a88d90047c5dc52268912d59e57d2c7ba3f',	'Taliah Kendall',	'1993-04-07',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(93,	'derren@email.com',	'edcf518d3718d5701487723ef721495f6131fddc8ed855af7ef67d5ad712840b',	'Derren Redman',	'1995-08-11',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(94,	'atticus@email.com',	'd83fae7c205203cf00f0f9c4eaaaa511d70eaf19114b012346b5c0d2ee6dab32',	'Atticus Carver',	'1996-11-26',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(95,	'habiba@email.com',	'7bab025eaba1d0dc3292527001408fa1327749b766bcb5620620b37d0740ad88',	'Habiba Hirst',	'2003-09-08',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(96,	'gianluca@email.com',	'ec27c5dcb1aba241730da0ab0e695920ac927de0399226d226b82b0e8b01103f',	'Gianluca Carrillo',	'2006-11-20',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(97,	'tiffany@email.com',	'834d79caa6e0efb1f91df5d913653bc82decc238c6781b61213c848d320afab6',	'Tiffany Swift',	'2007-01-13',	'R0002',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(98,	'alexie@email.com',	'01a1b3671dcf95055f682d4421c0b2ebd73960303ab791a3671822c761a1f8c0',	'Alexie Maynard',	'2007-05-14',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(99,	'chelsey@email.com',	'3e5c93878447290c0dcff64f25d92706494895fa6b1637e511df640b81032922',	'Chelsey Zuniga',	'2007-10-04',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false'),
(100,	'jenna@email.com',	'6e7e2ef0fbf160847f3a3f905528807e0dd6261d8020ce9ed58609b60e43aa7c',	'Jenna Kavanagh',	'2008-05-28',	'R0003',	'http://bawang.epizy.com/assets/poster/default.png',	'false');

-- 2020-06-01 00:24:24
