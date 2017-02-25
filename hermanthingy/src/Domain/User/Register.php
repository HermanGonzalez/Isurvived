<?php

namespace ISurvived\Demo\Domain\User;

use ISurvived\Demo\Entity\User;
use ISurvived\Demo\Helper\RandomPasswordGenerator;
use ISurvived\Demo\Repository\UserRepositoryInterface;

class Register
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * @var RandomPasswordGenerator
     */
    private $passwordGenerator;

    public function __construct(UserRepositoryInterface $repository, RandomPasswordGenerator $passwordGenerator)
    {
        $this->repository = $repository;
        $this->passwordGenerator = $passwordGenerator;
    }

    public function execute(User $user)
    {
        $user->setPassword($this->passwordGenerator->generate());

        if($this->repository->create($user)){
            return $user;
        };
    }
}
