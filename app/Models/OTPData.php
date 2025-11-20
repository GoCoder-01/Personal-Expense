<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTPData extends Model
{
    use HasFactory;

    protected $table = 'otp_data';
    protected $fillable = ['otp', 'user_id', 'otp_sent_status', 'otp_sent_ip', 'otp_verify_status', 'entry_date', 'entry_time'];
}