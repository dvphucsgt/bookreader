<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class BookAccount extends Model
{
    protected $table="book_account";
    protected $primaryKey="bookId";
    public $timestamps = false;
    
}
