<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 */
class Training
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasSessions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity=TrainingSession::class, mappedBy="training", orphanRemoval=true)
     */
    private $sessions;

    /**
     * @ORM\OneToMany(targetEntity=TrainingSkill::class, mappedBy="training", orphanRemoval=true)
     */
    private $trainingSkills;

    private $requiredSkills;
    private $toAcquireSkills;

    public function __construct()
    {
        $this->requiredSkills = new ArrayCollection();
        $this->toAcquireSkills = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->trainingSkills = new ArrayCollection();
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getHasSessions(): ?bool
    {
        return $this->hasSessions;
    }

    public function setHasSessions(bool $hasSessions): self
    {
        $this->hasSessions = $hasSessions;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFiles(): ?string
    {
        return $this->files;
    }

    public function setFiles(string $files): self
    {
        $this->files = $files;

        return $this;
    }

    /**
     * @return Collection|TrainingSession[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(TrainingSession $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setTraining($this);
        }

        return $this;
    }

    public function removeSession(TrainingSession $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getTraining() === $this) {
                $session->setTraining(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TrainingSkill[]
     */
    public function getTrainingSkills(): Collection
    {
        return $this->trainingSkills;
    }

    public function addTrainingSkill(TrainingSkill $trainingSkill): self
    {
        if (!$this->trainingSkills->contains($trainingSkill)) {
            $this->trainingSkills[] = $trainingSkill;
            $trainingSkill->setTraining($this);
        }

        return $this;
    }

    public function removeTrainingSkill(TrainingSkill $trainingSkill): self
    {
        if ($this->trainingSkills->removeElement($trainingSkill)) {
            // set the owning side to null (unless already changed)
            if ($trainingSkill->getTraining() === $this) {
                $trainingSkill->setTraining(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TrainingSkill[]
     */
    public function getRequiredSkills(): Collection
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->eq('isRequired', 1));

        return $this->trainingSkills->matching($criteria);
    }

    /**
     * @return Collection|TrainingSkill[]
     */
    public function getToAcquireSkills(): Collection
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->eq('isToAcquire', 1));

        return $this->trainingSkills->matching($criteria);
    }
}