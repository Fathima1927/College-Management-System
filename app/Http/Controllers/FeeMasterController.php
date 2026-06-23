<?php

namespace App\Http\Controllers;

use App\Models\FeeMaster;
use Illuminate\Http\Request;

class FeeMasterController extends Controller
{
    public function index()
    {
        $fees = FeeMaster::all();
        return view('fee-masters.index', compact('fees'));
    }

    public function create()
    {
        return view('fee-masters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'category' => 'required',
            'fee_name' => 'required',
            'amount' => 'required|numeric',
        ]);

        FeeMaster::create($request->all());

        return redirect()->route('fee-masters.index')
            ->with('success', 'Fee created successfully');
    }

    public function show(FeeMaster $feeMaster)
    {
        return view('fee-masters.show', compact('feeMaster'));
    }

    public function edit(FeeMaster $feeMaster)
    {
        return view('fee-masters.edit', compact('feeMaster'));
    }

    public function update(Request $request, FeeMaster $feeMaster)
    {
        $request->validate([
            'department' => 'required',
            'category' => 'required',
            'fee_name' => 'required',
            'amount' => 'required|numeric',
        ]);

        $feeMaster->update($request->all());

        return redirect()->route('fee-masters.index')
            ->with('success', 'Fee updated successfully');
    }

    public function destroy(FeeMaster $feeMaster)
    {
        $feeMaster->delete();

        return redirect()->route('fee-masters.index')
            ->with('success', 'Fee deleted successfully');
    }
}