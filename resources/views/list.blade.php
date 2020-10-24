<h1>Partners List</h1>

<table border="1">
    <tr>
        <td>ID</td>
        <td>NAME</td>
    </tr>
    @foreach($partners as $partner)
    <tr>
    <td>{{$partner['id']}}</td>
    <td>{{$partner['name']}}</td>
    </tr>
    @endforeach
</table>

{{-- <span>{{$partners->links()}}</span>

<style>
    .w-5{
      display: none; 
    }
</style> --}}