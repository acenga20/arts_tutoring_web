<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\User;
use App\Form\NewItemType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/shop')]
class ItemController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }


    #[Route('/', name:'app_all_items')]
    public function allLectures():  Response
    {
        return $this->render('shop/all_items.html.twig', [
        ]);
    }
    #[Route('/new/{userId}', name:'app_item_new')]
    public function new($userId, Request $request):  Response
    {
        $em = $this->doctrine->getManager();
        $item = new Item();
        $form = $this->createForm(NewItemType::class, $item);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $em->getRepository(User::class)->findOneBy(['id'=>$userId]);
            $item->setUser($user);
            $em->persist($item);
            $em->flush();
            return $this->redirectToRoute('app_single_user', [
                'id' => $userId
            ]);
        }

        $template =  'shop/_new_item_form.html.twig';

        return $this->render($template,[
            'form' => $form->createView()
        ]);

    }
}