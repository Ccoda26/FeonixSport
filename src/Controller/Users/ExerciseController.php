<?php


namespace App\Controller\Users;


use App\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExerciseController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/exercice", name="All_Exercices")
     */
    public function AllArticles(ExerciseRepository $exerciseRepository){

        $exerciceList = $exerciseRepository->findAll();

        return $this->render('Front/allExercices.html.twig',[
            'exerciceList' => $exerciceList
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/exercice/show/{id}", name="Exercice_Show")
     */
    public function ArticlesShow(ExerciseRepository $exerciseRepository, $id){

        $exercice = $exerciseRepository->find($id);

        return $this->render('Front/exercicesShow.html.twig',[
            'exercice' => $exercice
        ]);
    }

}