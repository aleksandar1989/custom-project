<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TermRequest;
use App\Term;
use App\TermTaxonomy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TermRequest $request)
    {
        // create new term
        $terms = Term::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'template' => $request->input('template')
        ]);

        // create taxonomy for term
        $terms->taxonomy()->create([
            'parent_id' => $request->input('parent'),
            'taxonomy' => $request->input('taxonomy'),
            'description' => $request->input('description'),
            'language_id' => language()
        ]);

        $notification = array(
            'message' => 'Category is successfully created!',
            'type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Manage categories
     *
     * @param $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function show($taxonomy)
    {
        // get all categories leveled
        $categories = Term::getTerms($taxonomy);

        return view('admin.terms.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get term by id
        $term = Term::find($id);

        // get taxonomy
        $taxonomy = $term->taxonomy->taxonomy;

        // get all categories leveled
        $categories = Term::getTerms($taxonomy);

        return view('admin.terms.edit', compact('categories', 'term'));
    }

    /**
     * Update Category
     * @param TermRequest $request
     * @param $id
     */
    public function update(TermRequest $request, $id)
    {
        // get term by id
        $term = Term::find($id);

        $term->name = $request->input('name');
        $term->template = $request->input('template');

        if($request->input('slug') != $term->slug)
            $term->slug = $request->input('slug');

        if($term->save()) {

            // get term taxonomy by term_id
            $taxonomy = TermTaxonomy::where('term_id', $id)->first();
            $taxonomy->parent_id = $request->input('parent');
            $taxonomy->description = $request->input('description');

            $taxonomy->save();

            $message = [
                'message' => 'The category has been updated.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'The category has not been updated.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get term by id
        $term = Term::find($id);

        // delete term
        if($term->syncDelete()) {
            $message = [
                'message' => 'Category has been deleted.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'Category has not been deleted.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }

    /**
     * Show posts for current category
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function posts($id) {
        // get term by id
        $term = Term::findOrFail($id);

        $posts = $term->posts()->paginate(10);

        return view('admin.terms.posts', compact('posts', 'term'));
    }
}
