<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/calendar", name="booking_calendar")
     */
    public function index(BookingRepository $repository): Response
    {
        $booking = $repository->findAll();

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
}
