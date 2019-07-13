<?php

namespace App\Repositories;

use App\Models\SuratKeluarBarangLine;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class SuratKeluarBarangLineRepository
 * @package App\Repositories
 * @version July 5, 2019, 3:48 pm UTC
 *
 * @method SuratKeluarBarangLine findWithoutFail($id, $columns = ['*'])
 * @method SuratKeluarBarangLine find($id, $columns = ['*'])
 * @method SuratKeluarBarangLine first($columns = ['*'])
*/
class SuratKeluarBarangLineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'quantity',
        'unit_id',
        'reason',
        'suratkeluarbarang_id',
        'kilogram'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SuratKeluarBarangLine::class;
    }
}
