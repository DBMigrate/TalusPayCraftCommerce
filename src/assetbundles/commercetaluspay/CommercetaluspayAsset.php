<?php
/**
 * commerce-taluspay plugin for Craft CMS 3.x
 *
 * taluspay plugin for craft commerce
 *
 */

namespace commercetaluspay\assetbundles\Commercetaluspay;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    leszczuu
 * @package   Commercetaluspay
 * @since     0.1
 */
class CommercetaluspayAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@DBMigrate/commercetaluspay/assetbundles/commercetaluspay/dist";

        $this->depends = [

        ];

        $this->js = [
        ];

        $this->css = [
        ];

        parent::init();
    }
}
