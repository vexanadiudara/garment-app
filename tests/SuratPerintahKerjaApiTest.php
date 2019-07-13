<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratPerintahKerjaApiTest extends TestCase
{
    use MakeSuratPerintahKerjaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->fakeSuratPerintahKerjaData();
        $this->json('POST', '/api/v1/suratPerintahKerjas', $suratPerintahKerja);

        $this->assertApiResponse($suratPerintahKerja);
    }

    /**
     * @test
     */
    public function testReadSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->makeSuratPerintahKerja();
        $this->json('GET', '/api/v1/suratPerintahKerjas/'.$suratPerintahKerja->id);

        $this->assertApiResponse($suratPerintahKerja->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->makeSuratPerintahKerja();
        $editedSuratPerintahKerja = $this->fakeSuratPerintahKerjaData();

        $this->json('PUT', '/api/v1/suratPerintahKerjas/'.$suratPerintahKerja->id, $editedSuratPerintahKerja);

        $this->assertApiResponse($editedSuratPerintahKerja);
    }

    /**
     * @test
     */
    public function testDeleteSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->makeSuratPerintahKerja();
        $this->json('DELETE', '/api/v1/suratPerintahKerjas/'.$suratPerintahKerja->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/suratPerintahKerjas/'.$suratPerintahKerja->id);

        $this->assertResponseStatus(404);
    }
}
