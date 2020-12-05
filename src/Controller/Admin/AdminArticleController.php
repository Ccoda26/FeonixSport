<?php


namespace App\Controller\Admin;



use App\Entity\Article;
use App\Entity\Media;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminArticleController extends AbstractController
{
//    protected $articleRepository;
//
//    public function __construct(ArticleRepository $articleRepository)
//    {
//        $this->articleRepository = $articleRepository;
//    }

    /**
     * @Route("/admin/article", name="Admin_All_Articles")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function AllArticles(ArticleRepository $articleRepository){
        $articleslist = $articleRepository->findAll();

        return $this->render('Admin/allArticles.html.twig',[
            "articleslist" => $articleslist
        ]);
    }

    /**
     * @Route("/admin/article/show/{id}", name="Article_Show")
     * @param ArticleRepository $articleRepository
     * @param $id
     * @return Response
     */
    public function ArticlesShow(ArticleRepository $articleRepository, $id){

        $article = $articleRepository->find($id);

        return $this->render('Front/articlesShow.html.twig',[
            "article" => $article
        ]);
    }


    /**
     * @Route("/admin/article/insert", name="Article_Insert")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @return RedirectResponse|Response
     */
    public function InsertArticle(Request $request,
                                  EntityManagerInterface $entityManager,
                                  SluggerInterface $slugger)
    {

        $articles = new Article();
        $articles->setTitle('debut empire');


        // createForm methode appartient au abstractController
        // appelle de la classe ArticleType dans dossier form
        // il va recuperer dans la class entité Catégory les types pour obtenir les bon inputs en twig
        $form = $this->createForm(ArticleType::class, $articles);

        // createView methode propre au formulaire pour permettre a twig de recuperer le formulaire

        $form->handleRequest($request);


        // si formulaire valid et envoyer
        if ($form->isSubmitted() && $form->isValid()) {


           $mediaName = $form->get('media')->getData();
           if ($mediaName){
               $originalName = pathinfo($mediaName->getClentOriginalName(),PATHINFO_FILENAME);

               $safeName = $slugger->slug($originalName);

               $newFilename = $safeName .'-'.uniqid().'.'.$mediaName->gessExtension();
               try {
                   $mediaName->move(
                       $this->getParameter('images_directory'),
                       $newFilename
                   );
               } catch (FileException $exception){

               }


        }
            // on le pre enregistre puis on transmets les infos en base de données
            $entityManager->persist($articles);
            $entityManager->flush();

            return $this->redirectToRoute('Admin_All_Articles');
        }

        $formView = $form->createView();

        return $this->render('admin/insertArticle.html.twig', [
            'formView' => $formView

        ]);

    }


//
//    /**
//     * @Route("/admin/article/update/{id}", name="Article_Update")
//     * @param Request $request
//     * @param Article $article
//     * @return RedirectResponse|Response
//     */
//    public function UpdateArticle(Request $request, Article $article)
//    {
//
//        $form = $this->createForm(ArticleType::class, $article);
//
//        $form->handleRequest($request);
//        $formView = $form->createView();
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            // va effectuer la requête d'UPDATE en base de données
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('Admin_All_Articles');
//        }
//
//        return $this->render('admin/updatesArticle.html.twig', [
//            'formView' => $formView
//        ]);
//    }
//
//    /**
//     * @Route("/admin/article/delete/{id}", name="Article_Delete")
//     * @param ArticleRepository $articleRepository
//     * @param $id
//     * @param EntityManagerInterface $entityManager
//     * @return RedirectResponse
//     */
//
//    public function DeleteArticle(articleRepository $articleRepository, $id, EntityManagerInterface $entityManager){
//
//        // select l'id pour updates la bonne ligne
//        $article = $articleRepository->find($id);
//
//        if (!is_null($article)) {
//            $entityManager->remove($article);
//            $entityManager->flush();
//            // ajoute le message d'erreur de types success => action bien prise en compte
//            // ajout du message => article est supprimé
//            $this->addFlash('success',
//                "La article est supprimé !");
//        }
//
//        // Le message est pris en compte est trasmis à la method articleList et donc envoyé au fichier twig
//        // -> de la liste des articles
//        return $this->redirectToRoute('Admin_All_Articles');
//
//    }
}