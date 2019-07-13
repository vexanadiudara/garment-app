<?php

namespace App\Repositories;

use App\Models\OperatorGosok;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class OperatorGosokRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:43 pm UTC
 *
 * @method OperatorGosok findWithoutFail($id, $columns = ['*'])
 * @method OperatorGosok find($id, $columns = ['*'])
 * @method OperatorGosok first($columns = ['*'])
*/
class OperatorGosokRepository extends BaseRepository
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
        return OperatorGosok::class;
    }
}
