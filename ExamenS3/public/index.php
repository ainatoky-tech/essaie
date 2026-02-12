<?php
require '../vendor/autoload.php';

$config = require '../app/config/config.php'; 

// Chargement des services (crée la connexion à la base de données)
require '../app/config/services.php';  // ← Ajoute ça

Flight::set('flight.views.path', '../app/views');

require '../app/config/routes.php';

Flight::start(); 