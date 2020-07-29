<?php

namespace App\Import\Job;

use App\Entity\ChargedFee;
use App\Entity\Enum\FeeType;
use App\Import\Payload\GeneratedPayload;

class Hydrate implements JobInterface{
	private $chargedFeesTypesTransco = array(
		"connexion 3G" => FeeType::INTERNET
	);

	public function play(GeneratedPayload $payload)
	{
		$chargedFee = new ChargedFee;
		$chargedFee->chargedAccountId = $payload->line['chargedAccountId'];
		$chargedFee->feeId = $payload->line['feeId'];
		$chargedFee->customerId = $payload->line['customerId'];
		$chargedFee->feeType = $payload->line['type'];
		$startDate = \DateTime::createFromFormat('j/m/Y H:i:s', $payload->line['startDate'] . " ". $payload->line['startTime']);
		$chargedFee->startDate = $startDate;
		$chargedFee->amount = $payload->line['amount'];
		$chargedFee->chargedAmount = $payload->line['chargedAmount'];
		$payload->chargedFee = $chargedFee;
	}
}