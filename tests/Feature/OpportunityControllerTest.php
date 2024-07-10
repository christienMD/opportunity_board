<?php

namespace Tests\Feature;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OpportunityControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $companyUser;
    private Opportunity $opportunity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->companyUser = User::factory()->create(['user_type' => 'company']);
        $this->opportunity = Opportunity::factory()->create(['user_id' => $this->companyUser->id]);
    }

    public function test_can_list_all_opportunities()
    {
        $response = $this->getJson(route('opportunities.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'title', 'status', 'description', 'img_url', 'category',
                        'created_at', 'closing_date', 'published_at',
                    ]
                ],
                'links', 'meta'
            ]);

        $this->assertNotEmpty($response->json('data'));
    }

    public function test_that_only_companies_can_create_opportunity()
    {
        $this->actingAs($this->companyUser);

        $opportunityData = [
            'title' => 'Test Opportunity',
            'category' => 'internship',
            'description' => 'Description of the new Test job opportunity Created today by me md christien.',
        ];

        $response = $this->postJson(route('opportunities.store'), $opportunityData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id', 'title', 'category', 'description', 'published_at', 'created_at',
                ]
            ])
            ->assertJson([
                'data' => $opportunityData
            ]);

        $this->assertDatabaseHas('opportunities', $opportunityData);
    }

    public function test_can_show_opportunity()
    {
        $response = $this->getJson(route('opportunities.show', $this->opportunity));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'title', 'status', 'description', 'img_url', 'category',
                    'created_at', 'closing_date', 'published_at',
                ]
            ])
            ->assertJson([
                'data' => [
                    'id' => $this->opportunity->id,
                    'title' => $this->opportunity->title,
                ]
            ]);
    }

    public function test_can_delete_opportunity()
    {
        $this->actingAs($this->companyUser);

        $response = $this->deleteJson(route('opportunities.destroy', $this->opportunity));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('opportunities', ['id' => $this->opportunity->id]);
    }

    public function test_can_publish_opportunity()
    {
        $this->actingAs($this->companyUser);

        $response = $this->postJson(route('opportunities.publish', $this->opportunity->id));
        // $response = $this->postJson("/api/opportunities/{$this->opportunity->id}/publish");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Opportunity published successfully.']);

        $this->assertDatabaseHas('opportunities', [
            'id' => $this->opportunity->id,
            'status' => 'Published',
        ]);
    }

    public function test_can_unpublish_opportunity()
    {
        $this->actingAs($this->companyUser);

        // First, publish the opportunity
        $this->opportunity->update(['status' => 'Published']);

        // $response = $this->postJson("/api/opportunities/{$this->opportunity->id}/unpublish");
        $response = $this->postJson(route('opportunities.unpublish', $this->opportunity->id));

        $response->assertStatus(200)
            ->assertJson(['message' => 'Opportunity unpublished successfully.']);

        $this->assertDatabaseHas('opportunities', [
            'id' => $this->opportunity->id,
            'status' => 'Pending',
        ]);
    }

    public function test_can_update_opportunity()
    {
        $this->actingAs($this->companyUser);

        $updatedData = [
            'title' => 'Updated Title',
            'category' => 'job',
            'description' => 'This is an updated description for the opportunity I just implemented now.',
            // 'img_upload' => 'http://example.com/new-image.jpg', 
        ];

        $response = $this->putJson(route('opportunities.update', $this->opportunity), $updatedData);

        if ($response->status() != 200) {
            dd($response->content());
        }

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'title', 'category', 'description', 'published_at', 'created_at',
                ]
            ])
            ->assertJson([
                'data' => $updatedData
            ]);

        $this->assertDatabaseHas('opportunities', $updatedData);
    }

    public function test_cannot_update_opportunity_created_by_another_user()
    {
        // Creating an original opportunity owner
        $originalOwner = User::factory()->create(['user_type' => 'company']);

        // Creating an opportunity owned by the original owner
        $opportunity = Opportunity::factory()->create([
            'user_id' => $originalOwner->id,
            'title' => 'Original Title',
            'category' => 'internship',
            'description' => 'Original description',
        ]);

        // Creating another user who will attempt to update the opportunity he did not create above
        $anotherUser = User::factory()->create(['user_type' => 'company']);
        $this->actingAs($anotherUser);

        $updatedData = [
            'title' => 'Updated The Original Opportunity Title',
            'category' => 'job',
            'description' => 'This is an updated description.',
            // 'img_upload' => 'http://example.com/new-image.jpg',
        ];

        $response = $this->putJson(route('opportunities.update', $opportunity), $updatedData);

        $response->assertStatus(403);


        $this->assertDatabaseMissing('opportunities', [
            'id' => $opportunity->id,
            'title' => $updatedData['title'],
            'category' => $updatedData['category'],
            'description' => $updatedData['description'],
        ]);
    }
}
