<?php

namespace Spatie\Selenium\Commands;

use InvalidArgumentException;
use Spatie\Selenium\Scenario;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExecuteCommand extends Command
{
    public function __construct()
    {
        parent::__construct('execute');

        $this->addArgument('scenario', InputArgument::REQUIRED, 'The name of the scenario to execute');

        $this->addOption('wait', null, InputOption::VALUE_NONE, 'Wait for ctrl+c before closing the browser window.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $scenario = $this->resolveScenario($input->getArgument('scenario'), $input, $output);

        $scenario->run();

        if ($input->getOption('wait')) {
            $scenario->wait();
        }
    }

    private function resolveScenario(string $name, InputInterface $input, OutputInterface $output): Scenario
    {
        $name = str_replace('Scenario', '', $name);

        $className = ucfirst($name) . 'Scenario';

        $fqcn = "Spatie\\Selenium\\Scenarios\\{$className}";

        if (! class_exists($fqcn)) {
            throw new InvalidArgumentException("Could not load scenario {$fqcn}");
        }

        return (new $fqcn())
            ->setInput($input)
            ->setOutput($output);
    }
}
