<div class="panel panel-default">
    <div class="panel-heading">
        {{ __("navbar.dashboard") }} 
        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
    </div>
    <div class="panel-body">

        <div class="panel panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
                            <div class="large">{{ $dashboard["total"] }}</div>
                            <div class="text-muted">{{__("dashboard.customers")}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-star color-orange"></em>
                            <div class="large"> {{ $dashboard["unique"] }}</div>
                            <div class="text-muted">{{ __("dashboard.unique") }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
                    <div class="panel panel-red panel-widget">
                        <div class="row no-padding"><em class="fa fa-xl fa-copy color-red"></em>
                            <div class="large">{{ $dashboard["duplicated"] }}</div>
                            <div class="text-muted">{{ __("dashboard.duplicated")}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.row-->
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel border-right">
                        <h4>{{__("dashboard.unique")}}</h4>
                    <div class="easypiechart" id="easypiechart-blue" data-percent="{{ $dashboard["per_unique"] }}"><span
                                class="percent">{{ $dashboard["per_unique"] }} %</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel border-right">
                        <h4>{{ __("dashboard.duplicated")}}</h4>
                        <div class="easypiechart" id="easypiechart-orange" data-percent="{{ $dashboard["per_duplicated"] }}"><span
                                class="percent">{{ $dashboard["per_duplicated"] }}%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel border-right">
                        <h4>{{ __("dashboard.no_email") }}</h4>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="{{ $dashboard["per_no_email"] }}"><span
                                class="percent">{{ $dashboard["per_no_email"] }}%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>{{ __("dashboard.no_last_name") }}</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="{{ $dashboard["per_no_last_name"] }}"><span
                                class="percent">{{ $dashboard["per_no_last_name"] }}%</span></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>