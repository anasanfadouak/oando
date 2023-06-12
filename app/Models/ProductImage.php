<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    use HasFactory;
    protected $attributes = [
        'file' => 'default_filename.jpg', // Replace with your desired default filename
    ];
    protected $fillable = [
        'product_id',
        'file',
        'alt_text',
    ];
    public function product()
{
    return $this->belongsTo(Product::class);
}

}
