<?php
/**
 * commerce-paytrace plugin for Craft CMS 3.x
 *
 * paytrace plugin for craft commerce
 *
 * @link      github.com/leszczuu
 * @copyright Copyright (c) 2020 leszczuu
 */

namespace commercepaytrace\assetbundles\Commercepaytrace;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    leszczuu
 * @package   Commercepaytrace
 * @since     0.1
 */
class CommercepaytraceAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@leszczuucommercepaytrace/commercepaytrace/assetbundles/commercepaytrace/dist";

        $this->depends = [
//            CpAsset::class,

        ];

        $this->js = [
//            'js/Commercepaytrace.js',
        ];

        $this->css = [
//            'css/Commercepaytrace.css',
        ];

        parent::init();
    }
}
