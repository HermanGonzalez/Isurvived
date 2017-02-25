<?php

namespace ISurvived\Demo\Handler\User;

use ISurvived\Demo\Command\User\RegisterUserCommand;
use ISurvived\Demo\Domain\User\Register;
use ISurvived\Demo\Entity\User;
use ISurvived\Demo\Exception\ValidationException;

class RegisterUserHandler
{
    /**
     * @var Register
     */
    private $register;

    /**
     * RegisterUserHandler constructor.
     *
     * @param Register $domainRegister
     */
    public function __construct(Register $domainRegister)
    {
        $this->register = $domainRegister;
    }

    /**
     * @param RegisterUserCommand $command
     *
     * @return User
     * @throws ValidationException
     */
    public function handle(RegisterUserCommand $command)
    {
        $errors = [];
        if(strlen($command->lastName) < 3){
            $errors[] = 'Surname is too short';
        }

        if(strlen($command->firstName) < 3){
            $errors[] = 'First name is too short';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }

        $user = (new User())
            ->setFirstName($command->firstName)
            ->setLastName($command->lastName);

        return $this->register->execute($user);
    }
}
