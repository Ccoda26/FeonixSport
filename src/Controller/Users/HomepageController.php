<?php


namespace App\Controller\Users;


use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\ExerciseRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /**
     * @param ArticleRepository $articleRepository
     * @param ExerciseRepository $exerciseRepository
     * @param ProgramRepository $programRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="Homepage")
     */

    public function Homepage(ArticleRepository $articleRepository,
                             ExerciseRepository $exerciseRepository,
                             ProgramRepository $programRepository){
        $user = new User();

        $articles = $articleRepository->findAll();

        $exercice = $exerciseRepository->findOneBy(['name' => 'squat']);

        $program = $programRepository->findOneBy(['Title' => 'Débuter à la maison']);


        return $this->render('base.html.twig',[
            'user' => $user,
            'exercice' => $exercice,
            'articles' => $articles,
            'program' => $program
        ]);
    }
}