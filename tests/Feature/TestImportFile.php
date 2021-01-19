<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TestImportFile extends TestCase
{

    public function test_user_can_see_import_file_models()
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');

        $this->get('/import-files/create')
             ->assertSuccessful()
             ->assertViewIs('import-files.create')
             ->assertSee(['People: XML', 'Ship Orders: XML', 'Customers: CSV']);
    }
    
    public function test_shiporders_ok()
    {
        $filename = 'test_shiporders_ok.xml';
        $this->runFileImport($filename, 'ShipOrders');
        $this->get('/import-files')
             ->assertSee($filename);
    }
    
    public function test_shiporders_adding_item_on_shiporder()
    {
        $filename = 'test_shiporders_adding_item_on_shiporder.xml';
        $this->runFileImport($filename, 'ShipOrders');
        $this->get('/import-files')
             ->assertSee($filename);
    }

    public function test_shiporders_updating_item_on_shiporder()
    {
        $filename = 'test_shiporders_updating_item_on_shiporder.xml';
        $this->runFileImport($filename, 'ShipOrders');
        $this->get('/import-files')
             ->assertSee($filename);
    }

    public function test_shiporders_ending_tag_mismatch()
    {
        $message = "Opening and ending tag mismatch: item line 61 and items";

        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'ShipOrders');
        $this->get('/import-files/create')
             ->assertSee($message);
    }

    public function test_people_ok()
    {
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files')
             ->assertSee($filename);
    }

    /**
     * test_people_error_accepted_mime_wrong_for_model
     *
     * 
     * On Chrome shows:
     * 'File expected: xml. Imported: application/vnd.ms-excel'
     * Could be the UploadedFile::fake()
     * @return void
     */
    public function test_people_error_accepted_mime_wrong_for_model()
    {
        $message = 'File expected: xml. Imported: text/csv';
        
        // TESTING CSV
        $filename = __FUNCTION__.'.csv';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }
    
    public function test_people_error_duplicate_data()
    {
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files')
             ->assertSee($filename);
    }
    
    public function test_people_error_empty_just_xml_header_tag()
    {
        $message = 'Start tag expected, \'<\' not found';
        
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }

    public function test_people_error_empty_missing_close_people_tag()
    {
        $message = 'EndTag: \'</\' not found';
        
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }

    public function test_people_error_missing_close_person_tag()
    {
        $message = 'Opening and ending tag mismatch: people line 2 and person';
        
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }

    public function test_people_error_missing_last_close_people_tag()
    {
        $message = 'EndTag: \'</\' not found';
        
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }
    
    public function test_people_error_right_extension_content_in_csv()
    {
        $message = 'Start tag expected, \'<\' not found';
        
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }
    
    /**
     * test_people_error_unaccepted_extension_and_content
     *
     * 
     * On Chrome shows:
     * 'File expected: xml. Imported: application/vnd.ms-excel'
     * Could be the UploadedFile::fake()
     * @return void
     */
    public function test_people_error_unaccepted_extension_and_content()
    {
        $message = 'File expected: xml. Imported: application/pdf';
        
        // TESTING PDF
        $filename = __FUNCTION__.'.pdf';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files/create')
             ->assertSee($message);        
    }

    /**
     * test_people_error_with_shiporders_content
     *
     * 
     * The file is well formed.
     * There is no data from model People inside.
     * The import file finish with success, but with 0 lines imported.
     * @return void
     */
    public function test_people_error_with_shiporders_content()
    {
        $message = ['test_people_error_with_shiporders_content.xml',	'0',	'People'];
        
        $filename = __FUNCTION__.'.xml';
        $this->runFileImport($filename, 'People');
        $this->get('/import-files')
             ->assertSeeInOrder($message);        
    }

    protected function runFileImport($filename, $model)
    {
        $path = __DIR__. '/Scenarios/'. $model. '/'. $filename;

        $user = User::first();

        $content = new UploadedFile($path, E_ALL);
             
        $file = UploadedFile::fake()->createWithContent($filename, $content->getContent());

        $response = $this->actingAs($user)->post('/import-files',
                                [ 'csv_file' => $file,
                                  '_token' => csrf_token(),
                                  'user_id' => $user->id,
                                  'model' => $model
                                ]);
    }

}