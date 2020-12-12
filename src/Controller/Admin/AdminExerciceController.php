<?php


namespace App\Controller\Admin;


use App\Entity\Exercise;
use App\Entity\Picture;
use App\Form\ExerciceType;
use App\Repository\ExerciseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminExerciceController extends AbstractController
{
    /**
     * @Route("/admin/exercice", name="Admin_All_Exercices")
     * @param ExerciseRepository $exerciseRepository
     * @return Response
     */
    public function AllExercices(ExerciseRepository $exerciseRepository)
    {
        $exerciselist = $exerciseRepository->findAll();

        return $this->render('admin/allExercices.html.twig', [
            "erxerciselist" => $exerciselist
        ]);
    }


    /**
     * @Route("/admin/exercice/show/{id}", name="Admin_Exercice_Show")
     * @param ExerciseRepository $exerciseRepository
     * @param $id
     * @return Response
     */
    public function ExerciceShow(ExerciseRepository $exerciseRepository, $id)
    {

        $exercice = $exerciseRepository->find($id);

        return $this->render('admin/exercicesShow.html.twig', [
            "exercice" => $exercice
        ]);
    }

    /**
     * @Route("/admin/exercice/insert", name="Exercice_Insert")
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

        $exercices = new Exercise();

        $form = $this->createForm(ExerciceType::class, $exercices);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $pictures = $form->get('Filename')->getData();

            // On boucle sur les images
            foreach ($pictures as $image) {
                if ($image) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    // On génère un nouveau nom de fichier
                    $newfilename = md5(uniqid()) . '.' . $image->guessExtension();

                    // On copie le fichier dans le dossier uploads
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newfilename
                    );

                    // On crée l'image dans la base de données
                    $picture = new Picture();
                    $picture->setFilename($newfilename);
                    $exercices->addFilename($picture);
                }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($exercices);
                $entityManager->flush();

//         si formulaire valid et envoyer
//                return $this->redirectToRoute('Admin_All_Articles');
            }
        }
            return $this->render('admin/insertExercice.html.twig', [

                'form' => $form->createView(),

            ]);


    }

}