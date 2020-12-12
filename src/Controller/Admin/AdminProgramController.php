<?php


namespace App\Controller\Admin;



use App\Entity\Picture;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminProgramController extends AbstractController
{
    /**
     * @Route("admin/programs", name="Admin_All_Program")
     * @param ProgramRepository $programRepository
     */
    public function ProgrammList(ProgramRepository $programRepository){
        return $this->render('Admin/allPrograms.html.twig');
    }

    /**
     * @Route("/admin/program/show/{id}", name="Admin_Program_Show")
     * @param ProgramRepository $programRepository
     * @param $id
     * @return Response
     */
    public function ExerciceShow(ProgramRepository $programRepository, $id)
    {

        $program = $programRepository->find($id);

        return $this->render('admin/programsShow.html.twig', [
            "program" => $program
        ]);
    }

    /**
     * @Route("/admin/program/insert", name="Program_Insert")
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

        $programs = new Program();

        $form = $this->createForm(ProgramType::class, $programs);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $picture = $form->get('Filename')->getData();


            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $picture->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $picture= new Picture();
                $picture->setFilename($newFilename);
                $programs->setFilename($picture);
        }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($programs);
                $entityManager->flush();

//         si formulaire valid et envoyer
//                return $this->redirectToRoute('Admin_All_Articles');
            }


        return $this->render('admin/insertProgram.html.twig', [

            'form' => $form->createView(),

        ]);

    }


}