<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class RoleCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60|min:3',
            'description' => 'nullable|string|max:255',
        ];
    }
}
