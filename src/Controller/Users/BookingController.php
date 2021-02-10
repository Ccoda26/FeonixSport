<?php


namespace App\Controller\Users;


use App\Entity\Booking;
use App\Entity\ChoiceDate;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class BookingController extends AbstractController
{

    /**
     * @Route("/calendar", name="Insert_Date")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

   Public function InsertDate(Request $request)
   {

       $booking = new Booking();

       $form = $this->createForm(BookingType::class, $booking);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $hoursData = $form->get('hourchoice')->getData();

           $user = $this->getUser();
           $booking->setClient($user);

           $hours = new ChoiceDate();
           $hours->setHours($hoursData);
           $booking->addHourchoice($hours);
    dd($booking);
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($booking);
           $entityManager->flush();

       }
       $formview = $form->createView();

       return $this->render('Front/InsertBooking.html.twig', [
           'form' => $formview
       ]);



   }
}