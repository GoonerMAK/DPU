<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CRC;
use App\Models\SubCRC;
use App\Models\Expenditure;
use App\Models\Project;
use App\Models\SubExpenditure;
use App\Models\SubExpCategory;

class DppController extends Controller
{
    public function showDppForm()
    {
        $projects = Project::all();
        $crcs = CRC::all();
        $subCrcs = SubCRC::all();
        $expenditures = Expenditure::all();
        $subExpenditures = SubExpenditure::all();
        $subExpCategories = SubExpCategory::all();

        return view('pages.DppInformation', [
            'projects' => $projects,
            'crcs' => $crcs,
            'subCrcs' => $subCrcs,
            'expenditures' => $expenditures,
            'subExpenditures' => $subExpenditures,
            'subExpCategories' => $subExpCategories
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

    // New method to handle the AJAX request for Sub CRC options
    public function getSubCRCOptions(Request $request)
    {
        $selectedCRCId = $request->input('crc_id');

        // Retrieve Sub CRC options based on the selected CRC
        $subCRCOptions = SubCRC::where('crc_id', $selectedCRCId)->get(['sub_crc_id', 'sub_crc_name']);

        return new JsonResponse($subCRCOptions);
    }

}
