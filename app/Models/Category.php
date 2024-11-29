<?php

namespace App\Models;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * Get all of the listings for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
