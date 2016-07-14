<?php

namespace Vehsamrak\Jiratool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Vehsamrak
 */
class ContainerAwareCommand extends Command
{

    /** @var ContainerInterface */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    /**
     * @param string $serviceName
     * @return object
     */
    public function get(string $serviceName)
    {
        return $this->container->get($serviceName);
    }
}
