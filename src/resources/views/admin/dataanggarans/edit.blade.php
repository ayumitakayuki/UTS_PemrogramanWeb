@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.data_anggaran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dataanggarans.update", [$data_anggaran->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            {{-- <div class="form-group">
                <label for="image">{{ trans('cruds.data_anggaran.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="Kategori_anggaran">{{ trans('cruds.data_anggaran.fields.Kategori_anggaran') }}</label>
                <input class="form-control {{ $errors->has('Kategori_anggaran') ? 'is-invalid' : '' }}" type="text" name="Kategori_anggaran" id="Kategori_anggaran" value="{{ old('Kategori_anggaran', $product->Kategori_anggaran) }}">
                @if($errors->has('Kategori_anggaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Kategori_anggaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="Alokasi_anggaran">{{ trans('cruds.data_anggaran.fields.description') }}</label>
                <input class="form-control {{ $errors->has('Alokasi_anggaran') ? 'is-invalid' : '' }}" type="text" name="Alokasi_anggaran" id="Alokasi_anggaran" value="{{ old('Alokasi_anggaran', $data_Anggaran->Alokasi_anggaran) }}">
                @if($errors->has('Alokasi_anggaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Alokasi_anggaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.Alokasi_anggaran_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="Penggunaan_anggaran">{{ trans('cruds.product.fields.Penggunaan_anggaran') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="Penggunaan_anggaran" id="Penggunaan_anggaran" value="{{ old('Penggunaan_anggaran', $data_anggaran->Penggunaan_anggaran) }}" step="0.01">
                @if($errors->has('Penggunaan_anggaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Pengunaan_anggaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.Penggunaan_anggaran_helper') }}</span>
            {{-- </div>
            <div class="form-group">
                <label for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" step="1">
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Product::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $product->category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image)
      var file = {!! json_encode($product->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection