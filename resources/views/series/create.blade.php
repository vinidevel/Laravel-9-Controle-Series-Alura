<x-layout title="Nova Série">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" autofocus id="nome" name="nome" class="form-control"
                    value="{{ old('nome') }}">
            </div>



            <div class="col-2">
                <label for="seasonsQty" class="form-label">N° Temporadas:</label>
                <input type="text" id="seasonsQty" name="seasonsQty" class="form-control"
                    value="{{ old('seasonsQty') }}">
            </div>


            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Ep/ Temporada:</label>
                <input type="text" id="episodesPerSeason" name="episodesPerSeason" class="form-control"
                    value="{{ old('episodesPerSeason') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Capa</label>
                    <input type="file" 
                                    id="cover" 
                                    name="cover" 
                                    class="form-control" 
                                   >
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

</x-layout>
