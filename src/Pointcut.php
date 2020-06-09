<?php declare(strict_types=1);

namespace rikmeijer\𓀁;

class Pointcut
{
    private $before;

    public function triggerBefore()
    {
        call_user_func_array($this->before, func_get_args());
    }

    public function withBefore(callable $before)
    {
        $pointcut = clone $this;
        $pointcut->before = $before;
        return $pointcut;
    }
}
