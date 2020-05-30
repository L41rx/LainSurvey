document.addEventListener("DOMContentLoaded", function(event) {
    var questions = document.getElementsByClassName("question");

    for (var i = 0; i < questions.length; i ++) {
        if (questions[i].classList.contains("relevant"))
            questions[i].style.maxHeight = questions[i].scrollHeight+"px";
        else
            questions[i].style.maxHeight = "0";

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
    console.log("showing "+unlockElement);
    var question = document.getElementById('div-'+unlockElement);
    question.classList.remove("irrelevant");
    question.classList.add("relevant");
    question.style.maxHeight = question.scrollHeight+"px";
}

function hideQuestion(unlockElement) {
    console.log("hiding "+unlockElement);
    var question = document.getElementById('div-'+unlockElement);
    question.classList.remove("relevant");
    question.classList.add("irrelevant");
    question.style.maxHeight = "0";
}

function showOrHideUnlocks(event) {
    var input = event.currentTarget;
    var value = input.value;
    var container = input.closest('.question');
    var unlocks = JSON.parse(container.dataset.unlocks);

    // hide the other ones...
    Object.keys(unlocks).forEach(function(option, index) {
        if (option !== value)
            for (i = 0; i < unlocks[option].length; i++)
                hideQuestion(unlocks[option][i]);

    });

    // if we should show
    if (typeof unlocks[value] !== 'undefined')
        for (var i = 0; i < unlocks[value].length; i++)
            showQuestion(unlocks[value][i]);
}