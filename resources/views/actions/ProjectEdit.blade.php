<html>
<head>
    <title>The Project Edit</title>
    <link rel="stylesheet" href="{{ asset('multi-select-tag.css') }}">

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

<h1>Edit the Project</h1>

<form action="{{ route('updateProject', ['id' => $project->project_id]) }}" method="post" onsubmit="return validateForm()">
@csrf
<table>
<tr>
    <td>Project Code</td>
    <td><input type="text" name="projectCode" value="{{ $project->project_id }}" required/></td>
</tr>

<tr>
    <td>Project Name (English)</td>
    <td><input type="text" name="projectNameEn" value="{{ $project->project_name }}" required/></td>
</tr>

<tr>
    <td>Project Name (Bengali)</td>
    <td><input type="text" name="projectNameBn" value="{{ $project->project_name_bn }}" /></td>
</tr>
    
<tr>
    <td>Start Date</td>
    <td><input type="date" name="startDate" value="{{ $project->start_date }}" required></td>
</tr>

<tr>
    <td>End Date</td>
    <td><input type="date" name="endDate" value="{{ $project->end_date }}" required></td>
</tr>

<tr>
    <td>Total Cost</td>
    <td><input type="number" name="totalCost" value="{{ $project->total_cost }}" required/></td>
</tr>

<tr>
    <td>Objective</td>
    <td><input type="text" name="objective" value="{{ $project->objective }}" /></td>
</tr>

<tr>
    <td>Activities</td>
    <td><input type="text" name="activities" value="{{ $project->activities }}" /></td>
</tr>

<tr>
    <td>Status</td>
    <td>
        <select name="status" required>
            @isset($statusOptions)
            <option value="{{ $project->status }}" selected>{{ $project->status }}</option>
            @foreach ($statusOptions as $statusOption)
                <option value="{{ $statusOption }}">{{ $statusOption }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Project Area</td>
    <td><input type="text" name="area" value="{{ $project->area }}" /></td>
</tr>

<tr>
    <td>Achievement</td>
    <td>
        <select name="achievement[]" id="achievement" multiple required>   
            @foreach (explode(', ', $project->achievement) as $achieved)
                <option value="{{ $achieved }}" selected>{{ $achieved }}</option>
            @endforeach      

            @isset($achievements)
            @foreach($achievements as $achievement)
                @php
                    $selectedAchievements = explode(', ', $project->achievement);
                    $isAlreadySelected = in_array($achievement->achievement, $selectedAchievements);
                @endphp
                @unless ($isAlreadySelected)
                    <option value="{{ $achievement->achievement }}">{{ $achievement->achievement }}</option>
                @endunless
            @endforeach
            @endisset
        </select>
    </td>
</tr>


<tr>
    <td>Funding Source</td>
    <td>
        <select name="fundingSource[]" id="fundingSource" multiple required>
            @foreach (explode(', ', $project->funding_source) as $funded)
                <option value="{{ $funded }}" selected>{{ $funded }}</option>
            @endforeach  

            @isset($fundingSources)
            @foreach($fundingSources as $fundingSource)
                @php
                    $selectedFundingSources = explode(', ', $project->funding_source);
                    $isAlreadySelected = in_array($fundingSource->source, $selectedFundingSources);
                @endphp
                @unless ($isAlreadySelected)
                    <option value="{{ $fundingSource-> source }}">{{ $fundingSource-> source }}</option>
                @endunless
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Climate Relevance Criteria (CRC)</td>
    <td>
        @php
        $crcValue = "Not Available"; 
        if ($project->sub_crc) 
        {
            $crc = \App\Models\CRC::find($project->sub_crc->crc_id);
            if ($crc) 
            {
                $crcValue = $crc->crc_id . ". " . $crc->crc_name;
            }
        }
        @endphp

        <select name="crc" required>
            <option value="{{ $crcValue }}" selected>{{ $crcValue }}</option>
            @isset($crcs)
            @foreach($crcs as $crc)
            @php
                $optionValue = $crc->crc_id . ". " . $crc->crc_name;
            @endphp
                @if ($optionValue !== $crcValue)
                    <option value="{{ $crc->crc_id }}">{{ $optionValue }}</option>
                @endif
            @endforeach
            @endisset
        </select>
    </td>   
</tr>

<tr>
    <td>Sub CRC</td>
    <td>
        @php
            $selectedSubCRCValue = $project->sub_crc->sub_crc_id . '. ' . $project->sub_crc->sub_crc_name;
        @endphp
        <select name="subcrc" id="subcrc-select" required>
            <option value="{{ $selectedSubCRCValue}}" selected> {{ $selectedSubCRCValue}} </option>
        </select>
    </td>
</tr>

</table>

    <input type="submit" value="Save"/>   

</form>

<form action="" method="get">
    <input type="submit" value="Reset"/>      
</form>

<form action="/ProjectDatabase" method="get">
    <input type="submit" value="Back"/>      
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><p>error</p>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session("success") }}');
            window.location.href = '/ProjectDatabase'; 
        };
    </script>
