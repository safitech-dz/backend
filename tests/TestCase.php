<?php

namespace Tests;

use App\Models\User;
use App\Services\TopicsImportService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

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
        (new TopicsImportService)->consume(__DIR__.'./../topics_directory.json');
    }
}
