<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="{{ Auth::user()->avatar_url ? Auth::user()->avatar_url : 'https://cdn.webmodularity.com/img/user_default.png' }}" class="user-image" alt="User Image">
        <span class="hidden-xs">{{ Auth::user()->person->email }}</span>
    </a>

    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{ Auth::user()->avatar_url ? Auth::user()->avatar_url : 'https://cdn.webmodularity.com/img/user_default.png' }}" class="img-circle" alt="User Image">
            <p>
                {{ Auth::user()->person->getFullName() }}
                <small>{{  Auth::user()->person->email }}</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body no-padding">
            <table class="table table-striped no-margin">
                <tbody>
                <tr>
                    <th>Recent Logins</th>
                    <th>From</th>
                    <th>Via</th>
                </tr>
                @foreach($activeUserRecentLogins as $userLogin)
                    <tr>
                        <td><small>{{ $userLogin->logRequest->created_at->format('m/d/y h:ia') }}</small></td>
                        <td><small>{{ $userLogin->logRequest->ip_address }}</small></td>
                        <td><small>{{ $userLogin->getLoginVia() }}</small></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST">
                {{ csrf_field() }}
                <!-- <div class="pull-left">
                    <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                </div>
            </form>
        </li>
    </ul>
</li>