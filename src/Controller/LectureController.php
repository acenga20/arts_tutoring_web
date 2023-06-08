<?php

namespace App\Controller;

use App\Entity\Lecture;
use App\Entity\User;
use App\Form\NewLectureType;
use App\Form\RegistrationFormType;
use App\Repository\LectureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lecture')]
class LectureController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
//    #[Route('/')]
//    public function index(): Response
//    {
//        return $this->render('lecture/index.html.twig', [
//            'controller_name' => 'LectureController',
//        ]);
//    }

    #[Route('/{id}', name:'app_single_lecture')]
    public function getLecture($id):  Response
    {
        $em = $this->doctrine->getManager();
        $lecture = $em->getRepository(Lecture::class)->findOneBy(['id'=> $id]);
        return $this->render('lecture/single_lecture.html.twig', [
            'lecture' => $lecture
        ]);
    }


    #[Route('/new/{userId}', name:'app_lecture_new')]
    public function new($userId, Request $request):  Response
    {
        $em = $this->doctrine->getManager();
        $lecture = new Lecture();
        $form = $this->createForm(NewLectureType::class, $lecture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($lecture);
            $em->flush();
            return $this->redirectToRoute('/user/'.$userId);
        }

        $template =  'lecture/_new_lecture_form.html.twig';

        return $this->render($template,[
            'form' => $form->createView()
        ]);

    }
}
