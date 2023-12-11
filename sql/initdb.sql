CREATE TABLE users (
    'id_login' VARCHAR(35) NOT NULL,
    'nom' VARCHAR(35) NOT NULL,
    'prenom' VARCHAR(35) NOT NULL,
    'email' VARCHAR(35) NOT NULL,
    'hashed_pwd' VARCHAR(35) NOT NULL,
    Primary key (id_login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE festivals (
    'id_grij' INTEGER NOT NULL,
    'date_deb' TIME NOT NULL,
    'date_fin' TIME NOT NULL,
    'temps_pause' TIME NOT NULL,
    Primary key (id_grij)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE spectacles (
    'id_spectacle' INTEGER NOT NULL,
    'titre' VARCHAR(35) NOT NULL,
    'desc' TEXT NOT NULL,
    'lien_img' VARCHAR(35),
    'duree' TIME NOT NULL,
    'categorie' VARCHAR(35),
    Primary key (id_spectacle),
    CONSTRAINT categorie CHECK (categorie IN ('concert', 'pièce de théatre', 'cirque', 'danse', 'projection de film'))
);

CREATE TABLE intervenants (
    'id_intervenant' INTEGER NOT NULL,
    'nom' VARCHAR(35) NOT NULL,
    'prenom' VARCHAR(35) NOT NULL,
    'email' VARCHAR(35) NOT NULL,
    Primary key (id_intervenant)
);

CREATE TABLE scenes (
    'id_scene' INTEGER NOT NULL,
    'capacite' INTEGER NOT NULL,
    'GPS' POINT NOT NULL,
    Primary key (id_scene)
);

CREATE TABLE taillescene (
    'id_taille' INTEGER NOT NULL,
    'libelle' VARCHAR(35) NOT NULL,
    Primary key (id_taille)
);

CREATE TABLE categoriefestival (
    'id_cat' INTEGER NOT NULL,
    'libelle' VARCHAR(35) NOT NULL,
    Primary key (id_cat)
);

CREATE TABLE grij (
    'id_grij' INTEGER NOT NULL,
    'heure_deb' TIME NOT NULL,
    'heure_fin' TIME NOT NULL,
    'temps_pause' TIME NOT NULL,
    Primary key (id_grij)
);

CREATE TABLE organise (

);

CREATE TABLE estsurscene (

);

CREATE TABLE esthorsscene (

);