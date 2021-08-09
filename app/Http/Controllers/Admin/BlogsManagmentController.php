<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogsManagmentRequest;
use App\Http\Requests\StoreBlogsManagmentRequest;
use App\Http\Requests\UpdateBlogsManagmentRequest;
use App\Models\BlogsManagment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BlogsManagmentController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('blogs_managment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BlogsManagment::with(['user'])->select(sprintf('%s.*', (new BlogsManagment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'blogs_managment_show';
                $editGate = 'blogs_managment_edit';
                $deleteGate = 'blogs_managment_delete';
                $crudRoutePart = 'blogs-managments';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? BlogsManagment::STATUS_RADIO[$row->status] : '';
            });
            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.blogsManagments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('blogs_managment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.blogsManagments.create', compact('users'));
    }

    public function store(StoreBlogsManagmentRequest $request)
    {
        $blogsManagment = BlogsManagment::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blogsManagment->id]);
        }

        return redirect()->route('admin.blogs-managments.index');
    }

    public function edit(BlogsManagment $blogsManagment)
    {
        abort_if(Gate::denies('blogs_managment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blogsManagment->load('user');

        return view('admin.blogsManagments.edit', compact('users', 'blogsManagment'));
    }

    public function update(UpdateBlogsManagmentRequest $request, BlogsManagment $blogsManagment)
    {
        $blogsManagment->update($request->all());

        return redirect()->route('admin.blogs-managments.index');
    }

    public function show(BlogsManagment $blogsManagment)
    {
        abort_if(Gate::denies('blogs_managment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogsManagment->load('user');

        return view('admin.blogsManagments.show', compact('blogsManagment'));
    }

    public function destroy(BlogsManagment $blogsManagment)
    {
        abort_if(Gate::denies('blogs_managment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogsManagment->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogsManagmentRequest $request)
    {
        BlogsManagment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('blogs_managment_create') && Gate::denies('blogs_managment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BlogsManagment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
