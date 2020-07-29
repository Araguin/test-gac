<?php

namespace App\Import\Job;

use Symfony\Component\Validator\Validation;
use App\Import\Payload\GeneratedPayload;

class ValidateFormat implements JobInterface{
	public function play(GeneratedPayload $payload)
	{
		$validator = Validation::createValidatorBuilder()
		    ->enableAnnotationMapping()
		    ->getValidator();
	    $violations = $validator->validate($payload->chargedFee);

	    if(count($violations) > 0){
	    	$errors = "";
	    	foreach($violations as $key => $violation){
	    		$errors = $errors . " [ " . $violation->getPropertyPath() . " ]: " . $violation->getMessage();
		    	
		    }
		    throw new \InvalidArgumentException($errors);
	    }
	    
	    return $payload;
	}
}