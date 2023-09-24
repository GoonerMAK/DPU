<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;

class SubExpenditureController extends Controller
{
    public function showSubExpenditureForm()
    {
        $expenditures = Expenditure::all();

        return view('pages.SubExpenditure', [
            'expenditures' => $expenditures
        ]);

    }
}
