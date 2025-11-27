<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    
    // PENTING: Menetapkan nama tabel tunggal 'status' (sesuai DB Anda)
    protected $table = 'status'; 
    protected $fillable = ['name'];
    // public $timestamps = false; // Non-aktifkan jika Anda tidak menambahkannya di migration

    // Relationship: Satu Status bisa dimiliki banyak item Knowledge
    public function knowledgeItems()
    {
        return $this->hasMany(Knowledge::class);
    }
}