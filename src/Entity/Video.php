<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['readUtilisateur']]
)]
class Video
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    #[Groups("readUtilisateur")]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups("readUtilisateur")]
    private $title;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
