<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminVideoTest extends TestCase
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

    public function test_home_lists_published_videos_newest_first(): void
    {
        Video::create([
            'title' => 'Vidéo masquée',
            'video_path' => 'site-videos/hidden.mp4',
            'video_date' => '2026-12-01',
            'is_published' => false,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSeeInOrder(['Néré Mining, le film', 'Néré Mining au SAMAO 2026'])
            ->assertDontSee('Vidéo masquée');
    }

    public function test_admin_can_add_a_video(): void
    {
        Storage::fake(config('filesystems.default'));

        $this->withSession($this->adminSession())
            ->post(route('admin.videos.store'), [
                'title' => 'Visite de la mine',
                'video_date' => '2026-11-20',
                'is_published' => '1',
                'video' => UploadedFile::fake()->create('visite.mp4', 4096, 'video/mp4'),
                'poster' => UploadedFile::fake()->image('apercu.jpg', 1280, 720),
            ])
            ->assertRedirect(route('admin.videos.index'));

        $video = Video::where('title', 'Visite de la mine')->firstOrFail();
        Storage::disk(config('filesystems.default'))->assertExists($video->video_path);
        Storage::disk(config('filesystems.default'))->assertExists($video->poster_path);

        $this->get(route('home'))
            ->assertOk()
            ->assertSeeInOrder(['Visite de la mine', 'Néré Mining, le film']);
    }

    public function test_deleting_a_bundled_video_keeps_its_public_file(): void
    {
        Storage::fake(config('filesystems.default'));
        $video = Video::where('video_path', 'videos/nere-mining-film-720p.mp4')->firstOrFail();

        $this->withSession($this->adminSession())
            ->delete(route('admin.videos.destroy', $video))
            ->assertRedirect(route('admin.videos.index'));

        $this->assertModelMissing($video);
        $this->assertFileExists(public_path('videos/nere-mining-film-720p.mp4'));
    }
}
