<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SeminarsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('seminar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Seminar::query()->select(sprintf('%s.*', (new Seminar())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'seminar_show';
                $editGate = 'seminar_edit';
                $deleteGate = 'seminar_delete';
                $crudRoutePart = 'seminars';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('pdf', function ($row) {
                return $row->pdf ? '<a href="' . $row->pdf->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'pdf']);

            return $table->make(true);
        }

        return view('admin.seminars.index');
    }

    public function create()
    {
        abort_if(Gate::denies('seminar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seminars.create');
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

        return redirect()->route('admin.seminars.index');
    }

    public function edit(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seminars.edit', compact('seminar'));
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

        return redirect()->route('admin.seminars.index');
    }

    public function show(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seminars.show', compact('seminar'));
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