@endif


</div>

</x-app-layout>

<script src="{{ asset('multi-select-tag.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new MultiSelectTag('achievement'); // id = 'achievement'
        new MultiSelectTag('fundingSource'); // id = 'fundingSource'
    });
</script>

<script>
    // Function to fetch and update Sub CRC options based on selected CRC
    function updateSubCRCOptions() 
    {
        const selectedCRCId = document.querySelector('select[name="crc"]').value;
        const subCRCSelect = document.getElementById('subcrc-select');

        // Store the initially selected value
        const initiallySelectedValue = subCRCSelect.value;
        const [initiallySelectedId, initiallySelectedName] = initiallySelectedValue.split('. ');

        // Make an AJAX request to the server to fetch Sub CRC options
        fetch(`/getSubCRCOptions?crc_id=${selectedCRCId}`)
            .then((response) => response.json())
            .then((data) => {

                // Clear existing options
                subCRCSelect.innerHTML = '';

                // Add new options based on the data received from the server
                data.forEach((subCRC) => 
                {                    
                    const option = document.createElement('option');
                    option.value = `${subCRC.sub_crc_id}. ${subCRC.sub_crc_name}`;
                    option.textContent = `${subCRC.sub_crc_id}. ${subCRC.sub_crc_name}`;
                    subCRCSelect.appendChild(option);
                });

                // If the initially selected value is still available, set it as the selected option
                if (subCRCSelect.querySelector(`option[value="${initiallySelectedValue}"]`)) {
                    subCRCSelect.value = initiallySelectedValue;
                }

            })
            .catch((error) => {
                console.error('Error fetching Sub CRC options:', error);
            });
    }

    // Attach the event listener to the "CRC" dropdown
    document.querySelector('select[name="crc"]').addEventListener('change', updateSubCRCOptions);

    // Execute the function to initialize the Sub CRC options based on the initially selected CRC
    updateSubCRCOptions();
</script>


<script>
    function validateForm() {
        const projectNameEn = document.getElementsByName('projectNameEn')[0].value;
        const projectType = document.getElementsByName('projectType')[0].value;
        const startDate = document.getElementsByName('startDate')[0].value;
        const endDate = document.getElementsByName('endDate')[0].value;
        const totalCost = document.getElementsByName('totalCost')[0].value;
        const status = document.getElementsByName('status')[0].value;
        const crc = document.getElementsByName('crc')[0].value;
        const subcrc = document.getElementsByName('subcrc')[0].value;
        const achievements = document.getElementsByName('achievement[]');
        const fundingSources = document.getElementsByName('fundingSource[]');

        if (
            projectNameEn === '' ||
            projectType === '' ||
            startDate === '' ||
            endDate === '' ||
            totalCost === '' ||
            status === '' ||
            crc === '' ||
            subcrc === '' ||
            achievements.length === 0 ||
            fundingSources.length === 0
        ) {
            alert('Fill All the Required Fields');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>


</body>
</html>
