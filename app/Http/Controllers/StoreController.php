<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $stores = Store::query();

            return DataTables::of($stores)
            ->editColumn('address', function($data) {
                return "$data->street, $data->suburb, $data->pincode";
            })
            ->editColumn('action', function($data) {
                return view('formActions.store-actions', compact('data'))->render();
            })
            ->make(true);
        }
        return view('stores.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Store has been removed successfully.');

        return redirect()->route('store.index');
    }
}
