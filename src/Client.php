<?php

namespace Spatie\Selenium;

use Spatie\Selenium\Commands\ExecuteCommand;
use Spatie\Selenium\Commands\ServeCommand;
use Symfony\Component\Console\Application;

class Client extends Application
{
    public function __construct()
    {
        parent::__construct('Selenium Client', '1.0');

        $this->addCommands([
            new ServeCommand(),
            new ExecuteCommand(),
        ]);
    }
}
