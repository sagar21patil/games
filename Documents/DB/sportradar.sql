
--
-- Database: `sportradar`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `_sport_id` int(5) NOT NULL,
  `_team_ida` int(5) NOT NULL,
  `_team_idb` int(5) NOT NULL,
  `_location_id` int(5) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `old_start_time` datetime DEFAULT NULL,
  `old_end_time` datetime DEFAULT NULL,
  `event_status` enum('Abandoned','Cancelled','Delayed','Ended','Finished','Interrupted','Live','NotStarted','Postponed','Suspended','Unknown') NOT NULL,
  `event_score_teama` varchar(10) DEFAULT NULL,
  `event_score_teamb` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `_sport_id`, `_team_ida`, `_team_idb`, `_location_id`, `start_time`, `end_time`, `old_start_time`, `old_end_time`, `event_status`, `event_score_teama`, `event_score_teamb`) VALUES
(1, 1, 1, 3, 12, '2020-01-08 14:30:00', '2020-01-08 15:00:00', NULL, NULL, 'NotStarted', NULL, NULL),
(2, 1, 2, 4, 13, '2020-01-10 14:30:00', '2020-01-10 15:00:00', NULL, NULL, 'NotStarted', NULL, NULL),
(3, 1, 27, 34, 28, '2020-01-11 02:30:00', '2020-01-11 03:00:00', '2020-01-10 02:30:00', '2020-01-10 02:30:00', 'Postponed', NULL, NULL),
(4, 7, 127, 126, 13, '2020-01-12 08:30:00', '2020-01-12 09:00:00', NULL, NULL, 'NotStarted', NULL, NULL),
(5, 1, 64, 71, 24, '2020-01-15 14:00:00', '2020-01-08 14:30:00', NULL, NULL, 'NotStarted', NULL, NULL),
(6, 3, 80, 90, 18, '2020-01-15 16:00:00', '2020-01-15 17:30:00', NULL, NULL, 'NotStarted', NULL, NULL),
(7, 4, 35, 40, 34, '2020-01-18 02:30:00', '2020-01-18 03:00:00', '2020-01-10 02:30:00', '2020-01-10 02:30:00', 'Postponed', NULL, NULL),
(8, 6, 110, 117, 11, '2020-01-28 11:30:00', '2020-01-28 12:00:00', NULL, NULL, 'NotStarted', NULL, NULL),
(9, 1, 10, 14, 3, '2020-01-07 14:30:00', '2020-01-07 15:00:00', NULL, NULL, 'Ended', NULL, NULL),
(10, 1, 16, 20, 7, '2020-01-08 16:30:00', '2020-01-08 17:00:00', NULL, NULL, 'Cancelled', NULL, NULL),
(11, 1, 30, 38, 30, '2020-01-08 20:30:00', '2020-01-08 21:00:00', '2020-01-08 18:30:00', '2020-01-08 19:00:00', 'Delayed', NULL, NULL),
(12, 7, 130, 132, 20, '2020-01-07 08:30:00', '2020-01-07 09:00:00', NULL, NULL, 'Suspended', NULL, NULL),
(13, 1, 77, 80, 14, '2020-01-08 16:00:00', '2020-01-08 16:30:00', NULL, NULL, 'Interrupted', NULL, NULL),
(14, 1, 12, 19, 12, '2020-01-06 14:30:00', '2020-01-06 15:00:00', NULL, NULL, 'Finished', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `league_id` int(5) NOT NULL,
  `league_short_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `league_full_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `league_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `_sport_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`league_id`, `league_short_name`, `league_full_name`, `league_status`, `_sport_id`) VALUES
