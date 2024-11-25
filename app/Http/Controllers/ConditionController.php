<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Models\Patient;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index(){
        return $this->Ok(Condition::with('patients')->get());
    }

    public function show(Patient $patient){
        return $this->Ok($patient->conditions);
    }

    public function store(Request $request){
        $validator = validator($request->all(), [
            'condition' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

            $condition = Condition::create($validator->validated());
            return $this->Ok($condition, 'Added condition Successfully');

    }
    public function update(Request $request, Condition $condition){
        $validator = validator($request->all(), [
            'condition' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        // $validated = $validator->validated()

            $condition->update($validator->validated());
            return $this->Ok($condition, 'Edited Successfully');

    }

    public function destroy(Request $request, Condition $condition){
            $condition->delete();
            return $this->Ok($condition, 'Patient Successfully Deleted');
    }

    public function attachCondition(Request $request){
        $validator = validator($request->all(), [
            'card_id' => 'required|exists:patients,card_id',
            'condition_id' => 'required|exists:conditions,id'
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        $validated = $validator->validated();

            $user = Patient::with(relations: 'conditions')->where('card_id','=',$validated['card_id'])->first();
            $user->conditions()->attach($validated['condition_id']);
            return $this->Ok($user, 'Attached Successfully');
    }
    public function detachCondition(Request $request){
        $validator = validator($request->all(), rules: [
            'card_id' => 'required',
            'condition_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->BadRequest($validator);
        }

        $validated = $validator->validated();

        $user = Patient::with(relations: 'conditions')->where('card_id','=',$validated['card_id'])->first();
        $user->conditions()->detach($validated['condition_id']);
        return $this->Ok($user, 'Attached Successfully');
    }

}
