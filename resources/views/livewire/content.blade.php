@extends('layout/main')
@section('title', 'Laravel Livewire - Selection CRUD')
@section('content')
@livewire('managecontent')
@livewireScripts
<script>
    window.addEventListener('swal:modal', event => { 
        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
          timer: 3000,
        });
    });
    window.addEventListener('swal:confirm', event => { 
        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.livewire.emit('remove');
          }
        });
    });
    window.addEventListener('swal:destroyConfirm',event=>{
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete)=>{
            if(willDelete){
                window.livewire.emit('destroy', event.detail.id);
                swal({
                    title:'Deleted!',
                    text:'your file has been deleted',
                    icon:'success',
                })
            }
        });
    });
    window.addEventListener('swal:selectedDestroyConfirm',event=>{
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete)=>{
            if(willDelete){
                window.livewire.emit('selectedDestroy');
                swal({
                    title:'Deleted!',
                    text:'your selected file has been deleted',
                    icon:'success',
                })
            }
        });
    });
    window.addEventListener('swal:selectedExcelConfirm',event=>{
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete)=>{
            if(willDelete){
                window.livewire.emit('selectedExcel');
                swal({
                    title:'Exported!',
                    text:'your selected file has been export to excel',
                    icon:'success',
                })
            }
        });
    });
</script>
@endsection