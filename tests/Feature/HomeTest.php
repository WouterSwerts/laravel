<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');

        $response->assertSeeText('Hello World!');

    }

    public function testContactPageIsWorkingCOrrectly() {

        $response = $this->get('/contact');

        $response->assertSeeText('Contact');
    }
}
