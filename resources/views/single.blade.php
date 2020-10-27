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
