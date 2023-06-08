<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserVerificationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/', name: 'app_index')]
    public function index(Request $request): Response
    {

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
