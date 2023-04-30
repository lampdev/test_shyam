<?php

namespace App\Services;

use anlutro\LaravelSettings\Facades\Setting;
use anlutro\LaravelSettings\SettingsManager as BaseSettingsManager;

class SettingsManager extends BaseSettingsManager
{
    public function allByTenant($tenantId)
    {
        Setting::setExtraColumns(['tenant_id' => $tenantId]);
        return Setting::all();
    }

    public function getByTenant($key, $tenantId, $default = null)
    {
        Setting::setExtraColumns(['tenant_id' => $tenantId]);

        return Setting::get($key, $default);
    }

    public function setByTenant($key, $value, $tenantId): void
    {
        Setting::setExtraColumns(['tenant_id' => $tenantId]);
        Setting::set($key, $value);
    }
}
