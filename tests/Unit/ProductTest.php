<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_products(): void
    {
        $response = $this->get('/api/products');
        $this->assertEquals($response->getStatusCode(), 200);
    }
    public function test_store_products_without_login(): void
    {
        $token = $this->get('/api')->getContent();
        $response = $this->post('/api/products', [
            '_token' => $token,
            "name" => "Blender Maching",
            "price" => "$100",
            "category" => "electronics",
            "description" => "This is an untimate watch"
        ]);
        $this->assertEquals($response->getStatusCode(), 401);
    }
    public function test_signup_user(): void
    {
        $token = $this->get('/api')->getContent();
        $response = $this->post('/api/register', [
            '_token' => $token,
            "name" => "ibrahim",
            "email" => "ibrahim@gmail.com",
            "password" => "123123"
        ]);
        $this->assertEquals($response->getStatusCode(), 200);
    }
    public function test_login_user(): void
    {
        $token = $this->get('/api')->getContent();
        $response = $this->post('/api/login', [
            '_token' => $token,
            "email" => "ibrahim@gmail.com",
            "password" => "123123",
        ]);
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
