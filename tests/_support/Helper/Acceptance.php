<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module;
use tidy;

class Acceptance extends Module
{

    final public function seeValidHTML(string $source): void
    {
        $tidy = new tidy();
        $tidy->parseString($source, [], 'utf8');
        $this->assertNull($tidy->errorBuffer);
    }
}
