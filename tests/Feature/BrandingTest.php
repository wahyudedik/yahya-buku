<?php

use App\Models\BrandingSetting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('can render branding page', function () {
    $user = User::factory()->create();
    $res = $this->actingAs($user)->get('/admin/branding');
    $res->assertOk();
});

it('rejects logo above 2MB', function () {
    $user = User::factory()->create();
    Storage::fake('public');
    $bigImage = UploadedFile::fake()->image('big.jpg', 3000, 3000)->size(3000);
    $res = $this->actingAs($user)->post('/admin/branding', [
        'logo' => $bigImage,
        'logo_position' => 'left',
    ]);
    $res->assertSessionHasErrors('logo');
});

it('accepts valid logo and favicon and stores settings', function () {
    $user = User::factory()->create();
    Storage::fake('public');
    $logo = UploadedFile::fake()->image('logo.png', 400, 120)->size(200);
    $favicon = UploadedFile::fake()->image('fav.png', 32, 32)->size(30);

    $res = $this->actingAs($user)->post('/admin/branding', [
        'logo' => $logo,
        'favicon' => $favicon,
        'logo_width' => 180,
        'logo_height' => 54,
        'logo_position' => 'left',
        'favicon_enabled' => 1,
    ]);
    $res->assertSessionHasNoErrors()->assertRedirect('/admin/branding');

    $settings = BrandingSetting::first();
    expect($settings)->not->toBeNull();
    expect($settings->updated_by)->toBe($user->id);
    expect($settings->logo_width)->toBe(180);
    expect($settings->logo_height)->toBe(54);
    Storage::disk('public')->assertExists($settings->logo_path);
    Storage::disk('public')->assertExists($settings->favicon_path);
});

it('validates favicon png size', function () {
    $user = User::factory()->create();
    Storage::fake('public');
    $badFavicon = UploadedFile::fake()->image('fav.png', 24, 24)->size(20);
    $res = $this->actingAs($user)->post('/admin/branding', [
        'favicon' => $badFavicon,
        'logo_position' => 'left',
    ]);
    $res->assertSessionHasErrors('favicon');
});

it('can reset to default', function () {
    $user = User::factory()->create();
    BrandingSetting::create(['logo_position' => 'center']);
    $res = $this->actingAs($user)->post('/admin/branding/reset');
    $res->assertRedirect('/admin/branding');
    $settings = BrandingSetting::first();
    expect($settings->logo_position)->toBe('left');
});
