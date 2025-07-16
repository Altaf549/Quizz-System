<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'tbl_staff';
    protected $primaryKey = 'id';
    protected $guard = 'staff';  
    protected $fillable = [
        'staff_name',  
        'staff_email', 
        'staff_password', 
    ];

    protected $hidden = [
        'staff_password', 
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->staff_password; 
    }
}
