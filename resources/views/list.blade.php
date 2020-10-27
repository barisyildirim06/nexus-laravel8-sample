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
    <br>
    <br>
    <br>
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

