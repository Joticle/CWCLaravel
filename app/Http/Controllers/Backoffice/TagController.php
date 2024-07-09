<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];
        $data['singular_name'] = 'Tag';
        $data['pulular_name'] = 'Tags';
        $breadcrumb = [];
        $breadcrumb['Tags'] = route('admin.tags.index');
        $breadcrumb['All Tags'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Tag::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.tags.index', $data);
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

        return view('backoffice.tags.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try {

            $this->tagService->store($request->validated());

            return redirect()->to(route('admin.tags.index'))->with('success', 'Tag Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
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

        return view('backoffice.tags.edit', $data);
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
        try {

            $this->tagService->update($tag, $request->validated());
            return redirect()->to(route('admin.tags.index'))->with('success', 'Tag Updated Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try {
            $this->tagService->delete($tag);

            return response()->json(['success' => true, 'reload' => true, 'message' => 'Tag Deleted Successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        $tags = Tag::where('name', 'like', '%' . $request->q . '%')->limit(15)->get(['id', 'name as text']);
        return ['items' => $tags];
    }

    public function createNewTags(array $tagNames)
    {
        try {
            foreach ($tagNames as $name) {
                Tag::firstOrCreate(['name' => trim($name)]);
            }
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }
}
