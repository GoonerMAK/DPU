<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CRC;
use App\Models\SubCRC;
use App\Models\Expenditure;
use App\Models\Project;
use App\Models\SubExpenditure;
use App\Models\SubExpCategory;

class FinanceController extends Controller
{
    public function showFinanceForm()
    {
        $projects = Project::all();
        $crcs = CRC::all();
        $subCrcs = SubCRC::all();
        $expenditures = Expenditure::all();
        $subExpenditures = SubExpenditure::all();
        $subExpCategories = SubExpCategory::all();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ];

        return view('pages.FinanceProject', [
            'projects' => $projects,
            'crcs' => $crcs,
            'subCrcs' => $subCrcs,
            'expenditures' => $expenditures,
            'subExpenditures' => $subExpenditures,
            'subExpCategories' => $subExpCategories,
            'months' => $months
        ]);

    }

    public function getSubEconomicCodes(Request $request)
    {
        $economicCode = $request->input('economicCode');

        $subEconomicCodes = DB::table('sub_exp')
            ->where('exp_code', $economicCode)
            ->get();

        return response()->json($subEconomicCodes);
    }

    public function getCategoryCodes(Request $request)
    {
        $subEconomicCode = $request->input('subEconomicCode');

        $categoryCodes = DB::table('sub_exp_cat')
            ->where('sub_exp_code', $subEconomicCode)
            ->get();

        return response()->json($categoryCodes);
    }

    public function addFinance(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'projectCode' => 'required|exists:project,project_id',
            'categoryCode' => 'required|exists:sub_exp_cat,cat_code',
            'year' => 'required|integer|min:1960|max:2040',
            'month' => 'required',
            'unit' => 'required|integer|min:0',
            'unitPrice' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'gobCost' => 'required|numeric|min:0',
            'paCost' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            // Save the data to the database
            DB::table('finance')->insert([
                'project_id' => $request->input('projectCode'),
                'cat_code' => $request->input('categoryCode'),
                'year' => $request->input('year'),
                'month' => $request->input('month'),
                'unit' => $request->input('unit'),
                'unit_price' => $request->input('unitPrice'),
                'quantity' => $request->input('quantity'),
                'gob_cost' => $request->input('gobCost'),
                'pa_cost' => $request->input('paCost'),
            ]);

            return redirect()->back()->with('success', 'Finance information added successfully!');

        }

        catch (QueryException $e) {
            // Check for unique constraint violation error (code 1062)
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', "Duplicate entry. The Sub Expenditure Category of this project has another entry for that month.");
            }

            // Handle other database exceptions if needed
            return redirect()->back()->with('error', 'An error occurred while adding finance information.');
        }

    }


}
