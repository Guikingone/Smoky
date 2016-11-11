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

use Smoky\Core\Providers\Provider;

/**
 * Class MailerProvider.
 */
class MailerProvider extends Provider
{
    /** {@inheritdoc} */
    public function loadClasses()
    {
        return [
            'Mailer' => new Mailer(),
        ];
    }
}
