# Base de données    projet151
# Username           projet151
# Password           projet151
USE projet151;

# Supprimer tables avant de recréer
DROP TABLE IF EXISTS t_order;
DROP TABLE IF EXISTS t_book;
DROP TABLE IF EXISTS t_genre;


# Structure de la table t_genre
CREATE TABLE t_genre (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  creation_date DATETIME NOT NULL DEFAULT NOW() COMMENT 'INSERT datetime',
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible'
) ENGINE=InnoDB;

# Structure de la table t_book
CREATE TABLE t_book (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(150) NOT NULL,
  overview text NOT NULL,
  author_sex VARCHAR(100) NOT NULL COMMENT 'M=MALE / F=FEMALE',
  author_name VARCHAR(100) NOT NULL,
  author_fname VARCHAR(100) NOT NULL,
  year INT(4) NOT NULL COMMENT 'YYYY',
  price FLOAT(11) NOT NULL COMMENT 'en CHF',
  img_cover VARCHAR(1000) NOT NULL COMMENT 'image location path',
  edition VARCHAR(100) NOT NULL,
  logistic_qnt INT(11) NOT NULL COMMENT 'état unités en stock',
  FK_genre INT(11) NOT NULL,
  creation_date DATETIME NOT NULL DEFAULT NOW() COMMENT 'INSERT datetime',
  modif_date DATETIME NOT NULL DEFAULT NOW() COMMENT 'UPDATE datetime',
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible',
  FOREIGN KEY (FK_genre) REFERENCES t_genre(id)
) ENGINE=InnoDB;

# Structure de la table t_order
CREATE TABLE t_order (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  order_date DATETIME NOT NULL DEFAULT NOW() COMMENT 'INSERT datetime',
  user INT(11) NOT NULL,
  qnt INT (11) NOT NULL,
  status INT(11) NOT NULL,
  TVA FLOAT(11) NOT NULL COMMENT 'en %',
  total_price FLOAT(11) NOT NULL COMMENT 'en CHF',
  FK_book INT(11) NOT NULL,
  deleted INT(1) NOT NULL DEFAULT 0 COMMENT '0=visible / 1=invisible',
  FOREIGN KEY (FK_book) REFERENCES t_book(id)
) ENGINE=InnoDB;