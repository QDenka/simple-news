<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        \Artisan::call('migrate:refresh');
        \Artisan::call('db:seed');
    }

    public function testRegisterSuccess()
    {
        $response = $this->post('/register', [
                'name' => 'Test User',
                'email' => 'example@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $response->assertStatus(200);
    }

    public function testRegisterFailed()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test',
            'password' => '123',
        ]);

        $response->assertStatus(302);
    }
}
