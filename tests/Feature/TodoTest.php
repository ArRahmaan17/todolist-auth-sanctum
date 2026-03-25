<?php

namespace Tests\Feature;

use App\Models\ListTodo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_todos()
    {
        $user = User::factory()->create();
        ListTodo::create([
            'name' => 'Test Todo',
            'user_id' => $user->id,
            'is_done' => false,
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->getJson('/api/todos', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }

    public function test_user_can_create_todo()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->postJson('/api/todos', [
            'name' => 'New Todo',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Todo created successfully',
            ]);

        $this->assertDatabaseHas('list_todos', [
            'name' => 'New Todo',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_todo()
    {
        $user = User::factory()->create();
        $todo = ListTodo::create([
            'name' => 'Old Todo',
            'user_id' => $user->id,
            'is_done' => false,
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->putJson("/api/todos/{$todo->id}", [
            'name' => 'Updated Todo',
            'is_done' => true,
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Todo updated successfully',
            ]);

        $this->assertDatabaseHas('list_todos', [
            'id' => $todo->id,
            'name' => 'Updated Todo',
            'is_done' => true,
        ]);
    }

    public function test_user_can_delete_todo()
    {
        $user = User::factory()->create();
        $todo = ListTodo::create([
            'name' => 'Delete Me',
            'user_id' => $user->id,
            'is_done' => false,
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->deleteJson("/api/todos/{$todo->id}", [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Todo deleted successfully',
            ]);

        $this->assertDatabaseMissing('list_todos', [
            'id' => $todo->id,
        ]);
    }
}
