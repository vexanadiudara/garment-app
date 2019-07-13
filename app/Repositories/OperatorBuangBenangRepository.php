<?php

namespace App\Repositories;

use App\Models\OperatorBuangBenang;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class OperatorBuangBenangRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:41 pm UTC
 *
 * @method OperatorBuangBenang findWithoutFail($id, $columns = ['*'])
 * @method OperatorBuangBenang find($id, $columns = ['*'])
 * @method OperatorBuangBenang first($columns = ['*'])
*/
class OperatorBuangBenangRepository extends BaseRepository
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
        return OperatorBuangBenang::class;
    }
}
