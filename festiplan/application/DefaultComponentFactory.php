<?php
/*
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2023   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace application;

use controllers\DashboardController;
use controllers\FestivalController;
use controllers\HomeController;
use controllers\DeconnexionController;
use controllers\CreerUserController;
use controllers\SpectacleController;
use controllers\PlanificationController;
use services\FestivalsService;
use services\PlanificationService;
use services\SpectaclesService;
use services\UsersService;

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
        return new FestivalController(new FestivalsService());
    }

    private function buildSpectacleController(): SpectacleController
    {
        return new SpectacleController(new SpectaclesService());

    }

    private function buildPlanificationController(): PlanificationController
    {
        return new PlanificationController( new PlanificationService(), new FestivalsService());

    }
}

