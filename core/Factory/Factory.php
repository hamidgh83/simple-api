<?php

namespace Core\Factory;

use Core\Service\ServiceInterface;
use RuntimeException;

class Factory
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    private $service;

    /**
     * @var array
     */
    private $options;

    public function __construct($name, ...$params)
    {
        $this->config = require(__DIR__ . '/../../config/factory.php');

        $factories = $this->config['factories'];
        $aliases   = $factories['services'] ?? [];

        if (isset($aliases[$name])) {
            $this->service = $aliases[$name];
        } else {
            $this->service = $name;
        }

        $this->options = $params;
    }

    public function make(): ServiceInterface
    {
        if (! class_exists($this->service)) {
            throw new RuntimeException(sprintf("The class %s does not exist.", $this->service), 500);
        }

        return new $this->service(...$this->options);
    }
}
