@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">
    <div>
        <a href="{{ route('room') }}" class="btn btn-danger mb-5">Back</a>
    </div>
    {{-- <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data"> --}}
    <form id="updateroom" action="/admin/room/update/{{ $datas->id }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mt-3">
            <img src="{{ $datas->image }}" alt="Gambar Room" width="100px">
        </div>
        <div class="mt-3">
            <label>Add Image <span class="text-warning">*Upload gambar untuk mengubah gambar / kosongi jika tidak merubah</span></label><br>
            <input type="file" id="image" name="image">
        </div>

         <div class="mt-3">
            <label> Room Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Room Name" id="name" name="name" value="{{ $datas->name }}">
        </div>

        <div class="mt-3">
            <label>Floor</label>
            <select class="form-control col-md-10" id="floor" name="floor"> 
                <option>------ Silahkan Pilih Lantai ------</option>
                @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" @if($i == $datas->floor) selected @endif>Lantai {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mt-3">
            <label class="">Capacity</label>
            <div class="row g-0">
                <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Capacity" id="capacity" name="capacity" value="{{ $datas->capacity }}">
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label class="">Facility</label>

            @foreach($datas->room_facilities as $key => $roomFacility) 
                <div class="row mb-3 g-0 facility-wrapper">
                    <div class="col-md-5">
                        <select class="form-control" name="facility_id[]"> 
                            <option selected>------ Silahkan Pilih Fasilitas ------</option>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}" @if($facility->id == $roomFacility->facility_id) selected @endif>{{ $facility->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-5">
                        <input type="number" class="form-control" placeholder="Banyaknya" name="quantity[]" value="{{$roomFacility->quantity}}">
                    </div>

                    @if($key != 0)
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-block button-delete-facility" type="button">Delete</button>
                        </div>
                    @endif
                </div>
            @endforeach

            <div id="facility-section">
                
            </div> 
            <div class="row mt-3 g-0">
                <div class="col-lg-3">
                    <button class="btn btn-success" type="button" onclick="addFacility()">Add Facility</button>
                </div>
            </div>
        </div>

        <!-- nb agata: tag button must inside tag form -->
        <div class="w-100 text-center">
            <button type="submit" class="btn btn-primary mt-5" value="save">Save</button>
        </div>
    </form>

</div>

@endsection
@show

@section('js')
<script>
    const addFacility = () => {
        $("#facility-section").append(`
            <div class="row mb-3 g-0 position-relative facility-wrapper">
                <div class="col-md-5">
                    <select class="form-control" name="facility_id[]"> 
                        <option selected>------ Silahkan Pilih Fasilitas ------</option>
                        @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" placeholder="Banyaknya" name="quantity[]">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger btn-block button-delete-facility" type="button">Delete</button>
                </div>
            </div>
        `);
    }

    $(document).on("click", ".button-delete-facility", function() {
        $(this).parents().remove(".facility-wrapper"); 
    });


    $(document).on("submit", "#updateroom", function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const method = form.attr('method');
        const redirect = '{{ route("room") }}';
        const data = new FormData(form[0]);

        submitForm(url, method, data, redirect);
    });
</script>
@endsection
