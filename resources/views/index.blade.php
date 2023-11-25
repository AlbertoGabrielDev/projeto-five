@extends('layouts.app')
@section('conteudo')
<div class="bg-gray-100 font-sans">
  <div class="text-gray-500 flex justify-center py-2.5 px-4 mx-5 my-4 hover:text-white text-9xl">
    <i class="fas fa-home mr-2"></i>Index
  </div>
  <div class="flex flex-wrap -mx-3 mb-5">
    @foreach ($permissions as $permission) 
      <div class="w-full max-w-full px-3 mb-6 mx-auto">
        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] border border-dashed border-stone-200 bg-white m-5">
          <div class="flex-auto block py-8 px-9">
            <div>
              <div class="flex flex-wrap w-full">
                <div class="flex flex-col mr-5 text-center mb-11 lg:mr-16">
                  <div class="inline-block mb-4 relative shrink-0 rounded-[.95rem]">
                    @if (pathinfo($permission->file_path, PATHINFO_EXTENSION) === 'pdf')                         
                      <embed src="/file/{{$permission->file_path}}" type="application/pdf" width="100%" height="500px">
                    @else                                        
                      <div class="bg-gray-200 rounded-lg overflow-hidden">
                        <img src="/file/{{$permission->file_path}}" alt="{{$permission->file_path}}" class="w-full h-full object-cover">
                      </div>
                    @endif
                  </div>
                    <div class="text-center">
                      <span class="block font-medium text-muted">Tipo de arquivo: {{ pathinfo($permission->file_path, PATHINFO_EXTENSION) }}</span>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    @endforeach
  </div>
</div>
@endsection