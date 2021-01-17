<?php

namespace Tests\Feature;

use Tests\TestCase;

class TestAPiImportFile extends TestCase
{
    public function test_get_all_import_files()
    {
        $response = $this->getJson('api/import-files');

        $response->assertStatus(200);
    }

    public function test_get_a_import_file()
    {
        $response = $this->getJson('api/import-files/1');

        $response->assertStatus(200);
    }

}