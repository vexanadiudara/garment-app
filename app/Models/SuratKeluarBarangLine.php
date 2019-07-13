<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="SuratKeluarBarangLine",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="quantity",
 *          description="quantity",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="unit_id",
 *          description="unit_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="reason",
 *          description="reason",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="suratkeluarbarang_id",
 *          description="suratkeluarbarang_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kilogram",
 *          description="kilogram",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class SuratKeluarBarangLine extends Model
{
    use SoftDeletes;

    public $table = 'surat_keluar_barang_lines';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'code',
        'name',
        'quantity',
        'unit_id',
        'reason',
        'suratkeluarbarang_id',
        'kilogram'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'unit_id' => 'integer',
        'reason' => 'string',
        'suratkeluarbarang_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    
}
