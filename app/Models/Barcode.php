<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barcode extends Model
{

    use HasFactory;

    //
    /**
     * Get the assets that owns the Barcode
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assets(): BelongsTo
    {
        return $this->belongsTo(Asset::class,'asset_id', 'id');
    }

}
