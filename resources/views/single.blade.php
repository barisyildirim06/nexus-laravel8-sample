@extends('layout')
<div class="container" style="padding-top: 50px; padding-bottom: 100px; text-align:center;">
    <h1>Partner</h1>

    <table class="table">
        <thead>
            <tr>
                <td scope="col-4-lg">ID</td>
                <td scope="col-4-lg">Photo</td>
                <td scope="col-4-lg">NAME</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><a href="/api/partners/{{$data['id']}}">{{$data['id']}}</a></th>
                <td><img src="{{ asset('storage/' . $data['photo']) }}" alt="no photo"></td>
                <td>{{$data['name']}}</td>
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
