<?php

namespace Jmitech\Model\Settings\Tests\Models;

use Jmitech\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserWithField
 * @package Jmitech\Model\Settings\Tests\Models
 * @method static first()
 */
class UserWithField extends Model
{
    use HasSettingsField;

    //protected $persistSettings = true;

    protected $table = 'users_with_field';

    protected $guarded = [];

    protected $fillable = ['id', 'name'];

    public $defaultSettings = [];

    public $settingsRules = [];
}
