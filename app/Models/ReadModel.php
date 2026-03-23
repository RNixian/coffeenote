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

// App\Models\ReadModel.php
public function histories()
{
    return $this->hasMany(ReadHistoryModel::class, 'history_id'); 
    // 'read_id' in read_history points to this read.id
}

}
