<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NewsVideoTest extends TestCase
{
    use RefreshDatabase;

    private function adminSession(): array
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin-test@nere-mining.bf'],
            ['name' => 'Admin Test', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        return [
            'admin_logged_in'       => true,
            'admin_id'              => $admin->id,
            'admin_role'            => 'admin',
            'admin_session_renewed' => true,
        ];
    }

    public function test_admin_can_attach_a_video_shown_on_the_article(): void
    {
        Storage::fake(config('filesystems.default'));

        $this->withSession($this->adminSession())
            ->post(route('admin.news.store'), [
                'title' => 'Le film Néré Mining',
                'category' => 'Actualité',
                'published_at' => now()->format('Y-m-d'),
                'video' => UploadedFile::fake()->create('film.mp4', 2048, 'video/mp4'),
            ])
            ->assertRedirect(route('admin.news.index'));

        $news = News::where('title', 'Le film Néré Mining')->firstOrFail();
        $this->assertNotNull($news->video_path);
        Storage::disk(config('filesystems.default'))->assertExists($news->video_path);

        $this->get(route('news.show', $news))
            ->assertOk()
            ->assertSee('<video', false)
            ->assertSee(basename($news->video_path), false);
    }

    public function test_admin_can_remove_the_video(): void
    {
        Storage::fake(config('filesystems.default'));
        $path = UploadedFile::fake()->create('film.mp4', 512, 'video/mp4')
            ->store('news/videos', config('filesystems.default'));

        $news = News::create([
            'title' => 'Article vidéo',
            'category' => 'Actualité',
            'video_path' => $path,
            'published_at' => now(),
        ]);

        $this->withSession($this->adminSession())
            ->put(route('admin.news.update', $news), [
                'title' => 'Article vidéo',
                'category' => 'Actualité',
                'remove_video' => '1',
            ])
            ->assertRedirect(route('admin.news.index'));

        $this->assertNull($news->fresh()->video_path);
        Storage::disk(config('filesystems.default'))->assertMissing($path);
    }
}
