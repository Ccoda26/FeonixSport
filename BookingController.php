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

   Public function InsertDate(Request $request, 
                            EntityManagerInterface $entityManager, 
                            BookingRepository $bookingrepository,
                            UserRepository $userrepository)
   {

       $booking = new Booking();

       $form = $this->createForm(BookingType::class, $booking);

       $form->handleRequest($request);



       if ($form->isSubmitted() && $form->isValid()) {
           $beginAt = $request->request->get('beginAt');
           $endAt =$request->request->get('endAt');

           $datamail = $request->request->get('email');

            $searchUser = $userrepository->findOneBy(['email' => $datamail]);
        if($searchUser){
            $user = $this->getUser();
            $booking->setClient($searchUser);

            $searchbeginat = $bookingrepository->findOneBy(['beginAt' => $beginAt]);
            $searchendat = $bookingrepository->findOneBy(['endAt' => $endAt]);
            if ($beginAt === null && $endAt === null){
                dump('bravo');
                $bookingEntity = $bookingrepository->findAll();
            
                foreach($bookingEntity as $book){
                    $beginHours[] = $book->getBeginAt();
                    $endHours []= $book->getEndAt();
                }
                dd($beginHours);

                for($i = 0; $i <= count($beginHours); $i++){
                    if ($beginAt >= $beginHours[$i] || $beginAt <= $endHours[$i]) {
                        // ce creneaux est deja pris
                    }
                    elseif ($endAt >= $beginHours[$i] || $endAt <= $endHours[$i]) {
                      // ce creneaux est deja pris
                    }
                }

               
              $booking->setBeginAt($beginAt);
              $booking->setEndAt($endAt);
     
     
                $entityManager->persist($booking);
                $entityManager->flush();

            }else {
                // ce creneaux est deja pris
            }
        }else{
            //va t'inscrire
        }
         

       }
       $formview = $form->createView();

       return $this->render('Front/InsertBooking.html.twig', [
           'form' => $formview
       ]);



   }
}