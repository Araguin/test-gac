<?php

namespace App\Import;

use Symfony\Component\Console\Output\OutputInterface;
use App\Import\Payload\GeneratedPayload;
use App\Import\Job\JobInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class Pipeline{
	private $jobs;

	/**
	* @param JobInterface[] $jobs
	*/
	public function __construct(array $jobs){
		$this->jobs = $jobs;
	}

	public function process($line){        
    	foreach($this->jobs as $job)
    	{
    		$job->play($line);
    	}
	}
}