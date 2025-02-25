<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['designation', 'description', 'prix', 'auteur', 'cover'];
    protected $dates = ['deleted_at']; // Champ pour gérer SoftDelete
}
