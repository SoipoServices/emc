<?php

use App\Models\Comment;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->comment = Comment::factory()->create([
        'body' => 'This is a test comment.',
        'user_id' => $this->user->id,
    ]);
});

describe('Comment Model', function () {
    it('can be created with valid attributes', function () {
        expect($this->comment)->toBeInstanceOf(Comment::class)
            ->and($this->comment->body)->toBe('This is a test comment.')
            ->and($this->comment->user_id)->toBe($this->user->id);
    });

    it('has correct fillable attributes', function () {
        $fillable = $this->comment->getFillable();
        
        expect($fillable)->toContain('body');
    });

    it('uses HasFactory trait', function () {
        expect($this->comment)->toHaveMethod('factory');
    });
});

describe('Comment Relationships', function () {
    it('belongs to a user', function () {
        expect($this->comment->user)->toBeInstanceOf(User::class)
            ->and($this->comment->user->id)->toBe($this->user->id);
    });
});

describe('Comment Factory', function () {
    it('can create comment with factory', function () {
        $comment = Comment::factory()->create();
        
        expect($comment)->toBeInstanceOf(Comment::class)
            ->and($comment->body)->toBeString()
            ->and($comment->user_id)->toBeInt();
    });

    it('can create multiple comments', function () {
        $comments = Comment::factory()->count(3)->create();
        
        expect($comments)->toHaveCount(3);
        $comments->each(fn($comment) => expect($comment)->toBeInstanceOf(Comment::class));
    });
});

describe('Comment Validation', function () {
    it('requires body field', function () {
        expect($this->comment->body)->not->toBeEmpty();
    });

    it('can handle long comments', function () {
        $longComment = Comment::factory()->create([
            'body' => str_repeat('This is a very long comment. ', 50)
        ]);
        
        expect($longComment->body)->toBeString()
            ->and(strlen($longComment->body))->toBeGreaterThan(100);
    });

    it('can handle HTML in comments', function () {
        $htmlComment = Comment::factory()->create([
            'body' => '<p>This is a <strong>HTML</strong> comment.</p>'
        ]);
        
        expect($htmlComment->body)->toContain('<p>')
            ->and($htmlComment->body)->toContain('<strong>');
    });
});
