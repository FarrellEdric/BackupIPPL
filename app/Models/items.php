<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';

    // Jangan masukin 'id' ke fillable
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'availability',
    ];

    // Tambahkan konfigurasi primary key biar Laravel yakin
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
