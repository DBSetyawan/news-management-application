<?php

use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['Privilages'])->group(function() {
            Route::get('/posts', 'PostController@index')->name('posts');
    }
);

Route::get('/reds', function () {
    $p = Redis::incr('p');
    return $p;
});
// Route::get('/redis', function () {
//     $redis = Redis::connection();
//     return $redis->get('last_seen_'.time());
//     $queue = Queue::push('LogMessage',array('message'=>'Time: '.time()));
//        return $queue;
//     });
    
//     class LogMessage{
//         public function fire($job, $date){
//         File::append(app_path().'/queue.txt',$date['message'].PHP_EOL);
//         $job->delete();
//         }
//     }
        

Route::resource('post', 'PostController');
Route::get('/hapus/{id}', 'PostController@hapus')->name('destr');
Route::resource('comments', 'CommentsController');
Route::get('detail-news/{id}', 'PostController@UpdateDataNews')->name('show.detail.news');
Route::get('update-detail-data/{id}', 'CommentsController@updateDataNews')->name('updates.data.detail.news');