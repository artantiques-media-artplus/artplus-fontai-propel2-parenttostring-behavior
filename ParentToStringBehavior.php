<?php
namespace Fontai\Propel\Behavior\ParentToString;

use Propel\Generator\Builder\Om\ObjectBuilder;
use Propel\Generator\Model\Behavior;


class ParentToStringBehavior extends Behavior
{
  public function objectFilter(
    string &$script,
    ObjectBuilder $builder
  )
  {
    if (!$builder->getBehaviorContent('parentClass') && !$builder->getTable()->getBaseClass())
    {
      return;
    }

    $script = preg_replace('~(public function __toString\(\)\s+\{\s+)~', "$1if (is_callable('parent::__toString'))
        {
            return parent::__toString();
        }\n\n        ", $script);
  }
}