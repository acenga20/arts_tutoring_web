<?php

namespace App\Controller;

use App\Entity\Lecture;
use App\Entity\User;
use App\Form\NewLectureType;
use App\Form\RegistrationFormType;
use App\Repository\LectureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lectures')]
class LectureController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }


    #[Route('/', name:'app_all_lectures')]
    public function allLectures():  Response
    {
        return $this->render('lecture/all_lectures.html.twig', [
        ]);
    }

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
            $user = $em->getRepository(User::class)->findOneBy(['id'=>$userId]);
            $lecture->setUser($user);
            $em->persist($lecture);
            $em->flush();
            return $this->redirectToRoute('app_single_user', [
                'id' => $userId
            ]);
        }

        $template =  'lecture/_new_lecture_form.html.twig';

        return $this->render($template,[
            'form' => $form->createView()
        ]);
    }
    #[Route('/delete/{id}', name: 'app_delete_lecture')]
    public function delete(Lecture $lecture)
    {
        $em = $this->doctrine->getManager();
        $em->remove($lecture);
        $em->flush();

        return new JsonResponse('success');
    }
}
