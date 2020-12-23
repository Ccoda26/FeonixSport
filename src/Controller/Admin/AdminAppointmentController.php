<?php


namespace App\Controller\Admin;


use App\Entity\Appointment;
use App\Form\AdminAppointmentType;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAppointmentController extends AbstractController
{

    /**
     * @Route("/Mettremesdispos", name="Ajouter_Date")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param AppointmentRepository $appointment
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function TakeAppointment(Request $request,
                                    EntityManagerInterface $entityManager,
                                    AppointmentRepository $appointmentRepository
){



        $appointment = new Appointment();

        $form = $this->createForm(AdminAppointmentType::class, $appointment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appointment);
            $entityManager->flush();
        }

        $formView = $form->createView();
        return $this->render('Admin/AddAppointment.html.twig',[
            'form' => $formView
        ]);
    }


}