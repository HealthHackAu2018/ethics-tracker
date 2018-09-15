CREATE TABLE `projects` (
  id varchar(100) NOT NULL,
  name varchar(100) NOT NULL,
  type smallint(6) DEFAULT NULL,
  description varchar(1000) DEFAULT NULL,
  lead_investigator varchar(100) DEFAULT NULL,
  status smallint(6) DEFAULT NULL,
  start_date date DEFAULT NULL,
  end_date date DEFAULT NULL,
  completion_date date DEFAULT NULL,
  contact_name varchar(100) DEFAULT NULL,
  contact_email varchar(100) DEFAULT NULL,
  contact_phone varchar(100) DEFAULT NULL,
  report_date date DEFAULT NULL,
  approved_investigators varchar(1000) DEFAULT NULL,
  committee varchar(100) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
