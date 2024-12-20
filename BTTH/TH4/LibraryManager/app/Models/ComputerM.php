<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerM extends Model
{
    use HasFactory;
    // Chỉ định tên bảng
    protected $table = 'computers';

    // Nếu bảng không có cột timestamps (created_at, updated_at), thêm dòng này:
    public $timestamps = false;

    // Danh sách các cột có thể được thêm hoặc chỉnh sửa
    protected $fillable = [
        'computer_name',
        'model',
        'operating_system',
        'processor',
        'memory',
        'available',
    ];

    // Định nghĩa quan hệ với bảng `issues` (1-nhiều)
    // public function issues()
    // {
    //     return $this->hasMany(IssueModel::class, 'computer_id', 'id');
    // }
}
