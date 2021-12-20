<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'author', 'text', 'creation_time', 'publication_date'
    ];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}

?>