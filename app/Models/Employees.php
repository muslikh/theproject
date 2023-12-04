<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employees extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_nm',
        'last_nm',
        'company_id',
        'email',
        'phone',
    ];

    
    protected $table = "employees";
    
    

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
