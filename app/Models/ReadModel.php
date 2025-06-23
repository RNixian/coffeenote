<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadModel extends Model
{
    
    use HasFactory;

    protected $table = 'read';

    protected $fillable = [
        'title',
        'volume',
        'chapter',
        'page',
        'coverphoto',
        'category',
        'genre',
        'author',
        'status',
    ];

}
