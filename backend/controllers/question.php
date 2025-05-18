<?php
require_once '../models/listquestion.php';
require_once '../helpers/serializer.php';

class QuestionController{
    private $listDataModel;
    private $serializer;

    public function __construct() {
        $this->listDataModel = new ListData();
        $this->serializer = new Serializer();
    }


    public function getAllQuestionsWithAnswers() {
        try {
            // Fetch all questions with answers
            $questions = $this->listDataModel->FetchAllQuestionsWithAnswers();

            // Check if no data is found
            if (empty($questions)) {
                $this->serializer->sendResponse(404, ['message' => 'No questions found.']);
                return;
            }

            // Group answers by question
            $groupedQuestions = [];
            foreach ($questions as $row) {
                $questionId = $row['question_id'];
                $questionText = $row['question_text'];
                $department = htmlspecialchars($row['name']);
                $answers = htmlspecialchars($row['answers']);

                if (!isset($groupedQuestions[$questionId])) {
                    $groupedQuestions[$questionId] = [
                        'question_text' => $questionText,
                        'answers' => []
                    ];
                }

                $groupedQuestions[$questionId]['answers'][] = [
                    'department_name' => $department,
                    'answer' => $answers
                ];
            }

            // Convert grouped questions to a JSON-friendly format
            $response = [];
            foreach ($groupedQuestions as $questionId => $questionData) {
                $response[] = [
                    
                    'question_text' => $questionData['question_text'],
                    'answers' => $questionData['answers'],
                    'department_name' => $questionData['answers'][0]['department_name']
                ];
            }

            // Send the JSON response using the Serializer
            $this->serializer->sendResponse(200, $response);
        } catch (Exception $e) {
            // Handle any exceptions and send an error response
            $this->serializer->sendResponse(500, ['error' => $e->getMessage()]);
        }
}
   

}

$data = new QuestionController();
$data->getAllQuestionsWithAnswers();



