<?php

namespace Tests\Feature;

use Tests\TestCase;

class TestApiShipOrder extends TestCase
{
    public function test_get_all_ship_orders()
    {
        $response = $this->getJson('api/ship-orders');
        
        $response->assertStatus(200);
    }

    public function test_get_a_ship_order()
    {
        $response = $this->getJson('api/ship-orders/1');

        $response->assertStatus(200);
    }

}