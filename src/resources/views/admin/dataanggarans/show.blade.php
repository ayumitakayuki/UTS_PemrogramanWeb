@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.data_anggaran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dataanggarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.id') }}
                        </th>
                        <td>
                            {{ $data_anggaran->id }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.image') }}
                        </th>
                        {{-- <td>
                            @if($product->image)
                                <a href="{{ $product->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Kategori_pengeluaran') }}
                        </th>
                        <td>
                            {{ $data_anggaran->Kategori_pengeluaran }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Alokasi_Anggaran') }}
                        </th>
                        <td>
                            {{ $data_anggaran->Alokasi_Anggaran }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Penggunaan_anggaran') }}
                        </th>
                        <td>
                            {{ $data_anggaran->Penggunaan_anggaran }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.stock') }}
                        </th>
                        <td>
                            {{ $data_anggaran->stock }}
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\Product::CATEGORY_SELECT[$product->category] ?? '' }}
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dataanggarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection