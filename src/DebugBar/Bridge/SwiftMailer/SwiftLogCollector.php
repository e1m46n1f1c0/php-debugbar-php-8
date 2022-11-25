<?php
/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DebugBar\Bridge\SwiftMailer;

use DebugBar\DataCollector\MessagesCollector;
use Swift_Mailer;
use Swift_Plugins_Logger;
use Swift_Plugins_LoggerPlugin;

/**
 * Collects log messages
 *
 * http://swiftmailer.org/
 */
class SwiftLogCollector extends MessagesCollector implements Swift_Plugins_Logger
{
    #[\ReturnTypeWillChange] public function __construct(Swift_Mailer $mailer)
    {
        $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($this));
    }

    #[\ReturnTypeWillChange] public function add($entry)
    {
        $this->addMessage($entry);
    }

    #[\ReturnTypeWillChange] public function dump()
    {
        $dump = '';
        foreach ($this->messages as $message) {
            if (!$message['is_string']) {
                continue;
            }

            $dump .= $message['message'] . PHP_EOL;
        }

        return $dump;
    }

    #[\ReturnTypeWillChange] public function getName()
    {
        return 'swiftmailer_logs';
    }
}
