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

Créez la base de données et exécutez les migrations :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Utilisation
Pour démarrer le serveur de développement, utilisez la commande suivante :
symfony server:start

Accédez à l'application dans votre navigateur à l'adresse http://127.0.0.1:8000.

Utilisation de MailDev
Pour tester l'envoi d'e-mails en environnement de développement, nous utilisons MailDev. Suivez les étapes ci-dessous pour configurer et utiliser MailDev :

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
