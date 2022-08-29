<?php

namespace Packages\Tests\Http;

use Packages\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @testdox test send
     * @runInSeparateProcess
     */
    public function testSend()
    {
        $mockResponse = new Response();

        $sut = $mockResponse->send([
            'name' => 'example'
        ]);

        $this->expectOutputString(json_encode([
            'name' => 'example'
        ]), $sut);
    }
}
