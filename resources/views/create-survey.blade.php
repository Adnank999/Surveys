@extends('layouts.app')

@section('content')

<div class="flex flex-row justify-center items-baseline pl-40 gap-10">
    <div class="flex flex-col justify-center items-center gap-2 mt-6">



        <h1 class="text-3xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 ">Create a New Survey</h1>




        <form action="{{ route('poll.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="mb-4">
                <label for="survey_name" class="block text-lg font-medium bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 ">Survey Name:</label>
                <input type="text" name="survey_name" id="survey_name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-700 focus:border-red-600" required>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 ">Questions:</h3>
                <div id="questions" class="space-y-4">
                    <div class="question ">
                        <input type="text" name="questions[0][text]" placeholder="Enter question text" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-700 focus:border-red-600" required>

                        <h4 class="text-lg font-semibold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500  mt-4">Answers:</h4>

                        <div class="flex flex-col justify-center items-center gap-2">
                            <div class="answers space-y-2">
                                <input type="text" name="questions[0][answers][]" placeholder="Answer 1" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-700 focus:border-red-600" required>
                                <input type="text" name="questions[0][answers][]" placeholder="Answer 2" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-700 focus:border-red-600" required>
                            </div>

                            <button type="button" class="add-answer mt-3 text-white hover:bg-clip-text hover:text-transparent hover:bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 border-2 border-white px-3 py-1 rounded-md">+ Add Answer</button>
                        </div>

                    </div>
                </div>
            </div>



            <div class="mt-6 flex flex-col justify-center items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-12 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Create Survey
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-row justify-center items-center gap-4">
        <button type="button" id="add-question" class="bg-red-600 px-3 py-1 rounded-md text-white hover:text-black">+ Add Another Question</button>
        <a href="{{ route('welcome') }}" class="mr-10 border-2 border-white px-3 py-1 rounded-md">
            Go Back
        </a>
    </div>


</div>



<script>
    document.getElementById('add-question').addEventListener('click', function() {
        const questionCount = document.querySelectorAll('.question').length;
        const questionDiv = document.createElement('div');
        questionDiv.classList.add('question');
        questionDiv.innerHTML = `
        <input type="text" name="questions[${questionCount}][text]" placeholder="Enter question text" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-600 focus:border-red-600" required>
        <h4 class="text-lg font-semibold text-white mt-4">Answers:</h4>
        <div class="answers space-y-2">
            <input type="text" name="questions[${questionCount}][answers][]" placeholder="Answer 1" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-blue-500 focus:border-red-600" required>
            <input type="text" name="questions[${questionCount}][answers][]" placeholder="Answer 2" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-600 focus:border-red-600" required>
        </div>
        <button type="button" class="add-answer mt-3 text-blue-500 hover:text-blue-700">+ Add Answer</button>
    `;
        document.getElementById('questions').appendChild(questionDiv);
    });

    // Add functionality to dynamically add answers
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('add-answer')) {
            const answersSection = event.target.previousElementSibling;
            const questionIndex = answersSection.querySelector('input').name.match(/\d+/)[0]; // Get the question index from name
            const answerCount = answersSection.querySelectorAll('input').length;
            const answerDiv = document.createElement('div');
            answerDiv.innerHTML = `<input type="text" name="questions[${questionIndex}][answers][]" placeholder="Answer ${answerCount + 1}" class="w-full px-3 py-2 bg-white border border-gray-500 rounded-md text-black focus:outline-none focus:ring focus:ring-red-600 focus:border-red-600" required>`;
            answersSection.appendChild(answerDiv);
        }
    });
</script>
@endsection