<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        // Funcion interna de laravel para seleccionar todo del modelo Students
        $students = Student::all();
        return response()->json(['students' => $students], 200);
    }

    public function show($id){
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => "Estudiante no encontrado."], 400);
        }
        return response()->json(['student' => $student], 200);
    }

    public function store(Request $request){
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Crear el registro en la base de datos
        $student = Student::create($request->all());

        // Retornar la respuesta con el registro creado
        return response()->json(['student' => $student], 201);
    }
    public function update(Request $request, $id){
        $student = Student::find($id);

        // Verificar si el estudiante existe
        if (!$student) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('student')->ignore($student->$id)],
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Actualizar los datos del estudiante
        $student->update($request->all());

        // Retornar la respuesta con el estudiante actualizado
        return response()->json(['student' => $student], 200);
    }

    public function destroy($id){
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
        $student->delete();
        return response()->json(['message' => 'Estudiante no encontrado'], 200);
    }

}
