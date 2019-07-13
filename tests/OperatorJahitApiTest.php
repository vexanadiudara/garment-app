<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorJahitApiTest extends TestCase
{
    use MakeOperatorJahitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOperatorJahit()
    {
        $operatorJahit = $this->fakeOperatorJahitData();
        $this->json('POST', '/api/v1/operatorJahits', $operatorJahit);

        $this->assertApiResponse($operatorJahit);
    }

    /**
     * @test
     */
    public function testReadOperatorJahit()
    {
        $operatorJahit = $this->makeOperatorJahit();
        $this->json('GET', '/api/v1/operatorJahits/'.$operatorJahit->id);

        $this->assertApiResponse($operatorJahit->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOperatorJahit()
    {
        $operatorJahit = $this->makeOperatorJahit();
        $editedOperatorJahit = $this->fakeOperatorJahitData();

        $this->json('PUT', '/api/v1/operatorJahits/'.$operatorJahit->id, $editedOperatorJahit);

        $this->assertApiResponse($editedOperatorJahit);
    }

    /**
     * @test
     */
    public function testDeleteOperatorJahit()
    {
        $operatorJahit = $this->makeOperatorJahit();
        $this->json('DELETE', '/api/v1/operatorJahits/'.$operatorJahit->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/operatorJahits/'.$operatorJahit->id);

        $this->assertResponseStatus(404);
    }
}
