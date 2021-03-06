> Access admin

<img src="public/img-apps/projects.png" title="FVCproductions" alt="FVCproductions">

> Access user non-admin

 <img src="public/img-apps/user-access.png" title="FVCproductions" alt="FVCproductions">

> Exception connection redis

 <img src="public/img-apps/exception-redis-server.png" title="FVCproductions" alt="FVCproductions">

# Repository Application news managements

**Package Depedencies**

- Laravel 6.x
- Composer
- php 7.2.*
- Redis 3.0.5 (stable) version
- Nginx
- Valet
- etc.

**Package dev-Depedencies**

- laravel passport
- Predis 1^ version


### Petunjuk (started redis [local])

    1. install redis 3.0.5^
    2. start redis 3.0.5^ on your local
    3. running application

### Queue redis to work?

    Sebelum menuju action menu button reply comment / Add Comment
    pada menu detail post (action edit), pastikan anda menjalankan php artisan queue:work.


### Petunjuk (Installasi applikasi)

   1. cd [project]
   2. composer install
   2. npm install
   3. php artisan migrate
   4. php artisan passport:install
   5. (saya running by valet web server nginx) *not php artisan serv (automatically)
   6. pastikan environment pada .env sesuai dengan development yang anda pakai.

**Redis running** : Testing Comments Queue using redis.

![news apps](public/img-apps/vKGPbbhUIw.gif)

> Get started 

### Petunjuk (Registrasi User)
---
    Saya menyarankan untuk registrasi awal dengan Username/name (attribute):
      - users (non-admin)
      - admin (admin)
---
- **Refs middleware by protected Privilages**
    - blob master at <a href="https://github.com/DBSetyawan/news-management-application/blob/master/app/Http/Middleware/SessionPrivilages.php" target="_blank">`SessionPrivilages`</a>
- **Kernel**
    
    -`'Privilages' => \App\Http\Middleware\SessionPrivilages::class`

> Logic update dan store post with dynamic show/update(file img) 

```php
    /**
     * logic process posted comments with image [fixed].
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  @table.post.id -> $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateChangedPosted(Request $request, $id){
        
        $input = $request->all();
        $post = Post::whereIn('id',[$input['post_id']])->first();

        if($request->hasFile('file'))
        {
            $image_name = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($image_name,PATHINFO_FILENAME);
            $image_ext = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $filename.'-'.time().'.'.$image_ext;
            $path = $request->file('file')->storeAs('public/News',$fileNameToStore);
           
        }  
            else {

                $fileNameToStore = $post->file;

        }

        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
        $datapath = $storagePath.'News\\'.$post->file;

        if(file_exists($datapath)){
            Storage::delete($datapath);
            $post->file = $fileNameToStore;
            $post->save();
        }

        $data = Comment::where('id', $input['parent_id'])->update(['body' => implode('', $input['body'])]);
   
        event(new EventUpdatedPost($input));
                
        return back();

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\ProcessComment Queue
     */
    public function store(Request $request)
    {
    	$request->validate([
            'body'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        $comment = Comment::create($input);

        ProcessComment::dispatch($comment);
            
        return back();
    }
```

### Petunjuk (Queue Comments)

    1. Install redis 3.0.5 (stable) from redis.io
    2. Masuk pada menu manage post.
    3. Berikan komentar pada post yang tersedia. 
    4. Comments Queue akan menunggu prosesnya 

***Tampilan Proses queue work berhasil dieksekusi***

[![FVCproductions](public/img-apps/queue-work.png)]() 

---
 
 **API docs with passport(DEFAULT)**

***Tampilan API registrasi***

[![FVCproductions](public/img-apps/api-register.png)]() 

***Tampilan API login***

[![FVCproductions](public/img-apps/api-login.png)]()

## RESPONSE JSON

- **RESPONSE API PAG at <a href="https://github.com/DBSetyawan/news-management-application/tree/a1fc5db66999665c1806e030cdf071ccf79208e2/public/json_response" target="_blank">`JSON RESPONSE`</a>**
    - [ GET ALL RESOURCES | MAKE PAGINATE POSTED COMMENTS ]
---

## Support

Reach out to me at one of the following places!

- Portfolio at <a href="https://dbsetyawan.github.io/portfolio" target="_blank">`Daniel Budi Setyawan`</a>
---

## License

[![License](https://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2020 © <a href="https://dbsetyawan.github.io/portfolio" target="_blank">Daniel</a>.