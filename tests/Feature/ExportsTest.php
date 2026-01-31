<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ExportsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_export_endpoints()
    {
        // Create admin user (assumes users table has 'role' column)
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user)
            ->get('/exports/stock/xlsx')
            ->assertStatus(200);

        $this->actingAs($user)
            ->get('/exports/movements/xlsx')
            ->assertStatus(200);

        $this->actingAs($user)
            ->get('/exports/report/download-pdf')
            ->assertStatus(200);
    }
}
