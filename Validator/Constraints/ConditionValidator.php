<?php

namespace Ruvents\RuworkBundle\Validator\Constraints;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ConditionValidator extends ConstraintValidator
{
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    public function __construct($propertyAccessor = null, ExpressionLanguage $expressionLanguage = null)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Condition) {
            throw new UnexpectedTypeException($constraint, Condition::class);
        }

        $context = $this->context;

        $true = $this->getExpressionLanguage()
            ->evaluate($constraint->expression, [
                'value' => $value,
                'this' => $context->getObject(),
            ]);

        $context->getValidator()
            ->inContext($context)
            ->atPath($context->getPropertyPath())
            ->validate($value, $true ? $constraint->true : $constraint->false);
    }

    private function getExpressionLanguage()
    {
        if (null === $this->expressionLanguage) {
            $this->expressionLanguage = new ExpressionLanguage();
        }

        return $this->expressionLanguage;
    }
}