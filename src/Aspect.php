<?php declare(strict_types=1);

namespace rikmeijer\goji;

class Aspect
{

    public static function wrap(object $object)
    {
        $class = get_class($object);
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
