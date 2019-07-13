<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratKeluarBarangApiTest extends TestCase
{
    use MakeSuratKeluarBarangTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->fakeSuratKeluarBarangData();
        $this->json('POST', '/api/v1/suratKeluarBarangs', $suratKeluarBarang);

        $this->assertApiResponse($suratKeluarBarang);
    }

    /**
     * @test
     */
    public function testReadSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->makeSuratKeluarBarang();
        $this->json('GET', '/api/v1/suratKeluarBarangs/'.$suratKeluarBarang->id);

        $this->assertApiResponse($suratKeluarBarang->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->makeSuratKeluarBarang();
        $editedSuratKeluarBarang = $this->fakeSuratKeluarBarangData();

        $this->json('PUT', '/api/v1/suratKeluarBarangs/'.$suratKeluarBarang->id, $editedSuratKeluarBarang);

        $this->assertApiResponse($editedSuratKeluarBarang);
    }

    /**
     * @test
     */
    public function testDeleteSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->makeSuratKeluarBarang();
        $this->json('DELETE', '/api/v1/suratKeluarBarangs/'.$suratKeluarBarang->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/suratKeluarBarangs/'.$suratKeluarBarang->id);

        $this->assertResponseStatus(404);
    }
}
