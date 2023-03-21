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
                    @foreach($data as $semester) @php $courses =
                    App\Models\Semester::find($semester->id)->courses; @endphp

                    <h1>Nombre:</h1>
                    <p>{{$semester->name}}</p>
                    <h1>Descripcion:</h1>
                    <p>{{$semester->description}}</p>
                    <h1>Cursos:</h1>
                    <ul>
                        @foreach($courses as $career)
                        <li>{{$career->name}}</li>
                        @endforeach @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
