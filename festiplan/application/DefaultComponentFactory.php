<?php

namespace application;

use controllers\HomeController;

use services\ExampleService;

use yasmf\ComponentFactory;
use yasmf\NoControllerAvailableForNameException;
use yasmf\NoServiceAvailableForNameException;

/**
 *  The controller factory
 */
class DefaultComponentFactory implements ComponentFactory
{
    private ?ExampleService $exampleService = null;

    /**
     * @param string $controller_name the name of the controller to instanciate
     * @return mixed the controller
     * @throws NoControllerAvailableForNameException when controller is not found
     */
    public function buildControllerByName(string $controller_name): mixed
    {
        return match ($controller_name) {
            "Home" => $this->buildHomeController(),
            default => throw new NoControllerAvailableForNameException($controller_name)
        };
    }

    /**
     * @param string $service_name the name of the service
     * @return mixed the created service
     * @throws NoServiceAvailableForNameException when service is not found
     */
    public function buildServiceByName(string $service_name): mixed
    {
        return match ($service_name) {
            "Example" => $this->buildExampleService(),
            default => throw new NoServiceAvailableForNameException($service_name)
        };
    }


    /**
     * @return HomeController
     */
    private function buildHomeController(): HomeController
    {
        return new HomeController($this->buildExampleService());
    }

    /**
     * @return ExampleService
     */
    private function buildExampleService(): ExampleService
    {
        if ($this->exampleService == null) {
            $this->exampleService = new ExampleService();
        }
        return $this->exampleService;
    }

}