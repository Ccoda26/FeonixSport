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

        //findby pour trouver tout les articles en relation avec l'id demandé
        $article = $articleRepository->find($id);
            //save all filename in $picture

            $picture = $article->getFilename();
            // save article content in $textun
            $firsttext = $article->getContent();
            //i cut my string contain in $text on all . to obtain an array
            $text = explode('.', $firsttext);


            //I send $text and $picture to my twig
        return $this->render('Front/articleShow.html.twig',[
            "article" => $article,
            "picture" => $picture,
            "text" => $text
        ]);
    }

}