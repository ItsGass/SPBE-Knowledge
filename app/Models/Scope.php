<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    use HasFactory;
    
    // PENTING: Menetapkan nama tabel tunggal 'scope' (sesuai DB Anda)
    protected $table = 'scope'; 
    protected $fillable = ['name'];
    // public $timestamps = false; // Non-aktifkan jika Anda tidak menambahkannya di migration

    // Relationship: Satu Scope bisa dimiliki banyak item Knowledge
    public function knowledgeItems()
    {
        return $this->hasMany(Knowledge::class);
    }
}