<form action="/products" method="POST" enctype="multipart/form-data">
  @csrf
  <div>
    <label>商品名</label>
    <input type="text" name="product_name">
  </div>

  <div>
    <label>価格</label>
    <input type="number" name="price">
  </div>

  <div>
    <label>商品説明</label>
    <textarea name="description"></textarea>
  </div>

  <div>
    <label>在庫数</label>
    <input type="number" name="stock">
  </div>

  <div>
    <label>商品画像</label>
    <input type="file" name="img_path">
  </div>

  <button type="submit">登録</button>
</form>
