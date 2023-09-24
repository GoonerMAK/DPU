<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ProjectType;
use App\Models\Achievement;
use App\Models\FundSource;
use App\Models\CRC;
use App\Models\SubCRC;
use App\Models\Project;

class ProjectController extends Controller
{
    public function showAddProjectForm()
    {
        $projectTypes = ProjectType::all();
        $statusOptions = ['Ongoing', 'Complete', 'Unapproved'];
        $achievements = Achievement::all();
        $fundingSources = FundSource::all();
        $crcs = CRC::all();
        $subCrcs = SubCRC::all();

        return view('pages.AddProject', [
            'projectTypes' => $projectTypes,
            'statusOptions' => $statusOptions,
            'achievements' => $achievements,
            'fundingSources' => $fundingSources,
            'crcs' => $crcs,
            'subCrcs' => $subCrcs
        ]);

    }
    
    // New method to handle the AJAX request for Sub CRC options
    public function getSubCRCOptions(Request $request)
    {
        $selectedCRCId = $request->input('crc_id');

        // Retrieve Sub CRC options based on the selected CRC
        $subCRCOptions = SubCRC::where('crc_id', $selectedCRCId)->get(['sub_crc_id', 'sub_crc_name']);

        return new JsonResponse($subCRCOptions);
    }

    public function addProject(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'projectCode' => 'required|numeric',
            'projectNameEn' => 'required|max:1000',
            'projectNameBn' => 'max:1000',
            'projectType' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'totalCost' => 'required|numeric|min:0',
            'objective' => 'max:1000',
            'activities' => 'max:100',
            'status' => 'required',
            'area' => 'max:50',
            'achievement' => 'required|array|min:1',
            'achievement.*' => 'distinct',
            'fundingSource' => 'required|array|min:1',
            'fundingSource.*' => 'distinct',
            'crc' => 'required|exists:crc,crc_id',
            'subcrc' => 'required|exists:sub_crc,sub_crc_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the form data
        $projectCode = $request->input('projectCode');
        $projectNameEn = $request->input('projectNameEn');
        $projectNameBn = $request->input('projectNameBn');
        $projectType = $request->input('projectType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $totalCost = $request->input('totalCost');
        $objective = $request->input('objective');
        $activities = $request->input('activities');
        $status = $request->input('status');
        $area = $request->input('area');
        $achievements = $request->input('achievement');
        $fundingSources = $request->input('fundingSource');
        $crcId = $request->input('crc');
        $subCrcId = $request->input('subcrc');

        // Create a new project instance and save it to the database
        $project = new Project();
        $project->project_id = $projectCode;
        $project->project_name = $projectNameEn;
        $project->project_name_bn = $projectNameBn;
        $project->start_date = $startDate;
        $project->end_date = $endDate;
        $project->total_cost = $totalCost;
        $project->objective = $objective;
        $project->activities = $activities;
        $project->status = $status;
        $project->area = $area;
        $project->funding_source = implode(', ', $fundingSources);
        $project->achievement = implode(', ', $achievements);
        $project->sub_crc_id = $subCrcId;

        // Save the project data to the database
        $project->save();

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Project added successfully!');
    }

}
