<?php


namespace App\Controller\Users;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Handler\SwiftMailerHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class UserController extends AbstractController
{


    /**
     * @Route("/inscription", name="sign_page")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function newUser(Request $request,
                            UserPasswordEncoderInterface $passwordEncoder
//                            GuardAuthenticatorHandler $guardAuthenticatorHandler,
//                            UserAuthenticatorInterface $authenticator,
//                            SwiftMailerHandler $mailer

){

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                ));


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


        $this->addFlash('message', 'Utilisateur activé avec succès');
        }
        $formView = $form->createView();

        return $this->render('Front/inscription.html.twig',[
            'form' => $formView
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/MaPage", name="User_Page")
     */

    public function userPage(){

        return $this->render('Front/userPage.html.twig');
    }
}