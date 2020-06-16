<?php

namespace Tests\Feature\API\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExampleTest extends TestCase
{
    /**
     * Test login as default API user returns token back.
     *
     * @return void
     */
    public function testLogin()
    {
        $baseUrl = Config::get('app.url') . '/api/auth/login';
        $email = Config::get('api.apiEmail');
        $password = Config::get('api.apiPassword');

        $response = $this->json('POST', $baseUrl, [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /**
     * Test logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/auth/logout';

        $response = $this->json('POST', $baseUrl, [
            'token' => $token
        ]);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'ok' => true,
                'message' => 'Successfully logged out'
            ]);
    }

    /**
     * Test token refresh.
     *
     * @return void
     */
    public function testRefreshJWTToken()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/auth/refresh';

        $response = $this->json('POST', $baseUrl, [
            'token' => $token
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /**
     * Test /user route is only visible to logged in user.
     *
     * @return void
     */
    public function testGetUserInfoIsOnlyVisibleToLoggedInUser()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/user';

        $response = $this->json('GET', $baseUrl, [
            'token' => $token
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * Test /user route is not visible to Unauthenticated user.
     *
     * @return void
     */
    public function testGetUserInfoIsNotVisibleToUnauthenticatedUser()
    {
        $response = $this->json('GET', '/api/user', []);

        $response->assertStatus(401)
        ->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }
}
