Creare un nuovo blog

Scaffolding base (PublicController, Components, Bootstrap c/Vite)

Homepage

Modello + Controller + Migrazione

Form di creazione

Salvataggio nel DB

Pagina con tutti gli oggetti creati


scrivo nel mio env nome del database e password //collego il db

php artisan make:migration create_authors_table //creo la migrazione per creare la tabella autori
php artisan migrate //lancio la migrazione
php artisan make:model Author //creo il modello autore

altro metodo :
php artisan make:model Author -m //in questo modo verrá creato sia il modello che la relativa migrazione

nella funzione up all'interno della migrazione trovo tutti i metodi per creare le colonne
della mia tabella

    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }

una volta modificata la migrazione lancio
php artisan migrate:rollback //elimino le tabelle create prima 
php artisan migrate //ricreo le tabelle con le giuste colonne

creo tramite artisan ArticleController

creo la rotta e la relativa vista article.index

//ARTICLE ROUTES
Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');

creo il componente card i cui richiamo gli attributi di article
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$item->title}}</h5>
            <p class="card-text">{{$item->body}}</p>
            {{-- <a href="{{route('show', ['id' => $item['id']])}}" class="btn btn-primary">{{$item['title']}}</a> --}}
        </div>
    </div>

nella vista index ciclo le card
    <x-layout>
        <section>
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 gap-3">
                    @forelse ($articles as $article)
                    <x-card :item="$article"/>
                    @empty
                    <span class="text-center">Nessun Articolo</span>
                    @endforelse
                </div>
            </div>
        </section>
    </x-layout>

creo le rotte create e store e le definisco nell'articlecontroller
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');

    public function create(){
        return view('article.create');
    }
    public function store(Request $request){
        Article::create($request->all());
        return 'ok';
    }

creo la vista create e all'interno inserico un form con metodo post e azione article.store

    <form action="{{route('article.store')}}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="title" class="form-label">Titolo Articolo</label>
            <input type="text" value="{{old('title')}}" class="form-control" name="title">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Corpo Articolo</label>
            <textarea name="body" id="" cols="30" rows="10">{{old('body')}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

nel modello article vado a creare l'array fillable //questo sará un elenco dei campi compilabili
protected $fillable = [
        'title', 'body'
    ];

