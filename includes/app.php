<?php 
require 'funciones.php';
require 'config/database.php';
require __DIR__.'/../vendor/autoload.php'; // Agrega automaticamente las clases en este app.php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Conectar a la base de datos
$db = conectarDB();

use Model\ActiveRecord;

//como es un atributo estatico NO requiere instanciarse
ActiveRecord::setDB($db);