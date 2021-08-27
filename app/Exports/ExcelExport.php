<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $selected;
    public function __construct($selected)
    {
        $this->selected = $selected;
    }

    public function collection()
    {
        foreach($this->selected as $key => $selected){
            $users[] = User::where('id',$this->selected[$key])->get();
        }
        // dd($users);
        // return $user;
        return collect($users);
    }
}
