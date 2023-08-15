<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = "transaction_detail";
    protected $with = ['book', 'transaction'];

    protected $fillable = [
      'transaction_id',
      'book_id',
      'qty',
      'return_date',
      'fine_days',
      'fine',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
