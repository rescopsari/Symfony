<?php

namespace App\Command;

use App\Entity\Competition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'new_compet',
    description: 'Add a short description for your command',
)]
class NewCompetCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addOption('competName', null, InputOption::VALUE_REQUIRED, 'Name of the competition')
            ->addOption('competSport', null, InputOption::VALUE_REQUIRED, 'Sport of the competition')
            ->addOption('competCity', null, InputOption::VALUE_REQUIRED, 'City of the competition')
            ->addOption('start_date', null, InputOption::VALUE_REQUIRED, 'Start of the competition')
            ->addOption('stop_date', null, InputOption::VALUE_REQUIRED, 'Stop of the competition')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $competName = $input->getOption('competName');
        $competSport = $input->getOption('competSport');
        $competCity = $input->getOption('competCity');
        $start_date = $input->getOption('start_date');
        $stop_date = $input->getOption('stop_date');

        $compet = new Competition();
        $compet->setName($competName);
        $compet->setCity($competSport);
        $compet->setName($competCity);
        $compet->setCity($start_date);
        $compet->setName($stop_date);

        $this->entityManager->persist($compet);
        $this->entityManager->flush();

        $io->success('La competition '.$competName.' est créé');

        return Command::SUCCESS;

    }
}
