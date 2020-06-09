<?php declare(strict_types=1);

namespace rikmeijer\𓀁;

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
    public function withPointcut(\\rikmeijer\\𓀁\\Pointcut \$pointcut) {
        \$wrapper = clone \$this;
        \$wrapper->pointcut = \$pointcut;
        return \$wrapper;
    }


    public function answer(\\rikmeijer\\𓀁\\Answer \$answer) : \\rikmeijer\\𓀁\\Answer {
        isset(\$this->pointcut) && \$this->pointcut->triggerBefore(\$answer);
        return parent::answer(\$answer);
    }
};
EOT);
        return $wrapper->withObject($object);
    }
}
