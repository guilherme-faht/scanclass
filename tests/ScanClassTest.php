<?php
use ReactBoot\ScanClass\ScanClass;

use PHPUnit\Framework\TestCase;

final class ScanClassTest extends TestCase
{
    public function testScan()
    {
        $scan = new ScanClass;
        $classes = $scan->scan(__DIR__ . '/dir');

        $this->assertContains('App\Example', $classes);
    }
}
