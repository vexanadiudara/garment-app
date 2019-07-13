<?php

use App\Models\OperatorBuangBenang;
use App\Repositories\OperatorBuangBenangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorBuangBenangRepositoryTest extends TestCase
{
    use MakeOperatorBuangBenangTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorBuangBenangRepository
     */
    protected $operatorBuangBenangRepo;

    public function setUp()
    {
        parent::setUp();
        $this->operatorBuangBenangRepo = App::make(OperatorBuangBenangRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->fakeOperatorBuangBenangData();
        $createdOperatorBuangBenang = $this->operatorBuangBenangRepo->create($operatorBuangBenang);
        $createdOperatorBuangBenang = $createdOperatorBuangBenang->toArray();
        $this->assertArrayHasKey('id', $createdOperatorBuangBenang);
        $this->assertNotNull($createdOperatorBuangBenang['id'], 'Created OperatorBuangBenang must have id specified');
        $this->assertNotNull(OperatorBuangBenang::find($createdOperatorBuangBenang['id']), 'OperatorBuangBenang with given id must be in DB');
        $this->assertModelData($operatorBuangBenang, $createdOperatorBuangBenang);
    }

    /**
     * @test read
     */
    public function testReadOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->makeOperatorBuangBenang();
        $dbOperatorBuangBenang = $this->operatorBuangBenangRepo->find($operatorBuangBenang->id);
        $dbOperatorBuangBenang = $dbOperatorBuangBenang->toArray();
        $this->assertModelData($operatorBuangBenang->toArray(), $dbOperatorBuangBenang);
    }

    /**
     * @test update
     */
    public function testUpdateOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->makeOperatorBuangBenang();
        $fakeOperatorBuangBenang = $this->fakeOperatorBuangBenangData();
        $updatedOperatorBuangBenang = $this->operatorBuangBenangRepo->update($fakeOperatorBuangBenang, $operatorBuangBenang->id);
        $this->assertModelData($fakeOperatorBuangBenang, $updatedOperatorBuangBenang->toArray());
        $dbOperatorBuangBenang = $this->operatorBuangBenangRepo->find($operatorBuangBenang->id);
        $this->assertModelData($fakeOperatorBuangBenang, $dbOperatorBuangBenang->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOperatorBuangBenang()
    {
        $operatorBuangBenang = $this->makeOperatorBuangBenang();
        $resp = $this->operatorBuangBenangRepo->delete($operatorBuangBenang->id);
        $this->assertTrue($resp);
        $this->assertNull(OperatorBuangBenang::find($operatorBuangBenang->id), 'OperatorBuangBenang should not exist in DB');
    }
}
