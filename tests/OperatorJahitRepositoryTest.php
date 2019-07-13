<?php

use App\Models\OperatorJahit;
use App\Repositories\OperatorJahitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorJahitRepositoryTest extends TestCase
{
    use MakeOperatorJahitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorJahitRepository
     */
    protected $operatorJahitRepo;

    public function setUp()
    {
        parent::setUp();
        $this->operatorJahitRepo = App::make(OperatorJahitRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOperatorJahit()
    {
        $operatorJahit = $this->fakeOperatorJahitData();
        $createdOperatorJahit = $this->operatorJahitRepo->create($operatorJahit);
        $createdOperatorJahit = $createdOperatorJahit->toArray();
        $this->assertArrayHasKey('id', $createdOperatorJahit);
        $this->assertNotNull($createdOperatorJahit['id'], 'Created OperatorJahit must have id specified');
        $this->assertNotNull(OperatorJahit::find($createdOperatorJahit['id']), 'OperatorJahit with given id must be in DB');
        $this->assertModelData($operatorJahit, $createdOperatorJahit);
    }

    /**
     * @test read
     */
    public function testReadOperatorJahit()
    {
        $operatorJahit = $this->makeOperatorJahit();
        $dbOperatorJahit = $this->operatorJahitRepo->find($operatorJahit->id);
        $dbOperatorJahit = $dbOperatorJahit->toArray();
        $this->assertModelData($operatorJahit->toArray(), $dbOperatorJahit);
    }

    /**
     * @test update
     */
    public function testUpdateOperatorJahit()
    {
        $operatorJahit = $this->makeOperatorJahit();
        $fakeOperatorJahit = $this->fakeOperatorJahitData();
        $updatedOperatorJahit = $this->operatorJahitRepo->update($fakeOperatorJahit, $operatorJahit->id);
        $this->assertModelData($fakeOperatorJahit, $updatedOperatorJahit->toArray());
        $dbOperatorJahit = $this->operatorJahitRepo->find($operatorJahit->id);
        $this->assertModelData($fakeOperatorJahit, $dbOperatorJahit->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOperatorJahit()
    {
        $operatorJahit = $this->makeOperatorJahit();
        $resp = $this->operatorJahitRepo->delete($operatorJahit->id);
        $this->assertTrue($resp);
        $this->assertNull(OperatorJahit::find($operatorJahit->id), 'OperatorJahit should not exist in DB');
    }
}
