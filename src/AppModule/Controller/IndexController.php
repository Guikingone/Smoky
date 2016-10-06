<?php

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