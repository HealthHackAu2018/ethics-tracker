CREATE TABLE `users` (
  username varchar(100) NOT NULL,
  fullname varchar(100) DEFAULT NULL,
  password varchar(100) DEFAULT NULL,
  project_list varchar(1000) DEFAULT NULL,
  PRIMARY KEY (username)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;
