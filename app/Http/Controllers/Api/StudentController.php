<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Student management.
 *
 * APIs for managing students.
 */
class StudentController extends Controller
{
    public function index() {

        $students = Student::all();

        if ($students->count() > 0) {
            return response()->json(
                [
                'status' => 200,
                'students' => $students
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

    public function store(Request $request) {

        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'phone' => 'required|digits:10',
            'course' => 'required|string|max:191'
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
            $student = Student::create(
                [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'course' => $request->course
                ]
            );

            if ($student) {
                return response()->json(
                    [
                    'status' => 200,
                    'students' => 'Student added successfully'
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

    public function show($id) {

        $student = Student::find($id);

        if ($student) {
            return response()->json(
                [
                'status' => 200,
                'students' => $student
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

    public function edit($id) {

        $student = Student::find($id);

        if ($student) {
            return response()->json(
                [
                'status' => 200,
                'students' => $student
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

    public function update(Request $request, int $id) {

        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'phone' => 'required|digits:10',
            'course' => 'required|string|max:191'
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
            $student = Student::find($id);

            if ($student) {
                $student->update(
                    [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'course' => $request->course
                    ]
                );
                return response()->json(
                    [
                    'status' => 200,
                    'students' => 'Student updated successfully'
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

    public function destroy(int $id) {

        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return response()->json(
                [
                'status' => 200,
                'students' => 'Student deleted successfully'
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
