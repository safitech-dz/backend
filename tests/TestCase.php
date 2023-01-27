<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Safitech\Iot\Services\TopicsImportService;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function authenticate(): User
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    protected function importTopics()
    {
        app()->make(TopicsImportService::class, ['command' => null])
            ->consume(__DIR__.'./../topics_directory.json');
    }
}
