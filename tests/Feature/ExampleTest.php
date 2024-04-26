<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'alice.johnson@upr.edu',
            'phone_number' => '7871234567',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'code' => 'ACCESSCODE123' // Assume this is a valid code
        ]);

        $response->assertStatus(302); // Assuming redirection to a dashboard or home
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', ['email' => 'alice.johnson@upr.edu']);
    }

    /** @test */
    public function user_registration_fails_with_invalid_email()
    {
        $response = $this->post('/register', [
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'email' => 'bob.smith@gmail.com',
            'phone_number' => '7871234567',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'code' => 'ACCESSCODE123'
        ]);


        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
public function user_can_update_their_information()
{
    $user = User::create([
        'first_name' => 'Charlie',
        'last_name' => 'Brown',
        'email' => 'charlie.brown@upr.edu',
        'phone_number' => '7871234567',
        'password' => bcrypt('OldPassword123!')
    ]);
        $user->role = 'Atleta';
        $user->remember_token = Str::random(60);

    $this->actingAs($user);

    $response = $this->put("/users/{$user->id}", [
        'first_name' => 'Charles',
        'last_name' => 'Brown',
        'email' => 'charlie.brown@upr.edu', // No change
        'phone_number' => '7871234568', // Change to trigger phone number validation
        'password' => 'NewPassword123!', // New password
        'password_confirmation' => 'NewPassword123!'
    ]);

    $response->assertOk();
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'first_name' => 'Charles',
        'phone_number' => Crypt::encryptString('7871234568')
    ]);
}
}

