<?php
  
namespace App;
  
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = ['*'];
   
    // protected $dates = ['deleted_at'];
    public $timestamps = false;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];
   
    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}