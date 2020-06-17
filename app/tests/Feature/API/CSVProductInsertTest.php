<?php

namespace Tests\Feature\API;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CSVProductInsertTest extends TestCase
{
    /**
     * Test inserting products as CSV fails for non-admin user.
     *
     * @return void
     */
    public function testInsertingCSVProductsIsForbiddenForNonAdmin()
    {
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/products/insertcsv';

        $file = $this->getUploadableFile(base_path("tests/Feature/API/MOCK_DATA.csv"));

        $response = $this->json('POST', $baseUrl, [
            'token' => $token,
            'file' => $file,
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test inserting products as CSV works for admin user.
     *
     * @return void
     */
    public function testInsertingCSVProductsWorksForAdmin()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/products/insertcsv';

        $file = $this->getUploadableFile(base_path("tests/Feature/API/MOCK_DATA.csv"));

        $response = $this->json('POST', $baseUrl, [
            'token' => $token,
            'file' => $file,
        ]);

        $response->assertStatus(201);
    }

    /**
     * Get uploadable file.
     *
     * @return UploadedFile
     */
    protected function getUploadableFile($file)
    {
        $dummy = file_get_contents($file);

        file_put_contents(base_path("tests/" . basename($file)), $dummy);

        $path = base_path("tests/" . basename($file));
        $original_name = 'subscribers.csv';
        $mime_type = 'text/csv';
        $error = null;
        $test = true;

        $file = new UploadedFile($path, $original_name, $mime_type, $error, $test);

        return $file;
    }
}