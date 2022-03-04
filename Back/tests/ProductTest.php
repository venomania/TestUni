<?php

namespace App\Tests;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;


class ProductTest extends TestCase
{
    public function testName()
    {
        $product = new Product();
        $name = "Test1";
        
        $product->setName($name);
        $this->assertEquals("Test1", $product->getName());
    }

    public function testPrice()
    {
        $product = new Product();
        $price = "1";
        
        $product->setPrice($price);
        $this->assertEquals("1", $product->getPrice());
    }
    public function testQuantity()
    {
        $product = new Product();
        $quantity = 1;
        
        $product->setQuantity($quantity);
        $this->assertEquals(1, $product->getQuantity());
    }

    public function testImage()
    {
        $product = new Product();
        $image = 1;
        
        $product->setImage($image);
        $this->assertEquals(1, $product->getImage());
    }
    
}

?>