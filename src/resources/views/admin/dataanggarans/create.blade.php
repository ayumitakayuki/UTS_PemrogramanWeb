@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.data_anggaran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dataanggarans.store") }}" enctype="multipart/form-data">
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
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.image_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="Kategori_pengeluaran">{{ trans('cruds.data_anggaran.fields.Kategori_pengeluaran') }}</label>
                <input class="form-control {{ $errors->has('Kategori_pengeluaran') ? 'is-invalid' : '' }}" type="text" name="Kategori_pengeluaran" id="Kategori_pengeluaran" value="{{ old('Kategori_pengeluaran', '') }}">
                @if($errors->has('Kategori_pengeluaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Kategori_pengeluaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.Kategori_pengeluaran_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="Alokasi_anggaran">{{ trans('cruds.data_anggaran.fields.Alokasi_anggaran') }}</label>
                <input class="form-control {{ $errors->has('Alokasi_anggaran') ? 'is-invalid' : '' }}" type="number" name="Alokasi_anggaran" id="Alokasi_anggaran" value="{{ old('Alokasi_anggaran', '') }}">
                @if($errors->has('Alokasi_anggaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Alokasi_anggaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.Alokasi_anggaran_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="Penggunaan_anggaran">{{ trans('cruds.data_anggaran.fields.Penggunaan_anggaran') }}</label>
                <input class="form-control {{ $errors->has('Penggunaan_anggaran') ? 'is-invalid' : '' }}" type="number" name="Penggunaan_anggaran" id="Penggunaan_anggaran" value="{{ old('Penggunaan_anggaran', '') }}" step="0.01">
                @if($errors->has('Penggunaan_anggaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Penggunaan_anggaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.Penggunaan_anggaran_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="stock">{{ trans('cruds.data_anggaran.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', '') }}" step="1">
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.data_anggaran.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\data_anggaran::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_anggaran.fields.category_helper') }}</span>
            </div>--}}
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
{{-- <script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.dataanggarans.storeMedia') }}',
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
@if(isset($data_anggaran) && $data_anggaran->image)
      var file = {!! json_encode($data_anggaran->image) !!}
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

</script> --}}
@endsection