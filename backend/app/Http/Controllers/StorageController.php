<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStorageRequest;
use App\Http\Requests\UpdateStorageRequest;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $storage = Storage::query()->paginate(5);
        return view('admin.pages.storages.index', compact('storage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.storages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStorageRequest $request)
    {
        //

        $param = $request->except('_token');
        if($request->isMethod('POST')){
            Storage::create($param);
        }


        return redirect()->route('admins.chips.index')->with('success','Storage được thêm thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $storage = Storage::query()->findOrFail($id);
        return view('admin.pages.storages.edit',compact('storage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStorageRequest $request, string $id)
    {
        //

        $storage = storage::query()->findOrFail($id);
        $param = $request->except('_token','_method');
        $storage->update($param);


        return redirect()->route('admins.chips.index')->with('success','storage được sửa thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $storage = Storage::query()->findOrFail($id);
        $storage->delete();
        return redirect()->back()->with('success','xóa thành công');
    }
}
