{!! Form::model($product, [
    'route' => 'products.store',
    'method' => 'POST'
]) !!}

    <div class="form-group">
        <label for="kode" class="control-label">Kode</label>
        {!! Form::text('kode_produk', null, ['class' => 'form-control', 'id' => 'kode', 'placeholder' => 'Masukan kode produk']) !!}
    </div>

    <div class="form-group">
        <label for="name" class="control-label">Nama</label>
        {!! Form::text('nama_produk', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Masukan nama produk']) !!}
    </div>

    <div class="form-group">
        <label for="harga" class="control-label">Harga</label>
        {!! Form::text('harga', null, ['class' => 'form-control', 'id' => 'harga', 'placeholder' => 'Masukan harga produk']) !!}
    </div>

{!! Form::close() !!}