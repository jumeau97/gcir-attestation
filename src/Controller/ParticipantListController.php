<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParticipantListController extends AbstractController
{
    #[Route('/', name: 'app_participant_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repo = $entityManager->getRepository(User::class);
        $participants = $repo->findAll();
        return $this->render('participant_list/index.html.twig', [
            'participants' => $participants
        ]);
    }
}
