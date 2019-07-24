@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel panel-default col-md-10 col-md-offset-1">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                </h4>
            </div>

            @include('common.error')

            <div class="panel-body">

                <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name-filed">用户名</label>
                        <input type="text" class="form-control" name="name" id="name-filed"
                               value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email-filed">邮 箱</label>
                        <input type="text" class="form-control" name="email" id="email-filed"
                               value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="introduction-filed">个人简介</label>
                        <textarea name="introduction" id="introduction-filed" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}
                        </textarea>
                    </div>
                    <div class="well well-sm">
                        <button class="btn btn-primary" type="submit">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop