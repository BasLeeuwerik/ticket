<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create ticket') }}
        </h2>
    </x-slot>

    <div class="container text-white-900 dark:text-white mt-6 ml-6 mb-6 mr-6" style="width:100%">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="container mt-6 mb-6 mr-6 ml-6">
                        <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="start_date_time">Start Date & Time</label>
                                <input type="datetime-local" id="start_date_time" name="start_date_time" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date_time">End Date & Time</label>
                                <input type="datetime-local" id="end_date_time" name="end_date_time" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="employee">Employee</label>
                                <input type="text" id="employee" name="employee" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea id="note" name="note" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-6">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>