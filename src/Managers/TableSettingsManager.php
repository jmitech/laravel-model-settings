<?php

namespace Jmitech\Model\Settings\Managers;

use Jmitech\Model\Settings\Contracts\SettingsManagerContract;
use Jmitech\Model\Settings\Models\ModelSettings;

/**
 * Class TableSettingsManager
 * @package Jmitech\Model\Settings\Managers
 * @property  \Illuminate\Database\Eloquent\Model|\Jmitech\Model\Settings\Traits\HasSettingsTable $model
 */
class TableSettingsManager extends AbstractSettingsManager
{
    /**
     * @param  array  $settings
     * @return \Jmitech\Model\Settings\Contracts\SettingsManagerContract
     * @throws \Exception
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    public function apply(array $settings = []): SettingsManagerContract
    {
        $this->validate($settings);

        $modelSettings = $this->model->modelSettings()->first();
        if (!count($settings)) {
            if ($modelSettings) {
                $modelSettings->delete();
            }
        } else {
            if (!$modelSettings) {
                $modelSettings = new ModelSettings();
                $modelSettings->setConnection($this->model->getConnectionName());
                $modelSettings->model()->associate($this->model);
            }
            $modelSettings->settings = $settings;
            $modelSettings->save();
        }

        cache()->forget($this->model->getSettingsCacheKey());

        return $this;
    }
}
