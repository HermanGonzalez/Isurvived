<?php

include_once __DIR__ . '/vendor/autoload.php';

use App\ISurvived\Demo\DICFactory;
use ISurvived\Demo\Command\User\RegisterUserCommand;
use ISurvived\Demo\Exception\ValidationException;
use League\Tactician\CommandBus;

$dependencyContainer = DICFactory::getInstance();

$commandBus = $dependencyContainer[CommandBus::class];

$command = new RegisterUserCommand('Jhuliano', 'Moreno');

try {
    $registeredUser = $commandBus->handle($command);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
    exit(-1);
}

echo sprintf('%s was registered%s', $registeredUser->getFullName(), PHP_EOL);
exit(0);
