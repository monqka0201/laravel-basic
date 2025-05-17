<!DOCTYPE html>
<html lang="ja">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel基礎</title>
</head>

<body>
  <p>
    こんにちは、{{ $name }}さん！
  </p>
  <ul>@foreach($languages as $languade)
    <li>{{ $language }}</li>
    <!-- @foreach -->
  </ul>
</body>
</html>
