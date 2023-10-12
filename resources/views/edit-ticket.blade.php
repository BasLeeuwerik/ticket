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
                    <form method="PATCH" action="/tickets/{{ $ticket }}">
                        @csrf
                        @method('PUT')

                        <label for="employee">Employee</label>
                        <div class="form-group text-gray-900">
                            <div class="relative inline-block text-left">
                                <select name="user" class="mt-6 mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <option value="{{ $ticket->user->name }}">{{ $ticket->user->name }}</option>
                                    @foreach ($users as $user)
                                    <option value={{ $user->name }}> {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            </label>

                            <label for="status">Status</label>
                            <div class="form-group text-gray-900">
                                <div class="relative inline-block text-left">
                                    <select name="status" class="mt-6 mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        @foreach ($tickets as $ticket)
                                        <option value={{ $ticket->status }}>{{ $ticket->status }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                </label>

                                <a href="{{ route('tickets.update', $ticket['id']) }}" class="stretched-link text-white">Update</a>
                    </form>

                </div>
            </div>
        </div>
</x-app-layout>