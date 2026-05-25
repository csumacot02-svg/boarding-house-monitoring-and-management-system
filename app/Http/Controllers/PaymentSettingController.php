<?php

namespace App\Http\Controllers;

use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentSettingController extends Controller
{
    public function edit()
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        return view('admin.payments.gcash-settings', [
            'setting' => PaymentSetting::current(),
        ]);
    }

    public function update(Request $request)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $data = $request->validate([
            'gcash_number' => ['required', 'string', 'max:30'],
            'gcash_account_name' => ['required', 'string', 'max:100'],
            'payment_instructions' => ['nullable', 'string', 'max:1000'],
        ]);

        PaymentSetting::current()->update($data);

        return back()->with('success', 'GCash details updated successfully.');
    }
}