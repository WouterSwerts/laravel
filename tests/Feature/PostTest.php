<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
       $response = $this->get('/posts');
       $response->assertSeeText('No posts found!');

        
    }

    // public function testSee1BlogPostWhenThereIs1WithNoComments() {
        
    //     // arrange
    //     $post = $this->createDummyBlogPost();

    //     // act
    //     $response = $this->get('/posts');

    //     // assert
    //     $response->assertSeeText('New Title');
    //     $response->assertSeeText('No comments yet!');

    //     // check in table if it has a record
    //     $this->assertDatabaseHas('blog_posts', [
    //         'title' => 'New Title'
    //     ]);
        
    // }

    public function testSee1BlogPostWithComments() {
        
        $post = $this->createDummyBlogPost();
        Comment::factory(4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');


    }

    public function testStoreValid() 
    {

        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created');

    }

    public function testStoreFail() {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }


    public function testUpdateValid () {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'a new named title',
            'content' => 'Content was changed'
        ];

        $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');


        $this->assertEquals(session('status'), 'Blog post was updated!');

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());

    }

    public function testDelete() {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->actingAs($this->user())
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was deleted!');

    }


    private function createDummyBlogPost(){

        $post = BlogPost::factory()->newTitle()->create();

        return $post;
    }


}
