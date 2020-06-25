<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use Facebook\WebDriver\WebDriver;
use Psr\Http\Message\ResponseInterface;
use tidy;

class Visitor
{
    private WebDriver $driver;
    private ResponseInterface $response;

    public function __construct(WebDriver $driver, ResponseInterface $response)
    {
        $this->driver = $driver;
        $this->response = $response;
    }

    final public function validate(): ?string
    {
        $tidy = new tidy();
        $tidy->parseString($this->response->getBody()->getContents(), [], 'utf8');
        return $tidy->errorBuffer;
    }
}
