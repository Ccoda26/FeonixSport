<?php


namespace App\Controller\Users;



use App\Repository\ProgramRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{


    /**
     * @Route("/panier", name="panier_vide")
     * @param SessionInterface $session
     * @param ProgramRepository $programRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function CardPage(SessionInterface $session, ProgramRepository $programRepository){

        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity){
            $panierWithData[] = [
                'program' => $programRepository->find($id),
                'quantité' => $quantity
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item){
            $totalItem = $item['program']->getPrice();
            $total += $totalItem;
        }

        return $this->render('Front/panier.html.twig',[
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/{id}", name="panier_plein")
     * @param SessionInterface $session
     * @param $id
     * @return void
     */

    public function AddCard(SessionInterface $session, $id){

        $panier = $session->get('panier', []);

        $panier[$id] = 1;

        $session->set('panier', $panier);

        dd($session->get('panier', $panier));

    }

    /**
     * @Route("/panier/Remove/{id}", name="Remove_panier")
     */

    public function RemoveCard(SessionInterface $session, $id){
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier', $panier);

        return  $this->redirectToRoute('panier_vide');
    }
}