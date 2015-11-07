<?php
/**
 * Phergie plugin for Query express using api (https://github.com/brucezhang1993/phergie-irc-plugin-react-expressquery)
 *
 * @link https://github.com/phergie/phergie-irc-plugin-react-expressquery for the canonical source repository
 * @copyright Copyright (c) 2015 Bruce Zhang (http://www.phpzon.com)
 * @license http://phergie.org/license Simplified BSD License
 * @package Phergie\Irc\Plugin\React\ExpressQuery
 */

namespace Phergie\Irc\Plugin\React\ExpressQuery;

use Phergie\Irc\Bot\React\AbstractPlugin;
use Phergie\Irc\Bot\React\EventQueueInterface as Queue;
use Phergie\Irc\Plugin\React\Command\CommandEvent as Event;

include "kuaidi.class.php";

/**
 * Plugin class.
 *
 * @category Phergie
 * @package Phergie\Irc\Plugin\React\ExpressQuery
 */
class Plugin extends AbstractPlugin
{
    protected $commands = [];
    protected $lines = 0;
    /**
     * Accepts plugin configuration.
     *
     * Supported keys:
     *
     *
     *
     * @param array $config
     */
    public function __construct(array $config = ['commands' => ['express', 'kd'], 'lines' => 5 ])
    {
	$this->commands = $config['commands']; 
	$this->lines = $config['lines'];
    }

    /**
     *
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
	$events = array();
	foreach ($this->commands as $command) {
	    $events['command.'.$command] = 'queryExpress';
	    $events['command.'.$command.'.help'] = 'queryExpressHelp';
	}
        return $events;
    }

    /**
     *
     *
     * @param \Phergie\Irc\Plugin\React\Command\CommandEvent $event
     * @param \Phergie\Irc\Bot\React\EventQueueInterface $queue
     */
    public function queryExpress(Event $event, Queue $queue)
    {
	$number = $event->getCustomParams()[0];
	if($number && is_numeric($number)) {
	    $query = new Kuaidi($number);
	    $result = json_decode( $query->quick_query(),true );
	    $queue->ircPrivmsg($event->getSource(), 'Query Result: ');
	    for($i=0; $i<$this->lines; $i++) {
		if(@isset($result['data'][$i])) {
	            $msg= $result['data'][$i]['time'].' -- '.$result['data'][$i]['context'];
		    $queue->ircPrivmsg($event->getSource(), $msg);
	        }
            }
	}else {
	    $queue->ircPrivmsg($event->getSource(), "Param missing or incorrect! Express ID should be numeric.");
	}
    }

    public function queryExpressHelp(Event $event, Queue $queue)
    {
	$msg="Usage: [";
	foreach($this->commands as $command) {
	    $msg.=$command.' ';
	}
	$msg .= '] [Express ID] -- Query the express status for given ID.';
	$queue->ircPrivmsg($event->getSource(), $msg);
    }

}
