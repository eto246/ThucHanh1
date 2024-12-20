<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueModel extends Model
{
    // Chỉ định tên bảng
    protected $table = 'issues';

    // Nếu bảng không có cột timestamps (created_at, updated_at), thêm dòng này:
    public $timestamps = false;
    use HasFactory;
    // Danh sách các cột có thể được thêm hoặc chỉnh sửa
    protected $fillable = [
        'computer_id',
        'reported_by',
        'reported_date',
        'description',
        'urgency',
        'status',
    ];

    // Định nghĩa quan hệ với bảng `issues` (1-nhiều)
    public function computer()
    {
        return $this->belongsto(ComputerM::class);
    }
}
