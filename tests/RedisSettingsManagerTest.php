<?php

namespace Jmitech\Model\Settings\Tests;

use Jmitech\Model\Settings\Tests\Models\UserWithRedis as User;

class RedisSettingsManagerTest extends TestCase
{
    /** @var \Jmitech\Model\Settings\Tests\Models\UserWithRedis */
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = User::first();
    }

    public function testMarker()
    {
        $this->assertTrue(true);
    }
}
