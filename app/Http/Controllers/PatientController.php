<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return $this->Ok(Patient::with(['conditions'])->get());
    }

    /**
     * Retrieves a specified Patient's data
     * @param \App\Models\Patient $patient
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(Patient $patient)
    {
        return $this->Ok($patient->all());
    }

    /**
     * Adds a Patient record to the database
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'card_id' => 'required|string|unique:Patients,card_id',
            'first_name' => 'required|string|max: 64',
            'middle_name' => 'required|string|max: 64',
            'last_name' => 'required|string|max: 64',
            'age' => 'required|integer|max:200',
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        $patient = Patient::create($validator->validated());

        return $this->Ok($patient, 'Registered Successfully');
    }

    /**
     * Modifies the Patient's data from the database
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Patient $patient)
    {
        $validator = validator($request->all(), [
            'card_id' => 'sometimes|string|unique:patients,card_id', // in case Patient wants to change cards or any the fol. info now
            'first_name' => 'sometimes|string|max: 64',
            'middle_name' => 'sometimes|string|max: 64',
            'last_name' => 'sometimes|string|max: 64',
            'age' => 'sometimes|integer|max:200',
            'status' => 'required|in:Alive,Deceased,Missing'
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }
            $patient->update($validator->validated());
            return $this->Ok($patient, 'Edited Successfully');

        
    }

    /**
     * Deletes a Patient record from the database
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Patient $patient)
    {{
            $patient->delete();
            return $this->Ok($patient, 'Patient Successfully Deleted');

    }
}
}