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
        return $this->redirectToRoute('All_Exercices');
    }


    /**
     * @Route("/admin/exercice/show/{id}", name="Admin_Exercice_Show")
     */
    public function ExerciceShow()
    {
        return $this->redirectToRoute('Exercice_Show');
    }

    /**
     * @Route("/admin/exercice/insert", name="Exercice_Insert")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @return RedirectResponse|Response
     */
    public function InsertExercice(Request $request,
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
             return $this->redirectToRoute('Admin_All_Exercices');
            }
        }
            return $this->render('admin/insertExercice.html.twig', [

                'form' => $form->createView(),

            ]);

    }

    /**
     * @Route("/admin/exercice/update/{id}", name="Exercice_Update")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @return RedirectResponse|Response
     */
    public function UpdateExercice(Request $request,
                                   EntityManagerInterface $entityManager,
                                   SluggerInterface $slugger,
                                   $id
    )
    {

        $exercices = $entityManager->getRepository(Exercise::class)->find($id);

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
                return $this->redirectToRoute('Exercice_Show', [
                    'id' => $exercices->getId(),
                ]);
            }

        }
        return $this->render('admin/updateExercice.html.twig', [
            'form' => $form->createView(),

        ]);

    }

    /**
     * @Route ("/admin/exercice/delete/{id}", name="Exercice_Delete")
     * @param EntityManagerInterface $entityManager
     * @param $id
     */
    Public Function DeleteExercice(EntityManagerInterface $entityManager,$id){

        $exercice = $entityManager->getRepository(Exercise::class)->find($id);

        $entityManager->remove($exercice);
        $entityManager->flush();

        return $this->redirectToRoute('All_Exercices');
    }

    /**
     * @Route("/admin/exercice/delete/picture/{id}", name="delete_exercice_image", methods={"DELETE"})
     */
    public function deleteImage(Picture $picture, Request $request){
        $data = json_decode($request->getContent(), true);

//        dump($data);die();

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$picture->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $picture->getFilename();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($picture);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }

}