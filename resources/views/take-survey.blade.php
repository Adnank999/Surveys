@extends('layouts.app')

@section('content')

<div class="flex flex-col justify-center items-center mt-10 gap-6 border-2 border-red-600 rounded-lg px-10 p-5 shadow-[0_10px_20px_rgba(240,_46,_170,_0.7)]">
    <h1 class="text-2xl font-bold">{{ $survey['name'] }}</h1>

    <form action="{{ route('poll.submit', $filename) }}" method="POST" class="flex flex-col justify-center items-center gap-6">
        @csrf
        @foreach ($survey['questions'] as $index => $question)
        <div>
         
            <label class="text-xl font-bold">{{ $question['text'] }}</label>

            @if (isset($question['answers']) && is_array($question['answers']))
            <div class="flex flex-col justify-center items-start text-center gap-8  p-4">
                @foreach ($question['answers'] as $answerIndex => $answer)
                <div class="flex flex-row justify-center items-center gap-6">
                  
                    <input type="radio" name="answers[{{ $index }}]" value="{{ $answer }}" class="h-6 w-6 checked:bg-red-600 text-red-600 px-3 " required>
                    <label>{{ $answer }}</label>
                </div>
                @endforeach
            </div>
            @else
          
            <input type="text" name="answers[{{ $index }}]" required>
            @endif
        </div>
        @endforeach

        <div class="relative group cursor-pointer">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-red-600 to-violet-600 rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
            </div>
            <div
                class="relative px-5 py-3 bg-black ring-1 ring-gray-900/5 rounded-lg leading-none flex items-top justify-start space-x-6">
                <div class="space-y-2">
                    <button type="submit">Submit Survey</button>
                </div>
            </div>
        </div>


    </form>
</div>

@endsection