<?php


namespace App\Controller\Admin;



use App\Controller\Service\DeleteImage;
use App\Entity\Article;
use App\Entity\Picture;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

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
     */
    public function AllArticles()
    {
        return $this->redirectToRoute('All_Articles');
    }

    /**
     * @Route("/admin/article/show/{id}", name="Admin_Article_Show")
     */
    public function ArticlesShow()
    {
        return $this->redirectToRoute('Article_Show');
    }


    /**
     * @Route("/admin/article/insert", name="Article_Insert")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
    public function InsertArticle(Request $request, EntityManagerInterface $entityManager)
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

            $entityManager->persist($articles);
            $entityManager->flush();

//         si formulaire valid et envoyer
                return $this->redirectToRoute('Admin_All_Articles');
            }


        return $this->render('admin/insertArticle.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/article/update/{id}", name="Article_Update")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @return RedirectResponse|Response
     */
    public function UpdateArticle(Request $request,
                                  EntityManagerInterface $entityManager,
                                  $id
    )
    {

        $articles = $entityManager->getRepository(Article::class)->find($id);

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
            return $this->redirectToRoute('Article_Show', [
                'id' => $articles->getId(),
            ]);
        }


        return $this->render('admin/updateArticle.html.twig', [

            'form' => $form->createView(),

        ]);

    }

    /**
     * @Route ("/admin/article/delete/{id}", name="Article_Delete")
     * @param EntityManagerInterface $entityManager
     * @param $id
     */
    Public Function DeleteArticle(EntityManagerInterface $entityManager,$id, DeleteImage $deleteImage){

        $article = $entityManager->getRepository(Article::class)->find($id);

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('All_Articles');
    }


    /**
     * @param SessionInterface $session
     * @param $id
     * @return RedirectResponse
     * @Route("/picture/delete/{id}", name="delete_picture")
     */
    public function RemovePicture(ArticleRepository $articleRepository, SessionInterface $session, $id){
        ///$pictures = $articleRepository->find($id);
        $pictures = $session->get('Filename');
        //dd($session->get('Filename', $Filename));
        //$pics = $pictures->getFilename();
dd($pictures);
        foreach ($pictures as $picture)
        {
            unlink($picture[$id]);
        }
        $session->set('picture', $pictures);


        return  $this->redirectToRoute('Admin_Article_Show');
    }
}

