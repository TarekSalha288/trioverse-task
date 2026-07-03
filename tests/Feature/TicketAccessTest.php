<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketAccessTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest_users_are_blocked_from_creating_a_ticket(): void
    {
        $ticketData = [
            'title' => 'Problem',
            'body' => 'I have a problem with my account.',
        ];
        $response = $this->postJson('/api/tickets', $ticketData);
        $response->assertStatus(401);
        $this->assertDatabaseMissing('tickets', [
            'title' => 'Problem'
        ]);
    }
    public function test_client_cannot_view_or_modify_another_clients_ticket(): void
    {
        $clientA = User::factory()->create();
        $clientB = User::factory()->create();
        $ticketOfClientA = Ticket::factory()->create([
            'user_id' => $clientA->id,
            'title' => 'Private Ticket of Client A'
        ]);
        $this->actingAs($clientB);
        $viewResponse = $this->getJson("/api/tickets/{$ticketOfClientA->id}");
        $viewResponse->assertStatus(403);
        $updateResponse = $this->getJson("/api/tickets/{$ticketOfClientA->id}");
        $updateResponse->assertStatus(403);
        $this->assertDatabaseHas('tickets', [
            'id' => $ticketOfClientA->id,
            'title' => 'Private Ticket of Client A'
        ]);
    }
}
