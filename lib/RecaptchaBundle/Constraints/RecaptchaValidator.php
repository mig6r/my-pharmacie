<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 10/05/2019
 * Time: 12:54
 */

namespace Mig\RecaptchaBundle\Constraints;

use ReCaptcha\ReCaptcha;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RecaptchaValidator extends ConstraintValidator
{
    private $requestStack;
    private $reCaptcha;

    public function __construct(RequestStack $requestStack, ReCaptcha $reCaptcha)
    {
        $this->requestStack = $requestStack;
        $this->reCaptcha = $reCaptcha;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $request = $this->requestStack->getCurrentRequest();
       $recaptchaResponse= $this->requestStack->getCurrentRequest()->request->get('g-recaptcha-response');
       if (empty($recaptchaResponse)){
           $this->addViolation($constraint);
        return;
    }
       $response = $this->reCaptcha
           ->setExpectedHostname($request->getHost())
           ->verify($recaptchaResponse, $request->getClientIp());
        if (!$response->isSuccess()){
            dump($response->getErrorCodes());
            $this->addViolation($constraint);
        }




    }

    private function addViolation(Constraint $constraint){
        $this->context->buildViolation($constraint->message)->addViolation();
    }
}