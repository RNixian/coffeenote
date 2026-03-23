<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadHistoryModel extends Model
{
    use HasFactory;

    protected $table = 'read_history';

    protected $fillable = [
        'history_id',
    ];

   // App\Models\ReadHistoryModel.php
public function read()
{
    return $this->belongsTo(ReadModel::class, 'history_id'); 
    // 'read_id' is the column in read_history that references read.id
}
}