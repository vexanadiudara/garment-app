<?php

namespace App\Repositories;

use App\Models\Step;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class StepRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:11 pm UTC
 *
 * @method Step findWithoutFail($id, $columns = ['*'])
 * @method Step find($id, $columns = ['*'])
 * @method Step first($columns = ['*'])
*/
class StepRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Step::class;
    }
}
