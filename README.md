# PHP Selenium client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/selenium-client.svg?style=flat-square)](https://packagist.org/packages/spatie/selenium-client)
[![Build Status](https://img.shields.io/travis/spatie/selenium-client/master.svg?style=flat-square)](https://travis-ci.org/spatie/selenium-client)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/selenium-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/selenium-client)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/selenium-client.svg?style=flat-square)](https://packagist.org/packages/spatie/selenium-client)

Selenium is a great tool for testing. 
This package gives you a boilerplate setup to automate UI testing tasks you'd do manually otherwise.

For example: you can make a scenario to test the flow of a form in one of your projects, 
without having to worry about setting up Selenium itself.

## Installation

```bash
git clone git@github.com:spatie/selenium-client.git
```

## Usage

You can add your own scenarios in the `Scenarios` folder. 

Next, you'll need to start the Selenium server like so:

```bash
php client.php serve
```

Next you can run your scenarios like so:

```bash
php client.php execute dummy [--wait]
```

Adding the `--wait` option will keep the browser open until you manually stop it.

### Making scenarios

Scenario classes should extend `Spatie\Selenium\Scenario`. 
There are a few helper methods provided like `$this->element($selector)` and `$this->click($selector)`;
but you can also directly access the Selenium driver via `$this->driver`.

For more information about the Selenium driver, please visit [this repository](https://github.com/facebook/php-webdriver).

A simple scenario can look like this.

```php
class MyScenario extends Scenario
{
    public function __construct()
    {
        // The website to visit.
        
        parent::__construct('https://mywebsite.com.test');
    }

    public function run()
    {
        // Go to a page
        $this->get('/contact');

        $this->element('input[name=name]')->sendKeys('Brent');
        $this->element('input[name=email]')->sendKeys('brent@spatie.be');
        $this->element('input[name=message']->sendKeys('Test');
        
        $this->submit('form#contact');
    }
}
```

Scenarios can be run with the `execute` command, in this case you'd run `execute my`. 

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Brent Roose](https://github.com/brendt)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
