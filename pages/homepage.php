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
    <link rel="stylesheet" href="/css/layout.css">
    <title>Lain avi survey</title>
</head>
<body>
<!-- site -->
<h1>Lain survey</h1>
<p>hi i made this survey because <abbr title="to be quite perfectly honesty">tbqph</abbr> I love lain and want to know what similar people also have in common. and what they dont!</p>
<p>how much or how little data you want to put it is up to you. the only required information is at the start and concerns lain (red asterisks)</p>
<p>some of these questions are pretty personal, and you can consider this any information entered in here part of the public domain... so be careful what you enter!</p>
<?php echo $lain_quiz->render(); ?>

<script src="/js/survey.js"></script>
</body>
</html>

