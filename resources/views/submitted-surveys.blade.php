@extends('layouts.app')

@section('content')

<div class="flex flex-col justify-center items-center gap-20">
    <div class="w-full flex flex-row justify-end items-center gap-56">
        <h1 class="text-4xl font-bold mr-56">Submitted Surveys</h1>
        <a href="{{ route('welcome') }}" class="mr-10 border-2 border-white px-3 py-1 rounded-md">
            Go Back
        </a>
    </div>



    @if (count($submittedSurveys) > 0)
  

    <div class="w-full min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 backdrop:blur-2xl text-[#d2d0dd] flex flex-col justify-center items-center p-3 sm:p-4 md:p-6 lg:p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-3 sm:gap-4 lg:gap-6 2xl:gap-8 mb-20">

          
            @foreach ($submittedSurveys as $submittedSurvey)
           
            <div class="relative appearance-none overflow-hidden outline-none p-[1.5px] m-0 rounded-3xl bg-violet-950 text-slate-100 hover:text-white shadow-[0_0_2px_0_rgb(0_0_0/0.05)] shadow-violet-900 before:absolute before:w-full before:h-[200%] before:inset before:-top-[50%] before:rounded-[inherit] before:overflow-hidden before:bg-[conic-gradient(var(--tw-gradient-stops))] before:from-violet-950 before:from-70% before:to-violet-100 before:blur-xl before:animate-[spin_linear_4.5s_infinite] [&>div]:relative [&>div]:z-[1] [&>div]:rounded-[inherit] [&>div]:overflow-hidden [&>div]:bg-[rgb(4,1,17)] hover:[&>div]:bg-[rgb(4,1,10)] [&>div]:transition-colors [&>div]:duration-300 [&>div]:backdrop-blur-3xl">
                <div class="w-full flex flex-col">
                    
                    <div class="w-full max-w-[24rem] flex flex-col p-4">
                        <div class="py-4">
                            <h2 class="text-xl font-bold text-center">{{ $submittedSurvey['survey_name'] }}</h2>

                            @if (isset($submittedSurvey['questions']) && is_array($submittedSurvey['questions']))
                            <ul class="space-y-2 mt-2">
                                @foreach ($submittedSurvey['questions'] as $index => $question)
                                <li class="flex flex-col gap-10 bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">
                                    <strong>Question {{ $index + 1 }}: {{ $question['text'] }}</strong>
                                    <p>
                                        <strong>User's Response:</strong>
                                        {{ $submittedSurvey['responses']['answers'][$index] ?? 'No response' }}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p>No questions available for this survey.</p>
                            @endif
                        </div>
                    </div>
                 
                </div>
            </div>
         
            @endforeach

        </div>
    </div>

    @else
    <p>No surveys have been submitted yet.</p>
    @endif

</div>



@endsection