<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPattern extends AdminModel
{
    use HasFactory;

    protected $table = 'exam_patterns';
    protected $fillable = ['title', 'campus_id', 'active'];

    protected $log_with = ['campus.title'];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
