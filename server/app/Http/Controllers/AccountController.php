<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Rules\UpperWord;
use App\Http\Models\BookAccount;
use App\Http\Models\Book;
use App\Http\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
     public function search(Request $request)
    {
        $search = $request->get('search');
        $query = DB::table('account')->select('*');
        if($search !== null){
            $query = $query
                    ->where('firstName','like','%'.$search.'%')
                    -> orwhere('lastName','like','%'.$search.'%')
                    -> orwhere('loginName','like','%'.$search.'%');
        }
        $accounts = $query
                -> paginate(5);
        $links = $accounts->appends(['search'=>$search])->links();
        return view('Account.index', compact(['accounts','search','links']));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validate = $request->validate([
            'field' => 'in:firstName,loginName,email,phone',
            'sort' => 'in:asc,desc',
        ]);
        $search = $request->get('search');

        $field = $request->query('field');

        $sort = $request->query('sort') ?: 'asc';
        
        $query = DB::table('account')->select('*');
        if($search !== null){
            $query = $query
                    -> where('firstName','like','%'.$search.'%')
                    -> orwhere('lastName','like','%'.$search.'%')
                    -> orwhere('loginName','like','%'.$search.'%');
        }
        if($field){
            $query = $query
                    -> orderBy($field,$sort);
        }

        $accounts = $query
                -> paginate(5);
        $links = $accounts -> appends(['field'=>$field,'sort'=>$sort,'search'=>$search])->links();
        return view('Account.index', compact(['accounts','field','sort','search','links']));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response{
     */
    public function create()
    {
        //
        return view('Account.register');
    }
    
    public function getMessageValidate(){
        return [
            'loginName.required'=>'Please enter user name.',
            'pass_word.required'=>'Please enter password.',
            're_password.required'=>'Please enter confirm password.',
            're_password.same'=>'That password does not match. Try again.',
            'phone.regex'=>'Phone number must be 10 digists or not invalid',
        ];
    }
    
    public function getRuleValidate($isAddRule){
        $ruleAccount=[
            'first_name'=>['bail','nullable','string','regex:/^[a-zA-Z ]{1,}$/',new UpperWord],
            'last_name'=>['bail','nullable','string','regex:/^[a-zA-Z ]{1,}$/',new UpperWord],
            'phone'=>'bail|nullable|regex:/^0[0-9]{2}-[0-9]{3}-[0-9]{4}$/',
        ];
        
        if($isAddRule){
            $ruleAdd =[
                'user_name'=>'bail|required|alpha_dash|unique:account,loginName',
                'pass_word'=>'bail|required|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z\d]{8,}$/',
                're_password'=>'bail|required|same:pass_word',
                'email'=>['bail','required','email','unique:account,email','max:255'],
            ];
            $rule=array_merge($ruleAdd,$ruleAccount);
        } else{
            $ruleEdit = [
                'password_new'=>'bail|nullable|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z\d]{8,}$/',
                'email'=>'bail|required|email|max:255',
            ];
            $rule=array_merge($ruleEdit,$ruleAccount);
        }
        return $rule;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $validate = $request->validate($this->getRuleValidate(true),$this->getMessageValidate());
            $account = new Account();
            $account->loginName = request('user_name');
            $account->password = Hash::make($request->pass_word);
            $account->firstName = request('first_name');
            $account->lastName = request('last_name');
            $account->email = request('email');
            $account->phone = request('phone');

            $account->save();
            DB::commit();
            return redirect()->back()->with('complete','Register complete');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            return redirect()->back()->with('error','System Error!');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        return view('Account.edit',compact('account','id'));
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
        DB::beginTransaction();
        try{
            $validate = $request->validate($this->getRuleValidate(false),$this->getMessageValidate());
            $account = Account::find($id);
            $account->password = Hash::make($request->password_new);
            $account->firstName = request('first_name');
            $account->lastName = request('last_name');
            $account->email = $request->get('email');
            $account->phone = $request->get('phone');
            $account->save();
            DB::commit();
            return redirect()->back()->with('complete','Update complete');
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
        $books = Book::select('book.id')
                ->join('book_account','book_account.bookId','=','book.id')
                ->where('accountId','=',$id)
                ->get();

        $deleteBookAccount = DB::table('book_account')
                ->where('accountId','=',$id)
                ->delete();

        foreach ($books as $book) {
            $book->forceDelete();
        }
        Account::destroy($id);
        return back();
    }
}
