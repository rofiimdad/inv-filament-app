<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    //

    /**
     * Get the assets that owns the Vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asset(): HasMany
    {
        return $this->HasMany(Asset::class);
    }
}
