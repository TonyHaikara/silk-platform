<?php

namespace App\Entity;

use App\Repository\OccupationRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OccupationRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"occupation:read"}},
 *      denormalizationContext={"groups"={"occupation:write"}}
 * )
 */
class Occupation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"occupation:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"occupation:read", "occupation:write"})
     */
    private $conceptType;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"occupation:read", "occupation:write"})
     */
    private $conceptUri;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read", "write"})
     */
    private $preferredLabel;
    /**
     * @ORM\Column(type="text")
     * @Groups({"read", "write"})
     */
    private $altLabels;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read", "write"})
     */
    private $hiddenLabels;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read", "write"})
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $regulatedProfessionNote;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write"})
     */
    private $scopeNote;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read", "write"})
     */
    private $definition;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read", "write"})
     */
    private $inScheme;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read", "write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=IscoGroup::class, inversedBy="occupations")
     */
    private $iscoGroup;

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

    public function setHiddenLabels(string $hiddenLabels): self
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

    public function getRegulatedProfessionNote(): ?string
    {
        return $this->regulatedProfessionNote;
    }

    public function setRegulatedProfessionNote(string $regulatedProfessionNote): self
    {
        $this->regulatedProfessionNote = $regulatedProfessionNote;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getIscoGroup(): ?IscoGroup
    {
        return $this->iscoGroup;
    }

    public function setIscoGroup(?IscoGroup $iscoGroup): self
    {
        $this->iscoGroup = $iscoGroup;

        return $this;
    }
}