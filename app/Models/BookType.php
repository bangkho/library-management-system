<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Book;

class BookType extends Model
{
    use HasFactory;

    protected $table = "book_type";

    protected $fillable = [
      'book_type_name',
    ];

    public function book(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
