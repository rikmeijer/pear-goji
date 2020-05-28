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
    private object \$pointcut;
    public function __construct() {}
    public function withObject(object \$object) {
        \$this->object = \$object;
        return \$this;
    }
    public function withPointcut(\\rikmeijer\\goji\\Pointcut \$pointcut) {
        \$wrapper = clone \$this;
        \$wrapper->pointcut = \$pointcut;
        return \$wrapper;
    }


    public function answer(\\rikmeijer\\goji\\Answer \$answer) : \\rikmeijer\\goji\\Answer {
        isset(\$this->pointcut) && \$this->pointcut->triggerBefore(\$answer);
        return parent::answer(\$answer);
    }
};
EOT);
        return $wrapper->withObject($object);
    }
}
