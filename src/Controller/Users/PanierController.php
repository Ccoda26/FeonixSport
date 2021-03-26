<?php


namespace App\Controller\Users;


use App\Entity\Booking;
use App\Entity\Card;
use App\Form\CardType;
use App\Repository\BookingRepository;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{


    /**
     * @Route("/panier", name="panier_vide")
     * @param SessionInterface $session
     * @param ProgramRepository $programRepository
     * @param BookingRepository $bookingRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function CardPage(SessionInterface $session,
                             ProgramRepository $programRepository,
                             BookingRepository $bookingRepository,
                             Request $request, EntityManagerInterface $entityManager)
    {

        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id) {
            $panierWithData[] = [
                'program' => $programRepository->find($id),
            ];
        }

        $total = [];

        $user = $this->getUser()->getId();
        $listRdv = $bookingRepository->findBy(['client' => $user]);

        if (!empty($listRdv)) {
            foreach ($panierWithData as $item) {
                $totalItem = $item['program']->getPrice();
                $total[] = $totalItem;

            }

            foreach ($listRdv as $tems) {

                $price = $tems->getPrice();
                $total [] = $price;
            }

            $card = new Card();
            $form = $this->createForm(CardType::class, $card);
            $form->handleRequest($request);
            $formView = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $idItem = $panierWithData->getId();
                $program = $programRepository->find($idItem);
                $payment = $panierWithData->getPaid();
                dd($payment);
                foreach ($listRdv as $done) {

                    $done->setPaid(1);


                    $entityManager->persist($done);
                    $entityManager->flush();
                }
                foreach ($program as $programPaid) {
                    $programPaid->setPaid(1);
                    dd($programPaid);
                    $entityManager->persist($programPaid);
                    $entityManager->flush();
                }
                return $this->redirectToRoute('end_site');
            }



        }


        return $this->render('Front/panier.html.twig',[
            'items' => $panierWithData,
            'total' => array_sum($total),
            'listRdvs' => $listRdv,
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/panier/{id}", name="panier_plein")
     * @param SessionInterface $session
     * @param $id
     * @param BookingRepository $bookingRepository
     * @return void
     */

    public function AddCard(SessionInterface $session, $id, BookingRepository $bookingRepository){

        $panier = $session->get('panier', []);

        $panier[$id] = 1;

        $session->set('panier', $panier);


    return $this->redirectToRoute('panier_vide');
    }

    /**
     * @Route("/panier/Remove/{id}", name="Remove_panier")
     * @param SessionInterface $session
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function RemoveCard(SessionInterface $session, $id){
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier', $panier);

        return  $this->redirectToRoute('panier_vide');
    }

    /**
     * @Route("/thanks", name="end_site")
     */

    public function Thanks(){

        return $this->render('Front/thanks.html.twig');
    }




}