<?php

namespace Jmitech\Model\Settings\Managers;

use Jmitech\Model\Settings\Contracts\SettingsManagerContract;
use Illuminate\Support\Facades\Redis;

/**
 * Class FieldSettingsManager
 * @package Jmitech\Model\Settings\Managers
 * @property \Illuminate\Database\Eloquent\Model|\Jmitech\Model\Settings\Traits\HasSettingsRedis $model
 */
class RedisSettingsManager extends AbstractSettingsManager
{
    public function apply(array $settings = []): SettingsManagerContract
    {
        $this->validate($settings);

        Redis::set($this->model->cacheKey(), json_encode($settings));

        return $this;
    }
}
