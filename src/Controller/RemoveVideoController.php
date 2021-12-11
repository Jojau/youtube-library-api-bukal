<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Repository\VideoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RemoveVideoController extends AbstractController
{
    public function __construct(private VideoRepository $videoRepository, private UtilisateurRepository $utilisateurRepository, private ManagerRegistry $doctrine)
    {
        
    }

    public function __invoke(string $id, string $videoId): Utilisateur
    {
        $entityManager = $this->doctrine->getManager();

        $video = $this->videoRepository->find($videoId);
        $utilisateur = $this->utilisateurRepository->find($id);
        $utilisateur->removeVideo($video);
        $entityManager->persist($utilisateur);
        $entityManager->flush();

        return $utilisateur;
    }
}
