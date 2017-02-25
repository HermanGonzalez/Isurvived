<?php

namespace ISurvived\Demo\Helper;

class RandomPasswordGenerator
{
    /**
     * @return string
     */
    public function generate()
    {
        return uniqid();
    }
}
