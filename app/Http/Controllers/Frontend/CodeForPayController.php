<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCodeForPayRequest;
use App\Http\Requests\StoreCodeForPayRequest;
use App\Http\Requests\UpdateCodeForPayRequest;
use App\Models\CodeForPay;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CodeForPayController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('code_for_pay_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeForPays = CodeForPay::with(['user'])->get();

        return view('frontend.codeForPays.index', compact('codeForPays'));
    }

    public function create()
    {
        abort_if(Gate::denies('code_for_pay_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.codeForPays.create', compact('users'));
    }

    public function store(StoreCodeForPayRequest $request)
    {
        $codeForPay = CodeForPay::create($request->all());

        return redirect()->route('frontend.code-for-pays.index');
    }

    public function edit(CodeForPay $codeForPay)
    {
        abort_if(Gate::denies('code_for_pay_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $codeForPay->load('user');

        return view('frontend.codeForPays.edit', compact('users', 'codeForPay'));
    }

    public function update(UpdateCodeForPayRequest $request, CodeForPay $codeForPay)
    {
        $codeForPay->update($request->all());

        return redirect()->route('frontend.code-for-pays.index');
    }

    public function show(CodeForPay $codeForPay)
    {
        abort_if(Gate::denies('code_for_pay_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeForPay->load('user');

        return view('frontend.codeForPays.show', compact('codeForPay'));
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
