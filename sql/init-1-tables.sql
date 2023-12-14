DROP IF EXISTS TABLE esthorsscene;
DROP IF EXISTS TABLE estsurscene;
DROP IF EXISTS TABLE organise;
DROP IF EXISTS TABLE intervenants;
DROP IF EXISTS TABLE spectacles;
DROP IF EXISTS TABLE festivals;
DROP IF EXISTS TABLE taillescene;
DROP IF EXISTS TABLE categoriefestival;
DROP IF EXISTS TABLE grij;
DROP IF EXISTS TABLE users;

CREATE TABLE users (
    id_login VARCHAR(35) NOT NULL,
    nom VARCHAR(35) NOT NULL,
    prenom VARCHAR(35) NOT NULL,
    email VARCHAR(35) NOT NULL,
    hashed_pwd VARCHAR(35) NOT NULL,
    PRIMARY KEY (id_login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE grij (
    id_grij INTEGER NOT NULL AUTO_INCREMENT,
    heure_deb TIME NOT NULL,
    heure_fin TIME NOT NULL,
    temps_pause TIME NOT NULL,
    PRIMARY KEY (id_grij)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE categoriefestival (
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
    titre VARCHAR(35) NOT NULL,
    description_f TEXT NOT NULL,
    lien_img VARCHAR(35),
    date_deb TIME NOT NULL,
    date_fin TIME NOT NULL,
    id_grij INTEGER NOT NULL,
    id_login VARCHAR(35) NOT NULL,
    id_cat INTEGER NOT NULL,
    FOREIGN KEY (id_grij) REFERENCES grij(id_grij),
    FOREIGN KEY (id_login) REFERENCES users(id_login),
    FOREIGN KEY (id_cat) REFERENCES categoriefestival(id_cat),
    PRIMARY KEY (id_festival)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE spectacles (
    id_spectacle INTEGER NOT NULL AUTO_INCREMENT,
    titre VARCHAR(35) NOT NULL,
    description_s TEXT NOT NULL,
    lien_img VARCHAR(35),
    duree TIME NOT NULL,
    categorie VARCHAR(35),
    id_login VARCHAR(35) NOT NULL,
    id_taille INTEGER NOT NULL,
    FOREIGN KEY (id_login) REFERENCES users(id_login),
    FOREIGN KEY (id_taille) REFERENCES taillescene(id_taille),
    PRIMARY KEY (id_spectacle),
    CONSTRAINT categorie CHECK (categorie IN ('concert', 'pièce de théatre', 'cirque', 'danse', 'projection de film'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE intervenants (
    id_intervenant INTEGER NOT NULL AUTO_INCREMENT,
    nom VARCHAR(35) NOT NULL,
    prenom VARCHAR(35) NOT NULL,
    email VARCHAR(35) NOT NULL,
    PRIMARY KEY key (id_intervenant)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE scenes (
    id_scene INTEGER NOT NULL AUTO_INCREMENT,
    capacite INTEGER NOT NULL,
    GPS POINT NOT NULL,
    id_taille INTEGER NOT NULL,
    FOREIGN KEY (id_taille) REFERENCES taillescene(id_taille),
    PRIMARY KEY (id_scene)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE organise (
    id_festival INTEGER NOT NULL AUTO_INCREMENT,
    id_login VARCHAR(35) NOT NULL,
    FOREIGN KEY (id_login) REFERENCES users(id_login),
    FOREIGN KEY (id_festival) REFERENCES festivals(id_festival),
    PRIMARY KEY(id_festival, id_login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE estsurscene (
    id_intervenant INTEGER NOT NULL AUTO_INCREMENT,
    id_spectacle INTEGER NOT NULL,
    FOREIGN KEY (id_intervenant) REFERENCES intervenants(id_intervenant),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id_spectacle),
    PRIMARY KEY(id_intervenant, id_spectacle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE esthorsscene (
    id_intervenant INTEGER NOT NULL AUTO_INCREMENT,
    id_spectacle INTEGER NOT NULL,
    FOREIGN KEY (id_intervenant) REFERENCES intervenants(id_intervenant),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id_spectacle),
    PRIMARY KEY(id_intervenant, id_spectacle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;