<?php

namespace App\Modules\Visittransfer\Events;

use App\Events\Event;

use App\Modules\Vt\Models\Application;
use Illuminate\Queue\SerializesModels;

class ApplicationRejected extends Event {
    use SerializesModels;

    public $application = null;

    public function __construct(Application $application){
        $this->application = $application;
    }
}