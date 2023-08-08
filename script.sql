###########################################################################
# Script by OtikNetwork                     
###########################################################################

#

# Create new user otikadmin and set password
GRANT ALL PRIVILEGES ON *.* TO 'otikuser'@localhost IDENTIFIED BY 'Love@OtikNetWork';

# Remove empty user and root remote login
DELETE FROM mysql.user WHERE User=''; 
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';

# Set new password for user "root"
UPDATE mysql.user SET authentication_string = PASSWORD('Love@OtikNetWork') WHERE User = 'root' AND Host = 'localhost';

# reload permission
FLUSH PRIVILEGES;

# Create new database name "otikdb" with support utf8 (Thai Language)
CREATE DATABASE otikdb character set utf8;


USE otikdb;

#
# Table structure for table 'tbl_master_radacct'
#

CREATE TABLE IF NOT EXISTS tbl_master_radacct (
  radacctid bigint(21) NOT NULL auto_increment,
  acctsessionid varchar(64) NOT NULL default '',
  acctuniqueid varchar(32) NOT NULL default '',
  username varchar(64) NOT NULL default '',
  realm varchar(64) default '',
  nasipaddress varchar(15) NOT NULL default '',
  nasportid varchar(15) default NULL,
  nasporttype varchar(32) default NULL,
  acctstarttime datetime NULL default NULL,
  acctupdatetime datetime NULL default NULL,
  acctstoptime datetime NULL default NULL,
  acctinterval int(12) default NULL,
  acctsessiontime int(12) unsigned default NULL,
  acctauthentic varchar(32) default NULL,
  connectinfo_start varchar(50) default NULL,
  connectinfo_stop varchar(50) default NULL,
  acctinputoctets bigint(20) default NULL,
  acctoutputoctets bigint(20) default NULL,
  calledstationid varchar(50) NOT NULL default '',
  callingstationid varchar(50) NOT NULL default '',
  acctterminatecause varchar(32) NOT NULL default '',
  servicetype varchar(32) default NULL,
  framedprotocol varchar(32) default NULL,
  framedipaddress varchar(15) NOT NULL default '',
  framedipv6address varchar(45) NOT NULL default '',
  framedipv6prefix varchar(45) NOT NULL default '',
  framedinterfaceid varchar(44) NOT NULL default '',
  delegatedipv6prefix varchar(45) NOT NULL default '',
  PRIMARY KEY (radacctid),
  UNIQUE KEY acctuniqueid (acctuniqueid),
  KEY username (username),
  KEY framedipaddress (framedipaddress),
  KEY framedipv6address (framedipv6address),
  KEY framedipv6prefix (framedipv6prefix),
  KEY framedinterfaceid (framedinterfaceid),
  KEY delegatedipv6prefix (delegatedipv6prefix),
  KEY acctsessionid (acctsessionid),
  KEY acctsessiontime (acctsessiontime),
  KEY acctstarttime (acctstarttime),
  KEY acctinterval (acctinterval),
  KEY acctstoptime (acctstoptime),
  KEY nasipaddress (nasipaddress)
) ENGINE = INNODB;

#
# Table structure for table 'tbl_master_radcheck'
#

CREATE TABLE IF NOT EXISTS tbl_master_radcheck (
  id int(11) unsigned NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  attribute varchar(64)  NOT NULL default '',
  op char(2) NOT NULL DEFAULT '==',
  value varchar(253) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY username (username(32))
);

#
# Table structure for table 'tbl_master_radgroupcheck'
#

CREATE TABLE IF NOT EXISTS tbl_master_radgroupcheck (
  id int(11) unsigned NOT NULL auto_increment,
  groupname varchar(64) NOT NULL default '',
  attribute varchar(64)  NOT NULL default '',
  op char(2) NOT NULL DEFAULT '==',
  value varchar(253)  NOT NULL default '',
  PRIMARY KEY  (id),
  KEY groupname (groupname(32))
);

#
# Table structure for table 'tbl_master_radgroupreply'
#

CREATE TABLE IF NOT EXISTS tbl_master_radgroupreply (
  id int(11) unsigned NOT NULL auto_increment,
  groupname varchar(64) NOT NULL default '',
  attribute varchar(64)  NOT NULL default '',
  op char(2) NOT NULL DEFAULT '=',
  value varchar(253)  NOT NULL default '',
  PRIMARY KEY  (id),
  KEY groupname (groupname(32))
);

#
# Table structure for table 'tbl_master_radreply'
#

CREATE TABLE IF NOT EXISTS tbl_master_radreply (
  id int(11) unsigned NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  attribute varchar(64) NOT NULL default '',
  op char(2) NOT NULL DEFAULT '=',
  value varchar(253) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY username (username(32))
);


#
# Table structure for table 'tbl_master_radusergroup'
#

CREATE TABLE IF NOT EXISTS tbl_master_radusergroup (
  id int(11) unsigned NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  groupname varchar(64) NOT NULL default '',
  priority int(11) NOT NULL default '1',
  PRIMARY KEY  (id),
  KEY username (username(32))
);

#
# Table structure for table 'tbl_master_radpostauth'
#
CREATE TABLE IF NOT EXISTS tbl_master_radpostauth (
  id int(11) NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  pass varchar(64) NOT NULL default '',
  reply varchar(32) NOT NULL default '',
  authdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (id),
  KEY username (username(32))
) ENGINE = INNODB;

