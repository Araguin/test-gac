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
use App\Entity\Enum\ChargedFeesState;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChargedFeesRepository")
 * @ApiResource(
 *     iri="http://schema.org/ChargedFees",
 *     normalizationContext={
 *         "groups"={"charged_fees_read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateChargedFeesAction::class,
 *             "deserialize"=false,
 *             "validation_groups"={"Default", "charged_fees_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @Vich\Uploadable
 */
class ChargedFees
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     * @Groups({"charged_fees_read"})
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"charged_fees_read"})
     */
    public $contentUrl;

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"charged_fees_create"})
     * @Vich\UploadableField(mapping="charged_fees", fileNameProperty="filePath")
     */
    public $file;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     */
    public $filePath;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/state")
     * @Groups({"charged_fees_read"})
     * @ORM\Column(nullable=false)
     */
    public $state;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty(iri="http://schema.org/rowsNumber")
     * @Groups({"charged_fees_read"})
     */
    public $rowsNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty(iri="http://schema.org/errorsNumber")
     * @Groups({"charged_fees_read"})
     */
    public $errorsNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $type
     * @return ChargedFees
     */
     public function setType($type)
    {
        if (!in_array($type, ChargedFeesState::getAvailableStates())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = $type;

        return $this;
    }
}
