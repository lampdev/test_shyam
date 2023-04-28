@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <h2 class="text-lg font-medium leading-6 text-gray-900">
                    Users
                </h2>

                <div>
                    <form
                        action="{{ route('user.index') }}"
                        method="GET"
                    >
                        <label
                            for="tenant"
                            class="sr-only"
                        >
                            Tenant
                        </label>

                        <select
                            id="tenant"
                            name="tenant_id"
                            class="rounded-md bg-white p-1 border"

                        >
                            <option value="">
                                All tenants
                            </option>

                            @foreach($tenants as $tenant)
                                <option
                                    value="{{ $tenant->id }}"
                                    {{ $tenant->id == $tenant_id ? 'selected' : '' }}
                                >
                                    {{ $tenant->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="shadow bg-white p-3 border-gray-200 sm:rounded-lg">
                <div class="grid grid-cols-12 border-b">
                    <div class="col-span-3 p-1 font-medium">
                        Name
                    </div>

                    <div class="col-span-3 p-1 font-medium">
                        Email
                    </div>

                    <div class="col-span-1 p-1 font-medium">
                        Age
                    </div>

                    <div class="col-span-1 p-1 font-medium">
                        Gender
                    </div>

                    <div class="col-span-4 p-1 font-medium">
                        Address
                    </div>
                </div>

                @foreach ($users as $user)
                <div class="grid grid-cols-12 border-b last:border-b-0">
                    <div class="col-span-3 p-2 truncate text-gray-600">
                        {{ $user->name }}
                    </div>

                    <div class="col-span-3 p-2 truncate text-gray-600">
                        {{ $user->email }}
                    </div>

                    <div class="col-span-1 p-2 truncate text-gray-600">
                        {{ $user->getMeta('age') }}
                    </div>

                    <div class="col-span-1 p-2 truncate text-gray-600">
                        {{ $user->getMeta('gender') }}
                    </div>

                    <div class="col-span-4 p-2 truncate text-gray-600">
                        {{ $user->getMeta('address') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Listen for changes to the tenant dropdown and submit the form
        document.getElementById('tenant').addEventListener('change', function () {
            this.form.submit();
        });
    </script>
@endsection
