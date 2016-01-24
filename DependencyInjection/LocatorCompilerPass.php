<?php
    namespace Meup\Bundle\GeoLocationBundle\DependencyInjection;

    use \Symfony\Component\DependencyInjection\ContainerBuilder;
    use \Symfony\Component\DependencyInjection\Reference;

    class LocatorCompilerPass implements \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
    {
        /**
         * {@inheritDoc}
         */
        public function process(ContainerBuilder $container)
        {
            $definition = $container->getDefinition(
                'meup_geo_location.locator'
            );
            $taggedServices = $container->findTaggedServiceIds(
                'landmarx_geo_location.locator'
            );

            foreach ($taggedServices as $id => $tags) {
                foreach ($tags as $attributes) {
                    $definition->addMethodCall(
                        'addLocator',
                        array(new Reference($id), $attributes)
                    );
                }
            }
        }
    }
