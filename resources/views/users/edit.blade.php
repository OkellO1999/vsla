<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Edit info here.</h1>

    <form action="{{route('register.edit', ['user'=>$user])}}" method="post">

        @csrf
        @method('put')
        <input type="text" name="name" id="" placeholder="Names" value="{{$user->name}}">
        <input type="text" name="username" id="" placeholder="Username" value="{{$user->username}}">
        <input type="email" name="email" id="" placeholder="Email" value="{{$user->email}}">
        <input type="submit" value="Update">
    </form>
</body>
</html>