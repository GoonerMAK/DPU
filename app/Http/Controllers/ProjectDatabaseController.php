<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\SubCRC;
use App\Models\CRC;
use App\Models\Achievement;
use App\Models\FundSource;



class ProjectDatabaseController extends Controller
{
    
    public function showProjects()
    {
        $projects = Project::all();
        $crcs = CRC::all();
        $subCrcs = SubCRC::all();

        return view('databases.ProjectDatabase', compact('projects', 'crcs', 'subCrcs'));
    }
    
    public function viewProject($id)
    {
        $project = Project::findOrFail($id);
        return view('actions.ProjectView', compact('project'));
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        $crcs = CRC::all();
        $subCrcs = SubCRC::all();
        $statusOptions = ['Ongoing', 'Complete', 'Unapproved'];
        $achievements = Achievement::all();        
        $fundingSources = FundSource::all();

        $statusOptions = array_diff($statusOptions, [$project->status]);        // Removing the current status value from the statusOptions array if it exists

        return view('actions.ProjectEdit', compact('project', 'crcs', 'subCrcs', 'statusOptions', 'achievements', 'fundingSources'));

    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('showProjects')->with('success', 'Project deleted successfully!');
    }

    public function getSubCRCOptions(Request $request)      // New method to handle the AJAX request for Sub CRC options
    {
        $selectedCRCId = $request->input('crc_id');

        // Retrieve Sub CRC options based on the selected CRC
        $subCRCOptions = SubCRC::where('crc_id', $selectedCRCId)->get(['sub_crc_id', 'sub_crc_name']);

        return new JsonResponse($subCRCOptions);
    }


    public function updateProject(Request $request, $id)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'projectCode' => 'required|numeric',
            'projectNameEn' => 'required|max:1000',
            'projectNameBn' => 'max:1000',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'totalCost' => 'required|numeric|min:0',
            'objective' => 'max:1000',
            'activities' => 'max:1000',
            'status' => 'required',
            'area' => 'max:100',
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
        
        // Find the existing project record based on the ID
        $project = Project::findOrFail($id);

        // Update the project data with the edited form data
        $project->project_id = $request->input('projectCode');
        $project->project_name = $request->input('projectNameEn');
        $project->project_name_bn = $request->input('projectNameBn');
        $project->start_date = $request->input('startDate');
        $project->end_date = $request->input('endDate');
        $project->total_cost = $request->input('totalCost');
        $project->objective = $request->input('objective');
        $project->activities = $request->input('activities');
        $project->status = $request->input('status');
        $project->area = $request->input('area');
        $project->funding_source = implode(', ', $request->input('fundingSource'));
        $project->achievement = implode(', ', $request->input('achievement'));

        $selectedSubCRCValue = $request->input('subcrc');
        $sub_crc_id = (int)explode('.', $selectedSubCRCValue)[0];

        $project->sub_crc_id = $sub_crc_id;

        // Save the update project data to the database
        $project->save();

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Project updated successfully!');
    }
}
