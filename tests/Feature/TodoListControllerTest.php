<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testControllerTodoList()
    {
        $response = $this->withSession([
            'user' => 'murtaki',
            'todolist' => [
                'id' => '1',
                'todo' => 'Mandi'
            ]
        ])->get('/todolist');

        $response->assertSeeText("1")->assertSeeText("Mandi");
    }
}