#
# Table structure for table 'tbl_master_nas'
#
CREATE TABLE IF NOT EXISTS tbl_master_nas (
  id int(10) NOT NULL auto_increment,
  nasname varchar(128) NOT NULL,
  shortname varchar(32),
  type varchar(30) DEFAULT 'other',
  ports int(5),
  secret varchar(60) DEFAULT 'secret' NOT NULL,
  server varchar(64),
  community varchar(50),
  description varchar(200) DEFAULT 'RADIUS Client',
  PRIMARY KEY (id),
  KEY nasname (nasname)
);
CREATE TABLE IF NOT EXISTS tbl_trans_account (
  acID int(20) NOT NULL AUTO_INCREMENT,
  pfID int(20) NOT NULL,
  acUser varchar(13) NOT NULL,
  acPassWd varchar(13) NOT NULL,
  tNote varchar(50) NULL,
  acStatus int(1) NOT NULL,
  WhoCreate varchar(50) NOT NULL,
  DateCreate datetime DEFAULT NULL,
  WhoUpdate varchar(50) DEFAULT NULL,
  DateUpdate datetime DEFAULT NULL,
  PRIMARY KEY (acID)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS tbl_master_administrator (
  uID int(11) NOT NULL AUTO_INCREMENT,
  uUserName varchar(100) NOT NULL,
  uPasswd varchar(100) NOT NULL,
  uFullName varchar(100) NOT NULL,
  uGrpID int(10) DEFAULT NULL,
  uPersProfile int(1) NOT NULL,
  uPersAccount int(1) NOT NULL,
  uPersReports int(1) NOT NULL,
  uPersOnline int(1) NOT NULL,
  uStatus int(1) NOT NULL,
  uCrtDate datetime NOT NULL,
  uUpdDate datetime NOT NULL,
  uDep varchar(100) DEFAULT NULL,
  uPicture varchar(100) DEFAULT NULL,
  uEmail varchar(50) DEFAULT NULL,
  uAddress varchar(255) DEFAULT NULL,
  PRIMARY KEY (uID)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

LOCK TABLES tbl_master_administrator WRITE;
INSERT INTO tbl_master_administrator VALUES (1,'amnuay','ee10d403452291ec7d888b0c0d8b5a8d','อำนวย ปิ่นทอง',1,0,0,0,0,1,'2017-09-06 00:00:00','2017-11-05 16:18:32','IT',NULL,'amnuay@otiknetwork.com','Bangkok Thailand'),(44,'sysadmin','48a365b4ce1e322a55ae9017f3daf0c0','SystemAdministrator',NULL,1,1,1,1,1,'2017-11-05 15:31:48','2017-11-05 15:49:42','AUTO','','sysadmin@gmail.com','');
UNLOCK TABLES;


CREATE TABLE IF NOT EXISTS tbl_master_cui (
  clientipaddress varchar(15) NOT NULL,
  callingstationid varchar(50) NOT NULL,
  username varchar(64) NOT NULL,
  cui varchar(32) NOT NULL,
  creationdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  lastaccounting timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (username, clientipaddress, callingstationid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS tbl_master_profiles (
  pfID int(20) NOT NULL AUTO_INCREMENT,
  pfName varchar(100) NOT NULL,
  pfSpeedLimitUp varchar(20) DEFAULT NULL,
  pfSpeedLimitDown varchar(20) DEFAULT NULL,
  pfAddressList varchar(50) DEFAULT NULL,
  pfUrlRedirect varchar(100) DEFAULT NULL,
  pfShareUsers varchar(50) NOT NULL,
  pfSessionTimout varchar(50) DEFAULT NULL,
  pfIdleTimeout varchar(50) DEFAULT NULL,
  pfUptime varchar(50) DEFAULT NULL,
  pfValidity varchar(50) DEFAULT NULL,
  pfStatus varchar(50) NOT NULL,
  WhoCreate varchar(50) DEFAULT NULL,
  DateCreate datetime DEFAULT NULL,
  WhoUpdate varchar(50) DEFAULT NULL,
  DateUpdate datetime DEFAULT NULL,
  pfPriority int(1) NOT NULL,
  pfPrice float DEFAULT NULL,
  PRIMARY KEY (pfID)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Create setting maser table for option

CREATE TABLE IF NOT EXISTS tbl_master_setting (
  id int(11) NOT NULL,
  sOption1 varchar(100) DEFAULT NULL,
  sOption2 varchar(100) DEFAULT NULL,
  sOption3 varchar(100) DEFAULT NULL,
  iOption1 int(6) DEFAULT NULL,
  iOption2 int(6) DEFAULT NULL,
  iOption3 int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tbl_master_setting
  ADD PRIMARY KEY (id);

ALTER TABLE tbl_master_setting
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


ALTER TABLE tbl_master_setting ADD sOption4 VARCHAR(50) NULL AFTER sOption3, ADD sOption5 VARCHAR(50) NULL AFTER sOption4, ADD sOption6 VARCHAR(50) NULL AFTER sOption5;

ALTER TABLE tbl_master_setting ADD sOption7 VARCHAR(50) NULL AFTER sOption6;