	--
	-- Database: `reservation`
	--

	-- --------------------------------------------------------

	--
	-- Table structure for table `admin`
	--

	CREATE TABLE `admin` (
	  `id` int(11) NOT NULL,
	  `name` varchar(255) NOT NULL,
	  `email` varchar(255) NOT NULL,
	  `password` varchar(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	
	ALTER TABLE `admin`
	  ADD PRIMARY KEY (`id`);

	ALTER TABLE `admin`
	  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


	CREATE TABLE `contact` (
	  `id` int(11) NOT NULL,
	  `name` varchar(255) NOT NULL,
	  `email` varchar(255) NOT NULL,
	  `message` varchar(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	
	ALTER TABLE `contact`
	  ADD PRIMARY KEY (`id`);

	ALTER TABLE `contact`
	  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Database: `comics`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comic`
--

CREATE TABLE `comic` (
  `id` int(11) NOT NULL,
  `photo` longblob NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgDesc` varchar(250) NOT NULL,
  `imgCat` varchar(100) NOT NULL,
  `posted` datetime NOT NULL,
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for table `tbl_comic`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_comic`
--
ALTER TABLE `comic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

