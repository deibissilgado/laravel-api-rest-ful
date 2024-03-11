<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at']; 
    
    public function Cliente() : BelongsTo 
    {
        return $this->belongsTo(Cliente::class);
    }
    
}
