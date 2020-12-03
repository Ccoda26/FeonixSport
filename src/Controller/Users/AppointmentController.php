<?php


namespace App\Controller\Users;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{

    /**
     * @Route("/RendezVous", name="Take_rdv")
     */
    public function TakeAppointment(){
        return $this->render('Front/takeAppointment.html.twig');
    }
}