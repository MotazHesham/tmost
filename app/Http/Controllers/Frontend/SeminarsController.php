<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySeminarRequest;
use App\Http\Requests\StoreSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;
use App\Models\Seminar;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SeminarsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('seminar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminars = Seminar::with(['media'])->get();

        return view('frontend.seminars.index', compact('seminars'));
    }

    public function create()
    {
        abort_if(Gate::denies('seminar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.seminars.create');
    }

    public function store(StoreSeminarRequest $request)
    {
        $seminar = Seminar::create($request->all());

        if ($request->input('pdf', false)) {
            $seminar->addMedia(storage_path('tmp/uploads/' . basename($request->input('pdf'))))->toMediaCollection('pdf');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $seminar->id]);
        }

        return redirect()->route('frontend.seminars.index');
    }

    public function edit(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.seminars.edit', compact('seminar'));
    }

    public function update(UpdateSeminarRequest $request, Seminar $seminar)
    {
        $seminar->update($request->all());

        if ($request->input('pdf', false)) {
            if (!$seminar->pdf || $request->input('pdf') !== $seminar->pdf->file_name) {
                if ($seminar->pdf) {
                    $seminar->pdf->delete();
                }
                $seminar->addMedia(storage_path('tmp/uploads/' . basename($request->input('pdf'))))->toMediaCollection('pdf');
            }
        } elseif ($seminar->pdf) {
            $seminar->pdf->delete();
        }

        return redirect()->route('frontend.seminars.index');
    }

    public function show(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.seminars.show', compact('seminar'));
    }

    public function destroy(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminar->delete();

        return back();
    }

    public function massDestroy(MassDestroySeminarRequest $request)
    {
        Seminar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('seminar_create') && Gate::denies('seminar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Seminar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
