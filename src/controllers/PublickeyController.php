<?php

namespace leszczuucommercepaytrace\commercepaytrace\controllers;

use craft\web\Controller;

class PublickeyController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['publickey'];

    public function actionPublickey()
    {
        $result = 'Welcome to the TestController actionIndex() method';

        return $this->asJson([
            'foo' => true,
        ]);
    }

}