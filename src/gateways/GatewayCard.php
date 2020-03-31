<?php

namespace leszczuucommercepaytrace\commercepaytrace\gateways;

use Craft;
use craft\commerce\omnipay\base\CreditCardGateway;
use craft\web\View;
use Omnipay\Common\AbstractGateway;
use Omnipay\Paytrace\CreditCardGateway as CreditCartGatewayOmnipay;

class GatewayCard extends CreditCardGateway
{
    /** @var string */
    public $user;

    /** @var string */
    public $password;

    /** @var string */
    public $integratorId;

    /** @var bool */
    public $supportsVisa;

    /** @var bool */
    public $supportsMastercard;

    /** @var bool */
    public $supportsAmericanExpress;

    /** @var bool */
    public $supportsDiscovery;

    protected function createGateway(): AbstractGateway
    {
        /** @var CreditCartGatewayOmnipay $gateway */
        $gateway = static::createOmnipayGateway($this->getGatewayClassName());

        $gateway->setUserName(Craft::parseEnv($this->user));
        $gateway->setPassword(Craft::parseEnv($this->password));
        $gateway->setIntegratorId('92400UL8ObAn');

        $gateway->setSupportsVisa(1);
        $gateway->setSupportsMastercard(1);
        $gateway->setSupportsAmericanExpress(1);
        $gateway->setSupportsDiscover(1);

        return $gateway;
    }

    protected function getGatewayClassName()
    {
        return '\\' . CreditCartGatewayOmnipay::class;
    }

    public static function displayName(): string
    {
        return Craft::t('commerce', 'Talus Pay credit card');
    }

    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('commerce-paytrace/Card/gatewaySettings', ['gateway' => $this]);
    }


    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getIntegratorId(): string
    {
        return $this->integratorId;
    }

    public function getPaymentFormHtml(array $params)
    {


        $defaults = [
            'paymentForm' => $this->getPaymentFormModel(),
            'visa_icon' => \Craft::$app->assetManager->getPublishedUrl('@leszczuucommercepaytrace/commercepaytrace/img/visa@2x.png', true),
            'supportsVisa' => $this->supportsVisa,
            'mastercard_icon' => \Craft::$app->assetManager->getPublishedUrl('@leszczuucommercepaytrace/commercepaytrace/img/mastercard@2x.png', true),
            'supportsMastercard' => $this->supportsMastercard,
            'amex_icon' => \Craft::$app->assetManager->getPublishedUrl('@leszczuucommercepaytrace/commercepaytrace/img/american-express@2x.png', true),
            'supportsAmex' => $this->supportsAmericanExpress,
            'discovery_icon' => \Craft::$app->assetManager->getPublishedUrl('@leszczuucommercepaytrace/commercepaytrace/img/discover@2x.png', true),
            'supportsDiscovery' => $this->supportsDiscovery,

        ];

        $params = array_merge($defaults, $params);

        $view = Craft::$app->getView();
        $view->registerJsFile('https://api.paytrace.com/assets/e2ee/paytrace-e2ee.js');
        $previousMode = $view->getTemplateMode();
        $view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('commerce-paytrace/Card/paymentForm', $params);
        $view->setTemplateMode($previousMode);

        return $html;
    }

    public function supportsPaymentSources(): bool
    {
        return false;
    }
}