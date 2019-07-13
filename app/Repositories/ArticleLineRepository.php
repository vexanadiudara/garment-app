<?php

namespace App\Repositories;

use App\Models\ArticleLine;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class ArticleLineRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:17 pm UTC
 *
 * @method ArticleLine findWithoutFail($id, $columns = ['*'])
 * @method ArticleLine find($id, $columns = ['*'])
 * @method ArticleLine first($columns = ['*'])
*/
class ArticleLineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'article_id',
        'step_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ArticleLine::class;
    }
}
