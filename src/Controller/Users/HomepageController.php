<?php


namespace App\Controller\Users;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="Homepage")
     */

    public function Homepage(){
        $user = new User();

        return $this->render('base.html.twig',[
            'user' => $user
        ]);
    }
}