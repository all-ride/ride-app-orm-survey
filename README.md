# Ride: ORM Survey Model

This module will add models to the Ride ORM to create and manage surveys. 

## Models

### Survey

The ```Survey``` model holds the available surveys.
A survey is a container of questions which belong together.
You can set a name and description for a general introduction.

### SurveyQuestion

The ```SurveyQuestion``` model holds the definitions of the questions.
A question belongs to one survey only.
You can set the question and a description to give an explaination about the question.

A question can hold predefined answers.

You can a flag a question to allow multiple answers.
This is for the frontend to know if a radio button should be used to allow only one answer, or checkboxes to allow multiple answers.

You can flag a question as being open. 
When the open question has no answers, a single text area should be displayed for an open answer.
If the open question has answers, an "other" option should be added with a text area for an open answer.

### SurveyAnswer

The ```QuestionAnswer``` model holds the predefined answers.

Each answer can have a score for evaluating the question.
More on evaluations later on.

An answer can also contain a Likert scale.
See the next topic to see what it is.

### SurveyLikert

The ```SurveyLikert``` model holds the available Likert scales.

A Likert scale is used for a question which should look like this:

|| very bad | bad | average | good | very good |
|---|---|---|---|---|---|
|answer 1||||X||
|answer 2|||||X|
|answer 3|||X|||

In this example, the _very bad_ ... _very good_ is the Likert scale.
The _answer 1_ ... _answer 3_ are the regular answers which hold the Likert scale.

You set a name for the scale and add the available answers.

###  SurveyEvaluation

The ```SurveyEvaluation``` model is used to create evaluations.
An evaluation can evaluate a single question or a complete survey.

You set a number of questions to the evaluation in combination with a set of rules.

When a ```SurveyEntry``` is being evaluated, a total score is calculated for the questions selected in the evaluation.
The result of an evaluation is the total score of these questions, combined with the rule which applies to this score.

The evaluation can calculate an average score for all logged evaluations.

### SurveyEvaluationRule

The ```SurveyEvaluationRule``` model holds the rules of the evaluations.
These rules hold a title and a body, as well as a minimum and maximum score.

The rule is considered an evaluation result when the score of the answers of the evaluation questions is between the minimum and maximum score of the rule.

### SurveyEvaluationLog

The ```SurveyEvaluationLog``` model is a history of evaluations.

Keeping this history is optional but adds the functionality to calculate an average score for an evaluation.
This can be done at any time with the CLI command provided by the [ride/cli-orm-survey](https://github.com/all-ride/ride-cli-orm-survey) module. 
    
### SurveyEntry

The ```SurveyEntry``` models is used to register when somebody fills in a survey.

Out of the box, it holds a name, the survey and the given answers.

This is a simple model which, most of the time, will be extended to add more information about the person who filled in the survey.
Just keep the ```survey``` and ```answers``` fields.
    
### SurveyEntryAnswer

The ```SurveyEntryAnswer``` model holds all registered answers of a survey entry.

This model has 2 relationships with the answer model.

The ```answer``` field holds the selected predefined answer.

When a Likert is used, the ```answer``` field holds the Likert answer while the ```questionAnswer``` field holds the answer of the question which uses the Likert scale. 

So applied on our Likert example from above: the ```answer``` field holds the _very bad_ ... _very good_ answer, while the ```questionAnswer``` holds the _answer 1_ ... _answer 2_.

The answer of an open question is set in the ```description``` field.

## Related Modules 

- [ride/app](https://github.com/all-ride/ride-app)
- [ride/app-orm](https://github.com/all-ride/ride-app-orm)
- [ride/cli-orm-survey](https://github.com/all-ride/ride-cli-orm-survey)
- [ride/lib-orm](https://github.com/all-ride/ride-lib-orm)
- [ride/wba-survey](https://github.com/all-ride/ride-wba-survey)
- [ride/web-orm](https://github.com/all-ride/ride-web-orm)
- [ride/wra-orm](https://github.com/all-ride/ride-wra-orm)
- [ride/wra-orm-survey](https://github.com/all-ride/ride-wra-orm-survey)

## Installation

You can use [Composer](http://getcomposer.org) to install this application.

```
composer require ride/app-orm-survey
```
