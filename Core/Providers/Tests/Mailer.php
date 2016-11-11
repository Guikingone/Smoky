<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Core\Providers\Tests;

/**
 * Class Mailer.
 */
class Mailer
{
    /** @var bool If the mail is send or not. */
    protected $send;

    /** Allow to send a new email using the data passed. */
    public function send()
    {
        // Just for test purpose !
    }
}
