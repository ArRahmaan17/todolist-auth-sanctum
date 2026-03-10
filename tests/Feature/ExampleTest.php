<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $response = $this->post('/login', [
            'email' => 'test@test.test',
            'password' => '12345678',
        ]);

        $response->assertStatus(302);
    }
}
