<?php

namespace App\Command;

use App\Repository\CompetitionRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'list_team_of_compet',
    description: 'Add a short description for your command',
)]
class ListTeamOfCompetCommand extends Command
{
    private $competRepository;
    
    public function __construct(CompetitionRepository $CompetitionRepository) {
        parent::__construct();
        $this->CompetitionRepository = $CompetitionRepository;
    }

    protected function configure(): void
    {
        $this
            ->addOption('competName', null, InputOption::VALUE_REQUIRED, 'Name of competition')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // On affiche que les equipes dont l'id de la competition est egal a celle en question
        $competRepository = $this->competRepository;

        $teams = $competRepository->findAll();

        $table = new Table($output);
        $table->setHeaders(['Id', 'Name', 'City']);

        foreach ($teams as $team) {
            $table->addRow([$team->getId(), $team->getName(), $team->getCity()]);
        }

        $table->render();

        return Command::SUCCESS;

    }
}
