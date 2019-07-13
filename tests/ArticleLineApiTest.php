<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleLineApiTest extends TestCase
{
    use MakeArticleLineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateArticleLine()
    {
        $articleLine = $this->fakeArticleLineData();
        $this->json('POST', '/api/v1/articleLines', $articleLine);

        $this->assertApiResponse($articleLine);
    }

    /**
     * @test
     */
    public function testReadArticleLine()
    {
        $articleLine = $this->makeArticleLine();
        $this->json('GET', '/api/v1/articleLines/'.$articleLine->id);

        $this->assertApiResponse($articleLine->toArray());
    }

    /**
     * @test
     */
    public function testUpdateArticleLine()
    {
        $articleLine = $this->makeArticleLine();
        $editedArticleLine = $this->fakeArticleLineData();

        $this->json('PUT', '/api/v1/articleLines/'.$articleLine->id, $editedArticleLine);

        $this->assertApiResponse($editedArticleLine);
    }

    /**
     * @test
     */
    public function testDeleteArticleLine()
    {
        $articleLine = $this->makeArticleLine();
        $this->json('DELETE', '/api/v1/articleLines/'.$articleLine->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/articleLines/'.$articleLine->id);

        $this->assertResponseStatus(404);
    }
}
