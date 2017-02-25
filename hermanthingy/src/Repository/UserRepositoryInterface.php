<?php

namespace ISurvived\Demo\Repository;

use ISurvived\Demo\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return User
     */
    public function create(User $user);
}
