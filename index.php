<?php 

require_once("config.php");

// $sql = new Sql();

// $usuario = $sql->select("SELECT * FROM TB_USUARIOS");

// echo json_encode($usuario);

$root = new Usuario();

$root->loadById(3);

echo $root;

 ?>