@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center gap-10 mt-10">
    <h1 class="text-4xl font-bold font-serif bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">Welcome to the Survey Portal</h1>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    <h2 class="text-2xl font-bold">Take Available Surveys:</h2>
   
    <ol>
        @foreach($surveys as $survey)
        <li class="py-4 border-2 border-white p-6 rounded-md hover:bg-clip-text hover:text-transparent hover:bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 mt-2">
            {{ $loop->iteration }}.
            <a href="{{ route('poll.take', $survey['file']) }}" class="text-xl">
                {{ $survey['name'] }}
            </a>
        </li>
        @endforeach
    </ol>

    <div  class="flex flex-row justify-center items-center gap-4">
        <a href="{{ route('poll.create') }}" class=" text-white hover:bg-white hover:text-black border-2 border-white  p-4 rounded-full">
            Create a New Survey
        </a>

        <a href="{{ route('poll.submitted') }}" class=" text-white hover:bg-white hover:text-black border-2 border-white  p-4 rounded-full">
           Show Submitted Surveys
        </a>
    </div>


</div>
@endsection