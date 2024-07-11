<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolitsTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService  = $this->app->make(TodolistService::class);
    }

    public function   testTodoListNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Mandi");

        $todolist = Session::get("todolist");
        foreach ($todolist as $val) {
            self::assertEquals("1", $val["id"]);
            self::assertEquals("Mandi", $val["todo"]);
        }
    }


    public function testGetTodoListEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodoList());
    }

    public function testGetTodoListNotEmpty()
    {
        $expected = [
            [
                'id' => "1",
                'todo' => "Mandi"
            ],
            [
                'id' => "2",
                'todo' => "Sarapan"
            ],
            [
                'id' => "3",
                'todo' => "Berangkat Kerja"
            ]
        ];

        $this->todolistService->saveTodo("1", "Mandi");
        $this->todolistService->saveTodo("2", "Sarapan");
        $this->todolistService->saveTodo("3", "Berangkat Kerja");
        $actual = $this->todolistService->getTodoList();
        self::assertEquals($expected, $actual, 'The todo list should match the expected list');
    }
}
