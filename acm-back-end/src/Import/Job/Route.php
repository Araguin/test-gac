<?php

namespace App\Import\Job;

use App\Entity\ChargedFee;
use App\Entity\Enum\FeeType;
use App\Import\Payload\GeneratedPayload;
use Doctrine\ORM\EntityManagerInterface;


class Route implements JobInterface{
	private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

	public function play(GeneratedPayload $payload)
	{
		$this->em->persist($payload->chargedFee);
		$this->em->flush();
		$this->em->clear();
		$payload->chargedFee = null;
		return $payload;
	}
}