/*
CREATE TABLE users (
    nom
    prenom
    login
    email
    hashed_pwd
);

CREATE TABLE festivals (
    Festival
Un festival regroupe un ensemble de prestations (spectacles) se déroulant sur différents
emplacements dans une zone géographique délimitée. Un festival se déroule sur une période finie
de quelques jours. Un festival est porté par un organisateur du festival pouvant être composé d’une
équipe de personnes. Un festival est caractérisé par :
• un nom
• Une description (1000 caractères max)
• Une illustation optionnelle (une image au format GIF, JPEG ou PNG ayant pour taille max
(800x600))
• Une date de début et une date de fin
• Au moins une catégorie (musique, théatre, cirque, danse, projection de film)
• Une liste de scènes
• Une liste des membres de l’équipe organisatrice
• Une grille journalière de contrainte (GriJ)
• Un responsable du festival (appartenant à la l’équipe organisatrice).
• Une liste de spectacles
);

CREATE TABLE spectacles (
Spectacle
Un spectacle est une prestation de durée limitée se produisant sur une scène du festival et est
caractérisé par :
• Un titre
• Une description (1000 caractères max)
• Une illustation optionnelle (une image au format GIF, JPEG ou PNG ayant pour taille max
(800x600))
• Une durée en minutes
• au moins une catégorie (concert, pièce de théatre, cirque, danse, projection de film)
• Taille de surface de scène requise (petite, moyenne, grande)
• Liste des intervenants sur scène (acteurs, musiciens, danseurs)
• Liste des intervenants hors scène (régisseurs son et lumière, etc.)
• Un responsable du spectacle.
);

CREATE TABLE intervenants (
    Intervenant
Un intervenant est une personne participant à un spectacle sur scène ou hors scène. Un intervenant
est caractérisé par :
• Un nom
• Un prénom
• Une adresse email
)

CREATE TABLE scenes (
    Scène
Une scène est un lieu pouvant accueillir un spectacle du festival. Une scène est caractérisée par :
• Un festival

1

• Un nom
• Une taille (petite, moyenne, grande)
• Un nombre de spectateurs maximum
• les coordonnées GPS de son emplacement
)
*/