<?php

namespace Spatie\Selenium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class ServeCommand extends Command
{
    public function __construct()
    {
        parent::__construct('serve');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $seleniumBinary = __DIR__ . '/../../bin/selenium-server-standalone-3.9.1.jar';

        $chromeDriver = __DIR__ . '/../../bin/chromedriver';

        $process = new Process("java -Dwebdriver.chrome.driver=\"{$chromeDriver}\" -jar {$seleniumBinary}");

        $process->setIdleTimeout(60 * 60);
        $process->setTimeout(60 * 60);

        $process->run(function ($type, $buffer) use ($output) {
            $output->write($buffer);
        });
    }
}
