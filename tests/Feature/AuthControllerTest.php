<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_students_can_signup()
    {
        $userData = [
            'name' => 'Test Student',
            'email' => 'teststudent@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone_number' => '1234567890',
            'user_type' => 'student',
            'category' => 'Volunteer',
        ];

        $response = $this->postJson('/api/signup', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'user_type',
                    'category',
                ]
            ])
            ->assertJson([
                'message' => 'User registered successfully',
                'user' => [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'phone_number' => $userData['phone_number'],
                    'user_type' => $userData['user_type'],
                    'category' => $userData['category'],
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
            'user_type' => $userData['user_type'],
            'category' => $userData['category'],
        ]);
    }

    public function test_that_companies_can_signup()
    {
        $userData = [
            'name' => 'Test Company',
            'email' => 'testcompany@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone_number' => '0987654321',
            'user_type' => 'company',
        ];

        $response = $this->postJson('/api/signup', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'user_type',
                    'category',
                ]
            ])
            ->assertJson([
                'message' => 'User registered successfully',
                'user' => [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'phone_number' => $userData['phone_number'],
                    'user_type' => $userData['user_type'],
                    'category' => null,
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
            'user_type' => $userData['user_type'],
            'category' => null,
        ]);
    }

    public function test_that_companies_can_login()
    {
        $user = User::factory()->create([
            'email' => 'testcompany@gmail.com',
            'password' => bcrypt('password123'),
            'user_type' => 'company',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'testcompany@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'authenticated user' => [
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'user_type',
                ],
            ])
            ->assertJson([
                'authenticated user' => [
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                ],
            ]);

        $this->assertNotNull($response->json('token'));
    }

    public function test_that_students_can_login()
    {
        $user = User::factory()->create([
            'email' => 'teststudent@gmail.com',
            'password' => bcrypt('password123'),
            'user_type' => 'student',
            'category' => 'Volunteer',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'teststudent@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'authenticated user' => [
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'user_type',
                    'category',
                ],
            ])
            ->assertJson([
                'authenticated user' => [
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                    'category' => $user->category,
                ],
            ]);

        $this->assertNotNull($response->json('token'));
    }

    public function test_that_user_can_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'You are Logged out Successfully'
            ]);

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }
}
