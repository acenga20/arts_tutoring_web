<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Lecture;
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
        $em = $this->doctrine->getManager();
        $lectures = $em->getRepository(Lecture::class)->findAll();
        $items = $em->getRepository(Item::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'lectures' => $lectures,
            'items' => $items,
            'controller_name' => 'IndexController',
        ]);
    }
}
