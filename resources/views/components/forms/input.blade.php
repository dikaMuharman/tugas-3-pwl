<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">{{Str::ucfirst($name)}}</label>
    <input type="{{$type}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value ? $value : old($name)}}" {{$attributes}}>
    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>