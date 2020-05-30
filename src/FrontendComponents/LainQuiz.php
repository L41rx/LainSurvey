<?php
namespace L41rx\Layer\FrontendComponents;
use L41rx\Layer\Abstracts\FrontendComponent;


class LainQuiz extends FrontendComponent
{
    const QUESTIONS = [
        [
            'id' => 'watch-lain',
            'q' => 'Have you watched Serial Experiments Lain?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['rate-lain']],
            'show_on_start' => 'true'
        ], [
            'id' => 'rate-lain',
            'q' => 'Did you like it? How would you rate it, one to ten?',
            'type' => 'scale',
            'min' => 1,
            'max' => 10
        ], ['id' => 'br'], [
            'id' => 'watch-habenai',
            'q' => 'Have you watched Habenai Remnai?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['rate-habenai']],
            'show_on_start' => 'true'
        ], [
            'id' => 'rate-habenai',
            'q' => 'Did you like it? How would you rate it, one to ten?',
            'type' => 'scale',
            'min' => 1,
            'max' => 10
        ], ['id' => 'br'], [
            'id' => 'have-job',
            'q' => 'Are you employed?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['what-job']],
            'show_on_start' => 'true'
        ], [
            'id' => 'what-job',
            'q' => 'What do you do for work?',
            'type' => 'text'
        ], ['id' => 'br'], [
            'id' => 'do-code',
            'q' => 'Do you write software?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['what-languages', 'other-languages']],
            'show_on_start' => 'true'
        ], [
            'id' => 'what-languages',
            'q' => 'Which languages do you usually prefer to work in?',
            'type' => 'checkbox',
            'options' => ['Python','Bash','JavaScript','PHP','Perl','C','C++','C#','Java','SQL','HTML/CSS','Lisp']
        ], [
            'id' => 'other-languages',
            'q' => 'Anything not listed?',
            'type' => 'text'
        ], ['id' => 'br'], [
            'id' => 'do-visual-art',
            'q' => 'Do you create visual art?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['what-visual-art']],
            'show_on_start' => 'true'
        ], [
            'id' => 'what-visual-art',
            'q' => 'What kind of visual art do you make? Do you stick to common mediums, themes, subjects? Is there a link to your art?',
            'type' => 'text'
        ], ['id' => 'br'], [
            'id' => 'do-music',
            'q' => 'Do you create music?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['what-music']],
            'show_on_start' => 'true'
        ], [
            'id' => 'what-music',
            'q' => 'What kind of music do you make? Do you stick to common mediums, themes, subjects? Is there a link to your work?',
            'type' => 'text'
        ], ['id' => 'br'], [
            'id' => 'is-faithful',
            'q' => 'Do you consider yourself religious or spiritual?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['is-christian']],
            'show_on_start' => 'true'
        ], [
            'id' => 'is-christian',
            'q' => 'Do you believe in a Christian God?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['what-denomination']]
        ], [
            'id' => 'what-denomination',
            'q' => 'What denomination do you belong to?',
            'type' => 'select',
            'options' => ['Catholic', 'Protestant', 'Baptist', 'Evangelical', 'Presbyterian', 'Methodist', 'Something else'],
            'unlocks' => ['Something else' => ['other-christian']]
        ], [
            'id' => 'other-christian',
            'q' => 'What is it?',
            'type' => 'text'
        ]
    ];

    public function render() {
        $rows = "";
        $timestamp = strtotime("now");

        $questions_html = "";
        foreach (self::QUESTIONS as $question) {
            if ($question['id'] === 'br') { $questions_html .= "\n<hr>\n"; continue; }

            // inject unlocks?
            if (isset($question['unlocks']))
                $unlock_inject = 'data-unlocks="'.htmlentities(json_encode($question['unlocks']), ENT_QUOTES, 'UTF-8').'"';
            else
                $unlock_inject = "";

            if (isset($question['show_on_start']) && $question['show_on_start'])
                $questions_html .= "<div class='question relevant' {$unlock_inject} id='div-{$question['id']}'>\n" . $this->renderQuestionAsInput($question) . "</div>\n";
            else
                $questions_html .= "<div class='question irrelevant' {$unlock_inject} id='div-{$question['id']}'>\n" . $this->renderQuestionAsInput($question) . "</div>\n";
        }

        $html = <<<HTML
        <form action="/submit" method="post" id="lain-quiz-form" class="lain-quiz-form">            
            {$questions_html}
            <input type="submit" value="all done" />
        </form>
        HTML;

        return $html;
    }

    private function renderQuestionAsInput($question)
    {
        $method_name = "renderQuestionAs".ucfirst($question['type'])."Input";
        return "<label class='question-text' for='{$question['id']}'>{$question['q']}</label>\n".$this->$method_name($question);
    }

    private function renderQuestionAsTextInput($question)
    {
        return "<input id='{$question['id']}' name='{$question['id']}' type='${question['type']}' />";
    }

    private function renderQuestionAsRadioInput($question)
    {
        $html = "";
        foreach ($question['options'] as $option) {
            $html .= "<input type='radio' id='{$question['id']}-{$option}' name='{$question['id']}' value='{$option}' />";
            $html .= "<label for='{$question['id']}-{$option}'>{$option}</label>\n";
        }
        return $html;
    }

    private function renderQuestionAsCheckboxInput($question)
    {
        $html = "";
        foreach ($question['options'] as $option) {
            $html .= "<input type='checkbox' id='{$question['id']}-{$option}' name='{$question['id']}' value='{$option}' />";
            $html .= "<label for='{$question['id']}-{$option}'>{$option}</label>\n";
        }
        return $html;
    }

    private function renderQuestionAsSelectInput($question)
    {
        $html = "";
        $html .= "<select id='{$question['id']}' name='{$question['id']}'>";
        foreach ($question['options'] as $option)
            $html .= "<option>{$option}</option>";
        $html .= "</select>";
        return $html;
    }

    private function renderQuestionAsScaleInput($question)
    {
        $html = "";
        $middle = ceil(($question['min'] + $question['max']) / 2);
        $html .= "<input type='range' min='{$question['min']}' max='{$question['max']}' value='{$middle}'>";
        return $html;
    }
}