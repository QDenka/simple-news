<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function testSuccessAuth()
    {
        $response = $this->post('/login', [
            'email' => 'test@kaban.dev',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function testFailedAuth()
    {
        $response = $this->post('/login', [
            'email' => 'test@kaban.dev',
            'password' => 'password123',
        ]);

        $response->assertStatus(401);
    }
}
