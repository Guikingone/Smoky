<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppModule\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction(Request $request)
    {
        $name = $request->get('name');
        return new Response('Hello ' . $name . ', comment vas-tu ?');
    }

    public function byeAction(Request $request)
    {
        $name = $request->get('name');
        return new Response('Bye ' . $name . ', passe une bonne journée.');
    }
}