<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;
use App\ProductionFloor;
use Illuminate\Http\Request;

class ProductionFloorController extends Controller
{
    public function index()
    {
        $title = 'Production Floor';
        $productionFloors = ProductionFloor::all();
        return view('pages.production-floor.index', compact('productionFloors', 'title'));
    }

    public function create(){
        $title = "Add Floor";
        return view('pages.production-floor.addEditFloor',compact('title'));
    }

    public function store(StoreFloorRequest $request){
        ProductionFloor::create($request->all());
        return redirect()->route('production-floor.index')->with(saveMessage());
    }

    public function edit($id){
        $productionFloor = ProductionFloor::find(encrypt_decrypt($id, 'decrypt'));
        $title = "Edit Floor";
        return view('pages.production-floor.addEditFloor',compact('title','productionFloor'));
    }

    public function update(UpdateFloorRequest $request,ProductionFloor $productionFloor){

//        $productionFloor = ProductionFloor::find($id);
        $validated = $request->all();
        $productionFloor->update($validated);
        return redirect()->route('production-floor.index')->with(updateMessage());
    }

    public function destroy(ProductionFloor $productionFloor)
    {
        $productionFloor->delete();

        return redirect()->back()->with(deleteMessage());
    }
}
