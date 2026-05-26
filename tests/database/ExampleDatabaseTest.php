<?php

use App\Models\ItemModel;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class ExampleDatabaseTest extends CIUnitTestCase
{
    public function testItemModelHasExpectedTableName(): void
    {
        $model = new ItemModel();
        $this->assertSame('items', $this->getPrivateProperty($model, 'table'));
    }

    public function testItemModelValidationRulesIncludeCoreFields(): void
    {
        $model = new ItemModel();
        $rules = $model->getValidationRules();

        $this->assertArrayHasKey('type', $rules);
        $this->assertArrayHasKey('title', $rules);
        $this->assertArrayHasKey('location', $rules);
        $this->assertArrayHasKey('contact_name', $rules);
        $this->assertArrayHasKey('contact_email', $rules);
    }
}
