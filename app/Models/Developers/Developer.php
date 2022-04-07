<?php

namespace App\Models\Developers;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $timestamps = true;
}
