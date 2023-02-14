<?php

namespace Jmitech\Model\Settings\Traits;

use Jmitech\Model\Settings\Contracts\SettingsManagerContract;
use Jmitech\Model\Settings\Managers\TableSettingsManager;
use Jmitech\Model\Settings\Models\ModelSettings;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Cache;

/**
 * Trait HasSettingsTable
 * @package Jmitech\Model\Settings\Traits
 * @property ModelSettings $modelSettings
 * @property array $settings
 * @method morphOne($model, $name)
 */
trait HasSettingsTable
{
    use HasSettings;

    /**
     * @return \Jmitech\Model\Settings\Contracts\SettingsManagerContract
     * @throws \Jmitech\Model\Settings\Exceptions\ModelSettingsException
     */
    public function settings(): SettingsManagerContract
    {
        return new TableSettingsManager($this);
    }

    /**
     * @return array
     */
    public function getSettingsValue(): array
    {
        if (config('model_settings.settings_table_use_cache')) {
            return Cache::rememberForever($this->getSettingsCacheKey(), function () {
                return $this->__getSettingsValue();
            });
        }

        return $this->__getSettingsValue();
    }

    private function __getSettingsValue(): array
    {
        if ($modelSettings = $this->modelSettings()->first()) {
            return $modelSettings->settings;
        }

        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function modelSettings(): MorphOne
    {
        return $this->morphOne(ModelSettings::class, 'model');
    }

    public function getSettingsCacheKey(): string
    {
        return config('model_settings.settings_table_cache_prefix') . $this->getTable() . '::' . $this->getKey();
    }

    abstract public function getTable();
}
