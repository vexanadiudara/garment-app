<?php

namespace App\Repositories;

use App\Models\SuratPerintahKerja;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class SuratPerintahKerjaRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:31 pm UTC
 *
 * @method SuratPerintahKerja findWithoutFail($id, $columns = ['*'])
 * @method SuratPerintahKerja find($id, $columns = ['*'])
 * @method SuratPerintahKerja first($columns = ['*'])
*/
class SuratPerintahKerjaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'line_id',
        'date',
        'suratkeluarbarang_id',
        'brand_id',
        'article_id',
        'color_id',
        'size_id',
        'quantity_pcs',
        'quantity_lsn',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SuratPerintahKerja::class;
    }
}
