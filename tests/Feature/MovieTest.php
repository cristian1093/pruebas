<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MovieTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear()
    {
        Artisan::call('migrate');

        $carga = $this->get(router(''));

    }
}
