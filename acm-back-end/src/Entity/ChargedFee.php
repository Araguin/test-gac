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
 *     iri="http://schema.org/ChargedFee",
 *     normalizationContext={
 *         "groups"={"charged_fee_read"}
 *     },
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 */
class ChargedFee
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
     * @var string|null
     *
     * @ORM\Column(nullable=false)
     * @ApiProperty(iri="http://schema.org/chargedAccountId")
     * @Groups({"charged_fee_read"})
     * @Assert\NotBlank
     * @Assert\Regex("/^[0-9]\d*$/")
     * 
     */
    public $chargedAccountId;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=false)
     * @ApiProperty(iri="http://schema.org/feeId")
     * @Groups({"charged_fee_read"})
     * @Assert\NotBlank
     * @Assert\Regex("/^[0-9]\d*$/")
     */
    public $feeId;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=false)
     * @ApiProperty(iri="http://schema.org/customerId")
     * @Groups({"charged_fee_read"})
     * @Assert\NotBlank
     * @Assert\Regex("/^[0-9]\d*$/")
     */
    public $customerId;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=false)
     * @ApiProperty(iri="http://schema.org/feeType")
     * @Groups({"charged_fee_read"})
     * @Assert\NotBlank
     */
    public $feeType;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=false)
     * @ApiProperty(iri="http://schema.org/startDate")
     * @Groups({"charged_fee_read"})
     * @Assert\NotBlank
     */
    public $startDate;

    
    /**
    * @var string|null
    *
    * @ORM\Column(nullable=false)
    * @ApiProperty(iri="http://schema.org/amount")
    * @Groups({"charged_fee_read"})
    */
    public $amount;

    /**
    * @var string|null
    *
    * @ORM\Column(nullable=false)
    * @ApiProperty(iri="http://schema.org/chargedAmount")
    * @Groups({"charged_fee_read"})
    */
    public $chargedAmount;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $feeType
     * @return ChargedFee
     */
    public function setFeeType($feeType)
    {
        if (!in_array($type, FeeType::getAvailableFeeTypes())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = $type;

        return $this;
    }
}
