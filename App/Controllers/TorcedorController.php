<?php

namespace App\Controllers;

require "../public/bibliotecas/PHPMailer/Exception.php";
require "../public/bibliotecas/PHPMailer/OAuth.php";
require "../public/bibliotecas/PHPMailer/PHPMailer.php";
require "../public/bibliotecas/PHPMailer/POP3.php";
require "../public/bibliotecas/PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class TorcedorController extends Action
{
	public function torcedores()
    {
		$torcedor = Container::getModel('Torcedor');

		$torcedores = $torcedor->getAll();

        $this->render('torcedores', $torcedores);
	}

	public function delete()
    {
		$torcedor = Container::getModel('Torcedor');
		$id = $_GET['id'];

		$torcedor->__set('id', $id);

		$torcedor->delete($id);

        $sucessoCadastro = true;

        $this->render('torcedores', $sucessoCadastro);
	}

	public function editar()
    {
		$torcedor = Container::getModel('Torcedor');

		$id = $_GET['id'];

		$torcedor->__set('id', $id);

        $dado = $torcedor->torcedorId($id);

        $this->render('editar', $dado);
	}

	public function editarTorcedor()
    {
		$torcedor = Container::getModel('Torcedor');

		$id = $_POST['id'];

		$torcedor->__set('telefone', $_POST['telefone']);
		$torcedor->__set('email', $_POST['email']);

        if ($torcedor->update($id)) {
            $msg = 'ok';
        } else {
            $msg = 'erro';
        }

        header('Location: /editar?id='.$id);
	}

	public function novo()
    {
		$this->render('novo');
	}

	public function novoTorcedor()
    {
		$torcedor = Container::getModel('Torcedor');

		$ativo = ($_POST['ativo'] == 'sim') ? 1 : 0;

		$torcedor->__set('nome', $_POST['nome']);
		$torcedor->__set('documento', $_POST['documento']);
		$torcedor->__set('cep', $_POST['cep']);
		$torcedor->__set('endereco', $_POST['endereco']);
		$torcedor->__set('bairro', $_POST['bairro']);
		$torcedor->__set('cidade', $_POST['cidade']);
		$torcedor->__set('uf', $_POST['uf']);
		$torcedor->__set('telefone', $_POST['telefone']);
		$torcedor->__set('email', $_POST['email']);
		$torcedor->__set('ativo', $ativo);

        if ($torcedor->validar()) {
            if ($torcedor->salvar()) {
                $msg = 'ok';
            } else {
                $msg = 'erro';
            }
        } else {
            $msg = 'erro';
        }

        $this->render('novo',$msg);
	}

	public function mensagem()
    {
        $email = $_GET['email'];
        $this->render('mensagem', $email);
	}

	public function enviarEmail()
    {
        $email = $_POST['email'];
        $assunto = $_POST['assunto'];
        $mensagem = $_POST['mensagem'];

        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'colocar email';//adicionar email para envio, lembrar de ativar permissoes de apps desconhecidos no gmail.
            $mail->Password = 'senha email';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('colocar email', 'Contato torcedor');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;
            $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem';

            $mail->send();
            $msg = 'ok';

        } catch (Exception $e) {
            echo "Erro " . $mail->ErrorInfo;
        }

        $this->render('mensagem', $msg);
	}
}
