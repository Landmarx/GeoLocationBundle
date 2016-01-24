<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Command;

    use \Symfony\Component\Console\Input\InputInterface;
    use \Symfony\Component\Console\Output\OutputInterface;

    class LocateCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
    {
        /**
         * {@inheritDoc}
         */
        protected function configure()
        {
            $this
                ->setName('landmarx_geo_location:locator:locate')
                ->setDescription('Stuff.')
            ;
        }

        /**
         * {@inheritDoc}
         */
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $this
                ->getContainer()
                ->get('landmarx_geo_location.locator')
            ;
        }
    }
