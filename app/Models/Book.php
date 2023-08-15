<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $table = "book";
    protected $with = ['book_type'];

    protected $fillable = [
      'book_type_id',
      'book_name',
      'description',
      'publisher',
      'year',
      'stock'
    ];

    public function book_type() : BelongsTo
    {
        return $this->belongsTo(BookType::class);
    }
}
