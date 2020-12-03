<?php


namespace App\Controller\Users;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="Homepage")
     */

    public function Homepage(){
        return $this->render('base.html.twig');
    }
}