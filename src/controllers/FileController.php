<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FileController {

    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    // POST endpoint to store file attributes
    public function store(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();

        // Input validation
        if (!isset($data['file_name']) || !isset($data['file_size']) || !isset($data['uploader_id'])) {
            $response->getBody()->write(json_encode(['error' => 'Missing attributes']));
            return $response->withStatus(400);
        }

        $attributes = [
            'file_name' => $data['file_name'],
            'file_size' => $data['file_size'],
            'uploader_id' => $data['uploader_id'],
            'upload_time' => date('Y-m-d H:i:s')
        ];

        $id = $this->file->storeAttributes($attributes);

        $response->getBody()->write(json_encode(['id' => $id]));
        return $response->withStatus(201);
    }

    // GET endpoint to retrieve file attributes
    public function get(Request $request, Response $response, $args) {
        $id = $args['id'];
        $file = $this->file->getFileAttributes($id);

        if (!$file) {
            $response->getBody()->write(json_encode(['error' => 'File not found']));
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($file));
        return $response->withStatus(200);
    }
}
?>
