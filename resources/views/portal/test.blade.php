<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Test</title>
    <link rel="stylesheet" href="{{ asset('css/portal/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar w/ text</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <span class="navbar-text">
                Navbar text with an inline element
            </span>
            </div>
        </div>
    </nav>
    <div class="card text-center mx-auto mt-5" id="instructions" style="max-width: 600px;">
        <div class="card-header">
            <h1 class="card-title">Test Information</h1>
        </div>
        <div class="card-body">
            <p class="card-text">
                <span id="total-questions">30</span> questions | 
                <span id="duration">30</span> minutes | 
                65% score required to pass
            </p>
            <hr>
            <h6 class="card-subtitle mb-4 text-muted">Instructions:</h6>
            <ul class="text-left">
                <li>Read each question carefully</li>
                <li>Select the best answer</li>
                <li>You can go back to previous questions</li>
                <li>Click "Submit" to finish the test</li>
            </ul>
        </div>
        <div class="card-footer text-muted">
            <button id="start-btn" class="btn btn-primary">Start Test</button>
        </div>
    </div>
    

    <div class="question-container" id="question-container" style="display:none">
        <div class="qheader-content">    
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
            <h1>Your Score:</h1>
            <span id="score"></span>
        </div>
    </div>

    <script src="{{ asset('js/portal/test.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
