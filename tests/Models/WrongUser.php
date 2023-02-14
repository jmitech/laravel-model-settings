<?php

namespace Jmitech\Model\Settings\Tests\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WrongUser
 * @package Jmitech\Model\Settings\Tests\Models
 * @method static first()
 */
class WrongUser extends Model
{
    protected $table = 'wrong_users';

    protected $guarded = [];

    protected $fillable = ['id', 'name'];
}
