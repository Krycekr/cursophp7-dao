<?php 

	require_once("config.php");


	/*$sql = new Sql();

	$usuarios = $sql->select("select * from tb_usuarios");

	echo json_encode($usuarios);*/



	// $root = new Usuario(); //buca por id

	// $root->loadById(4);

	// echo $root;




	// Daqui pra frente carrega uma lista de usuarios

	//$lista = Usuario::getList();

	//echo json_encode($lista);

	// Daqui pra trás carrega uma lista de usuarios



	// Carrega uma lista de users buscando pelo login

	//$search = Usuario::search("A");

	//echo json_encode($search);
	// FIM Carrega uma lista de users buscando pelo login


	// busca um susuario com os parametros de user e password
	// $usuario = new Usuario();


	// $usuario->login("joao","888888");

	// echo $usuario;
	//fim busca um susuario com os parametros de user e password

	$aluno = new Usuario();

	$aluno->setDeslogin("aluno");
	$aluno->setDessenha("@aluno");

	$aluno->insert();

	echo $aluno;


 ?>