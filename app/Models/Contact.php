<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

}
