<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['singular_name'] = 'Tag';
        $data['pulular_name'] = 'Tags';
        $breadcrumb = [];
        $breadcrumb['Tags'] = route('admin.tags.index');
        $breadcrumb['All Tags'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Tag::paginate(env('RECORD_PER_PAGE',10));
        return view('backoffice.tags.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['singular_name'] = 'Tag';
        $data['pulular_name'] = 'Tags';
        $breadcrumb = [];
        $breadcrumb['Tags'] = route('admin.tags.index');
        $breadcrumb['Add Tag'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.tags.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->validated());
        return redirect()->to(route('admin.tags.index'))->with('success','Tag Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $data = [];
        $data['singular_name'] = 'Tag';
        $data['pulular_name'] = 'Tags';
        $breadcrumb = [];
        $breadcrumb['Tags'] = route('admin.tags.index');
        $breadcrumb[$tag->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $tag;

        return view('backoffice.tags.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return redirect()->to(route('admin.tags.index'))->with('success','Tag Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['success' => true,'reload' => true, 'message' => 'Tag Deleted Successfully.']);
    }
}
