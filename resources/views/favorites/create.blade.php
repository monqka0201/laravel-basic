<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>お気に入りに追加</title>
  </head>

  <body>
    <h1>お気に入り追加ページ</h1>

    <form method="POST" action="{{ route('favorites.store') }}">
      @csrf
      <label for="product_id">商品選択：</label>
      <select name="product_id" id="product_id">
        @foreach($products as $product)
          <option value="{{ $product->id }}">
          {{ $product->product_name }} - ¥{{ number_format($product->price) }}
          </option>
        @endforeach
      </select>
      <button type="submit">お気に入りに追加</button>
    </form>

    <p><a href="{{ route('favorites.index') }}">お気に入り一覧へ戻る</a></p>
  </body>
  </html>