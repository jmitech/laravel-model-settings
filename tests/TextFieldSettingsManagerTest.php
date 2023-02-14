<?php

namespace Jmitech\Model\Settings\Tests;

use Jmitech\Model\Settings\Exceptions\ModelSettingsException;
use Jmitech\Model\Settings\Tests\Models\UserWithTextField as User;

class TextFieldSettingsManagerTest extends TestCase
{
    /** @var \Jmitech\Model\Settings\Tests\Models\UserWithTextField */
    protected $model;
    /** @var array */
    protected $testArray = [
        'user' => [
            'first_name' => "John",
            'last_name'  => "Doe",
            'email'      => "john@doe.com",
        ],
    ];
    /** @var array */
    protected $defaultSettingsTestArray = [
        'project' => 'Main Project',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->model = User::first();
    }

    /**
     * @throws \Jmitech\Model\Settings\Exceptions\ModelSettingsException
     */
    public function testIfSettingsIsNotValidJson()
    {
        $this->model->settings = 'Invalid Json';
        $this->model->save();

        $this->assertEquals([], $this->model->settings()->all());
    }

    /**
     * @throws \Jmitech\Model\Settings\Exceptions\ModelSettingsException
     */
    public function testModelArraySettings()
    {
        $testArray = ['a' => 'b'];
        $this->model->settings = $testArray;
        $this->model->save();
        $this->assertEquals($testArray, $this->model->settings()->all());
    }

    public function testSettingsMissingSettingsField()
    {
        $this->expectException(ModelSettingsException::class);
        $this->expectExceptionMessage('Unknown field');
        $this->model->settingsFieldName = 'test';
        $this->model->settings()->all();
    }

    /**
     * @throws \Jmitech\Model\Settings\Exceptions\ModelSettingsException
     */
    public function testPersistence()
    {
        $this->model->settings()->apply($this->testArray);
        $this->assertEquals($this->testArray, $this->model->fresh()->settings()->all());

        $this->model->settings()->delete();

        $this->model->setPersistSettings(false);
        $this->model->settings()->apply($this->testArray);
        $this->assertEquals([], $this->model->fresh()->settings()->all());

        $this->model->setPersistSettings(false);
        $this->model->settings()->apply($this->testArray);
        $this->model->save();
        $this->assertEquals($this->testArray, $this->model->fresh()->settings()->all());

        $this->model->settings()->delete();

        $this->model->fresh();
        $this->model->setPersistSettings(true);
        $this->model->settings()->apply($this->testArray);
        $this->assertEquals($this->testArray, $this->model->fresh()->settings()->all());
    }
}
