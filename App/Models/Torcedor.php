<?php

namespace App\Models;

use MF\Model\Model;

class Torcedor extends Model {

	private $id;
	private $nome;
	private $documento;
	private $cep;
	private $endereco;
	private $bairro;
	private $cidade;
	private $uf;
	private $telefone;
	private $email;
	private $ativo;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	public function validar() {
		if(empty($this->nome) || empty($this->documento) || empty($this->cep) || empty($this->endereco) || empty($this->bairro) || empty($this->cidade) || empty($this->uf) || empty($this->telefone) || empty($this->email) || empty($this->ativo)) {
				return false;
			}

		return true;
	}

	public function salvar() {
		
		$query = "INSERT INTO torcedores(nome, documento, cep, endereco, bairro, cidade, uf, telefone, email, ativo) VALUES(:nome, :documento, :cep, :endereco, :bairro, :cidade, :uf, :telefone, :email, :ativo)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':documento', $this->__get('documento'));
		$stmt->bindValue(':cep', $this->__get('cep'));
		$stmt->bindValue(':endereco', $this->__get('endereco'));
		$stmt->bindValue(':bairro', $this->__get('bairro'));
		$stmt->bindValue(':cidade', $this->__get('cidade'));
		$stmt->bindValue(':uf', $this->__get('uf'));
		$stmt->bindValue(':telefone', $this->__get('telefone'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':ativo', $this->__get('ativo'));
		$stmt->execute();

		return $this;

	}

	public function getAll() {

		$query = "SELECT * FROM torcedores";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function torcedorId($id) {
		$query = "SELECT * FROM torcedores WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function delete($id) {

		$query = "DELETE FROM torcedores WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		return true;

	}

	public function update($id) {
		$query = "UPDATE torcedores SET telefone = :telefone, email = :email WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':telefone', $this->__get('telefone'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $this;
	}
}

?>