<?php

use Faker\Factory as Faker;
use App\Models\ArticleLine;
use App\Repositories\ArticleLineRepository;

trait MakeArticleLineTrait
{
    /**
     * Create fake instance of ArticleLine and save it in database
     *
     * @param array $articleLineFields
     * @return ArticleLine
     */
    public function makeArticleLine($articleLineFields = [])
    {
        /** @var ArticleLineRepository $articleLineRepo */
        $articleLineRepo = App::make(ArticleLineRepository::class);
        $theme = $this->fakeArticleLineData($articleLineFields);
        return $articleLineRepo->create($theme);
    }

    /**
     * Get fake instance of ArticleLine
     *
     * @param array $articleLineFields
     * @return ArticleLine
     */
    public function fakeArticleLine($articleLineFields = [])
    {
        return new ArticleLine($this->fakeArticleLineData($articleLineFields));
    }

    /**
     * Get fake data of ArticleLine
     *
     * @param array $postFields
     * @return array
     */
    public function fakeArticleLineData($articleLineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'article_id' => $fake->randomDigitNotNull,
            'step_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $articleLineFields);
    }
}
