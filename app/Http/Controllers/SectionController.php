<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search', null);

        $col = $request->get('col', 'id');

        $sort = $request->get('sort', 'desc');

        $rows = $request->get('rows', 10);

        $sections = new Section;

        if(!is_null($search)){
            $sections = $sections->where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%");
        }

        $sections = $sections->orderBy($col, $sort)->paginate($rows);

        return view('modules.sections.index')->with('sections', $sections);
    }

    public function create()
    {
        return view('modules.sections.create');
    }

    public function store(SectionRequest $request)
    {
        $section = Section::create($request->all());

        return redirect()->route('sections.index')->with('message', 'New section created');
    }

    public function edit(Section $section)
    {

        return view('modules.sections.edit')->with('section', $section);

        return response()->json($section);
    }

    public function update(SectionRequest $request, Section $section)
    {
        $section->update($request->all());

        return redirect()->back()->with('success', true);
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->back()->with('message', 'Section successfully deleted');
    }

    public function checkSlug()
    {

    }
}