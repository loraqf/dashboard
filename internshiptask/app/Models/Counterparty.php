<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    protected $fillable = ['counterpartyname', 'bulstat', 'address', 'email'];

    public static function createCounterparty(array $data): Counterparty
    {
        return self::create($data);
    }

    public function editCounterparty(array $data): bool
    {
        return $this->update($data);
    }

    public function deleteCounterparty(): ?bool
    {
        return $this->delete();
    } 

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    use HasFactory;
}
