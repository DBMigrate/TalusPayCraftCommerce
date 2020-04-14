<?php


namespace DBMigrate\commercetaluspay\models;


use craft\commerce\models\payments\BasePaymentForm;
use craft\commerce\models\payments\CreditCardPaymentForm;

class CardPaymentForm extends CreditCardPaymentForm
{
    /** @var string */
    public $encryptedNumber;

    /**
     * @inheritdoc
     */
    public function defineRules(): array
    {
        $rules = BasePaymentForm::defineRules();

        $rules[] = [['firstName', 'lastName', 'month', 'year', 'cvv', 'encryptedNumber'], 'required'];
        $rules[] = [['month'], 'integer', 'integerOnly' => true, 'min' => 1, 'max' => 12];
        $rules[] = [['year'], 'integer', 'integerOnly' => true, 'min' => date('Y'), 'max' => date('Y') + 12];
        $rules[] = [['cvv'], 'integer', 'integerOnly' => true];
        $rules[] = [['cvv'], 'string', 'length' => [3, 4]];

        return $rules;
    }
}