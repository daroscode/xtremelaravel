<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::all();

        if ($inventory->count() > 0) {
            return response()->json(
                [
                'status' => 200,
                'items' => $inventory
                ], 200
            );
        } else {
            return response()->json(
                [
                'status' => 404,
                'message' => 'No records found at this time'
                ], 404
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|string|max:191',
            'quantity' => 'required',
            'value' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()
                ->json(
                    [
                    'status' => 422,
                    'message' => $validator->messages()
                    ], 422
                );
        } else {
            $inventory = Inventory::create(
                [
                'name' => $request->name,
                'quantity' => $request->quantity,
                'value' => $request->value
                ]
            );

            if ($inventory) {
                $new_inventory = Inventory::latest()->first();
                return response()->json(
                    [
                    'status' => 200,
                    'students' => 'Inventory itens added successfully',
                    'item_added' => $new_inventory
                    ], 200
                );
            } else {
                return response()->json(
                    [
                    'status' => 500,
                    'students' => 'Something went wrong'
                    ], 500
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);

        if ($inventory) {
            return response()->json(
                [
                'status' => 200,
                'item' => $inventory
                ], 200
            );
        } else {
            return response()->json(
                [
                'status' => 404,
                'students' => 'No records found.'
                ], 404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|string|max:191',
            'quantity' => 'required',
            'value' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                'status' => 422,
                'message' => $validator->messages()
                ], 422
            );
        } else {
            $inventory = Inventory::find($id);

            if ($inventory) {
                $inventory->update(
                    [
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'value' => $request->value
                    ]
                );
                return response()->json(
                    [
                    'status' => 200,
                    'students' => 'Inventory item updated successfully',
                    'updated' => $inventory
                    ], 200
                );
            } else {
                return response()->json(
                    [
                    'status' => 404,
                    'students' => 'No records found'
                    ], 404
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $destroyed_item = $inventory;

        if ($inventory) {
            $inventory->delete();
            return response()->json(
                [
                'status' => 200,
                'students' => 'Inventory item deleted successfully',
                'destroyed_item' => $destroyed_item
                ], 200
            );
        } else {
            return response()->json(
                [
                'status' => 404,
                'students' => 'Record not found'
                ], 404
            );
        }
    }
}
