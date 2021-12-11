<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\AddVideoController;
use App\Controller\RemoveVideoController;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['readUtilisateur']],
    itemOperations:[
        'get' => [
            'normalizationContext' => ['groups' => ['readUtilisateur']],
        ],
        'removeVideo' => [
            "method" => 'GET',
            'path' => 'utilisateurs/{id}/removeVideo/{videoId}',
            'controller' => RemoveVideoController::class
        ],
        'addVideo' => [
            "method" => 'GET',
            'path' => 'utilisateurs/{id}/addVideo/{videoId}',
            'controller' => AddVideoController::class
        ]
    ]
)]
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups("readUtilisateur")]
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Video::class)
     */
    #[Groups("readUtilisateur")]
    private $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        $this->videos->removeElement($video);

        return $this;
    }
}
