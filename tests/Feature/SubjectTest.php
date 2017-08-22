<?php

namespace Tests\Feature;

use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubjectTest extends TestCase
{
    use DatabaseTransactions;

    public function testShowEndpointReturnsTheSpecifiedSubject()
    {
        $subject = factory(Subject::class)->create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        $response = $this->get("/subjects/{$subject->slug}");

        $response->assertSee('Laravel');
        $response->assertSee('laravel');
    }

    public function testStoreEndpointCreatesASubjectInTheDatabase()
    {
        $data = [
            'name' => 'Laravel',
            'slug' => 'laravel',
        ];

        $response = $this->postJson("/subjects", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('subjects', $data);
    }

    public function testUpdateEndpointUpdatesASubjectInTheDatabase()
    {
        $subject = factory(Subject::class)->create();

        $data = [
            'name' => 'Laravel',
            'slug' => 'laravel',
        ];

        $response = $this->patchJson("/subjects/{$subject->slug}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('subjects', $data);
    }

    public function testDestroyEndpointRemovesASubject()
    {
        $subject = factory(Subject::class)->create();

        $response = $this->deleteJson("/subjects/{$subject->slug}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('subjects', ['slug' => $subject->slug, 'deleted_at' => null]);
    }
}
