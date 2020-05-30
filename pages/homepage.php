<?php
// use statements
use L41rx\Layer\Factory;
use L41rx\Layer\FrontendComponents\LainQuiz;

// page logic
$lain_quiz = new LainQuiz([]);

?>
<html lang="en">
<!-- html :) -->
<head>
    <h1>Lain survey</h1>
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
<!-- site -->
<?php echo $lain_quiz->render(); ?>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    var questions = document.getElementsByClassName("question");

    for (var i = 0; i < questions.length; i ++) {
        // are there unlocks associated?

        var is_unlocks = typeof questions[i].dataset.unlocks !== 'undefined';

        if (is_unlocks) { // register listeners on any inputs in the question, to check against the question in.. question (lol)
            var changeables = questions[i].querySelectorAll("input,select");

            for (var j = 0; j < changeables.length; j++) {
                changeables[j].addEventListener('change', showOrHideUnlocks);
            }
        }
    }
});

function showQuestion(unlockElement) {
    var question = document.getElementById('div-'+unlockElement);
    question.classList.remove("irrelevant");
    question.classList.add("relevant");
}

function hideQuestion(unlockElement) {
    var question = document.getElementById('div-'+unlockElement);
    question.classList.remove("relevant");
    question.classList.add("irrelevant");
}

function showOrHideUnlocks(event) {
    var input = event.currentTarget;
    var value = input.value;
    var container = input.closest('.question');
    var unlocks = JSON.parse(container.dataset.unlocks);

    // if we should show
    if (typeof unlocks[value] !== 'undefined')
        for (var i = 0; i < unlocks[value].length; i++)
            showQuestion(unlocks[value][i]);

    // hide the other ones...
    Object.keys(unlocks).forEach(function(option, index) {
        if (option !== value)
            for (i = 0; i < unlocks[option].length; i++)
                hideQuestion(unlocks[option][i]);

    });
}

</script>
</body>
</html>

