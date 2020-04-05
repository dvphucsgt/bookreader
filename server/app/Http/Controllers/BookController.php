<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BookAccount;
use Auth;

class BookController extends Controller
{
    /**
     * Show index view
     * 
     * @param Request $request
     * @return type
     */

    public function __construct()
    {
        $this->middleware('adminLogin');
    }

    public function getFile($foldername,$filename)
    {
        $fullpath='app/' . "{$foldername}/{$filename}";
        return response()->download(storage_path($fullpath), null, [], null);
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $query = DB::table('book')
                ->join('book_account','book_account.bookId','=','book.id')
                ->join('account','account.id','=','book_account.accountId')
                ->select('book.*', 'account.loginName');
        if($search !== null){
            $query = $query
                    ->where('name','like','%'.$search.'%')
                    -> orwhere('author','like','%'.$search.'%');
        }
        $books = $query
                -> paginate(5);
        $links = $books->appends(['search'=>$search])->links();
        return view('Book.List', compact(['books','search','links']));
    }
    public function index(Request $request)
    {
        $validator = $request->validate([
            'field'=>'nullable|in:name,author,uploadAt,size,loginName',
            'sort'=>'nullable|in:asc,desc',
        ]);
        $search = $request->get('search');
        $field = $request->get('field');
        $sort = $request->get('sort') ?: 'asc';
        $query = DB::table('book')
                    ->join('book_account','book_account.bookId','=','book.id')
                    ->join('account','account.id','=','book_account.accountId')
                    ->select('book.*', 'account.loginName');
        if ($search !== null) {
            $query = $query
                ->where('name','like','%'.$search.'%')
                ->orwhere('author','like','%'.$search.'%');
        }
        if($field){
            $books = $query->orderBy($field,$sort);
        }
        $books = $query
                ->paginate(5);
        $links = $books->appends(['search'=>$search,'field' => $field, 'sort' => $sort])->links();
        return view('Book.List', compact(['books','search','field','sort','links']));
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('Book.Add');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $validator = $request->validate(
            [
                'name'=>'bail|required|string|min:3|max:100',
                'author'=>'bail|required|string|min:3|max:100',
                'image'=>'image|mimes:jpeg,png,jpg,gif,svg',
                'book'=>'mimes:pdf,doc,docx',
            ]
        );
        DB::beginTransaction();
        try{
            $book = new book();  
            $book->name= $request->name;
            $book->author= $request->author;                             
            if($request->hasFile('image')){           
                $nameimage = time().'&'. $request->file('image')->getClientOriginalName(); 
                $file = $request->file('image');
                $Path = public_path('source_page/imgBook');
                $file->move($Path,$nameimage);
                $book->imagePath= 'imgBook/'.$nameimage;
            }
            
            if($request->hasFile('book')){           
                $namebook = time().'&'.$request->file('book')->getClientOriginalName(); 
                $file = $request->file('book')->storeAs('pdfBook',$namebook);
                $book->sourcePath= 'pdfBook/' . $namebook;
                $size=$request->file('book')->getSize();
                $book->size= round(($size/(1024*1024)),2);
            }        
            $book->save();

            $bookAccount = new BookAccount();
            $bookAccount->accountId = Auth::user()->id;
            $bookAccount->bookId = $book->id;
            $bookAccount->save();

            DB::commit();
            return redirect()->back()->with('complete','Add Complete');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            return redirect()->back()->with('error','System Error!');
        }
    //
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
    public function edit($id)
    {
        $book = Book::find($id); 
        return view('Book.Edit', compact('book','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        $validator = $request->validate(
            [
                'name'=>'required|string|min:3|max:100',
                'author'=>'required|string|min:3|max:100',
                'image'=>'image|mimes:jpeg,png,jpg,gif,svg',
                'book'=>'mimes:pdf,doc,docx',
            ]
        );    
        DB::beginTransaction();
        try{
            $book = Book::find($id);
            $book->name= $request->get('name');
            $book->author= $request->get('author');
            if($request->hasFile('image')){           
                $nameimage = time().'&'. $request->file('image')->getClientOriginalName(); 
                $file = $request->file('image');
                $Path = public_path('source_page/imgBook');
                $file->move($Path,$nameimage);
                $book->imagePath= 'imgBook/'.$nameimage;
            }               
            if($request->hasFile('book')){           
                $namebook = time().'&'.$request->file('book')->getClientOriginalName(); 
                $file = $request->file('book')->storeAs('pdfBook',$namebook);
                $book->sourcePath= 'pdfBook/' . $namebook;
                $size=$request->file('book')->getSize();
                $book->size= round(($size/(1024*1024)),2);
            }
            $book->save();
            $bookAccount = BookAccount::find($id);
            $bookAccount->accountId = Auth::user()->id;
            $bookAccount->save();
            
            DB::commit();
            return redirect()->back()->with('complete','Edit Complete');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            return redirect()->back()->with('error','System Error!');
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accountId = DB::table('account')
                ->join('book_account','book_account.accountId','=','account.id')
                ->where('bookId','=',$id)
                ->select('account.id')
                ->get();
        $deleteBookAccount = DB::table('book_account')
                ->where('bookId','=',$id)
                ->delete();
        Book::destroy($id);
        return back();
    }
}
