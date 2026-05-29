<?php

use CodeIgniter\Test\CIUnitTestCase;

final class ItemBasicTest extends CIUnitTestCase
{
    public function testStatusValueIsValid(): void
    {
        $status = 'open';

        $this->assertContains(
            $status,
            ['open', 'claimed', 'resolved']
        );
    }

    public function testItemTitleIsNotNull(): void
    {
        $title = 'Lost Wallet';

        $this->assertNotNull($title);
    }

    public function testBasicEquality(): void
    {
        $this->assertEquals(1, 1);
    }
}