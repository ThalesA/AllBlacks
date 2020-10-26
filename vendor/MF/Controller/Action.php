<?php

namespace MF\Controller;

require_once '../vendor/autoload.php';

abstract class Action
{
    protected function render($view, $array='')
    {
        $loader = new \Twig\Loader\FilesystemLoader('../App/Views/');

        $twig = new \Twig\Environment($loader);

        return print_r($twig->render(''.$view.'.phtml', array('dados' => $array )));
    }
}
