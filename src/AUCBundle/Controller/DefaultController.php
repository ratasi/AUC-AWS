<?php

namespace AUCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AUCBundle\Entity\Noticia;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AUCBundle:Default:index.html.twig');
    }
    public function futbolsillaAction()
    {
        return $this->render('AUCBundle:Default:futbolsilla.html.twig');
    }
    public function contactoAction()
    {
        return $this->render('AUCBundle:Default:contacto.html.twig');
    }
    public function extraAction()
    {
        return $this->render('AUCBundle:Default:extra.html.twig');
    }

    public function nosotrosAction()
    {
        return $this->render('AUCBundle:Default:quienes.html.twig');
    }
    public function adaptadoAction()
    {
        return $this->render('AUCBundle:Default:futboladaptado.html.twig');
    }
    public function bienvenidoAction()
    {
        return $this->render('AUCBundle:Default:bienvenido.html.twig');
    }

    public function allAction()
    {
        $repository = $this->getDoctrine()->getRepository('AUCBundle:Noticia');
        $noticias = $repository->findAll();
        return $this->render('AUCBundle:Default:index.html.twig', array("noticias"=>$noticias));
    }
}
