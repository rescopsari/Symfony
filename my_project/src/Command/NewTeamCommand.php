<?php

namespace App\Command;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'new_team',
    description: 'Add a short description for your command',
)]
class NewTeamCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addOption('teamName', null, InputOption::VALUE_REQUIRED, 'Name of the competition')
            ->addOption('teamCity', null, InputOption::VALUE_REQUIRED, 'Sport of the competition')
            ->addOption('teamColor', null, InputOption::VALUE_REQUIRED, 'City of the competition')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $teamName = $input->getOption('teamName');
        $teamCity = $input->getOption('teamCity');
        $teamColor = $input->getOption('teamColor');

        $team = new Team();
        $team->setName($teamName);
        $team->setCity($teamCity);
        $team->setName($teamColor);

        $this->entityManager->persist($team);
        $this->entityManager->flush();

        $io->success('La team '.$teamName.' est créé');

        return Command::SUCCESS;
    }
}
