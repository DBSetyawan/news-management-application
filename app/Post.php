<?php
  
namespace App;
  
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Post extends Model
{
    use SoftDeletes;
  
    protected $dates = ['deleted_at'];
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body','file'];
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function reply_comment()
    {
        return $this->hasMany(Comment::class);
    }
}