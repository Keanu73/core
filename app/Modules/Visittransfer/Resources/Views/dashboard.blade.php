@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-4 hidden-xs">
            {!! HTML::panelOpen("Visiting", ["type" => "vuk", "key" => "letter-v"]) !!}
                    <!-- Content Of Panel [START] -->
            <!-- Top Row [START] -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p>
                        You can apply to become a visitor if you:
                    <ul>
                        <li>want to control <strong>specific facilities*</strong> within the UK</li>
                        <li><strong>do not</strong> wish to leave your current division</li>
                    </ul>
                    <small>*Each facility will require a separate application.</small>
                    </p>
                </div>

            </div>

            <br/>

            <div class="row">
                <div class="col-xs-12 text-center">
                    @can("create", new \App\Modules\Visittransfer\Models\Application)
                        {!! Button::success("START APPLICATION")->asLinkTo(route("visiting.application.start", [\App\Modules\Visittransfer\Models\Application::TYPE_VISIT])) !!}
                    @elseif($currentVisitApplication)
                        {!! Button::primary("CONTINUE APPLICATION")->asLinkTo(route("visiting.application.continue")) !!}
                    @elseif($currentTransferApplication)
                        {!! Button::danger("You currently have a transfer application open.")->disable() !!}
                    @else
                        {!! Button::danger("You are not able to apply to visit at this time.")->disable() !!}
                    @endcan
                </div>
            </div>

            {!! HTML::panelClose() !!}
        </div>

        <div class="col-md-4 hidden-xs">
            {!! HTML::panelOpen("Transferring", ["type" => "vuk", "key" => "letter-t"]) !!}
                    <!-- Content Of Panel [START] -->
            <!-- Top Row [START] -->
            <div class="row">
                <div class="col-md-10 col-xs-offset-1">
                    <p>
                        You can apply to transfer if you:
                    <ul>
                        <li>want the freedom to <strong>control anywhere</strong> within the UK*</li>
                        <li><strong>are happy</strong> to leave your current division</li>
                    </ul>
                    <small>*subject to appropriate training and GRP restrictions.</small>
                    </p>
                </div>

            </div>

            <br/>

            <div class="row">
                <div class="col-xs-12 text-center">
                    @can("create", new \App\Modules\Visittransfer\Models\Application)
                        {!! Button::success("START APPLICATION")->asLinkTo(route("visiting.application.start", [\App\Modules\Visittransfer\Models\Application::TYPE_TRANSFER])) !!}
                    @elseif($currentTransferApplication)
                        {!! Button::primary("CONTINUE APPLICATION")->asLinkTo(route("visiting.application.continue")) !!}
                    @elseif($currentVisitApplication)
                        {!! Button::danger("You currently have a visit application open.")->disable() !!}
                    @else
                        {!! Button::danger("You are not able to apply to transfer at this time.")->disable() !!}
                        @endcan
                </div>
            </div>

            {!! HTML::panelClose() !!}
        </div>

        <div class="col-md-4 hidden-xs">
            {!! HTML::panelOpen("References", ["type" => "vuk", "key" => "letter-r"]) !!}

            <div class="row">
                {!! Form::horizontal(["route" => "visiting.reference.complete", "method" => "POST"]) !!}
                <div class="col-md-10 col-md-offset-1">
                    {!! ControlGroup::generate(
                        Form::label("reference_token", "Reference Token"),
                        Form::text("reference_token", Input::old("reference_token"), ["placeholder" => "VTREF-T4R7YN-H4GG15"]),
                        Form::help("You will find the token in the email you were sent.")
                    ) !!}

                    {!! ControlGroup::withContents(
                        Form::submit("COMPLETE REFERENCE", ["class" => "btn-info"])
                    )->withAttributes(["class" => "text-center"]) !!}

                </div>
                {!! Form::close() !!}

            </div>

            {!! HTML::panelClose() !!}
        </div>

        <div class="col-xs-12 visible-xs">
            {!! HTML::panelOpen("Start a new Application", ["type" => "fa", "key" => "exclamation"]) !!}
                <p class="text-center">You can only complete your application and references on a non-mobile device.</p>
            {!! HTML::panelClose() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! HTML::panelOpen("Previous Applications", ["type" => "fa", "key" => "list-alt"]) !!}
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Type</th>
                            <th width="25%">Facility</th>
                            <th width="10%" class="hidden-xs hidden-sm">Submitted</th>
                            <th>Outcome</th>
                            <th class="text-center">View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($allApplications) > 0)
                            <tr><td colspan="6" class="text-center">You have no applications to display.</td></tr>
                        @else
                            @foreach($allApplications as $application)
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->type }}</td>
                                    <td>{{ $application->facility_id }}</td>
                                    <td class="hidden-xs hidden-sm">{{ $application->submitted_at }}</td>
                                    <td>
                                        <span class="btn btn-danger btn-xs text-center">REJECTED</span>
                                        <span class="hidden-xs hidden-sm">
                                            Your application did not meet the requirements of the VT Policy.
                                        </span>
                                    </td>
                                    <td class="text-center">{!! link_to_route("visiting.application.view", "View", [$application->id]) !!}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            {!! HTML::panelClose() !!}
        </div>
    </div>
@stop
