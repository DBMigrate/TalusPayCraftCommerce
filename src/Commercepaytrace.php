<?php
/**
 * commerce-paytrace plugin for Craft CMS 3.x
 *
 * paytrace plugin for craft commerce
 *
 * @link      github.com/leszczuu
 * @copyright Copyright (c) 2020 leszczuu
 */

namespace leszczuucommercepaytrace\commercepaytrace;

use commercepaytrace\fields\CommercepaytraceField;
use commercepaytrace\services\CommercepaytraceService;
use commercepaytrace\widgets\CommercepaytraceWidget;
use craft\commerce\services\Gateways;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use leszczuucommercepaytrace\commercepaytrace\controllers\DefaultController;
use leszczuucommercepaytrace\commercepaytrace\gateways\GatewayCard;
use leszczuucommercepaytrace\commercepaytrace\gateways\GatewayCheck;
use leszczuucommercepaytrace\commercepaytrace\gateways\GatewaySubscription;
use leszczuucommercepaytrace\commercepaytrace\services\CommercepaytraceService as CommercepaytraceServiceService;
use leszczuucommercepaytrace\commercepaytrace\models\Settings;
use leszczuucommercepaytrace\commercepaytrace\fields\CommercepaytraceField as CommercepaytraceFieldField;
use leszczuucommercepaytrace\commercepaytrace\utilities\CommercepaytraceUtility;
use leszczuucommercepaytrace\commercepaytrace\widgets\CommercepaytraceWidget as CommercepaytraceWidgetWidget;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\services\Utilities;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class Commercepaytrace
 *
 * @author    leszczuu
 * @package   Commercepaytrace
 * @since     0.1
 *
 */
class Commercepaytrace extends Plugin
{


    // Static Properties
    // =========================================================================

    /**
     * @var Commercepaytrace
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
//            $event->types[] = GatewaySubscription::class;
        });

        Craft::info(
            Craft::t(
                'commerce-paytrace',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

}
