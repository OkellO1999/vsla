<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registered Users</h1>

    <a href="{{route('register.regForm')}}" style="background: green; padding:1%; text-decoration:none; border-radius:25px; outline:none; color:white; float:right;">+ Add User</a>

    @if(session()->has('success'))
        <p style="color: green; font-size: 2rem;">
            {{session('success')}}
        </p>
    @endif

    <table>
        <tr>
            <th>SN</th>
            <th>Names</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        @foreach($users as $user)
        <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
        <td>
            <a href="{{route('register.update', ['user'=>$user])}}">Edit</a>
            <form action="{{route('register.delete', ['user'=>$user])}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>

        </td>
        </tr>
    @endforeach
    </table>
</body>
</html>