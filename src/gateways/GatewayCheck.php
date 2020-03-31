<?php

namespace leszczuucommercepaytrace\commercepaytrace\gateways;

use Craft;
use craft\commerce\models\payments\BasePaymentForm;
use craft\commerce\omnipay\base\Gateway;
use craft\commerce\omnipay\base\OffsiteGateway;
use craft\web\View;
use leszczuucommercepaytrace\commercepaytrace\models\CheckPaymentForm;
use Omnipay\Common\AbstractGateway;
use Omnipay\Paytrace\CheckGateway;

class GatewayCheck extends Gateway
{
    /** @var string */
    public $user;

    /** @var string */
    public $password;

    /** @var string */
    public $integratorId;


    protected function createGateway(): AbstractGateway
    {
        /** @var CheckGateway $gateway */
        $gateway = static::createOmnipayGateway($this->getGatewayClassName());

        $gateway->setUserName(Craft::parseEnv($this->user));
        $gateway->setPassword(Craft::parseEnv($this->password));
        $gateway->setIntegratorId('92400UL8ObAn');

        return $gateway;
    }

    protected function getGatewayClassName()
    {
        return '\\' . CheckGateway::class;
    }

    public function getPaymentFormModel(): BasePaymentForm
    {
        return new CheckPaymentForm();
    }

    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('commerce-paytrace/gatewaySettings', ['gateway' => $this]);
    }

    public static function displayName(): string
    {
        return Craft::t('commerce', 'Talus Pay check');
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIntegratorId(): string
    {
        return $this->integratorId;
    }


    public function supportsPaymentSources(): bool
    {
        return false;
    }

    public function getPaymentFormHtml(array $params)
    {
        $defaults = [
            'paymentForm' => $this->getPaymentFormModel()
        ];

        $params = array_merge($defaults, $params);

        $view = Craft::$app->getView();
        $previousMode = $view->getTemplateMode();
        $view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('commerce-paytrace/Check/paymentForm', $params);
        $view->setTemplateMode($previousMode);

        return $html;
    }

    public function populateRequest(array &$request, BasePaymentForm $paymentForm = null)
    {
        /** @var $paymentForm CheckPaymentForm */
        if ($paymentForm && $paymentForm->hasProperty('token') && $paymentForm->token) {
            $request['token'] = $paymentForm->token;
        }
        $request['check'] = [
            'routingNumber' => $paymentForm->routingNumber,
            'bankAccount' => $paymentForm->bankAccount,
            'firstName' => $paymentForm->firstName,
            'lastName' => $paymentForm->lastName,
        ];
    }

}