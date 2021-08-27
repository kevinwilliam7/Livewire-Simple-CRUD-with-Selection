<?php

namespace App\Http\Livewire;

use App\Exports\ExcelExport;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Managecontent extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy','selectedDestroy','selectedExcel'];
    public $selected = [];
    public $selectedAll = false;
    public $entries=10;
    public $search;
    public $name, $password, $address, $email;

    public function mount(){
        $this->selected = collect();
    }

    public function render(){
        $users = User::
            where('name','like','%'.$this->search.'%')
            ->orWhere('address','like','%'.$this->search.'%')
            ->orWhere('email','like','%'.$this->search.'%')
            ->paginate($this->entries);
        $searchUsers = User::paginate($this->entries);
        return view(
            'livewire.managecontent',[
                'users'=>$users,
            ]
        );
    }
    
    public function destroyConfirm($id){
        $this->dispatchBrowserEvent('swal:destroyConfirm', [
            'type'=>'warning',
            'title'=>'Are you sure?',
            'text'=>'You will not be able to recover this file',
            'id'=>$id,
        ]);
    }

    public function selectedExcelConfirm(){
        $this->dispatchBrowserEvent('swal:selectedExcelConfirm', [
            'type'=>'',
            'title'=>'Are you sure?',
            'text'=>'You will export this selected file to excel',
        ]);
    }

    public function selectedDestroyConfirm(){
        $this->dispatchBrowserEvent('swal:selectedDestroyConfirm', [
            'type'=>'warning',
            'title'=>'Are you sure?',
            'text'=>'You will not be able to recover this selected file',
        ]);
    }

    public function destroy($id){
        User::where('id',$id)->delete();
        $this->reset();
    }

    public function selectedExcel(){
        return Excel::download(new ExcelExport($this->selected), 'excel.xlsx');
    }

    public function selectedDestroy(){
        foreach($this->selected as $key => $selected){
            User::where('id',$this->selected[$key])->delete();
        }
        $this->reset();
    }

    public function store(){
        $rules = [
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'email'=>'required',
        ];
        $customMessage = [
            'name.required' => 'custom message for name field',
            'password.required' => 'custom message for password field',
            'address.required' => 'custom message for name field',
            'email.required' => 'custom message for name field',
        ];
        $this->validate($rules,$customMessage);
        User::insert([
            'name'=>$this->name,
            'password'=>bcrypt($this->password),
            'address'=>$this->address,
            'email'=>$this->email,
        ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Success!', 
            'text' => 'Data stored to database.'
        ]);
    }
}
