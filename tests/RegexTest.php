<?php

namespace RezaFikkri\PHPLoginManagement;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testRegex(): void
    {
        $path = '/products/12345/categories/abcd';
        $pattern = '#^/products/([\d\w]*)/categories/([\d\w]*)$#';
        $result = preg_match($pattern, $path, $matches);

        $this->assertEquals(1, $result);

        var_dump($matches);
    }
}
