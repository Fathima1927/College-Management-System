<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCollection = FeePayment::where('status', 'Paid')->sum('amount');

        $pendingAmount = FeePayment::where('status', 'Pending')->sum('amount');

        $paidStudents = FeePayment::where('status', 'Paid')
            ->distinct('student_name')
            ->count();

        $recentPayments = FeePayment::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCollection',
            'pendingAmount',
            'paidStudents',
            'recentPayments'
        ));
    }
}