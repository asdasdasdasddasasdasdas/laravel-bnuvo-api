<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Guest::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|string|unique:guests,phone',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();

        // Определение страны по номеру телефона
        if (!isset($data['country'])) {
            $data['country'] = $this->getCountryFromPhone($data['phone']);
        }

        $guest = Guest::create($data);

        return response()->json($guest, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guest = Guest::find($id);
        return response()->json($guest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:guests,email,' . $id,
            'phone' => 'sometimes|required|string|unique:guests,phone,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();

        // Определение страны по номеру телефона, если не указана
        if (!isset($data['country']) && isset($data['phone'])) {
            $data['country'] = $this->getCountryFromPhone($data['phone']);
        }

        $guest = Guest::find($id);
        $guest->update($data);
        return response()->json($guest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return response()->json(['message' => 'Guest deleted successfully']);
    }

    /**
     * Determine the country from the phone number.
     */
    private function getCountryFromPhone($phone)
    {
        // Пример определения страны по коду телефона
        if (strpos($phone, '+7') === 0) {
            return 'Россия';
        }
        // Добавьте дополнительные условия для других стран
        // Например:
        // if (strpos($phone, '+1') === 0) {
        //     return 'США';
        // }

        return 'Неизвестная страна';
    }
}
