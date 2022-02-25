<?php

namespace App\Http\Requests\Category;

use App\Domain\Contracts\Model\GroupContract;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;
use Pearl\RequestValidate\RequestAbstract;

class GetListByGroupIdWithSubcategoriesRequest extends RequestAbstract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['group_id' => "string[]"])]
    public function rules(): array
    {
        return [
            'group_id' => [
                'required',
                'integer',
                Rule::exists(GroupContract::TABLE_NAME, GroupContract::FIELD_ID)
            ]
        ];
    }
}
