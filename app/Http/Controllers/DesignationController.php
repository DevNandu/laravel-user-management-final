<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::paginate(10);
        return view('designations.index', compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:designations|max:255',
        ]);

        Designation::create($request->all());

        return redirect()->route('designations.index')
            ->with('success', 'Designation created successfully.');
    }

    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name' => 'required|unique:designations,name,' . $designation->id . '|max:255',
        ]);

        $designation->update($request->all());

        return redirect()->route('designations.index')
            ->with('success', 'Designation updated successfully');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return redirect()->route('designations.index')
            ->with('success', 'Designation deleted successfully');
    }
}
