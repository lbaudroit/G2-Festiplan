-- AUTOINCREMENT COMMENCE A 1
-- Création des utilisateurs
INSERT INTO users (id_login, nom, prenom, email, hashed_pwd)
VALUES 
("herverous", "Hervé", "ROUS", "herve.rous@gmal.com", "hr"),
("francksilvestre", "Franck", "SILVESTRE", "franck.silvestre@gmal.com", "fs");

-- Création de la grij
INSERT INTO grij (heure_deb, heure_fin, temps_pause)
VALUES 
("08:00:00", "02:00:00", "00:30:00"),
("10:00:00", "22:00:00", "00:20:00"),
("18:00:00", "02:00:00", "00:45:00"),
("06:00:00", "21:00:00", "00:05:00");

-- Création de categorieFestival
INSERT INTO categoriefestival (libelle)
VALUES
("musique"),
("théatre"),
("cirque"),
("danse"),
("projection de film");

-- Création des tailles de scène
INSERT INTO taillescene (libelle)
VALUES
("petite"),
("moyenne"),
("grande");

-- Création des festivals
INSERT INTO festivals (titre, description_f, lien_img date_deb, date_fin, id_grij, id_login, id_cat)
VALUES 
("Premier de l'an", "Un premier festival d'exemple.", "f1.png", "01-01-2024", "03-01-2024", 1, 1, 1),
("Saint Valentin", "Un deuxieme festival d'exemple.", "f2.png", "14-02-2024", "18-02-2024", 2, 1, 2),
("Pomme de terre 2024", "Un troisieme festival d'exemple.", "14-06-2024", "18-06-2024", "f3.png", 3, 1, 3),
("Natural Games 2024", "Un quatrieme festival d'exemple.", "26-09-2024", "26-09-2024", "f4.png", 4, 1, 4);

-- Création de spectacles
INSERT INTO spectacles (titre, description_s, lien_img, duree, id_cat, id_login, id_taille)
VALUES 
("JeChante", "Si vous aimez chanter alors vous chantez ou pas je sais pas.", "s1.png", "00:01:40", 1, 2, 1),
("JActe", "Des gens sur scène.", "s1.png", "00:01:40", 2, 2, 2),
("JeCirque", "Des clowns et des équilibristes (ou pas)", "s1.png", "00:01:40", 3, 2, 2),
("JeDanse", "Des gens qui bougent beaucoup mais c'est beau.", "s1.png", "00:01:40", 4, 2, 3),
("JeProjette", "Tu t'assoies et tu regardes...", "s1.png", "00:01:40", 5, 2, 3);

-- Création d'intervenants
INSERT INTO intervenants (nom, prenom, email)
VALUES 
("BARRIOS", "frederic", "frederic.barrios@gmal.com"),
("SERVIERES", "Corinne", "servieres.corinne@gmal.com"),
("LBATH", "Redouane", "redouane.lnbath@gmal.com");

-- Création des scènes
INSERT INTO scenes (capacite, GPS, id_taille)
VALUES
(500, POINT(43.6044622,1.4442469), 2),
(1000, POINT(43.6044622,1.4442469), 3),
(50, POINT(43.6044622,1.4442469), 1),
(600, POINT(43.6044622,1.4442469), 2),
(900, POINT(43.6044622,1.4442469), 3);

-- Création de la table des organisateurs d'un festival
INSERT INTO organise (id_festival,id_login)
VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(1, 2),
(3, 2);

-- Crée la table des intervenants sur scène pour un spectacle
INSERT INTO TABLE estsurscene (id_intervenant, id_spectacle)
VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4),
(1, 5),
(2, 5);

-- Crée la table des intervenants hors scène pour un spectacle
INSERT INTO TABLE esthorsscene (id_intervenant, id_spectacle)
VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5);