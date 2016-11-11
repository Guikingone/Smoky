<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Core\Providers\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateProviderCommand.
 */
class CreateProviderCommand extends Command
{
    /** {@inheritdoc} */
    public function configure()
    {
        try {
            $this->setName('provider:create')
                ->setDescription('Allow to create a new Provider')
                ->addArgument('Module', InputOption::VALUE_REQUIRED,
                    'The Module used to generate the Provider.')
                ->addArgument('Provider', InputOption::VALUE_REQUIRED,
                    'The name of the Provider');
        } catch (InvalidArgumentException $e) {
            $e->getMessage();
        }
    }

    /** {@inheritdoc} */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome into the Smoky Provider creator !</info>');
        try {
            if (null === $input->getArgument('Module')) {
                throw new \LogicException('<error>The Module key MUST be provided.</error>');
            }
            if (null === $input->getArgument('Provider')) {
                throw new \LogicException('<error>The Provider key MUST be provided.</error>');
            }
            $module = $input->getArgument('Module');
            $modulePath = $this->getModulesManager()->get($module)->getPath();
            if (!$modulePath) {
                throw new \LogicException(
                    sprintf(
                        'A Module MUST have a defined path'
                    )
                );
            }
        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }
}
