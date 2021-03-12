<?php

namespace App\Controller\Admin;



use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("admin/calendar", name="admin_booking")
     * @param BookingRepository $repository
     * @return Response
     */
    public function index(BookingRepository $repository): Response
    {
    return $this->redirectToRoute('booking');
    }

    /**
     * @Route("admin/bookings", name="admin_all_booking")
     * @param BookingRepository $bookingRepository
     * @return Response
     */
    public function allbooking(BookingRepository $bookingRepository ){
        $rdvs = $bookingRepository->findBy([],['beginAt' => 'ASC']);

        foreach ($rdvs as $rdv){
            $beginAt [] = $rdv->getBeginAt();
            $endAt [] = $rdv->getEndAt();
        }

        //dump($beginAt);
        //dump($endAt);

        //$calcul =0;
        for ($i = 0; $i < count($beginAt); $i++){
           $date1= $beginAt[$i]->format('Y-m-d H:i:s');
           $date2 = $endAt[$i]->format('Y-m-d H:i:s');

            $diff = abs(strtotime($date2) - strtotime($date1));

            $years   = floor($diff / (365*60*60*24));
            $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));

            $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

            $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));

            $duration[] = (" %d days $days, %d hours $hours, %d minuts\n,$minuts, %d seconds\n  $seconds ");

            if ($hours >=1){
                $calcul = $hours * 50;
                $price = $calcul;
            }
        }
        return $this->render('admin/AllBooking.html.twig', [
            'bookings' => $rdvs,
            'price' => $price
        ]);
    }

}
