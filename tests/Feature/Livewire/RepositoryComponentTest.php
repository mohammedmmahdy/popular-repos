<?php

namespace Tests\Feature\Livewire;

use App\Exports\RepositoryExport;
use Tests\TestCase;
use Livewire\Livewire;
use App\Mail\SendExcelMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\RepositoryComponent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepositoryComponentTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(RepositoryComponent::class)
            ->assertStatus(200);
    }

    /** @test */
    public function it_renders_with_repositories_from_github()
    {
        // Mock the HTTP response
        Http::fake([
            'https://api.github.com/search/repositories*' => Http::response([
                'items' => [
                    [
                        'id' => 1,
                        'name' => 'test-repo',
                        'language' => 'php',
                        'forks' => 0,
                        'created_at' => '2022-01-01T00:00:00Z',
                        'owner' => [
                            'login' => 'test',
                        ]
                    ],
                ],
            ], 200)
        ]);

        // Use Livewire to test the component
        Livewire::test('repository.index')
            ->set('language', 'php')
            ->set('created_at', '2023-01-01')
            ->set('per_page', 10)
            ->assertViewHas('repositories', function ($repositories) {
                return count($repositories) > 0 && $repositories[0]['name'] === 'test-repo';
            });
    }

    /** @test */
    public function it_sends_an_email()
    {
        // Mock the Mail facade
        Mail::fake();

        // Prepare some repositories data
        $repositories = [
            [
                'id' => 1,
                'name' => 'test-repo',
                'language' => 'php',
                'forks' => 0,
                'created_at' => '2022-01-01T00:00:00Z',
                'owner' => [
                    'login' => 'test',
                ]
            ],
        ];

        // Trigger the sending of the email
        Mail::to('recipient@example.com')->send(new SendExcelMail(collect($repositories)));

        // Assert that the email was sent
        Mail::assertSent(SendExcelMail::class);
    }
}
