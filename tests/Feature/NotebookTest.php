<?php

namespace Tests\Feature;

use Tests\TestCase;
class NotebookTest extends TestCase
{
    public function testGetNotebookList()
    {
        $response = $this->get('/api/notebook');

        $response->assertStatus(200);
    }
}
