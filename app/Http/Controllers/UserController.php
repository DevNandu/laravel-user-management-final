<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['department', 'designation']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhereHas('department', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('designation', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', "%$search%");
                  });
            });
        }

        $users = $query->paginate(9); // Show 9 users per page (3x3 grid)

        if ($request->ajax()) {
            return view('users.index', compact('users'))->render();
        }

        return view('users.index', compact('users'));
    }
    public function exportCsv()
    {
        $users = User::with(['department', 'designation'])->get();

        $csvExporter = Writer::createFromFileObject(new \SplTempFileObject());
        $csvExporter->insertOne(['Name', 'Department', 'Designation', 'Phone Number']);

        foreach ($users as $user) {
            $csvExporter->insertOne([
                $user->name,
                $user->department->name,
                $user->designation->name,
                $user->phone_number
            ]);
        }

        $csvContent = (string) $csvExporter->getContent();

        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }
}
