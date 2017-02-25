<?php

use ISurvived\Demo\Helper\RandomPasswordGenerator;

class RandomPasswordGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function test_that_password_is_different_each_time()
    {
        $generator = new RandomPasswordGenerator();

        $passwords = [];

        for($i = 0; $i < 10; $i++){
            $passwords[] = $generator->generate();
        }

        $this->assertCount(count($passwords), array_unique($passwords));
    }
}
