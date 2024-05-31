@extends('layouts.admin')
@section('content')
@can('data_anggaran_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.dataanggarans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.data_anggaran.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.data_anggaran.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Kategori_pengeluaran') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Alokasi_anggaran') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Penggunaan_anggaran') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_anggaran.fields.Sisa_anggaran') }}
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data_anggaran as $key => $d)
                        <tr>
                            <td>{{ $d->id ?? '' }}</td>
                            <td>{{ $d->Kategori_pengeluaran ?? '' }}</td>
                            <td>{{ 'Rp ' . number_format($d->Alokasi_anggaran ?? 0, 0, ',', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($d->Penggunaan_anggaran ?? 0, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Sisa Anggaran</th>
                        <th>Rp {{ number_format($total_sisa_anggaran, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        @can('data_anggaran_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.dataanggarans.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id');
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}');

                    return;
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () { location.reload(); });
                }
            }
        };
        dtButtons.push(deleteButton);
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100
        });

        let table = $('.datatable').DataTable({ buttons: dtButtons });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        let totalSisaAnggaran = {{ $total_sisa_anggaran }};
        $('tfoot tr th:last-child').text('Rp ' + totalSisaAnggaran.toLocaleString());
    });
</script>
@endsection