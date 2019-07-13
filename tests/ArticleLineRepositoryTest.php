<?php

use App\Models\ArticleLine;
use App\Repositories\ArticleLineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleLineRepositoryTest extends TestCase
{
    use MakeArticleLineTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ArticleLineRepository
     */
    protected $articleLineRepo;

    public function setUp()
    {
        parent::setUp();
        $this->articleLineRepo = App::make(ArticleLineRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateArticleLine()
    {
        $articleLine = $this->fakeArticleLineData();
        $createdArticleLine = $this->articleLineRepo->create($articleLine);
        $createdArticleLine = $createdArticleLine->toArray();
        $this->assertArrayHasKey('id', $createdArticleLine);
        $this->assertNotNull($createdArticleLine['id'], 'Created ArticleLine must have id specified');
        $this->assertNotNull(ArticleLine::find($createdArticleLine['id']), 'ArticleLine with given id must be in DB');
        $this->assertModelData($articleLine, $createdArticleLine);
    }

    /**
     * @test read
     */
    public function testReadArticleLine()
    {
        $articleLine = $this->makeArticleLine();
        $dbArticleLine = $this->articleLineRepo->find($articleLine->id);
        $dbArticleLine = $dbArticleLine->toArray();
        $this->assertModelData($articleLine->toArray(), $dbArticleLine);
    }

    /**
     * @test update
     */
    public function testUpdateArticleLine()
    {
        $articleLine = $this->makeArticleLine();
        $fakeArticleLine = $this->fakeArticleLineData();
        $updatedArticleLine = $this->articleLineRepo->update($fakeArticleLine, $articleLine->id);
        $this->assertModelData($fakeArticleLine, $updatedArticleLine->toArray());
        $dbArticleLine = $this->articleLineRepo->find($articleLine->id);
        $this->assertModelData($fakeArticleLine, $dbArticleLine->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteArticleLine()
    {
        $articleLine = $this->makeArticleLine();
        $resp = $this->articleLineRepo->delete($articleLine->id);
        $this->assertTrue($resp);
        $this->assertNull(ArticleLine::find($articleLine->id), 'ArticleLine should not exist in DB');
    }
}
