-- Création des utilisateurs
INSERT INTO users (id_login, nom, prenom, email, hashed_pwd)
VALUES ("herverous", "Hervé", "ROUS", "herve.rous@gmail.com", "hr");
VALUES ("francksilvestre", "Franck", "SILVESTRE", "franck.silvestre@gmail.com", "fs");

-- Création de la grij
INSERT INTO grij (heure_deb, heure_fin, temps_pause)
VALUES ("08:00:00", "02:00:00", "00:30:00")
VALUES ("10:00:00", "22:00:00", "00:20:00")
VALUES ("18:00:00", "02:00:00", "00:45:00")
VALUES ("06:00:00", "21:00:00", "00:05:00");

-- Création de categorieFestival
INSERT INTO categoriefestival (libelle)
VALUES ("musique")
VALUES ("théatre")
VALUES ("cirque")
VALUES ("danse")
VALUES ("projection de film");

-- Création des tailles de scène
INSERT INTO taillescene (libelle)
VALUES ("petite")
VALUES ("moyenne")
VALUES ("grande");

-- Création des festivals
INSERT INTO festivals (titre, description_f, lien_img date_deb, date_fin, id_grij, id_login, id_cat)
VALUES ("Premier de l'an", "Un premier festival d'exemple.", "f1.png", "01-01-2024", "03-01-2024", 1, 1, 1)
VALUES ("Saint Valentin", "Un deuxieme festival d'exemple.", "f2.png", "14-02-2024", "18-02-2024", 1, 2, 2)
VALUES ("Pomme de terre 2024", "Un troisieme festival d'exemple.", "14-06-2024", "18-06-2024", "f3.png", 1, 3, 3)
VALUES ("Natural Games 2024", "Un quatrieme festival d'exemple.", "26-09-2024", "26-09-2024", "f4.png", 1, 4, 4);

-- Création de spectacles
INSERT INTO spectacles (titre, description_s, lien_img, duree, categorie, id_login, id_taille)
VALUES ("JeChante", "Si vous aimez chanter alors vous chantez ou pas je sais pas.", )
