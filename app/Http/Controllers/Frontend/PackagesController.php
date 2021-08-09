<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPackageRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Book;
use App\Models\Package;
use App\Models\Video;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PackagesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::with(['books', 'videos', 'media'])->get();

        return view('frontend.packages.index', compact('packages'));
    }

    public function create()
    {
        abort_if(Gate::denies('package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id');

        $videos = Video::pluck('title', 'id');

        return view('frontend.packages.create', compact('books', 'videos'));
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());
        $package->books()->sync($request->input('books', []));
        $package->videos()->sync($request->input('videos', []));
        foreach ($request->input('images', []) as $file) {
            $package->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $package->id]);
        }

        return redirect()->route('frontend.packages.index');
    }

    public function edit(Package $package)
    {
        abort_if(Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id');

        $videos = Video::pluck('title', 'id');

        $package->load('books', 'videos');

        return view('frontend.packages.edit', compact('books', 'videos', 'package'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());
        $package->books()->sync($request->input('books', []));
        $package->videos()->sync($request->input('videos', []));
        if (count($package->images) > 0) {
            foreach ($package->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $package->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $package->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('frontend.packages.index');
    }

    public function show(Package $package)
    {
        abort_if(Gate::denies('package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->load('books', 'videos');

        return view('frontend.packages.show', compact('package'));
    }

    public function destroy(Package $package)
    {
        abort_if(Gate::denies('package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackageRequest $request)
    {
        Package::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('package_create') && Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Package();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
