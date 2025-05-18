
<?php
class Serializer {
    public function sendResponse($statusCode, $data) {
        // Ensure no output has been sent before setting headers
        if (headers_sent()) {
            throw new Exception('Headers already sent. Cannot modify headers.');
        }

        // Set the HTTP response code
        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Send JSON-encoded data
        echo json_encode($data);
    }

    public function SendNumberResponse($statusCode, $data) {
        // Ensure no output has been sent before setting headers
        if (headers_sent()) {
            throw new Exception('Headers already sent. Cannot modify headers.');
        }

        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Ensure the data is always returned as valid JSON
        echo json_encode(['department_number' => $data]);
    }

    public function activeUser($statusCode, $data) {
        // Ensure no output has been sent before setting headers
        if (headers_sent()) {
            throw new Exception('Headers already sent. Cannot modify headers.');
        }

        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Ensure the data is always returned as valid JSON
        echo json_encode(['count' => $data]);
    }
}





class CurdSerializer {

    public function list($statusCode, $data){
        // Ensure no output has been sent before setting headers
        if (headers_sent()) {
            throw new Exception('Headers already sent. Cannot modify headers.');
        }

        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Ensure the data is always returned as valid JSON
        echo json_encode($data);
    }

    public function retriveSingle($statusCode, $data){
        // Ensure no output has been sent before setting headers
        if (headers_sent()) {
            throw new Exception('Headers already sent. Cannot modify headers.');
        }

        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Ensure the data is always returned as valid JSON
        echo json_encode($data);
    }

    public function delete($statusCode, $data){
        // Ensure no output has been sent before setting headers
        if (headers_sent()) {
            throw new Exception('Headers already sent. Cannot modify headers.');
        }

        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Ensure the data is always returned as valid JSON
        echo json_encode($data);
    }

}
?>