<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Model\Post;
use Config;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $post_type = 'page';

    public function index(Request $request)
    {
        $posts = Post::where('post_type', $this->post_type);

        if (! empty($request->search)) {
            $search = $request->search;
            $posts = $posts->where(function ($q) use ($search) {
                $q->where('post_title', 'like', '%'.$search.'%');
                $q->orWhere('post_content', 'like', '%'.$search.'%');
                $q->orWhere('post_excerpt', 'like', '%'.$search.'%');
            });
        }

        if (! empty($request->post_status)) {
            $post_status = $request->post_status;
            $posts = $posts->where(function ($q) use ($post_status) {
                $q->where('post_status', $post_status);
            });
        }

        $posts = $posts->latest()->paginate(10);

        $post_statuses = Config::get('custom.post.post_statuses');

        return view('admin.page.index', compact('posts', 'post_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        $post = POST::Create(['post_type' => $this->post_type, 'post_author' => $user->id]);

        return \Redirect::route('page.edit', $post->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = POST::where('id', $id)->with('media')->first();

        if (! $post) {
            return abort(404);
        }

        return view('admin.page.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $PostRequest, $id)
    {
        $post = Post::find($id);
        $post->post_title = $PostRequest->post_title;
        $post->post_content = $PostRequest->post_content;
        $post->post_excerpt = $PostRequest->post_excerpt;
        $post->meta_description = $PostRequest->meta_description;
        $post->post_status = $PostRequest->post_status;
        $post->featured_image = $PostRequest->featured_image;

        if (isset($PostRequest->slug)) {
            if (strcmp($post->slug, $PostRequest->slug) !== 0) {
                $post->slug = SlugService::createSlug(Post::class, 'slug', strtolower($PostRequest->slug));
            }
        } else {
            if (strcmp($post->slug, $PostRequest->post_title) !== 0) {
                $post->slug = SlugService::createSlug(Post::class, 'slug', strtolower($PostRequest->post_title));
            }
        }

        if (! empty($PostRequest->categories)) {
            TaxonomyRelation::where(['post_id' => $PostRequest->id])->delete();
            foreach ($PostRequest->categories as $category) {
                TaxonomyRelation::create(['post_id' => $PostRequest->id, 'term_id' => $category]);
            }
        }

        if ($PostRequest->comment_status && $PostRequest->comment_status == 'open') {
            $post->comment_status = 'open';
        }

        $post->save();

        return back()->withSuccess('Page saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return back()->withsuccess('Page deleted successfully!');
    }

    public function bulkAction(Request $request)
    {

        if (! isset($request->check_box_bulk_action)) {
            return back()->with(['message' => 'Please select an page!']);
        }

        $post_ids = array_values($request->check_box_bulk_action);

        if (! empty($post_ids)) {
            if ($request->bulk_action == 'draft') {
                Post::whereIn('id', $post_ids)->update(['post_status' => 'draft']);

                return \Redirect::route('page.index')->with(['success' => 'Page saved to draft!']);
            }

            if ($request->bulk_action == 'published') {
                Post::whereIn('id', $post_ids)->update(['post_status' => 'published']);

                return \Redirect::route('page.index')->with(['success' => 'Page saved to draft!']);
            }

            if ($request->bulk_action == 'delete') {
                Post::whereIn('id', $post_ids)->delete();

                return \Redirect::route('page.index')->with(['success' => 'Page deleted successfully!']);
            }
        }

        return \Redirect::route('page.index')->with(['error' => 'No post selected!']);
    }
}
