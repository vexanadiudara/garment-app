<?php

use App\Models\SuratKeluarBarang;
use App\Repositories\SuratKeluarBarangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratKeluarBarangRepositoryTest extends TestCase
{
    use MakeSuratKeluarBarangTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SuratKeluarBarangRepository
     */
    protected $suratKeluarBarangRepo;

    public function setUp()
    {
        parent::setUp();
        $this->suratKeluarBarangRepo = App::make(SuratKeluarBarangRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->fakeSuratKeluarBarangData();
        $createdSuratKeluarBarang = $this->suratKeluarBarangRepo->create($suratKeluarBarang);
        $createdSuratKeluarBarang = $createdSuratKeluarBarang->toArray();
        $this->assertArrayHasKey('id', $createdSuratKeluarBarang);
        $this->assertNotNull($createdSuratKeluarBarang['id'], 'Created SuratKeluarBarang must have id specified');
        $this->assertNotNull(SuratKeluarBarang::find($createdSuratKeluarBarang['id']), 'SuratKeluarBarang with given id must be in DB');
        $this->assertModelData($suratKeluarBarang, $createdSuratKeluarBarang);
    }

    /**
     * @test read
     */
    public function testReadSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->makeSuratKeluarBarang();
        $dbSuratKeluarBarang = $this->suratKeluarBarangRepo->find($suratKeluarBarang->id);
        $dbSuratKeluarBarang = $dbSuratKeluarBarang->toArray();
        $this->assertModelData($suratKeluarBarang->toArray(), $dbSuratKeluarBarang);
    }

    /**
     * @test update
     */
    public function testUpdateSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->makeSuratKeluarBarang();
        $fakeSuratKeluarBarang = $this->fakeSuratKeluarBarangData();
        $updatedSuratKeluarBarang = $this->suratKeluarBarangRepo->update($fakeSuratKeluarBarang, $suratKeluarBarang->id);
        $this->assertModelData($fakeSuratKeluarBarang, $updatedSuratKeluarBarang->toArray());
        $dbSuratKeluarBarang = $this->suratKeluarBarangRepo->find($suratKeluarBarang->id);
        $this->assertModelData($fakeSuratKeluarBarang, $dbSuratKeluarBarang->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSuratKeluarBarang()
    {
        $suratKeluarBarang = $this->makeSuratKeluarBarang();
        $resp = $this->suratKeluarBarangRepo->delete($suratKeluarBarang->id);
        $this->assertTrue($resp);
        $this->assertNull(SuratKeluarBarang::find($suratKeluarBarang->id), 'SuratKeluarBarang should not exist in DB');
    }
}
