<?php 

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;


		public function getIdusuario(){
			return $this->idusuario;
		}
		public function setIdusuario($value){
			$this->idusuario = $value;
		}
		public function getDeslogin(){
			return $this->deslogin;
		}
		public function setDeslogin($value){
			$this->deslogin = $value;
		}
		public function getDessenha(){
			return $this->dessenha;
		}
		public function setDessenha($value){
			$this->dessenha = $value;
		}
		public function getDtcadastro(){
			return $this->dtcadastro;
		}
		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}

		public function loadById($id){
			$sql = new Sql();

			$results = $sql->select("select * from tb_usuarios where idusuario = :ID", array(
				":ID"=>$id));

			if(count($results)>0){
				
				$this->setData($results[0]);

			}
		}

		public static function getList(){ // Lista a tabela do banco de dados, organizado pelo login

			$sql = new Sql();

			return $sql->select("select * from tb_usuarios order by deslogin");

		}

		public static function search($login){ // Busca no banco por parte de texto, neste caso no campo usuario

			$sql = new Sql();

			return $sql->select("select * from tb_usuarios where deslogin like :SEARCH order by deslogin",array(
				':SEARCH'=>"%".$login."%"
			));

		}

		public function login($login,$password){ // Busca os dados no banco por usuario e senha

			$sql = new Sql();

			$results = $sql->select("select * from tb_usuarios where deslogin = :LOGIN and dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));

			if(count($results)>0){

				$this->setData($results[0]);

			}else{

				throw new Exception("Login e/ ou senha invalidos!");
				

			}

		}

		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
			

		}

		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			));


			if(count($results)>0){

				$this->setData($results[0]);

			}

		}

		public function __construct($login = "", $password =""){
			$this->setDeslogin($login);
			$this->setDessenha($password);
		}

		public function update($login, $password){

			$this->setDeslogin($login);
			$this->setDessenha($password);

			$sql = new Sql();

			$sql->execQuery("update tb_usuarios set deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID",array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));

		}

		public function delete(){

			$sql = new Sql();

			$sql->execQuery("delete from tb_usuarios WHERE idusuario = :ID",array(
				':ID'=>$this->getIdusuario()
			));

			$this->setIdusuario(0);
			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setDtcadastro(new DateTime());

		}

		public function __toString(){
			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		}
	}

 ?>