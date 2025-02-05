<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function impersonate($user_id) {
        $original_id = Auth::user()->id;
        session()->put('impersonate', $original_id);
        Auth::loginUsingId($user_id);
        return redirect()->route('clients.index');
    }

    public function leaveImpersonate() {
        if(!session()->has('impersonate')) abort(403);
        $id = session()->get('impersonate');
        session()->remove('impersonate');
        session()->remove('company_id');
        Auth::loginUsingId($id);
        return redirect()->route('clients.index');
    }
}
