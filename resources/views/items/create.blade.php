<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
</head>
<body>
    <h1>Create a New Item</h1>
    <form method="POST" action="/items">
        {{ csrf_field() }}

        <div>
            <input type="text", name="title" placeholder="Item title">
        </div>

        <div>
            <textarea name="description" placeholder="Item description"></textarea>
        </div>

        <div>
            <input type="text", name="price" placeholder="Item price">
        </div>

        <div>
            <input type="text", name="phone" placeholder="phone number">
        </div>

        <div>
            <button type="submit">Create Item</button>
        </div>
    </form>
</body>
</html>
