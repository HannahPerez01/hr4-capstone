<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signup extends Model
{
    use HasFactory;
    protected $table="core_client_account";

  protected $fillable=[
    'client_id',
    'firstname',
    'lastname',
    'middlename',
    'contact',
    'company_address',
    'email',
    'contact',
    'status',
     'company',
       'client_code',
       'image',
];
}
