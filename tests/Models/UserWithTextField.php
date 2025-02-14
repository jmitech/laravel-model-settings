<?php

namespace Jmitech\Model\Settings\Tests\Models;

use Jmitech\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserWithTextField
 * @package Jmitech\Model\Settings\Tests\Models
 * @method static first()
 */
class UserWithTextField extends Model
{
    use HasSettingsField;

    //protected $persistSettings = true;

    protected $table = 'users_with_text_field';

    protected $guarded = [];

    protected $fillable = ['id', 'name'];

    public $defaultSettings = [];

    public $settingsRules = [];
}
