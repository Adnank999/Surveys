<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PollingController extends Controller
{

    public function welcome()
    {

        $surveyFiles = Storage::disk('local')->files('surveys');


        $surveys = [];


        foreach ($surveyFiles as $file) {

            $surveyContent = Storage::disk('local')->get($file);


            $survey = json_decode($surveyContent, true);


            if (isset($survey['name'])) {

                $surveys[] = [
                    'name' => $survey['name'],
                    'file' => basename($file, '.json')
                ];
            }
        }


        return view('welcome', compact('surveys'));
    }



    public function create()
    {
        return view('create-survey');
    }




    public function store(Request $request)
    {
      
        $survey = [
            'name' => $request->input('survey_name'),
            'questions' => []
        ];


        foreach ($request->input('questions') as $question) {
            $survey['questions'][] = [
                'text' => $question['text'],
                'answers' => $question['answers']
            ];
        }



       
        $filename = 'surveys/' . strtolower(str_replace(' ', '_', $request->input('survey_name'))) . '.json';
        Storage::disk('local')->put($filename, json_encode($survey, JSON_PRETTY_PRINT));

        return redirect()->route('welcome')->with('success', 'Survey created successfully!');
    }



    public function take($filename)
    {

        if (!str_ends_with($filename, '.json')) {
            $filename .= '.json';
        }

        
        if (!Storage::disk('local')->exists("surveys/{$filename}")) {
            abort(404, 'Survey not found');
        }

        $survey = Storage::disk('local')->get("surveys/{$filename}");
        $survey = json_decode($survey, true);

       
        if ($survey === null) {
            abort(500, 'Invalid JSON format in survey file');
        }

       
        return view('take-survey', compact('survey', 'filename'));
    }


    public function submit(Request $request, $filename)
    {
       
        $survey = json_decode(Storage::disk('local')->get("surveys/{$filename}"), true);

 
        $responses = [
            'survey_name' => $survey['name'],
            'questions' => $survey['questions'], 
            'responses' => $request->except('_token') 
        ];

    
        $responseFilename = 'responses/' . time() . '_' . $filename;

       
        Storage::disk('local')->put($responseFilename, json_encode($responses, JSON_PRETTY_PRINT));

        return redirect()->route('welcome')->with('success', 'Survey submitted successfully!');
    }


    public function submittedSurveys()
    {
      
        $files = Storage::disk('local')->files('responses');

        $submittedSurveys = [];

        foreach ($files as $file) {
            $content = Storage::disk('local')->get($file);
            $submittedSurveys[] = json_decode($content, true);
        }

        // dd($submittedSurveys);
        return view('submitted-surveys', compact('submittedSurveys'));
    }
}
