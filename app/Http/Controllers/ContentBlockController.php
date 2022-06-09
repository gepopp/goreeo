<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Http\Requests\StoreContentBlockRequest;
use App\Http\Requests\UpdateContentBlockRequest;

class ContentBlockController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContentBlockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentBlockRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentBlock  $contentBlock
     * @return \Illuminate\Http\Response
     */
    public function show(ContentBlock $contentBlock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentBlock  $contentBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentBlock $contentBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContentBlockRequest  $request
     * @param  \App\Models\ContentBlock  $contentBlock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContentBlockRequest $request, ContentBlock $contentBlock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentBlock  $contentBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentBlock $contentBlock)
    {
        //
    }
}
