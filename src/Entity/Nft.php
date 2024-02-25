<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NftRepository::class)]
#[ApiResource
    (normalizationContext: ['groups' => ['nfts:read']])
]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nfts:read', 'categories:read', 'users:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['nfts:read', 'categories:read', 'users:read'])]
    private ?string $imageUrl = null;


    #[ORM\Column(length: 255)]
    #[Groups(['nfts:read', 'categories:read', 'users:read'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['nfts:read', 'categories:read', 'users:read'])]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['nfts:read', 'categories:read', 'users:read'])]
    private ?\DateTimeInterface $dateDrop = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'nfts')]
    #[Groups(['nfts:read', 'users:read'])]
    private Collection $category;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['nfts:read', 'categories:read'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDateDrop(): ?\DateTimeInterface
    {
        return $this->dateDrop;
    }

    public function setDateDrop(\DateTimeInterface $dateDrop): static
    {
        $this->dateDrop = $dateDrop;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
    
}
