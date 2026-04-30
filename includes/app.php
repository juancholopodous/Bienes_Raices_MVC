<?php
require __DIR__ . '/../vendor/autoload.php'; // Agrega automaticamente las clases en este app.php

use Dotenv\Dotenv;
use Model\ActiveRecord;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
//$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';

// Conectar a la base de datos
$db = conectarDB();


//como es un atributo estatico NO requiere instanciarse
ActiveRecord::setDB($db);
