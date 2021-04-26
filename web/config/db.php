<?php

require_once "env.php";

try {
  $DB = new PDO("pgsql:dbname=$database_name;host=localhost;port=5432;user=$user;password=$password");
} catch (Exception $e) {
  echo "No se pudo conectar a la base de datos, verifica si env.php está correcto";
  throw $e;
}
