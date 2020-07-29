<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateChargedFeesAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ApiResource(
 *     iri="http://schema.org/ChargedFeesError",
 *     normalizationContext={
 *         "groups"={"charged_fees_read"}
 *     },
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 */
class ChargedFeesError
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    protected $id;

    /**
     * @var MediaObject|null
     *
     * @ORM\ManyToOne(targetEntity=ChargedFees::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/chargedFees")
     */
    public $chargedFees;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=false)
     * @ApiProperty(iri="http://schema.org/error")
     * @Groups({"charged_fees_read"})
     * 
     */
    public $error;

    public function getId(): ?int
    {
        return $this->id;
    }
}
