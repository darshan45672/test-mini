<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HoD extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['department_id'];

    protected $searchableFields = ['*'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculties()
    {
        return $this->hasManyThrough(Faculty::class, Department::class);
    }
}
