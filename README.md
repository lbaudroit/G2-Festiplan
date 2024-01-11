# Festiplan
Ce projet consiste en la création d'un site web permettant aux utilisateur de planifier leurs évènements culturels. Il permettra de créer des spectacles et les festivaux dans lesquels ils se dérouleront, puis de générer une planification du festival de sorte à éviter aux organisateurs l'effort de gérer les différentes scènes disponibles, artistes présents, etc...

## Equipe
BUT Info 2 - G2

| Etudiant | Login | Email | Rôle |
|----------|------|------|-----|
| BAUDROIT Leïla | lbaudroit  | leila.baudroit@iut-rodez.fr | Product Owner ité3 |
| BOYER Djedline | djedline   | djedline.boyer@iut-rodez.fr | Product Owner ité2, Scrum Master ité3 |
| BRIOT Nael     | AurorAkali | nael.briot@iut-rodez.fr | Product Owner ité1 |
| CATALA-BAILLY Tany | LesaintLineon | tany.catalabailly@iut-rodez.fr | Scrum Master ité2 |
| CHEIKH-BOUKAL Léo | Leptar | leo.cheikh-boukal@iut-rodez.fr | Scrum Master ité1 |
 
**Board agile :** https://github.com/users/lbaudroit/projects/3
**Documents du projet :** //TODO

## Commandes d'exécution du projet

Pour lancer en dev :
`docker compose --profile dev up -d`
`docker-compose exec dev-website composer update`

En cas de problème avec le serveur de base de données, utiliser plutôt
`docker compose build`
`docker compose --profile dev-db up -d`

Adresse du site web : localhost:9999/
Adresse de PHPmyAdmin : localhost:8888
