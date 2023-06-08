<?php

namespace App\Controller;

use App\Entity\Lecture;
use App\Entity\User;
use App\Form\ArchiveAccessType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/{id}', name: 'app_single_user')]
    public function getOneUser($id):Response{
        $em = $this->doctrine->getManager();

        $form = $this->createForm(RegistrationFormType::class);
        $user = $em->getRepository(User::class)->findOneBy(['id'=> $id]);
        $lecture = $em->getRepository(Lecture::class)->findOneBy(['id'=> 1]);
        return $this->render('user/single_user.html.twig', [
            'user' => $user,
            'lecture' => $lecture,

        ]);
    }

    #[Route('/set-description/{id}', name: 'app_user_desc')]
    public function setUserDescription($id, Request $request) :JsonResponse{
        $em = $this->doctrine->getManager();
        $responseArray = [];
        $user = $em->getRepository(User::class)->findOneBy(['id'=> $id]);
        $desc = $request->request->get('value');
        if($user){
            $user->setDescription($desc);
            $em->flush();
        }
        $responseArray['data'] = $desc;
        return new JsonResponse($responseArray);
    }

}