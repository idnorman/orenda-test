<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koli extends Model
{
    use HasFactory;
    
    /**
    * Atribut untuk nama tabel di database
    *
    * @var string
    */
    protected $table = 'koli';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'koli'
    ];
}
