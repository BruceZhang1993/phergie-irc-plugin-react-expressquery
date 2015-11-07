# brucezhang/phergie-irc-plugin-react-expressquery

[Phergie](http://github.com/phergie/phergie-irc-bot-react/) plugin for Query express using api.

[![Build Status](https://secure.travis-ci.org/brucezhang/phergie-irc-plugin-react-expressquery.png?branch=master)](http://travis-ci.org/brucezhang/phergie-irc-plugin-react-expressquery)

## Install

The recommended method of installation is [through composer](http://getcomposer.org).

`composer require phergie/phergie-irc-plugin-react-expressquery`

See Phergie documentation for more information on
[installing and enabling plugins](https://github.com/phergie/phergie-irc-bot-react/wiki/Usage#plugins).

## Provided Commands

| Command    | Parameters        | Description           |
|:----------:|-------------------|-----------------------|
| kd/express |   [Express ID]    | Express status query  |
## Configuration

```php
return [
    'plugins' => [
        // configuration
        new \Phergie\Irc\Plugin\React\ExpressQuery\Plugin([

		//User-defined commands    Default: express/kd
		'commands' => array('command1', 'command2', ...),
		
		//Latest {lines} status will be shown     Deault: 5
		'lines' => 5

        ])
    ]
];
```

## Tests

To run the unit test suite:

```
curl -s https://getcomposer.org/installer | php
composer install
./vendor/bin/phpunit
```

## License

Released under the BSD License. See `LICENSE`.
