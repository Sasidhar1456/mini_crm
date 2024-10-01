<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Other model properties and methods...

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

