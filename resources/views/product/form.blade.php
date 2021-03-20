{!! Form::model($product, [
    'route' => 'products.store',
    'method' => 'POST'
]) !!}

    <div class="form-group">
        <label for="kode" class="control-label">Kode</label>
        {!! Form::text('kode_produk', null, ['class' => 'form-control', 'id' => 'kode']) !!}
    </div>

    <div class="form-group">
        <label for="name" class="control-label">Nama</label>
        {!! Form::text('nama_produk', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>

    <div class="form-group">
        <label for="harga" class="control-label">Harga</label>
        {!! Form::text('harga', null, ['class' => 'form-control', 'id' => 'harga']) !!}
    </div>

    <div class="form-group">
        <label for="stok" class="control-label">Stok</label>
        {!! Form::number('stok', null, ['class' => 'form-control', 'id' => 'stok']) !!}
    </div>

{!! Form::close() !!}