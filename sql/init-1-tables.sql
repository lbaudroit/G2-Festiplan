DROP TABLE IF EXISTS esthorsscene;
DROP TABLE IF EXISTS estsurscene;
DROP TABLE IF EXISTS organise;
DROP TABLE IF EXISTS scenes;
DROP TABLE IF EXISTS intervenants;
DROP TABLE IF EXISTS spectacles;
DROP TABLE IF EXISTS festivals;
DROP TABLE IF EXISTS taillescene;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS grij;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id_login VARCHAR(35) NOT NULL,
    nom VARCHAR(35) NOT NULL,
    prenom VARCHAR(35) NOT NULL,
    email VARCHAR(35) NOT NULL,
    hashed_pwd VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE grij (
    id_grij INTEGER NOT NULL AUTO_INCREMENT,
    heure_deb TIME NOT NULL,
    heure_fin TIME NOT NULL,
    temps_pause TIME NOT NULL,
    PRIMARY KEY (id_grij)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE categories (
    id_cat INTEGER NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(35) NOT NULL,
    PRIMARY KEY (id_cat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE taillescene (
    id_taille INTEGER NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(35) NOT NULL,
    PRIMARY KEY (id_taille)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE festivals (
    id_festival INTEGER NOT NULL AUTO_INCREMENT,
    titre VARCHAR(100) NOT NULL,
    description_f TEXT NOT NULL,
    lien_img VARCHAR(35),
    date_deb DATE NOT NULL,
    date_fin DATE NOT NULL,
    id_grij INTEGER NOT NULL,
    id_login VARCHAR(35) NOT NULL,
    id_cat INTEGER NOT NULL,
    FOREIGN KEY (id_grij) REFERENCES grij(id_grij),
    FOREIGN KEY (id_login) REFERENCES users(id_login),
    FOREIGN KEY (id_cat) REFERENCES categorie(id_cat),
    PRIMARY KEY (id_festival)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE spectacles (
    id_spectacle INTEGER NOT NULL AUTO_INCREMENT,
    titre VARCHAR(100) NOT NULL,
    description_s TEXT NOT NULL,
    lien_img VARCHAR(35),
    duree TIME NOT NULL,
    id_cat INTEGER,
    id_login VARCHAR(35) NOT NULL,
    id_taille INTEGER NOT NULL,
    FOREIGN KEY (id_login) REFERENCES users(id_login),
    FOREIGN KEY (id_taille) REFERENCES taillescene(id_taille),
    FOREIGN KEY (id_cat) REFERENCES categorie(id_cat),
    PRIMARY KEY (id_spectacle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE intervenants (
    id_intervenant INTEGER NOT NULL AUTO_INCREMENT,
    nom VARCHAR(35) NOT NULL,
    prenom VARCHAR(35) NOT NULL,
    email VARCHAR(35) NOT NULL,
    PRIMARY KEY (id_intervenant)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE scenes (
    id_scene INTEGER NOT NULL AUTO_INCREMENT,
    capacite INTEGER NOT NULL,
    longitude DOUBLE NOT NULL,
    latitude DOUBLE NOT NULL,
    id_festival INTEGER NOT NULL,
    id_taille INTEGER NOT NULL,
    nom VARCHAR(35) NOT NULL,
    FOREIGN KEY (id_festival) REFERENCES festivals(id_festival),
    FOREIGN KEY (id_taille) REFERENCES taillescene(id_taille),
    PRIMARY KEY (id_scene)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE organise (
    id_festival INTEGER NOT NULL,
    id_login VARCHAR(35) NOT NULL,
    FOREIGN KEY (id_login) REFERENCES users(id_login),
    FOREIGN KEY (id_festival) REFERENCES festivals(id_festival),
    PRIMARY KEY(id_festival, id_login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE estsurscene (
    id_intervenant INTEGER NOT NULL,
    id_spectacle INTEGER NOT NULL,
    FOREIGN KEY (id_intervenant) REFERENCES intervenants(id_intervenant),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id_spectacle),
    PRIMARY KEY(id_intervenant, id_spectacle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE esthorsscene (
    id_intervenant INTEGER NOT NULL,
    id_spectacle INTEGER NOT NULL,
    FOREIGN KEY (id_intervenant) REFERENCES intervenants(id_intervenant),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id_spectacle),
    PRIMARY KEY(id_intervenant, id_spectacle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE contient (
    id_festival INTEGER NOT NULL,
    id_spectacle INTEGER NOT NULL,
    FOREIGN KEY (id_festival) REFERENCES festivals(id_festival),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id_spectacle),
    PRIMARY KEY(id_festival, id_spectacle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE planifie (
    id_scene INTEGER NOT NULL,
    id_spectacle INTEGER NOT NULL,
    date_spectacle DATE NOT NULL,
    heure_deb TIME NOT NULL,
    FOREIGN KEY (id_scene) REFERENCES scenes(id_scene),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id_spectacle),
    PRIMARY KEY(id_festival, id_spectacle)
)