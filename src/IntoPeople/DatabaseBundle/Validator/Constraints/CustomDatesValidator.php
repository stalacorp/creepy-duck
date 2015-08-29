<?php
/**
 * Created by PhpStorm.
 * User: Bart
 * Date: 29/08/2015
 * Time: 11:26
 */

namespace IntoPeople\DatabaseBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class CustomDatesValidator extends ConstraintValidator{
    public function validate($protocol, Constraint $constraint)
    {
        if ($protocol->getStartdatecdp() > $protocol->getEnddatecdp()) {
            // If you're using the new 2.5 validation API (you probably are!)
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', 'test')
                ->atPath('startdatecdp')
                ->addViolation();
        }
        if ($protocol->getStartdatemidyear() > $protocol->getEnddatemidyear()) {
            // If you're using the new 2.5 validation API (you probably are!)
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', 'test')
                ->atPath('startdatemidyear')
                ->addViolation();
        }

        if ($protocol->getStartdateyearend() > $protocol->getEnddateyearend()) {
            // If you're using the new 2.5 validation API (you probably are!)
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', 'test')
                ->atPath('startdateyearend')
                ->addViolation();
        }

    }

} 