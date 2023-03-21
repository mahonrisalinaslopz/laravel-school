<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Dashboard") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ol>
                        @foreach ($data as $career) @php $courses =
                        App\Models\Career::find($career->id)->courses; @endphp
                        Carrera :
                        <li>
                            <ul class="list-disc">
                                <li>id: {{$career->id}}</li>

                                <li>nombre: {{$career->name}}</li>

                                <li>descripcion: {{$career->description}}</li>
                                <li>
                                    <ol class="list-decimal">
                                        cursos: @foreach ($courses as $course)
                                        <li>{{ $course->name }}</li>
                                        @endforeach
                                    </ol>
                                </li>
                            </ul>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
