<?php

namespace Ruvents\RuworkBundle\Doctrine\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait VisibleTrait
{
    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\NotNull()
     * @Assert\Type("bool")
     *
     * @var bool
     */
    public $visible = false;
}