<?php


namespace App\Controller\Users;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IdentityController extends AbstractController
{
    /**
     * @Route("/identité", name="Identity_Page")
     */

    public function Identity(){
        return $this->render('Front/identity.html.twig');
    }
}