<?php
    namespace Landmarx\Bundle\GeoLocationBundle\DependencyInjection;

    use \Symfony\Component\Config\Definition\Builder\TreeBuilder;
    use \Symfony\Component\Config\Definition\ConfigurationInterface;

    class Configuration implements ConfigurationInterface
    {
        /**
         * {@inheritDoc}
         */
        public function getConfigTreeBuilder()
        {
            $treeBuilder = new TreeBuilder();
            $rootNode    = $treeBuilder->root('landmarx_geo_location');

            $rootNode
                ->children()

                    ->arrayNode('address')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('entity_class')
                                ->defaultValue('Landmarx\Bundle\GeoLocationBundle\Model\Address')
                            ->end()
                            ->scalarNode('factory_class')
                                ->defaultValue('Landmarx\Bundle\GeoLocationBundle\Factory\AddressFactory')
                            ->end()
                        ->end()
                    ->end()

                    ->arrayNode('coordinates')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('entity_class')
                                ->defaultValue('Landmarx\Bundle\GeoLocationBundle\Model\Coordinates')
                            ->end()
                            ->scalarNode('factory_class')
                                ->defaultValue('Landmarx\Bundle\GeoLocationBundle\Factory\CoordinatesFactory')
                            ->end()
                        ->end()
                    ->end()

                    ->arrayNode('handlers')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('distance_calculator')
                                ->defaultValue('Landmarx\Bundle\GeoLocationBundle\Handler\DistanceCalculator')
                            ->end()
                            ->scalarNode('locator_manager')
                                ->defaultValue('Landmarx\Bundle\GeoLocationBundle\Handler\LocatorManager')
                            ->end()
                        ->end()
                    ->end()

                    ->arrayNode('balancer')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('strategy')
                                ->defaultValue('landmarx_geo_location.balancer.random_strategy')
                            ->end()
                            ->scalarNode('factory')
                                ->defaultValue('landmarx_geo_location.balancer_factory.default')
                            ->end()
                        ->end()
                    ->end()

                    ->arrayNode('providers')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode('google')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->booleanNode('activated')->defaultTrue()->end()
                                    ->scalarNode('api_key')->defaultValue('%geo_location_google_api_key%')->cannotBeEmpty()->end()
                                    ->scalarNode('api_endpoint')->defaultValue('https://maps.googleapis.com/maps/api/geocode/json')->end()
                                    ->scalarNode('locator_class')->defaultValue('Landmarx\Bundle\GeoLocationBundle\Provider\Google\Locator')->end()
                                    ->scalarNode('hydrator_class')->defaultValue('Landmarx\Bundle\GeoLocationBundle\Provider\Google\Hydrator')->end()
                                ->end()
                            ->end()
                            ->arrayNode('bing')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->booleanNode('activated')->defaultTrue()->cannotBeEmpty()->end()
                                    ->scalarNode('api_key')->defaultValue('%geo_location_bing_api_key%')->cannotBeEmpty()->end()
                                    ->scalarNode('api_endpoint')->defaultValue('http://dev.virtualearth.net/REST/v1/Locations/')->end()
                                    ->scalarNode('locator_class')->defaultValue('Landmarx\Bundle\GeoLocationBundle\Provider\Bing\Locator')->end()
                                    ->scalarNode('hydrator_class')->defaultValue('Landmarx\Bundle\GeoLocationBundle\Provider\Bing\Hydrator')->end()
                                ->end()
                            ->end()
                            ->arrayNode('mapquest')
                                ->addDefaultsIfNotSet()
                                    ->children()
                                        ->booleanNode('activated')->defaultTrue()->cannotBeEmpty()->end()
                                        ->scalarNode('api_key')->defaultValue('%geo_location_mapquest_api_key%')->end()
                                        ->scalarNode('api_endpoint')->defaultValue('http://open.mapquestapi.com/geocoding/v1')->end()
                                        ->scalarNode('locator_class')->defaultValue('Landmarx\Bundle\GeoLocationBundle\Provider\Mapquest\Locator')->end()
                                        ->scalarNode('hydrator_class')->defaultValue('Landmarx\Bundle\GeoLocationBundle\Provider\Mapquest\Hydrator')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()

                ->end();

            return $treeBuilder;
        }
    }
