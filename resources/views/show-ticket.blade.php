<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @php
                $datetime1 = new DateTime($ticket->created_at);
                $datetime2 = new DateTime($ticket->end_date_time);
                $interval = $datetime1->diff($datetime2);

                $days = $interval->format('%m months %a days %h hours');

                @endphp
                <div class="container text-white-900 dark:text-white mt-6 ml-6 mb-6 mr-6" style="width:100%">
                <a href="/tickets/{{ $ticket->id }}/edit">Edit</a>

                <p class="mt-6"><b>ID:</b> {{ $ticket->id }} </p>
                    <p><b>Status:</b> {{ $ticket->status }} </p>
                    <p class="mb-6 mt-6"><b>Duration:</b> {{ $days }}</p>

                    <p><b>Start Date & Time:</b> {{ $ticket->start_date_time }}</p>
                    <p><b>End Date & Time:</b> {{ $ticket->end_date_time }}</p>
                    <p><b>Employee:</b> {{ $ticket->user->name }}</p>
                    <p><b>Note:</b> {{ $ticket->comment }}</p>
                    <p><b>Photo:</b> <img src="{{ asset('path_to_your_images/' . $ticket->image_url) }}" alt="Ticket Photo"></p>

                    <p class="mt-6"><b>Materials</b></p>
                    <ul>
                        @foreach($ticket->materials as $material)
                        <li>{{ $material->name }} - Quantity: {{ $material->quantity }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>