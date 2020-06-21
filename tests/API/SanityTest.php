<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\API;

use rikmeijer\𓀁\tests\APITest;

class SanityTest extends APITest
{
    public function testAPIAvailable(): void
    {
        $response = $this->http->get('/', []);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAPI_When_AcceptApplication_JSON_Expect_JSONResponse(): void
    {
        $response = $this->http->get('/', [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeader('Content-Type')[0]);
        $this->assertEquals('ok', json_decode($response->getBody()->getContents())->status);
    }

    public function testAPI_When_AcceptTextHTML_Expect_HTMLResponse(): void
    {
        $response = $this->http->get('/', [
            'headers' => [
                'Accept' => 'text/html'
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringStartsWith('text/html', $response->getHeader('Content-Type')[0]);
        $this->assertStringStartsWith('<!doctype html>', $response->getBody()->getContents());
    }
}
