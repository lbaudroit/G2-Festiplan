-- AUTOINCREMENT COMMENCE A 1
-- Création des utilisateurs
INSERT INTO users (id_login, nom, prenom, email, hashed_pwd)
VALUES 
("herverous", "Hervé", "ROUS", "herve.rous@gmal.com", "$2y$10$zWpcvPGM3GQshtYIkAAMg.mSK18iCRXE7NkTATX93Xo5CWIMrePCO"),
("francksilvestre", "Franck", "SILVESTRE", "franck.silvestre@gmal.com", "$2y$10$wm61a8daHRAPpYjg9/Ju.uUI8veLCq2iqx6RGKCm/jZSqwJL2H5i2");

-- Création de la grij
INSERT INTO grij (heure_deb, heure_fin, temps_pause)
VALUES 
("08:00:00", "24:00:00", "00:30:00"),
("10:00:00", "22:00:00", "00:20:00"),
("18:00:00", "24:00:00", "00:45:00"),
("06:00:00", "21:00:00", "00:05:00");

-- Création des categories
INSERT INTO categories (libelle)
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
INSERT INTO festivals (titre, description_f, lien_img, date_deb, date_fin, id_grij, id_login, id_cat)
VALUES 
("Premier de l\'an", "Un premier festival d\'exemple.", ".png", "2024-01-01", "2024-01-03", 1, "herverous", 1),
("Saint Valentin", "Un deuxieme festival d\'exemple.", ".png", "2024-02-14", "2024-02-18", 2, "herverous", 2),
("Pomme de terre 2024", "Un troisieme festival d\'exemple.", ".png", "2024-06-14", "2024-06-18", 3, "herverous", 3),
("Natural Games 2024", "Un quatrieme festival d\'exemple.", ".png", "2024-09-26", "2024-09-29", 4, "herverous", 4);

-- Création de spectacles
INSERT INTO spectacles (titre, description_s, lien_img, duree, id_cat, id_login, id_taille)
VALUES 
("JeChante", "Si vous aimez chanter alors vous chantez ou pas je sais pas.", ".png", "01:40:00", 1, "francksilvestre", 1),
("JActe", "Des gens sur scène.", ".png", "01:40:00", 2, "francksilvestre", 2),
("JeCirque", "Des clowns et des équilibristes (ou pas)", ".png", "01:40:00", 3, "francksilvestre", 2),
("JeDanse", "Des gens qui bougent beaucoup mais c\'est beau.", ".png", "01:40:00", 4, "francksilvestre", 3),
("JeProjette", "Tu t\'assoies et tu regardes...", ".png", "01:40:00", 5, "francksilvestre", 3);

-- Création d'intervenants
INSERT INTO intervenants (nom, prenom, email)
VALUES 
("BARRIOS", "Frederic", "frederic.barrios@gmal.com"),
("SERVIERES", "Corinne", "servieres.corinne@gmal.com"),
("LBATH", "Redouane", "redouane.lbath@gmal.com");

-- Création des scènes
INSERT INTO scenes (capacite, latitude, longitude, nom, id_festival, id_taille)
VALUES
(500, 43.6044622, 1.4442469,'Scène 1', 1, 2),
(1000, 43.6044622, 1.4442469,'Stade', 2, 3),
(50, 43.6044622, 1.4442469,'Petit local', 3, 1),
(600, 43.6044622, 1.4442469,'Scène principale', 4, 2);

-- Création de la table des organisateurs d'un festival
INSERT INTO organise (id_festival,id_login)
VALUES
(1, "francksilvestre"),
(3, "francksilvestre");

-- Crée la table des intervenants sur scène pour un spectacle
INSERT INTO estsurscene (id_intervenant, id_spectacle)
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
INSERT INTO esthorsscene (id_intervenant, id_spectacle)
VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5);