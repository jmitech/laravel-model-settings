<?php

namespace Jmitech\Model\Settings\Tests;

use Jmitech\Model\Settings\Exceptions\ModelSettingsException;
use Jmitech\Model\Settings\Managers\FieldSettingsManager;
use Jmitech\Model\Settings\Tests\Models\WrongUser;
use Jmitech\Model\Settings\Tests\Models\WrongUserWithField;

class TestWrongModelTest extends TestCase
{
    /**
     * @throws \Jmitech\Model\Settings\Exceptions\ModelSettingsException
     */
    public function testSettingsFieldUndefined()
    {
        $this->expectException(ModelSettingsException::class);
        $this->expectExceptionMessage('missing HasSettings');
        new FieldSettingsManager(WrongUser::first());
    }

    public function testSettingsMissingSettingsField()
    {
        $this->expectException(ModelSettingsException::class);
        $this->expectExceptionMessage('Unknown field');
        $model = WrongUserWithField::first();
        $model->settings()->all();
    }
}
