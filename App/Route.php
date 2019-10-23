<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['enviar'] = array(
			'route' => '/enviar',
			'controller' => 'indexController',
			'action' => 'enviar'
		);

		$routes['enviado'] = array(
			'route' => '/enviado',
			'controller' => 'indexController',
			'action' => 'enviado'
		);

		$routes['torcedores'] = array(
			'route' => '/torcedores',
			'controller' => 'TorcedorController',
			'action' => 'torcedores'
		);

		$routes['delete'] = array(
			'route' => '/delete',
			'controller' => 'TorcedorController',
			'action' => 'delete'
		);

		$routes['editar'] = array(
			'route' => '/editar',
			'controller' => 'TorcedorController',
			'action' => 'editar'
		);

		$routes['novo'] = array(
			'route' => '/novo',
			'controller' => 'TorcedorController',
			'action' => 'novo'
		);

		$routes['novoTorcedor'] = array(
			'route' => '/novoTorcedor',
			'controller' => 'TorcedorController',
			'action' => 'novoTorcedor'
		);

		$routes['editarTorcedor'] = array(
			'route' => '/editarTorcedor',
			'controller' => 'TorcedorController',
			'action' => 'editarTorcedor'
		);

		$routes['mensagem'] = array(
			'route' => '/mensagem',
			'controller' => 'TorcedorController',
			'action' => 'mensagem'
		);
		
		$routes['enviarEmail'] = array(
			'route' => '/enviarEmail',
			'controller' => 'TorcedorController',
			'action' => 'enviarEmail'
		);
		
		$this->setRoutes($routes);
	}

}

?>