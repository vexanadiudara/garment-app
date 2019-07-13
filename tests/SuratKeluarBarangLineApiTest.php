<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratKeluarBarangLineApiTest extends TestCase
{
    use MakeSuratKeluarBarangLineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->fakeSuratKeluarBarangLineData();
        $this->json('POST', '/api/v1/suratKeluarBarangLines', $suratKeluarBarangLine);

        $this->assertApiResponse($suratKeluarBarangLine);
    }

    /**
     * @test
     */
    public function testReadSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->makeSuratKeluarBarangLine();
        $this->json('GET', '/api/v1/suratKeluarBarangLines/'.$suratKeluarBarangLine->id);

        $this->assertApiResponse($suratKeluarBarangLine->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->makeSuratKeluarBarangLine();
        $editedSuratKeluarBarangLine = $this->fakeSuratKeluarBarangLineData();

        $this->json('PUT', '/api/v1/suratKeluarBarangLines/'.$suratKeluarBarangLine->id, $editedSuratKeluarBarangLine);

        $this->assertApiResponse($editedSuratKeluarBarangLine);
    }

    /**
     * @test
     */
    public function testDeleteSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->makeSuratKeluarBarangLine();
        $this->json('DELETE', '/api/v1/suratKeluarBarangLines/'.$suratKeluarBarangLine->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/suratKeluarBarangLines/'.$suratKeluarBarangLine->id);

        $this->assertResponseStatus(404);
    }
}
