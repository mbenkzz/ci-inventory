INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(2, 'Plastik', 'Item yang berbahan plastik'),
(3, 'Sembako', 'Beras, Minyak, Beras Ketan, Gula, Susu'),
(4, 'Perlengkapan Ulang Tahun', 'Pernik-pernik ulang tahun'),
(5, 'Bahan Kue', 'Bahan-bahan pembuatan kue'),
(6, 'Serbuk Minuman', 'Minuman serbuk berbagai kemasan'),
(7, 'Bumbu Dapur', 'Berbagai jenis bumbu, kecap, saos'),
(8, 'Perlengkapan Catering', 'Berbagai macam perlengkapan catering');

INSERT INTO `items` (`id`, `item_code`, `category_id`, `name`, `buy_price`, `sell_price`, `stock`, `unit`, `description`) VALUES
(1, 'ITEM0001', 2, 'Plastik Loco Merah 35', '12300', '14500', 0, 'pcs', NULL),
(2, 'ITEM0002', 2, 'Plastik Loco Merah 40', '12300', '14500', 0, 'pcs', NULL),
(3, 'ITEM0003', 2, 'Plastik Loco Putih 17 ', '14500', '16500', 0, 'pcs', NULL),
(4, 'ITEM0004', 2, 'Plastik Loco Putih 24', '14500', '16500', 0, 'pcs', NULL),
(5, 'ITEM0005', 2, 'Plastik Loco Putih 28', '14500', '16500', 0, 'pcs', NULL),
(6, 'ITEM0006', 2, 'Plastik Loco Putih 25', '14500', '16500', 0, 'pcs', NULL),
(7, 'ITEM0007', 2, 'Plastik Ekonomis 28 Putih', '8300', '10000', 0, 'pcs', NULL),
(8, 'ITEM0008', 2, 'Plastik Ekonomis 28 Hitam', '7000', '9000', 0, 'pcs', NULL),
(9, 'ITEM0009', 2, '	Plastik Ekonomis 35 Hitam', '11000', '13000', 0, 'pcs', NULL),
(10, 'ITEM0010', 2, 'Plastik Ekonomis 40 Hitam', '15500', '18000', 0, 'pcs', NULL),
(11, 'ITEM0011', 2, 'Mika 6 per 100 pcs', '60', '80', 0, 'pcs', NULL),
(12, 'ITEM0012', 2, 'Mika 6 per 50 pcs', '60', '50', 0, 'pcs', NULL),
(13, 'ITEM0013', 2, 'Mika 5 per 100 pcs', '90', '110', 0, 'pcs', NULL),
(14, 'ITEM0014', 2, 'Mika 5 per 50 pcs', '90', '120', 0, 'pcs', NULL),
(15, 'ITEM0015', 2, 'Mika 4 per 100 pcs', '140', '170', 0, 'pcs', NULL),
(16, 'ITEM0016', 2, 'Mika 4 per 50 pcs', '140', '160', 0, 'pcs', NULL),
(17, 'ITEM0017', 2, 'Mika 3 per 100 pcs', '180', '230', 0, 'pcs', NULL),
(18, 'ITEM0018', 2, 'Mika 3 per 50 pcs', '180', '220', 0, 'pcs', NULL),
(19, 'ITEM0019', 2, 'Mika 0.5 kg (2A) per 50 pcs', '200', '720', 0, 'pcs', NULL),
(20, 'ITEM0020', 2, 'Mika 0.5 kg (2A) per 1 pcs', '200', '1000', 0, 'pcs', NULL),
(21, 'ITEM0021', 2, 'Mika 1 kg (1A)', '1000', '1500', 0, 'pcs', NULL),
(22, 'ITEM0022', 2, 'Mika 2 kg', '1550', '2000', 0, 'pcs', NULL),
(23, 'ITEM0023', 2, 'Mika inner 18x18', '160', '200', 0, 'pcs', NULL),
(24, 'ITEM0024', 2, 'Mika inner 20x20', '1200', '1500', 0, 'pcs', NULL),
(25, 'ITEM0025', 8, 'Dus 18x18', '1100', '1500', 0, 'pcs', NULL),
(26, 'ITEM0026', 8, 'Dus 20x20', '1200', '1500', 0, 'pcs', NULL),
(27, 'ITEM0027', 8, 'Dus Snack 12x16', '650', '1000', 0, 'pcs', NULL),
(28, 'ITEM0028', 8, 'Aqua Bravo', '5500', '7000', 0, 'ball', NULL),
(29, 'ITEM0029', 8, 'Gelas Bola', '8000', '10000', 0, 'roll', NULL),
(30, 'ITEM0030', 8, 'Gelas Bravo 12', '9000', '11000', 0, 'roll', NULL),
(31, 'ITEM0031', 8, 'Gelas Bravo 14', '9000', '11000', 0, 'roll', NULL),
(32, 'ITEM0032', 8, 'Gelas Bravo 16', '9000', '11000', 0, 'roll', NULL),
(33, 'ITEM0033', 2, 'Plastik Klip 5x8', '1800', '2500', 0, 'pack', NULL),
(34, 'ITEM0034', 2, 'Plastik Klip 6x10', '2300', '3000', 0, 'pack', NULL),
(35, 'ITEM0035', 2, 'Plastik Klip 7x10', '2700', '3500', 0, 'pack', NULL),
(36, 'ITEM0036', 8, 'Tas Comico 25', '20000', '26000', 0, 'pack', NULL),
(37, 'ITEM0037', 8, 'Tas Comico 30', '22000', '27000', 0, 'pack', NULL),
(38, 'ITEM0038', 8, 'Tas Comico 38', '30000', '36000', 0, 'pack', NULL),
(39, 'ITEM0039', 8, 'DM 200 ml', '15000', '20000', 0, 'pack', NULL),
(40, 'ITEM0040', 8, 'DM 300 ml', '16000', '21000', 0, 'pack', NULL),
(41, 'ITEM0041', 8, 'DM 400 ml', '20000', '25000', 0, 'pack', NULL),
(42, 'ITEM0042', 8, 'DM 500 ml', '27000', '32000', 0, 'pack', NULL),
(43, 'ITEM0043', 8, 'DM 750 ml', '29000', '34000', 0, 'pack', NULL),
(44, 'ITEM0044', 8, 'DM 1000 ml', '31000', '36000', 0, 'pack', NULL),
(45, 'ITEM0045', 8, 'DM 1500 ml', '50000', '55000', 0, 'pack', NULL),
(46, 'ITEM0046', 8, 'DM 2000 ml', '78000', '85000', 0, 'pack', NULL),
(47, 'ITEM0047', 8, 'Tali Atom K / Tali Rafia', '900', '1500', 0, 'pcs', NULL),
(48, 'ITEM0048', 8, 'Cup Puding+Tutup', '6500', '8000', 0, 'roll', NULL),
(49, 'ITEM0049', 8, 'Sedotan Nanas Bengkok per pak', '22000', '27000', 0, 'pack', NULL),
(50, 'ITEM0050', 8, 'Sedotan Nanas Bengkok per pcs', '1080', '1500', 0, 'pcs', NULL),
(51, 'ITEM0051', 8, 'Bowl 800', '1600', '2000', 0, 'pcs', NULL),
(52, 'ITEM0052', 8, 'Bowl 650', '1360', '1500', 0, 'pcs', NULL),
(53, 'ITEM0053', 8, 'Bowl 500+Tutup', '1670', '1700', 0, 'pcs', NULL),
(54, 'ITEM0054', 8, 'Bowl 360+Tutup', '1600', '1600', 0, 'pcs', NULL),
(55, 'ITEM0055', 8, 'Tas Polos 15', '11000', '14000', 0, 'pack', NULL),
(56, 'ITEM0056', 8, 'Tas Polos 20', '17000', '21000', 0, 'pcs', NULL),
(57, 'ITEM0057', 8, 'Sendok Mika Putih Susu', '100', '1400', 0, 'pcs', NULL),
(58, 'ITEM0058', 8, 'Sendok Teh/Puding K', '2500', '3500', 0, 'bungkus', NULL),
(59, 'ITEM0059', 8, 'Sendok Teh/Puding T', '4000', '5000', 0, 'bungkus', NULL),
(60, 'ITEM0060', 8, 'Karet Sakura Coklat', '5500', '7000', 0, 'bungkus', NULL),
(61, 'ITEM0061', 8, 'Tas Polos 30', '30000', '35000', 0, 'pack', NULL),
(62, 'ITEM0062', 2, 'Plastik Tahan Panas 12x25  (1 Kg) per 0.25 kg', '7750', '10000', 0, 'kg', NULL),
(63, 'ITEM0063', 2, 'Plastik Tahan Panas 15x30 (0.5 kg) per 0.25 kg', '7750', '10000', 0, 'kg', NULL),
(64, 'ITEM0064', 5, 'Pewarna Cair Merah Rose', '4000', '5000', 0, 'pcs', NULL),
(65, 'ITEM0065', 5, 'Pewarna Cair Hitam', '4000', '5000', 0, 'pcs', NULL),
(66, 'ITEM0066', 5, 'Pewarna Cair Warna-Warni', '3200', '4500', 0, 'pcs', NULL),
(67, 'ITEM0067', 5, 'Soda Kue', '4000', '5000', 0, 'pcs', NULL),
(68, 'ITEM0068', 5, 'Baking Soda', '4000', '5000', 0, 'pcs', NULL),
(69, 'ITEM0069', 5, 'Selasih', '6400', '8000', 0, 'bungkus', NULL),
(70, 'ITEM0070', 8, 'Sumpit', '1700', '2500', 0, 'bungkus', NULL),
(71, 'ITEM0071', 8, 'Cup Kue B', '50000', '60000', 0, 'roll', NULL),
(72, 'ITEM0072', 8, 'Cup Kue T', '20000', '24000', 0, 'roll', NULL),
(73, 'ITEM0073', 8, 'Cup Kue K', '14000', '17000', 0, 'roll', NULL),
(74, 'ITEM0074', 8, 'Sarung Tangan', '6000', '7500', 0, 'box', NULL),
(75, 'ITEM0075', 8, 'Tas Goody Bag Plastik Batik', '23000', '28000', 0, 'pack', NULL),
(76, 'ITEM0076', 8, 'Kertas Nasi Putih KFC', '10000', '13000', 0, 'bungkus', NULL),
(77, 'ITEM0077', 8, 'Cup Sambal 25 ml', '10000', '13000', 0, 'roll', NULL),
(78, 'ITEM0078', 8, 'Kertas Nasi Coklat Gajah', '23000', '30000', 0, 'ball', NULL),
(79, 'ITEM0079', 2, 'Bubble Wrap', '2000', '3000', 0, 'meter', NULL),
(80, 'ITEM0080', 5, 'Ovalet', '5900', '7500', 0, 'pcs', NULL),
(81, 'ITEM0081', 5, 'TBM', '5900', '7500', 0, 'pcs', NULL),
(82, 'ITEM0082', 5, 'SP', '6000', '7500', 0, 'pcs', NULL),
(83, 'ITEM0083', 8, 'Styrofoam Nasi', '35000', '45000', 0, 'ball', NULL),
(84, 'ITEM0084', 8, 'Styrofoam Bubur', '25000', '35000', 0, 'ball', NULL),
(85, 'ITEM0085', 8, 'Styrofoam Bulat (MO)', '21000', '31000', 0, 'ball', NULL),
(86, 'ITEM0086', 8, 'Styrofoam Seblak', '35000', '45000', 0, 'ball', NULL),
(87, 'ITEM0087', 8, 'Tutup Gelas Cembung', '4500', '6000', 0, 'pcs', NULL),
(88, 'ITEM0088', 2, 'Mika Bulat T', '1500', '2000', 0, 'pcs', NULL),
(89, 'ITEM0089', 2, 'Mika Bulat B', '1800', '2500', 0, 'pcs', NULL),
(90, 'ITEM0090', 8, 'Tatakan Kue 20', '1400', '2000', 0, 'pcs', NULL),
(91, 'ITEM0091', 8, 'Tatakan Kue 22', '1400', '2000', 0, 'pcs', NULL),
(92, 'ITEM0092', 2, 'Plastik Lobi Biru 20x40 (2 kg)', '4100', '5500', 0, 'pcs', NULL),
(93, 'ITEM0093', 2, 'Plastik Joyoboyo 10x30', '1800', '2500', 0, 'pcs', NULL),
(94, 'ITEM0094', 2, 'Plastik Joyoboyo 17x35', '3300', '4000', 0, 'pcs', NULL),
(95, 'ITEM0095', 2, 'Plastik Joyoboyo 15x35', '3000', '4000', 0, 'pcs', NULL),
(96, 'ITEM0096', 2, 'Plastik Joyoboyo 13x35', '2500', '3000', 0, 'pcs', NULL),
(97, 'ITEM0097', 4, 'Lilin Magic', '5000', '6000', 0, 'pcs', NULL),
(98, 'ITEM0098', 5, 'Colatta Compound Dark (Coklat)', '12000', '14000', 0, 'pcs', NULL),
(99, 'ITEM0099', 5, 'Coklat Batang Premium', '9695', '11500', 0, 'pcs', NULL),
(100, 'ITEM0100', 5, 'Elmes Tropical Bluberry', '9000', '11500', 0, 'pcs', NULL),
(101, 'ITEM0101', 5, 'Elmes Tropical Rasberry', '9000', '11500', 0, 'pcs', NULL),
(102, 'ITEM0102', 5, 'Elmes Tropical Melon', '9000', '11500', 0, 'pcs', NULL),
(103, 'ITEM0103', 5, 'Elmes Tropical Banana', '9000', '11500', 0, 'pcs', NULL),
(104, 'ITEM0104', 5, 'Elmes Tropical White', '9500', '12500', 0, 'pcs', NULL),
(105, 'ITEM0105', 2, 'Plastik HIT', '1750', '2500', 0, 'pcs', NULL),
(106, 'ITEM0106', 2, 'Plastik Tahu/Bening 10x30', '1800', '2500', 0, 'pcs', NULL),
(107, 'ITEM0107', 2, 'Plastik Tahu/Bening 12x35', '2200', '2500', 0, 'pcs', NULL),
(108, 'ITEM0108', 2, 'Plastik Bening 15x35', '2800', '3500', 0, 'pcs', NULL),
(109, 'ITEM0109', 2, 'Plastik Tahu/Bening 17x35', '3000', '3500', 0, 'pcs', NULL),
(110, 'ITEM0110', 5, 'Meses Warna per 0.25 kg', '5000', '6500', 0, 'kg', NULL),
(111, 'ITEM0111', 5, 'Meses Coklat per 0.25 kg', '4500', '5500', 0, 'kg', NULL),
(112, 'ITEM0112', 8, 'Tusuk Gigi', '1800', '2500', 0, 'bungkus', NULL),
(113, 'ITEM0113', 5, 'Keju Cedar Mini', '4500', '5500', 0, 'pcs', NULL),
(114, 'ITEM0114', 5, 'Coklat Chip per 0.25 kg', '15000', '17500', 0, 'kg', NULL),
(115, 'ITEM0115', 5, 'Mentega Palmia', '6000', '7000', 0, 'pcs', NULL),
(116, 'ITEM0116', 5, 'Mentega Blueband', '9000', '10000', 0, 'pcs', NULL),
(117, 'ITEM0117', 2, 'Plastik Wayang 6x12 per 0.25 kg', '9000', '10000', 0, 'kg', NULL),
(118, 'ITEM0118', 2, 'Plastik Bawang 9x25 per 0.25 kg', '6400', '7500', 0, 'kg', NULL),
(119, 'ITEM0119', 2, 'Plastik Tomat 10x30 per 0.25 kg', '8500', '10000', 0, 'kg', NULL),
(120, 'ITEM0120', 5, 'SP 1 ons', '1500', '2500', 0, 'ons', NULL),
(121, 'ITEM0121', 2, 'Plastik Klip 16x15', '13000', '15000', 0, 'bungkus', NULL),
(122, 'ITEM0122', 2, 'Plastik Klip 10x15', '7000', '8000', 0, 'bungkus', NULL),
(123, 'ITEM0123', 5, 'Meses Mercolade per 0.25 kg', '8000', '9000', 0, 'kg', NULL),
(124, 'ITEM0124', 2, 'Plastik Segitiga 20x40x03 per 0.25 kg', '8250', '9000', 0, 'kg', NULL),
(125, 'ITEM0125', 5, 'Terigu Segitiga Biru ', '7840', '8500', 0, 'kg', NULL),
(126, 'ITEM0126', 5, 'Tepung Terigu Cakra', '8700', '9500', 0, 'kg', NULL),
(127, 'ITEM0127', 2, 'Plastik Sampah B', '2400', '3000', 0, 'pcs', NULL),
(128, 'ITEM0128', 2, 'Plastik Sampah T', '1000', '2000', 0, 'pcs', NULL),
(129, 'ITEM0129', 2, 'Plastik Sampah K', '250', '1000', 0, 'pcs', NULL),
(130, 'ITEM0130', 5, 'Win Cheese per 0.25 kg', '10625', '12500', 0, 'kg', NULL),
(131, 'ITEM0131', 8, 'Box Nasi Coklat 20x20', '1100', '1500', 0, 'pcs', NULL),
(132, 'ITEM0132', 8, 'Box pizza', '1700', '2500', 0, 'pcs', NULL),
(133, 'ITEM0133', 8, 'Box Donat', '1900', '2500', 0, 'pcs', NULL),
(134, 'ITEM0134', 4, 'Cake Topper/Tusukan Kue Ultah Pelangi', '2400', '3500', 0, 'pcs', NULL),
(135, 'ITEM0135', 4, 'Tusukan Kue Ultah Merah', '2000', '3000', 0, 'pcs', NULL),
(136, 'ITEM0136', 4, 'Tusukan Kue Ultah Bulat Besar', '1900', '3000', 0, 'pcs', NULL),
(137, 'ITEM0137', 8, 'Kertas Nasi Isi 100 pcs', '12000', '14000', 0, 'pack', NULL),
(138, 'ITEM0138', 8, 'Pasta', '5200', '6000', 0, 'pcs', NULL),
(139, 'ITEM0139', 8, 'Sendok Bebek', '1000', '2000', 0, 'pcs', NULL),
(140, 'ITEM0140', 2, 'Mika 6', '5000', '7000', 0, 'pack', NULL),
(141, 'ITEM0141', 8, 'Tusuk Sate', '12000', '15000', 0, 'pack', NULL),
(142, 'ITEM0142', 8, 'Gelas Aqua', '5500', '7000', 0, 'roll', NULL),
(143, 'ITEM0143', 4, 'Plastik Kado Transparan Polos', '3000', '3500', 0, 'pcs', NULL),
(144, 'ITEM0144', 4, 'Plastik Kado Transparant Motif', '2000', '2500', 0, 'pcs', NULL),
(145, 'ITEM0145', 2, 'Mika 6A per pak', '6000', '8000', 0, 'pack', NULL),
(146, 'ITEM0146', 2, 'Mika 3 per pak', '20000', '23000', 0, 'pack', NULL),
(147, 'ITEM0147', 5, 'Soda Kue Kupu-Kupu', '4000', '5000', 0, 'pcs', NULL),
(148, 'ITEM0148', 8, 'Standing Pouch', '12500', '15000', 0, 'pack', NULL),
(149, 'ITEM0149', 8, 'Gelas Kopi Kuping', '23000', '26000', 0, 'roll', NULL),
(150, 'ITEM0150', 8, 'Aluminium Roll', '19000', '27000', 0, 'roll', NULL),
(151, 'ITEM0151', 8, 'Mangkok T', '16000', '19000', 0, 'pack', NULL),
(152, 'ITEM0152', 8, 'Mangkok B', '22000', '25000', 0, 'pack', NULL),
(153, 'ITEM0153', 2, 'Jas Hujan', '4200', '10000', 0, 'pcs', NULL),
(154, 'ITEM0154', 8, 'Tissue Warna', '3000', '4000', 0, 'bungkus', NULL),
(155, 'ITEM0155', 8, 'Cup Puding 150 ml', '15000', '18000', 0, 'roll', NULL),
(156, 'ITEM0156', 8, 'Tusuk Gigi Steril', '14000', '17000', 0, 'pack', NULL),
(157, 'ITEM0157', 5, 'Susu Bubuk 0.5 kg', '8500', '10500', 0, 'kg', NULL),
(158, 'ITEM0158', 5, 'Coklat Bubuk Pahit 0.25 kg', '2500', '3500', 0, 'kg', NULL),
(159, 'ITEM0159', 5, 'Tepung Beras 0.5 kg', '6300', '7500', 0, 'kg', NULL),
(160, 'ITEM0160', 5, 'Sitrun', '2100', '3000', 0, 'pcs', NULL),
(161, 'ITEM0161', 8, 'Cup Sambal 35 ml', '12000', '14000', 0, 'roll', NULL),
(162, 'ITEM0162', 4, 'Lakban Besar ', '7500', '9000', 0, 'pcs', NULL),
(163, 'ITEM0163', 8, 'Thinwall 60x17', '17000', '20000', 0, 'roll', NULL),
(164, 'ITEM0164', 8, 'Gelas 130', '7500', '9000', 0, 'roll', NULL),
(165, 'ITEM0165', 7, 'Santan Kara', '2700', '3500', 0, 'pcs', NULL),
(166, 'ITEM0166', 2, 'Mika Dalaman 18x18', '7500', '11000', 0, 'pack', NULL),
(167, 'ITEM0167', 5, 'Tepung Maizena', '3300', '4500', 0, 'pack', NULL),
(168, 'ITEM0168', 8, 'Dus 30', '4000', '5000', 0, 'pcs', NULL),
(169, 'ITEM0169', 8, 'Kertas Nasi Padang KW 2', '13000', '15000', 0, 'kg', NULL),
(170, 'ITEM0170', 8, 'Kertas Nasi Gajah Merah', '30000', '36000', 0, 'pack', NULL),
(171, 'ITEM0171', 8, 'Kertas Nasi Gajah Biru', '26000', '31000', 0, 'pack', NULL),
(172, 'ITEM0172', 5, 'Gula GMP 1 Kg', '13250', '16500', 0, 'kg', NULL),
(173, 'ITEM0173', 8, 'Cup Puding 150 ml', '11500', '17000', 0, 'roll', NULL),
(174, 'ITEM0174', 5, 'Soda Kue Kupu', '4000', '5000', 0, 'pcs', NULL),
(175, 'ITEM0175', 4, 'Lakban 2 ml/Sedang', '4000', '5000', 0, 'pcs', NULL),
(176, 'ITEM0176', 8, 'Sendok Buram Jeruk Isi 100', '6500', '9000', 0, 'bungkus', NULL),
(177, 'ITEM0177', 5, 'Sagu Tani/Tapioka 0.5 kg', '6000', '7500', 0, 'kg', NULL),
(178, 'ITEM0178', 6, 'Susu Dancow', '3150', '4000', 0, 'pcs', NULL),
(179, 'ITEM0179', 8, 'Alas Toples', '20000', '28000', 0, 'pack', NULL),
(180, 'ITEM0180', 5, 'Selai Coklat 0.5 kg', '5250', '7000', 0, 'kg', NULL),
(181, 'ITEM0181', 8, 'Thinwal 1500', '1800', '2500', 0, 'pcs', NULL),
(182, 'ITEM0182', 3, 'Minyak Goreng Resto 1L', '23500', '25000', 0, 'pcs', NULL);

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
COMMIT;