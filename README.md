# Nexus Auto Transport Sample Laravel Project

## Project setup
```
composer install
```
```
npm install
```

## Technologies Used
`Laravel 8`, `MySql`, `Bootstrap 4.5`


### Compiles and hot-reloads for development
```
php artisan serve
```
### Task to Complate
```
CREATE TABLE `partner` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
Use Laravel 8 and your best coding practices to create REST API endpoints. It would be nice if you can set up a working demo link. Implement the following URL signatures:
- GET /api/partners -- return all partners sorted by id field and paginate the results. The results should contain also the full URL to partner logo.
- GET /api/partners?name=ab&per_page=3&page=2 -- return partners where name starts with prefix "ab".
- GET /api/partners/{id} -- return a single partner with the given id.
- POST /api/partners -- create a new partner, upload a partner logo, crop it to 100x100 pixels and store the filename in the field "photo". Implement a case insensitive rule that the "name" field can't contain the substring "Nexus" or its dashed derivatives (e.g. "N-exus", "nE-x----U-s").
- PATCH /api/partners/{id} -- allow to update the partner info including the logo, the same validation rules apply as before.
DELETE /api/partners/{id} -- delete the partner with the given id.

### Code Explanation
##### API Routes
```php
Route::get("partners",[PartnerController::class, 'partners']);

Route::get("partners/{id}", [PartnerController::class, 'partnersbyid']);

Route::post("partners", [PartnerController::class, 'add']);

Route::patch("partners/{id}",[PartnerController::class, 'update']);

Route::delete("partners/{id}", [PartnerController::class, 'deletepartner']);
```
#### Controllers
###### Get all partners API:
- Pagination will be applied by checking whether there is an per_page request or not.
- Partners can be filtered by their names. 
- `$name."%"` means filter will be applied according to the first letters of the name.
- /api/partners?name=baris&per_page=5&page=2 returns partners whose name starts with "baris" and results are showing second page and 5 partners per page. 
```php
function partners(Request $request)
    {
        $name = $request->input('name');
        $per_page = $request->input('per_page');
        if($per_page){
            $data = Partner::where("name","like",$name."%")->paginate($per_page);
        }else{
            $data = Partner::where("name","like",$name."%")->get();   
        }
        return view('list',['partners'=>$data]);
    }
```
###### Get single partner API:
- Single partner will be filtred according to id that comes from `query string`
```php
    function partnersbyid($id)
    {
        $data =Partner::find($id);
        return view('single',["data"=>$data]);
    } return view('list',['partners'=>$data]);
    }
```
###### Create existing partner API:
- Patch Method used in order to be able to change single variable.
- Validation applied to control new partners.
- Name is required and can't be empty.
- `not_regex:/(N|n)([-]+)?(E|e)([-]+)?(X|x)([-]+)?(U|u)([-]+)?(S|s)/` comment line means:
  - Whether it's capital letter or not, name cannot contain any dashed version of the word `Nexus`.
- All images are cropped and fitted into 100x100 pixels.
```php
use Intervention\Image\Facades\Image;

function add(Request $req)
    {
        $req->validate([
            'name' => array('required','not_regex:/(N|n)([-]+)?(E|e)([-]+)?(X|x)([-]+)?(U|u)([-]+)?(S|s)/')
        ]);
        $partner = new Partner;
        $name=$req->name;
        $partner->name=$req->name;
        $photo=$req->file('photo');
        if($photo){
            $partner->photo=$req->file('photo')->store('uploads', 'public');
            $photo = Image::make(public_path('storage/' . $partner->photo))->fit(100,100);
            $photo->save();
        }
        $result=$partner->save();
        if($result){return ["Result"=>"Data is saved to database"];}
        else{return ["Result"=>"Data couldn't saved to database"];}
    }
```
###### Update partner by ID with PATCH method API:
- Same validation rules applied with `create new partner API` to update existing partners.
- Partner id comes from `query string`
```php
use Intervention\Image\Facades\Image;

function add(Request $req)
    {
        $req->validate([
            'name' => array('required','not_regex:/(N|n)([-]+)?(E|e)([-]+)?(X|x)([-]+)?(U|u)([-]+)?(S|s)/')
        ]);
        $partner = new Partner;
        $name=$req->name;
        $partner->name=$req->name;
        $photo=$req->file('photo');
        if($photo){
            $partner->photo=$req->file('photo')->store('uploads', 'public');
            $photo = Image::make(public_path('storage/' . $partner->photo))->fit(100,100);
            $photo->save();
        }
        $result=$partner->save();
        if($result){return ["Result"=>"Data is saved to database"];}
        else{return ["Result"=>"Data couldn't saved to database"];}
    }
```
###### Delete existing partner API:
- Delete method is used to delete existing user.
- Partner id comes from `query string`
```php
    function deletepartner($id)
    {
        $partner = Partner::find($id);
        $result= $partner->delete();
        if($result)
        {
            return ["Result"=>"Partner is deleted from database"];
        }
    }
```
###### Layout.Blade.php
- Bootstrap installed into existing project
```html
<html>
    <head>
        <title>Nexus-Partner Laravel Project</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body>
    </body>
</html>
```
###### List.Blade.php
- Partners list blade contains
  - Partners list
  - Create new partner form
```html
@extends('layout')
<div class="container" style="padding-top: 50px; padding-bottom: 100px; text-align:center;">
    <h1>Partners List</h1>
    <table class="table">
        <thead>
            <tr>
                <td scope="col-3-lg">ID</td>
                <td scope="col-3-lg">Photo</td>
                <td scope="col-3-lg">NAME</td>
                <td scope="col-3-lg">OPERATION</td>
            </tr>
        </thead>
        <tbody>
            @foreach($partners as $partner)
            <tr>
                <th scope="row"><a href="/api/partners/{{$partner['id']}}">{{$partner['id']}}</a></th>
                <td><img src="{{ asset('storage/' . $partner['photo']) }}" alt="no photo"></td>
                <td>{{$partner['name']}}</td>
            <td><a href="{{"partners/".$partner['id']}}" >View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h1>To add new Partner</h1>
    <form action="partners" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Name" >
        </div>
        <div class="form-group">
            <input class="form-control-file" type="file" name="photo" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
```
###### Single.Blade.php
- Single partners blade contains:
  - Information of single partner.
  - Edit single partner form.
  - Delete single partner operation.
```html
@extends('layout')
<div class="container" style="padding-top: 50px; padding-bottom: 100px; text-align:center;">
    <h1>Partner</h1>
    <table class="table">
        <thead>
            <tr>
                <td scope="col-3-lg">ID</td>
                <td scope="col-3-lg">PHOTO</td>
                <td scope="col-3-lg">NAME</td>
                <td scope="col-3-lg">OPERATION</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{$data['id']}}</th>
                <td><img src="{{ asset('storage/' . $data['photo']) }}" alt="no photo"></td>
                <td>{{$data['name']}}</td>
                <td><form action="" method="POST">
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Delete</button></form></td>
            </tr>
        </tbody>
    </table>
    <h1>Edit Partner</h1>
    <form action="" method="POST" >
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="photo">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Name" value="{{$data['name']}}" id="name">
        </div>
        <div class="form-group">
            <input class="form-control-file" type="file" name="photo" id="photo">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
```
### For Questions
Linkedin Account:
[https://www.linkedin.com/in/barış-yıldırım-933375194](https://www.linkedin.com/in/barış-yıldırım-933375194)
Gmail Account:
yildrmbaris@gmail.com
