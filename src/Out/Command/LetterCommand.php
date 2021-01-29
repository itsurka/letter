<?php

namespace App\Out\Command;

use App\Domain\UseCase\UseCaseFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LetterCommand extends Command
{
    protected static $defaultName = 'letter:generate';

    /** @var UseCaseFactory */
    private $useCaseFactory;

    public function __construct(string $name = null, UseCaseFactory $useCaseFactory)
    {
        parent::__construct($name);
        $this->useCaseFactory = $useCaseFactory;
    }

    protected function configure()
    {
        $this
            ->setDescription('Generate letters')
            ->addOption('method', 'm', InputOption::VALUE_REQUIRED, '"mailing" or "report"')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $method = $input->getOption('method');

        $this->useCaseFactory->getUseCase($method)->execute();

        return Command::SUCCESS;
    }
}
