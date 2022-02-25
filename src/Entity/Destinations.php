<?php

namespace App\Entity;

use App\Repository\DestinationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DestinationsRepository::class)
 */
class Destinations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=65)
     */
    private $surname;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="text")
     */
    private $extract;

    /**
     * @ORM\Column(type="text")
     */
    private $pros;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    /**
     * @ORM\Column(type="date")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $price_per_night;

    /**
     * @ORM\ManyToMany(targetEntity=Landscapes::class, inversedBy="destinations")
     */
    private $landscape;

    /**
     * @ORM\ManyToMany(targetEntity=Seasons::class, inversedBy="destinations")
     */
    private $season;

    /**
     * @ORM\ManyToMany(targetEntity=Transports::class, inversedBy="destinations")
     */
    private $transport;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, inversedBy="destinations")
     */
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity=Providers::class, inversedBy="destinations")
     */
    private $provider;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, inversedBy="destinations")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Nights::class, inversedBy="destinations")
     */
    private $nigth;

    public function __construct()
    {
        $this->landscape = new ArrayCollection();
        $this->season = new ArrayCollection();
        $this->transport = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->nigth = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getExtract(): ?string
    {
        return $this->extract;
    }

    public function setExtract(string $extract): self
    {
        $this->extract = $extract;

        return $this;
    }

    public function getPros(): ?string
    {
        return $this->pros;
    }

    public function setPros(string $pros): self
    {
        $this->pros = $pros;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getPricePerNight(): ?int
    {
        return $this->price_per_night;
    }

    public function setPricePerNight(int $price_per_night): self
    {
        $this->price_per_night = $price_per_night;

        return $this;
    }

    /**
     * @return Collection<int, Landscapes>
     */
    public function getLandscape(): Collection
    {
        return $this->landscape;
    }

    public function addLandscape(Landscapes $landscape): self
    {
        if (!$this->landscape->contains($landscape)) {
            $this->landscape[] = $landscape;
        }

        return $this;
    }

    public function removeLandscape(Landscapes $landscape): self
    {
        $this->landscape->removeElement($landscape);

        return $this;
    }

    /**
     * @return Collection<int, Seasons>
     */
    public function getSeason(): Collection
    {
        return $this->season;
    }

    public function addSeason(Seasons $season): self
    {
        if (!$this->season->contains($season)) {
            $this->season[] = $season;
        }

        return $this;
    }

    public function removeSeason(Seasons $season): self
    {
        $this->season->removeElement($season);

        return $this;
    }

    /**
     * @return Collection<int, Transports>
     */
    public function getTransport(): Collection
    {
        return $this->transport;
    }

    public function addTransport(Transports $transport): self
    {
        if (!$this->transport->contains($transport)) {
            $this->transport[] = $transport;
        }

        return $this;
    }

    public function removeTransport(Transports $transport): self
    {
        $this->transport->removeElement($transport);

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    public function getProvider(): ?Providers
    {
        return $this->provider;
    }

    public function setProvider(?Providers $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Nights>
     */
    public function getNigth(): Collection
    {
        return $this->nigth;
    }

    public function addNigth(Nights $nigth): self
    {
        if (!$this->nigth->contains($nigth)) {
            $this->nigth[] = $nigth;
        }

        return $this;
    }

    public function removeNigth(Nights $nigth): self
    {
        $this->nigth->removeElement($nigth);

        return $this;
    }
}
