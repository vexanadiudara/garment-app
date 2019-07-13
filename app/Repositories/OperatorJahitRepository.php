<?php

namespace App\Repositories;

use App\Models\OperatorJahit;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class OperatorJahitRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:40 pm UTC
 *
 * @method OperatorJahit findWithoutFail($id, $columns = ['*'])
 * @method OperatorJahit find($id, $columns = ['*'])
 * @method OperatorJahit first($columns = ['*'])
*/
class OperatorJahitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'spk_id',
        'article_id',
        'operator_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OperatorJahit::class;
    }
}
