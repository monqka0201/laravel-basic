<!DOCTYPE html>
<html>
  
<head>
  <meta charset="UTF-8">
  <title>お気に入り一覧</title>
</head>

<body>
  <h1>お気に入り一覧</h1>

  @if($favorites->isEmpty())
    <p>お気に入りに登録された商品はありません</p>
  @else

    <ul>
      @foreach($favorites as $product)
        <li>
          {{ $product->product_name }} - ¥{{ number_format($product->price) }}
          <form method="POST" action="{{ route('favorites.destroy', $product->id) }}" style="display:inline;">
            @csrf
            <button type="submit">お気に入りを解除</button>
          </form>
        </li>
      @endforeach
    </ul>
  @endif

  <p><a href="{{ route('favorites.create') }}">商品をお気に入りに追加する</a></p>
</body>
</html>