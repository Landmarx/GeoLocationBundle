<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Domain;

    use Landmarx\Bundle\GeoLocationBundle\Domain\BalancingStrategy\StrategyInterface;

    /**
     * Factory for balancer
     *
     * @author Gilles <gilles@1001pharmacies.com>
     */
    class BalancerFactory implements BalancerFactoryInterface
    {
        const BALANCER_INTERFACE = 'Landmarx\Bundle\GeoLocationBundle\Domain\BalancerInterface';

        /**
         * @var \ReflectionClass
         */
        protected $class;

        /**
         * @var StrategyInterface
         */
        protected $strategy;

        /**
         * @param string $classname
         *
         * @throws InvalidArgumentException
         */
        public function __construct($classname, StrategyInterface $strategy)
        {
            $this->class    = new \ReflectionClass($classname);
            $this->strategy = $strategy;

            if (!$this->class->implementsInterface(self::BALANCER_INTERFACE)) {
                throw new \InvalidArgumentException();
            }
        }

        /**
         * {@inheritDoc}
         */
        public function create(array $locators)
        {
            return $this->class->newInstanceArgs(
                array(
                    $locators,
                    $this->strategy,
                )
            );
        }
    }
