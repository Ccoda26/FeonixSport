<?php


namespace App\Controller\Admin;



use App\Entity\Article;

use App\Entity\Picture;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function AllArticles(ArticleRepository $articleRepository)
    {
        $articleslist = $articleRepository->findAll();

        return $this->render('Admin/allArticles.html.twig', [
            "articleslist" => $articleslist
        ]);
    }

    /**
     * @Route("/admin/article/show/{id}", name="Admin_Article_Show")
     * @param ArticleRepository $articleRepository
     * @param $id
     * @return Response
     */
    public function ArticlesShow(ArticleRepository $articleRepository, $id)
    {

        $article = $articleRepository->find($id);

        return $this->render('admin/articlesShow.html.twig', [
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
                                  SluggerInterface $slugger
    )
    {

        $articles = new Article();

        $form = $this->createForm(ArticleType::class, $articles);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $pictures = $form->get('Filename')->getData();

            // On boucle sur les images
            foreach($pictures as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On crée l'image dans la base de données
                $picture = new Picture();
                $picture->setFilename($fichier);
                $articles->addFilename($picture);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articles);
            $entityManager->flush();

//         si formulaire valid et envoyer
//                return $this->redirectToRoute('Admin_All_Articles');
            }


        return $this->render('admin/insertArticle.html.twig', [

            'form' => $form->createView(),

        ]);

    }

}

