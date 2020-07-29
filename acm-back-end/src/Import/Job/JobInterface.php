<?php

namespace App\Import\Job;

use App\Import\Payload\GeneratedPayload;

interface JobInterface{
	public function play(GeneratedPayload $payload);
}