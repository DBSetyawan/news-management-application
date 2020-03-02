<?php
  
namespace App;
  
use Illuminate\Database\Eloquent\Model;
  
class Log_news extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event', 'username','logs_file'];
    
    protected $table = 'logs_news';
   
}