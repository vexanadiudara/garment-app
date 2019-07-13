<?php

use App\Models\OperatorGosok;
use App\Repositories\OperatorGosokRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorGosokRepositoryTest extends TestCase
{
    use MakeOperatorGosokTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperatorGosokRepository
     */
    protected $operatorGosokRepo;

    public function setUp()
    {
        parent::setUp();
        $this->operatorGosokRepo = App::make(OperatorGosokRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOperatorGosok()
    {
        $operatorGosok = $this->fakeOperatorGosokData();
        $createdOperatorGosok = $this->operatorGosokRepo->create($operatorGosok);
        $createdOperatorGosok = $createdOperatorGosok->toArray();
        $this->assertArrayHasKey('id', $createdOperatorGosok);
        $this->assertNotNull($createdOperatorGosok['id'], 'Created OperatorGosok must have id specified');
        $this->assertNotNull(OperatorGosok::find($createdOperatorGosok['id']), 'OperatorGosok with given id must be in DB');
        $this->assertModelData($operatorGosok, $createdOperatorGosok);
    }

    /**
     * @test read
     */
    public function testReadOperatorGosok()
    {
        $operatorGosok = $this->makeOperatorGosok();
        $dbOperatorGosok = $this->operatorGosokRepo->find($operatorGosok->id);
        $dbOperatorGosok = $dbOperatorGosok->toArray();
        $this->assertModelData($operatorGosok->toArray(), $dbOperatorGosok);
    }

    /**
     * @test update
     */
    public function testUpdateOperatorGosok()
    {
        $operatorGosok = $this->makeOperatorGosok();
        $fakeOperatorGosok = $this->fakeOperatorGosokData();
        $updatedOperatorGosok = $this->operatorGosokRepo->update($fakeOperatorGosok, $operatorGosok->id);
        $this->assertModelData($fakeOperatorGosok, $updatedOperatorGosok->toArray());
        $dbOperatorGosok = $this->operatorGosokRepo->find($operatorGosok->id);
        $this->assertModelData($fakeOperatorGosok, $dbOperatorGosok->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOperatorGosok()
    {
        $operatorGosok = $this->makeOperatorGosok();
        $resp = $this->operatorGosokRepo->delete($operatorGosok->id);
        $this->assertTrue($resp);
        $this->assertNull(OperatorGosok::find($operatorGosok->id), 'OperatorGosok should not exist in DB');
    }
}
