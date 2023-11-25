@extends('layouts.app')

@section('conteudo')
<div class="bg-white p-4 rounded-md w-full">
  <div class="mx-auto m-5 text-4xl font-medium text-slate-700 flex justify-center">Editar Usuário</div> 
  <a class=" text-gray-500 py-2.5 px-4 relative mx-5 my-4 w-1/12 rounded hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white" href="{{route('indexProfile')}}">
    <i class="fa fa-angle-left mr-2"></i>Back
  </a>
  
  
  <form action="{{route('editSave', $users->first()->id)}}" method="POST">
    @csrf
    @foreach ($users as $user)
      <div class="grid md:grid-cols-3 md:gap-6 py-4">
          <div class="relative z-0 w-full mb-6 group">
            <input type="number" name="id" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" aria-label="Sizing example input" disabled value="{{$user->id}}">
            <label for="text" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Id</label>
          </div>
          <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" aria-label="Sizing example input" value="{{$user->name}}">
            <label for="text" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
          </div>
          <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="email" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" aria-label="Sizing example input" value="{{$user->email}}">
            <label for="text" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
          </div>
      </div>
      @endforeach
      <button type="submit" class="block text-gray-500 py-2.5 relative my-4 w-48 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white">
        <i class="fas fa-plus mr-2"></i> Editar
      </button>
  </form>
</div>
@endsection
