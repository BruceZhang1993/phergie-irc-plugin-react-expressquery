<?php
/**
 * Phergie plugin for Query express using api (https://github.com/brucezhang1993/phergie-irc-plugin-react-expressquery)
 *
 * @link https://github.com/phergie/phergie-irc-plugin-react-expressquery for the canonical source repository
 * @copyright Copyright (c) 2015 Bruce Zhang (http://www.phpzon.com)
 * @license http://phergie.org/license Simplified BSD License
 * @package Phergie\Irc\Plugin\React\ExpressQuery
 */

namespace Phergie\Irc\Tests\Plugin\React\ExpressQuery;

use Phake;
use Phergie\Irc\Bot\React\EventQueueInterface as Queue;
use Phergie\Irc\Plugin\React\Command\CommandEvent as Event;
use Phergie\Irc\Plugin\React\ExpressQuery\Plugin;

/**
 * Tests for the Plugin class.
 *
 * @category Phergie
 * @package Phergie\Irc\Plugin\React\ExpressQuery
 */
class PluginTest extends \PHPUnit_Framework_TestCase
{


    /**
     * Tests that getSubscribedEvents() returns an array.
     */
    public function testGetSubscribedEvents()
    {
        $plugin = new Plugin;
        $this->assertInternalType('array', $plugin->getSubscribedEvents());
    }
}
