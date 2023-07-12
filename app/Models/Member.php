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

    // public function categories(){
    //     return $this->hasManyThrough(Category::class, MemberCategory::class,'member_id','id', 'id', 'category_id');
    // }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'member_categories');
    }

}
