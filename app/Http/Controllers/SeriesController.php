<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\flash;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Str;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $series = Series::query()->orderBy('nome')->get();
        //dd($series);
        //$series =  DB::select('SELECT nome FROM series;');

        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {

        $serie = $this->repository->add($request);
        $serie->cover = $serie->cover;
        $serie->save();

        //Podemos inserir informações das seguintes formas:

        /* $nomeSerie =    $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();*/
        //ou
        //(DB::insert('INSERT INTO series (nome) values (?)', [$nomeSerie]));

        //ou

        
        EventsSeriesCreated::dispatch(

            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );
        
   

        /*  $useList = User::all();

        foreach ($useList as $user) {

        $email = new SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );
        Mail::to($user)->later($email);*/
        //sleep(2);





        //Ou poderíamos tbm fazer desta forma:

        /*        
        $email = new SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
    );

                  // Mail::to(['name' => 'Vinicius', 'email' => 'vini_ide@yahoo.com.br'])->send($email);

                  Mail::to($request->user())->send($email);*/


        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        //dd($series->seasons());
        return view('series.edit')->with('serie', $series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series, Request $request)
    {

        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }
}
