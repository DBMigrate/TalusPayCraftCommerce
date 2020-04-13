<?php

namespace leszczuucommercepaytrace\commercepaytrace\controllers;

use craft\commerce\records\Gateway;
use craft\web\Controller;
use leszczuucommercepaytrace\commercepaytrace\gateways\GatewayCard;

class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['publickey'];

    public function init() {
        parent::init();

        $this->defaultAction = 'publickey';
    }

    public function actionPublickey($handle)
    {
        $gateway = Gateway::findOne(['handle'=> $handle, 'type' => GatewayCard::class ]);
        if (! $gateway) {
            return $this->asErrorJson(
                'wrong handle'
            );
        }

        $settings = json_decode($gateway->settings, true);
        return $this->asRaw($settings['publickey']);
    }

}