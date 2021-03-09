<?php


namespace App\Controller\Users;


use App\Entity\Booking;

use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class BookingController extends AbstractController
{


    /**
     * @Route ("/calendar", name="booking")
     */
    public function calendar(){
        //redirection vers le calendrier visuel avant la prise de rendez vous
    }




    /**
     * @Route("/calendar/insert", name="Insert_Date")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

   Public function InsertDate(Request $request,
                              EntityManagerInterface $entityManager,
                              UserRepository $userRepository,
                              BookingRepository $bookingRepository)
   {

       $booking = new Booking();

       $form = $this->createForm(BookingType::class, $booking);

       $form->handleRequest($request);


       if ($form->isSubmitted() && $form->isValid()) {
            $beginAt = new \DateTime($request->request->get('beginAt'));
           $endAt = new \DateTime($request->request->get('endAt'));
    dump($beginAt);
    dump($endAt);
           $datamail = $request->request->get('email');

            $searchUser = $userRepository->findOneBy(['email' => $datamail]);
        if($searchUser){
            //$user = $this->getUser();
            $booking->setClient($searchUser);

            $searchbeginat = $bookingRepository->findOneBy(['beginAt' => $beginAt]);
            $searchendat = $bookingRepository->findOneBy(['endAt' => $endAt]);

            if ($searchbeginat === null && $searchendat === null){
                dump('bravo');
                $bookingEntity = $bookingRepository->findAll();
            
                foreach($bookingEntity as $book){
                    $beginHours[] = $book->getBeginAt();
                    $endHours []= $book->getEndAt();
                }

                for($i = 0; $i < count($beginHours); $i++){
                    if ($beginAt >= $beginHours[$i] || $beginAt <= $endHours[$i]) {
                         $this->addFlash('error', 'créneaux est deja pris');
                        return $this->redirectToRoute('Insert_Date');
                        // ce creneaux est deja pris
                    }
                    elseif ($endAt >= $beginHours[$i] || $endAt <= $endHours[$i]) {
                      $this->addFlash('error', 'créneaux est deja pris');
                        return $this->redirectToRoute('Insert_Date');
                        // ce creneaux est deja pris
                    }
                }

               
              $booking->setBeginAt($beginAt);
              $booking->setEndAt($endAt);
     
     //dd($booking);
                $entityManager->persist($booking);
                $entityManager->flush();

            }else {
                $this->addFlash('error', 'créneaux est deja pris');
                return $this->redirectToRoute('Insert_Date');
            }
        }else{
           $this->addFlash('error', 'il faut etre inscris avant de prendre un rendez vous');
            return $this->redirectToRoute('Insert_Date');
        }
       return $this->redirectToRoute('Homepage');
       }
       $formview = $form->createView();

       return $this->render('Front/InsertBooking.html.twig', [
           'form' => $formview
       ]);

   }
}
