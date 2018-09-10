<?php

namespace Spatie\Selenium;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Scenario extends Browser
{
    /** @var \Symfony\Component\Console\Input\InputInterface */
    protected $input;

    /** @var \Symfony\Component\Console\Output\OutputInterface */
    protected $output;

    abstract function run();

    public function setInput(InputInterface $input): Scenario
    {
        $this->input = $input;

        return $this;
    }

    public function setOutput(OutputInterface $output): Scenario
    {
        $this->output = $output;

        return $this;
    }

    protected function log(string $message): Scenario
    {
        if (! $this->output) {
            return $this;
        }

        $this->output->writeln($message);

        return $this;
    }
}
