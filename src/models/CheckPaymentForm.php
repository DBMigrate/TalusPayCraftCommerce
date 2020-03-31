<?php

namespace leszczuucommercepaytrace\commercepaytrace\models;

use craft\commerce\models\payments\BasePaymentForm;

class CheckPaymentForm extends BasePaymentForm
{

    /**
     * @var string First name
     */
    public $firstName;

    /**
     * @var string Last name
     */
    public $lastName;

    /**
     * @var int Account number
     */
    public $bankAccount;

    /**
     * @var int Routing number
     */
    public $routingNumber;

    /**
     * @var string Token
     */
    public $token;

    /**
     * @inheritdoc
     */
    public function setAttributes($values, $safeOnly = true)
    {
        parent::setAttributes($values, $safeOnly);

        $this->bankAccount = preg_replace('/\D/', '', $values['bankAccount'] ?? '');
        $this->routingNumber= preg_replace('/\D/', '', $values['routingNumber'] ?? '');

    }

    /**
     * @inheritdoc
     */
    public function defineRules(): array
    {
        $rules = parent::defineRules();

        $rules[] = [['firstName', 'lastName', 'bankAccount', 'routingNumber'], 'required'];
        $rules[] = [['bankAccount', 'routingNumber'], 'integer', 'integerOnly' => true];

        return $rules;
    }
}