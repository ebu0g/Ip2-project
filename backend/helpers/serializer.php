

<?php
class Serializer {
    public function sendResponse($statusCode, $data) {
        // Clear any previous output buffer to avoid header issues
        if (ob_get_length()) {
            ob_clean();
        }

        // Set the HTTP response code
        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Send JSON-encoded data
        echo json_encode($data);

        // End output buffering
        ob_end_flush();
    }

    public function SendNumberResponse($statusCode, $data) {
        if (ob_get_length()) {
            ob_clean();
        }

        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Ensure the data is always returned as valid JSON
        echo json_encode(['department_number' => $data]);
    }
}
?>