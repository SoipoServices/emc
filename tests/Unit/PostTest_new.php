<?php

use LaraZeus\Sky\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = Post::factory()->create(['user_id' => $this->user->id]);
});

describe('Zeus Sky Post Model', function () {
    it('can be created', function () {
        expect($this->post)->toBeInstanceOf(Post::class);
    });

    it('belongs to a user', function () {
        expect($this->post->user)->toBeInstanceOf(User::class)
            ->and($this->post->user->id)->toBe($this->user->id);
    });

    it('has required fillable attributes', function () {
        $post = Post::factory()->create([
            'title' => 'Test Post Title',
            'slug' => 'test-post-title',
            'content' => '<p>This is test content.</p>',
            'status' => 'publish'
        ]);
        
        expect($post->title)->toBe('Test Post Title')
            ->and($post->slug)->toBe('test-post-title')
            ->and($post->content)->toContain('This is test content')
            ->and($post->status)->toBe('publish');
    });

    it('can be published or draft', function () {
        $publishedPost = Post::factory()->create(['status' => 'publish']);
        $draftPost = Post::factory()->create(['status' => 'draft']);
        
        expect($publishedPost->status)->toBe('publish')
            ->and($draftPost->status)->toBe('draft');
    });

    it('has searchable attributes', function () {
        expect($this->post)->toHaveMethod('toSearchableArray');
        
        $searchableArray = $this->post->toSearchableArray();
        expect($searchableArray)->toBeArray();
    });

    it('includes appended attributes in array', function () {
        $postArray = $this->post->toArray();
        
        expect($postArray)->toBeArray()
            ->and($postArray)->toHaveKey('title')
            ->and($postArray)->toHaveKey('content');
    });
});
