<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{

    use HasFactory;

    protected $table = 'assets';

    /**
     * Get the vendors associated with the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->BelongsTo(Vendor::class);
    }

    /**
     * Get the assign associated with the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    /**
     * Get the barcode associated with the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barcode(): HasOne
    {
        return $this->hasOne(Barcode::class);
    }

    public static function generateAssetNumber($type = "IT", $date = null , $id =null) :string
    {
        Log::info($id);
        $lastAsset = self::latest('id')->first();
        if(!$date==null){
            $year =(int)date('Y', strtotime($date));
            $month = convertToRoman((int)date('m', strtotime($date)));
        }else {
            $year = date('Y');
            $month = convertToRoman(date('m'));
        }
        $lastId = $lastAsset ? $lastAsset->id : 0;
        $typeCode = typeToCode($type);
        $newNumber = sprintf("SJD/INV/%s/%s/%s/%05d", $typeCode,  $month, $year, $id ? $id : $lastId + 1);
        return $newNumber;

    }

}
