<?php


namespace App\Controller\Users;


use App\Entity\Booking;

use App\Entity\Card;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class BookingController extends AbstractController
{


    /**
     * @Route ("/calendar", name="booking")
     */
    public function calendar(BookingRepository $bookingRepository){
        //redirection vers le calendrier vu par le users avec lien pour obtenir la liste sous form de tableau
        $booking = $bookingRepository->findAll();

        $rdvs = [];

        foreach($booking as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getBeginAt()->format('Y-m-d H:i:s'),
                'end' => $event->getEndAt()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'client' => $event->getClient()->getName(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('booking/index.html.twig', compact('data'));

    }


    /**
     * @Route("/calendar/insert", name="Insert_Date")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param BookingRepository $bookingRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

   Public function InsertDate(Request $request,
                              EntityManagerInterface $entityManager,
                              UserRepository $userRepository,
                              BookingRepository $bookingRepository, SessionInterface $session)
   {
       $booking = new Booking();

       $form = $this->createForm(BookingType::class, $booking);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            $beginAt = new \DateTime($request->request->get('beginAt'));
            $endAt = new \DateTime($request->request->get('endAt'));
//dd($beginAt);

           $datamail = $request->request->get('email');

            $searchUser = $userRepository->findOneBy(['email' => $datamail]);
        if($searchUser){

            $booking->setClient($searchUser);

            $searchbeginat = $bookingRepository->findOneBy(['beginAt' => $beginAt]);
            $searchendat = $bookingRepository->findOneBy(['endAt' => $endAt]);

            if ($searchbeginat === null && $searchendat === null){

                $bookingEntity = $bookingRepository->findAll();

                foreach($bookingEntity as $book){
                    $beginHours[] = $book->getBeginAt();
                    $endHours []= $book->getEndAt();
                }

                for($i = 0; $i < count($beginHours); $i++){
                    if ($beginAt >= $beginHours[$i] && $beginAt <= $endHours[$i]) {
                        //dd($beginHours[$i]);
                         $this->addFlash('error', 'créneaux est deja pris3');
                        return $this->redirectToRoute('Insert_Date');

                    }
                    elseif ($endAt >= $beginHours[$i] && $endAt <= $endHours[$i]) {
                      $this->addFlash('error', 'créneaux est deja pris2');
                        return $this->redirectToRoute('Insert_Date');

                    }

                }
              $booking->setBeginAt($beginAt);
              $booking->setEndAt($endAt);

                $diff = abs(strtotime($endAt->format('Y-m-d H:i:s')) - strtotime($beginAt->format('Y-m-d H:i:s')));

                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

                $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);

                $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));

                $duration[] = (" %d days $days, %d hours $hours, %d minuts\n,$minuts, %d seconds\n  $seconds ");


                if ($hours >= 0) {
                    $calcul = 50;
                    if ($hours >= 1) {
                        $calcul = $hours * 50;
                    }
                    $price = $calcul;
                }

                $booking->setPrice($price);


                if (!empty($booking)){
                    $entityManager->persist($booking);
                    $entityManager->flush();

                    $this->addFlash('success', 'Votre rendez-vous à bien été prise en compte');
                    return $this->redirectToRoute('panier_vide');
                }else{
                   $this->addFlash('error', "erreur cest produit lors de l'envoi");
                  return  $this->redirectToRoute('Insert_Date');
                }

            }else {
                $this->addFlash('error', 'créneaux est deja pris1');
                return $this->redirectToRoute('Insert_Date');
            }
        }else{
           $this->addFlash('error', 'il faut etre inscris avant de prendre un rendez vous');
            return $this->redirectToRoute('Insert_Date');
        }

       }
       $formview = $form->createView();

       return $this->render('Front/InsertBooking.html.twig', [
           'form' => $formview
       ]);

   }
}
