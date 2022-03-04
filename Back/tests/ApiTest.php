<?php

namespace App\Tests;    

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{

    public function testApihomme(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($responseData , ['message' => "Hello"]);
    }

    public function testApiindex(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($responseData , ['message' => "Hello world"]);
    }

    public function testApiproducts(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/products');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertCount(20, $responseData);
    }


    public function testApiproductsUnique(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/products/1');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($responseData ,['id' => 1 , "name" => "Rick Sanchez" , "price"=>"8","quantity"=>5,"image"=>"https://rickandmortyapi.com/api/character/avatar/1.jpeg"]);
    }


    
    public function testApiCartAdd(): void
    {
        $client = static::createClient();
        // Request a specific 2
        $client->jsonRequest('POST', '/api/cart/10',["quantity" => 1]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($responseData ,['id' => 1 , "products" => [
            0 => [
                "id" => 10,
                "name" => "Alan Rails",
                "price" => "8",
                "quantity" => 5,
                "image" => "https://rickandmortyapi.com/api/character/avatar/10.jpeg"
            ]
        ]]);
    }

     
    public function testApiCartAddOver(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('POST', '/api/cart/10',["quantity" => 100000]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);        
        $this->assertEquals($responseData , ["error" => "too many"]);
    }


    public function testApiCart(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/cart');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        // $this->assertCount(1, $responseData["products"]);
        $this->assertEquals($responseData ,['id' => 1 , "products" => [
            0 => [
                "id" => 10,
                "name" => "Alan Rails",
                "price" => "8",
                "quantity" => 5,
                "image" => "https://rickandmortyapi.com/api/character/avatar/10.jpeg"
            ]
        ]]);
    }

    public function testApiCartId(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('DELETE', '/api/cart/10');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($responseData["products"],[]);
    }

}
