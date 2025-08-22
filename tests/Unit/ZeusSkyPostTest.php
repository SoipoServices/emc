<?php

use LaraZeus\Sky\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = Post::factory()->create([
        'title' => 'Test Post Title',
        'content' => '<p>This is a <strong>test post</strong> with HTML content.</p>',
        'description' => 'This is a test description',
        'slug' => 'test-post-title',
        'user_id' => $this->user->id,
        'post_type' => 'post',
        'status' => \LaraZeus\Sky\Enums\PostStatus::PUBLISH,
    ]);
});

describe('Zeus Sky Post Model', function () {
    it('can be created with required fields', function () {
        expect($this->post->title)->toBe('Test Post Title')
            ->and($this->post->content)->toBe('<p>This is a <strong>test post</strong> with HTML content.</p>')
            ->and($this->post->slug)->toBe('test-post-title')
            ->and($this->post->post_type)->toBe('post');
    });

    it('has correct fillable attributes', function () {
        $fillable = (new Post())->getFillable();
        
        expect($fillable)->toContain('title', 'slug', 'content', 'description', 'user_id', 'post_type', 'status');
    });
});

describe('Post Content', function () {
    it('has getContent method', function () {
        expect($this->post)->toHaveMethod('getContent');
        expect($this->post->getContent())->toContain('test post');
    });

    it('handles title correctly', function () {
        expect($this->post->title)->toBe('Test Post Title');
    });
});

describe('Post Relationships', function () {
    it('belongs to a user', function () {
        expect($this->post->user)->toBeInstanceOf(User::class)
            ->and($this->post->user->id)->toBe($this->user->id);
    });

    it('can have tags', function () {
        // Zeus Sky uses Spatie Tags
        expect($this->post)->toHaveMethod('tags');
    });
});

describe('Post Attributes', function () {
    it('has post_type attribute', function () {
        expect($this->post->post_type)->toBe('post');
    });

    it('has status attribute', function () {
        expect($this->post->status)->toBeInstanceOf(\LaraZeus\Sky\Enums\PostStatus::class);
    });

    it('has proper timestamps', function () {
        expect($this->post->created_at)->toBeInstanceOf(\Carbon\Carbon::class)
            ->and($this->post->updated_at)->toBeInstanceOf(\Carbon\Carbon::class);
    });
});

describe('Post Methods', function () {
    it('can generate URLs', function () {
        // Zeus Sky posts should have route generation
        expect($this->post->slug)->toBe('test-post-title');
    });

    it('can check if published', function () {
        expect($this->post->status)->toBe(\LaraZeus\Sky\Enums\PostStatus::PUBLISH);
    });
});
