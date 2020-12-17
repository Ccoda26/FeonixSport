<?php


namespace App\Controller\Users;


use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{

    /**
     * @Route("/programs", name="All_Programs")
     */

    public function AllPrograms (ProgramRepository $programRepository){

        $programlist = $programRepository->findAll();

        return $this->render('Front/allPrograms.html.twig',[
            'programlist' => $programlist
        ]);
    }

    /**
     * @Route("/program/show/{id}", name="Program_Show")
     */
    public function ProgramShow(ProgramRepository $programRepository, $id){

        $program = $programRepository->find($id);

        return $this->render('Front/programShow.html.twig',[
            'program' =>$program
        ]);
    }

}