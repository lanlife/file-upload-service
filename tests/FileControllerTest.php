<?php

use PHPUnit\Framework\TestCase;

class FileControllerTest extends TestCase {

    private $file;
    private $fileController;

    protected function setUp(): void {
        $dbMock = $this->createMock(PDO::class);
        $this->file = new File($dbMock);
        $this->fileController = new FileController($this->file);
    }

    public function testStoreSuccess() {
        // Mock the file storage method
        $this->file->method('storeAttributes')->willReturn(1);

        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $request->method('getParsedBody')->willReturn([
            'file_name' => 'example.txt',
            'file_size' => 1024,
            'uploader_id' => 1
        ]);

        $responseMock = $this->fileController->store($request, $response, []);

        // Assert that the response has a 201 status
        $this->assertEquals(201, $responseMock->getStatusCode());
    }

    public function testGetSuccess() {
        $fileAttributes = [
            'id' => 1,
            'file_name' => 'example.jpg',
            'file_size' => 1024,
            'uploader_id' => 1,
            'upload_time' => '2024-01-01 12:00:00'
        ];

        $this->file->method('getFileAttributes')->willReturn($fileAttributes);

        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $responseMock = $this->fileController->get($request, $response, ['id' => 1]);

        // Assert that the response has a 200 status
        $this->assertEquals(200, $responseMock->getStatusCode());
    }
}
