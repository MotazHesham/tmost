<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCodeForPayRequest;
use App\Http\Requests\StoreCodeForPayRequest;
use App\Http\Requests\UpdateCodeForPayRequest;
use App\Models\CodeForPay;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CodeForPayController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('code_for_pay_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CodeForPay::with(['user'])->select(sprintf('%s.*', (new CodeForPay())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'code_for_pay_show';
                $editGate = 'code_for_pay_edit';
                $deleteGate = 'code_for_pay_delete';
                $crudRoutePart = 'code-for-pays';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
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

        return view('admin.codeForPays.index');
    }

    public function create()
    {
        abort_if(Gate::denies('code_for_pay_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.codeForPays.create', compact('users'));
    }

    public function store(StoreCodeForPayRequest $request)
    {
        $codeForPay = CodeForPay::create($request->all());

        return redirect()->route('admin.code-for-pays.index');
    }

    public function edit(CodeForPay $codeForPay)
    {
        abort_if(Gate::denies('code_for_pay_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $codeForPay->load('user');

        return view('admin.codeForPays.edit', compact('users', 'codeForPay'));
    }

    public function update(UpdateCodeForPayRequest $request, CodeForPay $codeForPay)
    {
        $codeForPay->update($request->all());

        return redirect()->route('admin.code-for-pays.index');
    }

    public function show(CodeForPay $codeForPay)
    {
        abort_if(Gate::denies('code_for_pay_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeForPay->load('user');

        return view('admin.codeForPays.show', compact('codeForPay'));
    }

    public function destroy(CodeForPay $codeForPay)
    {
        abort_if(Gate::denies('code_for_pay_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeForPay->delete();

        return back();
    }

    public function massDestroy(MassDestroyCodeForPayRequest $request)
    {
        CodeForPay::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
