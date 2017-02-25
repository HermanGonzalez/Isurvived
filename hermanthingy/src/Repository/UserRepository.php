<?php

namespace ISurvived\Demo\Repository;

use ISurvived\Demo\Entity\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(User $user)
    {
        $user->setId(uniqid());

        return $user;
    }
}
