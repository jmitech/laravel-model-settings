<?php

namespace Jmitech\Model\Settings\Managers;

use Jmitech\Model\Settings\Contracts\SettingsManagerContract;

/**
 * Class FieldSettingsManager
 * @package Jmitech\Model\Settings\Managers
 * @property \Illuminate\Database\Eloquent\Model|\Jmitech\Model\Settings\Traits\HasSettingsField $model
 */
class FieldSettingsManager extends AbstractSettingsManager
{
    /**
     * @param  array  $settings
     * @return \Jmitech\Model\Settings\Contracts\SettingsManagerContract
     */
    public function apply(array $settings = []): SettingsManagerContract
    {
        $this->validate($settings);

        $this->model->{$this->model->getSettingsFieldName()} = json_encode($settings);
        if ($this->model->isPersistSettings()) {
            $this->model->save();
        }

        return $this;
    }
}
