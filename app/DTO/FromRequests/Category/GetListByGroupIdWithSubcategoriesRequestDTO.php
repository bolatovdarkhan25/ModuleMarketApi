<?php

namespace App\DTO\FromRequests\Category;

use Spatie\DataTransferObject\DataTransferObject;

class GetListByGroupIdWithSubcategoriesRequestDTO extends DataTransferObject
{
    public int $groupId;
}
