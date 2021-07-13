<?php 

namespace sha443\rbac\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use sha443\rbac\traits\FlashMessages;


class RBACBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Custom traits
    use FlashMessages;
}

?>