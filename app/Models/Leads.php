<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'phone_one', 'phone_two', 'phone_three', 'phone_four', 'email', 'information_source', 'property_type', 'youtube', 'facebook', 'instagram', 'website', 'whatsapp', 'telegram', 'linkedin', 'tiktok', 'image'];
}
