-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 05:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryType` varchar(50) NOT NULL,
  `subCategory` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryType`, `subCategory`) VALUES
(1, 'Automotive', NULL),
(2, 'Wanted', NULL),
(3, 'Electronics', NULL),
(4, 'Clothing', NULL),
(5, 'Home', NULL),
(6, 'Pets', NULL),
(7, 'Fitness', NULL),
(8, 'Seasonal', NULL),
(10, 'Services', NULL),
(11, 'Shoes', NULL),
(12, 'Sports', NULL),
(13, 'Furniture', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `latitude` decimal(6,4) NOT NULL,
  `longitude` decimal(7,4) NOT NULL,
  `is_provincial_capital` tinyint(1) NOT NULL,
  `population` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `province_id`, `latitude`, `longitude`, `is_provincial_capital`, `population`) VALUES
(1, 'Selkirk', 1, '50.1500', '-96.8833', 0, 9986),
(2, 'Berens River', 1, '52.3666', '-97.0333', 0, 892),
(3, 'Shamattawa', 1, '55.8504', '-92.0833', 0, 870),
(4, 'Steinbach', 1, '49.5171', '-96.6833', 0, 9729),
(5, 'Dauphin', 1, '51.1500', '-100.0500', 0, 9077),
(6, 'Island Lake', 1, '53.9666', '-94.7666', 0, 10),
(7, 'Gillam', 1, '56.3500', '-94.7000', 0, 1281),
(8, 'Norway House', 1, '53.9666', '-97.8333', 0, 6000),
(9, 'Flin Flon', 1, '54.7666', '-101.8833', 0, 6393),
(10, 'Nelson House', 1, '55.8005', '-98.8500', 0, 2500),
(11, 'Brochet', 1, '57.8832', '-101.6666', 0, 278),
(12, 'Gimli', 1, '50.6333', '-97.0000', 0, 2623),
(13, 'Churchill', 1, '58.7660', '-94.1660', 0, 1000),
(14, 'Brandon', 1, '49.8333', '-99.9500', 0, 28418),
(15, 'Lynn Lake', 1, '56.8500', '-101.0500', 0, 482),
(16, 'Thompson', 1, '55.7499', '-97.8666', 0, 13727),
(17, 'Winnipeg', 1, '49.8830', '-97.1660', 1, 632063),
(18, 'Oxford House', 1, '54.9504', '-95.2666', 0, 184),
(19, 'The Pas', 1, '53.8166', '-101.2333', 0, 6055),
(20, 'Pukatawagan', 1, '55.7333', '-101.3166', 0, 431),
(21, 'Trepassey', 2, '46.7370', '-53.3633', 0, 398),
(22, 'Trout River', 2, '49.4837', '-58.1166', 0, 452),
(23, 'Gander', 2, '48.9500', '-54.5500', 0, 3345),
(24, 'St. John\'s', 2, '47.5850', '-52.6810', 1, 131469),
(25, 'Port Hope Simpson', 2, '52.5333', '-56.3000', 0, 197),
(26, 'Deer Lake', 2, '49.1744', '-57.4269', 0, 4163),
(27, 'Hopedale', 2, '55.4500', '-60.2167', 0, 442),
(28, 'Forteau', 2, '51.4504', '-56.9500', 0, 448),
(29, 'Cartwright', 2, '53.7014', '-57.0121', 0, 505),
(30, 'Corner Brook', 2, '48.9500', '-57.9333', 0, 20791),
(31, 'Channel-Port aux Basques', 2, '47.5670', '-59.1500', 0, 4220),
(32, 'St. Anthony', 2, '51.3837', '-55.6000', 0, 224),
(33, 'Rigolet', 2, '54.1766', '-58.4473', 0, 124),
(34, 'La Scie', 2, '49.9670', '-55.5830', 0, 817),
(35, 'Buchans', 2, '48.8170', '-56.8666', 0, 685),
(36, 'Stephenville', 2, '48.5504', '-58.5666', 0, 7054),
(37, 'Happy Valley - Goose Bay', 2, '53.3000', '-60.3000', 0, 7572),
(38, 'Argentia', 2, '47.3004', '-53.9900', 0, 1063),
(39, 'Nain', 2, '56.5474', '-61.6860', 0, 1151),
(40, 'Schefferville', 3, '54.8000', '-66.8167', 0, 471),
(41, 'Port-Menier', 3, '49.8226', '-64.3480', 0, 263),
(42, 'Chicoutimi', 3, '48.4333', '-71.0667', 0, 53940),
(43, 'Dolbeau', 3, '48.8666', '-72.2333', 0, 13337),
(44, 'Rimouski', 3, '48.4337', '-68.5167', 0, 35584),
(45, 'La Sarre', 3, '48.8000', '-79.2000', 0, 7206),
(46, 'Mingan', 3, '50.3018', '-64.0173', 0, 588),
(47, 'Saint-Georges', 3, '46.1171', '-70.6667', 0, 26149),
(48, 'Kuujjuaq', 3, '58.1000', '-68.4000', 0, 1273),
(49, 'Mont-Laurier', 3, '46.5504', '-75.5000', 0, 11642),
(50, 'Mistassini', 3, '50.4171', '-73.8666', 0, 2645),
(51, 'Eastmain', 3, '52.2333', '-78.5167', 0, 335),
(52, 'Baie-Comeau', 3, '49.2227', '-68.1580', 0, 10435),
(53, 'Natashquan', 3, '50.1913', '-61.8107', 0, 722),
(54, 'Cap-Chat', 3, '49.1000', '-66.6833', 0, 1484),
(55, 'Sherbrooke', 3, '45.4000', '-71.9000', 0, 139652),
(56, 'Gaspé', 3, '48.8373', '-64.4934', 0, 3677),
(57, 'St-Augustin', 3, '51.2423', '-58.6470', 0, 3961),
(58, 'Radisson', 3, '53.7836', '-77.6166', 0, 270),
(59, 'Drummondville', 3, '45.8833', '-72.4834', 0, 59489),
(60, 'Rivière-du-Loup', 3, '47.8333', '-69.5333', 0, 16403),
(61, 'St.-Jerome', 3, '45.7666', '-74.0000', 0, 78439),
(62, 'Trois-Rivières', 3, '46.3500', '-72.5499', 0, 119693),
(63, 'Amos', 3, '48.5666', '-78.1167', 0, 10516),
(64, 'Val d\'Or', 3, '48.1166', '-77.7666', 0, 20625),
(65, 'Victoriaville', 3, '46.0504', '-71.9667', 0, 41500),
(66, 'Kangirsuk', 3, '60.0248', '-69.9991', 0, 549),
(67, 'Shawinigan', 3, '46.5504', '-72.7333', 0, 49161),
(68, 'Matagami', 3, '49.7504', '-77.6333', 0, 1966),
(69, 'Rouyn-Noranda', 3, '48.2500', '-79.0332', 0, 24602),
(70, 'Montréal', 3, '45.5000', '-73.5833', 0, 3678000),
(71, 'Salluit', 3, '62.1826', '-75.6595', 0, 106),
(72, 'Ivugivik', 3, '62.4166', '-77.9000', 0, 156),
(73, 'Québec', 3, '46.8400', '-71.2456', 1, 624177),
(74, 'Inukjuak', 3, '58.4700', '-78.1360', 0, 1597),
(75, 'Joliette', 3, '46.0333', '-73.4333', 0, 45361),
(76, 'Sept-Îles', 3, '50.3161', '-66.3600', 0, 25686),
(77, 'Whitehorse', 4, '60.7167', '-135.0500', 1, 23276),
(78, 'Watson Lake', 4, '60.1166', '-128.8000', 0, 802),
(79, 'Burwash Landing', 4, '61.3504', '-139.0000', 0, 73),
(80, 'Dawson City', 4, '64.0666', '-139.4167', 0, 1319),
(81, 'Yorkton', 5, '51.2171', '-102.4665', 0, 15172),
(82, 'Melville', 5, '50.9333', '-102.8000', 0, 4279),
(83, 'Uranium City', 5, '59.5666', '-108.6166', 0, 89),
(84, 'Saskatoon', 5, '52.1700', '-106.6700', 0, 198958),
(85, 'Meadow Lake', 5, '54.1301', '-108.4347', 0, 5882),
(86, 'Prince Albert', 5, '53.2000', '-105.7500', 0, 34609),
(87, 'Moose Jaw', 5, '50.4000', '-105.5500', 0, 32166),
(88, 'Kindersley', 5, '51.4670', '-109.1333', 0, 4383),
(89, 'Hudson Bay', 5, '52.8504', '-102.3833', 0, 2157),
(90, 'North Battleford', 5, '52.7666', '-108.2833', 0, 19440),
(91, 'Stony Rapids', 5, '59.2666', '-105.8333', 0, 152),
(92, 'Swift Current', 5, '50.2837', '-107.7666', 0, 14906),
(93, 'Regina', 5, '50.4500', '-104.6170', 1, 176183),
(94, 'La Ronge', 5, '55.1000', '-105.3000', 0, 3783),
(95, 'Weyburn', 5, '49.6666', '-103.8500', 0, 9362),
(96, 'Biggar', 5, '52.0504', '-107.9833', 0, 2192),
(97, 'Antigonish', 6, '45.6269', '-61.9982', 0, 6739),
(98, 'Halifax', 6, '44.6500', '-63.6000', 1, 359111),
(99, 'Sydney', 6, '46.0661', '-60.1800', 0, 37538),
(100, 'New Glasgow', 6, '45.5833', '-62.6333', 0, 20322),
(101, 'Baddeck', 6, '46.1000', '-60.7540', 0, 852),
(102, 'Windsor', 6, '44.9806', '-64.1291', 0, 3864),
(103, 'Liverpool', 6, '44.0400', '-64.7200', 0, 4331),
(104, 'Shelburne', 6, '43.7656', '-65.3194', 0, 3167),
(105, 'Yarmouth', 6, '43.8308', '-66.1126', 0, 7500),
(106, 'Digby', 6, '44.6226', '-65.7605', 0, 3949),
(107, 'Amherst', 6, '45.8166', '-64.2166', 0, 9336),
(108, 'Wetaskiwin', 7, '52.9666', '-113.3833', 0, 11823),
(109, 'Brooks', 7, '50.5671', '-111.9000', 0, 14163),
(110, 'Camrose', 7, '53.0167', '-112.8166', 0, 15808),
(111, 'Calgary', 7, '51.0830', '-114.0800', 0, 1110000),
(112, 'Grand Prairie', 7, '55.1666', '-118.8000', 0, 41462),
(113, 'Peace River', 7, '56.2333', '-117.2833', 0, 5340),
(114, 'Medicine Hat', 7, '50.0333', '-110.6833', 0, 63138),
(115, 'Vegreville', 7, '53.5000', '-112.0500', 0, 5813),
(116, 'Lac La Biche', 7, '54.7719', '-111.9647', 0, 2986),
(117, 'Hinton', 7, '53.4000', '-117.5834', 0, 10265),
(118, 'Edmonton', 7, '53.5500', '-113.5000', 1, 1058000),
(119, 'Lethbridge', 7, '49.7005', '-112.8333', 0, 70617),
(120, 'Fort McMurray', 7, '56.7333', '-111.3833', 0, 21863),
(121, 'Jasper', 7, '52.8833', '-118.0834', 0, 3907),
(122, 'Stettler', 7, '52.3330', '-112.6833', 0, 5494),
(123, 'Fort Chipewyan', 7, '58.7171', '-111.1500', 0, 3222),
(124, 'Athabasca', 7, '54.7170', '-113.2666', 0, 2539),
(125, 'Red Deer', 7, '52.2666', '-113.8000', 0, 74857),
(126, 'Lake Louise', 7, '51.4337', '-116.1833', 0, 1248),
(127, 'Banff', 7, '51.1780', '-115.5719', 0, 7502),
(128, 'Meander River', 7, '59.0333', '-117.6830', 0, 200),
(129, 'Thunder Bay', 8, '48.4462', '-89.2750', 0, 99334),
(130, 'Oshawa', 8, '43.8800', '-78.8500', 0, 450963),
(131, 'Timmins', 8, '48.4666', '-81.3333', 0, 34974),
(132, 'Thessalon', 8, '46.2500', '-83.5500', 0, 1464),
(133, 'Atikokan', 8, '48.7504', '-91.6166', 0, 3625),
(134, 'Little Current', 8, '45.9670', '-81.9333', 0, 1595),
(135, 'Big Beaver House', 8, '52.9500', '-89.8833', 0, 10),
(136, 'Parry Sound', 8, '45.3337', '-80.0330', 0, 7105),
(137, 'Lansdowne House', 8, '52.2166', '-87.8833', 0, 120),
(138, 'Attawapiskat', 8, '52.9166', '-82.4333', 0, 1802),
(139, 'Cobalt', 8, '47.3837', '-79.6833', 0, 1372),
(140, 'Owen Sound', 8, '44.5666', '-80.8500', 0, 22625),
(141, 'Pembroke', 8, '45.8503', '-77.1166', 0, 15551),
(142, 'Moosonee', 8, '51.2806', '-80.6580', 0, 1725),
(143, 'Dryden', 8, '49.7833', '-92.8333', 0, 7862),
(144, 'Fort Severn', 8, '55.9833', '-87.6500', 0, 125),
(145, 'Kingston', 8, '44.2337', '-76.4833', 0, 114195),
(146, 'North Bay', 8, '46.3000', '-79.4500', 0, 50170),
(147, 'Toronto', 8, '43.7000', '-79.4200', 1, 5213000),
(148, 'Sudbury', 8, '46.5000', '-80.9666', 0, 157857),
(149, 'Cornwall', 8, '45.0171', '-74.7333', 0, 48821),
(150, 'Deer Lake', 8, '52.6170', '-94.0666', 0, 3743),
(151, 'London', 8, '42.9700', '-81.2500', 0, 346765),
(152, 'Orillia', 8, '44.6000', '-79.4167', 0, 37483),
(153, 'Kenora', 8, '49.7667', '-94.4666', 0, 10852),
(154, 'Barrie', 8, '44.3838', '-79.7000', 0, 182041),
(155, 'Marathon', 8, '48.7504', '-86.3667', 0, 4627),
(156, 'Red Lake', 8, '51.0337', '-93.8333', 0, 1765),
(157, 'Wiarton', 8, '44.7337', '-81.1333', 0, 2182),
(158, 'Ottawa', 8, '45.4167', '-75.7000', 0, 1145000),
(159, 'Cochrane', 8, '49.0670', '-81.0166', 0, 4441),
(160, 'Nipigon', 8, '49.0170', '-88.2500', 0, 1204),
(161, 'Geraldton', 8, '49.7166', '-86.9666', 0, 1290),
(162, 'New Liskeard', 8, '47.5000', '-79.6666', 0, 5203),
(163, 'Cat Lake', 8, '51.7170', '-91.8000', 0, 277),
(164, 'Peterborough', 8, '44.3000', '-78.3333', 0, 83627),
(165, 'Chapleau', 8, '47.8337', '-83.4000', 0, 2663),
(166, 'Belleville', 8, '44.1667', '-77.3833', 0, 43990),
(167, 'Kapuskasing', 8, '49.4167', '-82.4333', 0, 9240),
(168, 'Sioux Lookout', 8, '50.2630', '-91.9166', 0, 4570),
(169, 'Brockville', 8, '44.5893', '-75.6953', 0, 26458),
(170, 'Hamilton', 8, '43.2500', '-79.8300', 0, 721053),
(171, 'Kitchener', 8, '43.4500', '-80.5000', 0, 417001),
(172, 'Orangeville', 8, '43.9171', '-80.0833', 0, 32640),
(173, 'Wawa', 8, '48.0004', '-84.7833', 0, 2174),
(174, 'Hearst', 8, '49.7005', '-83.6666', 0, 5043),
(175, 'Sarnia', 8, '42.9666', '-82.4000', 0, 144172),
(176, 'Windsor', 8, '42.3333', '-83.0333', 0, 319246),
(177, 'Smithers', 9, '54.7666', '-127.1666', 0, 6245),
(178, 'Terrace', 9, '54.5000', '-128.5833', 0, 19443),
(179, 'Quesnel', 9, '52.9837', '-122.4833', 0, 13788),
(180, 'Dawson Creek', 9, '55.7670', '-120.2333', 0, 10802),
(181, 'Campbell River', 9, '50.0171', '-125.2500', 0, 33430),
(182, 'Revelstoke', 9, '51.0005', '-118.1833', 0, 7668),
(183, 'Creston', 9, '49.1000', '-116.5167', 0, 4816),
(184, 'Cranbrook', 9, '49.5167', '-115.7667', 0, 18610),
(185, 'Kamloops', 9, '50.6667', '-120.3333', 0, 68714),
(186, 'Powell River', 9, '49.8837', '-124.5500', 0, 12779),
(187, 'Nelson', 9, '49.4837', '-117.2833', 0, 11779),
(188, 'Vancouver', 9, '49.2734', '-123.1216', 0, 2313328),
(189, 'Bella Bella', 9, '52.1484', '-128.1173', 0, 1400),
(190, 'Kelowna', 9, '49.9000', '-119.4833', 0, 125109),
(191, 'Courtenay', 9, '49.6833', '-125.0000', 0, 32793),
(192, 'Fort St. John', 9, '56.2500', '-120.8333', 0, 18776),
(193, 'Lillooet', 9, '50.6837', '-121.9333', 0, 2893),
(194, 'Williams Lake', 9, '52.1166', '-122.1500', 0, 14168),
(195, 'Prince Rupert', 9, '54.3167', '-130.3300', 0, 14708),
(196, 'Chilliwack', 9, '49.1666', '-121.9500', 0, 51942),
(197, 'Port Hardy', 9, '50.7171', '-127.5000', 0, 2295),
(198, 'Penticton', 9, '49.5004', '-119.5833', 0, 37721),
(199, 'Fort Nelson', 9, '58.8167', '-122.5330', 0, 6315),
(200, 'Burns Lake', 9, '54.2170', '-125.7666', 0, 2635),
(201, 'Prince George', 9, '53.9167', '-122.7667', 0, 65558),
(202, 'Tofino', 9, '49.1521', '-125.9031', 0, 1655),
(203, 'Abbotsford', 9, '49.0504', '-122.3000', 0, 151683),
(204, 'Nanaimo', 9, '49.1460', '-123.9343', 0, 84905),
(205, 'Victoria', 9, '48.4333', '-123.3500', 1, 289625),
(206, 'Sandspit', 9, '53.2404', '-131.8333', 0, 538),
(207, 'Dease Lake', 9, '58.4503', '-130.0333', 0, 303),
(208, 'Lutselke', 10, '62.4001', '-110.7333', 0, 102),
(209, 'Yellowknife', 10, '62.4420', '-114.3970', 1, 19234),
(210, 'Paulatuk', 10, '69.3833', '-123.9833', 0, 294),
(211, 'Norman Wells', 10, '65.2837', '-126.8500', 0, 1027),
(212, 'Fort Resolution', 10, '61.1666', '-113.6830', 0, 448),
(213, 'Fort McPherson', 10, '67.4915', '-134.8950', 0, 1069),
(214, 'Holman', 10, '70.7334', '-117.7500', 0, 500),
(215, 'Fort Smith', 10, '60.0000', '-111.8833', 0, 518),
(216, 'Hay River', 10, '60.8500', '-115.7000', 0, 3900),
(217, 'Fort Simpson', 10, '61.8500', '-121.3333', 0, 283),
(218, 'Tuktoyaktuk', 10, '69.4548', '-133.0492', 0, 929),
(219, 'Fort Good Hope', 10, '66.2666', '-128.6333', 0, 597),
(220, 'Tsiigehtchic', 10, '67.4333', '-133.7500', 0, 175),
(221, 'Doline', 10, '65.1833', '-123.4167', 0, 525),
(222, 'Inuvik', 10, '68.3500', '-133.7000', 0, 3022),
(223, 'Resolute', 11, '74.6833', '-94.9000', 0, 250),
(224, 'Iqaluit', 11, '63.7505', '-68.5002', 1, 6124),
(225, 'Alert', 11, '82.4833', '-62.2500', 0, 125),
(226, 'Pangnirtung', 11, '66.1333', '-65.7500', 0, 1320),
(227, 'Arctic Bay', 11, '73.0333', '-85.1666', 0, 604),
(228, 'Rankin Inlet', 11, '62.8167', '-92.0953', 0, 2472),
(229, 'Coral Harbour', 11, '64.1538', '-83.1766', 0, 834),
(230, 'Kugluktuk', 11, '67.7987', '-115.1254', 0, 1302),
(231, 'Cape Dorset', 11, '64.3125', '-76.5386', 0, 1326),
(232, 'Baker Lake', 11, '64.3170', '-96.0167', 0, 1584),
(233, 'Igloolik', 11, '69.2565', '-81.7936', 0, 1612),
(234, 'Grise Fiord', 11, '76.4417', '-82.9500', 0, 23),
(235, 'Gjoa Haven', 11, '68.6333', '-95.9167', 0, 1109),
(236, 'Naujaat', 11, '66.5295', '-86.2829', 0, 1000),
(237, 'Taloyoak', 11, '69.5333', '-93.5333', 0, 774),
(238, 'Pond Inlet', 11, '72.6850', '-78.0001', 0, 1549),
(239, 'Ennadai', 11, '61.1333', '-100.8833', 0, 0),
(240, 'Kimmirut', 11, '62.8500', '-69.8833', 0, 385),
(241, 'Cambridge Bay', 11, '69.1170', '-105.0333', 0, 1477),
(242, 'Hall Beach', 11, '68.7675', '-81.2361', 0, 654),
(243, 'Arviat', 11, '61.1086', '-94.0586', 0, 1868),
(244, 'Chesterfield Inlet', 11, '63.3383', '-90.7001', 0, 374),
(245, 'Bathurst', 12, '47.6000', '-65.6500', 0, 6111),
(246, 'Saint John', 12, '45.2670', '-66.0767', 0, 87857),
(247, 'Moncton', 12, '46.0833', '-64.7667', 0, 90635),
(248, 'Fredericton', 12, '45.9500', '-66.6333', 1, 52337),
(249, 'Edmundston', 12, '47.3794', '-68.3333', 0, 17894),
(250, 'Charlottetown', 13, '46.2493', '-63.1313', 1, 42402);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `title` varchar(75) NOT NULL,
  `price` int(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(2500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `picturePath` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `title`, `price`, `category`, `description`, `date`, `picturePath`) VALUES
(6, '2001 VW Jetta 1.8L 5 speed standard transmission cloth interior', 2500, 'Automotive', '<p>Great daily driver, excellent on fuel and has been very reliable, a few fixes here and there but a very well kept car.</p>', '2020-11-11 00:00:00', '20201102_171022.jpg'),
(7, 'New HP Monitor 27&quot; FHD 75Hz 5ms 1080p', 250, 'Electronics', '<p>Experience PC gaming like never before on this ultra-thin 27\" LCD monitor with 75Hz refresh rate and 5ms GTG response time. It features FHD, IPS, and FreeSync technology for crisp, clear content with unbelievably vivid hues, and is blur and lag-free, so you keep up with the action. The expansive viewing makes it conducive to dual display setups.</p><ul><li>27-inch LED display with a 1920 x 1080 resolution delivers Full HD imagery for an immersive viewing experience</li><li>5ms response time and 75Hz refresh rate help to minimise motion blur so that even fast scenes display smoothly</li><li>Extra-wide 178-degree viewing angles provide you with a clear view from nearly any perspective</li><li>16:9 aspect ratio offers up a panoramic, cinema-quality experience</li><li>AMD Radeon FreeSync technology reduces image tearing by keeping your monitor</li></ul>', '2020-11-12 00:00:00', ''),
(8, 'Set of 4 winter tires, Goodyear Grippers 185/70R14', 250, 'Automotive', '<p>Sold my old car and these don\'t fit on my VW .. Good quality tires, definitely have a few more seasons left in them. Come pick them up!</p>', '2020-11-12 00:00:00', '20201111_000527.jpg'),
(9, 'New Smart Watch', 150, 'Electronics', '<p>Brand new still in package</p>', '2020-11-13 00:00:00', ''),
(11, 'Bluetooth headphones for sale. used.', 50, 'Electronics', '<p>Lightly used headphones, still in great shape, comes with aux and charging cable.</p>', '2020-11-20 00:00:00', ''),
(71, ' 2003 Toyota 4Runner, mint condition!', 5000, 'Automotive', '<p>Selling this rig because I\'ve recently upgraded! Lots of life left in this old girl. Outfitted with a pop out tent on the roof and mud tires for those remote off road adventures.</p>', '2020-11-26 13:30:47', '20180824_124655.jpg'),
(73, 'Treadmill for sale! ', 100, 'Fitness', '<p>Old but still works!</p>', '2020-11-27 03:41:46', ''),
(75, 'Radiant heater', 30, 'Home', '<p>Great heater works mint!</p>', '2020-11-27 13:00:18', ''),
(82, 'Basketball for sale', 15, 'Automotive', '<p>Used basketball, holds air no problem.</p>', '2020-12-04 14:04:50', ''),
(85, 'Swiss Coffee Mug', 10, 'Home', '<p>Holds coffee well, lightly used. Willing to ship within Canada.&nbsp;</p>', '2020-12-07 13:47:16', '20201121_125004.jpg'),
(88, 'Redwing Work Boots(non-slip)', 200, 'Other', '<p>Size 11.</p><p>Almost new pair of boots, hardly worn, they were a bit small and aren\'t even broken in yet.</p><p>Text for inquiries.</p>', '2020-12-07 14:00:14', '20181118_142713.jpg'),
(91, '1995 Nissan Skyline r32 V-Spec', 6000, 'Automotive', '<ol><li>Great older tuner car,</li><li>clean title</li><li>no accidents.</li></ol><p>Text for more info.</p>', '2020-12-07 14:51:03', NULL),
(92, 'Pink Lamborghini', 250000, 'Automotive', '<p>Real fancy</p>', '2020-12-08 13:09:38', 'lambo.jpg'),
(93, 'New HP Monitor 27&quot; FHD 75Hz 5ms 1080p', 250, 'Electronics', '<p>Brand new monitor text for details.. 204-793-0937&nbsp;</p><p>Whether you\'re working, gaming, or enjoying multimedia entertainment, this 27\" Samsung gaming monitor ensures every image and scene is clear, bright, and true-to-life. Boasting Full HD resolution and extra-wide viewing angles, it makes it easy to immerse yourself in the action. Its FreeSync technology minimises tearing for seamless motion.</p><p>&nbsp;</p><ul><li>27-inch LED display with a 1920 x 1080 resolution delivers Full HD</li></ul>', '2020-12-08 21:05:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(10) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(320) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` text NOT NULL,
  `province` text DEFAULT NULL,
  `postalCode` varchar(6) NOT NULL,
  `password` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `fullName`, `email`, `address`, `city`, `province`, `postalCode`, `password`, `date`) VALUES
(21, 'apple', 'Mike Haw', 'mike.a@htoma.com', 'asda', 'asd', 'asd', 'r0c0r0', '$2y$10$2d/cq/zo963p6cC6ckPhmOeEUCyhgnsQTO0W.BgaJ43', '2020-12-10 21:20:23'),
(23, 'Mike88', ' Michael Mike', 'Mike.mike@fmail.com', 'Box 2333', 'Balmoral', 'MB', 'F0W4R4', '$2y$10$QASyQmYQwhKmMVBjc/drPuYLcI.yf6GDvtFvJRSAeveMYHISXX0I6', '2020-12-10 21:32:12'),
(24, 'goodguygreg', 'Pablo Escobar', 'secretemail@secure.com', 'Rd 88 8402e', 'Langenburg', 'SK', 'S3D4F4', '$2y$10$QMIjbITH5Yz52./QyhXdw.xKxIsO2p8atDxXwQS9oeIB4Q9l7h/Z6', '2020-12-10 21:43:11'),
(52, 'Bobson', 'Bobby Boy', 'bobtree@email.com', 'ASD Ave', 'Brandon', 'MB', 'Q3W3W3', '$2y$10$Ijys.h2XQqqQTJeq6QMuOep/sZnoLSBh5Tua9uq/FKJYkv520XcgG', '2020-12-10 22:08:00'),
(53, 'JoeDirt', 'David Spade', 'secretemail1@secure.com', 'Rd 88 8402e', 'Teulon', 'MB', 'S3D4F4', '$2y$10$6jdOE8Gz6sLKATX0wtGf0u9iO7tP6K8126IqUsk1r73A94/tqQUP6', '2020-12-10 22:10:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
