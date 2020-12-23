<div class="panel panel-default">
    <div class="panel-heading">
        {{ __("navbar.import-customers") }} <span class="label label-success">{{ $importCustomers->total() }}</span>
        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
        <a class="panel-button-tab-right" type="button" href="/import-customers/create"><em
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
                            <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                                {{ __('import-customers.created_at') }}
                                @include('includes._sort-icon', ['field' => 'created_at'])
                            </a></th>
                            <th><a wire:click.prevent="sortBy('user_id')" role="button" href="#">
                                {{ __('import-customers.user_id') }}
                                @include('includes._sort-icon', ['field' => 'user_id'])
                            </a></th>
                            <th><a wire:click.prevent="sortBy('filename')" role="button" href="#">
                                    {{ __('import-customers.filename') }}
                                    @include('includes._sort-icon', ['field' => 'filename'])
                                </a></th>
                                <th><a wire:click.prevent="sortBy('count')" role="button" href="#">
                                    {{ __('import-customers.count') }}
                                    @include('includes._sort-icon', ['field' => 'count'])
                                </a></th>
                                <th><a wire:click.prevent="sortBy('header')" role="button" href="#">
                                    {{ __('import-customers.header') }}
                                    @include('includes._sort-icon', ['field' => 'header'])
                                </a></th>
                            <th>
                                {{ __('import-customers.actions') }}

                                </a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($importCustomers as $importCustomer)
                        <tr>
                            <td>{{ $importCustomer->created_at }}</td>
                            <td>{{ $importCustomer->user->name }}</td>
                            <td>{{ $importCustomer->filename }}</td>
                            <td>{{ $importCustomer->count }}</td>
                            <td>{{ $importCustomer->header }}</td>
                            <td>
                                <div class="row">
                                    <a class="btn" id="show" data-toggle="modal" href='/import-customers/{{ $importCustomer->id }}'><em
                                            class="fa fa-lg fa fa-eye color-blue">&nbsp;</em></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

            <div class="row mb-4">
                <div class="col text-center">
                    {{ $importCustomers->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
