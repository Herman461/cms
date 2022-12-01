<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">@</span>
    <input type="text" class="form-control" placeholder="Имя пользователя" aria-label="Имя пользователя" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Имя пользователя получателя" aria-label="Имя пользователя получателя" aria-describedby="basic-addon2">
    <span class="input-group-text" id="basic-addon2">@example.com</span>
</div>

<label for="basic-url" class="form-label">Ваш URL-адрес</label>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
</div>

<div class="input-group mb-3">
    <span class="input-group-text">$</span>
    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
    <span class="input-group-text">.00</span>
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Имя пользователя"  aria-label="Имя пользователя">
    <span class="input-group-text">@</span>
    <input type="text" class="form-control" placeholder="Сервер" aria-label="Сервер">
</div>

<div class="input-group">
    <span class="input-group-text">С текстовым полем</span>
    <textarea class="form-control" aria-label="С текстовым полем"></textarea>
</div>
</body>
</html>