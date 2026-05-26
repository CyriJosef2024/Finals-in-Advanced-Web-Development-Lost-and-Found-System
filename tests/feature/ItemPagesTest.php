<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class ItemPagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testItemsIndexPageReturns200(): void
    {
        $result = $this->get('/items');

        $result->assertStatus(200);
        $result->assertSee('Campus Lost &amp; Found');
    }

    public function testCreatePageReturns200(): void
    {
        $result = $this->get('/items/create');

        $result->assertStatus(200);
        $result->assertSee('Post Lost/Found Item');
        $result->assertSee('csrf');
    }
}
