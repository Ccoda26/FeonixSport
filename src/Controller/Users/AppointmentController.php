<?php


namespace App\Controller\Users;


use App\Entity\Appointment;
use App\Form\AdminAppointmentType;
use App\Form\UserAppointmentType;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{

    /**
     * @Route("/RendezVous", name="Take_rdv")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function TakeAppointment(Request $request,
                                    EntityManagerInterface $entityManager,
                                    AppointmentRepository $appointmentRepository
    ){
$rdvs = $appointmentRepository->findBy(['dispo' => 1], ['Date' => 'ASC']);

        $appointment = new Appointment();

        $form = $this->createForm(UserAppointmentType::class, $appointment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appointment);
            $entityManager->flush();
        }

        $formView = $form->createView();
        return $this->render('Front/takeAppointment.html.twig',[
            'rdvs' => $rdvs,
            'form' => $formView
        ]);
    }

    /**
     * @Route("/user/mesrendezvous/{id}", name="MyUser_page")
     * @param AppointmentRepository $appointmentRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function AllAppointment(AppointmentRepository $appointmentRepository,$id){
       $appointmentlist=  $appointmentRepository->findBy(['user' => $id]);

        return $this->render('Front/userPage.html.twig',[
            "appointmentlist" => $appointmentlist,
        ]);
    }
}