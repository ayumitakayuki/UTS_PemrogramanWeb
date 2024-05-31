<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataanggaranRequest;
use App\Http\Requests\StoreDataanggaranRequest;
use App\Http\Requests\UpdateDataanggaranRequest;
use App\Models\Dataanggaran;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DataanggaranController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_anggaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $data_anggaran = Dataanggaran::with(['media'])->get();
    
        // Hitung total sisa anggaran dari semua data
        $total_sisa_anggaran = $data_anggaran->sum('Alokasi_anggaran') - $data_anggaran->sum('Penggunaan_anggaran');
    
        return view('admin.dataanggarans.index', compact('data_anggaran', 'total_sisa_anggaran'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_anggaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataanggarans.create');
    }

    public function store(StoreDataanggaranRequest $request)
    {
        $data_anggaran = Dataanggaran::create($request->all());

        // if ($request->input('image', false)) {
        //     $data_anggaran->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        // }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $data_anggaran->id]);
        // }

        return redirect()->route('admin.dataanggarans.index');
    }

    public function edit(Dataanggaran $data_anggaran)
    {
        abort_if(Gate::denies('data_anggaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataanggarans.edit', compact('data_anggaran'));
    }

    public function update(UpdateDataanggaranRequest $request, Dataanggaran $data_anggaran)
    {
        $data_anggaran->update($request->all());

        // if ($request->input('image', false)) {
        //     if (! $data_anggaran->image || $request->input('image') !== $data_anggaran->image->file_name) {
        //         if ($data_anggaran->image) {
        //             $data_anggaran->image->delete();
        //         }
        //         $data_anggaran->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        //     }
        // } elseif ($data_anggaran->image) {
        //     $data_anggaran->image->delete();
        // }

        return redirect()->route('admin.dataanggarans.index');
    }

    public function show(Dataanggaran $data_anggaran)
    {
        abort_if(Gate::denies('data_anggaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataanggarans.show', compact('data_anggaran'));
    }

    public function destroy(Dataanggaran $data_anggaran)
    {
        abort_if(Gate::denies('data_anggaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data_anggaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataanggaranRequest $request)
    {
        $data_anggaran = Dataanggaran::find(request('ids'));

        foreach ($data_anggaran as $data_anggaran) {
            $data_anggaran->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_anggaran_create') && Gate::denies('data_anggaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Dataanggaran();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}