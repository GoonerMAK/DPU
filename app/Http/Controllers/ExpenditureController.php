<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    public function showExpenditureForm()
    {
        $budgetTypes = ['Revenue', 'Capital'];

        return view('pages.AddExpenditure', [
            'budgetTypes' => $budgetTypes
        ]);

    }
}
