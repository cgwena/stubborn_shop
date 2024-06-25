Introduction
Bienvenue dans notre application Symfony! Ce projet est conçu pour gérer un site de e-commerce. Ce document vous guidera à travers les étapes de configuration et d'utilisation de l'application.

Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

PHP 7.4 ou supérieur
Composer
MySQL ou PostgreSQL
Node.js et npm (pour la gestion des assets)
Symfony CLI (optionnel mais recommandé)
MailDev (installé via Composer)
Installation
Suivez les étapes ci-dessous pour installer et configurer l'application :

Clonez le dépôt depuis GitHub :
git clone https://github.com/cgwena/stubborn_shop.git

Accédez au répertoire du projet :
cd votre-repo

Installez les dépendances PHP via Composer :
composer install

Créez un fichier .env.local à partir du fichier .env et configurez vos variables d'environnement, notamment la connexion à la base de données :
cp .env .env.local

Ensuite, éditez le fichier .env.local pour définir les paramètres de connexion à la base de données, par exemple :
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

Créez la base de données et exécutez les migrations :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Installez les dépendances JavaScript et compilez les assets :
npm install
npm run dev

Utilisation
Pour démarrer le serveur de développement, utilisez la commande suivante :
symfony server:start

Accédez à l'application dans votre navigateur à l'adresse http://127.0.0.1:8000.

Utilisation de MailDev
Pour tester l'envoi d'e-mails en environnement de développement, nous utilisons MailDev. Suivez les étapes ci-dessous pour configurer et utiliser MailDev :

Installez MailDev via Composer :
composer require maildev/maildev
Configurez Symfony pour utiliser MailDev en ajoutant ou modifiant les lignes suivantes dans votre fichier .env.local :
MAILER_DSN=smtp://localhost:1025

Lancez MailDev en utilisant la commande suivante :
vendor/bin/maildev

Accédez à l'interface de MailDev pour visualiser les e-mails envoyés par l'application :
Ouvrez votre navigateur et accédez à http://localhost:1080.

Documentation de l'API
La documentation de l'API est disponible à l'adresse suivante : http://127.0.0.1:8000/api/doc

Tests
Initialisation des Fixtures
Avant d'exécuter les tests, vous devez charger les fixtures pour initialiser les données de test. Utilisez la commande suivante :
php bin/console doctrine:fixtures:load --env=test

Exécution des Tests
Pour exécuter les tests, utilisez la commande suivante :
php bin/phpunit
