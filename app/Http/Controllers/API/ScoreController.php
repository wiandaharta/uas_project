<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Score;

class ScoreController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        $student            = new Student;
        $student->nama      = $request->nama;
        $student->alamat    = $request->alamat;
        $student->no_telp   = $request->no_telp;
        $student->jns_klamin = $request->jns_klamin;
        $student->save();

        foreach ($request->list_pelajaran as $key => $value) {
            $score = array(
                'student_id' => $student->id,
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai'],
                'guru' => $value['guru']
            );
            $scores = Score::create($score);
        }

        return response()->json([
                'message'       => 'success'
            ], 200);
    }

    public function edit($id)
    {
        $student = Student::find($id);
        return response()->json([
                'message'       => 'success',
                'data_student'  => $student
            ], 200);
    }

    public function edit($id)
    {
        $score = Score::find($id);
        
        return response()->json([
                'message'       => 'success',
                'data_score'  => $score
            ], 200);
    }
    public function update(Request $request, $id)
    {
        $score = Score::find($id);

        $student            = new Student;
        $student->nama      = $request->nama;
        $student->alamat    = $request->alamat;
        $student->no_telp   = $request->no_telp;
        $student->jns_klamin = $request->jns_klamin;
        $student->save();

        foreach ($request->list_pelajaran as $key => $value) {
            Score::create([
                'student_id' => $student->id,
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai'],
                'guru' => $value['guru']
            ]);

            }

        return response()->json([
                'message'       => 'success',
                'data_student'  => $student
            ], 200);
    }

    public function delete($id)
    {
        $score = Score::find($id)->delete();

        return response()->json([
                'message'       => 'data student berhasil dihapus'
            ], 200);
    }
}
