<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Import\Manager;

class ImportChargedFeesFileCommand extends Command
{
    protected static $defaultName = 'app:import-charged-fees-file';

    private $importManager;

    public function __construct(Manager $importManager)
    {
        $this->importManager = $importManager;
        parent::__construct();
    }

    protected function configure()
    {
 		$this
		    ->setDescription('Import charged fees file.')
		    ->setHelp('This command allows you to import loaded charged fees');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->importManager->import($input, $output);
        return Command::SUCCESS;
    }
}