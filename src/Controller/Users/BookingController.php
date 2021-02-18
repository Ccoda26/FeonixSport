<?php


namespace App\Controller\Users;


use App\Entity\Booking;
use App\Entity\ChoiceDate;
use App\Form\BookingType;
use App\Repository\BookingRepository;
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

   Public function InsertDate(Request $request, EntityManagerInterface $entityManager)
   {

       $booking = new Booking();

       $form = $this->createForm(BookingType::class, $booking);

       $form->handleRequest($request);



       if ($form->isSubmitted() && $form->isValid()) {
           $dataDate = $request->request->get('date');
           $dataHours =$request->request->get('hours');

           $user = $this->getUser();
           $booking->setClient($user);



           $hours = new ChoiceDate();
           $hours->setHours($dataDate);
           $hours->setDate($dataHours);
           $booking->addHourchoice($hours);


           $entityManager->persist($booking);
           $entityManager->flush();

       }
       $formview = $form->createView();

       return $this->render('Front/InsertBooking.html.twig', [
           'form' => $formview
       ]);



   }
}