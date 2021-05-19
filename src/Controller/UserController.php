<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/create/user', name: 'user_create')]
    public function create(Request $req, EntityManagerInterface $em): Response
    {
        $newUser = new User;
        $myForm = $this->createForm(UserType::class, $newUser);

        $myForm->handleRequest($req);
        if($myForm->isSubmitted() && $myForm->isValid())
        {
            $em->persist($newUser);
            $em->flush();
            
            $this->addFlash("success", "User créé");
            return $this->redirectToRoute("home");
        }
        else
        {
            return $this->render('user/create.html.twig', ["myForm" => $myForm->createView()]);
        }

    }



    #[Route('/update/user/{id<[0-9]+>}', name: 'user_update', methods: ["POST|GET"])]
    public function update(int $id, Request $req, EntityManagerInterface $em, UserRepository $repo): Response
    {
        $newUser = $repo->find($id);
        $myForm = $this->createForm(UserType::class, $newUser);

        $myForm->handleRequest($req);
        if($myForm->isSubmitted() && $myForm->isValid())
        {
            $em->persist($newUser);
            $em->flush();
            
            $this->addFlash("success", "User Modifié");
            return $this->redirectToRoute("home");
        }
        else
        {
            return $this->render('user/update.html.twig', ["myForm" => $myForm->createView()]);
        }

    }
}
