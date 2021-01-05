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
//        $picture = [];
            $picture = $article->getFilename();

            $text = $article->getContent();
//            dd($text);
            $textcut = explode('.', $text);

//        dd($textcut);




        //déclare un array $pictures ou tu va stocker toutes les photos trouver dans le findby

        //ensuite en twig tu fait un lenght de $pictures pour savoir combien tu en as
        // pour ensuite gêrer l'affichage, ex:
        // {% if $pictures|lenght = 1 %}
        //      <img 0 de mon array>
        //{% endif %}

        return $this->render('Front/articleShow.html.twig',[
            "article" => $article,
            "picture" => $picture,
            "textcut" => $textcut
        ]);
    }

}