<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactUsRequest;
use App\Http\Requests\StoreContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use App\Models\ContactUs;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_us_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactUs::query()->select(sprintf('%s.*', (new ContactUs())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contact_us_show';
                $editGate = 'contact_us_edit';
                $deleteGate = 'contact_us_delete';
                $crudRoutePart = 'contactuses';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('subject', function ($row) {
                return $row->subject ? $row->subject : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.contactuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contact_us_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactuses.create');
    }

    public function store(StoreContactUsRequest $request)
    {
        $contactUs = ContactUs::create($request->all());

        return redirect()->route('admin.contactuses.index');
    }

    public function edit(ContactUs $contactUs)
    {
        abort_if(Gate::denies('contact_us_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactuses.edit', compact('contactUs'));
    }

    public function update(UpdateContactUsRequest $request, ContactUs $contactUs)
    {
        $contactUs->update($request->all());

        return redirect()->route('admin.contactuses.index');
    }

    public function show(ContactUs $contactUs)
    {
        abort_if(Gate::denies('contact_us_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactuses.show', compact('contactUs'));
    }

    public function destroy(ContactUs $contactUs)
    {
        abort_if(Gate::denies('contact_us_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactUs->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactUsRequest $request)
    {
        ContactUs::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
