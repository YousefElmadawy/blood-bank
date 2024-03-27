<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',  
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //client prfere many posts & post prefered by many users
    
    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    
    public function scopeFilter(Builder $bulider , $filters)
    {

        if ($filters['title'] ?? false ) {
            $bulider->where('title', 'LIKE', "%{$filters['title']}%");
        } 
        if ($filters['name'] ?? false ) {
            $bulider->where('category_id', '=', $filters['name']);
        }

        
      

    }


}
