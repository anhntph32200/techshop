<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChipRequest;
use App\Http\Requests\UpdateChipRequest;
use App\Models\Chip;

use App\Models\Ram;
use App\Models\Storage;

use Illuminate\Http\Request;

class ChipController extends Controller
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
        $chip = Chip::query()->paginate(5);

        

        $ram = Ram::query()->paginate(5);
        $storage = Storage::query()->paginate(5);
        return view('admin.pages.chips.index', compact('chip', 'ram', 'storage'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.chips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChipRequest $request)
    {
        $param = $request->except('_token');
        if($request->isMethod('POST')){
            Chip::create($param);
        }


        return redirect()->route('admins.chips.index')->with('success','Chip được thêm thành công');

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
        $chip = Chip::query()->findOrFail($id);
        return view('admin.pages.chips.edit',compact('chip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChipRequest $request, string $id)
    {
        $chip = Chip::query()->findOrFail($id);
        $param = $request->except('_token','_method');
        $chip->update($param);

        return redirect()->route('admins.chips.index')->with('success','Chip được sửa thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chip = Chip::query()->findOrFail($id);
        $chip->delete();
        return redirect()->back()->with('success','xóa thành công');
    }
}
