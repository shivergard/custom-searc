<?php namespace Shivergard\CustomSearch;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

use \Shivergard\CustomSearch\PackageController;

class CrudController extends PackageController {

    public function index() {

        $tables = Table::paginate(7);
        return view('custom-search::crud.index', compact('tables'));
    }

    public function create() {

        return view('custom-search::crud.create');
    }

    public function store(Requests\TableRequest $request) {


        Table::create($request->all());
        
        \Session::flash('flash_message','Your Data has been saved !!!');

        return redirect('table');
    }

    public function edit($id) {


        $table = Table::findOrFail($id);

        return view('custom-search::crud.edit', compact('table'));
    }

    public function update($id, Requests\TableRequest $request) {

        $table = Table::findOrFail($id);

        $table->update($request->all());
        \Session::flash('flash_message','Your Data has been Edited !!!');
        return redirect('table');
    }

    public function delete($id) {

        Table::find($id)->delete();
        return redirect('table');
    }

    public function search() {

        $name = Request::input('name');

        return View('custom-search::crud.search')->with('tables', Table::where('name', 'like', '%' . $name . '%')->paginate(7));
    }

}
