document.addEventListener('DOMContentLoaded', function() {
        
    // const duration = 0.1 * 60; // 30 minutes in seconds
    const duration = assessment[0].duration *60;
    let timer = duration;
    let timerInterval;

    function startTimer() {
        timerInterval = setInterval(function() {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;
            const formattedTime = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            // Display the timer on the UI
            document.getElementById('timer').textContent = formattedTime;

            if (timer === 0) {
                clearInterval(timerInterval);
                submit('Time is up!!!');
            } else {
                timer--;
            }
        }, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
    }
     
        const questionBanks = 
    [ 
        {
            section: 'A',
            category: 'Math',
            content: 'What is the result of 2 + 2?',
            type: 'multiple_choice',
            answeroptions: ['3', '4', '5', '6'],
            answer: '4'
        },
        {
            section: 'B',
            category: 'Science',
            content: 'The Earth orbits around the Sun, true or false?',
            type: 'true_false',
            answeroptions: ['True', 'False'],
            answer: 'True'
        },
        {
            section: 'C',
            category: 'English',
            content: 'What is the synonym of "happy"?',
            type: 'multiple_choice',
            answeroptions: ['Joyful', 'Sad', 'Angry', 'Confused'],
            answer: 'Joyful'
        },
        {
            section: 'D',
            category: 'Geography',
            content: 'Which continent is known as the "Dark Continent"?',
            type: 'multiple_choice',
            answeroptions: ['Africa', 'Asia', 'Europe', 'North America'],
            answer: 'Africa'
        },
        {
            section: 'A',
            category: 'Math',
            content: 'What is 15 multiplied by 3?',
            type: 'multiple_choice',
            answeroptions: ['30', '45', '50', '55'],
            answer: '45'
        }

    ];

    let currentQuestionIndex = 0;
    let score = 0;
    let num = 1;
    const selectedAnswers = new Map();

    const questionContainer = document.getElementById('question-container');
    const questionContent = document.getElementById('question-content');
    const optionsContainer = document.getElementById('options-container');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    const qheaderContent = document.getElementById('qheader-content');
    const scoreContainer = document.getElementById('score-container');
    const percentageElement = document.getElementById('pecentage');
    const scoreElement = document.getElementById('score');
    const qnumElement = document.getElementById('question-number');
    const instructions = document.getElementById('instructions');
    
    function loadQuestion(index, qNum=num) {
        questionContainer.style.display = 'block';
        qnumElement.textContent = 'Question: ' + qNum + '/' + questionBank.length;
        const question = questionBank[index];
    
        const content = question.content;
        const answeroptions = question.answeroptions.split(',').map(option => option.trim());
    
        questionContent.textContent = content;
    
        optionsContainer.innerHTML = '';
        answeroptions.forEach((answer, idx) => {
            const option = document.createElement('div');
            option.classList.add('option');
    
            const radioInput = document.createElement('input');
            radioInput.type = 'radio';
            radioInput.name = 'answer';
            radioInput.value = answer;
    
            if (selectedAnswers.has(index) && selectedAnswers.get(index) === answer) {
                radioInput.checked = true;
            }
    
            const label = document.createElement('label');
            label.textContent = `${String.fromCharCode(65 + idx)}. ${answer}`;
    
            option.appendChild(radioInput);
            option.appendChild(label);
    
            optionsContainer.appendChild(option);
    
            option.addEventListener('click', function () {
                radioInput.checked = true;
                selectedAnswers.set(index, radioInput.value);
            });
    
            radioInput.addEventListener('change', function () {
                selectedAnswers.set(index, this.value);
            });
        });
    
        showPrevNextButton();
    }
    

    function nextQuestion() {
        currentQuestionIndex++;
        num = currentQuestionIndex+1;
        if (currentQuestionIndex < questionBank.length) {
            loadQuestion(currentQuestionIndex, num);
        } else {
            toggleSubmitButton(); // Show submit button after last question
        }
    }

    function prevQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            num = currentQuestionIndex+1;
            loadQuestion(currentQuestionIndex, num);
            toggleSubmitButton();
        }
    }
    
    function showPrevNextButton() {
        var prevBtn = document.getElementById('prev-btn');
        var nextBtn = document.getElementById('next-btn');
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'block';
    }

    function showSubmitButton_v1() {
        const submitBtn = document.createElement('button');
        submitBtn.id = 'submit-btn';
        submitBtn.textContent = 'Submit';
        submitBtn.addEventListener('click', submit);
    
        const questionContainer = document.querySelector('.question-container');
        questionContainer.appendChild(submitBtn);
    }

    function toggleSubmitButton() {
        if (currentQuestionIndex < questionBank.length) {
            nextBtn.textContent = 'Next Question';
            nextBtn.addEventListener('click', nextQuestion);
        } else {
            // Show submit button after last question
            const submitBtn = document.getElementById('next-btn');
            submitBtn.textContent = 'Submit';
            submitBtn.addEventListener('click', submit());
        }
    }
   
    function submit(msg ='') {
        stopTimer();
        score = 0; // Reset score before recalculating
        questionBank.forEach((question, index) => {
            const selectedAnswer = selectedAnswers.get(index);
    
            if (question.type === 'true_false') {
                // For true/false questions, the answer is already a string
                if (selectedAnswer && selectedAnswer.trim().toLowerCase() === question.answer.trim().toLowerCase()) {
                    score++;
                }
            } else {
                // For multiple choice questions, convert answeroptions to an array
                const answerOptions = question.answeroptions.split(',').map(option => option.trim());
    
                if (selectedAnswer && selectedAnswer.trim() === question.answer.trim()) {
                    score++;
                }
            }
        });
    
        showScore(msg);
    }
    

    function showScore(msg) {
        questionContent.style.display = 'none';
        optionsContainer.style.display = 'none';
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'none';
        qheaderContent.style.display = 'none';
        scoreContainer.style.display = 'block';
        
        percentageElement.textContent = ' '+percentScore() + '%';  
        scoreElement.innerHTML = `${msg} <br>You got <strong>${score}</strong> correct answer(s) out of <strong>${questionBank.length}</strong> questions`;
    }
    
    function percentScore(){
        const percentageCorrect = Math.round((score / questionBank.length) * 100);
        updateScore(percentageCorrect);
        return percentageCorrect;
    }

    prevBtn.addEventListener('click', prevQuestion);
    nextBtn.addEventListener('click', nextQuestion);
    submitBtn.addEventListener('click', submit);

    function startTest() {
        justBeforeLoadQuestion();
        loadQuestion(currentQuestionIndex);
    }

    function justBeforeLoadQuestion(){
        instructions.style.display = 'none';
        //Register this event such that the user cannot redo the test or reload the page
    }

    document.getElementById('start-btn').addEventListener('click', function() {
        startTimer();
        this.style.display = 'none'; // Hide the start button after clicking
        startTest();
    });

    // Display the timer in the UI
    const timerElement = document.createElement('div');
    timerElement.id = 'timer';
    document.querySelector('.question-container').appendChild(timerElement);

    function updateScore(score) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
        fetch('/update-score', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ score: score }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch(error => {
            console.error('Error updating score:', error);
        });
    }
    
});


document.getElementById('startTestForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/start-test', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({}),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Status updated successfully');
    })
    .catch(error => {
        console.error('Error updating status:', error);
    });
});