(1, 'NFL', 'National Football League', 'active', 1),
(2, 'RFPL', 'Russian Football Premier League', 'active', 1),
(3, 'ITF', 'International Tennis Federation', 'inactive', 2),
(4, 'NBA', 'National Basketball Association', 'active', 3),
(5, 'NHL', 'National Hockey League', 'active', 4),
(6, 'HBL', 'German Handball Bundesliga', 'active', 6),
(7, 'MLB', 'Major League Baseball', 'active', 7);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(5) NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `country` varchar(100) NOT NULL,
  `location_status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `city`, `country`, `location_status`) VALUES
(1, 'Earls Court', 'England', 'active'),
(2, 'Brighton', 'England', 'active'),
(3, 'Paris', 'France', 'active'),
(4, 'London', 'England', 'active'),
(5, 'Geneva', 'Switzerland', 'active'),
(6, 'Antwerp', 'Belgium', 'active'),
(7, 'Zürich', 'Switzerland', 'active'),
(8, 'Dortmund', 'Germany', 'active'),
(9, 'Essen', 'Germany', 'active'),
(10, 'Krefeld', 'Germany', 'active'),
(11, 'Berlin', 'Germany', 'active'),
(12, 'Munich', 'Germany', 'active'),
(13, 'Vienna', 'Austria', 'active'),
(14, 'Stockholm', 'Sweden', 'active'),
(15, 'Gothenburg', 'Sweden', 'active'),
(16, 'Helsinki', 'Finland', 'active'),
(17, 'Oulu', 'Finland', 'active'),
(18, 'Graz', 'Austria', 'active'),
(19, 'Bern', 'Switzerland', 'active'),
(20, 'Prague', 'Czech Republic', 'active'),
(21, 'Bratislava', 'Slovakia', 'active'),
(22, 'Tampere', 'Finland', 'active'),
(23, 'Malmö', 'Sweden', 'active'),
(24, 'Saint Petersburg', 'Russia', 'active'),
(25, 'Riga', 'Latvia', 'active'),
(26, 'Mannheim', 'Germany', 'active'),
(27, 'Amsterdam', 'Netherlands', 'active'),
(28, 'Barcelona', 'Spain', 'active'),
(29, 'Cologne', 'Germany', 'active'),
(30, 'Edinburgh', 'Scotland', 'active'),
(31, 'Birmingham', 'England', 'active'),
(32, 'Toronto', 'Canada', 'active'),
(33, 'New yourk', 'USA', 'active'),
(34, 'Houston', 'USA', 'active'),
(35, 'Orlando', 'USA', 'active'),
(36, 'San Antonio', 'USA', 'active'),
(37, 'sydney', 'Australia', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `sport_id` int(5) NOT NULL,
  `sport_name` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sport_id`, `sport_name`, `status`) VALUES
