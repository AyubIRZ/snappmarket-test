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

    /**
     * Test to see if the get products list endpoint is returning Json.
     *
     * @return void
     */
    public function testProductListEndpointReturnsJson()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJson([
                'ok' => true
            ]);
    }

    /**
     * Test to see if the get products list endpoint is returning correct Json response.
     *
     * @return void
     */
    public function testProductListEndpointReturnsCorrectJsonStructure()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'ok',
                'message',
                'data'
            ]);
    }

    /**
     * Test to see if the get products list endpoint is returning paginated data.
     *
     * @return void
     */
    public function testProductListEndpointReturnsPaginatedData()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'ok',
                'message',
                'data' => [
                    'current_page'
                ]
            ]);
    }

    /**
     * Test to see if the get products list endpoint with a category is returning correct products filtered by category.
     *
     * @return void
     */
    public function testProductListEndpointWithCategoryReturnsCorrectProducts()
    {
        $category = 1;

        $response = $this->get('/api/products?category=' . $category);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'data' => [
                        [
                            'category_id' => $category
                        ]
                    ]
                ]
            ]);
    }

    /**
     * Test to see if the get products list endpoint with a wrong category is returning error.
     *
     * @return void
     */
    public function testProductListEndpointWithWrongCategoryReturnsError()
    {
        $category = 1000515;

        $response = $this->get('/api/products?category=' . $category);

        $response->assertStatus(422);
    }
}
