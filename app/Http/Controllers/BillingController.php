<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\User;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BillingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $billings = Billing::with('tenant')->latest()->get();

            return view('admin.billings.index', compact('billings'));
        }

        $billings = Billing::where('tenant_id', Auth::id())->latest()->get();
        $paymentSetting = PaymentSetting::current();

        return view('tenant.billings.index', compact('billings', 'paymentSetting'));
    }

    public function uploadReceipt(Request $request, Billing $billing)
    {
        abort_if(Auth::user()->role !== 'tenant' || $billing->tenant_id !== Auth::id(), 403);

        $data = $request->validate([
            'gcash_receipt' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gcash_reference_number' => ['nullable', 'string', 'max:100'],
        ]);

        if ($billing->gcash_receipt_path) {
            Storage::disk('public')->delete($billing->gcash_receipt_path);
        }

        $path = $request->file('gcash_receipt')->store('gcash-receipts', 'public');

        $billing->update([
            'gcash_receipt_path' => $path,
            'gcash_reference_number' => $data['gcash_reference_number'] ?? null,
            'receipt_uploaded_at' => now(),
            'status' => 'Submitted',
        ]);

        return back()->with('success', 'Receipt uploaded successfully. Wait for admin verification.');
    }

    public function gcashPayments()
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $billings = Billing::with('tenant')
            ->whereNotNull('gcash_receipt_path')
            ->latest('receipt_uploaded_at')
            ->get();

        return view('admin.payments.gcash-payments', compact('billings'));
    }

    public function verifyGcashPayment(Billing $billing)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $billing->update([
            'status' => 'Paid',
            'remarks' => 'GCash payment verified by admin.',
        ]);

        return back()->with('success', 'Payment verified successfully.');
    }

    public function create()
    {
        return view('admin.billings.create', [
            'tenants' => User::where('role', 'tenant')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'month' => 'required',
            'status' => 'required'
        ]);

        Billing::create($request->all());

        return redirect()->route('billings.index')->with('success', 'Billing record created.');
    }

    public function edit(Billing $billing)
    {
        return view('admin.billings.edit', [
            'billing' => $billing,
            'tenants' => User::where('role', 'tenant')->get()
        ]);
    }

    public function update(Request $request, Billing $billing)
    {
        $billing->update([
            'status' => $request->status,
        ]);

        return redirect()->route('billings.index')
            ->with('success', 'Billing status updated successfully.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();

        return back()->with('success', 'Billing deleted.');
    }

    public function paymentDashboard()
    {
        $totalBillings = Billing::count();
        $paid = Billing::where('status', 'Paid')->count();
        $unpaid = Billing::where('status', 'Unpaid')->count();
        $partial = Billing::where('status', 'Partial')->count();
        $submitted = Billing::where('status', 'Submitted')->count();

        $totalAmount = Billing::sum('amount');
        $paidAmount = Billing::where('status', 'Paid')->sum('amount');
        $unpaidAmount = Billing::where('status', 'Unpaid')->sum('amount');
        $partialAmount = Billing::where('status', 'Partial')->sum('amount');
        $submittedAmount = Billing::where('status', 'Submitted')->sum('amount');

        $recentBillings = Billing::with('tenant')
            ->latest()
            ->take(10)
            ->get();

        $setting = PaymentSetting::current();

        return view('admin.payments.dashboard', compact(
            'totalBillings',
            'paid',
            'unpaid',
            'partial',
            'submitted',
            'totalAmount',
            'paidAmount',
            'unpaidAmount',
            'partialAmount',
            'submittedAmount',
            'recentBillings',
            'setting'
        ));
    }
}