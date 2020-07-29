<?php

namespace App\Import\Job;

use App\Import\Payload\GeneratedPayload;

class ValidateRow implements JobInterface{
	private $headers = array(
		"chargedAccountId",
		"feeId",
		"customerId",
		"startDate",
		"startTime",
		"amount",
		"chargedAmount",
		"type"
	);

	public function play(GeneratedPayload $payload)
	{
		if(count($payload->line) != count($this->headers)){
			throw new \InvalidArgumentException("Line length is invalid");
		}
		$validatedData = [];
		foreach($payload->line as $key => $data){
			if(!array_key_exists($key, $this->headers)){
				throw new \InvalidArgumentException("Header $header is invalid");
			}
			$validatedData[$this->headers[$key]] = $data;
		}
		$payload->line = $validatedData;
		return $payload;
	}
}