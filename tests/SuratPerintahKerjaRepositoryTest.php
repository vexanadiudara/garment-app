<?php

use App\Models\SuratPerintahKerja;
use App\Repositories\SuratPerintahKerjaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratPerintahKerjaRepositoryTest extends TestCase
{
    use MakeSuratPerintahKerjaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SuratPerintahKerjaRepository
     */
    protected $suratPerintahKerjaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->suratPerintahKerjaRepo = App::make(SuratPerintahKerjaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->fakeSuratPerintahKerjaData();
        $createdSuratPerintahKerja = $this->suratPerintahKerjaRepo->create($suratPerintahKerja);
        $createdSuratPerintahKerja = $createdSuratPerintahKerja->toArray();
        $this->assertArrayHasKey('id', $createdSuratPerintahKerja);
        $this->assertNotNull($createdSuratPerintahKerja['id'], 'Created SuratPerintahKerja must have id specified');
        $this->assertNotNull(SuratPerintahKerja::find($createdSuratPerintahKerja['id']), 'SuratPerintahKerja with given id must be in DB');
        $this->assertModelData($suratPerintahKerja, $createdSuratPerintahKerja);
    }

    /**
     * @test read
     */
    public function testReadSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->makeSuratPerintahKerja();
        $dbSuratPerintahKerja = $this->suratPerintahKerjaRepo->find($suratPerintahKerja->id);
        $dbSuratPerintahKerja = $dbSuratPerintahKerja->toArray();
        $this->assertModelData($suratPerintahKerja->toArray(), $dbSuratPerintahKerja);
    }

    /**
     * @test update
     */
    public function testUpdateSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->makeSuratPerintahKerja();
        $fakeSuratPerintahKerja = $this->fakeSuratPerintahKerjaData();
        $updatedSuratPerintahKerja = $this->suratPerintahKerjaRepo->update($fakeSuratPerintahKerja, $suratPerintahKerja->id);
        $this->assertModelData($fakeSuratPerintahKerja, $updatedSuratPerintahKerja->toArray());
        $dbSuratPerintahKerja = $this->suratPerintahKerjaRepo->find($suratPerintahKerja->id);
        $this->assertModelData($fakeSuratPerintahKerja, $dbSuratPerintahKerja->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSuratPerintahKerja()
    {
        $suratPerintahKerja = $this->makeSuratPerintahKerja();
        $resp = $this->suratPerintahKerjaRepo->delete($suratPerintahKerja->id);
        $this->assertTrue($resp);
        $this->assertNull(SuratPerintahKerja::find($suratPerintahKerja->id), 'SuratPerintahKerja should not exist in DB');
    }
}
