<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container text-white-900 dark:text-white mt-6 ml-6 mb-6 mr-6" style="width:100%">
                    <h1>Edit Ticket</h1><br>
                    <form method="PATCH" action="/ticket/{{ $ticket->id }}/update" enctype="multipart/form-data">
                        @method('PATCH')

                        <label for="employee">Employee</label>
                        <div class="form-group text-gray-900">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $ticket->user->name) }}">
                        </div><br>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>