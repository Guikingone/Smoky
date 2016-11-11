<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Aurelien Morvan <contact@aurelien-morvan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$datetime = new DateTime();
$path = $datetime->format('d-m-Y').'_'.($datetime->format('H') + 1).'h'.$datetime->format('i').'min';

exec('phpunit --coverage-html ./Coverage/'.$path);
