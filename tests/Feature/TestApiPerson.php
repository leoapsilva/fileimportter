<?php

namespace Tests\Feature;

use Tests\TestCase;

class TestApiPerson extends TestCase
{
    public function test_get_all_people()
    {
        $response = $this->getJson('api/people');
        
        $response->assertStatus(200);
    }

    public function test_get_a_person()
    {
        $response = $this->getJson('api/people/1');

        $response->assertStatus(200);
    }

}