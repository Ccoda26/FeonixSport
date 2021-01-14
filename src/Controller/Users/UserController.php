<?php


namespace App\Controller\Users;


use App\Entity\Appointment;
use App\Entity\User;
use App\Form\AdminAppointmentType;
use App\Form\UserType;
use App\Repository\AppointmentRepository;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserController extends AbstractController
{

//    private $appointmentRepository;
//    private $router;
//
//    public function __construct(
//        BookingRepository $bookingRepository,
//        UrlGeneratorInterface $router
//    )
//    {
//        $this->bookingRepository = $bookingRepository;
//        $this->router = $router;
//    }


        /**
     * @Route("/inscription", name="sign_page")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function newUser(Request $request,
                            UserPasswordEncoderInterface $passwordEncoder
){

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
//            dd($_POST);

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                ));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');

        }


        $formView = $form->createView();


        return $this->render('Front/inscription.html.twig',[
            'form' => $formView
        ]);
    }

}


//     * * @Assert\Regex(
//     *     pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*[@#$%])(?!.*(.)\1{2}).*[a-z]/m",
//     *     match=true,
//     *     message="Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole."
//     *)