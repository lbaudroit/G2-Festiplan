Pour lancer en dev :
`docker compose --profile dev up -d`
`docker-compose exec dev-website composer update`

En cas de problème avec le serveur de base de données, utiliser plutôt
`docker compose build`
`docker compose --profile dev-db up -d`

Adresse de la BDD : saccharun.fr:6612
Adresse du site web : localhost:9999/festiplan/
Adresse de PHPmyAdmin : localhost:8888
