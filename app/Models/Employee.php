<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    //

    /**
     * Get the branch associated with the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function branch(): HasOne
    // {
    //     return $this->hasOne(Branch::class);
    // }

    /**
     * Get the branch that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function asset(): HasMany
    {
        return $this->HasMany(Branch::class);
    }

    public function getName(){
        
    }
}
