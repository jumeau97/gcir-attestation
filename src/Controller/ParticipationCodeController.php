<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Entity\User;
use App\Service\PdfService;
use App\Form\ParticipationCodeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParticipationCodeController extends AbstractController
{
    // #[Route('/', name: 'app_participation_code')]
    // public function index(EntityManagerInterface $entityManager, Request $request): Response
    // {
    //     $user = new User();
    //     $repository = $entityManager->getRepository(User::class);
    //     $form = $this->createForm(ParticipationCodeType::class, $user);
        
    //     $form->handleRequest($request);
        
    //     if ($form->isSubmitted() && $form->isValid()) { 
           
    //         $checkedUser = $repository->findOneBy([
    //             'code' => $form->getData()->getCode(),
    //             'status' => true
    //         ]);
           
    //         if ($checkedUser) {
    //             // dd($checkedUser);
    //             return $this->redirectToRoute('certificate');
    //         }
    //     }
    //     return $this->render('participation_code/index.html.twig',[
    //         'form' => $form->createView(),
    //     ]);
    // }

    #[Route('/download/attestation/{id}', name:'certificate')]
    public function attestation(EntityManagerInterface $entityManager ,$id, PdfService $pdf){

        $user = new User();
        $repo = $entityManager->getRepository(User::class);
        $user = $repo->findOneById($id); 
        if ($user) {
            $user->setStatus(true);
            $entityManager ->flush();
            // dd($user);
        }
     

            
            $html = $this->render('participation_code/attestation.html.twig',[
                'user' => $user
             ]);
             $pdf->showPdfFile($html);
             return new Response();
     

    }
    #[Route('/pdf', name: 'personne.pdf')]
    public function generatePdfPersonne(PdfService $pdf) {
        // $html = $this->render('participation_code/attestation.html.twig');
        $html = "bonjour";
        $pdf->showPdfFile($html);
    }
}
