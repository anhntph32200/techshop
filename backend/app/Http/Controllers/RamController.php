<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRamRequest;
use App\Http\Requests\UpdateRamRequest;
use App\Models\Ram;
use Illuminate\Http\Request;

class RamController extends Controller
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
        $ram = Ram::query()->paginate(5);
        return view('admin.pages.rams.index', compact('ram'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.rams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRamRequest $request)
    {
        $param = $request->except('_token');
        if($request->isMethod('POST')){
            Ram::create($param);
        }


        return redirect()->route('admins.chips.index')->with('success','Ram được thêm thành công');
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
        $ram = Ram::query()->findOrFail($id);
        return view('admin.pages.rams.edit',compact('ram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRamRequest $request, string $id)
    {
        $ram = Ram::query()->findOrFail($id);
        $param = $request->except('_token','_method');
        $ram->update($param);


        return redirect()->route('admins.chips.index')->with('success','Ram được sửa thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Ram = Ram::query()->findOrFail($id);
        $Ram->delete();
        return redirect()->back()->with('success','xóa thành công');
    }
}
