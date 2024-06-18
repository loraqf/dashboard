<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image'];

    public static function createProduct(array $data): Product
    {
        return self::create($data);
    }

    public function editProduct(array $data): bool
    {
        return $this->update($data);
    }

    public function deleteProduct(): ?bool
    {
        return $this->delete();
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    use HasFactory;
}
