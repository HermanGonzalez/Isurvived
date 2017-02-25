<?php

namespace Tests\ISurvived\Demo\Domain\User;

use ISurvived\Demo\Domain\User\Register;
use ISurvived\Demo\Entity\User;
use ISurvived\Demo\Helper\RandomPasswordGenerator;
use ISurvived\Demo\Repository\UserRepositoryInterface;
use Prophecy\Argument;

class RegisterTest extends \PHPUnit_Framework_TestCase
{
    public function test_should_add_a_random_password_and_then_save_the_user()
    {
        $password = uniqid();

        $passwordGeneratorMock = $this->prophesize(RandomPasswordGenerator::class);
        $passwordGeneratorMock->generate()->shouldBeCalled()->willReturn($password);

        $userMock = $this->prophesize(User::class);
        $userMock->setPassword($password)->shouldBeCalled()->willReturn($userMock);

        $user = $userMock->reveal();

        $repository = $this->prophesize(UserRepositoryInterface::class);
        $repository->create($user)->shouldBeCalled()->willReturn($user);

        $domain = new Register($repository->reveal(), $passwordGeneratorMock->reveal());

        $this->assertEquals($user, $domain->execute($user));
    }
}
