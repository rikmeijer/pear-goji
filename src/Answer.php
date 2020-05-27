<?php declare(strict_types=1);

namespace rikmeijer\goji;

class Answer
{
    private string $answer;

    /**
     * Answer constructor.
     * @param string $answer
     */
    public function __construct(string $answer)
    {
        $this->answer = $answer;
    }
}
