<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    use HasFactory;
    protected $table = 'financial_year';

    protected $fillable = ['from_date', 'to_date', 'from_year', 'to_year', 'status', 'is_running_year', 'created_by', 'created_at', 'updated_at'];
}