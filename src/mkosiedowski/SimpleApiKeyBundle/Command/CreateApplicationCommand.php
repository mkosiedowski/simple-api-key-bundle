<?php

namespace mkosiedowski\SimpleApiKeyBundle\Command;

use mkosiedowski\SimpleApiKeyBundle\Entity\ApplicationProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateApplicationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('simple_api_key:add_application')
            ->setDescription('Adds new application to registry')
            ->addArgument('name', InputArgument::REQUIRED, 'Application name');
    }

    /**
     * Gets district from Google API and updates salons
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ApplicationProvider $provider */
        $provider = $this->getContainer()->get('mkosiedowski.simple_api_key.application.provider');

        $application = $provider->create($input->getArgument('name'));
        $provider->add($application);
        $output->writeln("{$application->getApplicationName()}:{$application->getApiKey()}");
    }
}
