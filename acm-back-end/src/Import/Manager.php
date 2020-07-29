<?php
namespace App\Import;

use App\Entity\ChargedFees;
use App\Entity\ChargedFeesError;
use App\Repository\ChargedFeesRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Import\Payload\PayloadGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Doctrine\ORM\EntityManagerInterface;

class Manager{
	private $pipeline;

	private $chargedFeesDao;

	private $payloadGenerator;

	private $em;

	public function __construct(Pipeline $pipeline, ChargedFeesRepository $chargedFeesDao, PayloadGenerator $payloadGenerator, EntityManagerInterface $em){
		$this->pipeline = $pipeline;
		$this->chargedFeesDao = $chargedFeesDao;
		$this->payloadGenerator = $payloadGenerator;
		$this->em = $em;
	}

	public function import(InputInterface $input, OutputInterface $output){
		$chargedFeesFiles = $this->chargedFeesDao->findLastChargedFees();
		foreach($chargedFeesFiles as $chargedFees)
		{
			$output->writeln('Start importing file '.$chargedFees->filePath);
			$chargedFees->state = "importing";
			$this->em->flush();
			$payloads = $this->payloadGenerator->generate($chargedFees);
			$size = count($payloads);
			$chargedFees->rowNumber = $size;
	        $progress = new ProgressBar($output, $size);
	        $progress->start();
	        $errors = 0;
	        $line = 0;
	        foreach($payloads as $payload)
	        {
	        	$line++;
	        	try{
	        		$this->pipeline->process($payload);
	        	}
	        	catch(\InvalidArgumentException $e){
	        		$error = new ChargedFeesError();
	        		$error->chargedFees = $payload->chargedFees;
	        		$error->error = "Line ". $line . ": " .$e->getMessage();
	        		$output->writeln($error->error);
	        		$errors++;
	        		$this->em->persist($error);
					$this->em->flush();
	        	}
	        	$progress->advance(1);
	        }
	        $chargedFees->state = "imported";
	        $chargedFees->errorsNumber = $errors;
			$this->em->flush();
			$this->em->clear();
	        $progress->finish();
	        $output->writeln('Imported file '.$chargedFees->filePath);
			return $payload;
		}
	}
}