<?php
namespace L41rx\Layer\FrontendComponents;
use L41rx\Layer\Abstracts\FrontendComponent;
use L41rx\Layer\Questions;


class LainQuiz extends FrontendComponent
{
    public function render() {
        $questions_html = "";
        foreach (Questions::ITEMS as $question) {
            if ($question['id'] === 'br') { $questions_html .= "\n<hr>\n"; continue; }

            // inject unlocks?
            if (isset($question['unlocks']))
                $unlock_inject = 'data-unlocks="'.htmlentities(json_encode($question['unlocks']), ENT_QUOTES, 'UTF-8').'"';
            else
                $unlock_inject = "";

            // inject required if it is a required question
            $required_inject = ['data' => '', 'class' => '', 'attr' => ''];
            if (isset($question['required']) && $question['required']) {
                $required_inject['data'] = 'data-required="true"';  // persist (since if a question is irrelevant, we dont want it to be required
                $required_inject['class'] = "required";             // to style it as one
                if (isset($question['show_on_start']))
                    $required_inject['attr'] = 'required="true"';          // if its show_on_start it means by default the question is relevant, so actually start required fo real
            }

            if (isset($question['show_on_start']) && $question['show_on_start'])
                $questions_html .= "<div class='question relevant {$required_inject['class']}' {$unlock_inject} {$required_inject['data']} id='div-{$question['id']}'>\n" . $this->renderQuestionAsInput($question, $required_inject) . "</div>\n";
            else
                $questions_html .= "<div class='question irrelevant {$required_inject['class']}' {$unlock_inject} {$required_inject['data']} id='div-{$question['id']}'>\n" . $this->renderQuestionAsInput($question, $required_inject) . "</div>\n";
        }

        $html = <<<HTML
        <form action="/submit" method="post" id="lain-quiz-form" class="lain-quiz-form">            
            {$questions_html}
            <input type="submit" value="all done" />
        </form>
        HTML;

        return $html;
    }

    private function renderQuestionAsInput($question, $required_inject)
    {
        $method_name = "renderQuestionAs".ucfirst($question['type'])."Input";
        return "<label class='question-text' for='{$question['id']}'>{$question['q']}</label>\n".$this->$method_name($question, $required_inject);
    }

    private function renderQuestionAsTextInput($question, $required_inject)
    {
        return "<input class=\"{$required_inject['class']}\" {$required_inject['data']} id='{$question['id']}' name='{$question['id']}' type='${question['type']}' {$required_inject['attr']} />";
    }

    private function renderQuestionAsRadioInput($question, $required_inject)
    {
        $html = "";
        foreach ($question['options'] as $option) {
            $html .= "<input class=\"{$required_inject['class']}\" {$required_inject['data']} type='radio' id='{$question['id']}-{$option}' name='{$question['id']}' value='{$option}' {$required_inject['attr']} />";
            $html .= "<label for='{$question['id']}-{$option}'>{$option}</label>\n";
        }
        return $html;
    }

    private function renderQuestionAsCheckboxInput($question, $required_inject)
    {
        $html = "";
        foreach ($question['options'] as $option) {
            $html .= "<input class=\"{$required_inject['class']}\" {$required_inject['data']} type='checkbox' id='{$question['id']}-{$option}' name='{$question['id']}' value='{$option}' {$required_inject['attr']} />";
            $html .= "<label for='{$question['id']}-{$option}'>{$option}</label>\n";
        }
        return $html;
    }

    private function renderQuestionAsSelectInput($question, $required_inject)
    {
        $html = "";
        $html .= "<select class=\"{$required_inject['class']}\" {$required_inject['data']}  id='{$question['id']}' name='{$question['id']}' {$required_inject['attr']}>";
        foreach ($question['options'] as $option)
            $html .= "<option>{$option}</option>";
        $html .= "</select>";
        return $html;
    }

    private function renderQuestionAsScaleInput($question, $required_inject)
    {
        $html = "";
        $middle = ceil(($question['min'] + $question['max']) / 2);
        $html .= "<input class=\"{$required_inject['class']}\" {$required_inject['data']} type='range' min='{$question['min']}' max='{$question['max']}' value='{$middle}' {$required_inject['attr']} />";
        return $html;
    }
}