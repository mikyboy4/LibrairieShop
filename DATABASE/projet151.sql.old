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
  creation_date DATETIME NOT NULL DEFAULT NOW() COMMENT 'INSERT datetime',
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

# Structure of the table t_order
CREATE TABLE t_order (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  order_date DATETIME NOT NULL DEFAULT NOW() COMMENT 'INSERT datetime',
  user INT(11) NOT NULL,
  qnt INT (11) NOT NULL,
  status INT(11) NOT NULL,
  TVA DECIMAL(11) NOT NULL COMMENT 'en %',
  total_price DECIMAL(11, 2) NOT NULL COMMENT 'en CHF',
  creation_date DATETIME COMMENT 'INSERT datetime',
  delivery_date DATETIME COMMENT 'livraison datetime',
  FK_book INT(11) NOT NULL,
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible',
  FOREIGN KEY (FK_book) REFERENCES t_book(id)
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