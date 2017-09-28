<div class="form-group">
    <label>User Name</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter your name...']) !!}
</div>
<div class="form-group">
    <label>Email Address</label>
    <div class="input-group">
    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter email...']) !!}
    <span class="input-group-addon">
    <i class="fa fa-envelope"></i>
    </span>
    </div>
</div>
<div class="form-group">
    <label>User role</label>
    {!! Form::select('role', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class' => 'form-control', 'id' => 'role',  'placeholder' => 'Choose user role...']) !!}
</div>
<div class="form-group">
    <label>User status</label>
    {!! Form::select('status', [ '1' => 'Active', '2' => 'Panding', '3' => 'Blocked' ], null, ['class' => 'form-control', 'id' => 'role']) !!}
</div>

<div class="form-group">
    <label for="Password">Password</label>
    <div class="input-group">
        {!! Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Enter password...']) !!}
        <span class="input-group-addon">
            <i class="fa fa-user font-silver"></i>
        </span>
    </div>
</div>

<div class="form-group">
    <label for="password_confirmation">Password Confirm</label>
    <div class="input-group">
        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Enter password confirmation...']) !!}
        <span class="input-group-addon">
            <i class="fa fa-user font-silver"></i>
        </span>
    </div>
</div>

<div class="form-group">
    <label for="avatar">Avatar</label>
    <div class="fileinput fileinput-new avatar_box" data-provides="fileinput">
        <div class="input-group input-large">
            <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                <span class="fileinput-filename"> </span>
            </div>
            <span class="input-group-addon btn default btn-file">
                <span class="fileinput-new"> Select image </span>
                <span class="fileinput-exists"> Change </span>
                {!! Form::file('avatar') !!}
            </span>
            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
        </div>
    </div>
</div>

@if(isset($user) && $user->meta('avatar'))
    <img src="{{ $user->meta('avatar') }}" alt="{{ $user->name }}" height="100" />
@endif