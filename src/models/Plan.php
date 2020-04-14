<?php

namespace DBMigrate\commercetaluspay\models;

use craft\commerce\base\PlanInterface;

class Plan extends \craft\commerce\base\Plan
{

    public function canSwitchFrom(PlanInterface $currentPlant): bool
    {
        return false;
    }
}