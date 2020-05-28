<?php declare(strict_types=1);

namespace rikmeijer\goji;

use ReflectionObject;

class Aspect
{

    public static function wrap(object $object)
    {
        $reflection = new ReflectionObject($object);
        $class = $reflection->getName();
        $wrapper = eval(<<<EOT
return new class extends {$class} {
    private object \$object;
    public function __construct() {}
    public function withObject(object \$object) {
        \$this->object = \$object;
        return \$this;
    }

//    public function answer(\\rikmeijer\\goji\\Answer \$answer) : \\rikmeijer\\goji\\Answer {
//        trigger_error("What?");
//    }
};
EOT);
        return $wrapper->withObject($object);
    }
}
