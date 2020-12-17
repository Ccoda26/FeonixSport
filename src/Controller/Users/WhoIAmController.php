<?php


namespace App\Controller\Users;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use  Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WhoIAmController extends AbstractController
{
    /**
     * @Route("Qui-sommes-nous", name="page_identity")

     */
    public function ContentPage(){
        return $this->render('Front/WhoIAm.html.twig');
    }

}