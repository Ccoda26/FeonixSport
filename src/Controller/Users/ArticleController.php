<?php


namespace App\Controller\Users;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article", name="All_Articles")
     */
    public function AllArticles(ArticleRepository $articleRepository){
        $articleslist = $articleRepository->findAll();

        return $this->render('Front/allArticles.html.twig',[
            "articleslist" => $articleslist
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="Article_Show")
     */
    public function ArticlesShow(ArticleRepository $articleRepository, $id){

        $article = $articleRepository->find($id);

        return $this->render('Front/articleShow.html.twig',[
            "article" => $article
        ]);
    }

}