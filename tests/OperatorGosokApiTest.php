<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorGosokApiTest extends TestCase
{
    use MakeOperatorGosokTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOperatorGosok()
    {
        $operatorGosok = $this->fakeOperatorGosokData();
        $this->json('POST', '/api/v1/operatorGosoks', $operatorGosok);

        $this->assertApiResponse($operatorGosok);
    }

    /**
     * @test
     */
    public function testReadOperatorGosok()
    {
        $operatorGosok = $this->makeOperatorGosok();
        $this->json('GET', '/api/v1/operatorGosoks/'.$operatorGosok->id);

        $this->assertApiResponse($operatorGosok->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOperatorGosok()
    {
        $operatorGosok = $this->makeOperatorGosok();
        $editedOperatorGosok = $this->fakeOperatorGosokData();

        $this->json('PUT', '/api/v1/operatorGosoks/'.$operatorGosok->id, $editedOperatorGosok);

        $this->assertApiResponse($editedOperatorGosok);
    }

    /**
     * @test
     */
    public function testDeleteOperatorGosok()
    {
        $operatorGosok = $this->makeOperatorGosok();
        $this->json('DELETE', '/api/v1/operatorGosoks/'.$operatorGosok->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/operatorGosoks/'.$operatorGosok->id);

        $this->assertResponseStatus(404);
    }
}
