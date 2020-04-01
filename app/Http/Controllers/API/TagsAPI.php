<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\BackEnd\Tags\Store;
use App\Http\Resources\TagsResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsAPI extends ApiHome
{
    public function __construct(Tag $model){
        parent::__construct($model);
    }//end of constructor

    public function index(Request $request){
        return TagsResource::collection(Tag::all());
    }//end of index

    public function store(Store $request){
        $row=Tag::create($request->all());
        return $this->sendResponse(new TagsResource($row),'Created Successfully');
    }//end of store


    public function update(Store $request,$id){
        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This Tag Not Found',400);
        $row->update($request->all());
        return$this->sendResponse(new TagsResource($row),'Tag Updated Successfully');
    }//end of update
}
