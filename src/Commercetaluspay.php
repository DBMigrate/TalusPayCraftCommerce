<?php
/**
 * commerce-taluspay plugin for Craft CMS 3.x
 *
 * Taluspay plugin for craft commerce
 *
 * @link      github.com/DBMigrate
 * @copyright Copyright (c) 2020 DBMigrate
 */

namespace DBMigrate\commercetaluspay;

use commercetaluspay\fields\CommercetaluspayField;
use commercetaluspay\services\CommercetaluspayService;
use commercetaluspay\widgets\CommercetaluspayWidget;

use Craft;
use craft\base\Plugin;
use craft\commerce\services\Gateways;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;

use DBMigrate\commercetaluspay\controllers\DefaultController;
use DBMigrate\commercetaluspay\gateways\GatewayCard;
use DBMigrate\commercetaluspay\gateways\GatewayCheck;
use DBMigrate\commercetaluspay\models\Settings;
use DBMigrate\commercetaluspay\utilities\CommercetaluspayUtility;
use yii\base\Event;

/**
 * Class CommerceTaluspay
 *
 * @author    DBMigrate
 * @package   CommerceTaluspay
 * @since     0.1
 *
 */
class CommerceTaluspay extends Plugin
{


    // Static Properties
    // =========================================================================

    /**
     * @var Commercetaluspay
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.1';


    /** @var array */
    public $controllerMap = [
        'publickey' => DefaultController::class,
    ];


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;


        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_SITE_URL_RULES, function(RegisterUrlRulesEvent $event) {
            $event->rules['gateway/publickey/(?P<handle>\w+)'] = 'publickey/publickey';
        });



        Event::on(Gateways::class, Gateways::EVENT_REGISTER_GATEWAY_TYPES,  function(RegisterComponentTypesEvent $event) {
            $event->types[] = GatewayCard::class;
            $event->types[] = GatewayCheck::class;
        });

        Craft::info(
            Craft::t(
                'commerce-taluspay',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

}
