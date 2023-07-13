<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'dob',
        'join_date',
        'image_path',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'member_categories');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function subscription(){
        return $this->hasOne(Subscription::class);
    }

}