(1, 'Football', 'active'),
(2, 'Tennis', 'inactive'),
(3, 'Basketball ', 'active'),
(4, 'Hockey', 'active'),
(5, 'Ice Hockey', 'inactive'),
(6, 'Handball', 'active'),
(7, 'Baseball', 'active'),
(8, 'Cricket', 'inactive'),
(9, 'Volleyball', 'inactive'),
(10, 'Rugby', 'inactive'),
(11, 'Snooker', 'inactive'),
(12, 'Boxing', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `team_country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `_league_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_status`, `team_country`, `_league_id`) VALUES
(1, 'Arizona Cardinals', 'active', 'USA', 1),
(2, 'Atlanta Falcons', 'active', 'USA', 1),
(3, 'Baltimore Ravens', 'active', 'USA', 1),
(4, 'Buffalo Bills', 'active', 'USA', 1),
(5, 'Carolina Panthers', 'active', 'USA', 1),
(6, 'Chicago Bears', 'active', 'USA', 1),
(7, 'Cincinnati Bengals', 'active', 'USA', 1),
(8, 'Cleveland Browns', 'active', 'USA', 1),
(9, 'Dallas Cowboys', 'active', 'USA', 1),
(10, 'Denver Broncos', 'active', 'USA', 1),
(11, 'Detroit Lions', 'active', 'USA', 1),
(12, 'Green Bay Packers', 'active', 'USA', 1),
(13, 'Houston Texans', 'active', 'USA', 1),
(14, 'Indianapolis Colts', 'active', 'USA', 1),
(15, 'Jacksonville Jaguars', 'active', 'USA', 1),
(16, 'Kansas City Chiefs', 'active', 'USA', 1),
(17, 'Los Angeles Chargers', 'active', 'USA', 1),
(18, 'Los Angeles Rams', 'active', 'USA', 1),
(19, 'Miami Dolphins', 'active', 'USA', 1),
(20, 'Minnesota Vikings', 'active', 'USA', 1),
(21, 'New England Patriots', 'active', 'USA', 1),
(22, 'New Orleans Saints', 'active', 'USA', 1),
(23, 'New York Giants', 'active', 'USA', 1),
(24, 'New York Jets', 'active', 'USA', 1),
(25, 'Oakland Raiders', 'active', 'USA', 1),
(26, 'Philadelphia Eagles', 'active', 'USA', 1),
(27, 'Pittsburgh Steelers', 'active', 'USA', 1),
(28, 'San Francisco 49ers', 'active', 'USA', 1),
(29, 'Seattle Seahawks', 'active', 'USA', 1),
(30, 'Tampa Bay Buccaneers', 'active', 'USA', 1),
(31, 'Tennessee Titans', 'active', 'USA', 1),
(32, 'Washington Redskins', 'active', 'USA', 1),
(33, 'Anaheim Ducks', 'active', '', 5),
(34, 'Arizona Coyotes', 'active', '', 5),
(35, 'Boston Bruins', 'active', '', 5),
(36, 'Buffalo Sabres', 'active', '', 5),
(37, 'Calgary Flames', 'active', '', 5),
(38, 'Carolina Hurricanes', 'active', '', 5),
(39, 'Chicago Blackhawks', 'active', '', 5),
(40, 'Colorado Avalanche', 'active', '', 5),
(41, 'Columbus Blue Jackets', 'active', '', 5),
(42, 'Dallas Stars', 'active', '', 5),
(43, 'Detroit Red Wings', 'active', '', 5),
(44, 'Edmonton Oilers', 'active', '', 5),
(45, 'Florida Panthers', 'active', '', 5),
(46, 'Los Angeles Kings', 'active', '', 5),
(47, 'Minnesota Wild', 'active', '', 5),
(48, 'Montreal Canadiens', 'active', '', 5),
(49, 'Nashville Predators', 'active', '', 5),
(50, 'New Jersey Devils', 'active', '', 5),
(51, 'New York Islanders', 'active', '', 5),
(52, 'New York Rangers', 'active', '', 5),
(53, 'Ottawa Senators', 'active', '', 5),
(54, 'Philadelphia Flyers', 'active', '', 5),
(55, 'Pittsburgh Penguins', 'active', '', 5),
(56, 'San Jose Sharks', 'active', '', 5),
(57, 'St. Louis Blues', 'active', '', 5),
(58, 'Tampa Bay Lightning', 'active', '', 5),
(59, 'Toronto Maple Leafs', 'active', '', 5),
(60, 'Vancouver Canucks', 'active', '', 5),
(61, 'Vegas Golden Knights', 'active', '', 5),
(62, 'Washington Capitals', 'active', '', 5),
(63, 'Winnipeg Jets', 'active', '', 5),
(64, 'Akhmat Grozny', 'active', 'Russia', 2),
(65, 'Arsenal Tula', 'active', 'Russia', 2),
(66, 'CSKA Moscow', 'active', 'Russia', 2),
(67, 'Dynamo Moscow', 'active', 'Russia', 2),
(68, 'FC Ural Yekaterinburg', 'active', 'Russia', 2),
(69, 'Krasnodar', 'active', 'Russia', 2),
(70, 'Krylia Sovetov Samara', 'active', 'Russia', 2),
(71, 'Lokomotiv Moscow', 'active', 'Russia', 2),
(72, 'Orenburg', 'active', 'Russia', 2),
(73, 'Rostov', 'active', 'Russia', 2),
(74, 'Rubin Kazan', 'active', 'Russia', 2),
(75, 'Sochi', 'active', 'Russia', 2),
(76, 'Spartak Moscow', 'active', 'Russia', 2),
(77, 'Tambov', 'active', 'Russia', 2),
(78, 'Ufa', 'active', 'Russia', 2),
(79, 'Zenit Saint Petersburg', 'active', 'Russia', 2),
(80, 'Atlanta Hawks', 'active', '', 4),
(81, 'Boston Celtics', 'active', '', 4),
(82, 'Brooklyn Nets', 'active', '', 4),
(83, 'Charlotte Bobcats', 'active', '', 4),
(84, 'Chicago Bulls', 'active', '', 4),
(85, 'Cleveland Cavaliers', 'active', '', 4),
(86, 'Dallas Mavericks', 'active', '', 4),
(87, 'Denver Nuggets', 'active', '', 4),
(88, 'Detroit Pistons', 'active', '', 4),
(89, 'Golden State Warriors', 'active', '', 4),
(90, 'Houston Rockets', 'active', '', 4),
(91, 'Indiana Pacers', 'active', '', 4),
(92, 'LA Clippers', 'active', '', 4),
(93, 'LA Lakers', 'active', '', 4),
(94, 'Memphis Grizzlies', 'active', '', 4),
(95, 'Miami Heat', 'active', '', 4),
(96, 'Milwaukee Bucks', 'active', '', 4),
(97, 'Minnesota Timberwolves', 'active', '', 4),
(98, 'New Orleans Hornets', 'active', '', 4),
(99, 'New York Knicks', 'active', '', 4),
(100, 'Oklahoma City Thunder', 'active', '', 4),
(101, 'Orlando Magic', 'active', '', 4),
(102, 'Philadelphia Sixers', 'active', '', 4),
(103, 'Phoenix Suns', 'active', '', 4),
(104, 'Portland Trail Blazers', 'active', '', 4),
(105, 'Sacramento Kings', 'active', '', 4),
(106, 'San Antonio Spurs', 'active', '', 4),
(107, 'Toronto Raptors', 'active', '', 4),
(108, 'Utah Jazz', 'active', '', 4),
(109, 'Washington Wizards', 'active', '', 4),
(110, 'SV Polizei Hamburg', 'active', '', 6),
(111, 'Frisch Auf Göppingen', 'active', '', 6),
(112, 'Berliner SV 1892', 'active', '', 6),
(113, 'THW Kiel', 'active', '', 6),
(114, 'VfL Gummersbach', 'active', '', 6),
(115, 'SG Leutershausen', 'active', '', 6),
(116, 'Grün-Weiß Dankersen', 'active', '', 6),
(117, 'TV Grosswallstadt', 'active', '', 6),
(118, 'TUSEM Essen', 'active', '', 6),
(119, 'SG Wallau-Massenheim', 'active', '', 6),
(120, 'TBV Lemgo', 'active', '', 6),
(121, 'SC Magdeburg', 'active', '', 6),
(122, 'SG Flensburg-Handewitt', 'active', '', 6),
(123, 'HSV Hamburg', 'active', '', 6),
(124, 'Rhein-Neckar Löwen', 'active', '', 6),
(125, 'Arizona Diamondbacks', 'active', '', 7),
(126, 'Atlanta Braves', 'active', '', 7),
(127, 'Baltimore Orioles', 'active', '', 7),
(128, 'Boston Red Sox', 'active', '', 7),
(129, 'Chicago White Sox', 'active', '', 7),
(130, 'Chicago Cubs', 'active', '', 7),
(131, 'Cincinnati Reds', 'active', '', 7),
(132, 'Cleveland Indians', 'active', '', 7),
(133, 'Colorado Rockies', 'active', '', 7),
(134, 'Detroit Tigers', 'active', '', 7),
(135, 'Houston Astros', 'active', '', 7),
(136, 'Kansas City Royals', 'active', '', 7),
(137, 'Los Angeles Angels', 'active', '', 7),
(138, 'Los Angeles Dodgers', 'active', '', 7),
(139, 'Miami Marlins', 'active', '', 7),
(140, 'Milwaukee Brewers', 'active', '', 7),
(141, 'Minnesota Twins', 'active', '', 7),
(142, 'New York Yankees', 'active', '', 7),
(143, 'New York Mets', 'active', '', 7),
(144, 'Oakland Athletics', 'active', '', 7),
(145, 'Philadelphia Phillies', 'active', '', 7),
(146, 'Pittsburgh Pirates', 'active', '', 7),
(147, 'San Diego Padres', 'active', '', 7),
(148, 'San Francisco Giants', 'active', '', 7),
(149, 'Seattle Mariners', 'active', '', 7),
(150, 'St. Louis Cardinals', 'active', '', 7),
(151, 'Tampa Bay Rays', 'active', '', 7),
(152, 'Texas Rangers', 'active', '', 7),
(153, 'Toronto Blue Jays', 'active', '', 7),
(154, 'Washington Nationals', 'active', '', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `_location_id` (`_location_id`),
  ADD KEY `_sports_id` (`_sport_id`),
  ADD KEY `_team_ida` (`_team_ida`),
  ADD KEY `_team_idb` (`_team_idb`);

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`league_id`),
  ADD KEY `league_sport_id` (`_sport_id`) USING BTREE;

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `team_league_id` (`_league_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `league_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `sport_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `_location_id` FOREIGN KEY (`_location_id`) REFERENCES `locations` (`location_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `_sports_id` FOREIGN KEY (`_sport_id`) REFERENCES `sports` (`sport_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `_team_ida` FOREIGN KEY (`_team_ida`) REFERENCES `teams` (`team_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `_team_idb` FOREIGN KEY (`_team_idb`) REFERENCES `teams` (`team_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `leagues`
--
ALTER TABLE `leagues`
  ADD CONSTRAINT `_sport_id` FOREIGN KEY (`_sport_id`) REFERENCES `sports` (`sport_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `_league_id` FOREIGN KEY (`_league_id`) REFERENCES `leagues` (`league_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
