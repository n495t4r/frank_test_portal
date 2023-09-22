<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ config('app.name','PEVA Test Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- {{ __("User: ") }} -->

                    @if (isset($assessmentDone))
                        Hi {{Auth::user()->name}}, you scored <strong>{{Auth::user()->score}}%</strong> in your last assessement!
                        <p>Contact an admin to do another test!!</p>
                        
                    @else
                        <script>
                                const assessment = @json($assessment);
                                const questionBank = @json($questions);
                        </script>

                        <div class="card text-center mx-auto mt-5" id="instructions" style="max-width: 600px;">
                            <div class="card-header">
                                <h1 class="card-title">Test Information</h1>
                            </div>
                            <div class="card-body">
                                <h4 class="card-subtitle mb-4 text-left">Title: {{$assessment[0]['title']}}</h4>
                                <p class="card-text">
                                    <span id="total-questions">{{ count($questions) }}</span> questions | 
                                    <span id="duration">{{$assessment[0]['duration']}}</span> minutes | 
                                    65% score required to pass
                                </p>
                                <hr>
                                <h5 class="card-subtitle mb-4 text-left">Instructions:</h5>
                                <ul class="text-left">
                                    <li>Read each questions carefully</li>
                                    <li>Select the best answer</li>
                                    <li>You can go back to previous questions</li>
                                    <li>Do not reload the test page!</li>
                                    <li>Click "Submit" to finish the test</li>
                                    <li>Once started you cannot pause the timer or restart the test!</li>
                                </ul>
                                <br>
                                <h5>Good luck!!!</h5>
                            </div>
                            <div class="card-footer text-muted">

                            <form id="startTestForm" action="/start-test" method="POST">
                                @csrf
                                <button type="submit" id="start-btn" class="btn btn-primary">
                                    <i class="fas fa-play"></i> Start Test
                                </button>
                            </form>

                            <!-- <button id="start-btn" class="btn btn-primary"><i class="fas fa-play"></i> Start Test</button> -->

                            </div>
                        </div>
                        

                        <div class="question-container" id="question-container" style="display:none">
                            <div class="qheader-content" id="qheader-content">    
                                <div class="question-number" id="question-number">Question 1</div>
                                <div class="timer">
                                    <i class="far fa-clock"></i>
                                    <span id="timer"></span>
                                </div>
                            </div>
                            
                            <h1 id="question-content"></h1>
                            <form id="options-form">
                                <div id="options-container"></div>
                            </form>
                            <div class="buttons">
                                <button id="prev-btn" style="display:none">Previous</button>
                                <button id="next-btn" style="display:none">Next</button>
                                <button id="submit-btn" style="display:none">Submit</button>
                            </div>
                            <div id="score-container" style="display:none">
                                <spans id="time-up"></span>    
                                <h6>Hi {{ Auth::user()->name }} ({{ Auth::user()->email }}),<h6/>
                                <h1>You scored:<span id="pecentage"></span></h1>
                                <span id="score"></span>
                                <h5>Thank you!!!</h5>
                            </div>
                        </div>

                        <script src="{{ asset('js/portal/test.js') }}"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                    
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
