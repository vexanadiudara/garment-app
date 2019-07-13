<?php

use App\Models\SuratKeluarBarangLine;
use App\Repositories\SuratKeluarBarangLineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratKeluarBarangLineRepositoryTest extends TestCase
{
    use MakeSuratKeluarBarangLineTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SuratKeluarBarangLineRepository
     */
    protected $suratKeluarBarangLineRepo;

    public function setUp()
    {
        parent::setUp();
        $this->suratKeluarBarangLineRepo = App::make(SuratKeluarBarangLineRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->fakeSuratKeluarBarangLineData();
        $createdSuratKeluarBarangLine = $this->suratKeluarBarangLineRepo->create($suratKeluarBarangLine);
        $createdSuratKeluarBarangLine = $createdSuratKeluarBarangLine->toArray();
        $this->assertArrayHasKey('id', $createdSuratKeluarBarangLine);
        $this->assertNotNull($createdSuratKeluarBarangLine['id'], 'Created SuratKeluarBarangLine must have id specified');
        $this->assertNotNull(SuratKeluarBarangLine::find($createdSuratKeluarBarangLine['id']), 'SuratKeluarBarangLine with given id must be in DB');
        $this->assertModelData($suratKeluarBarangLine, $createdSuratKeluarBarangLine);
    }

    /**
     * @test read
     */
    public function testReadSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->makeSuratKeluarBarangLine();
        $dbSuratKeluarBarangLine = $this->suratKeluarBarangLineRepo->find($suratKeluarBarangLine->id);
        $dbSuratKeluarBarangLine = $dbSuratKeluarBarangLine->toArray();
        $this->assertModelData($suratKeluarBarangLine->toArray(), $dbSuratKeluarBarangLine);
    }

    /**
     * @test update
     */
    public function testUpdateSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->makeSuratKeluarBarangLine();
        $fakeSuratKeluarBarangLine = $this->fakeSuratKeluarBarangLineData();
        $updatedSuratKeluarBarangLine = $this->suratKeluarBarangLineRepo->update($fakeSuratKeluarBarangLine, $suratKeluarBarangLine->id);
        $this->assertModelData($fakeSuratKeluarBarangLine, $updatedSuratKeluarBarangLine->toArray());
        $dbSuratKeluarBarangLine = $this->suratKeluarBarangLineRepo->find($suratKeluarBarangLine->id);
        $this->assertModelData($fakeSuratKeluarBarangLine, $dbSuratKeluarBarangLine->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSuratKeluarBarangLine()
    {
        $suratKeluarBarangLine = $this->makeSuratKeluarBarangLine();
        $resp = $this->suratKeluarBarangLineRepo->delete($suratKeluarBarangLine->id);
        $this->assertTrue($resp);
        $this->assertNull(SuratKeluarBarangLine::find($suratKeluarBarangLine->id), 'SuratKeluarBarangLine should not exist in DB');
    }
}
