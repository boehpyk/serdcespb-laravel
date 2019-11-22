<?php

namespace Tests\Feature\Admin\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AdminEventStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if unlogined user cannot access admin area
     *
     * @return void
     */
    public function testUnloginedUserCannotAccessHere()
    {
        $response = $this->post('/admin/events/create');
        $response->assertRedirect('/login');
    }

    /**
     * Test if simple user cannot access admin area
     *
     * @return void
     */
    public function testSimpleUserCannotAccessAdminArea()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->post('/admin/events/create');
        $response->assertStatus(403);
    }

    /**
     * Test if super admin user can access admin area
     *
     * @return void
     */
    public function testSuperAdminUserCanAccessAdminArea()
    {
        $user = factory(User::class)->create([
            'type'      => 'supaBoss',
        ]);

        $response = $this->actingAs($user)->get('/admin/events/create');
        $response->assertSuccessful();
        $response->assertStatus(200);
    }

}
