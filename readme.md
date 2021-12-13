# Youtube Library API
Pour pouvoir enregistrer les bibliothèques des utilisateurs, j'ai développé une API en utilisant Symfony et API Platform.

## Mode d'emploi
- Cloner le projet
- Dans le dossier du projet cloné, exécuter la commande ```composer install```
- Créer une base de données qui servira à l'application
- Modifiez les paramètres de la base de donnée dans le fichier .env (lignes 21 à 28, selon votre configuration)
- Puis exécutez les commandes suivantes :
- ```php bin/console doctrine:migrations:migrate``` pour créer les tables dans votre base de données
- ```php bin/console doctrine:fixtures:load``` pour générer les données necessaires.
- Si vous utilisez un serveur local, vous pouvez installer Symfony CLI, et la commande ```symfony serve``` pour pouvoir visualiser l'application.

## Faire appel à l'API
### S'authentifier
Lors de la génération des données en base, un utilisateur de l'API est créé : Il va nous permettre de faire des appels authentifiés à l'API.

Pour configurer les tokens JWT, effectuer la commande ```php bin/console lexik:jwt:generate-keypair```

SI CETTE COMMANDE NE FONCTIONNE PAS, il faut installer Chocolatey (https://chocolatey.org/install), et effectuer la commande ```choco install openssl```.

En envoyant à l'adresse ```/api/login``` avec la méthode POST les données de l'utilisateur dans un objet json tel que ```{"username": "xxx", "password": "xxx"}```, elle renvoie un token JWT.
Celui-ci sera utilisé en tant que Bearer lors des appels à l'API. Il servira pour l'application front.

### Récupérer les id des utilisateurs
L'adresse ```/api/utilisateurs``` renvoie les deux utilisateurs, john et mark. Leur id sera utilisé dans l'application front.