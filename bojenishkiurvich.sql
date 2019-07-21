SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

create table if not exists `amenities` (
  `amen_id` int(100) not null AUTO_INCREMENT,
  `amen_name` varchar(100) not null,
  `amen_desp` varchar(100) not null,
  `amen_image` varchar(100) not null,
  primary key (`amen_id`)
) ENGINE=MyISAM  default CHARSET=latin1 AUTO_INCREMENT=18 ;

create table if not exists `guest` (
  `guest_id` int(30) not null AUTO_INCREMENT,
  `firstname` varchar(30) not null,
  `lastname` varchar(30) not null,  
  `city` varchar(30) not null,
  `address` varchar(30) not null,  
  `phone` varchar(30) not null,
  `email` varchar(30) not null,  
  primary key (`guest_id`)
) ENGINE=MyISAM  default CHARSET=latin1 AUTO_INCREMENT=40 ;

create table if not exists `reservation` (
  `reservation_id` int(11) not null AUTO_INCREMENT,
  `roomNo` int(50) not null,
  `guest_id` int(11) not null,
  `arrival` varchar(30) not null,
  `departure` varchar(30) not null,  
  `payable` int(11) not null,
  `status` varchar(10) not null default 'pending',
  `booked` date not null,
  `confirmation` varchar(20) not null,
  primary key (`reservation_id`)
) ENGINE=MyISAM  default CHARSET=latin1 AUTO_INCREMENT=21 ;

create table if not exists `room` ( 
  `roomNo` int(50) not null AUTO_INCREMENT,
  `typeID` int(50) not null,
  `roomName` varchar(50) not null,
  `price` varchar(50) not null,  
  `roomImage` varchar(200) default null,
  primary key (`roomNo`)
) ENGINE=MyISAM  default CHARSET=latin1 AUTO_INCREMENT=11 ;

create table if not exists `roomtype` (
  `typeID` int(50) not null AUTO_INCREMENT,
  `typename` varchar(50) not null,
  `Desp` text not null,
  primary key (`typeID`)
) ENGINE=MyISAM  default CHARSET=latin1 AUTO_INCREMENT=93 ;

create table if not exists `useraccounts` (
  `ACCOUNT_ID` int(11) not null AUTO_INCREMENT,
  `ACCOUNT_NAME` varchar(255) not null,
  `ACCOUNT_USERNAME` varchar(255) not null,
  `ACCOUNT_PASSWORD` text not null,
  `ACCOUNT_TYPE` varchar(30) not null,
  primary key (`ACCOUNT_ID`)
) ENGINE=InnoDB  default CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`) VALUES
(1, 'Bojenishki Urvich', 'bojenishkiurvich@abv.bg', '645ef42ed9ab33b0a2ee5ff04d1066fee58a68a5', 'Administrator');

-- 645ef42ed9ab33b0a2ee5ff04d1066fee58a68a5 - m4n4ger
