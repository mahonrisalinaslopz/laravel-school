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
                    <ul>
                        @foreach ($data as $course)
                        <li>nombre: {{$course->name}}</li>
                        <li>Descripcion: {{$course->descripcion}}</li>
                        <li>link: {{$course->link}}</li>
                        <li>Curso id:{{$course->career_id}}</li>

                        <li>{{$course->career->name}}</li>
                        <li>Semestre id: {{$course->semester_id}}</li>
                        <li>semestre name: {{$course->semester->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
