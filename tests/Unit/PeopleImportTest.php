<?php

namespace Tests\Unit;

use ACFBentveld\XML\XML;
use ErrorException;
use Exception;
use SimpleXMLElement;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class PeopleImportTest extends TestCase
{
    use MatchesSnapshots;   
    
    public function test_import_people_ok()
    {
        $path = __DIR__.'/Scenarios/people_ok.xml';
        $xml = XML::import($path);

        $this->assertMatchesJsonSnapshot($xml->toJson());
    }
    /**
     * @expectedException \ErrorException
     * @expectedExceptionMessageRegExp /^Strart tad expected, '<' not found\.$/
     */
    public function test_import_people_error_empty_just_xml_header_tag()
    {
        $path = __DIR__.'/Scenarios/people_error_empty_just_xml_header_tag.xml';
        $xml = XML::import($path);
        
        //$this->expectErrorMessageMatches("String could not be parsed as XML");
        //$this->expectNoticeMessage("String could not be parsed as XML");

        //$this->expectExceptionMessage("String could not be parsed as XML");
        $this->expectException = ErrorException::class;

        //$this->assertMatchesJsonSnapshot($xml->toJson());
    }
    

}