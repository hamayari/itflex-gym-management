<?php

namespace App\Validator\Constraints;

use App\Entity\Activites;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class IsCoachAvailableValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof Activites) {
            return;
        }

        $dateDeb = $value->getDateDeb();
        $idUser = $value->getIdUser();

        // Check if the coach has activities on the specified date
        $existingActivity = $this->entityManager->getRepository(Activites::class)
            ->findOneBy([
                'idUser' => $idUser,
                'dateDeb' => $dateDeb,
            ]);

        if ($existingActivity) {
            $this->context->buildViolation($constraint->message)
                ->atPath('idUser') // Specify the field that the error is associated with
                ->addViolation();
        }
    }
}