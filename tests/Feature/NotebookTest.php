<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Tests\TestCase;
class NotebookTest extends TestCase
{

    /**
     * Тестирование получения всех записных книжек
     */
    public function testGetNotebookList()
    {
        $response = $this->get('/api/notebook');

        $response->assertStatus(200);
    }

    /**
     * Тестирование добавления записной книжки
     */
    public function testNotebookCreate():void
    {
        $data = [
            'first_name'=> 'Petr',
            'last_name' => 'Petrov',
            'third_name' => 'Petrovich',
            'company' => 'abc',
            'phone' => '77009009099',
            'email' => 'aaa@bbb.com',
            'date_birth' => '2000-01-01'
        ];

        $response = $this->postJson('/api/notebook', $data);

        $response
            ->assertStatus(201)
            ->assertJson($data);
    }

    /**
     * Тестирование получения записной книжки по id
     */
    public function testGetNotebookById()
    {
        $factory =  Notebook::factory()->create();

        $notebook = $factory->getAttributes();

        $id = $notebook['id'];

        $response = $this->getJson("/api/notebook/$id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $id,
            ]);
    }

    /**
     * Тестирование редактирования записной книжки по id
     */
    public function testUpdateNotebookById()
    {
        $factory =  Notebook::factory()->create();

        $notebook = $factory->getAttributes();

        $id = $notebook['id'];

        $response = $this->postJson("/api/notebook/$id", [
            'first_name'=> 'Саша',
            'last_name' => 'Александров',
            'third_name' => 'Александрович',
            'company' => 'alex',
            'phone' => '11111111111',
            'email' => 'alex@alex.ru',
            'date_birth' => '2000-10-10',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $id,
                'first_name'=> 'Саша',
                'last_name' => 'Александров',
                'third_name' => 'Александрович',
                'company' => 'alex',
                'phone' => '11111111111',
                'email' => 'alex@alex.ru',
                'date_birth' => '2000-10-10',
            ]);
    }

    /**
     * Тестирование получения записной книжки по id
     */
    public function testDeleteNotebookById()
    {
        $factory =  Notebook::factory()->create();

        $notebook = $factory->getAttributes();

        $id = $notebook['id'];

        $response = $this->delete("/api/notebook/$id");

        $response
            ->assertJsonMissing([
                'id' => $id,
            ]);
    }
}
