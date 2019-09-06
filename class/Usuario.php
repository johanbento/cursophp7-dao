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

		$result = $sql->select("SELECT * FROM TB_USUARIOS WHERE IDUSUARIO = :ID", array(
			":ID"=>$id
		));

		if (count($result) > 0) {
			
			// $row = $result[0];
			
			// $this->setIdusuario($row['idusuario']);
			// $this->setDeslogin($row['deslogin']);
			// $this->setDessenha($row['dessenha']);
			// $this->setDtcadastro(new DateTime($row['dtcadastro']));

			$this->setData($result[0]);

		}
	}


	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM TB_USUARIOS ORDER BY DESLOGIN;");
	}


	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN LIKE :SEARCH ;", array(
			':SEARCH'=>"%".$login."%"
		));
	}


	public function login($login, $password){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN = :LOGIN AND DESSENHA = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($result) > 0) {
			
			// $row = $result[0];
			
			$this->setData($result[0]);

		}
		else {
			throw new Exception("Login ou senha inválidos.");
		}
	}


	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}


	// = "" torna o campo não obrigatório, isso somente por causa do método construtor
	public function __construct($login = "", $password = ""){

		$this->setDeslogin($login);
		$this->setDessenha($password);
	}


	public function insert(){

		$sql = new Sql();

		$result = $sql->select("CALL SP_USUARIOS_INSERT(:LOGIN, :PASSWORD)", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
		));

		if (count($result) > 0) {

			$this->setData($result[0]);
		}
	}


	public function update($login, $password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->query("UPDATE TB_USUARIOS SET DESLOGIN = :LOGIN, DESSENHA = :PASSWORD WHERE IDUSUARIO = :ID", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDeslogin(),
			":ID"=>$this->getIdusuario()
		));
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