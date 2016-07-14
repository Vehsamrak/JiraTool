<?php

namespace Vehsamrak\Jiratool\Service;

use Symfony\Component\Yaml\Yaml;
use Vehsamrak\Jiratool\Exception\ParameterNotFound;

/**
 * @author Vehsamrak
 */
class Config
{

    /** @var array */
    private $config;

    /** @var string */
    private $configPath;

    public function __construct()
    {
        $this->configPath = ROOT_DIRECTORY . '/config/parameters.yml';
        $this->config = Yaml::parse(file_get_contents($this->configPath))['parameters'];
    }

    public function get(string $parameter): string
    {
        if (!key_exists($parameter, $this->config)) {
            throw new ParameterNotFound(sprintf('Parameter %s was not found in %s', $parameter, $this->configPath));
        }

        return (string) $this->config[$parameter];
    }
}
