<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorBuangBenangApiTest extends TestCase
{
    use MakeOperatorBuangBenangTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->fakeOperatorBuangBenangData();
        $this->json('POST', '/api/v1/operatorBuangBenangs', $operatorBuangBenang);

        $this->assertApiResponse($operatorBuangBenang);
    }

    /**
     * @test
     */
    public function testReadOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->makeOperatorBuangBenang();
        $this->json('GET', '/api/v1/operatorBuangBenangs/'.$operatorBuangBenang->id);

        $this->assertApiResponse($operatorBuangBenang->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->makeOperatorBuangBenang();
        $editedOperatorBuangBenang = $this->fakeOperatorBuangBenangData();

        $this->json('PUT', '/api/v1/operatorBuangBenangs/'.$operatorBuangBenang->id, $editedOperatorBuangBenang);

        $this->assertApiResponse($editedOperatorBuangBenang);
    }

    /**
     * @test
     */
    public function testDeleteOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->makeOperatorBuangBenang();
        $this->json('DELETE', '/api/v1/operatorBuangBenangs/'.$operatorBuangBenang->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/operatorBuangBenangs/'.$operatorBuangBenang->id);

        $this->assertResponseStatus(404);
    }
}
