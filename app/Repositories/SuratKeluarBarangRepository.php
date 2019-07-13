<?php

namespace App\Repositories;

use App\Models\SuratKeluarBarang;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class SuratKeluarBarangRepository
 * @package App\Repositories
 * @version July 5, 2019, 3:35 pm UTC
 *
 * @method SuratKeluarBarang findWithoutFail($id, $columns = ['*'])
 * @method SuratKeluarBarang find($id, $columns = ['*'])
 * @method SuratKeluarBarang first($columns = ['*'])
*/
class SuratKeluarBarangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'start_date',
        'product_departement_id',
        'created_by',
        'reason'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SuratKeluarBarang::class;
    }
}
