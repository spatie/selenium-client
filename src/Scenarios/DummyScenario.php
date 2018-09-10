<?php

namespace Spatie\Selenium\Scenarios;

use Spatie\Selenium\Scenario;

class DummyScenario extends Scenario
{
    public function __construct()
    {
        parent::__construct('https://spatie.be');
    }

    public function run()
    {
        $this->get('/');

        $this->element('header a[href*=open]')->click();

        $this->scrollTo('section#support');

        $this->log('Sleeping for 2 seconds…');

        $this->timeout(2);

        $this->linkByText('support us')->click();
    }
}
