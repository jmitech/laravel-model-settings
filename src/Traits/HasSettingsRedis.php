<?php

namespace Jmitech\Model\Settings\Traits;

use Jmitech\Model\Settings\Contracts\SettingsManagerContract;
use Jmitech\Model\Settings\Managers\RedisSettingsManager;
use Illuminate\Support\Facades\Redis;

/**
 * Trait HasSettingsRedis
 * @package Jmitech\Model\Settings\Traits
 * @property array $settings
 */
trait HasSettingsRedis
{
    use HasSettings;

    /**
     * @return \Jmitech\Model\Settings\Contracts\SettingsManagerContract
     * @throws \Jmitech\Model\Settings\Exceptions\ModelSettingsException
     */
    public function settings(): SettingsManagerContract
    {
        return new RedisSettingsManager($this);
    }

    public function getSettingsValue(): array
    {
        $redisValue = Redis::connection()->get($this->cacheKey());
        $value = json_decode($redisValue, true);

        return is_array($value) ? $value : [];
    }

    public function cacheKey(string $key = null): string
    {
        return sprintf(
            "r-k-%s:%s",
            $this->getTable(),
            $this->getKey()
        ) . $key;
    }

    abstract public function getTable();

    abstract public function getKey();
}
