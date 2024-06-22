<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [];

    protected $searchableFields = ['*'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function hoD()
    {
        return $this->hasOne(HoD::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}
