<?php

namespace Packages\Tests\Http;

use Packages\Http\Request;
use PHPUnit\Framework\TestCase;
use Mockery;

class RequestTest extends TestCase
{
    /**
     * @testdox test query params get name
     */
    public function testQueryParamsGetName()
    {
        $mockName = "example";
        $_GET["name"] = $mockName;
        $request = new Request();

        $sut = $request->queryParams("name");

        $this->assertEquals($mockName, $sut);
    }

    /**
     * @testdox test not set selected fields
     */
    public function testNotSetSelectedFields()
    {
        $mockData = [
            'name' => 'testExample',
            'age' => 27
        ];
        $mockRequest = Mockery::mock(Request::class)->makePartial();
        $mockRequest->shouldReceive('getInput')->andReturn($mockData);

        $sut = $mockRequest->fields();

        $this->assertEquals($mockData, $sut);
    }

    /**
     * @testdox test set selected field 'name'
     */
    public function testSetSelectedFieldName()
    {
        $mockData = [
            'name' => 'testExample',
            'age' => 27
        ];
        $mockRequest = Mockery::mock(Request::class)->makePartial();
        $mockRequest->shouldReceive('getInput')->andReturn($mockData);

        $sut = $mockRequest->fields(['name']);

        unset($mockData['age']);

        $this->assertEquals($mockData, $sut);
    }

    /**
     * @testdox test get input
     */
    public function testGetInput()
    {
        $mockRequest = Mockery::mock(Request::class)->makePartial();

        $sut = $mockRequest->getInput();

        $this->assertEquals(null, $sut);
    }

    /**
     * @testdox test get headers 'Location'
     */
    public function testGetHeadersLocation()
    {
        $_SERVER['Location'] = 'test';
        $mockRequest = new Request();

        $sut = $mockRequest->headers(['Location']);

        $this->assertEquals([
            'Location' => 'test'
        ], $sut);
    }

    /**
     * @testdox test get headers
     */
    public function testGetHeaders()
    {
        $_SERVER['Location'] = 'test';
        $mockRequest = new Request();

        $sut = $mockRequest->headers();

        $this->assertEquals($_SERVER, $sut);
    }
}
