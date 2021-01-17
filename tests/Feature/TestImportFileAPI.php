<?php

namespace Tests\Feature;

use Tests\TestCase;

class TestImportFileAPI extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_making_an_api_request()
    {
        $response = $this->get('/import-files');

        //dd($response);
        
        $response->assertStatus(200);
    }
}