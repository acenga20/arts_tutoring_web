<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            try {
            $user->setName($form->get('name')->getData());
            $user->setSurname($form->get('surname')->getData());
            $user->setPhoneNr($form->get('phoneNr')->getData());
            $user->setUsername($form->get('username')->getData());
            $user->setType($form->get('type')->getData());
            $user->setInterests($form->get('interests')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('app_index',[
            ]);
            }catch (UniqueConstraintViolationException $exception){
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                    'error' => 'There is already an account with this email!'
                ]);
            }

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/edit/{id}', name: 'app_user_edit')]
    public function edit(User $user, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils): Response
    {

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            try {
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'User Updated!');
                $id = $user->getId();
                // do anything else you need here, like send an email
                return $this->redirectToRoute('app_single_user',[
                    'id' => $id
                ]);
            }catch (UniqueConstraintViolationException $exception){
                return $this->render('user/_edit_modal.html.twig', [
                    'user' => $user,
                    'registrationForm' => $form->createView(),
                    'error' => 'There is already an account with this email!'
                ]);
            }

        }
        return $this->render('user/_edit_modal.html.twig', [
            'registrationForm' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'user' => $user
        ]);
    }
}
