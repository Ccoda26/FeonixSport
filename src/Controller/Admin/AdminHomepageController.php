<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomepageController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/accueil", name="Homepage_admin")
     */
    public function AdminHomepage(){
        return $this->render('admin/Homepage.html.twig');
    }
}