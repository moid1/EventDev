<?php

namespace App\Http\Controllers;

use App\Models\BugTypes;
use App\Models\Issues;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bugTypes = BugTypes::all();
        return view('front.issues.create', compact('bugTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $issues = Issues::create([
            'type' => $request->type,
            'description' => $request->description,
            'name' => $request->name,
            'email' => $request->email,
            'status' => 'new',
        ]);
        return redirect()->back()->with('message','Your issue has been sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function show(Issues $issues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function edit(Issues $issues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issues $issues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issues $issues)
    {
        //
    }
}
