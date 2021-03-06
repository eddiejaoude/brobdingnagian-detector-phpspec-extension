<?php

namespace Elfiggo\Brobdingnagian\Param;

use PhpSpec\ServiceContainer;

/**
 * Class Params
 * @package Elfiggo\Brobdingnagian\Param
 */
class Params
{
    const CLASS_SIZE = 300;
    const DEPENDENCIES_SIZE = 3;
    const NUMBER_OF_METHODS = 5;
    const NUMBER_OF_INTERFACES = 3;
    const METHOD_SIZE = 15;
    const NUMBER_OF_TRAITS = 1;
    const LIST_BROB = false;
    const CREATE_CSV = false;

    /**
     * @var ServiceContainer
     */
    private $params;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @param ServiceContainer $serviceContainer
     */
    public function __construct(ServiceContainer $serviceContainer)
    {
        $this->input = $serviceContainer->get('console.input');
        $this->params = $serviceContainer->getParam('brobdingnagian');
    }

    /**
     * @return int
     */
    public function getClassSize()
    {
         return (int) $this->params['class-size'] ?: self::CLASS_SIZE;
    }

    /**
     * @return bool
     */
    public function getBrobList()
    {
        return null !== $this->input->getOption('list-brob') ?
            $this->listBrobOption() :
            $this->listBrobConfig();
    }

    /**
     * @return bool
     */
    private function listBrobOption()
    {
        return strtolower($this->input->getOption('list-brob')) == 'true';
    }

    /**
     * @return bool
     */
    private function listBrobConfig()
    {
        return isset($this->params['list-brob']) ? $this->params['list-brob'] : self::LIST_BROB;
    }

    /**
     * @return int
     */
    public function getDependenciesLimit()
    {
        return (int) $this->params['dependencies'] ?: self::DEPENDENCIES_SIZE;
    }

    /**
     * @return int
     */
    public function getNumberOfMethods()
    {
        return (int) $this->params['number-of-methods'] ?: self::NUMBER_OF_METHODS;
    }

    /**
     * @return int
     */
    public function getMethodSize()
    {
        return (int) $this->params['method-size'] ?: self::METHOD_SIZE;
    }

    /**
     * @return bool
     */
    public function getCsv()
    {
        return isset($this->params['create-csv']) ?: self::CREATE_CSV;
    }

    /**
     * @return int
     */
    public function getNumberOfInterfaces()
    {
        return (int) $this->params['number-of-interfaces'] ?: self::NUMBER_OF_INTERFACES;
    }

    /**
     * @return int
     */
    public function getNumberOfTraits()
    {
        return (int) $this->params['number-of-traits'] ?: self::NUMBER_OF_TRAITS;
    }
}
