<div class="panel panel-default">
    <div class="panel-heading">
        {{ __("navbar.customers") }} <span class="label label-success">{{ $customers->total() }}</span>
        {{-- <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span> --}}
        <a class="panel-button-tab-right" type="button" href="/customers/create"><em
            class="fa fa-lg fa fa-plus color-blue">&nbsp; </em></a>    </div>
    <div class="panel-body">
        <div>
            <div class="row mb-4">
                <div class="col form-inline text-left">
                    &nbsp; Per Page: &nbsp;
                    <select wire:model="perPage" class="form-control">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                    <input wire:model="search" class="form-control panel-button-tab-right" type="text"
                        placeholder="Pesquisar...">
                </div>
            </div>

            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th><a wire:click.prevent="sortBy('title')" role="button" href="#">
                                {{ __('customers.title') }}
                                @include('includes._sort-icon', ['field' => 'title'])
                            </a></th>
                            <th><a wire:click.prevent="sortBy('first_name')" role="button" href="#">
                                    {{ __('customers.first_name') }}
                                    @include('includes._sort-icon', ['field' => 'first_name'])
                                </a></th>
                            <th><a wire:click.prevent="sortBy('last_name')" role="button" href="#">
                                    {{ __('customers.last_name') }}
                                    @include('includes._sort-icon', ['field' => 'lastn_ame'])
                                </a></th>
                            <th><a wire:click.prevent="sortBy('email')" role="button" href="#">
                                    {{ __('customers.email') }}
                                    @include('includes._sort-icon', ['field' => 'email'])
                                </a></th>
                                <th><a wire:click.prevent="sortBy('gender')" role="button" href="#">
                                    {{ __('customers.gender') }}
                                    @include('includes._sort-icon', ['field' => 'gender'])
                                </a></th>
                            <th><a wire:click.prevent="sortBy('ip_address')" role="button" href="#">
                                    {{ __('customers.ip_address') }}
                                    @include('includes._sort-icon', ['field' => 'ip_address'])
                                </a></th>
                            <th><a wire:click.prevent="sortBy('company')" role="button" href="#">
                                {{ __('customers.company') }}
                                @include('includes._sort-icon', ['field' => 'company'])
                                </a></th>
                            <th><a wire:click.prevent="sortBy('city')" role="button" href="#">
                                {{ __('customers.city') }}
                                @include('includes._sort-icon', ['field' => 'city'])
                                </a></th>
                            <th><a wire:click.prevent="sortBy('website')" role="button" href="#">
                                {{ __('customers.website') }}
                                @include('includes._sort-icon', ['field' => 'website'])
                                </a></th>
                             <th>
                                {{ __('customers.actions') }}

                                </a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->title }}</td>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>{{ $customer->ip_address }}</td>
                            <td>{{ $customer->company }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ Str::limit($customer->website, 20,'(...)') }}</td>
                            <td>
                                <div class="row">
                                    <a class="btn" id="show" data-toggle="modal" href='/customers/{{ $customer->id }}'><em
                                            class="fa fa-lg fa fa-eye color-blue">&nbsp;</em></a>

                                    <a class="btn" id="edit" data-toggle="modal"
                                        href='/customers/{{ $customer->id }}/edit'><em
                                            class="fa fa-lg fa-pencil color-teal">&nbsp;</em></a>

                                    <a class="btn" id="delete" data-toggle="modal"
                                        href='/customers/{{ $customer->id }}/delete'><em
                                            class="fa fa-lg fa-remove color-red">&nbsp;</em></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-4">
                <div class="col text-center">
                    {{ $customers->links('pagination-bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</div>

@section('extra_js')
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
@endsection
