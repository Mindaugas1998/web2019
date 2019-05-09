<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create</title>
</head>
<body>
<h1>Item List</h1>
<div>
    <a href="/">Homepage</a>
</div>
<div>
        <button type="submit">Create New Project</button>
</div>

@foreach($items as $item)
<div>
    <li>
        {{ $item->title }}
        <div>{{ $item->description }}</div>
        <div>{{ $item->price }}</div>
        <div>{{ $item->phone }}</div>
    </li>
</div>
@endforeach

</body>
</html>
