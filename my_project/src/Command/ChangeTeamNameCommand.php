<?php

namespace App\Command;

use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'change_team_name',
    description: 'Add a short description for your command',
)]
class ChangeTeamNameCommand extends Command
{
    private $TeamRepository;
    private $entityManager;

    public function __construct(TeamRepository $TeamRepository, EntityManagerInterface $entityManager) {
        parent::__construct();
        $this->TeamRepository = $TeamRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
        ->addOption('teamId', null, InputOption::VALUE_REQUIRED, 'Id de la team à modifier')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $teamRepository = $this->teamRepository;

        $teamId = $input->getOption('teamId');
        $team = $teamRepository->find($teamId);

        if ($team) {
            $newName = $io->ask('Nouveau nom : ', $team->getName());
            $team->setName($newName);

            $this->entityManager->flush();
        } else {
            $io->error('Team inexistante !');
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
