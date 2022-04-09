<x-app-layout>
    <div class="container">
        <div class="row">
            <h2>Edit proposta {{$proposta->titulo}}</h2>
        </div>
        <form method="POST" action="{{route('propostas.update', ['startup' => $startup, 'proposta' => $proposta])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="título" id="titulo" class="form-control" value="{{old('título', $proposta->titulo)}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="pitch" class="form-label">Vídeo do pitch</label>
                    <input type="file" name="vídeo_do_pitch" id="pitch" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descrição" id="descricao" cols="30" rows="10">{{old('descrição', $proposta->descricao)}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success submit-form-btn">Salvar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace( 'descricao' );
    </script>
</x-app-layout>