<?php
    namespace Landmarx\Bundle\GeoLocationBundle\DependencyInjection;

    use Symfony\Component\DependencyInjection\Definition;
    use Symfony\Component\DependencyInjection\Reference;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\DependencyInjection\Extension;

    /**
     * This is the class that loads and manages your bundle configuration
     *
     * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
     */
    class LandmarxGeoLocationExtension extends Extension
    {
        /**
         * {@inheritDoc}
         */
        public function load(array $configs, ContainerBuilder $container)
        {
            $config = $this->processConfiguration(
                new Configuration(),
                $configs
            );

            $factories = $this->loadFactories($config, $container);
            $this->loadBalancer($config, $container);
            $this->loadHandlers($config, $container);
            $this->loadProviders($config, $container, $factories);
        }

        /**
         * @param array $config
         * @param ContainerBuilder $container
         *
         * @return Array<Definition>
         */
        protected function loadFactories(array $config, ContainerBuilder $container)
        {
            $result = array();

            foreach (array('address', 'coordinates') as $entity) {
                $result[] = $container->setDefinition(
                    sprintf('landmarx_geo_location.%s_factory', $entity),
                    new Definition(
                        $config[$entity]['factory_class'],
                        array(
                            $config[$entity]['entity_class'],
                        )
                    )
                );
            }

            return $result;
        }

        /**
         * Load balancer service
         *
         * @param array            $config
         * @param ContainerBuilder $container
         */
        protected function loadBalancer(array $config, ContainerBuilder $container)
        {
            $container->register(
                'landmarx_geo_location.balancer.random_strategy',
                'Landmarx\Bundle\GeoLocationBundle\Domain\BalancingStrategy\RandomStrategy'
            );

            $container->setAlias(
                'landmarx_geo_location.balancer.strategy',
                $config['balancer']['strategy']
            );

            $container
                ->register(
                    'landmarx_geo_location.balancer_factory.default',
                    'Landmarx\Bundle\GeoLocationBundle\Domain\BalancerFactory'
                )
                ->addArgument(
                    'Landmarx\Bundle\GeoLocationBundle\Domain\Balancer'
                )
                ->addArgument(
                    new Reference('landmarx_geo_location.balancer.strategy')
                )
            ;

            $container->setAlias(
                'landmarx_geo_location.balancer_factory',
                $config['balancer']['factory']
            );
        }

        /**
         * @param array $config
         * @param ContainerBuilder $container
         *
         * @return void
         */
        protected function loadHandlers(array $config, ContainerBuilder $container)
        {
            $container->setDefinition(
                'landmarx_geo_location.distance_calculator',
                new Definition($config['handlers']['distance_calculator'])
            );

            $container->setDefinition(
                'landmarx_geo_location.locator',
                new Definition(
                    $config['handlers']['locator_manager'],
                    array(
                        new Reference('landmarx_geo_location.balancer_factory'),
                        new Reference('logger'),
                    )
                )
            );
        }

        /**
         * @param array $config
         * @param ContainerBuilder $container
         *
         * @return Array<Definition>
         */
        protected function loadProviders(array $config, ContainerBuilder $container, $model)
        {
            $http_client = $container->setDefinition(
                'landmarx_geo_location.http_client',
                new Definition(
                    'Guzzle\Http\Client'
                )
            );

            $result = array();

            foreach ($config['providers'] as $name => $params) {
                if ($params['activated']) {
                    $result[] = $this->loadProvider(
                        $container,
                        $name,
                        $params,
                        $http_client,
                        $model
                    );
                }
            }

            return $result;
        }

        /**
         * @param ContainerBuilder $container
         * @param string $name
         * @param array $params
         * @param Definition $http_client
         * @param Array<Definition> $factories
         *
         * @return Definition
         */
        protected function loadProvider(ContainerBuilder $container, $name, array $params, Definition $http_client, array $factories)
        {
            $container->setParameter(
                sprintf('geo_location_%s_api_key', $name),
                'null'
            );

            $hydrator = $container->setDefinition(
                sprintf('landmarx_geo_location.%s_hydrator', $name),
                new Definition(
                    $params['hydrator_class'],
                    $factories
                )
            );

            $definition = new Definition(
                $params['locator_class'],
                array(
                    $hydrator,
                    $http_client,
                    new Reference('logger'),
                    $params['api_key'],
                    $params['api_endpoint']
                )
            );

            $definition->addTag('landmarx_geo_location.locator');

            $container->setDefinition(
                sprintf('landmarx_geo_location.%s_locator', $name),
                $definition
            );

            return $definition;
        }
    }
