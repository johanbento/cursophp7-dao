<?php 

require_once("config.php");

// $sql = new Sql();

// $usuario = $sql->select("SELECT * FROM TB_USUARIOS");

// echo json_encode($usuario);


// Carrega um usuário
// $root = new Usuario();
// $root->loadById(3);
// echo $root;

// Carrega uma lista de usuários
// $lista = Usuario::getList();
// echo json_encode($lista);

// Carrega uma lista de usuários buscando pelo login
// $search = Usuario::search("jo");
// echo json_encode($search);

// Carrega um usuario usando o login e a senha
$usuario = new Usuario();
$usuario->login("root", "root");
echo $usuario;

 ?>