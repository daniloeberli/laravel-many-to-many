<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create',compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $request->validated();
        $data = $request->all();

        $new_project = new Project();
        $new_project->fill($data);

        $new_project->slug = Str::slug($new_project->title, '-');
        if (isset($data['image'])) {
            $new_project->image = Storage::put('uploads', $data['image']);
        }

        $new_project->save();

        if(isset($data['technologies'])){
            $new_project->technologies()->sync($data['technologies']);
        }
        
        return to_route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validated();

        $data = $request->all();
        $project->slug = Str::slug($project->title, '-');

        if (isset($data['image'])) {

            if($project->image){
                Storage::delete($project->image);
            }

            $project->image = Storage::put('uploads', $data['image']);
        }

        // if(isset($data['technologies'])){
        //     $project->technologies()->sync($data['technologies']);
        // }

        $technologies = isset($data['technologies']) ? $data['technologies'] : [];
        $project->technologies()->sync($technologies);

        $project->update($data); 

        return to_route('admin.projects.show', $project->id)->with('message', 'Hai modificato con successo il progetto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index');
    }
}
