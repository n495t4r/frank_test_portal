document.addEventListener('DOMContentLoaded', function() {
    const duration = 0.5 * 60; // 30 minutes in seconds
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
                submit();
            } else {
                timer--;
            }
        }, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
    }
    
    const questionBank = 
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
    const selectedAnswers = new Map();

    const questionContent = document.getElementById('question-content');
    const optionsContainer = document.getElementById('options-container');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    const scoreContainer = document.getElementById('score-container');
    const scoreElement = document.getElementById('score');

    function loadQuestion(index) {
        const question = questionBank[index];
        questionContent.textContent = question.content;

        optionsContainer.innerHTML = '';
        question.answeroptions.forEach((answer, idx) => {
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

            radioInput.addEventListener('change', function() {
                selectedAnswers.set(index, this.value);
            });
        });
        showPrevNextButton();
    }

    function nextQuestion() {
        currentQuestionIndex++;
        if (currentQuestionIndex < questionBank.length) {
            loadQuestion(currentQuestionIndex);
        } else {
            showSubmitButton(); // Show submit button after last question
        }
    }
    
    function showPrevNextButton() {
        var prevBtn = document.getElementById('prev-btn');
        var nextBtn = document.getElementById('next-btn');
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'block';
    }

    function showSubmitButton() {
        const submitBtn = document.createElement('button');
        submitBtn.id = 'submit-btn';
        submitBtn.textContent = 'Submit';
        submitBtn.addEventListener('click', submit);
    
        const questionContainer = document.querySelector('.question-container');
        questionContainer.appendChild(submitBtn);
    }
    

    function showScore() {
        questionContent.style.display = 'none';
        optionsContainer.style.display = 'none';
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'none';
        scoreContainer.style.display = 'block';
        scoreElement.textContent = score + '/' + questionBank.length;
    }

    function prevQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            loadQuestion(currentQuestionIndex);
        }
    }

    function submit() {
        score = 0; // Reset score before recalculating
    
        questionBank.forEach((question, index) => {
            if (selectedAnswers.has(index) && selectedAnswers.get(index) === question.answer) {
                score++;
            }
        });
    
        showScore();
    }
    

    prevBtn.addEventListener('click', prevQuestion);
    nextBtn.addEventListener('click', nextQuestion);
    submitBtn.addEventListener('click', submit);

    function startTest() {
        loadQuestion(currentQuestionIndex);
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
});
