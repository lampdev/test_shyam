@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-md">
                <div class="flex items-center justify-between mb-3 p-3">
                    <h2 class="text-lg font-medium text-gray-900">
                        Users
                    </h2>

                    <div>
                        <form
                            action="{{ route('user.index') }}"
                            method="GET"
                        >
                            <label for="tenant" class="hidden">Tenant</label>
                            <select
                                id="tenant"
                                name="tenant_id"
                                class="rounded-md bg-white border p-1"
                            >
                                <option value="">
                                    All tenants
                                </option>

                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->id }}" {{ $tenant->id == $tenant_id ? 'selected' : '' }}>
                                        {{ $tenant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <div class="p-3">
                    <div class="grid grid-cols-12 border-b border-gray-300">
                        <div class="col-span-4 p-2">
                            <span class="text-gray-800 font-medium">
                                Name
                            </span>
                        </div>

                        <div class="col-span-1 p-2">
                            <span class="text-gray-800 font-medium">
                                Age
                            </span>
                        </div>

                        <div class="col-span-1 p-2">
                            <span class="text-gray-800 font-medium">
                                Gender
                            </span>
                        </div>

                        <div class="col-span-6 p-2">
                            <span class="text-gray-800 font-medium">
                                Address
                            </span>
                        </div>
                    </div>

                    @foreach ($users as $user)
                    <div class="grid grid-cols-12 border-b border-gray-300 last:border-b-0">
                        <div class="col-span-4 p-2 flex flex-col">
                            <span class="text-gray-900 font-medium">
                                {{ $user->name }}
                            </span>

                            <span class="text-gray-700">
                                {{ $user->email }}
                            </span>
                        </div>

                        <div class="col-span-1 p-2 flex items-center">
                            <span class="text-gray-700">
                                {{ $user->getMeta('age') ?? 'unknown' }}
                            </span>
                        </div>

                        <div class="col-span-1 p-2 flex items-center">
                            <span class="text-gray-700 capitalize">
                                {{ $user->getMeta('gender') ?? 'unknown' }}
                            </span>
                        </div>

                        <div class="col-span-6 p-2 flex items-center truncate">
                            <span class="text-gray-700">
                                {{ $user->getMeta('address') ?? 'unknown' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
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
