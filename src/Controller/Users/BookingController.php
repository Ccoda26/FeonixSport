<?php


namespace App\Controller\Users;


use App\Entity\Booking;
use App\Form\BookingType;

use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{

    /**
     * @Route("/calendar", name="Insert_Date")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return
     */

   Public function InsertDate(Request $request,EntityManagerInterface $entityManager, BookingRepository $bookingRepository){

       $booking = new Booking();

       $form = $this->createForm(BookingType::class, $booking);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $user = $this->getUser();
           $booking->setClient($user);

           $beginDate = $booking->getBeginAt();

           $date = $bookingRepository->findOneBy(array('beginAt' => $beginDate));

           if (isset($date)){
               $message = $this->addFlash('success','Ce creneau horaire est deja pris');
           }else{
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($booking);
               $entityManager->flush();
           }


           return $this->redirectToRoute('Insert_Date',[
               'message' => $message
           ]);
       }

       $formview = $form->createView();

       return $this->render('Front/InsertBooking.html.twig',[
           'form' => $formview
       ]);


   }
}