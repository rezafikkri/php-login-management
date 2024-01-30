<?php

namespace RezaFikkri\PHPLoginManagement\Core;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender(): void
    {
        $this->expectOutputRegex('/PHP Login Management/');
        $this->expectOutputRegex('/<html>/');
        $this->expectOutputRegex('/<body>/');
        $this->expectOutputRegex('/Login Management/');
        $this->expectOutputRegex('/Login/');
        $this->expectOutputRegex('/Register/');

        View::render('Home/index', [
            'title' => 'PHP Login Management'
        ]);
    }
}
