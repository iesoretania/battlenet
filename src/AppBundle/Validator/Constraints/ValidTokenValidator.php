<?php
/*
  Battlenet

  Copyright (C) 2016: Luis Ramón López López

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see [http://www.gnu.org/licenses/].
*/

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Codigo;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidTokenValidator extends ConstraintValidator
{
    private $em;

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var Codigo|null
         */
        $token = $this->em->getRepository('AppBundle:Codigo')->findOneBy([
            'token' => $value
        ]);

        if (!$token) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
        elseif (null !== $token->getEquipo()) {
            $this->context->buildViolation($constraint->messageUsed)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}
