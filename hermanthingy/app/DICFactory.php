<?php

namespace App\ISurvived\Demo;

use ISurvived\Demo\Command\User\RegisterUserCommand;
use ISurvived\Demo\Domain\User\Register;
use ISurvived\Demo\Handler\User\RegisterUserHandler;
use ISurvived\Demo\Helper\RandomPasswordGenerator;
use ISurvived\Demo\Repository\UserRepository;
use ISurvived\Demo\Repository\UserRepositoryInterface;
use League\Tactician\CommandBus;
use League\Tactician\Setup\QuickStart;
use Pimple\Container;

class DICFactory
{
    /**
     * @return Container
     */
    public static function getInstance()
    {
        $container = new Container();

        $container[RandomPasswordGenerator::class] = function () {
            return new RandomPasswordGenerator();
        };

        $container[UserRepositoryInterface::class] = function () {
            return new UserRepository();
        };

        $container[Register::class] = function ($container) {
            return new Register($container[UserRepositoryInterface::class], $container[RandomPasswordGenerator::class]);
        };

        $container[RegisterUserHandler::class] = function ($container) {
            return new RegisterUserHandler($container[Register::class]);
        };

        $container[CommandBus::class] = function ($container) {
            return QuickStart::create([
                RegisterUserCommand::class => ($container[RegisterUserHandler::class]),
            ]);
        };

        return $container;
    }
}
