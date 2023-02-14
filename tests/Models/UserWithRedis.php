<?php

namespace Jmitech\Model\Settings\Tests\Models;

use Jmitech\Model\Settings\Traits\HasSettingsRedis;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserWithRedis
 * @package Jmitech\Model\Settings\Tests\Models
 * @method static first()
 */
class UserWithRedis extends Model
{
    use HasSettingsRedis;

    protected $table = 'users';

    protected $guarded = [];

    protected $fillable = ['id', 'name'];

    public $defaultSettings = [];

    public $settingsRules = [];
}
