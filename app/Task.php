<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Notifiable;

	/**
     * @var array
     */
    protected $fillable = [
        'title', 'desc',
    ];
}
