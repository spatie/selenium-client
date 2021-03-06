<?php

namespace Spatie\Selenium;

use Facebook\WebDriver\Interactions\WebDriverActions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverPoint;
use Facebook\WebDriver\WebDriverSelect;

class Browser
{
    /** @var \Facebook\WebDriver\Remote\RemoteWebDriver */
    protected $driver;

    /** @var string */
    protected $host;

    public function __construct(string $host)
    {
        $this->driver = RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            DesiredCapabilities::chrome()
        );

        $this->driver->manage()->window()->setPosition(new WebDriverPoint(0 ,0));
        $this->driver->manage()->window()->maximize();

        $this->host = rtrim($host, '/');

        pcntl_async_signals(true);

        pcntl_signal(SIGINT, function () {
            $this->driver->quit();

            exit;
        });

        register_shutdown_function(function () {
            $this->driver->quit();
        });
    }

    public function get(string $url): RemoteWebDriver
    {
        return $this->driver->get($this->getUrl($url));
    }

    public function element(string $selector): RemoteWebElement
    {
        return $this->driver->findElement(WebDriverBy::cssSelector($selector));
    }

    /**
     * @param string $selector
     *
     * @return RemoteWebElement[]
     */
    public function elements(string $selector): array
    {
        return $this->driver->findElements(WebDriverBy::cssSelector($selector));
    }

    public function linkByText(string $text): RemoteWebElement
    {
        return $this->driver->findElement(WebDriverBy::linkText($text));
    }

    public function click(string $selector): RemoteWebElement
    {
        return $this->element($selector)->click();
    }

    public function submit(string $selector): RemoteWebElement
    {
        return $this->element($selector)->submit();
    }

    public function select(string $selector, int $index)
    {
        (new WebDriverSelect($this->element($selector)))->selectByIndex($index);
    }

    public function upload(string $selector, string $path)
    {
        $this->element($selector)->sendKeys($path);
    }

    public function scrollTo(string $selector)
    {
        $actions = new WebDriverActions($this->driver);

        $actions->moveToElement($this->element($selector));

        $actions->perform();
    }

    public function timeout(int $seconds): void
    {
        sleep($seconds);
    }

    public function driver(): WebDriver
    {
        return $this->driver();
    }

    public function wait()
    {
        echo 'Press ctrl+c to exit..' . PHP_EOL;

        while (true) {};
    }

    protected function getUrl(string $url): string
    {
        $url = ltrim($url, '/');

        return "{$this->host}/{$url}";
    }
}
