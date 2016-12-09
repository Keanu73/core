<?php

namespace App\Modules\Community\Http\Controllers\Site;

use App\Modules\Community\Models\Group;
use Auth;
use Input;
use Redirect;
use Exception;
use App\Models\Mship\Account;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\BaseController;

class Membership extends BaseController
{
    public function getDeploy()
    {
        $this->authorize('deploy', new \App\Modules\Community\Models\Membership());

        $defaultGroup = Group::isDefault()->first();
        \Auth::user()->addCommunityGroup($defaultGroup);

        $groups = Group::notDefault()->get();

        return $this->viewMake('community::site.membership.deploy')
                    ->with("groups", $groups);
    }
}
