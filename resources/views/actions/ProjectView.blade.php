<html>
<head>
    <title>The Project View</title>
    <style>
        .container {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem !important;
            font-weight: bold !important;
            margin-bottom: 20px !important;
        }

        form {
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type = "date"],
        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 240px;
        }


        input[type="submit"] {
            padding: 8px 15px;
            background-color: #6875F5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 30px auto;
            width: 80px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container input[type="submit"] {
            background-color: #4CAF50;
        }

        .btn-container input[type="submit"]:hover {
            background-color: #222;
        }
    </style>
</head>


<body>

<x-app-layout>

<div class="container">

<h1>The Project</h1>


<table>
<tr>
    <td>Project Code</td>
    <td><input type="text" name="projectCode" value="{{ $project->project_id }}" readonly/></td>
</tr>

<tr>
    <td>Project Name (English)</td>
    <td><input type="text" name="projectNameEn" value="{{ $project->project_name }}" readonly/></td>
</tr>

<tr>
    <td>Project Name (Bengali)</td>
    <td><input type="text" name="projectNameBn" value="{{ $project->project_name_bn }}" readonly/></td>
</tr>
    
<tr>
    <td>Start Date</td>
    <td><input type="text" name="startDate" value="{{ $project->start_date }}" readonly></td>
</tr>

<tr>
    <td>End Date</td>
    <td><input type="text" name="endDate" value="{{ $project->end_date }}" readonly></td>
</tr>

<tr>
    <td>Total Cost</td>
    <td><input type="number" name="totalCost" value="{{ $project->total_cost }}" readonly/></td>
</tr>

<tr>
    <td>Objective</td>
    <td><input type="text" name="objective" value="{{ $project->objective }}" readonly/></td>
</tr>

<tr>
    <td>Activities</td>
    <td><input type="text" name="activities" value="{{ $project->activities }}" readonly/></td>
</tr>

<tr>
    <td>Status</td>
    <td><input type="text" name="status" value="{{ $project->status }}" readonly/></td>
</tr>

<tr>
    <td>Project Area</td>
    <td><input type="text" name="area" value="{{ $project->area }}" readonly/></td>
</tr>

<tr>
    <td>Achievement</td>
    <td><input type="text" name="achievement" value="{{ $project->achievement }}" readonly/></td>
</tr>

<tr>
    <td>Funding Source</td>
    <td><input type="text" name="fundingSource" value="{{ $project->funding_source }}" readonly/></td>
</tr>

<tr>
    <td>Climate Relevance Criteria (CRC)</td>
    <td>
        @if ($project->sub_crc)
            @php
                $crc = \App\Models\CRC::find($project->sub_crc->crc_id);
            @endphp
            @if ($crc)
                <input type="text" name="crc" value="{{ $crc->crc_id }}. {{ $crc->crc_name }}" readonly/>
            @else
                <input type="text" name="crc" value="Not Available" readonly/>
            @endif
        @else    
            <input type="text" name="crc" value="Not Available" readonly/>
        @endif
    </td> 
</tr>

<tr>
    <td>Sub CRC</td>
    <td><input type="text" name="subcrc" value="{{ $project->sub_crc->sub_crc_id }}. {{ $project->sub_crc->sub_crc_name }}" readonly/></td>
</tr>

</table>

<form action="/ProjectDatabase" method="get">
    <input type="submit" value="Back"/>      
</form>

</div>

</x-app-layout>


</body>
</html>