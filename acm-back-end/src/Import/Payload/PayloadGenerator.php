<?php

namespace App\Import\Payload;

use App\Entity\ChargedFees;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;
use Symfony\Component\HttpKernel\KernelInterface;

class PayloadGenerator{
	protected $projectDir;
	public function __construct(KernelInterface $kernel){
		$this->projectDir = $kernel->getProjectDir();
	}

	public function generate(ChargedFees $chargedFees){
		$filename = $this->projectDir ."/public/charged_fees/" . $chargedFees->filePath;
    	if(!file_exists($filename)){
    		throw new NoFileException("file not found ($filename)");
    	}
        if(!is_readable($filename)) {
            throw new NoFileException("file not readable ($filename)");
        }
        $payloads = [];
        $header = NULL;
        if (($file = fopen($filename, 'r')) !== FALSE) {
        	$row = 0;
            while (($line = fgetcsv($file, null, ";")) !== FALSE) {
            	$row++;
            	if($row > 3) {
            		if( !mb_check_encoding( $line, 'UTF-8' ) ){
					   $line = mb_convert_encoding( $line, 'UTF-8' );
					}
            		$payload = new GeneratedPayload();
					$payload->chargedFees = $chargedFees;
                    $payload->line = $line;
                    $payloads[] = $payload;
            	}
            }
            fclose($file);
        }
        return $payloads;
	}
}