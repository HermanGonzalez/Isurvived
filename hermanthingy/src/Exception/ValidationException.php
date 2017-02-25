<?php

namespace ISurvived\Demo\Exception;


class ValidationException extends \Exception
{
    /**
     * @var string[]
     */
    private $messages;

    /**
     * ValidationException constructor.
     *
     * @param string[] $messages
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct(array $messages, $code = 400, \Exception $previous = null)
    {
        $this->messages = $messages;
        parent::__construct(implode(',', $messages), $code, $previous);
    }

    /**
     * @return string[]
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
