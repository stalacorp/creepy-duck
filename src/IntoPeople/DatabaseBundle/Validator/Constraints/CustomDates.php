<?php
/**
 * Created by PhpStorm.
 * User: Bart
 * Date: 29/08/2015
 * Time: 12:19
 */

namespace IntoPeople\DatabaseBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/** @Annotation */
class CustomDates extends Constraint{
    public $message = '%message%';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
} 