<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Online Test</title>
</head>
<body>
<button id="start-btn">Start Test</button>

    <div class="question-container">
        <h1 id="question-content"></h1>
        <form id="options-form">
            <div id="options-container"></div>
        </form>
            <button id="prev-btn" style="display:none">Previous</button>
            <button id="next-btn" style="display:none">Next</button>
        <button id="submit-btn" style="display:none">Submit</button>
        <div id="timer"></div> <!-- Add this line for the timer -->
    </div>
    <div id="score-container" style="display:none">
        <h1>Your Score:</h1>
        <span id="score"></span>
    </div>
    <script src="js/main.js"></script>
</body>
</html>



