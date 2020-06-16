<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{

    /**
     * Test to see if the get products list endpoint is available by returning correct status code.
     *
     * @return void
     */
    public function testProductListEndpointIsAvailable()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }
}
