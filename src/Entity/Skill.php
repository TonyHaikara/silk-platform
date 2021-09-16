<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 * @ApiResource(
 *      collectionOperations={"get"},
 *      itemOperations={"get"},
  *     normalizationContext={"groups"={"skill:read", "occupationSkill:read"}},
 *      denormalizationContext={"groups"={"skill:write", "occupationSkill:read"}},
 *      attributes={
 *          "formats"={"json"}
 *     }
 * )
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $conceptType;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $conceptUri;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $skillType;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $reuseLevel;

    /**
     * @ORM\Column(type="text")
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $preferredLabel;

    /**
     * @ORM\Column(type="text")
     */
    private $altLabels;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $hiddenLabels;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $scopeNote;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $definition;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $inScheme;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"occupation:read", "skill:read", "occupationSkill:read", "trainingSkill:read", "training:read"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SkillTranslation::class, mappedBy="skill", orphanRemoval=true)
     */
    private $skillTranslations;

    public function __construct()
    {
        $this->skillTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConceptType(): ?string
    {
        return $this->conceptType;
    }

    public function setConceptType(string $conceptType): self
    {
        $this->conceptType = $conceptType;

        return $this;
    }

    public function getConceptUri(): ?string
    {
        return $this->conceptUri;
    }

    public function setConceptUri(string $conceptUri): self
    {
        $this->conceptUri = $conceptUri;

        return $this;
    }

    public function getSkillType(): ?string
    {
        return $this->skillType;
    }

    public function setSkillType(string $skillType): self
    {
        $this->skillType = $skillType;

        return $this;
    }

    public function getReuseLevel(): ?string
    {
        return $this->reuseLevel;
    }

    public function setReuseLevel(string $reuseLevel): self
    {
        $this->reuseLevel = $reuseLevel;

        return $this;
    }

    public function getPreferredLabel(): ?string
    {
        return $this->preferredLabel;
    }

    public function setPreferredLabel(string $preferredLabel): self
    {
        $this->preferredLabel = $preferredLabel;

        return $this;
    }

    public function getAltLabels(): ?string
    {
        return $this->altLabels;
    }

    public function setAltLabels(string $altLabels): self
    {
        $this->altLabels = $altLabels;

        return $this;
    }

    public function getHiddenLabels(): ?string
    {
        return $this->hiddenLabels;
    }

    public function setHiddenLabels(?string $hiddenLabels): self
    {
        $this->hiddenLabels = $hiddenLabels;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getScopeNote(): ?string
    {
        return $this->scopeNote;
    }

    public function setScopeNote(?string $scopeNote): self
    {
        $this->scopeNote = $scopeNote;

        return $this;
    }

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(?string $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    public function getInScheme(): ?string
    {
        return $this->inScheme;
    }

    public function setInScheme(string $inScheme): self
    {
        $this->inScheme = $inScheme;

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

    /**
     * @return Collection|SkillTranslation[]
     */
    public function getSkillTranslations(): Collection
    {
        return $this->skillTranslations;
    }

    public function addSkillTranslation(SkillTranslation $skillTranslation): self
    {
        if (!$this->skillTranslations->contains($skillTranslation)) {
            $this->skillTranslations[] = $skillTranslation;
            $skillTranslation->setSkill($this);
        }

        return $this;
    }

    public function removeSkillTranslation(SkillTranslation $skillTranslation): self
    {
        if ($this->skillTranslations->removeElement($skillTranslation)) {
            // set the owning side to null (unless already changed)
            if ($skillTranslation->getSkill() === $this) {
                $skillTranslation->setSkill(null);
            }
        }

        return $this;
    }
}
