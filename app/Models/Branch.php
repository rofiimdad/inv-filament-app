<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Branch extends Model
{

    use HasFactory;
    //
    /**
     * The employee that belong to the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function employee(): hasMany
    {
        return $this->hasMany(Employee::class);
    }


}
