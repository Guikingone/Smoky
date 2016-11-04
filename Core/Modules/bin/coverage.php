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
$hours = ($datetime->format('H') + 1).'h';
$minutes = $datetime->format('i').'min';
$date = $datetime->format('d-m-Y');
$path = $date.'_'.$hours.$minutes;

exec('phpunit --coverage-html ./Coverage/'.$path);