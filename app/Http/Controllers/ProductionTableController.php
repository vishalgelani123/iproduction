<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\ProductionFloor;
use App\ProductionTable;
use Illuminate\Http\Request;

class ProductionTableController extends Controller
{
    public function index(){
        $title = 'Production Floor';
        $productionTables = ProductionTable::with('floor')->latest()->get();
        return view('pages.production-table.index', compact('productionTables', 'title'));
    }

    public function create(){
        $title = 'Create Table';
        $floors = ProductionFloor::all();
        return view('pages.production-table.addEditTable', compact('floors','title'));
    }

    public function store(StoreTableRequest $request){
        ProductionTable::create($request->all());
        return redirect()->route('production-table.index')->with(saveMessage());
    }

    public function edit($id){
        $productionTable = ProductionTable::find(encrypt_decrypt($id, 'decrypt'));
        $title = "Edit Table";
        $floors = ProductionFloor::all();
        return view('pages.production-table.addEditTable',compact('title','productionTable','floors'));
    }

    public function update(UpdateTableRequest $request,ProductionTable $productionTable){
        $validated = $request->validated();
        $productionTable->update($validated);
        return redirect()->route('production-table.index')->with(updateMessage());
    }

    public function destroy(ProductionTable $productionTable){
        $productionTable->delete();

        return redirect()->back()->with(deleteMessage());
    }
}
