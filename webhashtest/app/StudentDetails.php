<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    protected $table = 'student_details';
	// Primary key
	public $primaryKey = 'id';

	protected $fillable = [
         'userId', 'stdName','address','phone','course'
    ];

      
}
