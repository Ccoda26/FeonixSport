<?php


namespace App\Controller\Admin;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
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

        return $this->render('Front/articlesShow.html.twig',[
            "article" => $article
        ]);
    }


    /**
     * @Route("/article/insert", name="Article_Insert")
     */
    public function insertArticle(Request $request)
    {

        $article = new Article();
        // createForm methode appartient au abstractController
        // appelle de la classe CategoryType dans dossier form
        // il va recuperer dans la class entité Catégory les types pour obtenir les bon inputs en twig
        $form = $this->createForm(ArticleType::class, $article);

        // createView methode propre au formulaire pour permettre a twig de recuperer le formulaire

        $form->handleRequest($request);

        $formView = $form->createView();
        // si formulaire valid et envoyer
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // on le pre enregistre puis on transmets les infos en base de données
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin_category_List');
        }

        return $this->render('admin/insertArticle.html.twig', [
            'formView' => $formView
        ]);

    }

    /**
     * @Route("/article/update/{id}", name="Article_Show")
     */
    public function updatecategory(Request $request, Article $article)
    {

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        $formView = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {
            // va effectuer la requête d'UPDATE en base de données
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_category_List');
        }

        return $this->render('admin/updatesArticle.html.twig', [
            'formView' => $formView
        ]);
    }
}