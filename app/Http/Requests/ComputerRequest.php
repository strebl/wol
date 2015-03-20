<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComputerRequest extends Request {


    /**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        \Validator::extend('mac', function($attribute, $value, $parameters)
        {
            return preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $value);
        });

		return [
			'name' => 'required',
            'mac' => 'required|mac',
            'use_broadcast' => 'required',
            'broadcast' => 'required_if:use_broadcast,1|ip',
            'ip' => 'required_if:use_broadcast,0|ip',
            'subnet' => 'required_if:use_broadcast,0|ip',
		];
	}

}
