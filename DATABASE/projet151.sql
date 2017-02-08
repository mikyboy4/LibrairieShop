# Database           projet151
# Username           projet151
# Password           projet151
USE projet151;

# Deleting before creating
DROP TABLE IF EXISTS t_order;
DROP TABLE IF EXISTS t_comment;
DROP TABLE IF EXISTS t_book;
DROP TABLE IF EXISTS t_genre;


# Structure of the table t_genre
CREATE TABLE t_genre (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  creation_date DATETIME COMMENT 'INSERT datetime',
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible'
) ENGINE=InnoDB;

# Structure of the table t_book
CREATE TABLE t_book (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(150) NOT NULL,
  overview text NOT NULL,
  author_sex VARCHAR(100) NOT NULL COMMENT 'M=MALE / F=FEMALE',
  author_name VARCHAR(100) NOT NULL,
  author_fname VARCHAR(100) NOT NULL,
  year INT(4) NOT NULL COMMENT 'YYYY',
  price DECIMAL(11, 2) NOT NULL COMMENT 'en CHF',
  img_cover VARCHAR(1000) NOT NULL COMMENT 'image location path',
  edition VARCHAR(100) NOT NULL,
  logistic_qnt INT(11) NOT NULL COMMENT 'état unités en stock',
  FK_genre INT(11) NOT NULL,
  creation_date DATETIME COMMENT 'INSERT datetime',
  modif_date DATETIME COMMENT 'UPDATE datetime',
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible',
  FOREIGN KEY (FK_genre) REFERENCES t_genre(id)
) ENGINE=InnoDB;

CREATE TABLE t_order (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  order_date datetime COMMENT 'INSERT datetime',
  user int(11) NOT NULL,
  status int(11) NOT NULL,
  total_price decimal(11,2) NOT NULL COMMENT 'en CHF',
  deleted int(1) NOT NULL DEFAULT '0' COMMENT '0=visible / 1=invisible',
  bookqnt varchar(512) NOT NULL
) ENGINE=InnoDB;

# Structure of the table t_comment
CREATE TABLE t_comment (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  comment text NOT NULL,
  user INT(11) NOT NULL,
  status INT(1) NOT NULL COMMENT '0=à valider, 1=validé',
  FK_book INT(11) NOT NULL,
  creation_date DATETIME COMMENT 'INSERT datetime',
  validation_date DATETIME COMMENT 'VALIDATION datetime',
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible',
  FOREIGN KEY (FK_book) REFERENCES t_book(id)
) ENGINE=InnoDB;