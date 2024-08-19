#!/bin/bash

# Lancement de maildev
echo "Starting Maildev..."
maildev &

# Attendre quelques secondes pour s'assurer que Maildev est bien démarré
sleep 2

# Exécution des tests
echo "Running PHPUnit tests..."
php bin/phpunit



# Vérification du statut des tests
if [ $? -eq 0 ]; then
    echo "Tests passed. Starting the Symfony server..."
    symfony server:start
else
    echo "Tests failed. Server not started."
fi