<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCertificate extends Model
{
    protected $table = 'student_certificate';
	// Primary key
	public $primaryKey = 'id';

	protected $fillable = [
         'userId', 'cname'
    ];

      
}
