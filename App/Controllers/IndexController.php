<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
	public function index()
    {
		$this->render('index');
	}

	public function enviar()
    {
		$this->render('enviar');
	}

	public function enviado()
    {
		$torcedor = Container::getModel('Torcedor');

		if (is_uploaded_file($_FILES['arquivo']['tmp_name'])) {
	   		$xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);

				foreach($xml->torcedor as $item){

		        	$ativo = ($item['ativo'] == 'sim') ? 1 : 0;

					$torcedor->__set('nome', $item['nome']);
					$torcedor->__set('documento', $item['documento']);
					$torcedor->__set('cep', $item['cep']);
					$torcedor->__set('endereco', $item['endereco']);
					$torcedor->__set('bairro', $item['bairro']);
					$torcedor->__set('cidade', $item['cidade']);
					$torcedor->__set('uf', $item['uf']);
					$torcedor->__set('telefone', $item['telefone']);
					$torcedor->__set('email', $item['email']);
					$torcedor->__set('ativo', $ativo);
					$torcedor->salvar();
				}

            $sucessoCadastro = true;
            $this->render('enviar', $sucessoCadastro);
		}
	}
}
