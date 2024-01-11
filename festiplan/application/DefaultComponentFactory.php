<?php
namespace application;

use controllers\DashboardController;
use controllers\FestivalController;
use controllers\HomeController;
use controllers\DeconnexionController;
use controllers\CreerUserController;
use controllers\SpectacleController;
use controllers\PlanificationController;
use controllers\CreerIntervenantController;

use services\CategoriesService;
use services\FestivalsService;
use services\PlanificationService;
use services\SpectaclesService;
use services\UsersService;
use services\CreerIntervenantService;

use yasmf\ComponentFactory;
use yasmf\NoControllerAvailableForNameException;
use yasmf\NoServiceAvailableForNameException;

/**
 *  The controller factory
 */
class DefaultComponentFactory implements ComponentFactory
{

    private ?UsersService $usersService = null;

    /**
     * @param string $controller_name the name of the controller to instanciate
     * @return mixed the controller
     * @throws NoControllerAvailableForNameException when controller is not found
     */
    public function buildControllerByName(string $controller_name): mixed
    {
        return match ($controller_name) {
            "Home" => $this->buildHomeController(),
            "Dashboard" => $this->buildDashboardController(),
            "Deconnexion" => $this->buildDeconnexionController(),
            "CreerUser" => $this->buildCreerUserController(),
            "festival" => $this->buildFestivalController(),
            "spectacle" => $this->buildSpectacleController(),
            "planification" => $this->buildPlanificationController(),
            "creerIntervenant" => $this->buildCreerIntervenantController(),
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
            // TODO ajouter des correspondances
            default => $this->buildUsersService()
        // TODO changer le default
        };
    }


    /**
     * @return HomeController
     */
    private function buildHomeController(): HomeController
    {
        return new HomeController($this->buildUsersService());
    }

    /**
     * @return UsersService
     */
    private function buildUsersService(): UsersService
    {
        if ($this->usersService == null) {
            $this->usersService = new UsersService();
        }
        return $this->usersService;
    }

    private function buildDashboardController(): DashboardController
    {
        return new DashboardController(new FestivalsService(), new SpectaclesService());
    }

    private function buildDeconnexionController(): DeconnexionController
    {
        return new DeconnexionController();
    }


    /**
     * @return CreerUserController
     */
    private function buildCreerUserController(): CreerUserController
    {
        return new CreerUserController($this->buildUsersService());
    }

    private function buildFestivalController(): FestivalController
    {
        return new FestivalController(new FestivalsService(), new CategoriesService());
    }

    private function buildSpectacleController(): SpectacleController
    {
        return new SpectacleController(new SpectaclesService());

    }

    private function buildPlanificationController(): PlanificationController
    {
        return new PlanificationController(new PlanificationService(), new FestivalsService());

    }

    private function buildCreerIntervenantController(): CreerIntervenantController
    {
        return new CreerIntervenantController(new CreerIntervenantService(), new UsersService());
    }
}

