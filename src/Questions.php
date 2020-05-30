<?php
namespace L41rx\Layer;

class Questions
{
    const ITEMS = [
        [
            'id' => 'watch-lain',
            'q' => 'cheers... so have you watched Serial Experiments Lain?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'unlocks' => ['Yes' => ['rate-lain'], 'No' => ['why-quiz']],
            'show_on_start' => 'true',
            'required' => true
        ], [
            'id' => 'why-quiz',
            'q' => 'How did you come around this quiz?',
            'type' => 'text',
            'required' => true,
        ], [
            'id' => 'rate-lain',
            'q' => 'Did you like it? How would you rate it, one to ten?',
            'type' => 'scale',
            'min' => 1,
            'max' => 10,
            'required' => true,
            'unlocks' => [1 => ['why-hate-lain'], 2 => ['why-hate-lain'], 3 => ['why-hate-lain'], 7 => ['discuss-lain'], 8 => ['discuss-lain'], 9 => ['discuss-lain'], 10 => ['discuss-lain']]
        ], [
            'id' => 'discuss-lain',
            'q' => 'What really made it stand out to you?',
            'type' => 'text',
            'required' => true,
        ], [
            'id' => 'why-hate-lain',
            'q' => '... ok... you didnt like it? why?',
            'type' => 'text',
            'required' => true,
        ], ['id' => 'br'], [
            'id' => 'is-lain-avi',
            'q' => 'Do you use a lain avatar on twitter?',
            'type' => 'radio',
            'options' => ['Yes', 'No'],
            'show_on_start' => 'true',
            'required' => true
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
}