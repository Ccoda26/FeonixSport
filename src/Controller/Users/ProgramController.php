<?php


namespace App\Controller\Users;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{

    /**
     * @Route("/programs", name="All_Programs")
     */

    public function AllPrograms (){
        return $this->render('Front/allPrograms.html.twig');
    }

    /**
     * @Route("/programs/show/{id}", name="Programs_Show")
     */
    public function ProgramShow($id){
        return $this->render('Front/programShow.html.twig');
    }

}