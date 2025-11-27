<?php

namespace App\Http\Controllers\admin\config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FinancialYear;
class FinancialyearController extends Controller
{
    public function financialYears(Request $request)
    {
        $financialYears = FinancialYear::get();
        $data['years'] = $financialYears;
        return view('admin.config.year.index', $data);
    }

    public function create(Request $request)
    {
        $html = view('admin.config.year.create')->render();

        return response()->json([
            'token_status' => true,
            'error_status' => true,
            'body' => $html
        ]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
        ], [
            'from_date.required' => 'From date is required.',
            'to_date.required'   => 'To date is required.',
            'to_date.after_or_equal' => 'To date must be greater than or equal to From date.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $DataIn['from_date'] = date('Y-m-d', strtotime($request->from_date));
        $DataIn['to_date'] = date('Y-m-d', strtotime($request->to_date));
        $DataIn['from_year'] = date('Y', strtotime($request->from_date));
        $DataIn['to_year'] = date('Y', strtotime($request->to_date));
        $DataIn['status'] = '1';
        $DataIn['is_running_year'] = $request->is_running_year;
        $DataIn['created_by'] = session()->get('user_id');

        FinancialYear::create($DataIn);

        return redirect()->back()->with('success', 'New Financial year added successfully..');
    }

    public function editYear($id)
    {

    }

    public function updateYear(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }
    
}
