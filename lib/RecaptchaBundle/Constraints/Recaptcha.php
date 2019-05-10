<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 10/05/2019
 * Time: 12:48
 */

namespace Mig\RecaptchaBundle\Constraints;


use Symfony\Component\Validator\Constraint;

class Recaptcha extends Constraint
{
    public $message = 'Invalid Captcha';
}