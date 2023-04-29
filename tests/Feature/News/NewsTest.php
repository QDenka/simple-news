<?php

namespace Tests\Feature\News;

use App\Models\News\Category;
use App\Models\User\User;
use App\Services\User\AuthenticateService;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function testNewsIndex()
    {
        $response = $this->get('/api/news');

        $response->assertJson(
            [
                'success' => true,
            ]
        );
    }

    public function testNewsCreate()
    {
        $this->actingAs(User::first());
        $response = $this->post('/api/news', [
            'title' => 'Test News',
            'content' => 'Test Content',
            'category_ids' => [Category::first()->id],
        ]);

        $response->assertStatus(200);
    }

    public function testNewsForbidden()
    {
        $response = $this->post('/api/news', [
            'title' => 'Test News',
            'content' => 'Test Content',
            'category_ids' => [Category::first()->id],
        ]);

        $response->assertStatus(302);
    }

    public function testNewsDelete()
    {
        $token = app(AuthenticateService::class)->authenticate('test@kaban.dev', 'password');
        $response = $this->delete('/api/news/1', headers: [
            'Authorization' => 'Bearer token',
        ]);

        $response->assertStatus(200);
    }
}
