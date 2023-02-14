<?php

namespace Jmitech\Model\Settings\Tests\Models;

use Jmitech\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WrongUserWithField
 * @package Jmitech\Model\Settings\Tests\Models
 * @method static first()
 */
class WrongUserWithField extends Model
{
    use HasSettingsField;

    protected $table = 'wrong_users';

    protected $guarded = [];

    protected $fillable = ['id', 'name'];
}
